import React from 'react';
import { useNode } from '@craftjs/core';

export const TextWidget = ({ text, fontSize, textAlign }) => {
  const { connectors: { connect } } = useNode();

  return (
    <div 
      ref={(ref) => connect(ref)} 
      style={{ fontSize: `${fontSize}px`, textAlign }}
      className="w-full"
    >
      <div dangerouslySetInnerHTML={{ __html: text }} />
    </div>
  );
};

TextWidget.craft = {
  props: {
    text: '',
    fontSize: 16,
    textAlign: 'left'
  }
};
