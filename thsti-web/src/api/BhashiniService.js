import axiosInstance from './axios';

// The institutional API key should be provided in environment variables
const BHASHINI_API_KEY = import.meta.env.VITE_BHASHINI_API_KEY || '';
const BHASHINI_USER_ID = import.meta.env.VITE_BHASHINI_USER_ID || '';
const BHASHINI_INFERENCE_URL = 'https://dhruva-api.bhashini.gov.in/services/inference/pipeline';

export const BhashiniService = {
  /**
   * Translates text from English to Hindi
   * @param {string} sourceText - The English text to translate
   * @returns {Promise<string>} The translated Hindi text
   */
  async translateToHindi(sourceText) {
    if (!BHASHINI_API_KEY || !sourceText) return sourceText; // Fallback if no key

    try {
      // Structure based on standard Bhashini API request payload
      const response = await fetch(BHASHINI_INFERENCE_URL, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': BHASHINI_API_KEY,
          'userID': BHASHINI_USER_ID
        },
        body: JSON.stringify({
          pipelineTasks: [
            {
              taskType: "translation",
              config: {
                language: {
                   sourceLanguage: "en",
                   targetLanguage: "hi"
                }
              }
            }
          ],
          inputData: {
            input: [
              {
                source: sourceText
              }
            ]
          }
        })
      });

      const data = await response.json();
      
      if (data && data.pipelineResponse && data.pipelineResponse[0]) {
          return data.pipelineResponse[0].output[0].target;
      }
      return sourceText;
    } catch (error) {
      console.error('Bhashini Translation Check Failed:', error);
      return sourceText;
    }
  }
}
