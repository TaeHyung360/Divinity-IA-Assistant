<?php

// Registro un nuevo shortcode llamado 'DivinityAssistant' en WordPress.
// Cuando se agregue [DivinityAssistant] en una entrada o página, se ejecutará la función renderizar_mi_chat.
add_shortcode('DivinityAssistant', 'renderizar_mi_chat');

/**
 * Función para renderizar el chat en la página.
 * Captura todo el contenido HTML generado y devolverlo.
 * Ofrece control sobre el contenido generado, previene errores comunes.
 */
function renderizar_mi_chat() {
    // Inicio de la captura de todo el HTML generado.
    ob_start();

    // Obtengo el nombre del negocio guardado en las opciones de WordPress.
    $nombre_guardado = get_option('aai_negocio', '');
    ?>
    
    <!-- Estructura HTML del chat -->
    <div id="mi-chat-container">
        <div id="chat-mensajes">
            <!-- Mensaje inicial con el nombre del negocio -->
            <p>Hola, somos: <?php echo esc_html($nombre_guardado); ?> </p>
        </div>
        
        <div id="mi-chat-input-container">
            <!-- Área para escribir el mensaje -->
            <textarea id="chat-input" placeholder="Escribe tu mensaje..."></textarea>
            <!-- Botón para enviar el mensaje -->
            <button id="chat-enviar">Enviar</button>
        </div>
    </div>
    
    <script>
        // Agrego un addEventListener(), manejador de eventos para el clic en el botón de enviar.
        document.getElementById('chat-enviar').addEventListener('click', function() {
            // Obtengo el mensaje que ha introducido el usuario.
            let mensaje = document.getElementById('chat-input').value;
            // Añado el mensaje del usuario al área de mensajes.
            document.getElementById('chat-mensajes').innerHTML += '<p>Tú: ' + mensaje + '</p>';
            
            // Envío el mensaje a la función getGPT3Response para obtener una respuesta.
            getGPT3Response(mensaje, function(respuesta) {
                // Añado la respuesta de GPT-3 al área de mensajes.
                document.getElementById('chat-mensajes').innerHTML += '<p>GPT-3: ' + respuesta + '</p>';
            });
            
            // Limpio el área de entrada para el próximo mensaje.
            document.getElementById('chat-input').value = '';
        });
    </script>

    <!-- Estilos para el chat -->
    <style>
        #mi-chat-container {
            border: 1px solid #ddd;
            padding: 10px;
            width: 100%;
            display: flex;
            flex-direction: column; 
        }

        #chat-mensajes {
            height: 20rem;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            background-color: #D3D3D3;
        }

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
    // Devuelvo todo el contenido HTML generado.
    return ob_get_clean();
}
?>
