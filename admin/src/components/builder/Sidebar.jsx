import React from 'react';
import { useEditor, Element } from '@craftjs/core';
import { ContainerWidget } from './blocks/ContainerWidget';
import { TextWidget } from './blocks/TextWidget';
import { FacultyGridWidget } from './blocks/FacultyGridWidget';

export const Sidebar = () => {
  const { connectors, query } = useEditor();

  return (
    <div className="w-64 bg-white border-r border-gray-200 flex flex-col h-full">
      <div className="p-4 border-b border-gray-100 bg-gray-50">
        <h3 className="font-bold text-gray-800">Components</h3>
        <p className="text-xs text-gray-500">Drag and drop to build your page</p>
      </div>
      <div className="flex-1 overflow-y-auto p-4 flex flex-col gap-3">
        <div 
          ref={ref => connectors.create(ref, <Element is={ContainerWidget} padding={20} canvas />)}
          className="border border-gray-200 p-3 rounded bg-gray-50 text-center cursor-move hover:border-blue-400 transition-colors"
        >
          <div className="font-bold text-gray-700">Container</div>
        </div>
        
        <div 
          ref={ref => connectors.create(ref, <TextWidget text="Type your text here..." />)}
          className="border border-gray-200 p-3 rounded bg-gray-50 text-center cursor-move hover:border-blue-400 transition-colors"
        >
          <div className="font-bold text-gray-700">Text Block</div>
        </div>

        <div 
          ref={ref => connectors.create(ref, <FacultyGridWidget />)}
          className="border border-blue-200 p-3 rounded bg-blue-50 text-center cursor-move hover:border-blue-500 hover:bg-blue-100 transition-colors"
        >
          <div className="font-bold text-blue-800">Faculty Grid</div>
        </div>
      </div>
    </div>
  );
};
