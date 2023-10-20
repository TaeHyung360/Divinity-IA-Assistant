<script src="https://cdn.jsdelivr.net/npm/openai@4.12.4/index.min.js"></script>

<script>
    function getGPT3Response(prompt, callback) {
        fetch("aai-peticiones-openai.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                prompt: prompt
            })
        })
        .then(response => response.json())
        .then(data => {
            callback(data.response);
        })
        .catch(error => {
            console.error("Error:", error);
        });
    }
</script>