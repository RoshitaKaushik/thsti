import React, { useState, useEffect } from 'react';
import { useNode } from '@craftjs/core';
import ReactQuill from 'react-quill-new';
import 'react-quill-new/dist/quill.snow.css';

export const TextWidget = ({ text, fontSize, textAlign }) => {
  const { connectors: { connect, drag }, hasSelectedNode, hasDraggedNode, actions: { setProp } } = useNode((state) => ({
    hasSelectedNode: state.events.selected,
    hasDraggedNode: state.events.dragged,
  }));

  const [editable, setEditable] = useState(false);

  useEffect(() => {
    if (!hasSelectedNode) {
      setEditable(false);
    }
  }, [hasSelectedNode]);

  return (
    <div 
      ref={(ref) => connect(drag(ref))} 
      onClick={() => setEditable(true)}
      style={{ fontSize: `${fontSize}px`, textAlign }}
      className={`w-full ${editable ? 'border border-blue-500' : ''}`}
    >
      {editable ? (
        <ReactQuill 
          theme="snow" 
          value={text} 
          onChange={(val) => setProp(props => props.text = val)} 
        />
      ) : (
        <div dangerouslySetInnerHTML={{ __html: text }} />
      )}
    </div>
  );
};

export const TextSettings = () => {
  const { fontSize, textAlign, actions: { setProp } } = useNode((node) => ({
    fontSize: node.data.props.fontSize,
    textAlign: node.data.props.textAlign,
  }));

  return (
    <div>
      <div className="mb-4">
        <label className="block text-sm font-bold text-gray-700 mb-1">Font Size (px)</label>
        <input 
          type="number" 
          value={fontSize || 16} 
          onChange={(e) => setProp(props => props.fontSize = e.target.value)} 
          className="w-full p-2 border rounded"
        />
      </div>
      <div className="mb-4">
        <label className="block text-sm font-bold text-gray-700 mb-1">Text Align</label>
        <select 
          value={textAlign} 
          onChange={(e) => setProp(props => props.textAlign = e.target.value)}
          className="w-full p-2 border rounded"
        >
          <option value="left">Left</option>
          <option value="center">Center</option>
          <option value="right">Right</option>
        </select>
      </div>
    </div>
  );
};

TextWidget.craft = {
  props: {
    text: '<p>Edit this text</p>',
    fontSize: 16,
    textAlign: 'left'
  },
  related: {
    settings: TextSettings
  }
};
