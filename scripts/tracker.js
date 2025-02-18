async function sendVisitorData() {
    const url = window.location.href;

    const response = await fetch('http://localhost:8080/sendVisitorData.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ url })
    });

    const data = await response.json();
    
}

sendVisitorData();
