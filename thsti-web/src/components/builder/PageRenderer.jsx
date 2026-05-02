import React, { useEffect } from 'react';
import { Editor, Frame, useEditor } from '@craftjs/core';
import { ContainerWidget } from './blocks/ContainerWidget';
import { TextWidget } from './blocks/TextWidget';
import { FacultyGridWidget } from './blocks/FacultyGridWidget';

// Internal component to handle loading the JSON string into the Editor
const RendererInterface = ({ json }) => {
  const { actions } = useEditor();

  useEffect(() => {
    if (json) {
      try {
        actions.deserialize(json);
      } catch (err) {
        console.error("Failed to load visual builder layout", err);
      }
    }
  }, [json, actions]);

  // Frame renders the current state of the editor (which we just deserialized)
  return <Frame />;
};

export const PageRenderer = ({ json }) => {
  if (!json) return null;

  return (
    <div className="visual-builder-content w-full">
      <Editor enabled={false} resolver={{ ContainerWidget, TextWidget, FacultyGridWidget }}>
        <RendererInterface json={json} />
      </Editor>
    </div>
  );
};
