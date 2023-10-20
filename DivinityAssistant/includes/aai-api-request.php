<script src="https://cdn.jsdelivr.net/npm/openai@4.12.4/index.min.js"></script>

<script>
    function getGPT3Response(prompt, callback) {
        console.log(prompt)
        fetch("http://localhost/wordpress/wp-content/plugins/DivinityAssistant/includes/aai-peticiones-openai.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                prompt: prompt
            })
        })
        .then(response =>{
            console.log(response)
            return response.json()
        } )
        .then(data => {
            console.log("Entro 2")
            callback(data.response);
        })
        .catch(error => {
            console.error("Error:", error);
        });
    }
</script>



