import React, { useEffect } from 'react';
import { Routes, Route, Navigate } from 'react-router-dom';
import Header from './components/layout/Header';
import Footer from './components/layout/Footer';
import Accessibility from './components/layout/Accessibility';
import ScrollToTop from './components/layout/ScrollToTop';
import Home from './pages/Home';
import Page from './pages/Page';

import Search from './pages/Search';
import FacultyProfile from './pages/FacultyProfile';
import Tenders from './pages/Tenders';
import News from './pages/News';
import ContactUs from './pages/ContactUs';
import Galleries from './pages/Galleries';
import ResearchDetails from './pages/ResearchDetails';
import ResearchCentersIndex from './pages/ResearchCentersIndex';
import FacilityDetails from './pages/FacilityDetails';
import About from './pages/About';
import Partners from './components/home/Partners';

function App() {
  // Initialize global scroll reveal WOW animations using the original library natively ported for React DOM observation
  useEffect(() => {
    if (window.WOW) {
      new window.WOW({ live: true, animateClass: 'animated' }).init();
    }
  }, []);

  // Simple script to handle toggling accessibility sidebar if needed
  useEffect(() => {
    window.closeSidebar = () => {
      const sidebar = document.getElementById('sidebar');
      if (sidebar) sidebar.classList.remove('active');
    };
  }, []);

  // GIGW External Link Warning
  useEffect(() => {
    const handleExternalLinks = (e) => {
      const target = e.target.closest('a');
      if (target && target.href && target.href.startsWith('http')) {
        try {
          const url = new URL(target.href);
          const currentHost = window.location.hostname;
          if (url.hostname !== currentHost && url.hostname !== 'localhost') {
            const confirmExit = window.confirm('You are about to leave the THSTI website. This link may take you to an external website. Do you want to proceed?');
            if (!confirmExit) {
              e.preventDefault();
            }
          }
        } catch (err) {
          // ignore invalid urls
        }
      }
    };
    document.addEventListener('click', handleExternalLinks);
    return () => document.removeEventListener('click', handleExternalLinks);
  }, []);

  return (
    <div className="page-wrapper" style={{ overflow: 'clip' }}>
      <a href="#main-content" className="sr-only focus:not-sr-only focus:absolute focus:z-[9999] focus:p-4 focus:bg-white focus:text-[var(--primary)] font-bold shadow-lg">Skip to Main Content</a>
      <Header />
      
      <main id="main-content" tabIndex="-1" className="outline-none">
        <Routes>
          <Route path="/" element={<Home />} />
          {/* Legacy redirect for /page/ paths */}
          <Route path="/page/:slug" element={<Page />} />
          {/* Dynamic CMS Pages (fallback route for any root slug) */}
          <Route path="/:slug" element={<Page />} />
          <Route path="/faculty/:slug" element={<FacultyProfile />} />
          <Route path="/search" element={<Search />} />
          <Route path="/Tender" element={<Tenders />} />
          <Route path="/News" element={<News />} />
          <Route path="/contact-us" element={<ContactUs />} />
          <Route path="/galleries" element={<Galleries />} />
          <Route path="/TheMatic" element={<ResearchCentersIndex />} />
          <Route path="/research-centers/:slug" element={<ResearchDetails />} />
          <Route path="/research-facilities/:slug" element={<FacilityDetails />} />
          <Route path="/about" element={<About />} />
          <Route path="/about.html" element={<About />} />
        </Routes>
      </main>

      <Partners />
      <Footer />
      <Accessibility />

      {/* Scroll To Top */}
      <ScrollToTop />
    </div>
  );
}

export default App;
