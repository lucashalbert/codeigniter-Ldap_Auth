<?php

defined("BASEPATH") OR exit("No direct script access allowed");

/**
 * CodeIgniter Ldapauth Controller
 * 
 * A simple LDAP authentication library for CodeIgniter
 *
 * @package         Ldap_Auth
 * @subpackage      Ldap_Auth Library
 * @author          Lucas Halbert <lhalbert@lhalbert.xyz>
 * @version         0.0.2
 * @link            https://github.com/lucashalbert/codeigniter-Ldap_Auth
 * @license         BSD 3-Clause "New" or "Revised" License
 * @copyright       Copyright © 2019 by Lucas Halbert <lhalbert@lhalbert.xyz>
 */

class Ldap_Auth {

    // Declare customer variable to load from ldap_auth config
    protected $customer = "customerA";

    // Declare protected CodeIgniter super-object variable
    protected $CI;

    // Declare protected configuration variables
    protected $servers;
    protected $ports;
    protected $tls_ca_cert;
    protected $tmp_tls_ca_certfile;
    protected $tls_cert;
    protected $tmp_tls_certfile;
    protected $tls_key;
    protected $tmp_tls_keyfile;
    protected $tls_required;
    protected $start_tls;
    protected $base_dn;
    protected $user_dn;
    protected $user_attribute;
    protected $bind_user_dn;
    protected $bind_user_pw;
    protected $member_attribute;

    // Declare LDAP connection object
    protected $ldap_connection;

    // Declare client_ip variable for use throughout class
    protected $client_ip;


    /**
     * Constructor function
     * @access public
     */
    function __construct() {
        // Check if ldap_connect functions exist
        if(! function_exists("ldap_connect")) {
            log_message("error", "LDAP functionality not detected. Please enable/load the LDAP module in php.ini or use a version of PHP with the module compiled in");
            show_error("LDAP functionality not detected. Please enable/load the LDAP module in php.ini or use a version of PHP with the module compiled in", 500, $heading = "An Error Was Encountered");
        }

        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();

        // Load session library
        $this->CI->load->library("session");

        // Load ldap config
        $this->CI->load->config("ldap_auth");

        // Load necessary configuration data from config file
        $this->servers          = $this->CI->config->item("servers", $this->customer);
        $this->ports            = $this->CI->config->item("ports", $this->customer);
        $this->tls_ca_cert      = $this->CI->config->item("tls_ca_cert", $this->customer);
        $this->tls_cert         = $this->CI->config->item("tls_cert", $this->customer);
        $this->tls_key          = $this->CI->config->item("tls_key", $this->customer);
        $this->tls_required     = $this->CI->config->item("tls_required", $this->customer);
        $this->start_tls        = $this->CI->config->item("start_tls", $this->customer);
        $this->base_dn          = $this->CI->config->item("base_dn", $this->customer);
        $this->user_dn          = $this->CI->config->item("user_dn", $this->customer);
        $this->user_attribute   = $this->CI->config->item("user_attribute", $this->customer);
        $this->bind_user_dn     = $this->CI->config->item("bind_user_dn", $this->customer);
        $this->bind_user_pw     = $this->CI->config->item("bind_user_pw", $this->customer);
        $this->member_attribute = $this->CI->config->item("member_attribute", $this->customer);

        // Capture client IP for logging purposes
        $this->client_ip = $this->_get_client_ip();
    } 


    /**
     * Destructor function
     * @access public
     */
    function __destruct() {
        // Close LDAP connection
        if($this->ldap_connection) {
            ldap_close($this->ldap_connection);
        }

        // Destroy temporary certificate files
        if($this->tmp_tls_ca_certfile) {
            $this->_destroy_tmp_file($this->tmp_tls_ca_certfile);
        }
        if($this->tmp_tls_certfile) {
            $this->_destroy_tmp_file($this->tmp_tls_certfile);
        }
        if($this->tmp_tls_keyfile) {
            $this->_destroy_tmp_file($this->tmp_tls_keyfile);
        }
    }


