<?php
/**
 * Shortcode y funciones relacionadas para el chat de Divinity IA Assistant.
*/

// Registro del shortcode
function mfp_chat_shortcode() {
    wp_enqueue_script('jquery'); // Asegúrate de que jQuery esté incluido

    ob_start();
    ?>
    <div id="mfp_chat_box">
        <div id="mfp_chat_messages">
            <!-- Aquí se mostrarán los mensajes del chat -->
        </div>
        <textarea id="mfp_user_input" placeholder="Escribe tu mensaje..."></textarea>
        <button id="mfp_send_btn">Enviar</button>
    </div>
    <script>
    jQuery(document).ready(function($) {
        $('#mfp_send_btn').on('click', function() {
            let user_input = $('#mfp_user_input').val();

            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'mfp_get_gpt4_response',
                    user_input: user_input
                },
                success: function(response) {
                    $('#mfp_chat_messages').append('<div>User: ' + user_input + '</div>');
                    $('#mfp_chat_messages').append('<div>GPT-4: ' + response + '</div>');
                    $('#mfp_user_input').val('');
                }
            });
        });
    });
    </script>
    <style>
    /* Aquí puedes añadir estilos para tu chat. Por ejemplo: */
    #mfp_chat_box {
        border: 1px solid #ddd;
        padding: 20px;
        width: 300px;
    }
    #mfp_chat_messages {
        max-height: 200px;
        overflow-y: scroll;
        margin-bottom: 20px;
    }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode('divinity_chat', 'mfp_chat_shortcode');

// Función AJAX para obtener respuesta de GPT-4
function mfp_get_gpt4_response() {
    $user_input = sanitize_text_field($_POST['user_input']);
    $response = mfp_query_gpt4($user_input);
    echo $response;
    wp_die();
}
add_action('wp_ajax_mfp_get_gpt4_response', 'mfp_get_gpt4_response');
add_action('wp_ajax_nopriv_mfp_get_gpt4_response', 'mfp_get_gpt4_response');
