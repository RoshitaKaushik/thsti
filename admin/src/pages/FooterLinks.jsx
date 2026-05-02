import { useState, useEffect } from 'react';
import { Plus, Edit2, GripVertical, Trash2 } from 'lucide-react';
import api from '../api/axios';
import AdminPageLayout from '../components/AdminPageLayout';
import AdminModal from '../components/AdminModal';
import MediaSelector from '../components/MediaSelector';

export default function FooterLinks() {
    const [links, setLinks] = useState([]);
    const [loading, setLoading] = useState(true);
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [editingLink, setEditingLink] = useState(null);
    const [formData, setFormData] = useState({
        column: 'IMPORTANT',
        label: '',
        url: '',
        displayOrder: 0,
        isActive: true
    });

    useEffect(() => {
        fetchLinks();
    }, []);

    const fetchLinks = () => {
        setLoading(true);
        api.get('/footer-links')
            .then(res => setLinks(res.data))
            .catch(err => console.error('Failed to load footer links', err))
            .finally(() => setLoading(false));
    };

    const handleOpenNew = () => {
        setEditingLink(null);
        setFormData({ column: 'IMPORTANT', label: '', url: '', displayOrder: links.length + 1, isActive: true });
        setIsModalOpen(true);
    };

    const handleOpenEdit = (link) => {
        setEditingLink(link);
        setFormData({ column: link.column, label: link.label, url: link.url, displayOrder: link.displayOrder, isActive: link.isActive });
        setIsModalOpen(true);
    };

    const handleChange = (e) => {
        const { name, value, type, checked } = e.target;
        if (name === 'displayOrder') {
            setFormData(prev => ({ ...prev, [name]: parseInt(value) || 0 }));
        } else {
            setFormData(prev => ({ ...prev, [name]: type === 'checkbox' ? checked : value }));
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            if (editingLink) {
                await api.put(`/footer-links/${editingLink.id}`, formData);
            } else {
                await api.post('/footer-links', formData);
            }
            setIsModalOpen(false);
            fetchLinks();
        } catch (error) {
            console.error(error);
            alert(error.response?.data?.error || 'Failed to save link');
        }
    };

    const handleToggleActive = async (id) => {
        try {
            await api.patch(`/footer-links/${id}/toggle-active`);
            fetchLinks();
        } catch (error) {
            console.error('Failed to toggle footer link', error);
        }
    };

    const handleDelete = async (id) => {
        if (!window.confirm("Are you sure you want to delete this link?")) return;
        try {
            await api.delete(`/footer-links/${id}`);
            fetchLinks();
        } catch (error) {
            console.error('Failed to delete footer link', error);
            alert('Failed to delete link');
        }
    };

    // Grouping links by column visually
    const importantLinks = links.filter(l => l.column === 'IMPORTANT').sort((a, b) => a.displayOrder - b.displayOrder);
    const usefulLinks = links.filter(l => l.column === 'USEFUL').sort((a, b) => a.displayOrder - b.displayOrder);

    const actionButtons = (
        <button onClick={handleOpenNew} className="admin-btn-primary flex items-center gap-1 px-3 py-1.5 text-sm">
            <Plus size={15} /> Add Link
        </button>
    );

    const renderTable = (data, title) => (
        <div className="mb-8">
            <h3 className="text-lg font-bold text-secondary mb-3">{title}</h3>
            <div className="overflow-hidden bg-white shadow-sm border border-gray-200 rounded-md">
                <table className="w-full text-left border-collapse">
                    <thead className="bg-gray-100 border-b border-gray-200 text-sm">
                        <tr>
                            <th className="w-16 py-3 px-4 font-bold text-gray-700 text-center">S.No</th>
                            <th className="py-3 px-4 font-bold text-gray-700">Label</th>
                            <th className="py-3 px-4 font-bold text-gray-700">URL</th>
                            <th className="w-24 py-3 px-4 font-bold text-gray-700 text-center">Order</th>
                            <th className="w-24 py-3 px-4 font-bold text-gray-700 text-center">Status</th>
                            <th className="w-24 py-3 px-4 font-bold text-gray-700 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {data.length === 0 ? (
                            <tr><td colSpan="6" className="text-center py-10 text-gray-400 text-sm italic">No links found for this column.</td></tr>
                        ) : data.map((item, index) => (
                            <tr key={item.id} className="hover:bg-gray-50 transition-colors border-b border-gray-100 last:border-b-0">
                                <td className="py-3 px-4 text-center font-medium text-gray-500 text-sm">{index + 1}</td>
                                <td className="py-3 px-4 font-bold text-secondary text-sm">{item.label}</td>
                                <td className="py-3 px-4 text-gray-500 font-mono text-sm max-w-[200px] truncate" title={item.url}>{item.url}</td>
                                <td className="py-3 px-4 text-center text-sm text-gray-600">{item.displayOrder}</td>
                                <td className="py-3 px-4 text-center">
                                    <button
                                        onClick={() => handleToggleActive(item.id)}
                                        className={`px-2 py-1 text-xs font-bold rounded-full w-20 transition-colors ${item.isActive ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-red-100 text-red-700 hover:bg-red-200'}`}
                                    >
                                        {item.isActive ? 'Active' : 'Disabled'}
                                    </button>
                                </td>
                                <td className="py-3 px-4 text-right">
                                    <div className="flex justify-end gap-2">
                                        <button onClick={() => handleOpenEdit(item)} className="p-1.5 text-gray-500 hover:text-blue-600 bg-gray-50 border border-gray-200 rounded transition-colors" title="Edit Link">
                                            <Edit2 size={16} />
                                        </button>
                                        <button onClick={() => handleDelete(item.id)} className="p-1.5 text-gray-500 hover:text-red-600 bg-gray-50 border border-gray-200 rounded transition-colors" title="Delete Link">
                                            <Trash2 size={16} />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </div>
    );

    return (
        <AdminPageLayout title="Footer Links" subtitle="Manage external and internal hyperlinks located in the footer" actionButtons={actionButtons}>
            {loading ? (
                <div className="flex justify-center py-12"><div className="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div></div>
            ) : (
                <div className="flex-1 overflow-auto pr-2 custom-scrollbar">
                    {renderTable(importantLinks, "Important Links")}
                    {renderTable(usefulLinks, "Useful Links")}
                </div>
            )}

            <AdminModal isOpen={isModalOpen} onClose={() => setIsModalOpen(false)} title={editingLink ? 'Edit Footer Link' : 'Add Footer Link'} size="md">
                <form onSubmit={handleSubmit} className="space-y-4">
                    <div>
                        <label className="block text-text-main font-bold mb-1">Column placement *</label>
                        <select name="column" className="admin-input" value={formData.column} onChange={handleChange} required>
                            <option value="IMPORTANT">Important Links</option>
                            <option value="USEFUL">Useful Links</option>
                        </select>
                    </div>
                    <div>
                        <label className="block text-text-main font-bold mb-1">Link Label *</label>
                        <input type="text" name="label" className="admin-input" value={formData.label} onChange={handleChange} required placeholder="e.g. Policies" />
                    </div>
                    <div>
                        <MediaSelector
                            label="URL / Document *"
                            value={formData.url}
                            onChange={(url) => setFormData(prev => ({ ...prev, url }))}
                            accept="*/*"
                        />
                        <div className="text-xs text-gray-500 mt-1">You can type a regular URL (e.g., /policies) or select/upload a document.</div>
                    </div>
                    <div className="grid grid-cols-2 gap-4">
                        <div>
                            <label className="block text-text-main font-bold mb-1">Display Order</label>
                            <input type="number" name="displayOrder" className="admin-input" value={formData.displayOrder} onChange={handleChange} />
                        </div>
                        <div className="flex items-center h-full pt-6">
                            <label className="flex items-center gap-2 cursor-pointer font-medium text-text-main">
                                <input type="checkbox" name="isActive" checked={formData.isActive} onChange={handleChange} className="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary" />
                                Active
                            </label>
                        </div>
                    </div>
                    <div className="flex justify-end gap-3 mt-6 pt-4 border-t border-border-light">
                        <button type="button" onClick={() => setIsModalOpen(false)} className="px-4 py-2 border border-border-light text-text-dark font-bold hover:bg-gray-100 rounded transition-colors">Cancel</button>
                        <button type="submit" className="admin-btn-primary px-6 py-2">Save Link</button>
                    </div>
                </form>
            </AdminModal>
        </AdminPageLayout>
    );
}