    /**
     * Login function
     * @access public
     * @param string $username
     * @param string $password
     * @return boolean
     */
    function login($username, $password) {
        log_message("info", "Attempting to login with username " . $username . " from " . $this->client_ip );

        // Attempt to connect to LDAP servers
        if(! $this->_connect_ldap()) {
            log_message("error", "LDAP server connection failed.");
            show_error("LDAP server connection failed.", 500, $heading = "An Error Was Encountered");
            return FALSE;
        }

        // Attempt login
        if($user = $this->_authenticate($username, $password)) {
            $this->CI->session->set_userdata($user);
        } else {
            return FALSE;
        }
        return TRUE;
    }


    /**
     * Logout function
     * @access public
     * @return boolean
     */
    function logout() {
        log_message("info", "Performing logout of " . $this->CI->session->userdata("username")[0] . " from " . $this->client_ip );
        $this->CI->session->sess_destroy();
        return TRUE;
    }


    /**
     * Function to check if user is currently authenticated
     * @access public
     * @return boolean
     */
    function is_authenticated() {
        if($this->CI->session->userdata("logged_in")) {
            return True;
        } else {
            return False;
        }
    }


    /**
     * Function to loop over and attempt connection to each configured LDAP server
     * @access private
     * @return boolean
     */
    private function _connect_ldap() {
        if($this->tls_ca_cert) {
            // Create temporary CA certificate file
            $this->tmp_tls_ca_certfile = $this->_create_tmp_file($this->tls_ca_cert);
        }
        if($this->tls_cert) {
            // Create temporary certificate file
            $this->tmp_tls_certfile = $this->_create_tmp_file($this->tls_cert);
        }
        if($this->tls_key) {
            // Create temporary key file
            $this->tmp_tls_keyfile = $this->_create_tmp_file($this->tls_key);
        }

        // Loop over all configured LDAP servers and attempt connection
        foreach($this->servers as $i => $server) {
            // Validate server connection string
            $this->ldap_connection = ldap_connect($server);

            if($this->ldap_connection) {
                log_message("info", "LDAP connection endpoint \"" . $server . "\" valid.");
                
                // Set LDAP protocol version
                if(! ldap_set_option($this->ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3)) {
                    log_message("error", "Error setting LDAPv3.");
                    show_error("Error setting LDAPv3.", 500, $heading = "An Error Was Encountered");
                }
                // Set LDAP referrals to 0
                if(! ldap_set_option($this->ldap_connection, LDAP_OPT_REFERRALS, 0)) {
                    log_message("error", "Error setting Referrals to 0.");
                    show_error("Error setting Referrals to 0.", 500, $heading = "An Error Was Encountered");
                }
                // Set LDAP connection timeout to 10 seconds
                if(! ldap_set_option($this->ldap_connection, LDAP_OPT_NETWORK_TIMEOUT, 10)) {
                    log_message("error", "Error setting connection timeout.");
                    show_error("Error setting connection timeout.", 500, $heading = "An Error Was Encountered");
                }
                // Check if TLS required
                if($this->tls_required) {
                    // Switch statement to determine if REQUIRE_CERT should be FALSE, NEVER, HARD, DEMAND, ALLOW, TRY
                    switch($this->tls_required) {
                        case "NEVER":
                            // Set REQUIRE_CERT to Never
                            if(! ldap_set_option($this->ldap_connection, LDAP_OPT_X_TLS_REQUIRE_CERT, LDAP_OPT_X_TLS_NEVER)) {
                                log_message("error", "Error setting TLS REQCERT to NEVER.");
                                show_error("Error setting TLS REQCERT to NEVER.", 500, $heading = "An Error Was Encountered");
                            }
                            break;
                        case "HARD":
                            // Set REQUIRE_CERT to Never
                            if(! ldap_set_option($this->ldap_connection, LDAP_OPT_X_TLS_REQUIRE_CERT, LDAP_OPT_X_TLS_HARD)) {
                                log_message("error", "Error setting TLS REQCERT to HARD.");
                                show_error("Error setting TLS REQCERT to HARD.", 500, $heading = "An Error Was Encountered");
                            }
                            break;
                        case "DEMAND":
                            // Set REQUIRE_CERT to Never
                            if(! ldap_set_option($this->ldap_connection, LDAP_OPT_X_TLS_REQUIRE_CERT, LDAP_OPT_X_TLS_DEMAND)) {
                                log_message("error", "Error setting TLS REQCERT to DEMAND.");
                                show_error("Error setting TLS REQCERT to DEMAND.", 500, $heading = "An Error Was Encountered");
                            }
                            break;
                        case "ALLOW":
                            // Set REQUIRE_CERT to Never
                            if(! ldap_set_option($this->ldap_connection, LDAP_OPT_X_TLS_REQUIRE_CERT, LDAP_OPT_X_TLS_ALLOW)) {
                                log_message("error", "Error setting TLS REQCERT to ALLOW.");
                                show_error("Error setting TLS REQCERT to ALLOW.", 500, $heading = "An Error Was Encountered");
                            }
                            break;
                        case "TRY":
                            // Set REQUIRE_CERT to Never
                            if(! ldap_set_option($this->ldap_connection, LDAP_OPT_X_TLS_REQUIRE_CERT, LDAP_OPT_X_TLS_TRY)) {
                                log_message("error", "Error setting TLS REQCERT to TRY.");
                                show_error("Error setting TLS REQCERT to TRY.", 500, $heading = "An Error Was Encountered");
                            }
                            break;
                        default:
                            // Set REQUIRE_CERT to TRY
                            if(! ldap_set_option($this->ldap_connection, LDAP_OPT_X_TLS_REQUIRE_CERT, LDAP_OPT_X_TLS_TRY)) {
                                log_message("error", "Error setting TLS REQCERT to TRY.");
                                show_error("Error setting TLS REQCERT to TRY.", 500, $heading = "An Error Was Encountered");
                            }
                            break;
                    }

                    if($this->tls_ca_cert) {
                        // Set CACERTFILE location to the tmp_tls_ca_certfile path
                        if(! ldap_set_option($this->ldap_connection, LDAP_OPT_X_TLS_CACERTFILE, $this->tmp_tls_ca_certfile)) {
                            log_message("error", "Error setting the TLS CA Certificate file.");
                            show_error("Error setting the TLS CA Certificate file.", 500, $heading = "An Error Was Encountered");
                        }
                    }
                    if($this->tls_cert) {
                        // Set CERTFILE location to the tmp_tls_certfile path
                        if(! ldap_set_option($this->ldap_connection, LDAP_OPT_X_TLS_CERTFILE, $this->tmp_tls_certfile)) {
                            log_message("error", "Error setting the TLS Certificate file.");
                            show_error("Error setting the TLS Certificate file.", 500, $heading = "An Error Was Encountered");
                        }
                    }
                    if($this->tls_key) {
                        // Set KEYFILE location to the tmp_tls_keyfile path
                        if(! ldap_set_option($this->ldap_connection, LDAP_OPT_X_TLS_KEYFILE, $this->tmp_tls_keyfile)) {
                            log_message("error", "Error setting the TLS Key file.");
                            show_error("Error setting the TLS Key file.", 500, $heading = "An Error Was Encountered");
                        }
                    }
                    if($this->start_tls) {
                        // Start TLS
                        ldap_start_tls($this->ldap_connection);
                    }
                }
            
                // Bind to LDAP for user lookup
                if($this->bind_user_dn) {
                    // Perform authenticated bind
                    $bind = ldap_bind($this->ldap_connection, $this->bind_user_dn, $this->bind_user_pw);
                } else {
                    // Perform anonymous bind
                    $bind = ldap_bind($this->ldap_connection);
                }

                // Break out of foreach loop if bind is successful
                if($bind) {
                    log_message("info", "Connection to " . $server . " successful.");
                    break;
                } else {
                    log_message("info", "Connection to " . $server . " failed.");
                }
            } else {
                log_message("info", "LDAP connection endpoint \"" . $server . "\" invalid.");
            }
        }

        if(! $this->ldap_connection) {
            log_message("error", "Error connecting to all defined LDAP servers.");
            show_error("Error connecting to all defined LDAP servers.", 500, $heading = "An Error Was Encountered");
        }

        // Check if bind succeeded
        if(! $bind) {
            log_message("error", "Error performing initial LDAP bind. Request originated from " . $this->client_ip . ".");
            show_error("Error performing initial LDAP bind. Request originated from " . $this->client_ip . ".", 500, $heading = "An Error Was Encountered");
        }

        return TRUE;
    }


