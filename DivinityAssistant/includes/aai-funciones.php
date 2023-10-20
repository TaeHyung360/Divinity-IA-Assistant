<?php
/*
    Añade un nuevo menú al Panel de Control de Administrador
*/

add_action('admin_menu', 'aai_Add_My_Admin_Link');
add_action('admin_init', 'aai_register_settings');

// Registra la configuración de la opción
function aai_register_settings() {
    register_setting('aai_settings_group', 'mfp_clave');
}

// Agregar un nuevo enlace de menú de nivel superior
function aai_Add_My_Admin_Link() {
    add_menu_page(
        'Divinity IA Assistant', // Titulo de la pagina
        'Divinity IA Assistant', // Texto para mostrar en el enlace del menu
        'manage_options', // Requisito de capacidad para ver el enlace.
        'aai_admin_page_slug', // Una babosa única para la página de administracion
        'aai_admin_page' //  Función de devolución de llamada para mostrar el contenido de la página.
    );
}

// Función para generar el contenido de la página.
function mfp_admin_page() {
    include(plugin_dir_path(__FILE__) . 'mfp-first-acp-page.php');
}

// Al inicio del archivo, añade:
//require_once plugin_dir_path(__FILE__) . 'mfp-shortcode-chat.php';

// Include mfp-chatgpt.php for functions related to GPT-4 communication
//require_once plugin_dir_path(__FILE__) . 'mfp-chatgpt-ia.php';
?>
