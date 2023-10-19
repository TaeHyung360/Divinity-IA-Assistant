<?php
/*
* Add my new menu to the Admin Control Panel
*/

// Hook the 'admin_menu' action hook, run the function named 'mfp_Add_My_Admin_Link()'
add_action('admin_menu', 'mfp_Add_My_Admin_Link');
add_action('admin_init', 'mfp_register_settings');

// Register setting for our option
function mfp_register_settings() {
    register_setting('mfp_settings_group', 'mfp_clave');
}

// Add a new top level menu link to the ACP
function mfp_Add_My_Admin_Link() {
    add_menu_page(
        'Divinity IA Assistant', // Title of the page
        'Divinity IA Assistant', // Text to show on the menu link
        'manage_options', // Capability requirement to see the link
        'mfp_admin_page_slug', // A unique slug for the admin page
        'mfp_admin_page' // Callback function to display the page content
    );
}

// Function to generate the page content
function mfp_admin_page() {
    // Include the content from your mfp-first-acp-page.php file
    include(plugin_dir_path(__FILE__) . 'mfp-first-acp-page.php');
}

// Al inicio del archivo, añade:
require_once plugin_dir_path(__FILE__) . 'mfp-chat-shortcode.php';

// Include mfp-chatgpt.php for functions related to GPT-4 communication
require_once plugin_dir_path(__FILE__) . 'mfp-chatgpt.php';
?>
