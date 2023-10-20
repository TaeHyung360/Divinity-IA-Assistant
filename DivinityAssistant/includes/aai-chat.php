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
        
        <div id="mi-chat-input-container">
            <textarea id="chat-input" placeholder="Escribe tu mensaje..."></textarea>
            <button id="chat-enviar">Enviar</button>
        </div>
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
            width: 100%;
            display: flex;
            flex-direction: column; /* Para asegurarse de que los elementos hijos se apilen verticalmente */
        }

        #chat-mensajes {
            max-height: 200px;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }

        /* El contenedor para el textarea y el botón */
        #mi-chat-input-container {
            display: flex; /* Habilitar flexbox */
            width: 100%;
        }

        #chat-input {
            flex-grow: 1; /* Hace que el textarea ocupe todo el espacio disponible */
            padding: 5px;
            margin-right: 10px; /* Espacio entre el textarea y el botón */
        }

        #chat-enviar {
            padding: 5px;
        }
    </style>
    <?php
    return ob_get_clean();
}

?>