import React, { useState, useEffect } from 'react';
import api from '../api/axios';

const SectionSettings = ({ type, defaultTitle }) => {
    const [loading, setLoading] = useState(true);
    const [saving, setSaving] = useState(false);
    const [statusIndicator, setStatusIndicator] = useState(null);
    const [formData, setFormData] = useState({
        title: defaultTitle || '',
        isActive: true,
    });

    useEffect(() => {
        api.get('/home-sections')
            .then(res => {
                const section = res.data.find(s => s.sectionType === type);
                if (section) {
                    setFormData({
                        title: section.title,
                        isActive: section.isActive
                    });
                }
                setLoading(false);
            })
            .catch(err => {
                console.error("Failed to load section settings", err);
                setLoading(false);
            });
    }, [type]);

    const handleSave = async () => {
        setSaving(true);
        setStatusIndicator(null);
        try {
            await api.put(`/home-sections/${type}`, {
                ...formData,
                description: '',
                subtitle: '',
                imageUrl: '',
                ctaText: '',
                ctaLink: ''
            });
            setStatusIndicator({ type: 'success', text: 'Saved successfully!' });
            setTimeout(() => setStatusIndicator(null), 3000);
        } catch (error) {
            setStatusIndicator({ type: 'error', text: 'Failed to save.' });
            console.error(error);
        } finally {
            setSaving(false);
        }
    };

    if (loading) return (
        <div className="mb-8 bg-gray-50 animate-pulse rounded-xl h-24 border border-gray-200/60 shadow-soft"></div>
    );

    return (
        <div className="mb-8 bg-gradient-to-r from-gray-50 via-white to-gray-50 backdrop-blur-md border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow duration-300">
            <div className="flex flex-col md:flex-row md:items-center justify-between gap-6">
                
                {/* Left side: branding/desc */}
                <div className="flex items-center gap-4 flex-1">
                    <div className="w-10 h-10 rounded-full bg-stone-100 border border-stone-200 flex items-center justify-center text-stone-500 shadow-inner">
                        <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    </div>
                    <div>
                        <h3 className="text-secondary font-bold" style={{fontSize: '1.05rem', lineHeight: '1.2'}}>Homepage Header</h3>
                        <p className="text-xs text-stone-500 mt-1">Override the main title & toggle global visibility.</p>
                    </div>
                </div>
                
                {/* Right side: controls */}
                <div className="flex flex-col sm:flex-row sm:items-center items-end gap-5">
                    
                    {/* Input */}
                    <div className="flex items-center gap-2">
                        <label className="text-xs font-semibold text-stone-600 uppercase tracking-wider">Heading:</label>
                        <input 
                            type="text" 
                            className="bg-white border border-stone-300 rounded px-3 py-1.5 text-sm w-48 text-stone-700 shadow-sm focus:ring-2 focus:ring-rose-500/20 focus:border-rose-400 outline-none transition-all" 
                            value={formData.title} 
                            placeholder={defaultTitle}
                            onChange={e => setFormData({...formData, title: e.target.value})} 
                        />
                    </div>
                    
                    {/* Toggle */}
                    <div className="flex items-center gap-3 sm:border-l border-stone-200 sm:pl-5">
                        <span className={`text-xs font-bold tracking-wide uppercase ${formData.isActive ? 'text-green-600' : 'text-stone-400'}`}>
                            {formData.isActive ? 'Published' : 'Hidden'}
                        </span>
                        <button 
                            type="button" 
                            onClick={() => setFormData({...formData, isActive: !formData.isActive})}
                            className={`relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-rose-500 focus-visible:ring-offset-2 ${formData.isActive ? 'bg-green-500' : 'bg-stone-300 shadow-inner'}`}
                        >
                            <span className={`pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out ${formData.isActive ? 'translate-x-5' : 'translate-x-0'}`}></span>
                        </button>
                    </div>

                    {/* Button */}
                    <div className="sm:border-l border-stone-200 sm:pl-5 relative">
                        <button 
                            type="button" 
                            onClick={handleSave} 
                            disabled={saving}
                            className="bg-secondary hover:bg-blue-900 text-white text-xs font-bold px-4 py-2 rounded shadow-md transition-all flex items-center justify-center min-w-[70px]"
                        >
                            {saving ? (
                                <svg className="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                                    <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            ) : 'SAVE'}
                        </button>

                        {/* Status Popup */}
                        {statusIndicator && (
                            <div className={`absolute -top-10 left-1/2 transform -translate-x-1/2 px-3 py-1 rounded text-xs font-bold whitespace-nowrap shadow animation-fade-in ${statusIndicator.type === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'}`}>
                                {statusIndicator.text}
                            </div>
                        )}
                    </div>

                </div>
            </div>
        </div>
    );
};

export default SectionSettings;
