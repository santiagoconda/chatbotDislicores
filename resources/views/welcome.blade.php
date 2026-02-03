<input id="msg" type="text" placeholder="Escribe tu mensaje...">
<button onclick="send()">Enviar</button>

<div id="chat"></div>

<script>
async function send() {
    const msg = document.getElementById('msg').value;
    
    if (!msg.trim()) return;

    try {
        const res = await fetch('/api/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ message: msg })
        });

        const data = await res.json();

        document.getElementById('chat').innerHTML += `
            <p><b>Tú:</b> ${msg}</p>
            <p><b>Bot:</b> ${data.reply}</p>
        `;
        
        document.getElementById('msg').value = '';
        
    } catch (error) {
        console.error('Error:', error);
        alert('Error al comunicarse con el bot');
    }
}
</script>