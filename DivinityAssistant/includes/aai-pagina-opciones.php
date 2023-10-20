
<?php

// Verificar si se ha enviado el formulario.
if (isset($_POST['aai_guardar'])) {
    // Guardar la clave en las opciones de WordPress.
    update_option('aai_clave', sanitize_text_field($_POST['aai_clave']));
    update_option('aai_negocio', sanitize_text_field($_POST['aai_negocio']));
}

// Recuperar la clave de las opciones de WordPress.
$clave_guardada = get_option('aai_clave', '');

$nombre_guardado = get_option('aai_negocio', '');

?>

<div class="wrap">
    <h1>Divinity IA Assistant</h1>
    <p>Bienvenido al administrador de Divinity IA Assistant, en esta pantalla puedes modificar todos los parámetros necesarios.</p>
    
    <form method="post">
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Introduce el nombre del negocio</th>
                <td><input type="text" name="aai_negocio" value="<?php echo esc_attr($nombre_guardado); ?>" /></td>
                <th scope="row">Introduce la api key de openai</th>
                <td><input type="text" name="aai_clave" value="<?php echo esc_attr($clave_guardada); ?>" /></td>
            </tr>
        </table>
        <?php submit_button('Guardar', 'primary', 'aai_guardar'); ?>
        
    </form>
</div>
