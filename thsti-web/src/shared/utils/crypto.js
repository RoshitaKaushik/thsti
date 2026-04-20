import CryptoJS from 'crypto-js';

// Convert the basic password into a strict 32-byte key using SHA-256
const RAW_SECRET = import.meta.env.VITE_ENCRYPTION_KEY || '@Thsti#SecureKey_2026!';
const KEY = CryptoJS.SHA256(RAW_SECRET);

export const encryptData = (data) => {
    if (!data) return null;
    try {
        const stringifiedData = JSON.stringify(data);
        // Generate a random 16-byte IV
        const iv = CryptoJS.lib.WordArray.random(16);
        
        // Encrypt using AES-CBC
        const encrypted = CryptoJS.AES.encrypt(stringifiedData, KEY, {
            iv: iv,
            mode: CryptoJS.mode.CBC,
            padding: CryptoJS.pad.Pkcs7
        });
        
        // Combine IV + Ciphertext so the server can extract the IV easily
        const combined = iv.concat(encrypted.ciphertext);
        return CryptoJS.enc.Base64.stringify(combined);
    } catch (err) {
        console.error('Encryption failed:', err);
        return null;
    }
};

export const decryptData = (base64String) => {
    if (!base64String) return null;
    try {
        const combinedRaw = CryptoJS.enc.Base64.parse(base64String);
        
        // Extract the original 16-byte IV from the front
        const iv = CryptoJS.lib.WordArray.create(combinedRaw.words.slice(0, 4));
        
        // Extract the remaining bytes as Ciphertext
        const ciphertext = CryptoJS.lib.WordArray.create(combinedRaw.words.slice(4));
        const cipherParams = CryptoJS.lib.CipherParams.create({ ciphertext });
        
        // Decrypt
        const decryptedWords = CryptoJS.AES.decrypt(cipherParams, KEY, {
            iv: iv,
            mode: CryptoJS.mode.CBC,
            padding: CryptoJS.pad.Pkcs7
        });
        
        const originalText = decryptedWords.toString(CryptoJS.enc.Utf8);
        return JSON.parse(originalText);
    } catch (err) {
        console.error('Decryption failed:', err);
        return null;
    }
};
