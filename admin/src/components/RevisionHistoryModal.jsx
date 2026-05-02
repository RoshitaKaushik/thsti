import React, { useState, useEffect } from 'react';
import { Clock, RotateCcw, X, AlertCircle, Eye, EyeOff } from 'lucide-react';
import api from '../api/axios';
import { toast } from 'react-hot-toast';

export default function RevisionHistoryModal({ isOpen, onClose, entityType, entityId, onRevertSuccess, entityTitle }) {
    const [revisions, setRevisions] = useState([]);
    const [loading, setLoading] = useState(true);
    const [revertingId, setRevertingId] = useState(null);
    const [previewingId, setPreviewingId] = useState(null);
    const [confirmRevertId, setConfirmRevertId] = useState(null);

    useEffect(() => {
        if (isOpen && entityType && entityId) {
            fetchRevisions();
        }
    }, [isOpen, entityType, entityId]);

    const fetchRevisions = async () => {
        setLoading(true);
        try {
            const res = await api.get(`/revisions/${entityType}/${entityId}`);
            setRevisions(res.data);
        } catch (err) {
            console.error('Failed to load revisions', err);
            toast.error('Failed to load revision history');
        } finally {
            setLoading(false);
        }
    };

    const handleRevertClick = (revisionId) => {
        setConfirmRevertId(revisionId);
    };

    const executeRevert = async () => {
        if (!confirmRevertId) return;
        const revisionId = confirmRevertId;
        setConfirmRevertId(null);
        setRevertingId(revisionId);
        try {
            await api.post(`/revisions/${revisionId}/revert`);
            toast.success('Successfully reverted to older version!');
            if (onRevertSuccess) onRevertSuccess();
            onClose();
        } catch (err) {
            console.error('Failed to revert', err);
            toast.error(err.response?.data?.error || 'Failed to revert to this version');
        } finally {
            setRevertingId(null);
        }
    };

    if (!isOpen) return null;

    return (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
            <div className="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[85vh] flex flex-col overflow-hidden">
                <div className="flex justify-between items-center p-4 border-b border-gray-100 bg-gray-50">
                    <h2 className="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <Clock size={20} className="text-blue-600" />
                        Revision History
                        <span className="text-sm font-normal text-gray-500 bg-gray-200 px-2 py-0.5 rounded ml-2">
                            {entityTitle || `${entityType} #${entityId}`}
                        </span>
                    </h2>
                    <button onClick={onClose} className="p-1 hover:bg-gray-200 rounded-full transition-colors">
                        <X size={20} className="text-gray-500" />
                    </button>
                </div>

                <div className="p-6 flex-1 overflow-y-auto">
                    {loading ? (
                        <div className="flex justify-center py-8">
                            <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                        </div>
                    ) : revisions.length === 0 ? (
                        <div className="text-center py-12 px-4 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                            <Clock size={40} className="mx-auto text-gray-300 mb-3" />
                            <h3 className="text-lg font-bold text-gray-700">No History Found</h3>
                            <p className="text-gray-500 text-sm mt-1">
                                There are no saved revisions for this item yet. A revision is automatically saved every time you make an edit.
                            </p>
                        </div>
                    ) : (
                        <div className="space-y-4 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-300 before:to-transparent">
                            {revisions.map((rev, idx) => (
                                <div key={rev.id} className="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                                    <div className="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-slate-100 text-slate-500 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2">
                                        <Clock size={16} />
                                    </div>
                                    <div className="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-4 rounded border border-slate-200 bg-white shadow-sm">
                                        <div className="flex items-center justify-between space-x-2 mb-1">
                                            <div className="font-bold text-slate-900">
                                                Version {revisions.length - idx}
                                            </div>
                                            <time className="font-mono text-xs text-slate-500">
                                                {new Date(rev.createdAt.endsWith('Z') ? rev.createdAt : rev.createdAt + 'Z').toLocaleString()}
                                            </time>
                                        </div>
                                        <div className="text-slate-500 text-sm mb-3">
                                            Saved before changes by <strong>{rev.changedBy || 'System'}</strong>
                                        </div>
                                        <div className="flex gap-2">
                                            <button
                                                onClick={() => setPreviewingId(previewingId === rev.id ? null : rev.id)}
                                                className="w-1/2 flex items-center justify-center gap-1 px-2 py-1 bg-gray-50 text-gray-700 hover:bg-gray-100 border border-gray-200 rounded text-xs font-semibold transition-colors whitespace-nowrap"
                                            >
                                                {previewingId === rev.id ? <EyeOff size={12} /> : <Eye size={12} />}
                                                {previewingId === rev.id ? 'Hide Data' : 'View Data'}
                                            </button>
                                            <button
                                                onClick={() => handleRevertClick(rev.id)}
                                                disabled={revertingId === rev.id}
                                                className="w-1/2 flex items-center justify-center gap-1 px-2 py-1 bg-blue-50 text-blue-700 hover:bg-blue-100 border border-blue-200 rounded text-xs font-semibold transition-colors disabled:opacity-50 whitespace-nowrap"
                                            >
                                                {revertingId === rev.id ? (
                                                    <div className="animate-spin rounded-full h-3 w-3 border-b-2 border-blue-700"></div>
                                                ) : (
                                                    <RotateCcw size={12} />
                                                )}
                                                {revertingId === rev.id ? 'Reverting...' : 'Revert'}
                                            </button>
                                        </div>

                                        {/* Expanded Preview Area */}
                                        {previewingId === rev.id && (
                                            <div className="mt-3 p-3 bg-slate-50 border border-slate-200 rounded text-xs overflow-x-auto max-h-60 overflow-y-auto">
                                                {(() => {
                                                    try {
                                                        const data = JSON.parse(rev.snapshotJson);
                                                        return (
                                                            <div className="space-y-2">
                                                                {Object.entries(data).map(([key, value]) => {
                                                                    // Skip rendering technical keys that clutter the view
                                                                    if (['Id', 'CreatedAt', 'UpdatedAt', 'IsDeleted'].includes(key)) return null;
                                                                    
                                                                    // Format the value nicely
                                                                    let displayValue = String(value);
                                                                    if (value === null) {
                                                                        displayValue = <span className="italic text-gray-400">null</span>;
                                                                    } else if (typeof value === 'boolean') {
                                                                        displayValue = <span className={value ? "text-green-600 font-bold" : "text-red-600 font-bold"}>{value ? 'True' : 'False'}</span>;
                                                                    } else if (typeof value === 'string' && (value.includes('<p>') || value.includes('</div>') || key.toLowerCase() === 'content' || key.toLowerCase() === 'description')) {
                                                                        // Render HTML content properly instead of showing tags
                                                                        displayValue = <div className="p-3 mt-1 bg-white border border-gray-200 rounded max-h-40 overflow-y-auto prose prose-sm max-w-none" dangerouslySetInnerHTML={{ __html: value }} />;
                                                                    } else if (typeof value === 'string' && value.length > 100) {
                                                                        displayValue = <div className="p-2 mt-1 bg-white border border-gray-200 rounded max-h-20 overflow-y-auto whitespace-pre-wrap">{value}</div>;
                                                                    }

                                                                    return (
                                                                        <div key={key} className="break-all">
                                                                            <span className="font-bold text-gray-700">{key}:</span> {displayValue}
                                                                        </div>
                                                                    );
                                                                })}
                                                            </div>
                                                        );
                                                    } catch (e) {
                                                        return <span className="text-red-500">Failed to parse version data.</span>;
                                                    }
                                                })()}
                                            </div>
                                        )}
                                    </div>
                                </div>
                            ))}
                        </div>
                    )}
                </div>

                <div className="p-4 border-t border-gray-100 bg-gray-50 flex justify-between items-center text-xs text-gray-500">
                    <div className="flex items-center gap-1">
                        <AlertCircle size={14} /> Only content saved after the update was applied can be reverted.
                    </div>
                    <button onClick={onClose} className="px-4 py-2 bg-white border border-gray-300 rounded hover:bg-gray-50 font-bold text-gray-700 transition-colors">
                        Close
                    </button>
                </div>
            </div>

            {/* Custom Confirmation Modal */}
            {confirmRevertId && (
                <div className="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm animate-in fade-in duration-200">
                    <div className="bg-white rounded-xl shadow-2xl w-full max-w-sm overflow-hidden animate-in zoom-in-95 duration-200">
                        <div className="p-5 border-b border-gray-100 flex items-start gap-3">
                            <div className="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center shrink-0">
                                <AlertCircle size={24} className="text-orange-600" />
                            </div>
                            <div>
                                <h3 className="text-lg font-bold text-gray-900 mb-1">Confirm Reversion</h3>
                                <p className="text-sm text-gray-600 leading-relaxed">
                                    Are you sure you want to revert to this version? Any changes made after this version will be overwritten, but your current state will be safely archived as a new revision.
                                </p>
                            </div>
                        </div>
                        <div className="p-4 bg-gray-50 flex justify-end gap-3">
                            <button
                                onClick={() => setConfirmRevertId(null)}
                                className="px-4 py-2 text-sm font-semibold text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors"
                            >
                                Cancel
                            </button>
                            <button
                                onClick={executeRevert}
                                className="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded hover:bg-blue-700 transition-colors shadow-sm"
                            >
                                Yes, Revert Now
                            </button>
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
}
