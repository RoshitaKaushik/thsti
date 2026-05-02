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
    localStorage.setItem('site_theme', theme);
    document.documentElement.setAttribute('data-theme', theme);
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
