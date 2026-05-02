import React from 'react';
import { useNode } from '@craftjs/core';

export const ContainerWidget = ({ background, padding, minHeight, children }) => {
  const { connectors: { connect, drag } } = useNode();
  return (
    <div 
      ref={(ref) => connect(drag(ref))} 
      style={{ background, padding: `${padding}px`, minHeight: minHeight || '50px' }}
      className="border-2 border-dashed border-gray-200 w-full rounded"
    >
      {children}
    </div>
  );
};

export const ContainerSettings = () => {
  const { background, padding, actions: { setProp } } = useNode((node) => ({
    background: node.data.props.background,
    padding: node.data.props.padding,
  }));

  return (
    <div>
      <div className="mb-4">
        <label className="block text-sm font-bold text-gray-700 mb-1">Background Color</label>
        <input 
          type="color" 
          value={background || '#ffffff'} 
          onChange={(e) => setProp(props => props.background = e.target.value)} 
          className="w-full h-10 p-1 border rounded"
        />
      </div>
      <div className="mb-4">
        <label className="block text-sm font-bold text-gray-700 mb-1">Padding (px)</label>
        <input 
          type="number" 
          value={padding || 0} 
          onChange={(e) => setProp(props => props.padding = e.target.value)} 
          className="w-full p-2 border rounded"
        />
      </div>
    </div>
  );
};

ContainerWidget.craft = {
  props: {
    background: '#ffffff',
    padding: 20
  },
  related: {
    settings: ContainerSettings
  }
};
