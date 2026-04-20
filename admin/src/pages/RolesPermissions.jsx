import React, { useState, useEffect } from 'react';
import { ShieldAlert, Save, RefreshCw } from 'lucide-react';
import { toast } from 'react-hot-toast';
import api from '../api/axios';

const SYSTEM_ROLES = ["ADMIN", "EXECUTIVE", "MANAGER", "EDITOR"];

export default function RolesPermissions() {
    const [modules, setModules] = useState([]);
    const [loading, setLoading] = useState(true);
    const [savingId, setSavingId] = useState(null);

    const fetchModules = async () => {
        setLoading(true);
        try {
            const res = await api.get('/admin-sidebar/all-modules');
            setModules(res.data || []);
        } catch (error) {
            toast.error("Failed to load modules");
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchModules();
    }, []);

    const handleRoleToggle = (moduleId, roleStr) => {
        setModules(prev => prev.map(mod => {
            if (mod.id !== moduleId) return mod;
            
            let roles = mod.allowedRoles ? mod.allowedRoles.split(',').map(r => r.trim()).filter(Boolean) : [];
            if (roles.includes(roleStr)) {
                roles = roles.filter(r => r !== roleStr);
            } else {
                roles.push(roleStr);
            }
            
            return { ...mod, allowedRoles: roles.join(',') };
        }));
    };

    const handleSave = async (mod) => {
        setSavingId(mod.id);
        try {
            await api.put(`/admin-sidebar/${mod.id}`, {
                allowedRoles: mod.allowedRoles,
                isActive: mod.isActive
            });
            toast.success(`${mod.name} permissions saved!`);
        } catch (error) {
            toast.error("Failed to save changes");
        } finally {
            setSavingId(null);
        }
    };

    return (
        <div className="space-y-6 max-w-6xl mx-auto">
            <div className="flex justify-between items-center mb-8">
                <div>
                    <h1 className="text-3xl font-bold text-gray-900 tracking-tight flex items-center gap-3">
                        <ShieldAlert className="text-primary" size={32} />
                        Roles & Permissions
                    </h1>
                    <p className="mt-2 text-gray-500 text-sm">
                        Configure which user roles have access to each module in the sidebar. Use "ADMIN" to restrict to top-level administrators.
                    </p>
                </div>
                <button
                    onClick={fetchModules}
                    className="flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors font-medium text-sm"
                >
                    <RefreshCw size={16} /> Refresh
                </button>
            </div>

            {loading ? (
                <div className="flex items-center justify-center h-48">
                    <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
                </div>
            ) : (
                <div className="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <table className="w-full text-left text-sm text-gray-700">
                        <thead className="bg-gray-50 text-gray-900 font-semibold border-b border-gray-200">
                            <tr>
                                <th className="px-6 py-4">Module Name</th>
                                <th className="px-6 py-4">Parent Group</th>
                                <th className="px-6 py-4">Allowed Roles</th>
                                <th className="px-6 py-4 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody className="divide-y divide-gray-100">
                            {modules.map((mod) => (
                                <tr key={mod.id} className="hover:bg-gray-50/50 transition-colors">
                                    <td className="px-6 py-4 font-medium text-gray-900 flex items-center gap-2">
                                        {mod.name}
                                    </td>
                                    <td className="px-6 py-4 text-gray-500">
                                        {mod.parentName ? <span className="px-2 py-1 bg-gray-100 rounded text-xs">{mod.parentName}</span> : '-'}
                                    </td>
                                    <td className="px-6 py-4 space-y-2">
                                        <div className="flex flex-wrap gap-3">
                                            {SYSTEM_ROLES.map(role => {
                                                const hasRole = (mod.allowedRoles || "").split(',').map(r=>r.trim()).includes(role);
                                                return (
                                                    <label key={role} className="flex items-center gap-2 cursor-pointer text-xs">
                                                        <input 
                                                            type="checkbox" 
                                                            className="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary focus:ring-2"
                                                            checked={hasRole}
                                                            onChange={() => handleRoleToggle(mod.id, role)}
                                                        />
                                                        {role}
                                                    </label>
                                                )
                                            })}
                                        </div>
                                    </td>
                                    <td className="px-6 py-4 text-right">
                                        <button
                                            onClick={() => handleSave(mod)}
                                            disabled={savingId === mod.id}
                                            className="inline-flex items-center gap-2 px-3 py-1.5 bg-primary/10 text-primary hover:bg-primary/20 rounded-md transition-colors text-sm font-medium disabled:opacity-50"
                                        >
                                            {savingId === mod.id ? <RefreshCw className="animate-spin" size={14} /> : <Save size={14} />}
                                            Save
                                        </button>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            )}
        </div>
    );
}
