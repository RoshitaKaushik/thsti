import React from 'react';
import { useNode } from '@craftjs/core';

// This is a placeholder for the admin interface. It won't render the real grid data in the admin to save performance, 
// but it represents where the grid will be and exposes the settings.
export const FacultyGridWidget = ({ showSearch, showCategory, showPagination }) => {
  const { connectors: { connect, drag } } = useNode();
  
  return (
    <div 
      ref={(ref) => connect(drag(ref))} 
      className="w-full bg-blue-50 border-2 border-blue-200 border-dashed rounded-lg p-8 flex flex-col items-center justify-center"
    >
      <div className="bg-white p-3 rounded-full shadow-sm mb-4">
        <svg className="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
      </div>
      <h3 className="text-xl font-bold text-blue-800 mb-2">Faculty Grid Component</h3>
      <p className="text-blue-600 text-sm text-center max-w-md">
        This component will automatically render the dynamic Faculty & Scientists grid on the live site.
      </p>
      
      <div className="mt-6 flex flex-wrap justify-center gap-3">
        {showSearch && <span className="px-3 py-1 bg-white border border-blue-200 text-blue-600 text-xs rounded-full font-bold">Search Enabled</span>}
        {showCategory && <span className="px-3 py-1 bg-white border border-blue-200 text-blue-600 text-xs rounded-full font-bold">Category Filter Enabled</span>}
        {showPagination && <span className="px-3 py-1 bg-white border border-blue-200 text-blue-600 text-xs rounded-full font-bold">Pagination Enabled</span>}
      </div>
    </div>
  );
};

export const FacultyGridSettings = () => {
  const { showSearch, showCategory, showPagination, actions: { setProp } } = useNode((node) => ({
    showSearch: node.data.props.showSearch,
    showCategory: node.data.props.showCategory,
    showPagination: node.data.props.showPagination,
  }));

  return (
    <div>
      <h4 className="font-bold text-gray-800 mb-4 pb-2 border-b">Grid Features</h4>
      
      <label className="flex items-center gap-3 cursor-pointer p-2 hover:bg-gray-50 rounded mb-2">
        <input 
          type="checkbox" 
          checked={showSearch} 
          onChange={(e) => setProp(props => props.showSearch = e.target.checked)} 
          className="w-4 h-4 text-primary focus:ring-primary border-gray-300 rounded"
        />
        <span className="text-sm font-bold text-gray-700">Show Search Bar</span>
      </label>

      <label className="flex items-center gap-3 cursor-pointer p-2 hover:bg-gray-50 rounded mb-2">
        <input 
          type="checkbox" 
          checked={showCategory} 
          onChange={(e) => setProp(props => props.showCategory = e.target.checked)} 
          className="w-4 h-4 text-primary focus:ring-primary border-gray-300 rounded"
        />
        <span className="text-sm font-bold text-gray-700">Show Category Filter</span>
      </label>

      <label className="flex items-center gap-3 cursor-pointer p-2 hover:bg-gray-50 rounded mb-2">
        <input 
          type="checkbox" 
          checked={showPagination} 
          onChange={(e) => setProp(props => props.showPagination = e.target.checked)} 
          className="w-4 h-4 text-primary focus:ring-primary border-gray-300 rounded"
        />
        <span className="text-sm font-bold text-gray-700">Show Pagination</span>
      </label>
    </div>
  );
};

FacultyGridWidget.craft = {
  props: {
    showSearch: true,
    showCategory: true,
    showPagination: true
  },
  related: {
    settings: FacultyGridSettings
  }
};
