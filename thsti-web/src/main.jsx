import { StrictMode } from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter } from 'react-router-dom';
import '@fontsource/familjen-grotesk/400.css';
import '@fontsource/familjen-grotesk/500.css';
import '@fontsource/familjen-grotesk/600.css';
import '@fontsource/familjen-grotesk/700.css';
import '@fontsource/lato/300.css';
import '@fontsource/lato/400.css';
import '@fontsource/lato/700.css';
import '@fontsource/lato/900.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
import './index.css';
import App from './App.jsx';
import { LanguageProvider } from './components/LanguageContext';
import { AccessibilityProvider } from './components/AccessibilityContext';


createRoot(document.getElementById('root')).render(
  <StrictMode>
    <LanguageProvider>
      <AccessibilityProvider>
        <BrowserRouter>
          <App />
        </BrowserRouter>
      </AccessibilityProvider>
    </LanguageProvider>
  </StrictMode>,
);
