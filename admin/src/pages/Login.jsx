import { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import api from '../api/axios';

export default function Login() {
    const navigate = useNavigate();
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [error, setError] = useState('');

    const handleLogin = async (e) => {
        e.preventDefault();
        setError('');
        try {
            const res = await api.post('/auth/login', { email, password });
            localStorage.setItem('thsti_admin_token', res.data.accessToken);
            localStorage.setItem('thsti_admin_refresh', res.data.refreshToken);
            localStorage.setItem('thsti_admin_user', JSON.stringify(res.data.user));
            navigate('/dashboard');
        } catch (err) {
            const msg = err.response?.data?.message || 'Invalid email or password';
            setError(msg);
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
