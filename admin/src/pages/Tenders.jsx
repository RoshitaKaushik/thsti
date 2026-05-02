import { useState, useEffect, useCallback } from 'react';
import { toast } from 'react-hot-toast';
import api from '../api/axios';
import { FiEdit2, FiTrash2, FiFileText } from 'react-icons/fi';
import MediaSelector from '../components/MediaSelector';

export default function Tenders() {
    const currentUser = JSON.parse(localStorage.getItem('thsti_admin_user') || '{}');
    const isExec = currentUser?.role === 'EXECUTIVE';

    const [tenders, setTenders] = useState([]);
    const [filterState, setFilterState] = useState('ALL'); // ALL, ACTIVE, DRAFT, ARCHIVED
    const [loading, setLoading] = useState(false);
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [editingTender, setEditingTender] = useState(null);

    const [formData, setFormData] = useState({
        title: '',
        titleHi: '',
        referenceNo: '',
        documentUrl: '',
        publishDate: new Date().toISOString().split('T')[0],
        closingDate: new Date().toISOString().split('T')[0],
        reviewStatus: 'Draft',
        remarks: ''
    });

    const fetchTenders = useCallback(async () => {
        setLoading(true);
        try {
            const res = await api.get('/tenders/admin');
            setTenders(res.data);
        } catch (err) {
            toast.error(err.response?.data?.message || 'Failed to load tenders');
        } finally {
            setLoading(false);
        }
    }, []);

    useEffect(() => { fetchTenders(); }, [fetchTenders]);

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            const payload = { ...formData };

            if (editingTender) {
                await api.put(`/tenders/${editingTender.id}`, payload);
                toast.success('Tender updated successfully');
            } else {
                await api.post('/tenders', payload);
                toast.success('Tender created successfully');
            }
            setIsModalOpen(false);
            fetchTenders();
        } catch (err) {
            toast.error(err.response?.data?.error || 'Operation failed');
        }
    };

    const handleDelete = async (id) => {
        if (!window.confirm('Are you sure you want to delete this tender?')) return;
        try {
            await api.delete(`/tenders/${id}`);
            toast.success('Tender deleted');
            fetchTenders();
        } catch (err) {
            toast.error('Failed to delete tender');
        }
    };

    const handleArchiveToggle = async (item) => {
        if (!window.confirm(`Are you sure you want to ${item.isArchived ? 'unarchive' : 'archive'} this tender?`)) return;
        try {
            await api.put(`/tenders/${item.id}`, { ...item, isArchived: !item.isArchived });
            toast.success(item.isArchived ? 'Tender Unarchived' : 'Tender Archived');
            fetchTenders();
        } catch (err) {
            toast.error('Failed to toggle archive state');
        }
    };

    const filteredTenders = tenders.filter(item => {
        if(filterState === 'ACTIVE') return !item.isArchived && item.reviewStatus === 'Published';
        if(filterState === 'DRAFT') return !item.isArchived && item.reviewStatus !== 'Published';
        if(filterState === 'ARCHIVED') return item.isArchived;
        return true;
    });

    const openCreateModal = () => {
        setEditingTender(null);
        setFormData({
            title: '', titleHi: '', referenceNo: '', documentUrl: '',
            publishDate: new Date().toISOString().split('T')[0],
            closingDate: new Date().toISOString().split('T')[0],
            reviewStatus: 'Draft', remarks: ''
        });
        setIsModalOpen(true);
    };

    const openEditModal = (item) => {
        setEditingTender(item);
        setFormData({
            title: item.title,
            titleHi: item.titleHi || '',
            referenceNo: item.referenceNo,
            documentUrl: item.documentUrl,
            publishDate: new Date(item.publishDate).toISOString().split('T')[0],
            closingDate: new Date(item.closingDate).toISOString().split('T')[0],
            reviewStatus: item.reviewStatus,
            remarks: item.remarks || ''
        });
        setIsModalOpen(true);
    };

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData(prev => ({ ...prev, [name]: value }));
    };

    const getStatusBadge = (status) => {
        const styles = {
            'Published': 'bg-green-100 text-green-800',
            'PendingReview': 'bg-yellow-100 text-yellow-800',
            'Draft': 'bg-gray-100 text-gray-800',
            'Rejected': 'bg-red-100 text-red-800'
        };
        return <span className={`px-2 py-1 rounded text-xs font-semibold ${styles[status]}`}>{status}</span>;
    };

    return (
        <div className="p-6">
            <div className="flex justify-between items-center mb-6">
                <div>
                    <h1 className="text-2xl font-bold text-secondary">Tenders Management</h1>
                    <p className="text-text-muted mt-1">Manage public tenders, automated archiving, and tracking.</p>
                </div>
                <div className="flex items-center gap-4">
                    <select 
                        className="admin-input py-2 text-sm w-40" 
                        value={filterState} 
                        onChange={(e) => setFilterState(e.target.value)}
                    >
                        <option value="ALL">All Items</option>
                        <option value="ACTIVE">Active (Live)</option>
                        <option value="DRAFT">Drafts</option>
                        <option value="ARCHIVED">Archived 🗄️</option>
                    </select>
                    <button onClick={openCreateModal} className="admin-btn-primary">+ Add New Tender</button>
                </div>
            </div>

            <div className="admin-card overflow-x-auto">
                {loading ? <div className="p-10 text-center text-text-muted">Loading...</div> : (
                    <table className="w-full text-sm">
                        <thead className="bg-bg-light border-b border-border-light text-left">
                            <tr>
                                <th className="p-4">Reference No.</th>
                                <th className="p-4">Tender Title</th>
                                <th className="p-4">Publish Date</th>
                                <th className="p-4">Closing Date</th>
                                <th className="p-4">Status</th>
                                <th className="p-4">Archived</th>
                                <th className="p-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {filteredTenders.map((item) => (
                                <tr key={item.id} className={`border-b border-border-light hover:bg-gray-50 ${item.isArchived ? 'opacity-70 grayscale' : ''}`}>
                                    <td className="p-4 font-mono font-bold text-secondary">{item.referenceNo}</td>
                                    <td className="p-4 w-1/3 text-secondary font-medium">
                                        {item.title}
                                        {item.remarks && <div className="text-xs text-red-500 mt-1">Manager Note: {item.remarks}</div>}
                                    </td>
                                    <td className="p-4 text-text-muted">{new Date(item.publishDate).toLocaleDateString()}</td>
                                    <td className="p-4 text-orange-600 font-bold">{new Date(item.closingDate).toLocaleDateString()}</td>
                                    <td className="p-4">{getStatusBadge(item.reviewStatus)}</td>
                                    <td className="p-4">
                                        {item.isArchived ? <span className="text-amber-600 font-bold">🗄️ ARCHIVED</span> : <span className="text-green-600 font-medium">Visible</span>}
                                    </td>
                                    <td className="p-4 flex gap-3">
                                        {!item.isArchived && (
                                            <a href={item.documentUrl} target="_blank" rel="noreferrer" title="View Document" className="text-gray-500 hover:text-blue-600 bg-gray-100 p-2 rounded-full"><FiFileText size={16} /></a>
                                        )}
                                        <button onClick={() => handleArchiveToggle(item)} title={item.isArchived ? "Unarchive" : "Archive"} className="text-gray-500 hover:text-amber-600 bg-gray-100 p-2 rounded-full">
                                            {item.isArchived ? '👁️' : '🗄️'}
                                        </button>
                                        <button onClick={() => openEditModal(item)} className="text-gray-500 hover:text-primary bg-gray-100 p-2 rounded-full"><FiEdit2 size={16} /></button>
                                        <button onClick={() => handleDelete(item.id)} className="text-gray-500 hover:text-red-600 bg-gray-100 p-2 rounded-full"><FiTrash2 size={16} /></button>
                                    </td>
                                </tr>
                            ))}
                            {filteredTenders.length === 0 && (
                                <tr>
                                    <td colSpan="7" className="p-6 text-center text-text-muted">No tenders match this filter.</td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                )}
            </div>

            {/* Modal */}
            {isModalOpen && (
                <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
                    <div className="bg-white rounded-xl shadow-2xl w-full max-w-2xl flex flex-col max-h-[90vh]">
                        <div className="flex items-center justify-between p-5 border-b border-border-light bg-bg-light/50">
                            <h2 className="text-xl font-bold text-secondary">{editingTender ? 'Edit Tender' : 'New Tender'}</h2>
                            <button onClick={() => setIsModalOpen(false)} className="text-text-muted hover:text-red-500">&times;</button>
                        </div>

                        <form onSubmit={handleSubmit} className="p-5 overflow-y-auto space-y-4">
                            <div className="grid grid-cols-2 gap-4">
                                <div className="col-span-2 md:col-span-1">
                                    <label className="block font-bold mb-1">Title (English) *</label>
                                    <input type="text" name="title" className="admin-input" value={formData.title} onChange={handleChange} required />
                                </div>
                                <div className="col-span-2 md:col-span-1">
                                    <label className="block font-bold mb-1">Title (Hindi)</label>
                                    <input type="text" name="titleHi" className="admin-input" placeholder="Leave blank to translate" value={formData.titleHi} onChange={handleChange} />
                                </div>

                                <div className="col-span-2">
                                    <label className="block font-bold mb-1">Reference Number *</label>
                                    <input type="text" name="referenceNo" className="admin-input font-mono" value={formData.referenceNo} onChange={handleChange} required />
                                </div>

                                <div>
                                    <label className="block font-bold mb-1">Publish Date *</label>
                                    <input type="date" name="publishDate" className="admin-input" value={formData.publishDate} onChange={handleChange} required />
                                </div>
                                <div>
                                    <label className="block font-bold mb-1">Closing Date *</label>
                                    <input type="date" name="closingDate" className="admin-input" value={formData.closingDate} onChange={handleChange} required />
                                </div>

                                <div className="col-span-2">
                                    <MediaSelector
                                        label="Tender Document (PDF)"
                                        value={formData.documentUrl}
                                        onChange={(url) => setFormData({ ...formData, documentUrl: url })}
                                        accept=".pdf,.doc,.docx"
                                    />
                                </div>
                            </div>
                            
                            {/* Workflow */}
                            <div className="p-4 bg-gray-50 border border-border-light rounded-lg mt-4">
                                <h3 className="font-bold text-secondary mb-3">Workflow & Governance</h3>
                                <div className="grid grid-cols-2 gap-4">
                                    <div>
                                        <label className="block font-bold mb-1">Status</label>
                                        <select name="reviewStatus" className="admin-input" value={formData.reviewStatus} onChange={handleChange}>
                                            <option value="Draft">Draft</option>
                                            <option value="PendingReview">Pending Review</option>
                                            {!isExec && <option value="Published">Published</option>}
                                            {!isExec && <option value="Rejected">Rejected</option>}
                                        </select>
                                    </div>
                                    <div>
                                        <label className="block font-bold mb-1">Reviewer Remarks / Feedback</label>
                                        <input type="text" name="remarks" className="admin-input" value={formData.remarks} onChange={handleChange} disabled={isExec} placeholder="Manager notes..." />
                                    </div>
                                </div>
                            </div>

                            <div className="pt-4 flex justify-end gap-3 mt-6 border-t border-border-light">
                                <button type="button" onClick={() => setIsModalOpen(false)} className="admin-btn-secondary">Cancel</button>
                                <button type="submit" className="admin-btn-primary">
                                    {isExec && formData.reviewStatus === 'Published' ? 'Submit for Review' : 'Save Tender'}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            )}
        </div>
    );
}
