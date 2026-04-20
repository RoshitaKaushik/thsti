const CryptoJS = require('crypto-js');

const RAW_SECRET = '@Thsti#SecureKey_2026!';
const KEY = CryptoJS.SHA256(RAW_SECRET);

function encryptData(data) {
    const stringifiedData = JSON.stringify(data);
    const iv = CryptoJS.lib.WordArray.random(16);
    
    const encrypted = CryptoJS.AES.encrypt(stringifiedData, KEY, {
        iv: iv,
        mode: CryptoJS.mode.CBC,
        padding: CryptoJS.pad.Pkcs7
    });
    
    const combined = iv.concat(encrypted.ciphertext);
    return CryptoJS.enc.Base64.stringify(combined);
}

const encryptedStr = encryptData({ test: "Hello World" });
console.log("Encrypted:", encryptedStr);

// Now try to decrypt it ourselves first to double check logic:
function decryptData(base64String) {
    const combinedRaw = CryptoJS.enc.Base64.parse(base64String);
    const iv = CryptoJS.lib.WordArray.create(combinedRaw.words.slice(0, 4));
    const ciphertext = CryptoJS.lib.WordArray.create(combinedRaw.words.slice(4));
    const cipherParams = CryptoJS.lib.CipherParams.create({ ciphertext });
    
    const decryptedWords = CryptoJS.AES.decrypt(cipherParams, KEY, {
        iv: iv,
        mode: CryptoJS.mode.CBC,
        padding: CryptoJS.pad.Pkcs7
    });
    
    return decryptedWords.toString(CryptoJS.enc.Utf8);
}

console.log("Decrypted via JS:", decryptData(encryptedStr));

// Now call the server
const http = require('http');

const data = JSON.stringify({ data: encryptedStr });
const options = {
    hostname: 'localhost',
    port: 5001,
    path: '/api/crypto/decrypt',
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'Content-Length': data.length
    }
};

const req = http.request(options, res => {
    console.log(`STATUS: ${res.statusCode}`);
    res.on('data', d => {
        process.stdout.write("Server Reply: " + d + "\n");
    });
});

req.on('error', error => {
    console.error(error);
});

req.write(data);
req.end();
