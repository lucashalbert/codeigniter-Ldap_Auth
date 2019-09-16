<?php

defined("BASEPATH") OR exit("No direct script access allowed");

/**
 * CodeIgniter Ldap_Auth Controller
 * 
 * A simple authentication controller for CodeIgniter that extends
 * the CI_Controller and leverages the Ldap_Auth library.
 *
 * @package         Ldap_Auth
 * @subpackage      Auth Controller
 * @author          Lucas Halbert <lhalbert@lhalbert.xyz>
 * @version         0.0.1
 * @link            https://github.com/lucashalbert/codeigniter-Ldap_Auth
 * @license         BSD 3-Clause "New" or "Revised" License
 * @copyright       Copyright © 2019 by Lucas Halbert <lhalbert@lhalbert.xyz> */

class Auth extends CI_Controller {
    
    /**
     * Constructor function
     * @access public
     */
    public function __construct() {
        // Construct parent
        parent::__construct();

        // Load url helper
        $this->load->helper("url");

        // Load form helper
        $this->load->helper("form");

        // Load form validation library
        $this->load->library("form_validation");

        // Load Ldap_Auth library
        $this->load->library("ldap_auth");
    }


    /**
     * Loads the index page when no method is specified
     * @access public
     */
    public function index() {
        // Capture original page for redirection later on
        $this->session->keep_flashdata("reference_page");
        $this->login();
    }


    /**
     * Loads the login method
     * @access public
     */
    public function login() {
        // Capture original page for redirection later on
        $this->session->keep_flashdata("reference_page");

        // Check if user already logged in
        if(! $this->ldap_auth->is_authenticated()) {
            // Create rules for validation
            $rules = $this->form_validation;
            $rules->set_rules("username", "Username", "required");
            $rules->set_rules("password", "Password", "required");

            // Perform login
            if($rules->run() && $this->ldap_auth->login($rules->set_value("username"), $rules->set_value("password"))) {
                // Check if reference_page is set
                if($this->session->flashdata("reference_page")) {
                    // Redirect to original reference page
                    redirect($this->session->flashdata["reference_page"]);
                } else {
                    // Load the login success view
                    $this->load->view("Ldap_Auth/auth_success");
                }
            } else {
                // Load the login form view
                $this->load->view("Ldap_Auth/login_form");
            }
        } else {
            // User already logged in
            $this->load->view("Ldap_Auth/logged_in");
        }
    }


    /**
     * Loads the logout method
     * @access public
     */
    public function logout() {
        $this->ldap_auth->logout();
        $this->load->view("Ldap_Auth/logout_view");
    }
}