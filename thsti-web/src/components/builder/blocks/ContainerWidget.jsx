import React from 'react';
import { useNode } from '@craftjs/core';

export const ContainerWidget = ({ background, padding, minHeight, children }) => {
  const { connectors: { connect } } = useNode();
  return (
    <div 
      ref={(ref) => connect(ref)} 
      style={{ background, padding: `${padding}px`, minHeight }}
      className="w-full"
    >
      {children}
    </div>
  );
};

ContainerWidget.craft = {
  props: {
    background: '#ffffff',
    padding: 20
  }
};
