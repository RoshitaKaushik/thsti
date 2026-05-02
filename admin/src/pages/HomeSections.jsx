import { useState, useEffect, useRef } from 'react';
import { PUBLIC_SITE_URL } from '../config/env';
import { Save, Plus, Trash2, Image as ImageIcon, ExternalLink } from 'lucide-react';
import { toast } from 'react-hot-toast';
import api from '../api/axios';
import AdminPageLayout from '../components/AdminPageLayout';
import MediaSelector from '../components/MediaSelector';

export default function HomeSections() {
    const [loading, setLoading] = useState(true);
    const [isSaving, setIsSaving] = useState(false);

    const [formData, setFormData] = useState({
        title: '',
        subtitle: '',
        description: '',
        imageUrl: '',
        ctaText: '',
        ctaLink: '',
        isActive: true,
    });

    const defaultCounters = [
        { key: 'students', label: '', value: 0, suffix: '+' },
        { key: 'faculty', label: '', value: 0, suffix: '+' },
        { key: 'eep_participants', label: '', value: 0, suffix: '+' },
        { key: 'eep_days', label: '', value: 0, suffix: '+' }
    ];
    const [counters, setCounters] = useState(defaultCounters);
    const [allowSlider, setAllowSlider] = useState(true);

    const fetchAboutSection = async () => {
        try {
            const res = await api.get('/home-sections');
            const about = res.data.find(s => s.sectionType === 'ABOUT');
            if (about) {
                setFormData({
                    title: about.title || '',
                    subtitle: about.subtitle || '',
                    description: about.description || '',
                    imageUrl: about.imageUrl || '',
                    ctaText: about.ctaText || '',
                    ctaLink: about.ctaLink || '',
                    isActive: about.isActive
                });

                if (about.metadata) {
                    if (Array.isArray(about.metadata)) {
                        setCounters(about.metadata);
                        setAllowSlider(false);
                    } else if (about.metadata.counters) {
                        setCounters(about.metadata.counters);
                        setAllowSlider(about.metadata.allowSlider ?? false);
                    } else {
                        setCounters(defaultCounters);
                        setAllowSlider(false);
                    }
                } else {
                    setCounters(defaultCounters);
                    setAllowSlider(false);
                }
            }
        } catch (err) {
            console.error('Failed to fetch ABOUT section', err);
            toast.error('Failed to load Intro Section');
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchAboutSection();
    }, []);

    const handleChange = (e) => {
        const { name, value, type, checked } = e.target;
        setFormData(prev => ({
            ...prev,
            [name]: type === 'checkbox' ? checked : value
        }));
    };

    const handleCounterChange = (index, field, value) => {
        setCounters(prev => {
            const newCounters = [...prev];
            newCounters[index] = {
                ...newCounters[index],
                [field]: field === 'value' ? (parseFloat(value) || 0) : value
            };
            return newCounters;
        });
    };

    const addCounter = () => {
        setCounters(prev => [...prev, { key: `COUNTER_${Date.now()}`, label: '', value: 0, suffix: '+' }]);
    };

    const removeCounter = (index) => {
        setCounters(prev => prev.filter((_, i) => i !== index));
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setIsSaving(true);
        try {
            const payload = {
                ...formData,
                metadata: { allowSlider, counters }
            };

            await api.put(`/home-sections/ABOUT`, payload);
            toast.success('Successfully saved changes!');
            fetchAboutSection();
        } catch (err) {
            toast.error(err.response?.data?.error || 'Failed to save section');
        } finally {
            setIsSaving(false);
        }
    };

    if (loading) return <div className="p-8 text-gray-500 font-bold">Loading Homepage Intro Data...</div>;

    const actionButtons = (
        <a href={`${PUBLIC_SITE_URL}/#about-intro`} target="_blank" rel="noopener noreferrer" className="flex items-center justify-center gap-2 py-2 px-4 text-sm bg-white border border-border-light rounded hover:bg-stone-50 text-secondary font-bold shadow-sm transition-colors">
            <ExternalLink size={16} /> Preview on Live Site
        </a>
    );

    return (
        <AdminPageLayout title="Homepage Intro (About)" subtitle="Manage the static introduction paragraph and the statistical counters." actionButtons={actionButtons}>
            <div className="admin-card bg-white shadow-sm border border-border-light p-6 overflow-y-auto">
                <form onSubmit={handleSubmit} className="space-y-6 max-w-4xl mx-auto pb-10">
                    
                    <div className="bg-gradient-to-r from-rose-50 to-white border border-rose-100 rounded-xl p-5 mb-8 flex items-center gap-4 shadow-sm">
                        <div className="w-12 h-12 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center font-bold text-xl ring-4 ring-white shadow">i</div>
                        <div>
                            <h3 className="text-secondary font-bold text-lg leading-tight">THSTI Intro Block</h3>
                            <p className="text-sm text-text-muted mt-0.5">Control the primary "About Us" messaging that immediately follows the Hero banner.</p>
                        </div>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div className="md:col-span-2">
                            <label className="block text-xs font-bold text-stone-600 uppercase tracking-widest mb-1.5">Heading</label>
                            <input type="text" name="title" className="admin-input font-bold text-lg" value={formData.title} onChange={handleChange} required />
                        </div>

                        <div className="md:col-span-2">
                            <label className="block text-xs font-bold text-stone-600 uppercase tracking-widest mb-1.5">Subtitle (Optional Colored Text)</label>
                            <input type="text" name="subtitle" className="admin-input" value={formData.subtitle} onChange={handleChange} placeholder="e.g. Advancing Science" />
                        </div>

                        <div className="md:col-span-2">
                            <label className="block text-xs font-bold text-stone-600 uppercase tracking-widest mb-1.5">Main Content Paragraphs (HTML / Text)</label>
                            <textarea name="description" className="admin-input h-40 text-sm leading-relaxed" value={formData.description} onChange={handleChange} placeholder="Enter the introductory text here..." />
                        </div>

                        {/* Image Upload */}
                        <div className="md:col-span-2">
                            <MediaSelector
                                label="Side Featured Image"
                                value={formData.imageUrl}
                                onChange={(url) => setFormData({ ...formData, imageUrl: url })}
                                accept="image/png, image/jpeg, image/webp"
                            />
                        </div>

                        {/* CTA */}
                        <div className="md:col-span-1">
                            <label className="block text-xs font-bold text-stone-600 uppercase tracking-widest mb-1.5">Action Button Text</label>
                            <input type="text" name="ctaText" className="admin-input" value={formData.ctaText} onChange={handleChange} placeholder="e.g. Read More" />
                        </div>
                        <div className="md:col-span-1">
                            <label className="block text-xs font-bold text-stone-600 uppercase tracking-widest mb-1.5">Action Button Link URL</label>
                            <input type="text" name="ctaLink" className="admin-input" value={formData.ctaLink} onChange={handleChange} placeholder="e.g. /about" />
                        </div>

                        {/* Counters */}
                        <div className="md:col-span-2 border-t border-border-light pt-6 mt-4">
                            <div className="flex justify-between items-center mb-4">
                                <div>
                                    <h4 className="text-lg font-bold text-secondary">Statistical Counters</h4>
                                    <p className="text-sm text-text-muted mt-1">The animated numbers displayed below the text.</p>
                                </div>
                                <button type="button" onClick={addCounter} className="text-accent hover:text-rose-700 flex items-center gap-1 text-sm font-bold bg-rose-50 px-3 py-1.5 rounded transition-colors border border-rose-100">
                                    <Plus size={16} /> Add Custom Counter
                                </button>
                            </div>
                            
                            <div className="space-y-3 bg-stone-50 p-4 border border-stone-200 rounded-lg">
                                {counters.length === 0 ? (
                                    <div className="text-sm text-stone-500 italic text-center py-4">No counters configured.</div>
                                ) : (
                                    counters.map((counter, idx) => (
                                        <div key={idx} className="flex flex-col sm:flex-row gap-3 items-center bg-white p-3 border border-stone-200 rounded shadow-sm relative group">
                                            
                                            <div className="flex-1 w-full">
                                                <label className="text-[10px] font-bold text-stone-400 uppercase tracking-wide block mb-1">Display Label</label>
                                                <input type="text" className="admin-input text-sm py-1.5" value={counter.label} onChange={(e) => handleCounterChange(idx, 'label', e.target.value)} placeholder="e.g. STUDENTS" />
                                            </div>

                                            <div className="w-full sm:w-24">
                                                <label className="text-[10px] font-bold text-stone-400 uppercase tracking-wide block mb-1">Number</label>
                                                <input type="number" min="0" className="admin-input text-sm py-1.5 font-mono text-center" value={counter.value} onChange={(e) => handleCounterChange(idx, 'value', e.target.value)} placeholder="0" />
                                            </div>

                                            <div className="w-full sm:w-20">
                                                <label className="text-[10px] font-bold text-stone-400 uppercase tracking-wide block mb-1">Suffix</label>
                                                <input type="text" className="admin-input text-sm py-1.5 text-center bg-stone-50 font-bold" value={counter.suffix} onChange={(e) => handleCounterChange(idx, 'suffix', e.target.value)} placeholder="e.g. +" />
                                            </div>

                                            <button type="button" onClick={() => removeCounter(idx)} className="mt-4 sm:mt-0 p-2 text-stone-400 hover:text-red-600 hover:bg-red-50 rounded transition-colors self-end sm:self-center tooltip" title="Remove Counter">
                                                <Trash2 size={18} />
                                            </button>
                                        </div>
                                    ))
                                )}
                            </div>
                        </div>

                    </div>

                    <div className="flex items-center justify-between border-t border-border-light pt-6 mt-8">
                        <label className="flex items-center gap-3 cursor-pointer p-2 rounded-lg hover:bg-stone-50 transition-colors">
                            <div className="relative">
                                <input type="checkbox" name="isActive" className="sr-only" checked={formData.isActive} onChange={handleChange} />
                                <div className={`block w-14 h-8 rounded-full transition-colors ${formData.isActive ? 'bg-green-500' : 'bg-stone-300'}`}></div>
                                <div className={`absolute left-1.5 top-1.5 bg-white w-5 h-5 rounded-full transition-transform ${formData.isActive ? 'translate-x-6' : ''}`}></div>
                            </div>
                            <span className="font-bold text-secondary text-sm">Publish Intro to Homepage</span>
                        </label>

                        <button type="submit" disabled={isSaving} className={`admin-btn-primary flex items-center justify-center gap-2 px-8 py-2.5 text-base shadow-md hover:shadow-lg transition-all ${isSaving ? 'opacity-70 cursor-wait' : ''}`}>
                            <Save size={20} /> {isSaving ? 'Saving...' : 'Save Intro Settings'}
                        </button>
                    </div>
                </form>
            </div>
        </AdminPageLayout>
    );
}
