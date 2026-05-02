import fs from 'fs';
import { decryptData } from '../src/shared/utils/crypto.js';

const encryptedJson = fs.readFileSync('scratch/encrypted.json', 'utf8');
const obj = JSON.parse(encryptedJson);
const decrypted = decryptData(obj.data);
fs.writeFileSync('scratch/decrypted.json', JSON.stringify(decrypted, null, 2));
console.log('Decrypted to scratch/decrypted.json');
