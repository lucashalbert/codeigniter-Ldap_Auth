<?php

defined("BASEPATH") OR exit("No direct script access allowed");

/**
 * CodeIgniter Ldap_Auth
 * 
 * Configuration file used to drive the Ldap_Auth library
 *
 * @package         Ldap_Auth
 * @subpackage      Auth configuration
 * @author          Lucas Halbert <lhalbert@lhalbert.xyz>
 * @version         0.0.1
 * @link            https://github.com/lucashalbert/codeigniter-Ldap_Auth
 * @license         BSD 3-Clause "New" or "Revised" License
 * @copyright       Copyright © 2019 by Lucas Halbert <lhalbert@lhalbert.xyz>
 */

$config["customerA"]["servers"] = array("ldap://dir01.domain.tld:389", "ldap://dir02.domain.tld:389");
$config["customerA"]["tls_required"] = FALSE;
$config["customerA"]["base_dn"] = "dc=domain,dc=tld";
//$config["customerA"]["user_attribute"] = "uid";
$config["customerA"]["user_attribute"] = "samaccountname";
$config["customerA"]["bind_user_dn"] = "DOMAIN\service_account";
$config["customerA"]["bind_user_pw"] = "password";
$config["customerA"]["member_attribute"] = "memberUid";