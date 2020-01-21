<?php
defined('ABSPATH') or die('No script kiddies please!');
/*
Plugin Name: IFRS Portal Documentos
Plugin URI:  https://github.com/IFRS/portal-plugin-documentos
Description: Plugin para gerenciar Documentos.
Version:     1.1.1
Author:      Ricardo Moro
Author URI:  https://github.com/ricardomoro
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
Text Domain: ifrs-portal-plugin-documentos
Domain Path: /lang
*/

require_once('documento-type.php');
require_once('documento-origin.php');
require_once('documento.php');
require_once('queries.php');
require_once('roles.php');
require_once('widgets/latest.php');

register_activation_hook(__FILE__, function () {
    flush_rewrite_rules();
    ifrs_portal_documentos_addRoles();
});

register_deactivation_hook(__FILE__, function () {
    flush_rewrite_rules();
    ifrs_portal_documentos_removeRoles();
});
