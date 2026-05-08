import { useState, useEffect } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import api from '../api/axios';

export default function Login() {
    const navigate = useNavigate();
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [captchaToken, setCaptchaToken] = useState('');
    const [captchaQuestion, setCaptchaQuestion] = useState('');
    const [captchaAnswer, setCaptchaAnswer] = useState('');
    const [error, setError] = useState('');

    const fetchCaptcha = async () => {
        try {
            const res = await api.get('/auth/captcha');
            setCaptchaQuestion(res.data.question);
            setCaptchaToken(res.data.captchaToken);
            setCaptchaAnswer('');
        } catch (err) {
            console.error('Failed to load captcha', err);
        }
    };

    useEffect(() => {
        fetchCaptcha();
    }, []);

    const handleLogin = async (e) => {
        e.preventDefault();
        setError('');
        try {
            const res = await api.post('/auth/login', { 
                email, 
                password,
                captchaToken,
                captchaAnswer
            });
            localStorage.setItem('thsti_admin_token', res.data.accessToken);
            localStorage.setItem('thsti_admin_refresh', res.data.refreshToken);
            localStorage.setItem('thsti_admin_user', JSON.stringify(res.data.user));
            navigate('/dashboard');
        } catch (err) {
            const msg = err.response?.data?.message || 'Invalid email or password';
            setError(msg);
            fetchCaptcha(); // Refresh captcha on failure
        }
    };

    return (
        <div className="min-h-screen flex flex-col items-center justify-center bg-gray-50 font-sans">
            <div className="w-full max-w-[420px] px-4">
                <div className="text-center mb-8">
                    <h1 className="text-3xl font-bold text-secondary uppercase tracking-wider">
                        THSTI CMS
                    </h1>
                    <p className="text-gray-600 mt-2 text-sm">
                        Translational Health Science and Technology Institute<br/>
                        Content Management System
                    </p>
                </div>

                <div className="bg-white rounded border border-gray-200 shadow-sm overflow-hidden">
                    <div className="bg-secondary p-4 text-center">
                        <h2 className="text-white font-semibold flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fillRule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clipRule="evenodd" />
                            </svg>
                            Secure Login
                        </h2>
                    </div>

                    <div className="p-8">
                        {error && (
                            <div className="bg-red-50 border border-red-200 text-red-700 px-3 py-2 rounded mb-6 text-sm">
                                {error}
                            </div>
                        )}

                        <form onSubmit={handleLogin} className="space-y-5">
                            <div>
                                <label className="block text-gray-700 font-semibold mb-1 text-sm">Email Address</label>
                                <input
                                    type="email"
                                    className="admin-input"
                                    placeholder="Enter your email"
                                    value={email}
                                    onChange={(e) => setEmail(e.target.value)}
                                    required
                                />
                            </div>
                            <div>
                                <label className="block text-gray-700 font-semibold mb-1 text-sm">Password</label>
                                <input
                                    type="password"
                                    className="admin-input"
                                    placeholder="Enter your password"
                                    value={password}
                                    onChange={(e) => setPassword(e.target.value)}
                                    required
                                />
                            </div>
                            
                            <div>
                                <label className="block text-gray-700 font-semibold mb-1 text-sm">Security Question (CAPTCHA)</label>
                                <div className="flex gap-3">
                                    <div className="flex-1 bg-gray-100 border border-gray-300 rounded flex items-center justify-center font-mono font-bold text-lg text-gray-800 select-none px-4" title="Solve this math problem">
                                        {captchaQuestion || 'Loading...'}
                                    </div>
                                    <input
                                        type="number"
                                        className="admin-input flex-1"
                                        placeholder="Answer"
                                        value={captchaAnswer}
                                        onChange={(e) => setCaptchaAnswer(e.target.value)}
                                        required
                                    />
                                    <button type="button" onClick={fetchCaptcha} className="px-3 bg-gray-200 hover:bg-gray-300 rounded border border-gray-300 transition-colors" title="Reload CAPTCHA">
                                        <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fillRule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clipRule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            
                            <div className="pt-2">
                                <button type="submit" className="admin-btn-primary w-full py-2.5 text-sm uppercase tracking-wide">
                                    Sign In
                                </button>
                            </div>

                            <div className="flex justify-between items-center mt-6 text-xs text-gray-600">
                                <Link to="/forgot-username" className="hover:text-primary hover:underline">
                                    Forgot Username?
                                </Link>
                                <Link to="/forgot-password" className="hover:text-primary hover:underline">
                                    Forgot Password?
                                </Link>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div className="text-center mt-8 text-xs text-gray-500">
                    &copy; {new Date().getFullYear()} THSTI. All rights reserved.
                </div>
            </div>
        </div>
    );
}
