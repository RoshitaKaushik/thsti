import React, { useEffect } from 'react';
import { Editor, Frame, Element, useEditor } from '@craftjs/core';
import { Sidebar } from './Sidebar';
import { SettingsPanel } from './SettingsPanel';
import { ContainerWidget } from './blocks/ContainerWidget';
import { TextWidget } from './blocks/TextWidget';
import { FacultyGridWidget } from './blocks/FacultyGridWidget';

const BuilderInterface = ({ initialJson, onChange }) => {
  const { actions, query } = useEditor();

  const initialized = React.useRef(false);

  useEffect(() => {
    if (initialJson && !initialized.current) {
      try {
        actions.deserialize(initialJson);
        initialized.current = true;
      } catch (err) {
        console.error("Failed to load layout", err);
      }
    }
  }, [initialJson, actions]);

  // Use an interval or event listener to notify parent of changes
  useEffect(() => {
    const interval = setInterval(() => {
      const json = query.serialize();
      onChange(json);
    }, 1000);
    return () => clearInterval(interval);
  }, [query, onChange]);

  return (
    <div className="flex h-[700px] border border-gray-300 rounded-lg overflow-hidden bg-gray-100">
      <Sidebar />
      <div className="flex-1 overflow-y-auto p-8 flex justify-center">
        <div className="w-full max-w-4xl bg-white shadow-sm rounded border border-gray-200 relative">
          <Frame>
            <Element is={ContainerWidget} padding={20} minHeight="800px" canvas>
              <TextWidget text="<h1 style='text-align: center'>Welcome to Visual Builder</h1>" fontSize={24} />
            </Element>
          </Frame>
        </div>
      </div>
      <SettingsPanel />
    </div>
  );
};

export const PageBuilder = ({ initialJson, onChange }) => {
  return (
    <Editor resolver={{ ContainerWidget, TextWidget, FacultyGridWidget }}>
      <BuilderInterface initialJson={initialJson} onChange={onChange} />
    </Editor>
  );
};
