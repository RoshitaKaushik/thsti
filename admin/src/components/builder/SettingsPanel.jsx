import React from 'react';
import { useEditor } from '@craftjs/core';

export const SettingsPanel = () => {
  const { selected } = useEditor((state, query) => {
    // state.events.selected is a Set in newer Craft.js versions
    const selectedIds = Array.from(state.events.selected || []);
    const currentNodeId = selectedIds.length > 0 ? selectedIds[0] : null;
    let selected;

    if (currentNodeId && state.nodes[currentNodeId]) {
      selected = {
        id: currentNodeId,
        name: state.nodes[currentNodeId].data.name,
        settings: state.nodes[currentNodeId].related && state.nodes[currentNodeId].related.settings,
        isDeletable: query.node(currentNodeId).isDeletable()
      };
    }

    return { selected };
  });

  const { actions } = useEditor();

  if (!selected) {
    return (
      <div className="w-72 bg-white border-l border-gray-200 flex flex-col h-full items-center justify-center p-6 text-center">
        <div className="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
          <svg className="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
        </div>
        <p className="text-gray-500 font-medium">Click on a component in the canvas to edit its properties.</p>
      </div>
    );
  }

  return (
    <div className="w-72 bg-white border-l border-gray-200 flex flex-col h-full">
      <div className="p-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
        <div>
          <h3 className="font-bold text-gray-800">{selected.name} Settings</h3>
          <p className="text-xs text-gray-500">Modify properties</p>
        </div>
      </div>
      
      <div className="flex-1 overflow-y-auto p-4">
        {selected.settings && React.createElement(selected.settings)}
      </div>

      {selected.isDeletable && (
        <div className="p-4 border-t border-gray-100">
          <button 
            onClick={() => actions.delete(selected.id)}
            className="w-full py-2 bg-red-50 text-red-600 font-bold border border-red-200 rounded hover:bg-red-100 transition-colors"
          >
            Delete Component
          </button>
        </div>
      )}
    </div>
  );
};
