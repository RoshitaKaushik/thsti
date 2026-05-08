import React, { createContext, useState, useEffect, useContext } from 'react';

const AccessibilityContext = createContext();

export const AccessibilityProvider = ({ children }) => {
  const [fontSize, setFontSize] = useState(() => {
    return localStorage.getItem('site_font_size') || 'normal'; // 'normal', 'large', 'xlarge'
  });

  const [theme, setTheme] = useState(() => {
    return localStorage.getItem('site_theme') || 'light'; // 'light', 'high-contrast'
  });

  const [readableFont, setReadableFont] = useState(() => {
    return localStorage.getItem('site_readable_font') === 'true';
  });

  useEffect(() => {
    localStorage.setItem('site_font_size', fontSize);
    document.documentElement.setAttribute('data-font-size', fontSize);
  }, [fontSize]);

  useEffect(() => {
    try {
      localStorage.setItem('site_theme', theme);
    } catch (e) {
      console.warn("localStorage not available", e);
    }
    let imgStyleTag = document.getElementById('high-contrast-images-style');
    if (theme === 'high-contrast') {
      document.body.classList.add('high-contrast-mode');
      document.documentElement.style.setProperty('filter', 'invert(100%) hue-rotate(180deg)', 'important');
      document.documentElement.style.setProperty('background-color', '#fff', 'important');
      
      if (!imgStyleTag) {
        imgStyleTag = document.createElement('style');
        imgStyleTag.id = 'high-contrast-images-style';
        document.head.appendChild(imgStyleTag);
      }
      imgStyleTag.innerHTML = `
        img, video, canvas, svg, iframe, .accessibility-btn {
            filter: invert(100%) hue-rotate(180deg) !important;
        }
      `;
    } else {
      document.body.classList.remove('high-contrast-mode');
      document.documentElement.style.removeProperty('filter');
      document.documentElement.style.removeProperty('background-color');
      
      if (imgStyleTag) {
        imgStyleTag.remove();
      }
    }
  }, [theme]);

  useEffect(() => {
    localStorage.setItem('site_readable_font', readableFont);
    document.documentElement.setAttribute('data-readable-font', readableFont);
  }, [readableFont]);

  const increaseFont = () => {
    setFontSize(prev => {
      if (prev === 'normal') return 'large';
      if (prev === 'large') return 'xlarge';
      return 'xlarge';
    });
  };

  const decreaseFont = () => {
    setFontSize(prev => {
      if (prev === 'xlarge') return 'large';
      if (prev === 'large') return 'normal';
      return 'normal';
    });
  };

  const resetFont = () => {
    setFontSize('normal');
  };

  const enableHighContrast = () => {
    setTheme('high-contrast');
  };

  const disableHighContrast = () => {
    setTheme('light');
  };

  const toggleReadableFont = () => {
    setReadableFont(prev => !prev);
  };

  return (
    <AccessibilityContext.Provider value={{
      fontSize,
      increaseFont,
      decreaseFont,
      resetFont,
      theme,
      enableHighContrast,
      disableHighContrast,
      readableFont,
      toggleReadableFont
    }}>
      {children}
    </AccessibilityContext.Provider>
  );
};

export const useAccessibility = () => useContext(AccessibilityContext);
