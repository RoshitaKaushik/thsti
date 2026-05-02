import React from 'react';
import { useNode } from '@craftjs/core';
import FacultyGrid from '../../faculty/FacultyGrid'; // Import the real component!

export const FacultyGridWidget = ({ showSearch, showCategory, showPagination }) => {
  const { connectors: { connect } } = useNode();
  
  return (
    <div ref={(ref) => connect(ref)} className="w-full">
      {/* 
        Here we render the ACTUAL React component. 
        We pass down the configured props from the Admin builder!
      */}
      <FacultyGrid 
        config={{
          showSearch,
          showCategory,
          showPagination
        }}
      />
    </div>
  );
};

FacultyGridWidget.craft = {
  props: {
    showSearch: true,
    showCategory: true,
    showPagination: true
  }
};
