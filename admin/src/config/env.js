export const API_BASE_URL = import.meta.env.VITE_API_BASE_URL || 'http://localhost:5001/api';
export const ASSETS_BASE_URL = import.meta.env.VITE_ASSETS_BASE_URL || API_BASE_URL.replace('/api', '');
export const PUBLIC_SITE_URL = import.meta.env.VITE_PUBLIC_SITE_URL || 'http://localhost:5173';
