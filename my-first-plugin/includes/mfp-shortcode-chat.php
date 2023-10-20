<?php

function enqueue_chat_scripts() {
    // Encola el script de GPT-3
    wp_enqueue_script('chatgpt-ia', plugins_url('chatgpt-ia.js', __FILE__), array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_chat_scripts');

function chat_shortcode() {

    $apiKey = get_option('mfp_clave', '');

    ob_start();
    ?>
    <div id="chat-container">
        <div id="chat-messages"></div>
        <textarea id="chat-input"></textarea>
        <button id="send-message">Enviar</button>
    </div>

    <script>
        document.getElementById('send-message').addEventListener('click', function() {
            var input = document.getElementById('chat-input');
            var messages = document.getElementById('chat-messages');

            var messageDiv = document.createElement('div');
            messageDiv.textContent = input.value;
            messages.appendChild(messageDiv);

            // Usar la función definida en chatgpt-ia.php
            getGPT3Response(input.value, function(response) {
                var gptMessageDiv = document.createElement('div');
                gptMessageDiv.textContent = 'GPT-3: ' + response;
                messages.appendChild(gptMessageDiv);
            });

            input.value = '';
        });
    </script>

    <style>
        #simple-chat-container {
            border: 1px solid #ccc;
            padding: 20px;
            width: 300px;
        }
        #chat-messages {
            max-height: 300px;
            overflow-y: scroll;
        }
        #chat-input {
            width: 100%;
            height: 50px;
        }
    </style>
    <?php
    return ob_get_clean();
}

add_shortcode('divinity_chat', 'chat_shortcode');
