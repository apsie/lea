<?php
/**
 * Stylite: Group administration
 *
 * @link www.stylite.de
 * @author rb(at)stylite.de
 * @copyright (c) 2014 by rb(at)stylite.de
 * @package stylite
 * @subpackage setup
 * @version $Id: default_records.inc.php 3102 2014-06-16 20:55:55Z ralfbecker $
 */

// give Admins group rights for groups app
$admingroup = $GLOBALS['egw_setup']->add_account('Admins','Admin','Group',False,False);
$GLOBALS['egw_setup']->add_acl('groups','run',$admingroup);
