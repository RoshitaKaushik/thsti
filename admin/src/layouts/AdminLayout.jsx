import { Outlet, Navigate } from 'react-router-dom';
import Sidebar from '../components/Sidebar';

export default function AdminLayout() {
    const token = localStorage.getItem('thsti_admin_token');

    if (!token) {
        return <Navigate to="/" replace />;
    }

    return (
        <div className="flex h-screen bg-bg-light font-sans text-text-main overflow-hidden">
            <Sidebar />
            <div className="flex-1 flex flex-col min-h-0 min-w-0 overflow-hidden relative">
                <header className="bg-white w-full z-10 h-16 shrink-0 flex items-center px-8 shadow-sm justify-between border-b border-gray-200">
                    <h2 className="text-lg font-medium text-secondary">
                        THSTI CMS Platform
                    </h2>
                    
                    <div className="flex items-center gap-4 text-sm text-gray-600">
                        <div className="flex items-center gap-2">
                            <span className="hidden sm:inline-block font-medium">Administrator Profile</span>
                            <div className="w-8 h-8 rounded-full bg-gray-100 border border-gray-200 text-secondary flex items-center justify-center font-medium">
                                A
                            </div>
                        </div>
                    </div>
                </header>
                <main className="p-8 flex-1 overflow-y-auto flex flex-col relative w-full h-full min-h-0 bg-bg-light custom-scrollbar">
                    <Outlet />
                </main>
            </div>
        </div>
    );
}
