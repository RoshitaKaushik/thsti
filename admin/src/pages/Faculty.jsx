import { useState, useEffect } from 'react';
import { ASSETS_BASE_URL } from '../config/env';
import { Plus, Edit2, Trash2, Save, ExternalLink, Image, GraduationCap } from 'lucide-react';
import api from '../api/axios';
import AdminPageLayout from '../components/AdminPageLayout';
import AdminModal from '../components/AdminModal';
import MediaSelector from '../components/MediaSelector';
import RichTextEditor from '../components/RichTextEditor';

export default function Faculty() {
    const [faculty, setFaculty] = useState([]);
    const [filterState, setFilterState] = useState('ALL'); // ALL, ACTIVE, DRAFT, ARCHIVED
    const [loading, setLoading] = useState(true);
    const [editingFaculty, setEditingFaculty] = useState(null);
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [activeTab, setActiveTab] = useState('personal');

    const initialFormData = {
        name: '', slug: '', designation: '', department: '', location: '',
        office: '', email: '', phone: '', cvUrl: '', labWebsiteUrl: '', orcid: '',
        googleScholarUrl: '', researchGateUrl: '', linkedinUrl: '', researchFocus: '', educationSnippet: '',
        publicationsCount: 0, citationsCount: 0, hIndex: 0, patentsCount: 0, projectsCount: 0,
        overviewContent: '', educationContent: '', researchContent: '', publicationsContent: '',
        booksContent: '', patentsContent: '', awardsContent: '',
        imageUrl: '', displayOrder: 0, isActive: true, isArchived: false
    };

    const [formData, setFormData] = useState(initialFormData);

    const fetchFaculty = async () => {
        try {
            const res = await api.get('/faculty');
            setFaculty(res.data);
        } catch (err) {
            console.error('Failed to fetch faculty', err);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchFaculty();
    }, []);

    const handleChange = (e) => {
        const { name, value, type, checked } = e.target;
        setFormData(prev => {
            const updated = {
                ...prev,
                [name]: type === 'checkbox' ? checked : (type === 'number' ? Number(value) : value)
            };
            if (name === 'name' && !editingFaculty) {
                updated.slug = value.toLowerCase().trim().replace(/[^\w\s-]/g, '').replace(/[\s_-]+/g, '-').replace(/^-+|-+$/g, '');
            }
            return updated;
        });
    };

    const startEdit = (item) => {
        setActiveTab('personal');
        setEditingFaculty(item);
        setFormData({
            ...initialFormData,
            ...item
        });
        setIsModalOpen(true);
    };

    const handleOpenNew = () => {
        setActiveTab('personal');
        setEditingFaculty(null);
        setFormData(initialFormData);
        setIsModalOpen(true);
    };

    const handleCloseModal = () => {
        setIsModalOpen(false);
        setEditingFaculty(null);
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            const payload = { ...formData };

            if (editingFaculty) {
                await api.put(`/faculty/${editingFaculty.id}`, payload);
            } else {
                await api.post('/faculty', payload);
            }
            handleCloseModal();
            fetchFaculty();
        } catch (err) {
            alert(err.response?.data?.error || 'Failed to save faculty member');
        }
    };

    const handleDelete = async (id) => {
        if (window.confirm('Are you sure you want to delete this faculty member?')) {
            try {
                await api.delete(`/faculty/${id}`);
                fetchFaculty();
            } catch (err) {
                alert('Failed to delete faculty member');
            }
        }
    };

    const handleArchiveToggle = async (item) => {
        if (window.confirm(`Are you sure you want to ${item.isArchived ? 'unarchive' : 'archive'} this faculty member?`)) {
            try {
                await api.put(`/faculty/${item.id}`, { ...item, isArchived: !item.isArchived });
                fetchFaculty();
            } catch (err) {
                alert('Failed to toggle archive state');
            }
        }
    };

    const filteredFaculty = faculty.filter(item => {
        if (filterState === 'ACTIVE') return item.isActive && !item.isArchived;
        if (filterState === 'INACTIVE') return !item.isActive && !item.isArchived;
        if (filterState === 'ARCHIVED') return item.isArchived;
        return true;
    });

    if (loading) return <div>Loading...</div>;

    const actionButtons = (
        <div className="flex items-center gap-4">
            <select 
                className="admin-input py-2 text-sm w-40" 
                value={filterState} 
                onChange={(e) => setFilterState(e.target.value)}
            >
                <option value="ALL">All Items</option>
                <option value="ACTIVE">Active (Live)</option>
                <option value="INACTIVE">Inactive</option>
                <option value="ARCHIVED">Archived 🗄️</option>
            </select>
            <button onClick={handleOpenNew} className="admin-btn-primary flex items-center gap-2 px-4 py-2 text-sm">
                <Plus size={16} /> Add Faculty
            </button>
        </div>
    );

    const tabs = [
        { id: 'personal', label: 'Personal Info' },
        { id: 'education', label: 'Educational Info' },
        { id: 'research', label: 'Research Info' },
        { id: 'publications', label: 'Publications' },
        { id: 'awards', label: 'Awards' }
    ];

    return (
        <AdminPageLayout title="Faculty Members" actionButtons={actionButtons}>
            <div className="admin-card overflow-hidden flex flex-col flex-1 min-h-0 bg-white shadow-sm border border-border-light">
                <div className="overflow-auto flex-1 p-6">
                    {filteredFaculty.length === 0 ? (
                        <div className="text-center text-text-muted italic py-12 border-2 border-dashed border-border-light rounded-lg">
                            <GraduationCap size={48} className="mx-auto text-gray-300 mb-4" />
                            <p>No faculty members match this filter.</p>
                            <button onClick={handleOpenNew} className="mt-4 text-primary font-bold hover:underline">Add first faculty member</button>
                        </div>
                    ) : (
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            {filteredFaculty.map(item => (
                                <div key={item.id} className={`admin-card p-5 border border-border-light shadow-sm hover:shadow-md transition-shadow bg-white flex flex-col relative ${item.isArchived ? 'opacity-70 grayscale' : ''}`}>
                                    <div className="flex items-center gap-4 border-b border-gray-100 pb-4 mb-4">
                                        <div className="h-16 w-16 bg-gray-100 rounded-full overflow-hidden border-2 border-gray-200 flex-shrink-0">
                                            {item.imageUrl ? (
                                                <img src={item.imageUrl.startsWith('http') ? item.imageUrl : `${ASSETS_BASE_URL}${item.imageUrl}`} className="h-full w-full object-cover" alt={item.name} onError={(e) => { e.target.onerror = null; e.target.src = '' }} />
                                            ) : (
                                                <div className="h-full w-full flex items-center justify-center bg-blue-100 text-blue-800 font-bold text-xl">{item.name.charAt(0)}</div>
                                            )}
                                        </div>
                                        <div className="overflow-hidden">
                                            <h4 className="font-bold text-secondary text-base leading-tight truncate">{item.name}</h4>
                                            <p className="text-xs text-primary font-medium truncate mt-1">{item.designation || 'No Designation'}</p>
                                        </div>
                                    </div>
                                    
                                    <div className="text-sm text-text-muted mb-4 flex-1">
                                        <div className="truncate"><span className="font-semibold text-gray-700">Dept:</span> {item.department || '-'}</div>
                                        <div className="truncate"><span className="font-semibold text-gray-700">Email:</span> {item.email || '-'}</div>
                                    </div>
                                    
                                    <div className="flex justify-between items-center text-xs pt-4 border-t border-border-light mt-auto">
                                        <span className={`px-2 py-1 font-bold rounded-full ${item.isActive ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100'}`}>
                                            {item.isActive ? 'ACTIVE' : 'INACTIVE'}
                                        </span>
                                        <div className="flex items-center gap-2">
                                            <button onClick={() => handleArchiveToggle(item)} title={item.isArchived ? "Unarchive" : "Archive"} className="p-1.5 text-text-muted hover:text-amber-600 bg-gray-50 border border-border-light rounded shadow-sm transition-colors">
                                                {item.isArchived ? '👁️' : '🗄️'}
                                            </button>
                                            <button onClick={() => startEdit(item)} title="Edit" className="p-1.5 text-text-muted hover:text-accent bg-gray-50 border border-border-light rounded shadow-sm transition-colors">
                                                <Edit2 size={14} />
                                            </button>
                                            <button onClick={() => handleDelete(item.id)} title="Delete" className="p-1.5 text-text-muted hover:text-primary bg-gray-50 border border-border-light rounded shadow-sm transition-colors">
                                                <Trash2 size={14} />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    )}
                </div>
            </div>

            <AdminModal
                isOpen={isModalOpen}
                onClose={handleCloseModal}
                title={editingFaculty ? 'Edit Faculty' : 'Add Faculty'}
                size="xl" 
            >
                <form onSubmit={handleSubmit} className="space-y-6 h-[80vh] overflow-y-auto px-2 custom-scrollbar">
                    
                    <div className="flex border-b border-gray-200 gap-1 overflow-x-auto mb-4">
                        {tabs.map(tab => (
                            <button
                                key={tab.id}
                                type="button"
                                className={`px-4 py-2 text-sm font-bold border-b-2 transition-colors whitespace-nowrap ${activeTab === tab.id ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'}`}
                                onClick={() => setActiveTab(tab.id)}
                            >
                                {tab.label}
                            </button>
                        ))}
                    </div>

                    {activeTab === 'personal' && (
                        <div className="space-y-6">
                            <div className="bg-gray-50 p-4 rounded border border-gray-200">
                                <h3 className="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Basic Info</h3>
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label className="block text-text-main font-bold mb-1">Full Name *</label>
                                        <input type="text" name="name" className="admin-input" value={formData.name || ''} onChange={handleChange} required />
                                    </div>
                                    <div>
                                        <label className="block text-text-main font-bold mb-1">URL Slug</label>
                                        <input type="text" name="slug" className="admin-input" value={formData.slug || ''} onChange={handleChange} required />
                                    </div>
                                    <div>
                                        <label className="block text-text-main font-bold mb-1">Designation</label>
                                        <input type="text" name="designation" className="admin-input" value={formData.designation || ''} onChange={handleChange} />
                                    </div>
                                    <div>
                                        <label className="block text-text-main font-bold mb-1">Department</label>
                                        <input type="text" name="department" className="admin-input" value={formData.department || ''} onChange={handleChange} />
                                    </div>
                                    <div>
                                        <label className="block text-text-main font-bold mb-1">Email</label>
                                        <input type="email" name="email" className="admin-input" value={formData.email || ''} onChange={handleChange} />
                                    </div>
                                    <div>
                                        <label className="block text-text-main font-bold mb-1">Phone</label>
                                        <input type="text" name="phone" className="admin-input" value={formData.phone || ''} onChange={handleChange} />
                                    </div>
                                    <div>
                                        <label className="block text-text-main font-bold mb-1">Office Location</label>
                                        <input type="text" name="office" className="admin-input" value={formData.office || ''} onChange={handleChange} />
                                    </div>
                                    <div>
                                        <label className="block text-text-main font-bold mb-1">Display Order</label>
                                        <input type="number" name="displayOrder" className="admin-input" value={formData.displayOrder} onChange={handleChange} />
                                    </div>
                                    <div className="md:col-span-2">
                                        <MediaSelector
                                            label="Profile Image"
                                            value={formData.imageUrl}
                                            onChange={(url) => setFormData({ ...formData, imageUrl: url })}
                                            accept="image/*"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div className="bg-gray-50 p-4 rounded border border-gray-200">
                                <h3 className="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Academic & Social Links</h3>
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label className="block text-text-main font-bold mb-1">ORCID</label>
                                        <input type="text" name="orcid" className="admin-input" value={formData.orcid || ''} onChange={handleChange} placeholder="e.g. 0000-0002-XXXX-XXXX" />
                                    </div>
                                    <div>
                                        <label className="block text-text-main font-bold mb-1">Google Scholar URL</label>
                                        <input type="text" name="googleScholarUrl" className="admin-input" value={formData.googleScholarUrl || ''} onChange={handleChange} />
                                    </div>
                                    <div>
                                        <label className="block text-text-main font-bold mb-1">ResearchGate URL</label>
                                        <input type="text" name="researchGateUrl" className="admin-input" value={formData.researchGateUrl || ''} onChange={handleChange} />
                                    </div>
                                    <div>
                                        <label className="block text-text-main font-bold mb-1">LinkedIn URL</label>
                                        <input type="text" name="linkedinUrl" className="admin-input" value={formData.linkedinUrl || ''} onChange={handleChange} />
                                    </div>
                                    <div>
                                        <label className="block text-text-main font-bold mb-1">Lab Website URL</label>
                                        <input type="text" name="labWebsiteUrl" className="admin-input" value={formData.labWebsiteUrl || ''} onChange={handleChange} />
                                    </div>
                                    <div className="md:col-span-2">
                                        <MediaSelector
                                            label="CV Document (PDF generally)"
                                            value={formData.cvUrl}
                                            onChange={(url) => setFormData({ ...formData, cvUrl: url })}
                                            accept=".pdf,application/pdf"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div className="bg-gray-50 p-4 rounded border border-gray-200">
                                <label className="block text-text-main font-bold mb-1">Overview / Bio</label>
                                <RichTextEditor
                                    value={formData.overviewContent}
                                    onChange={(val) => setFormData(prev => ({ ...prev, overviewContent: val }))}
                                />
                            </div>
                        </div>
                    )}

                    {activeTab === 'education' && (
                        <div className="space-y-6">
                            <div className="bg-gray-50 p-4 rounded border border-gray-200">
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label className="block text-text-main font-bold mb-1">Short Education Snippet</label>
                                        <input type="text" name="educationSnippet" className="admin-input" placeholder="e.g. Ph.D. (1999)" value={formData.educationSnippet || ''} onChange={handleChange} />
                                    </div>
                                    <div>
                                        <label className="block text-text-main font-bold mb-1">Location Snippet</label>
                                        <input type="text" name="location" className="admin-input" placeholder="e.g. THSTI, Faridabad" value={formData.location || ''} onChange={handleChange} />
                                    </div>
                                </div>
                            </div>
                            <div className="bg-gray-50 p-4 rounded border border-gray-200">
                                <label className="block text-text-main font-bold mb-1">Education Details</label>
                                <RichTextEditor
                                    value={formData.educationContent}
                                    onChange={(val) => setFormData(prev => ({ ...prev, educationContent: val }))}
                                />
                            </div>
                        </div>
                    )}

                    {activeTab === 'research' && (
                        <div className="space-y-6">
                            <div className="bg-gray-50 p-4 rounded border border-gray-200">
                                <label className="block text-text-main font-bold mb-1">Research Focus snippet</label>
                                <input type="text" name="researchFocus" className="admin-input" placeholder="e.g. Translational Immunology" value={formData.researchFocus || ''} onChange={handleChange} />
                            </div>
                            <div className="bg-gray-50 p-4 rounded border border-gray-200">
                                <label className="block text-text-main font-bold mb-1">Research Overview</label>
                                <RichTextEditor
                                    value={formData.researchContent}
                                    onChange={(val) => setFormData(prev => ({ ...prev, researchContent: val }))}
                                />
                            </div>
                        </div>
                    )}

                    {activeTab === 'publications' && (
                        <div className="space-y-6">
                            <div className="bg-gray-50 p-4 rounded border border-gray-200">
                                <h3 className="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Stats</h3>
                                <div className="grid grid-cols-5 gap-2">
                                    <div><label className="text-xs font-bold">Publications</label><input type="number" name="publicationsCount" className="admin-input p-1" value={formData.publicationsCount} onChange={handleChange} /></div>
                                    <div><label className="text-xs font-bold">Citations</label><input type="number" name="citationsCount" className="admin-input p-1" value={formData.citationsCount} onChange={handleChange} /></div>
                                    <div><label className="text-xs font-bold">H-Index</label><input type="number" name="hIndex" className="admin-input p-1" value={formData.hIndex} onChange={handleChange} /></div>
                                    <div><label className="text-xs font-bold">Patents</label><input type="number" name="patentsCount" className="admin-input p-1" value={formData.patentsCount} onChange={handleChange} /></div>
                                    <div><label className="text-xs font-bold">Projects</label><input type="number" name="projectsCount" className="admin-input p-1" value={formData.projectsCount} onChange={handleChange} /></div>
                                </div>
                            </div>
                            <div className="bg-gray-50 p-4 rounded border border-gray-200">
                                <label className="block text-text-main font-bold mb-1">Publications</label>
                                <RichTextEditor
                                    value={formData.publicationsContent}
                                    onChange={(val) => setFormData(prev => ({ ...prev, publicationsContent: val }))}
                                />
                            </div>
                            <div className="bg-gray-50 p-4 rounded border border-gray-200">
                                <label className="block text-text-main font-bold mb-1">Books & Book Chapters</label>
                                <RichTextEditor
                                    value={formData.booksContent}
                                    onChange={(val) => setFormData(prev => ({ ...prev, booksContent: val }))}
                                />
                            </div>
                            <div className="bg-gray-50 p-4 rounded border border-gray-200">
                                <label className="block text-text-main font-bold mb-1">Patents</label>
                                <RichTextEditor
                                    value={formData.patentsContent}
                                    onChange={(val) => setFormData(prev => ({ ...prev, patentsContent: val }))}
                                />
                            </div>
                        </div>
                    )}

                    {activeTab === 'awards' && (
                        <div className="space-y-6">
                            <div className="bg-gray-50 p-4 rounded border border-gray-200">
                                <label className="block text-text-main font-bold mb-1">Awards & Honors</label>
                                <RichTextEditor
                                    value={formData.awardsContent}
                                    onChange={(val) => setFormData(prev => ({ ...prev, awardsContent: val }))}
                                />
                            </div>
                        </div>
                    )}

                    <div className="sticky bottom-0 bg-white p-4 border-t border-gray-200 mt-6 flex justify-between items-center shadow-[0_-4px_10px_rgba(0,0,0,0.05)]">
                        <label className="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="isActive" checked={formData.isActive} onChange={handleChange} className="w-5 h-5" />
                            <span className="font-bold">Active / Visible</span>
                        </label>
                        <div className="flex gap-4">
                            <button type="submit" className="admin-btn-primary flex items-center justify-center gap-2 px-6 py-2">
                                <Save size={18} /> {editingFaculty ? 'Save Changes' : 'Create Faculty'}
                            </button>
                            <button type="button" onClick={handleCloseModal} className="px-6 py-2 border border-border-light text-text-dark font-bold hover:bg-gray-100 rounded">
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>
            </AdminModal>
        </AdminPageLayout>
    );
}