    /**
     * Function to perform authentication against connected LDAP server
     * @access private
     * @param string $username
     * @param string $password
     * @return array
     *
     */
    private function _authenticate($username, $password) {
        // Username should be sanitized before making it to this function

        // Generate user search filter
        $user_filter = "(" . $this->user_attribute . "=" . $username . ")";

        // Array denoting which items to return from search
        $return_items = array("dn", "cn", "mail", $this->user_attribute);
        
        // Perform search
        $user_search = ldap_search($this->ldap_connection, $this->base_dn, $user_filter, $return_items);

        // Enumerate entries from search
        $user_entries = ldap_get_entries($this->ldap_connection, $user_search);

        // Check if user search returned any entries
        if($user_entries["count"] == 0) {
            log_message("error", "LDAP search for " . $username . " returned 0 entries. User does not exist.");
            show_error("Authentication Failure: " . $username . " from " . $this->client_ip . ". This authentication attempt has been recorded", 500, $heading = "Authentication Failure Detected");
            return False;
        }

        // Bind to LDAP for user authentication
        if(! $bind = ldap_bind($this->ldap_connection, $user_entries[0]["dn"], $password)) {
            log_message("info", "Authentication Failure: " . $username . " from " . $this->client_ip );
            show_error("Authentication Failure: " . $username . " from " . $this->client_ip . ". This authentication attempt has been recorded", 500, $heading = "Authentication Failure Detected");
            return FALSE;
        }

        // Return authenticated user info
        return array(
            "username"  => $user_entries[0]["cn"],
            "email"     => $user_entries[0]["mail"],
            "username"  => $user_entries[0][$this->user_attribute],
            "logged_in" => TRUE
        );
    }


