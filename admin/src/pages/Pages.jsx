import { useState, useEffect } from 'react';
import { Plus, Edit2, Trash2, Save, FileText, Search, Filter, X } from 'lucide-react';
import api from '../api/axios';
import AdminPageLayout from '../components/AdminPageLayout';
import AdminModal from '../components/AdminModal';
import RichTextEditor from '../components/RichTextEditor';
import RevisionHistoryModal from '../components/RevisionHistoryModal';
import { Clock } from 'lucide-react';
import { BhashiniService } from '../api/BhashiniService';

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
        templateConfigJson: JSON.stringify({ showSidebar: true, showTextBox: true, showStickyNav: true })
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
        let parsedConfig = {};
        try {
            parsedConfig = JSON.parse(configStr || '{}');
        } catch(e) {}
        
        // Auto-migrate legacy format to modular format
        if (!parsedConfig.sidebarBlocks) {
            const blocks = [];
            if (parsedConfig.showSidebar !== false) {
                blocks.push({
                    id: 'legacy-links-' + Date.now(),
                    type: 'quickLinks',
                    title: 'QUICK LINKS',
                    links: parsedConfig.sidebarLinks || []
                });
            }
            if (parsedConfig.showTextBox !== false) {
                blocks.push({
                    id: 'legacy-text-' + Date.now(),
                    type: 'textBox',
                    title: 'Mission Box',
                    content: parsedConfig.textBoxContent || ''
                });
            }
            parsedConfig.sidebarBlocks = blocks;
            delete parsedConfig.showSidebar;
            delete parsedConfig.sidebarLinks;
            delete parsedConfig.showTextBox;
            delete parsedConfig.textBoxContent;
        }

        if (!parsedConfig.stickyNavItems) {
            if (parsedConfig.showStickyNav !== false) {
                parsedConfig.stickyNavItems = [
                    { label: "Mission and Vision", url: "#", icon: "fa-user", isActive: true },
                    { label: "Director's Message", url: "/directors-message", icon: "fa-graduation-cap" },
                    { label: "Former Directors", url: "#", icon: "fa-flask" }
                ];
            } else {
                parsedConfig.stickyNavItems = [];
            }
            delete parsedConfig.showStickyNav;
        }

        configStr = JSON.stringify(parsedConfig);

        setFormData({
            title: page.title,
            titleHi: page.titleHi || '',
            slug: page.slug,
            content: page.content || '',
            contentHi: page.contentHi || '',
            metaTitle: page.metaTitle || '',
            metaDescription: page.metaDescription || '',
            ogImage: page.ogImage || '',
            isActive: page.isActive,
            pageType: page.pageType === 'Standard' ? 'Template' : page.pageType === 'DynamicListing' ? 'ModuleLinked' : (page.pageType || 'Template'),
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
            titleHi: '',
            slug: '', 
            content: '', 
            contentHi: '',
            metaTitle: '', 
            metaDescription: '', 
            ogImage: '', 
            isActive: true, 
            pageType: 'Template',
            bannerImageUrl: '',
            breadcrumbTitle: '',
            templateConfigJson: JSON.stringify({ 
                sidebarBlocks: [
                    { id: 'default-links', type: 'quickLinks', title: 'QUICK LINKS', links: [] }
                ], 
                stickyNavItems: [
                    { label: "Mission and Vision", url: "#", icon: "fa-user", isActive: true }
                ] 
            })
        });
        setIsModalOpen(false);
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            const payload = { ...formData };
            
            // Auto-translate using Bhashini if Hindi fields are blank
            if (!payload.titleHi && payload.title) {
                payload.titleHi = await BhashiniService.translateToHindi(payload.title);
            }
            if (!payload.contentHi && payload.content) {
                payload.contentHi = await BhashiniService.translateToHindi(payload.content);
            }

            if (editingPage) {
                await api.put(`/pages/${editingPage.id}`, payload);
            } else {
                await api.post('/pages', payload);
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
                                                    {page.pageType === 'ModuleLinked' ? 'Module Linked' : 'Template'}
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
                                            {page.pageType !== 'ModuleLinked' && (
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
                        {formData.pageType === 'ModuleLinked' && (
                            <>
                                <div className="md:col-span-1">
                                    <label className="block text-text-main font-bold mb-1">Page Title <span className="text-primary">*</span></label>
                                    <input type="text" name="title" className="admin-input text-lg" value={formData.title} onChange={handleChange} required placeholder="e.g. Terms of Service" />
                                </div>
                                <div className="md:col-span-1">
                                    <label className="block text-text-main font-bold mb-1">Page Title (Hindi)</label>
                                    <input type="text" name="titleHi" className="admin-input text-lg" value={formData.titleHi} onChange={handleChange} placeholder="Leave blank to translate" />
                                </div>
                                <div className="md:col-span-2">
                                    <label className="block text-text-main font-bold mb-1">Page Type</label>
                                    <div className="px-3 py-2 bg-blue-50 text-blue-800 border border-blue-200 rounded text-sm font-bold flex items-center">
                                        <span className="mr-2 text-xl">ℹ️</span>
                                        This is a Module-Linked Page. Content is managed inside its respective module.
                                    </div>
                                </div>
                            </>
                        )}
                        <div className="md:col-span-2">
                            <label className="block text-text-main font-bold mb-1">URL Slug <span className="text-primary">*</span></label>
                            <div className="flex">
                                <span className="bg-gray-100 text-gray-500 border border-border-light border-r-0 px-4 flex items-center rounded-l" style={{ width: 'auto', borderTopLeftRadius: '4px', borderBottomLeftRadius: '4px' }}>/</span>
                                <input type="text" name="slug" className="admin-input font-mono flex-1 rounded-none border-l-0 border-r-0" value={formData.slug} onChange={handleChange} required placeholder="terms-of-service" style={{ borderRadius: 0 }} readOnly={formData.pageType === 'ModuleLinked'} />
                                {formData.pageType !== 'ModuleLinked' && (
                                    <button type="button" onClick={handleGenerateSlug} className="px-4 border border-border-light font-bold text-secondary hover:bg-gray-100 rounded-r transition-colors text-sm" style={{ borderTopRightRadius: '4px', borderBottomRightRadius: '4px' }}>Generate</button>
                                )}
                            </div>
                        </div>
                        
                        <div className="md:col-span-1">
                            <label className="block text-text-main font-bold mb-1">Hero Banner Image URL</label>
                            <input type="text" name="bannerImageUrl" className="admin-input" value={formData.bannerImageUrl} onChange={handleChange} placeholder="e.g. /images/banner.jpg" />
                        </div>
                        
                        {formData.pageType === 'ModuleLinked' && (
                            <div className="md:col-span-1">
                                <label className="block text-text-main font-bold mb-1">Breadcrumb Title</label>
                                <input type="text" name="breadcrumbTitle" className="admin-input" value={formData.breadcrumbTitle} onChange={handleChange} placeholder="e.g. Home > About" />
                            </div>
                        )}
                    </div>

                    {formData.pageType !== 'ModuleLinked' && (
                        <>
                            <div className="border-t border-border-light pt-4 mt-6">
                                <h4 className="font-bold text-secondary mb-3 flex items-center justify-between">
                                    <span>Template: Subpage with Left Panel</span>
                                    <span className="text-sm font-normal text-gray-500 bg-gray-100 px-3 py-1 rounded-full border border-gray-200">WYSIWYG Editor</span>
                                </h4>
                                
                                <div className="bg-gray-50 p-2 md:p-6 rounded-xl border border-gray-200 mb-6 overflow-x-auto">
                                    <div className="min-w-[900px] w-full bg-white rounded-lg shadow-[0_4px_20px_rgba(0,0,0,0.08)] overflow-hidden border border-gray-300 font-sans text-sm relative">
                                        {/* Mock Header (Static) */}
                                        <div className="h-14 bg-white border-b border-gray-200 flex items-center px-6 justify-between select-none">
                                            <div className="text-2xl font-black text-blue-900 tracking-tighter">THSTI CMS</div>
                                            <div className="flex gap-4 font-bold text-gray-500 text-xs uppercase tracking-wider">
                                                <div>About Us</div><div>Research</div><div>Academics</div>
                                            </div>
                                        </div>
                                        
                                        {/* Banner / Breadcrumb Area (Editable) */}
                                        <div 
                                            className="h-48 bg-gradient-to-r from-blue-900 to-blue-800 flex flex-col justify-center px-10 relative group"
                                            style={formData.bannerImageUrl ? { backgroundImage: `url(${formData.bannerImageUrl.startsWith('http') ? formData.bannerImageUrl : 'http://localhost:5000' + formData.bannerImageUrl})`, backgroundSize: 'cover', backgroundPosition: 'center' } : {}}
                                        >
                                            <div className="absolute inset-0 bg-blue-900/70 mix-blend-multiply"></div>
                                            
                                            <div className="relative z-10 w-full max-w-5xl mx-auto">
                                                <div className="flex gap-4">
                                                    <input 
                                                        type="text" 
                                                        name="title"
                                                        value={formData.title} 
                                                        onChange={handleChange}
                                                        placeholder="Enter Page Title..."
                                                        required
                                                        className="w-1/2 bg-transparent border-b border-transparent hover:border-white/30 focus:border-white text-white text-4xl font-extrabold mb-2 placeholder-white/50 outline-none transition-colors py-1"
                                                    />
                                                    <input 
                                                        type="text" 
                                                        name="titleHi"
                                                        value={formData.titleHi} 
                                                        onChange={handleChange}
                                                        placeholder="Hindi Title..."
                                                        className="w-1/2 bg-transparent border-b border-transparent hover:border-white/30 focus:border-white text-white text-3xl font-extrabold mb-2 placeholder-white/50 outline-none transition-colors py-1"
                                                    />
                                                </div>
                                                <div className="flex items-center text-white/80 font-medium text-sm">
                                                    <span className="opacity-70 mr-2">Home &gt;</span>
                                                    <input 
                                                        type="text" 
                                                        name="breadcrumbTitle"
                                                        value={formData.breadcrumbTitle} 
                                                        onChange={handleChange}
                                                        placeholder="Breadcrumb Title (Optional, defaults to Page Title)"
                                                        className="bg-transparent border-b border-transparent hover:border-white/30 focus:border-white text-white placeholder-white/50 outline-none transition-colors w-64"
                                                    />
                                                </div>
                                            </div>
                                        </div>

                                        {/* Sticky Nav Area */}
                                        <div className="relative bg-[#e5f1f8] border-b border-blue-100 p-3">
                                            <div className="flex justify-between items-center mb-2">
                                                <span className="text-xs font-bold text-blue-900 uppercase tracking-wider">Sticky Navigation Bar</span>
                                                <button 
                                                    type="button" 
                                                    className="text-xs bg-blue-600 text-white px-2 py-1 rounded hover:bg-blue-700 flex items-center gap-1 shadow-sm transition-colors"
                                                    onClick={() => {
                                                        const newItems = [...(templateConfig.stickyNavItems || []), { label: 'New Link', url: '', icon: 'fa-link' }];
                                                        handleTemplateDataChange('stickyNavItems', newItems);
                                                    }}
                                                >
                                                    <Plus size={14} /> Add Nav Item
                                                </button>
                                            </div>
                                            <div className="flex flex-wrap gap-2">
                                                {(templateConfig.stickyNavItems || []).map((navItem, index) => (
                                                    <div key={index} className="flex flex-col bg-white border border-blue-200 rounded p-2 shadow-sm relative group w-64 hover:border-blue-400 transition-colors">
                                                        <button 
                                                            type="button"
                                                            className="absolute -top-2 -right-2 w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center text-[10px] opacity-0 group-hover:opacity-100 transition-opacity z-10 shadow"
                                                            onClick={() => {
                                                                const newItems = [...(templateConfig.stickyNavItems || [])];
                                                                newItems.splice(index, 1);
                                                                handleTemplateDataChange('stickyNavItems', newItems);
                                                            }}
                                                        >
                                                            <X size={12} strokeWidth={3} />
                                                        </button>
                                                        <div className="flex items-center border-b border-gray-100 pb-1 mb-1">
                                                            <i className={`fa-solid ${navItem.icon || 'fa-link'} text-blue-400 text-[10px] w-4 text-center mr-1`}></i>
                                                            <input 
                                                                type="text" 
                                                                className="w-12 text-blue-400 font-mono outline-none text-[10px] border-r border-gray-100 pr-1 mr-1" 
                                                                placeholder="fa-icon" 
                                                                value={navItem.icon || ''}
                                                                onChange={(e) => {
                                                                    const newItems = [...templateConfig.stickyNavItems];
                                                                    newItems[index].icon = e.target.value;
                                                                    handleTemplateDataChange('stickyNavItems', newItems);
                                                                }}
                                                                title="FontAwesome class (e.g. fa-user)"
                                                            />
                                                            <input 
                                                                type="text" 
                                                                className="flex-1 text-sm font-bold text-blue-900 outline-none placeholder-gray-400" 
                                                                placeholder="Nav Label" 
                                                                value={navItem.label}
                                                                onChange={(e) => {
                                                                    const newItems = [...templateConfig.stickyNavItems];
                                                                    newItems[index].label = e.target.value;
                                                                    handleTemplateDataChange('stickyNavItems', newItems);
                                                                }}
                                                            />
                                                        </div>
                                                        <input 
                                                            type="text" 
                                                            className="w-full text-xs text-gray-500 outline-none placeholder-gray-300 bg-transparent" 
                                                            placeholder="URL (e.g. /about)" 
                                                            value={navItem.url}
                                                            onChange={(e) => {
                                                                const newItems = [...templateConfig.stickyNavItems];
                                                                newItems[index].url = e.target.value;
                                                                handleTemplateDataChange('stickyNavItems', newItems);
                                                            }}
                                                        />
                                                    </div>
                                                ))}
                                                {!(templateConfig.stickyNavItems?.length > 0) && (
                                                    <div className="text-xs text-blue-800/50 italic py-2">No sticky nav items. The sticky nav bar will be hidden.</div>
                                                )}
                                            </div>
                                        </div>

                                        {/* Main Content & Sidebar Grid */}
                                        <div className="flex p-8 gap-8 min-h-[600px] max-w-6xl mx-auto">
                                            {/* Sidebar Side */}
                                            <div className={`w-[30%] flex flex-col gap-6 relative transition-all duration-300 ${!templateConfig.sidebarBlocks?.length ? 'hidden' : ''}`}>
                                                {(templateConfig.sidebarBlocks || []).map((block, blockIndex) => {
                                                    if (block.type === 'quickLinks') {
                                                        return (
                                                            <div key={block.id} className="border border-gray-200 rounded p-0 bg-[#f9f9f9] shadow-sm relative group overflow-hidden hover:border-blue-300 transition-colors">
                                                                <button type="button" onClick={() => {
                                                                    const newBlocks = [...templateConfig.sidebarBlocks];
                                                                    newBlocks.splice(blockIndex, 1);
                                                                    handleTemplateDataChange('sidebarBlocks', newBlocks);
                                                                }} className="absolute top-2 right-2 w-6 h-6 bg-red-500 text-white rounded flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition-opacity z-10 shadow">
                                                                    <Trash2 size={12} />
                                                                </button>
                                                                <div className="bg-[#113162] p-4 font-bold text-white flex justify-between items-center rounded-t border-b-2 border-red-600">
                                                                    <input type="text" className="bg-transparent border-b border-transparent hover:border-white/30 focus:border-white text-sm outline-none w-32 uppercase" value={block.title || ''} onChange={(e) => {
                                                                        const newBlocks = [...templateConfig.sidebarBlocks];
                                                                        newBlocks[blockIndex].title = e.target.value;
                                                                        handleTemplateDataChange('sidebarBlocks', newBlocks);
                                                                    }} placeholder="MENU TITLE" />
                                                                    <button type="button" className="text-xs text-white/80 hover:text-white flex items-center gap-1 mr-8" onClick={() => {
                                                                        const newBlocks = [...templateConfig.sidebarBlocks];
                                                                        newBlocks[blockIndex].links = [...(block.links || []), { label: '', url: '#' }];
                                                                        handleTemplateDataChange('sidebarBlocks', newBlocks);
                                                                    }}>
                                                                        <Plus size={12} /> Add Link
                                                                    </button>
                                                                </div>
                                                                <div className="p-0 flex flex-col">
                                                                    {(block.links || []).map((link, linkIndex) => (
                                                                        <div key={linkIndex} className="flex flex-col border-b border-gray-200 bg-white group/link hover:bg-gray-50 relative">
                                                                            <div className="flex p-3 items-center">
                                                                                <div className="w-2 h-2 bg-red-600 rounded-full mr-3 shrink-0"></div>
                                                                                <input type="text" className="flex-1 bg-transparent text-sm font-bold text-[#113162] outline-none placeholder-gray-300" placeholder="Link Label" value={link.label} onChange={(e) => {
                                                                                    const newBlocks = [...templateConfig.sidebarBlocks];
                                                                                    newBlocks[blockIndex].links[linkIndex].label = e.target.value;
                                                                                    handleTemplateDataChange('sidebarBlocks', newBlocks);
                                                                                }} />
                                                                                <button type="button" className="text-gray-300 hover:text-red-500 ml-2 opacity-0 group-hover/link:opacity-100 transition-opacity" onClick={() => {
                                                                                    const newBlocks = [...templateConfig.sidebarBlocks];
                                                                                    newBlocks[blockIndex].links.splice(linkIndex, 1);
                                                                                    handleTemplateDataChange('sidebarBlocks', newBlocks);
                                                                                }}>
                                                                                    <X size={12} strokeWidth={3} />
                                                                                </button>
                                                                            </div>
                                                                            <div className="px-3 pb-3 pt-0 ml-5 flex items-center">
                                                                                <span className="text-[10px] text-gray-400 font-mono mr-2">URL:</span>
                                                                                <input type="text" className="flex-1 text-[11px] text-gray-500 outline-none font-mono bg-gray-50 border border-gray-200 rounded px-2 py-1" placeholder="# or /url-route" value={link.url} onChange={(e) => {
                                                                                    const newBlocks = [...templateConfig.sidebarBlocks];
                                                                                    newBlocks[blockIndex].links[linkIndex].url = e.target.value;
                                                                                    handleTemplateDataChange('sidebarBlocks', newBlocks);
                                                                                }} />
                                                                            </div>
                                                                        </div>
                                                                    ))}
                                                                    {(!block.links || block.links.length === 0) && (
                                                                        <div className="text-xs text-gray-400 text-center py-4 bg-white">No links.</div>
                                                                    )}
                                                                </div>
                                                            </div>
                                                        );
                                                    } else if (block.type === 'textBox') {
                                                        return (
                                                            <div key={block.id} className="relative border border-gray-200 rounded p-1 bg-white flex-1 transition-all duration-300 shadow-sm flex flex-col group hover:border-blue-300">
                                                                <button type="button" onClick={() => {
                                                                    const newBlocks = [...templateConfig.sidebarBlocks];
                                                                    newBlocks.splice(blockIndex, 1);
                                                                    handleTemplateDataChange('sidebarBlocks', newBlocks);
                                                                }} className="absolute -top-3 -right-3 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition-opacity z-20 shadow">
                                                                    <X size={12} strokeWidth={3} />
                                                                </button>
                                                                <div className="bg-gray-50 border-b border-gray-100 p-2 flex justify-between items-center">
                                                                    <span className="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Side Text Box</span>
                                                                </div>
                                                                <RichTextEditor 
                                                                    value={block.content || ''} 
                                                                    onChange={(val) => {
                                                                        const newBlocks = [...templateConfig.sidebarBlocks];
                                                                        newBlocks[blockIndex].content = val;
                                                                        handleTemplateDataChange('sidebarBlocks', newBlocks);
                                                                    }}
                                                                    placeholder="e.g. <h2>Mission</h2><p>...</p>"
                                                                    heightClass="min-h-[200px]"
                                                                />
                                                            </div>
                                                        );
                                                    }
                                                    return null;
                                                })}
                                                
                                                <div className="flex flex-col gap-2 p-4 border-2 border-dashed border-blue-200 rounded-lg bg-blue-50/50 hover:bg-blue-50 transition-colors">
                                                    <div className="text-xs font-bold text-blue-800 text-center uppercase tracking-wider mb-1">Add Sidebar Block</div>
                                                    <div className="flex gap-2">
                                                        <button type="button" onClick={() => {
                                                            const newBlocks = [...(templateConfig.sidebarBlocks || []), { id: Date.now().toString(), type: 'quickLinks', title: 'NEW MENU', links: [] }];
                                                            handleTemplateDataChange('sidebarBlocks', newBlocks);
                                                        }} className="flex-1 text-xs bg-white text-blue-600 border border-blue-200 rounded py-2 font-bold hover:bg-blue-600 hover:text-white transition-colors shadow-sm">
                                                            + Link Menu
                                                        </button>
                                                        <button type="button" onClick={() => {
                                                            const newBlocks = [...(templateConfig.sidebarBlocks || []), { id: Date.now().toString(), type: 'textBox', title: '', content: '' }];
                                                            handleTemplateDataChange('sidebarBlocks', newBlocks);
                                                        }} className="flex-1 text-xs bg-white text-blue-600 border border-blue-200 rounded py-2 font-bold hover:bg-blue-600 hover:text-white transition-colors shadow-sm">
                                                            + Text Box
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            {/* Content Side */}
                                            <div className={`flex-1 transition-all duration-500 ${!templateConfig.sidebarBlocks?.length ? 'w-full' : ''}`}>
                                                <div className="border border-gray-200 rounded p-1 bg-white shadow-sm h-full flex flex-col relative">
                                                    {!templateConfig.sidebarBlocks?.length && (
                                                        <div className="absolute -top-4 -left-4 z-10 flex gap-2">
                                                            <button type="button" onClick={() => {
                                                                handleTemplateDataChange('sidebarBlocks', [{ id: Date.now().toString(), type: 'quickLinks', title: 'QUICK LINKS', links: [] }]);
                                                            }} className="bg-white px-3 py-1.5 rounded shadow border border-gray-200 hover:bg-gray-50 transition-colors text-xs font-bold text-blue-600 uppercase tracking-wider">
                                                                + Add Sidebar
                                                            </button>
                                                        </div>
                                                    )}
                                                    <div className="bg-gray-50 border-b border-gray-100 p-2 text-xs font-bold text-gray-500 uppercase tracking-wider flex justify-between items-center px-4">
                                                        <span>Main Page Content <span className="text-red-500">*</span></span>
                                                    </div>
                                                    <div className="flex-1 flex flex-col gap-4">
                                                        <div>
                                                            <div className="bg-blue-50 text-blue-800 px-3 py-1 text-xs font-bold rounded-t border border-blue-100 border-b-0">English Content</div>
                                                            <RichTextEditor 
                                                                value={formData.content} 
                                                                onChange={(val) => setFormData({...formData, content: val})} 
                                                                placeholder="Write the main article content here..."
                                                                heightClass="min-h-[400px]"
                                                            />
                                                        </div>
                                                        <div>
                                                            <div className="bg-orange-50 text-orange-800 px-3 py-1 text-xs font-bold rounded-t border border-orange-100 border-b-0">Hindi Content</div>
                                                            <RichTextEditor 
                                                                value={formData.contentHi} 
                                                                onChange={(val) => setFormData({...formData, contentHi: val})} 
                                                                placeholder="Write the Hindi translated content here (Leave blank to use auto-translation)..."
                                                                heightClass="min-h-[400px]"
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
