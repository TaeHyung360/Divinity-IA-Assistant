
<?php

// Verificar si se ha enviado el formulario.
if (isset($_POST['mfp_guardar'])) {
    // Guardar la clave en las opciones de WordPress.
    update_option('mfp_clave', sanitize_text_field($_POST['mfp_clave']));
}

// Recuperar la clave de las opciones de WordPress.
$clave_guardada = get_option('mfp_clave', '');

?>

<div class="wrap">
    <h1>Divinity IA Assistant</h1>
    <p>Bienvenido al administrador de Divinity IA Assistant, en esta pantalla puedes modificar todos los parámetros necesarios.</p>
    
    <form method="post">
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Introduce la api key de openai</th>
                <td><input type="text" name="mfp_clave" value="<?php echo esc_attr($clave_guardada); ?>" /></td>
            </tr>
        </table>
        <?php submit_button('Guardar Clave', 'primary', 'mfp_guardar'); ?>
    </form>
</div>
