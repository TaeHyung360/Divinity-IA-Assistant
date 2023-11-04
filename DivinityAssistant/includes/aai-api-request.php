<!-- Incorporo la biblioteca de OpenAI desde un CDN para tener acceso a sus funcionalidades -->
<script src="https://cdn.jsdelivr.net/npm/openai@4.12.4/index.min.js"></script>

<script>
    /**
     * Defino una función para obtener una respuesta del modelo GPT-3 de OpenAI.
     * @param {string} prompt - Texto que el usuario envía y que se usará como entrada para GPT-3.
     * @param {Function} callback - Función que se ejecutará cuando se obtenga la respuesta de GPT-3.
     */
    function getGPT3Response(prompt, callback) {
        // Muestra el icono de carga
        document.getElementById('loading').style.display = 'block';
        document.getElementById('chat-enviar').style.display = 'none';
        // Realizo una petición HTTP de tipo POST a un script PHP alojado en mi servidor local.
        fetch("http://localhost/DivinityPCrafter/wp-content/plugins/DivinityAssistant/includes/aai-peticiones-openai.php", {
            method: "POST", // Indico que la petición es de tipo POST.
            headers: {
                "Content-Type": "application/json", // Especifico que estoy enviando datos en formato JSON.
            },
            body: JSON.stringify({
                prompt: prompt // Convierto el objeto que contiene el prompt a una cadena JSON para enviarlo.
            })
        })
        .then(response => response.json()) // Convierto la respuesta del servidor de formato JSON a un objeto JavaScript.
        .then(data => {
            // Oculta el icono de carga
            document.getElementById('loading').style.display = 'none';
            document.getElementById('chat-enviar').style.display = 'block';
            // Verifico si la respuesta incluye el campo "response".
            if (data.response) {
                // Si es así, ejecuto la función de devolución de llamada, pasándole la respuesta de GPT-3.
                callback(data.response);
            } else if (data.error) {
                // Si la respuesta incluye un campo "error", lo muestro en la consola para depurar.
                console.error("Error:", data.error);
            }
        })
        .catch(error => {
            // Oculta el icono de carga si hay error
            document.getElementById('loading').style.display = 'none';
            document.getElementById('chat-enviar').style.display = 'block';
            // Capturo cualquier error que pueda ocurrir durante la petición y lo muestro en la consola.
            console.error("Error:", error);
        });
    }
</script>
