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

  return (
    <div className="page-wrapper">
      <Header />
      
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/faculty-and-scientists" element={<Navigate to="/page/faculty-and-scientists" replace />} />
        <Route path="/page/:slug" element={<Page />} />
        <Route path="/faculty/:slug" element={<FacultyProfile />} />
        <Route path="/search" element={<Search />} />
        <Route path="/Tender" element={<Tenders />} />
        <Route path="/News" element={<News />} />
        <Route path="/contact-us" element={<ContactUs />} />
        <Route path="/galleries" element={<Galleries />} />
      </Routes>

      <Footer />
      <Accessibility />

      {/* Scroll To Top */}
      <ScrollToTop />
    </div>
  );
}

export default App;
