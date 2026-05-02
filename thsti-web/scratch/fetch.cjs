const https = require('https');
const fs = require('fs');

https.get('https://demo.1akal.in/thsti/design9/research-details.html', (res) => {
    let data = '';
    res.on('data', (chunk) => data += chunk);
    res.on('end', () => {
        fs.writeFileSync('scratch/live_template.html', data);
        console.log('Fetched successfully, length:', data.length);
    });
}).on('error', (err) => console.log('Error:', err.message));
