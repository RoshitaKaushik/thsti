import React, { useState, useEffect } from 'react';
import { ASSETS_BASE_URL } from '../../config/env';
import api from '../../api/axios';

const formatDate = (dateStr) => {
    if (!dateStr) return '';
    const d = new Date(dateStr);
    return d.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
};

// Fallback view all mapping
const getViewAllLink = (tabName) => {
    // As per user request, match design9 where View All opens about.html
    return '/about.html';
};

const TabsSection = () => {
    const [tabs, setTabs] = useState([]);
    const [activeTab, setActiveTab] = useState('');
    const [data, setData] = useState({});
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchCategoriesAndData = async () => {
            try {
                // Fetch dynamic categories
                const catRes = await api.get('/notifications/categories/public');
                const categories = catRes.data || [];
                
                if (categories.length === 0) {
                    setLoading(false);
                    return;
                }
                
                setTabs(categories);
                setActiveTab(categories[0].name);

                // Fetch data for each category
                const results = await Promise.all(
                    categories.map(cat => api.get(`/notifications?type=${encodeURIComponent(cat.name)}`))
                );
                
                const newData = {};
                categories.forEach((cat, i) => {
                    newData[cat.name] = results[i].data || [];
                });
                setData(newData);
            } catch (err) {
                console.error('TabsSection fetch error:', err);
            } finally {
                setLoading(false);
            }
        };
        fetchCategoriesAndData();
    }, []);

    // Only show if at least one tab has data
    const hasAnyData = tabs.some(tab => data[tab.name] && data[tab.name].length > 0);
    
    // Inject fallback dummy data for visual parity if CMS is empty or still loading
    let displayTabs = tabs;
    let displayData = data;
    let currentTab = activeTab;

    if (loading || !hasAnyData) {
        displayTabs = [
            { id: 1, name: 'Announcements' },
            { id: 2, name: 'Work With Us' },
            { id: 3, name: 'Results' },
            { id: 4, name: 'Tenders' }
        ];
        const dummyAnnouncement = {
            id: 1, publishDate: '2026-01-17', title: 'Translation regulation promotes stress adaptation', summary: 'Invasive Candida infections remain a serious...', imageUrl: 'images/resource/news-1.jpg', isNew: false, url: '#'
        };
        const dummyWork = {
            id: 1, publishDate: '2026-01-17', title: 'Translation regulation promotes stress adaptation', summary: 'Invasive Candida infections remain a serious...', isNew: true, url: '#'
        };
        displayData = {
            'Announcements': [
                { ...dummyAnnouncement, id: 1, imageUrl: 'images/resource/news-1.jpg' }, 
                { ...dummyAnnouncement, id: 2, imageUrl: 'images/resource/news-2.jpg' }, 
                { ...dummyAnnouncement, id: 3, imageUrl: 'images/resource/news-3.jpg' }, 
                { ...dummyAnnouncement, id: 4, imageUrl: 'images/resource/news-4.jpg' }
            ],
            'Work With Us': [
                { ...dummyWork, id: 1 }, { ...dummyWork, id: 2 }, { ...dummyWork, id: 3 }, { ...dummyWork, id: 4 }
            ],
            'Results': [ { ...dummyWork, id: 1 }, { ...dummyWork, id: 2 } ],
            'Tenders': [ { ...dummyWork, id: 1 }, { ...dummyWork, id: 2 } ]
        };
        currentTab = activeTab || 'Announcements';
    }

    const activeItems = displayData[currentTab] || [];
    const isAnnouncement = currentTab.toLowerCase().includes('announcement');

    return (
        <section className="what-we-offer" style={{ backgroundImage: 'url(images/background/5-2.jpg)' }}>
            <div className="auto-container">
                <div className="row clearfix">
                    <div className="text-column col-lg-12 col-md-12 col-sm-12"
                        style={{ backgroundColor: '#fff', padding: '50px', borderRadius: '20px' }}>
                        <div className="inner">
                            <div className="tabs-box tabs-style-one">
                                <ul className="tab-buttons clearfix">
                                    {displayTabs.filter(tab => displayData[tab.name] && displayData[tab.name].length > 0).map(tab => (
                                        <li
                                            key={tab.id}
                                            className={`tab-btn${currentTab === tab.name ? ' active-btn' : ''}`}
                                            onClick={() => setActiveTab(tab.name)}
                                            style={{ cursor: 'pointer', textTransform: 'uppercase' }}
                                        >
                                            <div className="txt">{tab.name}</div>
                                        </li>
                                    ))}
                                </ul>

                                <div className="tabs-content">
                                    {isAnnouncement ? (
                                        <div className="tab active-tab" id="announcements">
                                            <div className="row">
                                                {activeItems.slice(0, 4).map(item => (
                                                    <div key={item.id} className="col-lg-6">
                                                        <div className="announcements-card">
                                                            <div className="announcements-card-item">
                                                                {item.imageUrl && (
                                                                    <div className="card-item-icon1">
                                                                        <img
                                                                            src={item.imageUrl.startsWith('http') ? item.imageUrl : (item.imageUrl.startsWith('images/') ? item.imageUrl : `${ASSETS_BASE_URL}${item.imageUrl}`)}
                                                                            alt={item.title}
                                                                        />
                                                                    </div>
                                                                )}
                                                                <div className="card-content">
                                                                    <div className="announcements-tags">
                                                                        <span>
                                                                            <i className="fa fa-calendar" aria-hidden="true"></i>
                                                                            {' '}{formatDate(item.publishDate)}
                                                                        </span>
                                                                        {item.isNew && <span style={{ background: '#e74c3c', color: '#fff', marginLeft: 6 }}>New</span>}
                                                                    </div>
                                                                    <h5>{item.title}</h5>
                                                                    {item.summary && <p>{item.summary}</p>}
                                                                    {item.url && (
                                                                        <div className="link-box" style={{ marginTop: '10px' }}>
                                                                            <a
                                                                                href={item.url}
                                                                                target={item.openInNewTab ? '_blank' : '_self'}
                                                                                rel="noreferrer"
                                                                                className="read-more"
                                                                                style={{ fontSize: '12px', fontWeight: 'bold' }}
                                                                            >
                                                                                {(item.buttonText || 'READ MORE').toUpperCase()}
                                                                            </a>
                                                                        </div>
                                                                    )}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                ))}
                                            </div>
                                            <div className="link-box" style={{ marginTop: '20px' }}>
                                                <a href={getViewAllLink(currentTab)} className="read-more" style={{ fontWeight: 'bold' }}>
                                                    VIEW ALL <span className="fas fa-angle-right"></span>
                                                </a>
                                            </div>
                                        </div>
                                    ) : (
                                        <div className="tab active-tab" id={activeTab.replace(/\s+/g, '-').toLowerCase()}>
                                            <div className="work-with-us">
                                                {activeItems.slice(0, 4).map(item => {
                                                    const d = new Date(item.publishDate);
                                                    const month = d.toLocaleString('en-US', { month: 'short' });
                                                    const day = d.getDate();
                                                    return (
                                                        <div key={item.id} className="work-with-us-card">
                                                            <div className="work-with-us-card-item">
                                                                <div className="card-item-icon">
                                                                    <span className="month">{month}</span>
                                                                    <span className="day">{day}</span>
                                                                </div>
                                                                <div className="card-content">
                                                                    {item.isNew && (
                                                                        <div className="announcements-tags">
                                                                            <span style={{ background: '#e74c3c', color: '#fff', padding: '2px 8px', borderRadius: '4px', fontSize: '11px' }}>New</span>
                                                                        </div>
                                                                    )}
                                                                    <h5>{item.title}</h5>
                                                                    {item.summary && <p>{item.summary}</p>}
                                                                    {item.url && (
                                                                        <div className="link-box">
                                                                            <a
                                                                                href={item.url}
                                                                                target={item.openInNewTab ? '_blank' : '_self'}
                                                                                rel="noreferrer"
                                                                                className="read-more"
                                                                            >
                                                                                {(item.buttonText || 'READ MORE').toUpperCase()}
                                                                            </a>
                                                                        </div>
                                                                    )}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    );
                                                })}
                                            </div>
                                            <div className="link-box" style={{ marginTop: '20px' }}>
                                                <a
                                                    href={getViewAllLink(currentTab)}
                                                    className="read-more"
                                                    style={{ fontWeight: 'bold' }}
                                                >
                                                    VIEW ALL <span className="fas fa-angle-right"></span>
                                                </a>
                                            </div>
                                        </div>
                                    )}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
};

export default TabsSection;
