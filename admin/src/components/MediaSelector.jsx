import React, { useState, useEffect, useRef } from 'react';
import api from '../api/axios';
import { toast } from 'react-hot-toast';
import { FileUp, Image as ImageIcon, Link as LinkIcon, Library, Loader2 } from 'lucide-react';
import { ASSETS_BASE_URL, PUBLIC_SITE_URL } from '../config/env';

export default function MediaSelector({ 
    label = "Media Source", 
    value = "", 
    onChange, 
    accept = "image/*",
    placeholder = "Enter URL"
}) {
    const [mediaOpt, setMediaOpt] = useState('LIBRARY');
    const [mediaList, setMediaList] = useState([]);
    const [isUploading, setIsUploading] = useState(false);
    const [customUrl, setCustomUrl] = useState('');
    const [selectedFile, setSelectedFile] = useState(null);
    const [altText, setAltText] = useState('');
    const fileInputRef = useRef(null);

    useEffect(() => {
        fetchMedia();
    }, []);

    const fetchMedia = async () => {
        try {
            const res = await api.get('/media');
            setMediaList(res.data);
        } catch (err) {
            console.error("Failed to fetch media library:", err);
        }
    };

    // Auto-detect mode based on initial value
    useEffect(() => {
        if (value && mediaList.length > 0) {
            const isInLibrary = mediaList.some(m => m.url === value);
            if (!isInLibrary && mediaOpt === 'LIBRARY') {
                setMediaOpt('URL');
                setCustomUrl(value);
            }
        }
        // Sync URL text input if external prop changes
        if (mediaOpt === 'URL' && value !== customUrl) {
            setCustomUrl(value);
        }
    }, [value, mediaList]);

    const handleUrlChange = (e) => {
        setCustomUrl(e.target.value);
        onChange(e.target.value);
    };

    const handleFileSelect = (e) => {
        const file = e.target.files[0];
        if (!file) {
            setSelectedFile(null);
            return;
        }
        setSelectedFile(file);
    };

    const handleUpload = async () => {
        if (!selectedFile) return;
        
        const isImage = selectedFile.type.startsWith('image/');
        if (isImage && !altText.trim()) {
            toast.error("Alt text is mandatory for images to comply with GIGW guidelines.");
            return;
        }

        const payload = new FormData();
        payload.append('file', selectedFile);
        if (altText) payload.append('altText', altText);
        
        setIsUploading(true);
        try {
            const res = await api.post('/media/upload', payload, { 
                headers: { 'Content-Type': 'multipart/form-data' }
            });
            toast.success("File uploaded to Media Library");
            await fetchMedia(); 
            setMediaOpt('LIBRARY');
            setAltText('');
            setSelectedFile(null);
            onChange(res.data.url);
        } catch (err) {
            toast.error(err.response?.data?.error || "Failed to upload file");
        } finally {
            setIsUploading(false);
            if (fileInputRef.current) fileInputRef.current.value = '';
        }
    };

    // Helper for generating reliable image sources
    const getPreviewUrl = (urlStr) => {
        if (!urlStr) return '';
        if (urlStr.startsWith('http')) return urlStr;
        if (urlStr.startsWith('images/') || urlStr.startsWith('/images/')) {
            return `${PUBLIC_SITE_URL}${urlStr.startsWith('/') ? '' : '/'}${urlStr}`;
        }
        return `${ASSETS_BASE_URL}${urlStr.startsWith('/') ? '' : '/'}${urlStr}`;
    };

    return (
        <div className="border border-border-light rounded-lg p-4 bg-gray-50 shadow-sm relative">
            {label && <label className="block text-sm font-bold text-secondary mb-3">{label}</label>}
            
            <div className="flex flex-wrap gap-4 mb-4 border-b border-gray-200 pb-3">
                <label className="flex items-center space-x-1.5 cursor-pointer group">
                    <input type="radio" value="LIBRARY" checked={mediaOpt === 'LIBRARY'} onChange={() => { setMediaOpt('LIBRARY'); onChange(''); }} className="text-[var(--primary)] focus:ring-[var(--primary)] rounded-full h-4 w-4" />
                    <Library size={16} className={mediaOpt === 'LIBRARY' ? 'text-[var(--primary)]' : 'text-gray-400 group-hover:text-gray-600'} />
                    <span className={`text-sm font-bold ${mediaOpt === 'LIBRARY' ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-700'}`}>Media Library</span>
                </label>
                <label className="flex items-center space-x-1.5 cursor-pointer group">
                    <input type="radio" value="UPLOAD" checked={mediaOpt === 'UPLOAD'} onChange={() => setMediaOpt('UPLOAD')} className="text-[var(--primary)] focus:ring-[var(--primary)] rounded-full h-4 w-4" />
                    <FileUp size={16} className={mediaOpt === 'UPLOAD' ? 'text-[var(--primary)]' : 'text-gray-400 group-hover:text-gray-600'} />
                    <span className={`text-sm font-bold ${mediaOpt === 'UPLOAD' ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-700'}`}>Upload New File</span>
                </label>
                <label className="flex items-center space-x-1.5 cursor-pointer group">
                    <input type="radio" value="URL" checked={mediaOpt === 'URL'} onChange={() => { setMediaOpt('URL'); setCustomUrl(value); }} className="text-[var(--primary)] focus:ring-[var(--primary)] rounded-full h-4 w-4" />
                    <LinkIcon size={16} className={mediaOpt === 'URL' ? 'text-[var(--primary)]' : 'text-gray-400 group-hover:text-gray-600'} />
                    <span className={`text-sm font-bold ${mediaOpt === 'URL' ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-700'}`}>External URL</span>
                </label>
            </div>

            <div className="min-h-[42px] flex items-center">
                {mediaOpt === 'LIBRARY' && (
                    <select value={value || ''} onChange={(e) => onChange(e.target.value)} className="admin-input w-full bg-white font-mono text-xs">
                        <option value="">-- Select a file from the Media Library --</option>
                        {Array.from(new Map(mediaList.map(m => [m.filename, m])).values()).map(m => (
                            <option key={m.id} value={m.url}>{m.filename}</option>
                        ))}
                    </select>
                )}

                {mediaOpt === 'UPLOAD' && (
                    <div className="w-full flex flex-col gap-3 border border-gray-200 bg-white p-3 rounded">
                        <input 
                            type="file" 
                            ref={fileInputRef}
                            onChange={handleFileSelect} 
                            className="admin-input p-1 cursor-pointer w-full bg-gray-50" 
                            accept={accept}
                            disabled={isUploading}
                        />
                        {selectedFile && (
                            <div className="flex flex-col gap-2 border-t pt-3 mt-1">
                                {selectedFile.type.startsWith('image/') && (
                                    <div>
                                        <label className="block text-xs font-bold text-gray-700 mb-1">
                                            Alt Text <span className="text-red-500">*</span> (Required for GIGW)
                                        </label>
                                        <input 
                                            type="text" 
                                            value={altText}
                                            onChange={(e) => setAltText(e.target.value)}
                                            placeholder="Describe the image for screen readers"
                                            className="admin-input w-full bg-white text-sm"
                                        />
                                    </div>
                                )}
                                <button 
                                    type="button" 
                                    onClick={handleUpload}
                                    disabled={isUploading || (selectedFile.type.startsWith('image/') && !altText.trim())}
                                    className="admin-btn-primary flex items-center justify-center gap-2 py-2 mt-2 disabled:opacity-50"
                                >
                                    {isUploading ? <><Loader2 size={16} className="animate-spin" /> Uploading...</> : <><FileUp size={16} /> Upload to Library</>}
                                </button>
                            </div>
                        )}
                    </div>
                )}

                {mediaOpt === 'URL' && (
                    <input 
                        type="text" 
                        value={customUrl} 
                        onChange={handleUrlChange} 
                        placeholder={placeholder} 
                        className="admin-input w-full bg-white" 
                    />
                )}
            </div>
            
            {/* Safe Image Preview helper */}
            {value && mediaOpt !== 'UPLOAD' && accept.includes('image') && (
                <div className="mt-3 bg-white p-2 border border-gray-200 rounded inline-block shadow-sm relative group max-w-full overflow-hidden">
                    <img src={getPreviewUrl(value)} alt="Preview" className="h-20 object-contain rounded" onError={(e) => e.target.style.display = 'none'} />
                    <button type="button" onClick={() => onChange('')} title="Clear Selection" className="absolute -top-2 -right-2 bg-red-100 text-red-600 rounded-full h-6 w-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity drop-shadow hover:bg-red-200 border border-white text-xs font-bold">✕</button>
                </div>
            )}
        </div>
    );
}
