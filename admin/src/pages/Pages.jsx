import { useState, useEffect } from 'react';
import { Plus, Edit2, Trash2, Save, FileText, Search, Filter } from 'lucide-react';
import api from '../api/axios';
import AdminPageLayout from '../components/AdminPageLayout';
import AdminModal from '../components/AdminModal';
import RichTextEditor from '../components/RichTextEditor';
import RevisionHistoryModal from '../components/RevisionHistoryModal';
import { Clock } from 'lucide-react';

export default function Pages() {
    const [pages, setPages] = useState([]);
    const [loading, setLoading] = useState(true);
    const [editingPage, setEditingPage] = useState(null);
    const [historyPage, setHistoryPage] = useState(null);
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [searchQuery, setSearchQuery] = useState('');
    const [statusFilter, setStatusFilter] = useState('all');

    const [formData, setFormData] = useState({
        title: '',
        slug: '',
        content: '',
        metaTitle: '',
        metaDescription: '',
        ogImage: '',
        isActive: true,
        pageType: 'Standard',
        bannerImageUrl: '',
        breadcrumbTitle: '',
        templateConfigJson: JSON.stringify({ showSidebar: true, showSidebarTextBox: true })
    });

    const fetchPages = async () => {
        try {
            const res = await api.get('/pages');
            setPages(res.data);
        } catch (err) {
            console.error('Failed to fetch pages', err);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchPages();
    }, []);

    const handleChange = (e) => {
        const { name, value, type, checked } = e.target;
        setFormData(prev => ({
            ...prev,
            [name]: type === 'checkbox' ? checked : value
        }));
    };

    const handleTemplateToggle = (key) => {
        try {
            const currentConfig = JSON.parse(formData.templateConfigJson || '{}');
            
            // Provide default data when turning features on for the first time
            if (key === 'showSidebar' && !currentConfig[key]) {
                if (!currentConfig.sidebarLinks) currentConfig.sidebarLinks = [{ label: 'Current Page', url: '#' }, { label: 'Back to Home', url: '/' }];
            }
            if (key === 'showTextBox' && !currentConfig[key]) {
                if (!currentConfig.textBoxContent) currentConfig.textBoxContent = '<h2>Mission</h2><p>Our mission goes here.</p>';
            }

            const newConfig = { ...currentConfig, [key]: !currentConfig[key] };
            setFormData(prev => ({
                ...prev,
                templateConfigJson: JSON.stringify(newConfig)
            }));
        } catch (err) {
            console.error("Invalid JSON config");
        }
    };

    const handleTemplateDataChange = (key, value) => {
        try {
            const currentConfig = JSON.parse(formData.templateConfigJson || '{}');
            const newConfig = { ...currentConfig, [key]: value };
            setFormData(prev => ({
                ...prev,
                templateConfigJson: JSON.stringify(newConfig)
            }));
        } catch (err) {
            console.error("Invalid JSON config");
        }
    };

    let templateConfig = { showSidebar: true, showTextBox: true };
    try {
        templateConfig = JSON.parse(formData.templateConfigJson || '{}');
    } catch(e) {}

    const handleGenerateSlug = () => {
        if (!formData.title) return;
        const generated = formData.title.toLowerCase().trim().replace(/[^\w\s-]/g, '').replace(/[\s_-]+/g, '-').replace(/^-+|-+$/g, '');
        setFormData(prev => ({ ...prev, slug: generated }));
    };

    const startEdit = (page) => {
        setEditingPage(page);
        
        let configStr = page.templateConfigJson;
        if (!configStr) {
            configStr = JSON.stringify({ showSidebar: true, showTextBox: true });
        }

        setFormData({
            title: page.title,
            slug: page.slug,
            content: page.content || '',
            metaTitle: page.metaTitle || '',
            metaDescription: page.metaDescription || '',
            ogImage: page.ogImage || '',
            isActive: page.isActive,
            pageType: page.pageType || 'Standard',
            bannerImageUrl: page.bannerImageUrl || '',
            breadcrumbTitle: page.breadcrumbTitle || '',
            templateConfigJson: configStr
        });
        setIsModalOpen(true);
    };

    const resetForm = () => {
        setEditingPage(null);
        setFormData({ 
            title: '', 
            slug: '', 
            content: '', 
            metaTitle: '', 
            metaDescription: '', 
            ogImage: '', 
            isActive: true, 
            pageType: 'Standard',
            bannerImageUrl: '',
            breadcrumbTitle: '',
            templateConfigJson: JSON.stringify({ showSidebar: true, showSidebarTextBox: true })
        });
        setIsModalOpen(false);
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            if (editingPage) {
                await api.put(`/pages/${editingPage.id}`, formData);
            } else {
                await api.post('/pages', formData);
            }
            resetForm();
            fetchPages();
        } catch (err) {
            alert(err.response?.data?.error || 'Failed to save page');
        }
    };

    const handleDelete = async (id) => {
        if (confirm('Are you sure you want to delete this page?')) {
            try {
                await api.delete(`/pages/${id}`);
                fetchPages();
            } catch (err) {
                alert('Failed to delete page');
            }
        }
    };

    if (loading) return <div>Loading pages...</div>;

    const filteredPages = pages.filter(page => {
        const matchesSearch = page.title.toLowerCase().includes(searchQuery.toLowerCase()) || 
                              page.slug.toLowerCase().includes(searchQuery.toLowerCase());
        const matchesStatus = statusFilter === 'all' 
                              ? true 
                              : statusFilter === 'published' ? page.isActive === true : page.isActive === false;
        return matchesSearch && matchesStatus;
    });

    const actionButtons = (
        <button onClick={() => { resetForm(); setIsModalOpen(true); }} className="admin-btn-primary flex items-center gap-2 text-sm">
            <Plus size={16} /> New Page
        </button>
    );



    return (
        <AdminPageLayout title="Pages Builder" actionButtons={actionButtons}>
            {/* Content Area (Full Width) */}
            <div className="admin-card overflow-hidden flex flex-col flex-1 min-h-0 bg-white">
                <div className="p-5 border-b border-gray-100 bg-white/50 backdrop-blur flex flex-col sm:flex-row gap-4 justify-between items-center z-10 sticky top-0">
                    <div className="relative w-full sm:w-96 group">
                        <div className="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <Search className="w-5 h-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" />
                        </div>
                        <input 
                            type="text" 
                            placeholder="Find a page..." 
                            className="w-full pl-11 pr-4 py-2.5 bg-gray-50/80 border border-gray-200 text-gray-900 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all outline-none shadow-sm font-medium"
                            value={searchQuery}
                            onChange={(e) => setSearchQuery(e.target.value)}
                        />
                    </div>
                    <div className="flex items-center gap-3 w-full sm:w-auto">
                        <div className="bg-gray-50/80 border border-gray-200 rounded-xl p-1 flex items-center shadow-sm hover:bg-white transition-colors">
                            <Filter className="text-gray-400 ml-3 w-4 h-4" />
                            <select 
                                className="bg-transparent border-none text-gray-700 font-bold py-1.5 px-3 focus:ring-0 outline-none cursor-pointer min-w-[140px]"
                                value={statusFilter}
                                onChange={(e) => setStatusFilter(e.target.value)}
                            >
                                <option value="all">All Status</option>
                                <option value="published">Published</option>
                                <option value="unpublished">Drafts</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div className="overflow-auto flex-1 p-6 bg-gray-50/30">
                    {filteredPages.length === 0 ? (
                        <div className="text-center py-16 text-gray-400">
                            <div className="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <FileText size={32} className="text-gray-300" />
                            </div>
                            <p className="text-xl font-bold text-gray-600 mb-2">No pages found</p>
                            <p className="text-sm">Click "New Page" or clear your search filters to continue.</p>
                        </div>
                    ) : (
                        <div className="flex flex-col gap-3">
                            {filteredPages.map(page => (
                                <div key={page.id} className="group bg-white rounded-xl p-4 shadow-[0_2px_12px_-3px_rgba(6,81,237,0.05)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-gray-100 hover:border-blue-100 hover:-translate-y-0.5 transition-all duration-300 flex flex-col md:flex-row md:items-center justify-between gap-4">
                                    <div className="flex items-center gap-4 flex-1 min-w-0">
                                        <div className="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-gray-50 to-gray-100 border border-gray-200 flex items-center justify-center group-hover:from-blue-50 group-hover:to-indigo-50 group-hover:border-blue-200 group-hover:text-blue-600 text-gray-400 transition-colors shadow-inner">
                                            <FileText size={20} className="stroke-[1.5]" />
                                        </div>
                                        <div className="flex-1 min-w-0">
                                            <h4 className="font-extrabold text-gray-900 text-[1.05rem] tracking-tight mb-1 group-hover:text-blue-700 transition-colors truncate">
                                                {page.title}
                                            </h4>
                                            <div className="inline-flex items-center gap-3">
                                                <div className="px-2.5 py-0.5 rounded-md bg-gray-50/80 border border-gray-100 text-gray-500 font-mono text-[11px] tracking-wider truncate max-w-full group-hover:bg-white transition-colors">
                                                    /{page.slug}
                                                </div>
                                                <div className="px-2.5 py-0.5 rounded-md bg-blue-50 text-blue-600 text-[11px] font-bold uppercase tracking-wider">
                                                    {page.pageType || 'Standard'}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div className="flex items-center gap-6 justify-between md:justify-end shrink-0 pl-16 md:pl-0">
                                        <div className="w-28 flex justify-start md:justify-center">
                                            {page.isActive ? (
                                                <span className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] uppercase font-black tracking-widest bg-emerald-50 text-emerald-600 ring-1 ring-emerald-500/20 shadow-[0_0_10px_rgba(16,185,129,0.1)]">
                                                    <span className="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                                    Live
                                                </span>
                                            ) : (
                                                <span className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] uppercase font-black tracking-widest bg-amber-50 text-amber-600 ring-1 ring-amber-500/20">
                                                    <span className="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                    Draft
                                                </span>
                                            )}
                                        </div>
                                        
                                        <div className="flex gap-2">
                                            <button onClick={() => window.open(`/page/${page.slug}`, '_blank')} className="flex items-center justify-center w-9 h-9 rounded-lg text-gray-400 bg-gray-50 hover:text-blue-600 hover:bg-blue-50 transition-colors border border-transparent hover:border-blue-100 shadow-sm" title="View">
                                                <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                            </button>
                                            <button onClick={() => startEdit(page)} className="flex items-center justify-center w-9 h-9 rounded-lg text-gray-400 bg-gray-50 hover:text-indigo-600 hover:bg-indigo-50 transition-colors border border-transparent hover:border-indigo-100 shadow-sm" title="Edit">
                                                <Edit2 size={16} className="stroke-[2]" />
                                            </button>
                                            <button onClick={() => setHistoryPage(page)} className="flex items-center justify-center w-9 h-9 rounded-lg text-gray-400 bg-gray-50 hover:text-blue-500 hover:bg-blue-50 transition-colors border border-transparent hover:border-blue-100 shadow-sm" title="Revision History (Undo)">
                                                <Clock size={16} className="stroke-[2]" />
                                            </button>
                                            <div className="w-px h-6 bg-gray-200 my-auto mx-1 hidden md:block"></div>
                                            {page.pageType === 'Standard' && (
                                                <button onClick={() => handleDelete(page.id)} className="flex items-center justify-center w-9 h-9 rounded-lg text-gray-400 bg-gray-50 hover:text-red-600 hover:bg-red-50 transition-colors border border-transparent hover:border-red-100 shadow-sm" title="Delete">
                                                    <Trash2 size={16} className="stroke-[2]" />
                                                </button>
                                            )}
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    )}
                </div>
            </div>

            {/* Revision History Modal */}
            <RevisionHistoryModal
                isOpen={!!historyPage}
                onClose={() => setHistoryPage(null)}
                entityType="Page"
                entityId={historyPage?.id}
                entityTitle={historyPage?.title}
                onRevertSuccess={fetchPages}
            />

            {/* Modal Form */}
            <AdminModal
                isOpen={isModalOpen}
                onClose={resetForm}
                title={editingPage ? 'Edit Page' : 'Create New Page'}
                size="xl"
            >
                <form onSubmit={handleSubmit} className="space-y-6">
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div className="md:col-span-1">
                            <label className="block text-text-main font-bold mb-1">Page Title <span className="text-primary">*</span></label>
                            <input type="text" name="title" className="admin-input text-lg" value={formData.title} onChange={handleChange} required placeholder="e.g. Terms of Service" />
                        </div>
                        <div className="md:col-span-1">
                            <label className="block text-text-main font-bold mb-1">Page Type</label>
                            <select name="pageType" className="admin-input text-lg" value={formData.pageType} onChange={handleChange}>
                                <option value="Standard">Standard Text Page</option>
                                <option value="DynamicListing">Dynamic Module Page</option>
                            </select>
                        </div>
                        <div className="md:col-span-2">
                            <label className="block text-text-main font-bold mb-1">URL Slug <span className="text-primary">*</span></label>
                            <div className="flex">
                                <span className="bg-gray-100 text-gray-500 border border-border-light border-r-0 px-4 flex items-center rounded-l" style={{ width: 'auto', borderTopLeftRadius: '4px', borderBottomLeftRadius: '4px' }}>/</span>
                                <input type="text" name="slug" className="admin-input font-mono flex-1 rounded-none border-l-0 border-r-0" value={formData.slug} onChange={handleChange} required placeholder="terms-of-service" style={{ borderRadius: 0 }} />
                                {formData.pageType === 'Standard' && (
                                    <button type="button" onClick={handleGenerateSlug} className="px-4 border border-border-light font-bold text-secondary hover:bg-gray-100 rounded-r transition-colors text-sm" style={{ borderTopRightRadius: '4px', borderBottomRightRadius: '4px' }}>Generate</button>
                                )}
                            </div>
                        </div>
                        
                        <div className="md:col-span-1">
                            <label className="block text-text-main font-bold mb-1">Hero Banner Image URL</label>
                            <input type="text" name="bannerImageUrl" className="admin-input" value={formData.bannerImageUrl} onChange={handleChange} placeholder="e.g. /images/banner.jpg" />
                        </div>
                        <div className="md:col-span-1">
                            <label className="block text-text-main font-bold mb-1">Breadcrumb Title</label>
                            <input type="text" name="breadcrumbTitle" className="admin-input" value={formData.breadcrumbTitle} onChange={handleChange} placeholder="e.g. Home > About" />
                        </div>
                    </div>

                    {formData.pageType === 'Standard' && (
                        <>
                            <div className="border-t border-border-light pt-4 mt-6">
                                <h4 className="font-bold text-secondary mb-3">Template: Subpage with Left Panel</h4>
                                <div className="flex gap-8 items-start bg-gray-50 p-4 rounded-lg border border-gray-200">
                                    {/* Visual Representation of the Template */}
                                    <div className="w-48 bg-white border border-gray-300 rounded shadow-sm overflow-hidden flex-shrink-0">
                                        <div className="h-6 bg-gray-200 border-b border-gray-300 flex items-center px-2">
                                            <div className="h-2 w-16 bg-gray-400 rounded"></div>
                                        </div>
                                        <div className="flex p-2 gap-2 h-32">
                                            {templateConfig.showSidebar && (
                                                <div className="w-12 flex flex-col gap-2">
                                                    <div className="h-full bg-blue-100 border border-blue-200 rounded flex items-center justify-center">
                                                        <span className="text-[8px] text-blue-800 font-bold rotate-[-90deg] whitespace-nowrap">Side Menu</span>
                                                    </div>
                                                    {templateConfig.showTextBox && (
                                                        <div className="h-10 bg-amber-100 border border-amber-200 rounded flex items-center justify-center">
                                                            <span className="text-[8px] text-amber-800 font-bold text-center leading-tight px-1">Text Box</span>
                                                        </div>
                                                    )}
                                                </div>
                                            )}
                                            <div className="flex-1 bg-gray-100 border border-gray-200 rounded p-1 flex flex-col gap-1">
                                                <div className="h-2 w-3/4 bg-gray-300 rounded"></div>
                                                <div className="h-1 w-full bg-gray-200 rounded"></div>
                                                <div className="h-1 w-full bg-gray-200 rounded"></div>
                                                <div className="h-1 w-5/6 bg-gray-200 rounded"></div>
                                                <div className="text-[8px] text-gray-400 text-center mt-auto">Main Content</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    {/* Toggles */}
                                    <div className="flex flex-col gap-4 flex-1">
                                        <p className="text-sm text-gray-500 mb-2">Configure the layout components for this page based on the <code>subpage-with-leftpanel.html</code> template.</p>
                                        <label className="flex items-center gap-3 cursor-pointer">
                                            <input type="checkbox" className="w-5 h-5 text-primary rounded border-gray-300" checked={templateConfig.showSidebar} onChange={() => handleTemplateToggle('showSidebar')} />
                                            <span className="text-sm font-bold text-gray-700">Show Side Menu (Left Panel)</span>
                                        </label>
                                        <label className={`flex items-center gap-3 cursor-pointer ${!templateConfig.showSidebar ? 'opacity-50 pointer-events-none' : ''}`}>
                                            <input type="checkbox" className="w-5 h-5 text-primary rounded border-gray-300" checked={templateConfig.showTextBox} onChange={() => handleTemplateToggle('showTextBox')} disabled={!templateConfig.showSidebar} />
                                            <span className="text-sm font-bold text-gray-700">Show Text Box (Mission/Vision below menu)</span>
                                        </label>
                                        <label className="flex items-center gap-3 cursor-pointer">
                                            <input type="checkbox" className="w-5 h-5 text-primary rounded border-gray-300" checked={templateConfig.showStickyNav} onChange={() => handleTemplateToggle('showStickyNav')} />
                                            <span className="text-sm font-bold text-gray-700">Show Horizontal Sticky Navigation Bar (Below Banner)</span>
                                        </label>
                                    </div>
                                </div>

                                {/* Dynamic Content Fields for Template */}
                                {templateConfig.showSidebar && (
                                    <div className="mt-4 p-4 border border-gray-200 rounded-lg bg-white">
                                        <h5 className="font-bold text-sm text-gray-800 mb-3">Sidebar Links</h5>
                                        {(templateConfig.sidebarLinks || []).map((link, index) => (
                                            <div key={index} className="flex gap-2 mb-2">
                                                <input 
                                                    type="text" 
                                                    className="w-full p-2 border border-gray-300 rounded text-sm" 
                                                    placeholder="Link Label (e.g. Contents)" 
                                                    value={link.label}
                                                    onChange={(e) => {
                                                        const newLinks = [...(templateConfig.sidebarLinks || [])];
                                                        newLinks[index].label = e.target.value;
                                                        handleTemplateDataChange('sidebarLinks', newLinks);
                                                    }}
                                                />
                                                <input 
                                                    type="text" 
                                                    className="w-full p-2 border border-gray-300 rounded text-sm" 
                                                    placeholder="URL (e.g. # or /route)" 
                                                    value={link.url}
                                                    onChange={(e) => {
                                                        const newLinks = [...(templateConfig.sidebarLinks || [])];
                                                        newLinks[index].url = e.target.value;
                                                        handleTemplateDataChange('sidebarLinks', newLinks);
                                                    }}
                                                />
                                                <button 
                                                    type="button" 
                                                    className="px-3 py-2 bg-red-100 text-red-600 rounded hover:bg-red-200"
                                                    onClick={() => {
                                                        const newLinks = (templateConfig.sidebarLinks || []).filter((_, i) => i !== index);
                                                        handleTemplateDataChange('sidebarLinks', newLinks);
                                                    }}
                                                >
                                                    <i className="fa-solid fa-trash"></i>
                                                </button>
                                            </div>
                                        ))}
                                        <button 
                                            type="button" 
                                            className="text-sm text-primary font-bold mt-2 flex items-center gap-1 hover:underline"
                                            onClick={() => {
                                                const newLinks = [...(templateConfig.sidebarLinks || []), { label: '', url: '' }];
                                                handleTemplateDataChange('sidebarLinks', newLinks);
                                            }}
                                        >
                                            <i className="fa-solid fa-plus"></i> Add Link
                                        </button>
                                    </div>
                                )}

                                {templateConfig.showSidebar && templateConfig.showTextBox && (
                                    <div className="mt-4 p-4 border border-gray-200 rounded-lg bg-white">
                                        <h5 className="font-bold text-sm text-gray-800 mb-3">Left Text Box HTML Content</h5>
                                        <p className="text-xs text-gray-500 mb-2">You can write HTML here directly (e.g. &lt;h2&gt;Mission&lt;/h2&gt;&lt;p&gt;...&lt;/p&gt;).</p>
                                        <textarea 
                                            className="w-full p-3 border border-gray-300 rounded text-sm font-mono h-32"
                                            value={templateConfig.textBoxContent || ''}
                                            onChange={(e) => handleTemplateDataChange('textBoxContent', e.target.value)}
                                            placeholder="<h2>Mission</h2><p>Text here</p>"
                                        />
                                    </div>
                                )}
                            </div>

                            
                            <div className="mb-8 mt-6">
                                <label className="block text-text-main font-bold mb-1">Page Content <span className="text-primary">*</span></label>
                                <RichTextEditor value={formData.content} onChange={(val) => setFormData({...formData, content: val})} />
                            </div>
                        </>
                    )}

                    <div className="border-t border-border-light pt-4 mt-6">
                        <h4 className="font-bold text-secondary mb-3">SEO & Metadata</h4>
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label className="block text-text-main font-bold mb-1 text-sm">Meta Title</label>
                                <input type="text" name="metaTitle" className="admin-input" value={formData.metaTitle} onChange={handleChange} placeholder="Overrides default page title" />
                            </div>
                            <div>
                                <label className="block text-text-main font-bold mb-1 text-sm">OG Image URL</label>
                                <input type="text" name="ogImage" className="admin-input" value={formData.ogImage} onChange={handleChange} placeholder="Image for social sharing (https://...)" />
                            </div>
                            <div className="md:col-span-2">
                                <label className="block text-text-main font-bold mb-1 text-sm">Meta Description</label>
                                <textarea name="metaDescription" className="admin-input h-20" value={formData.metaDescription} onChange={handleChange} placeholder="Search engine description" />
                            </div>
                        </div>
                    </div>

                    <div className="flex items-center justify-between border-t border-border-light pt-4 mt-4">
                        <label className="flex items-center gap-3 cursor-pointer p-2 bg-gray-50 rounded border border-border-light hover:bg-gray-100 pr-4">
                            <input type="checkbox" name="isActive" className="w-5 h-5 text-primary rounded border-gray-300 focus:ring-primary" checked={formData.isActive} onChange={handleChange} />
                            <span className="font-bold text-text-dark text-sm">Publish Page (Active)</span>
                        </label>
                        <div className="flex gap-4">
                            <button type="submit" className="admin-btn-primary flex items-center justify-center gap-2 min-w-[150px] py-2">
                                <Save size={18} /> {editingPage ? 'Save Changes' : 'Create Page'}
                            </button>
                            <button type="button" onClick={resetForm} className="px-6 py-2 border border-border-light text-text-dark font-bold hover:bg-gray-100 rounded transition-colors uppercase tracking-wide">
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>
            </AdminModal>
        </AdminPageLayout>
    );
}
