import axiosInstance from './axios';

export const BhashiniService = {
  /**
   * Translates text from English to Hindi by brokering through the .NET backend securely.
   * @param {string} sourceText - The English text to translate
   * @returns {Promise<string>} The translated Hindi text
   */
  async translateToHindi(sourceText) {
    if (!sourceText) return sourceText;

    try {
      const response = await axiosInstance.post('/translation/translate', {
        sourceText: sourceText
      });
      
      if (response.data && response.data.translatedText) {
          return response.data.translatedText;
      }
      return sourceText;
    } catch (error) {
      console.error('Backend Translation Proxy Failed:', error);
      return sourceText; // Fallback to original text if backend or Bhashini fails
    }
  }
}
