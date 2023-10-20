<?php

// Registra el shortcode DivinityAssistant
add_shortcode('DivinityAssistant', 'renderizar_mi_chat');

function renderizar_mi_chat() {
    ob_start();
    ?>
    <div id="mi-chat-container">
        <div id="chat-mensajes">
            <!-- Aquí se mostrarán los mensajes -->
        </div>
        
        <textarea id="chat-input" placeholder="Escribe tu mensaje..."></textarea>
        <button id="chat-enviar">Enviar</button>
    </div>
    
    <script>
        document.getElementById('chat-enviar').addEventListener('click', function() {
            let mensaje = document.getElementById('chat-input').value;
            document.getElementById('chat-mensajes').innerHTML += '<p>' + mensaje + '</p>';
            document.getElementById('chat-input').value = '';
        });
    </script>

    <style>
        #mi-chat-container {
            border: 1px solid #ddd;
            padding: 10px;
            width: 300px;
        }

        #chat-mensajes {
            max-height: 200px;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ccc;
        }

        #chat-input {
            width: 100%;
            padding: 5px;
        }

        #chat-enviar {
            width: 100%;
            padding: 5px;
            margin-top: 10px;
        }
    </style>
    <?php
    return ob_get_clean();
}

?>