import React, { useState, useEffect } from 'react';
import ReactQuill from 'react-quill-new';
import 'react-quill-new/dist/quill.snow.css';

const modules = {
  toolbar: [
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
    [{ 'font': [] }],
    [{ 'size': ['small', false, 'large', 'huge'] }],
    ['bold', 'italic', 'underline', 'strike', 'blockquote'],
    [{ 'color': [] }, { 'background': [] }],
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    [{ 'indent': '-1'}, { 'indent': '+1' }],
    [{ 'align': [] }],
    ['link', 'image', 'video'],
    ['clean']
  ],
};

const formats = [
  'header', 'font', 'size',
  'bold', 'italic', 'underline', 'strike', 'blockquote',
  'color', 'background',
  'list', 'indent',
  'align',
  'link', 'image', 'video'
];

export default function RichTextEditor({ value, onChange, placeholder = 'Write your content here...', heightClass = 'h-[300px]' }) {


  return (
    <div className={`rich-text-editor-wrapper flex flex-col ${heightClass}`}>

      <div className="flex-1 bg-white border border-gray-300 rounded overflow-hidden flex flex-col min-h-[200px]">
        <ReactQuill 
          theme="snow"
        value={value || ''}
        onChange={onChange}
        modules={modules}
        formats={formats}
        placeholder={placeholder}
        className="flex-1 flex flex-col [&>.ql-container]:flex-1 [&>.ql-container]:border-none [&>.ql-toolbar]:border-none [&>.ql-toolbar]:border-b [&>.ql-toolbar]:border-gray-200"
      />
      <style>{`
        /* Tailwind custom styles to adjust Quill */
        .ql-editor { font-family: inherit; font-size: 1rem; line-height: 1.6; }
        .ql-snow .ql-picker-options { z-index: 100; }
        .ql-snow .ql-tooltip { z-index: 100; left: 0 !important; }
      `}</style>
      </div>
    </div>
  );
}
