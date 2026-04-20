import axios from 'axios';
import { API_BASE_URL } from '../config/env';
import { encryptData, decryptData } from '../utils/crypto';

const api = axios.create({
    baseURL: API_BASE_URL,
    headers: {
        'Content-Type': 'application/json'
    }
});

// Inject Bearer token and Encrypt payload on every request
api.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem('thsti_admin_token');
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        
        // Encrypt request body if there is one
        if (config.data && Object.keys(config.data).length > 0) {
            // FormData uploads should usually not be encrypted (they handle multipart natively),
            // but standard JSON payloads must be encrypted!
            if (!(config.data instanceof FormData)) {
                const encryptedStr = encryptData(config.data);
                config.data = { data: encryptedStr };
            }
        }
        return config;
    },
    (error) => Promise.reject(error)
);

// On 401, clear cached credentials and redirect to login
// Otherwise, automatically Decrypt incoming payloads!
api.interceptors.response.use(
    (response) => {
        // Automatically decrypt and unwrap the CMS traffic
        if (response.data && response.data.data && typeof response.data.data === 'string') {
            const decryptedObj = decryptData(response.data.data);
            if (decryptedObj !== null) {
                // Return payload in raw unencrypted format to keep React components functional
                response.data = decryptedObj;
            }
        }
        return response;
    },
    (error) => {
        if (error.response?.status === 401) {
            console.error('[AXIOS] 401 UNAUTHORIZED ON URL:', error.config.url);
            localStorage.removeItem('thsti_admin_token');
            localStorage.removeItem('thsti_admin_user');
            localStorage.removeItem('thsti_admin_refresh');
            // Only redirect if not already on login page
            if (window.location.pathname !== '/') {
                window.location.href = '/';
            }
        }
        return Promise.reject(error);
    }
);

export default api;
