import React, { useState, useEffect } from 'react';
import api from '../api/axios';
import SectionSettings from '../components/SectionSettings';
import AdminPageLayout from '../components/AdminPageLayout';
import AdminModal from '../components/AdminModal';
import MediaSelector from '../components/MediaSelector';
import { DragDropContext, Droppable, Draggable } from '@hello-pangea/dnd';
import { Edit2, Trash2, GripVertical, Check, X, FileVideo, Image as ImageIcon } from 'lucide-react';
import toast from 'react-hot-toast';

export default function HeroSlides() {
    const [slides, setSlides] = useState([]);
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [editingSlide, setEditingSlide] = useState(null);
    
    // Auth State
    const currentUser = JSON.parse(localStorage.getItem('thsti_admin_user') || '{}');
    const isExecutive = currentUser?.role === 'Executive';
    // Form State
    const [formData, setFormData] = useState({
        title: '',
        subtitle: '',
        type: 'IMAGE',
        mediaUrl: '',
        posterUrl: '',
        isActiveVideo: false,
        isActive: true,
        openInNewTab: false,
        routeUrl: '',
        showText: true,
        reviewStatus: 'Draft',
        remarks: ''
    });

    useEffect(() => {
        fetchSlides();
    }, []);

    const [filterState, setFilterState] = useState('ALL');

    const fetchSlides = async () => {
        try {
            const res = await api.get('/hero-slides/all');
            setSlides(res.data);
        } catch {
            toast.error("Failed to fetch slides");
        }
    };


    const handleDragEnd = async (result) => {
        if (!result.destination) return;
        const items = Array.from(slides);
        const [reorderedItem] = items.splice(result.source.index, 1);
        items.splice(result.destination.index, 0, reorderedItem);

        const updatedItems = items.map((item, index) => ({ ...item, displayOrder: index }));
        setSlides(updatedItems);

        try {
            await api.patch('/hero-slides/reorder', {
                items: updatedItems.map(item => ({ id: item.id, order: item.displayOrder }))
            });
            toast.success("Order saved");
        } catch {
            toast.error("Failed to save order");
            fetchSlides();
        }
    };

    const [isSaving, setIsSaving] = useState(false);


    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            setIsSaving(true);

            if (!formData.mediaUrl) {
                toast.error("Media source is required");
                return;
            }

            const payload = { ...formData };
            if (payload.type !== 'VIDEO') {
                payload.posterUrl = '';
            }

            if (editingSlide) {
                await api.put(`/hero-slides/${editingSlide.id}`, payload);
                toast.success("Slide updated");
            } else {
                await api.post('/hero-slides', { ...payload, displayOrder: slides.length });
                toast.success("Slide created");
            }
            setIsModalOpen(false);
            fetchSlides();
        } catch (error) {
            toast.error(error.response?.data?.error || "Failed to save slide");
        } finally {
            setIsSaving(false);
        }
    };

    const handleArchiveToggle = async (slide) => {
        try {
            const payload = { ...slide, isArchived: !slide.isArchived };
            await api.put(`/hero-slides/${slide.id}`, payload);
            toast.success(`Slide ${slide.isArchived ? 'unarchived' : 'archived'} successfully`);
            fetchSlides();
        } catch {
            toast.error("Failed to modify slide archival status");
        }
    };

    const toggleStatus = async (id) => {
        try {
            await api.patch(`/hero-slides/${id}/toggle-active`);
            fetchSlides();
        } catch {
            toast.error("Failed to toggle status");
        }
    };

    const filteredSlides = slides.filter(item => {
        if (filterState === 'ACTIVE') return !item.isArchived;
        if (filterState === 'ARCHIVED') return item.isArchived;
        return true;
    });

    const openModal = (slide = null) => {
        if (slide) {
            setEditingSlide(slide);
            setFormData({
                title: slide.title || '',
                subtitle: slide.subtitle || '',
                type: slide.type || 'IMAGE',
                mediaUrl: slide.mediaUrl || '',
                posterUrl: slide.posterUrl || '',
                isActiveVideo: slide.isActiveVideo || false,
                isActive: slide.isActive ?? true,
                openInNewTab: slide.openInNewTab || false,
                routeUrl: slide.routeUrl || '',
                showText: slide.showText ?? true,
                reviewStatus: slide.reviewStatus || 'Draft',
                remarks: slide.remarks || ''
            });
        } else {
            setEditingSlide(null);
            setFormData({
                title: '', subtitle: '', type: 'IMAGE', mediaUrl: '', posterUrl: '',
                isActiveVideo: false, isActive: true, openInNewTab: false, routeUrl: '', showText: true, reviewStatus: 'Draft', remarks: ''
            });
        }
        setIsModalOpen(true);
    };

    return (
        <AdminPageLayout
            title="Hero Slider"
            subtitle="Manage image and video slides for the homepage"
            actionButtons={
                <button
                    onClick={() => openModal()}
                    className="bg-[var(--primary)] text-white px-4 py-2 rounded shadow hover:bg-red-800 transition-colors"
                >
                    + Add New Slide (Video / Image)
                </button>
            }
        >
            <SectionSettings type="HERO" defaultTitle="Top Hero Slider" />
            <div className="mb-4 flex justify-end">
                <select 
                    value={filterState} 
                    onChange={(e) => setFilterState(e.target.value)}
                    className="border border-gray-300 rounded px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="ALL">All Items</option>
                    <option value="ACTIVE">Active (Live)</option>
                    <option value="ARCHIVED">🗄️ Archived</option>
                </select>
            </div>
            <div className="bg-white rounded-lg shadow-sm overflow-hidden">
                <DragDropContext onDragEnd={handleDragEnd}>
                    <Droppable droppableId="slidesList">
                        {(provided) => (
                            <div {...provided.droppableProps} ref={provided.innerRef}>
                                <table className="min-w-full divide-y divide-gray-200">
                                    <thead className="bg-gray-50">
                                        <tr>
                                            <th className="w-10 px-4 py-3"></th>
                                            <th className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                            <th className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Media</th>
                                            <th className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Primary Video</th>
                                            <th className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                            <th className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Workflow</th>
                                            <th className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Archived</th>
                                            <th className="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody className="bg-white divide-y divide-gray-200">
                                        {filteredSlides.map((slide, index) => (
                                            <Draggable key={slide.id.toString()} draggableId={slide.id.toString()} index={index}>
                                                {(provided, snapshot) => (
                                                    <tr
                                                        ref={provided.innerRef}
                                                        {...provided.draggableProps}
                                                        className={`${snapshot.isDragging ? 'bg-blue-50' : 'hover:bg-gray-50'} transition-colors ${slide.isArchived ? 'opacity-60 grayscale' : ''}`}
                                                    >
                                                        <td className="px-4 py-4 text-gray-400">
                                                            <div {...provided.dragHandleProps} className="cursor-grab hover:text-gray-600">
                                                                <GripVertical size={18} />
                                                            </div>
                                                        </td>
                                                        <td className="px-4 py-4">
                                                            {slide.type === 'VIDEO' ? <FileVideo className="text-blue-500" size={24} /> : <ImageIcon className="text-green-500" size={24} />}
                                                        </td>
                                                        <td className="px-4 py-4 text-sm font-medium text-gray-900 truncate max-w-[200px]">
                                                            {slide.mediaUrl}
                                                        </td>
                                                        <td className="px-4 py-4">
                                                            {slide.isActiveVideo ?
                                                                <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Active Video</span>
                                                                : <span className="text-gray-400 text-xs">-</span>
                                                            }
                                                        </td>
                                                        <td className="px-4 py-4">
                                                            <button
                                                                onClick={() => toggleStatus(slide.id)}
                                                                className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${slide.isActive ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200'}`}
                                                            >
                                                                {slide.isActive ? 'Active' : 'Inactive'}
                                                            </button>
                                                        </td>
                                                        <td className="px-4 py-4">
                                                            <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                                ${slide.reviewStatus === 'Published' ? 'bg-blue-100 text-blue-800' : 
                                                                  slide.reviewStatus === 'PendingReview' ? 'bg-yellow-100 text-yellow-800' : 
                                                                  slide.reviewStatus === 'Rejected' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800'}
                                                            `}>
                                                                {slide.reviewStatus || 'Draft'}
                                                            </span>
                                                        </td>
                                                        <td className="px-4 py-4">
                                                            {slide.isArchived ? <span className="text-amber-600 font-bold text-xs">🗄️ ARCHIVED</span> : <span className="text-green-600 font-medium text-xs">Visible</span>}
                                                        </td>
                                                        <td className="px-4 py-4 text-right text-sm">
                                                            <div className="flex justify-end gap-3">
                                                                <button onClick={() => openModal(slide)} title="Edit Slide" className="text-gray-400 hover:text-primary">
                                                                    <Edit2 size={18} />
                                                                </button>
                                                                <button onClick={() => handleArchiveToggle(slide)} title={slide.isArchived ? "Unarchive" : "Archive"} className="text-gray-400 hover:text-amber-600">
                                                                    {slide.isArchived ? <span className="text-lg">👁️</span> : <span className="text-lg">🗄️</span>}
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                )}
                                            </Draggable>
                                        ))}
                                        {provided.placeholder}
                                    </tbody>
                                </table>
                            </div>
                        )}
                    </Droppable>
                </DragDropContext>
            </div>

            <AdminModal
                isOpen={isModalOpen}
                onClose={() => setIsModalOpen(false)}
                title={editingSlide ? 'Edit Slide' : 'Add New Slide'}
            >
                <form onSubmit={handleSubmit} className="space-y-4">
                    <div className="grid grid-cols-2 gap-4">
                        <div className="col-span-2 sm:col-span-1">
                            <label className="block text-sm font-medium text-gray-700 mb-1">Type</label>
                            <select
                                value={formData.type}
                                onChange={(e) => setFormData({ ...formData, type: e.target.value })}
                                className="w-full border border-gray-300 rounded-md p-2"
                                required
                            >
                                <option value="IMAGE">Image</option>
                                <option value="VIDEO">Video</option>
                            </select>
                        </div>
                        <div className="col-span-2 sm:col-span-1 flex items-end pb-2">
                            <label className="flex items-center space-x-2 cursor-pointer">
                                <input
                                    type="checkbox"
                                    checked={formData.isActiveVideo}
                                    onChange={(e) => setFormData({ ...formData, isActiveVideo: e.target.checked })}
                                    className="rounded border-gray-300 text-[var(--primary)] focus:ring-[var(--primary)]"
                                    disabled={formData.type !== 'VIDEO'}
                                />
                                <span className="text-sm text-gray-700">Set as Active Autoplay Video</span>
                            </label>
                        </div>
                    </div>

                    <MediaSelector
                        label="Media Source (Required)"
                        value={formData.mediaUrl}
                        onChange={(url) => setFormData({ ...formData, mediaUrl: url })}
                        accept={formData.type === 'VIDEO' ? "video/*" : "image/*"}
                        placeholder="Enter Google Drive link or direct URL"
                    />

                    {formData.type === 'VIDEO' && (
                        <MediaSelector
                            label="Fallback Poster Image (Required for Video)"
                            value={formData.posterUrl}
                            onChange={(url) => setFormData({ ...formData, posterUrl: url })}
                            accept="image/*"
                            placeholder="Enter direct Image URL"
                        />
                    )}

                    <div className="grid grid-cols-2 gap-4">
                        <div>
                            <label className="block text-sm font-medium text-gray-700 mb-1">Title (Optional)</label>
                            <input
                                type="text"
                                value={formData.title}
                                onChange={(e) => setFormData({ ...formData, title: e.target.value })}
                                className="w-full border border-gray-300 rounded-md p-2"
                            />
                        </div>
                        <div>
                            <label className="block text-sm font-medium text-gray-700 mb-1">Subtitle (Optional)</label>
                            <input
                                type="text"
                                value={formData.subtitle}
                                onChange={(e) => setFormData({ ...formData, subtitle: e.target.value })}
                                className="w-full border border-gray-300 rounded-md p-2"
                            />
                        </div>
                    </div>

                    <div>
                        <label className="block text-sm font-medium text-gray-700 mb-1">Route / Link URL (Optional)</label>
                        <input
                            type="text"
                            value={formData.routeUrl}
                            onChange={(e) => setFormData({ ...formData, routeUrl: e.target.value })}
                            className="w-full border border-gray-300 rounded-md p-2"
                            placeholder="e.g. /about or https://google.com"
                        />
                    </div>
                    <div className="flex gap-4">
                        <label className="flex items-center space-x-2 cursor-pointer">
                            <input
                                type="checkbox"
                                checked={formData.openInNewTab}
                                onChange={(e) => setFormData({ ...formData, openInNewTab: e.target.checked })}
                                className="rounded border-gray-300 text-[var(--primary)] focus:ring-[var(--primary)]"
                            />
                            <span className="text-sm text-gray-700">Open link in new tab</span>
                        </label>
                        <label className="flex items-center space-x-2 cursor-pointer">
                            <input
                                type="checkbox"
                                checked={formData.isActive}
                                onChange={(e) => setFormData({ ...formData, isActive: e.target.checked })}
                                className="rounded border-gray-300 text-[var(--primary)] focus:ring-[var(--primary)]"
                            />
                            <span className="text-sm text-gray-700">Active</span>
                        </label>
                        <label className="flex items-center space-x-2 cursor-pointer">
                            <input
                                type="checkbox"
                                checked={formData.showText}
                                onChange={(e) => setFormData({ ...formData, showText: e.target.checked })}
                                className="rounded border-gray-300 text-[var(--primary)] focus:ring-[var(--primary)]"
                            />
                            <span className="text-sm text-gray-700">Show Text on Slide</span>
                        </label>
                    </div>

                    {!isExecutive && (
                        <div className="mt-4 p-3 bg-gray-50 border rounded-md">
                            <label className="block text-sm font-medium text-gray-700 mb-2">Workflow Status</label>
                            <select
                                value={formData.reviewStatus || 'Draft'}
                                onChange={(e) => setFormData({ ...formData, reviewStatus: e.target.value })}
                                className="w-full border border-gray-300 rounded-md p-2"
                            >
                                <option value="Draft">Draft</option>
                                <option value="PendingReview">Pending Review</option>
                                <option value="Published">Published</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                    )}
                    {isExecutive && formData.reviewStatus === 'Rejected' && (
                        <div className="mt-4 p-3 bg-red-50 border border-red-200 rounded-md">
                            <p className="text-sm text-red-700 font-bold">This slide was rejected by the manager.</p>
                            {formData.remarks && <p className="text-sm text-red-600 mt-1">Remarks: {formData.remarks}</p>}
                        </div>
                    )}

                    <div className="flex justify-end pt-4 border-t">
                        <button
                            type="button"
                            onClick={() => setIsModalOpen(false)}
                            disabled={isSaving}
                            className={`mr-2 px-4 py-2 text-gray-600 hover:text-gray-800 ${isSaving ? 'opacity-50 cursor-not-allowed' : ''}`}
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            disabled={isSaving}
                            className={`px-4 py-2 bg-[var(--primary)] text-white rounded shadow hover:bg-red-800 flex items-center gap-2 ${isSaving ? 'opacity-50 cursor-wait' : ''}`}
                        >
                            {isSaving ? 'Saving...' : (isExecutive ? (editingSlide ? 'Update Draft' : 'Submit for Review') : (editingSlide ? 'Update Slide' : 'Publish Slide'))}
                        </button>
                    </div>
                </form>
            </AdminModal>
        </AdminPageLayout>
    );
}
