import axios from 'axios';
import { API_BASE_URL } from '../config/env';
import { encryptData, decryptData } from '../shared/utils/crypto';

const api = axios.create({
    baseURL: API_BASE_URL,
    headers: {
        'Content-Type': 'application/json'
    }
});

// Request interceptor: Automatically encrypt outgoing request bodies
api.interceptors.request.use(
    (config) => {
        if (config.data && Object.keys(config.data).length > 0) {
            const encryptedStr = encryptData(config.data);
            config.data = { data: encryptedStr };
        }
        return config;
    },
    (error) => Promise.reject(error)
);

// Response interceptor: Automatically decrypt and unwrap incoming API envelopes
api.interceptors.response.use(
    (response) => {
        // The server returns { status, message, data: "encrypted_aes_string" }
        if (response.data && response.data.data && typeof response.data.data === 'string') {
            const decryptedObj = decryptData(response.data.data);
            if (decryptedObj !== null) {
                // To maintain backwards compatibility with legacy components,
                // we strip the new envelope and return the raw mapped Array/Object natively.
                response.data = decryptedObj;
            }
        }
        return response;
    },
    (error) => {
        console.error('API Error:', error.response?.status, error.message);
        return Promise.reject(error);
    }
);

export default api;
