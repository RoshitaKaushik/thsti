import axios from 'axios';
import { encryptData, decryptData } from '../utils/crypto';

const api = axios.create({
    baseURL: import.meta.env.VITE_API_BASE_URL || 'http://localhost:5001/api',
    headers: {
        'Content-Type': 'application/json',
    },
});

// Request interceptor
api.interceptors.request.use(
    (config) => {
        // If there is a POST/PUT body (data), encrypt it securely before sending
        if (config.data && Object.keys(config.data).length > 0) {
            const encryptedStr = encryptData(config.data);
            // The backend requires the body to be wrapped in a simple JSON structure
            config.data = { data: encryptedStr };
        }
        return config;
    },
    (error) => Promise.reject(error)
);

// Response interceptor
api.interceptors.response.use(
    (response) => {
        // The server returns { status, message, data: "encrypted_aes_string" }
        // We only decrypt the 'data' property if it's an encrypted string
        if (response.data && response.data.data && typeof response.data.data === 'string') {
            const decryptedObj = decryptData(response.data.data);
            if (decryptedObj !== null) {
                // Swap the encrypted string for the readable JSON object
                response.data.data = decryptedObj;
            }
        }
        return response;
    },
    (error) => {
        console.error('API Error:', error.response?.status, error.message);
        return Promise.reject(error);
    }
);

class CallApiService {
    static async get(url, params = {}) {
        const response = await api.get(url, { params });
        return response.data?.data;
    }

    static async post(url, data = {}) {
        const response = await api.post(url, data);
        return response.data?.data;
    }

    static async put(url, data = {}) {
        const response = await api.put(url, data);
        return response.data?.data;
    }

    static async delete(url) {
        const response = await api.delete(url);
        return response.data?.data;
    }
}

export default CallApiService;