    /**
     * Function to find and return client IP address
     * @access private
     * @return string
     */
    private function _get_client_ip() {
        if(array_key_exists("HTTP_X_FORWARD_FOR", $_SERVER)) {
            // Return last comma delimited item of HTTP_X_FORWARD_FOR in case multiple proxies were used
            $http_x_forward_for = array_values(array_filter(explode(",", $_SERVER["HTTP_X_FORWARD_FOR"])));
            return end($http_x_forward_for);
        } elseif(array_key_exists("REMOTE_ADDR", $_SERVER)) {
            return $_SERVER["REMOTE_ADDR"];
        } elseif(array_key_exists("HTTP_CLIENT_IP", $_SERVER)) {
            return $_SERVER["HTTP_CLIENT_IP"];
        } else {
            return "Unknown_IP";
        }
    }


    /**
     * Function to create temporary TLS CA Cert, Cert, and key files
     * for use with SSL ldap connections.
     * @access private
     * @param string $contents
     * @return string $file
     */
    protected function _create_tmp_file($contents) {
        // Create temporary file
        $file = tempnam(sys_get_temp_dir(), 'ldap_tls');

        // Open temporary file handle for writing
        $handle = fopen($file, "w");

        // Write contents to file handle
        fwrite($handle, $contents);

        // Close the file handle
        fclose($handle);

        // return the path of the $tmp_file
        return $file;
    }


    /**
     * Function to destroy temporary TLS CA Cert, Cert, and key files
     * for use with SSL ldap connections.
     * @access private
     * @param string $file
     * @return boolean
     */
    protected function _destroy_tmp_file($file) {
        // Delete temporary files
        if(! unlink($file)) {
            log_message("error", "Error destroying temporary file: " . $file);
            show_error("Error destroying temporary files", 500, $heading = "An Error Was Encountered");
            return FALSE;
        }

        return TRUE;
    }
}