import React, { createContext, useState, useEffect, useContext } from 'react';
import { BhashiniService } from '../api/BhashiniService';

const LanguageContext = createContext();

export const LanguageProvider = ({ children }) => {
  // Check local storage for saved language, default to 'en'
  const [language, setLanguage] = useState(() => {
    return localStorage.getItem('site_language') || 'en';
  });

  const [isTranslating, setIsTranslating] = useState(false);

  useEffect(() => {
    localStorage.setItem('site_language', language);
    // Apply lang attribute to HTML tag for accessibility
    document.documentElement.lang = language;
  }, [language]);

  const toggleLanguage = () => {
    setLanguage(prev => prev === 'en' ? 'hi' : 'en');
  };

  const translate = async (text) => {
    if (language === 'en' || !text) return text;
    
    setIsTranslating(true);
    try {
      const translated = await BhashiniService.translateToHindi(text);
      return translated;
    } finally {
      setIsTranslating(false);
    }
  };

  return (
    <LanguageContext.Provider value={{ language, toggleLanguage, translate, isTranslating }}>
      {children}
    </LanguageContext.Provider>
  );
};

export const useLanguage = () => useContext(LanguageContext);
