<?php
/*
    Añado un nuevo menú al Panel de Control de Administrador
*/

add_action('admin_menu', 'aai_Add_My_Admin_Link');
add_action('admin_init', 'aai_register_settings');

// Registro la configuración de la opción
function aai_register_settings() {
    register_setting('aai_settings_group', 'mfp_clave');
}

// Agrego un nuevo enlace de menú de nivel superior
function aai_Add_My_Admin_Link() {
    add_menu_page(
        'Divinity IA Assistant', // Titulo de la pagina
        'Divinity IA Assistant', // Texto para mostrar en el enlace del menu
        'manage_options', // Requisito de capacidad para ver el enlace.
        'aai_admin_page_slug', 
        'aai_admin_page' //  Función de devolución de llamada para mostrar el contenido de la página.
    );
}

// Función para generar el contenido de la página.
function aai_admin_page() {
    include(plugin_dir_path(__FILE__) . 'aai-pagina-opciones.php');
}

// Al inicio del archivo, añade:
require_once plugin_dir_path(__FILE__) . 'aai-chat.php';

require_once plugin_dir_path(__FILE__) . 'aai-peticiones-openai.php';

require_once plugin_dir_path(__FILE__) . 'aai-api-request.php';
?>
