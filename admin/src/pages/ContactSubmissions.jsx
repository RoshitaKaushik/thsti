import { useState, useEffect, useCallback } from 'react';
import { toast } from 'react-hot-toast';
import api from '../api/axios';
import { FiCheckCircle, FiTrash2 } from 'react-icons/fi';

export default function ContactSubmissions() {
    const [submissions, setSubmissions] = useState([]);
    const [loading, setLoading] = useState(false);

    const fetchSubmissions = useCallback(async () => {
        setLoading(true);
        try {
            const res = await api.get('/contact-submissions/admin');
            setSubmissions(res.data);
        } catch (err) {
            toast.error(err.response?.data?.message || 'Failed to load submissions');
        } finally {
            setLoading(false);
        }
    }, []);

    useEffect(() => { fetchSubmissions(); }, [fetchSubmissions]);

    const handleResolveToggle = async (sub) => {
        try {
            await api.put(`/contact-submissions/${sub.id}`, { isResolved: !sub.isResolved });
            toast.success(`Submission marked as ${sub.isResolved ? 'Pending' : 'Resolved'}`);
            fetchSubmissions();
        } catch (err) {
            toast.error('Failed to update status');
        }
    };

    const handleDelete = async (id) => {
        if (!window.confirm('Permanent delete? This cannot be undone.')) return;
        try {
            await api.delete(`/contact-submissions/${id}`);
            toast.success('Submission deleted');
            fetchSubmissions();
        } catch (err) {
            toast.error('Failed to delete submission');
        }
    };

    return (
        <div className="p-6">
            <div className="mb-6">
                <h1 className="text-2xl font-bold text-secondary">Contact Submissions</h1>
                <p className="text-text-muted mt-1">Manage public inquiries, feedback, and support requests.</p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {loading ? <div className="p-10 text-text-muted">Loading...</div> : submissions.map(sub => (
                    <div key={sub.id} className={`admin-card p-5 relative border-l-4 ${sub.isResolved ? 'border-green-500 bg-gray-50' : 'border-orange-500 bg-white'}`}>
                        <div className="flex justify-between items-start mb-3">
                            <div>
                                <h3 className="font-bold text-secondary text-lg">{sub.name}</h3>
                                <a href={`mailto:${sub.email}`} className="text-primary text-sm font-semibold hover:underline">{sub.email}</a>
                                {sub.phone && <div className="text-sm text-text-muted">{sub.phone}</div>}
                            </div>
                            <span className="text-xs font-mono text-gray-400">
                                {new Date(sub.createdAt).toLocaleDateString()}
                            </span>
                        </div>
                        
                        <div className="bg-gray-50 p-3 rounded border border-gray-100 text-sm italic text-gray-700 mb-4 h-24 overflow-y-auto">
                            "{sub.message}"
                        </div>

                        <div className="flex justify-between items-center border-t border-gray-100 pt-4">
                            <button 
                                onClick={() => handleResolveToggle(sub)} 
                                className={`flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold transition-all ${sub.isResolved ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-orange-100 text-orange-700 hover:bg-orange-200'}`}
                            >
                                <FiCheckCircle /> {sub.isResolved ? 'Resolved' : 'Mark as Resolved'}
                            </button>
                            <button 
                                onClick={() => handleDelete(sub.id)} 
                                className="text-gray-400 hover:text-red-500"
                            >
                                <FiTrash2 size={16} />
                            </button>
                        </div>
                    </div>
                ))}
            </div>

            {!loading && submissions.length === 0 && (
                <div className="admin-card p-10 text-center text-gray-500 flex flex-col items-center justify-center">
                    <FiCheckCircle size={40} className="text-green-300 mb-3" />
                    <p className="text-lg">Inbox Zero</p>
                    <p className="text-sm mt-1">No pending feedback from the public.</p>
                </div>
            )}
        </div>
    );
}
