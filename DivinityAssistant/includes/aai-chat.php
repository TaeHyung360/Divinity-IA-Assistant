<?php

// Registra el shortcode DivinityAssistant
add_shortcode('DivinityAssistant', 'renderizar_mi_chat');


function renderizar_mi_chat() {
ob_start();

    $nombre_guardado = get_option('aai_negocio', '');
    ?>
    <div id="mi-chat-container">
        <div id="chat-mensajes">
            <!-- Aquí se mostrarán los mensajes -->
            <p>Hola, somos: <?php echo esc_html($nombre_guardado); ?> </p>
        </div>
        
        <div id="mi-chat-input-container">
            <textarea id="chat-input" placeholder="Escribe tu mensaje..."></textarea>
            <button id="chat-enviar">Enviar</button>
        </div>
    </div>
    
    <script>
        /*
        document.getElementById('chat-enviar').addEventListener('click', function() {
            let mensaje = document.getElementById('chat-input').value;
            document.getElementById('chat-mensajes').innerHTML += '<p>' + mensaje + '</p>';
            document.getElementById('chat-input').value = '';
        });
        */

        document.getElementById('chat-enviar').addEventListener('click', function() {
            let mensaje = document.getElementById('chat-input').value;
            document.getElementById('chat-mensajes').innerHTML += '<p>Tú: ' + mensaje + '</p>';

            getGPT3Response(mensaje, function(respuesta) {
                document.getElementById('chat-mensajes').innerHTML += '<p>GPT-3: ' + respuesta + '</p>';
            });
            
            document.getElementById('chat-input').value = '';
        });
    </script>

    <style>
        #mi-chat-container {
            border: 1px solid #ddd;
            padding: 10px;
            width: 100%;
            display: flex;
            flex-direction: column; 
        }

        #chat-mensajes {
            max-height: 200px;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            background-color: #D3D3D3;
        }

        /* El contenedor para el textarea y el botón */
        #mi-chat-input-container {
            display: flex; 
            width: 100%;
        }

        #chat-input {
            flex-grow: 1; 
            padding: 5px;
            margin-right: 10px; 
        }

        #chat-enviar {
            padding: 5px;
        }
    </style>
    <?php
    return ob_get_clean();
}

?>