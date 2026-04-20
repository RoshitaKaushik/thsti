import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import api from '../api/axios';
import AdminPageLayout from '../components/AdminPageLayout';
import { Users, GraduationCap, FileText, Newspaper, ArrowRight } from 'lucide-react';

export default function Dashboard() {
    const userStr = localStorage.getItem('thsti_admin_user');
    const user = userStr ? JSON.parse(userStr) : null;
    const [summary, setSummary] = useState({ users: '--', faculty: '--', pages: '--', news: '--' });

    useEffect(() => {
        api.get('/dashboard/summary')
            .then(res => setSummary(res.data))
            .catch(err => console.error('Failed to load dashboard summary', err));
    }, []);

    const statCards = [
        { title: 'Total Users', value: summary.users, icon: <Users size={24} className="text-blue-600" />, bg: 'bg-blue-50', border: 'border-blue-100', link: '/dashboard/users' },
        { title: 'Faculty Members', value: summary.faculty, icon: <GraduationCap size={24} className="text-emerald-600" />, bg: 'bg-emerald-50', border: 'border-emerald-100', link: '/dashboard/faculty' },
        { title: 'Total Pages', value: summary.pages, icon: <FileText size={24} className="text-amber-600" />, bg: 'bg-amber-50', border: 'border-amber-100', link: '/dashboard/pages' },
        { title: 'News & Events', value: summary.news, icon: <Newspaper size={24} className="text-purple-600" />, bg: 'bg-purple-50', border: 'border-purple-100', link: '/dashboard/news' },
    ];

    return (
        <AdminPageLayout title="Dashboard" subtitle="System Overview">
            <div className="flex flex-col space-y-6">
                
                {/* Premium Welcome Card */}
                <div className="relative overflow-hidden rounded-xl shadow-md border border-white/20 bg-gradient-to-br from-rose-900 via-stone-800 to-rose-950 text-white p-5 group">
                    
                    {/* Dynamic Background Elements */}
                    <div className="absolute top-0 right-0 w-64 h-64 bg-rose-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 group-hover:opacity-20 transition-opacity duration-700 animate-pulse"></div>
                    <div className="absolute -bottom-20 -left-20 w-80 h-80 bg-orange-600 rounded-full mix-blend-multiply filter blur-3xl opacity-10 group-hover:opacity-20 transition-opacity duration-700 animate-pulse" style={{ animationDelay: '2s' }}></div>
                    
                    {/* Glassmorphic overlay grid overlay */}
                    <div className="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdib3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0zNiAzNHYtbDItMiB2LTJsLTIgLTJoLTJ2MmgtdjIteiIgZmlsbD0iI2ZmZiIgZmlsbC1vcGFjaXR5PSIwLjA1Ii8+PC9nPjwvc3ZnPg==')] opacity-[0.03]"></div>
                    
                    {/* Watermark Icon */}
                    <div className="absolute -right-4 -bottom-10 opacity-[0.02] pointer-events-none transform group-hover:scale-105 group-hover:-rotate-3 transition-transform duration-700">
                        <Users size={180} strokeWidth={1} />
                    </div>

                    <div className="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div className="flex items-center gap-4">
                            <div className="hidden sm:flex relative">
                                <div className="absolute inset-0 bg-rose-400 rounded-full blur opacity-40 group-hover:opacity-60 transition-opacity"></div>
                                <div className="w-12 h-12 rounded-full bg-gradient-to-tr from-rose-600 to-orange-400 border border-white/20 shadow-lg flex items-center justify-center relative z-10 text-white font-semibold text-lg">
                                    {user?.name ? user.name.charAt(0).toUpperCase() : 'A'}
                                </div>
                            </div>
                            <div>
                                <h2 className="text-xl font-semibold mb-1 tracking-tight text-white">
                                    Welcome back, {user?.name || 'Administrator'}!
                                </h2>
                                <div className="flex items-center gap-3">
                                    <p className="text-rose-100/90 text-sm flex items-center gap-2">
                                        <span className="w-1.5 h-1.5 rounded-full bg-rose-400"></span>
                                        {user?.email || 'admin@thsti.res.in'}
                                    </p>
                                    <span className="w-1 h-1 rounded-full bg-white/20"></span>
                                    <div className="flex items-center gap-1.5 px-2 py-0.5 bg-white/10 backdrop-blur-md rounded border border-white/10 shadow-sm">
                                        <span className="text-[10px] font-semibold text-rose-100 uppercase tracking-wider">Role:</span>
                                        <span className="text-[10px] font-bold text-white bg-rose-500/40 px-1 rounded uppercase">{user?.role || 'VIEWER'}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* Status Indicator */}
                        <div className="relative group/status cursor-default mt-2 md:mt-0">
                            <div className="absolute inset-0 bg-emerald-400/20 rounded-lg blur-sm opacity-0 group-hover/status:opacity-100 transition-opacity duration-500"></div>
                            <div className="relative bg-black/20 backdrop-blur-xl px-4 py-2 rounded-lg flex items-center gap-2 border border-white/10 hover:border-emerald-500/30 transition-colors shadow-sm">
                                <span className="relative flex h-2 w-2">
                                    <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span className="relative inline-flex rounded-full h-2 w-2 bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.8)]"></span>
                                </span>
                                <span className="text-[11px] font-bold tracking-widest text-emerald-100">SYSTEM ONLINE</span>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Stat Cards */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    {statCards.map((stat, idx) => (
                        <div key={idx} className="bg-white rounded border border-gray-200 shadow-sm overflow-hidden flex flex-col transition-shadow hover:shadow-md">
                            <div className="p-5 flex-1">
                                <div className="flex items-center justify-between mb-4">
                                    <div className={`p-3 rounded-lg ${stat.bg} ${stat.border} border`}>
                                        {stat.icon}
                                    </div>
                                    <h3 className="text-3xl font-bold text-gray-800">{stat.value}</h3>
                                </div>
                                <h4 className="text-gray-500 font-medium text-sm">{stat.title}</h4>
                            </div>
                            <Link 
                                to={stat.link} 
                                className="bg-gray-50 py-2.5 px-5 text-sm text-secondary font-medium flex items-center justify-between hover:bg-gray-100 transition-colors border-t border-gray-100"
                            >
                                View Details <ArrowRight size={16} />
                            </Link>
                        </div>
                    ))}
                </div>

                {/* Quick Actions Panel */}
                <div className="bg-white border border-gray-200 rounded shadow-sm p-6">
                    <h3 className="text-lg font-semibold text-secondary mb-4 border-b border-gray-100 pb-2">Quick Actions</h3>
                    <div className="flex flex-wrap gap-3">
                        <Link to="/dashboard/news" className="px-4 py-2 bg-gray-50 border border-gray-200 rounded text-sm font-medium text-gray-700 hover:bg-white hover:border-secondary hover:text-secondary transition-all">
                            Post News/Event
                        </Link>
                        <Link to="/dashboard/pages" className="px-4 py-2 bg-gray-50 border border-gray-200 rounded text-sm font-medium text-gray-700 hover:bg-white hover:border-secondary hover:text-secondary transition-all">
                            Create New Page
                        </Link>
                        <Link to="/dashboard/media" className="px-4 py-2 bg-gray-50 border border-gray-200 rounded text-sm font-medium text-gray-700 hover:bg-white hover:border-secondary hover:text-secondary transition-all">
                            Upload Media
                        </Link>
                        <Link to="/dashboard/settings" className="px-4 py-2 bg-gray-50 border border-gray-200 rounded text-sm font-medium text-gray-700 hover:bg-white hover:border-secondary hover:text-secondary transition-all">
                            System Settings
                        </Link>
                    </div>
                </div>

            </div>
        </AdminPageLayout>
    );
}
