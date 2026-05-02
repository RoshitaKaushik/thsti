import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import api from '../api/axios';

const StatRing = ({ value, label, icon, color, max }) => {
    const val = parseInt(value) || 0;
    const safeMax = Math.max(val, max, 1);
    const radius = 38;
    const circumference = 2 * Math.PI * radius;
    const [offset, setOffset] = useState(circumference);

    useEffect(() => {
        // Trigger animation on mount
        setTimeout(() => {
            setOffset(circumference - (val / safeMax) * circumference);
        }, 100);
    }, [val, safeMax, circumference]);

    return (
        <div className="infographic-stat-item">
            <div className="infographic-ring-container">
                <svg className="infographic-svg" viewBox="0 0 100 100">
                    <circle className="infographic-bg" cx="50" cy="50" r={radius} />
                    <circle 
                        className="infographic-progress" 
                        cx="50" cy="50" r={radius} 
                        stroke={color}
                        strokeDasharray={circumference}
                        strokeDashoffset={offset}
                    />
                </svg>
                <div className="infographic-icon">
                    <i className={`fa-solid ${icon}`} style={{color}}></i>
                </div>
            </div>
            <div className="infographic-details">
                <span className="infographic-value">{val}</span>
                <span className="infographic-label">{label}</span>
            </div>
        </div>
    );
};

export default function FacultyProfile() {
    const { slug } = useParams();
    const [faculty, setFaculty] = useState(null);
    const [loading, setLoading] = useState(true);
    const [activeTab, setActiveTab] = useState('overview');

    useEffect(() => {
        const fetchFaculty = async () => {
            try {
                // Since our backend doesn't have getFacultyBySlug right now, but rather getById,
                // Oh wait! I didn't add getFacultyBySlug. I'll need to fetch all and filter or update backend.
                // Assuming backend will be updated to fetch by slug or ID. 
                const res = await api.get(`/faculty`); 
                const data = res.data;
                const found = data.find(f => f.slug === slug || f.id.toString() === slug);
                if(found) setFaculty(found);
            } catch (err) {
                console.error("Failed to fetch faculty", err);
            } finally {
                setLoading(false);
            }
        };
        fetchFaculty();
    }, [slug]);

    if (loading) return <div className="text-center py-20 text-xl font-bold">Loading Profile...</div>;
    if (!faculty) return <div className="text-center py-20 text-xl font-bold text-red-600">Faculty not found</div>;

    const tabs = [
        { id: 'overview', icon: 'fa-user', label: 'Overview', content: faculty.overviewContent },
        { id: 'education', icon: 'fa-graduation-cap', label: 'Education', content: faculty.educationContent },
        { id: 'research', icon: 'fa-flask', label: 'Research', content: faculty.researchContent },
        { id: 'publications', icon: 'fa-book-open', label: 'Publications', content: faculty.publicationsContent },
        { id: 'books', icon: 'fa-book', label: 'Books', content: faculty.booksContent },
        { id: 'patents', icon: 'fa-lightbulb', label: 'Patents', content: faculty.patentsContent },
        { id: 'awards', icon: 'fa-trophy', label: 'Awards', content: faculty.awardsContent }
    ].filter(t => t.content && t.content.trim() !== '');

    if(!tabs.find(t => t.id === activeTab) && tabs.length > 0) {
        setActiveTab(tabs[0].id);
    }

    return (
        <section className="faculty-details">
            <div className="auto-container">
                {/* HERO CARD */}
                <div className="fd-hero-card">
                    <div className="fd-photo-wrapper">
                        <div className="fd-photo-ring">
                            {faculty.imageUrl ? (
                                <img src={`${process.env.REACT_APP_PUBLIC_URL || 'http://localhost:5000'}${faculty.imageUrl}`} alt={faculty.name} 
                                   onError={(e)=>{ e.target.style.display='none'; e.target.parentElement.innerHTML=`<div style='width:100%;height:100%;border-radius:50%;background:linear-gradient(135deg,#1a5fa8,#9d302b);display:flex;align-items:center;justify-content:center;font-size:40px;font-weight:800;color:#fff'>${faculty.name.charAt(0)}</div>`}} />
                            ) : (
                                <div style={{width:'100%',height:'100%',borderRadius:'50%',background:'linear-gradient(135deg,#1a5fa8,#9d302b)',display:'flex',alignItems:'center',justifyContent:'center',fontSize:'40px',fontWeight:'800',color:'#fff'}}>{faculty.name.charAt(0)}</div>
                            )}
                        </div>
                    </div>
                    
                    <div className="fd-hero-info">
                        {faculty.designation && <span className="fd-designation-badge">{faculty.designation}</span>}
                        <h1 className="fd-hero-name">{faculty.name}</h1>
                        <p className="fd-hero-title">{faculty.department}</p>
                        
                        <div className="fd-hero-meta">
                            {faculty.location && <span><i className="fa-solid fa-building-columns"></i> {faculty.location}</span>}
                            {faculty.researchFocus && <span><i className="fa-solid fa-flask"></i> {faculty.researchFocus}</span>}
                            {faculty.educationSnippet && <span><i className="fa-solid fa-graduation-cap"></i> {faculty.educationSnippet}</span>}
                            {faculty.office && <span><i className="fa-solid fa-location-dot"></i> {faculty.office}</span>}
                        </div>
                        
                        <div className="fd-hero-actions">
                            {faculty.email && (
                                <a href={`mailto:${faculty.email}`} className="fd-btn fd-btn-light">
                                    <i className="fa-solid fa-envelope"></i> Send Email
                                </a>
                            )}
                            {faculty.cvUrl && (
                                <a href={`${faculty.cvUrl.startsWith('http') ? '' : 'http://localhost:5000'}${faculty.cvUrl}`} target="_blank" rel="noreferrer" className="fd-btn fd-btn-outline-light">
                                    <i className="fa-solid fa-file-pdf"></i> Download CV
                                </a>
                            )}
                            {faculty.labWebsiteUrl && (
                                <a href={faculty.labWebsiteUrl} target="_blank" rel="noreferrer" className="fd-btn fd-btn-outline-light">
                                    <i className="fa-solid fa-globe"></i> Lab Website
                                </a>
                            )}
                        </div>
                    </div>
                </div>

                {/* INFOGRAPHICS STATS BAR */}
                <div className="fd-infographics-bar">
                    <StatRing value={faculty.publicationsCount} label="Publications" icon="fa-book-open" color="#3b82f6" max={100} />
                    <StatRing value={faculty.citationsCount} label="Citations" icon="fa-quote-right" color="#10b981" max={1000} />
                    <StatRing value={faculty.hIndex} label="H-Index" icon="fa-chart-line" color="#f59e0b" max={50} />
                    <StatRing value={faculty.patentsCount} label="Patents" icon="fa-lightbulb" color="#8b5cf6" max={20} />
                    <StatRing value={faculty.projectsCount} label="Projects" icon="fa-diagram-project" color="#ef4444" max={20} />
                </div>

                {/* MAIN LAYOUT */}
                <div className="fd-layout">
                    {/* SIDEBAR */}
                    <aside className="fd-sidebar">
                        <div className="fd-sidebar-card">
                            <div className="fd-sidebar-card-header">
                                <i className="fa-solid fa-address-card"></i> Contact Info
                            </div>
                            <div className="fd-sidebar-card-body">
                                <ul className="fd-contact-list">
                                    {faculty.email && (
                                        <li>
                                            <div className="fd-cl-icon"><i className="fa-solid fa-envelope"></i></div>
                                            <div className="fd-cl-text">
                                                <strong>Email</strong>
                                                <a href={`mailto:${faculty.email}`}>{faculty.email.replace('@','[AT]').replace('.','[DOT]')}</a>
                                            </div>
                                        </li>
                                    )}
                                    {faculty.phone && (
                                        <li>
                                            <div className="fd-cl-icon"><i className="fa-solid fa-phone"></i></div>
                                            <div className="fd-cl-text">
                                                <strong>Phone</strong>
                                                {faculty.phone}
                                            </div>
                                        </li>
                                    )}
                                    {faculty.office && (
                                        <li>
                                            <div className="fd-cl-icon"><i className="fa-solid fa-building"></i></div>
                                            <div className="fd-cl-text">
                                                <strong>Office</strong>
                                                {faculty.office}
                                            </div>
                                        </li>
                                    )}
                                    {faculty.orcid && (
                                        <li>
                                            <div className="fd-cl-icon"><i className="fa-brands fa-orcid"></i></div>
                                            <div className="fd-cl-text">
                                                <strong>ORCID</strong>
                                                <a href={`https://orcid.org/${faculty.orcid}`} target="_blank" rel="noreferrer">{faculty.orcid}</a>
                                            </div>
                                        </li>
                                    )}
                                </ul>
                            </div>
                        </div>

                        {/* Social Links */}
                        <div className="fd-sidebar-card">
                            <div className="fd-sidebar-card-header">
                                <i className="fa-solid fa-share-nodes"></i> Academic Profiles
                            </div>
                            <div className="fd-sidebar-card-body">
                                <div className="fd-social-links">
                                    {faculty.googleScholarUrl && (
                                        <a href={faculty.googleScholarUrl} target="_blank" rel="noreferrer" className="fd-social-link scholar">
                                            <i className="fa-brands fa-google"></i> Google Scholar
                                        </a>
                                    )}
                                    {faculty.researchGateUrl && (
                                        <a href={faculty.researchGateUrl} target="_blank" rel="noreferrer" className="fd-social-link resgate">
                                            <i className="fa-brands fa-researchgate"></i> ResearchGate
                                        </a>
                                    )}
                                    {faculty.linkedinUrl && (
                                        <a href={faculty.linkedinUrl} target="_blank" rel="noreferrer" className="fd-social-link linkedin">
                                            <i className="fa-brands fa-linkedin"></i> LinkedIn
                                        </a>
                                    )}
                                </div>
                            </div>
                        </div>
                    </aside>

                    {/* TABBED CONTENT */}
                    <div className="fd-content-panel">
                        <nav className="fd-tab-nav" role="tablist">
                            {tabs.map(tab => (
                                <button key={tab.id} onClick={() => setActiveTab(tab.id)} className={`fd-tab-btn ${activeTab === tab.id ? 'fd-active' : ''}`} role="tab">
                                    <i className={`fa-solid ${tab.icon}`}></i> {tab.label}
                                </button>
                            ))}
                        </nav>
                        
                        <div className="fd-tab-pane fd-active" style={{overflowX: 'auto'}}>
                            {tabs.map(tab => (
                                activeTab === tab.id && (
                                    <div key={tab.id}>
                                         <h2 className="fd-pane-heading">
                                            <i className={`fa-solid ${tab.icon}`}></i> {tab.label}
                                         </h2>
                                         <div className="fd-bio-text" dangerouslySetInnerHTML={{ __html: tab.content }}></div>
                                    </div>
                                )
                            ))}
                        </div>
                    </div>
                </div>
            </div>
            <style>{`
            .faculty-details {
                padding: 60px 0;
                background-color: #f4f6f9;
            }
            .fd-hero-card {
                display: flex;
                background: #fff;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.05);
                padding: 40px;
                margin-bottom: 30px;
                align-items: center;
                gap: 40px;
            }
            .fd-photo-wrapper {
                flex-shrink: 0;
            }
            .fd-photo-ring {
                width: 200px;
                height: 200px;
                border-radius: 50%;
                padding: 8px;
                background: linear-gradient(135deg, #0b2d55 0%, #ab1f24 100%);
            }
            .fd-photo-ring img {
                width: 100%;
                height: 100%;
                border-radius: 50%;
                object-fit: cover;
                border: 4px solid #fff;
                background: #fff;
            }
            .fd-hero-info {
                flex-grow: 1;
            }
            .fd-designation-badge {
                display: inline-block;
                padding: 5px 15px;
                background: rgba(11, 45, 85, 0.1);
                color: #0b2d55;
                border-radius: 20px;
                font-weight: 700;
                font-size: 13px;
                margin-bottom: 15px;
                text-transform: uppercase;
                letter-spacing: 1px;
            }
            .fd-hero-name {
                font-size: 36px;
                font-weight: 800;
                color: #0b2d55;
                margin-bottom: 5px;
            }
            .fd-hero-title {
                font-size: 18px;
                color: #666;
                margin-bottom: 20px;
                font-weight: 500;
            }
            .fd-hero-meta {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                margin-bottom: 25px;
            }
            .fd-hero-meta span {
                display: flex;
                align-items: center;
                gap: 8px;
                color: #555;
                font-size: 15px;
            }
            .fd-hero-meta span i {
                color: #ab1f24;
            }
            .fd-hero-actions {
                display: flex;
                gap: 15px;
            }
            .fd-btn {
                padding: 10px 25px;
                border-radius: 6px;
                font-weight: 600;
                font-size: 15px;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                text-decoration: none;
                transition: all 0.3s;
            }
            .fd-btn-light {
                background: #0b2d55;
                color: #fff !important;
            }
            .fd-btn-light:hover {
                background: #ab1f24;
            }
            .fd-btn-outline-light {
                border: 2px solid #e2e8f0;
                color: #0b2d55 !important;
            }
            .fd-btn-outline-light:hover {
                border-color: #0b2d55;
                background: #f8fafc;
            }

            /* Infographics Stats Bar */
            .fd-infographics-bar {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                justify-content: center;
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 5px 20px rgba(0,0,0,0.03);
                padding: 35px 20px;
                margin-bottom: 40px;
            }
            .infographic-stat-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                min-width: 140px;
                transition: transform 0.3s;
            }
            .infographic-stat-item:hover {
                transform: translateY(-5px);
            }
            .infographic-ring-container {
                position: relative;
                width: 90px;
                height: 90px;
                margin-bottom: 15px;
            }
            .infographic-svg {
                width: 100%;
                height: 100%;
                transform: rotate(-90deg);
            }
            .infographic-bg {
                fill: none;
                stroke: #f1f5f9;
                stroke-width: 8;
            }
            .infographic-progress {
                fill: none;
                stroke-width: 8;
                stroke-linecap: round;
                transition: stroke-dashoffset 1.5s ease-out;
            }
            .infographic-icon {
                position: absolute;
                top: 0; left: 0; right: 0; bottom: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 24px;
                background: #fff;
                border-radius: 50%;
                margin: 12px;
                box-shadow: inset 0 2px 5px rgba(0,0,0,0.05);
            }
            .infographic-details {
                text-align: center;
            }
            .infographic-value {
                display: block;
                font-size: 26px;
                font-weight: 800;
                color: #0b2d55;
                line-height: 1;
                margin-bottom: 5px;
            }
            .infographic-label {
                font-size: 13px;
                color: #64748b;
                text-transform: uppercase;
                font-weight: 600;
                letter-spacing: 0.5px;
            }

            /* Layout */
            .fd-layout {
                display: flex;
                gap: 35px;
            }
            .fd-sidebar {
                width: 320px;
                flex-shrink: 0;
            }
            .fd-content-panel {
                flex-grow: 1;
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 5px 20px rgba(0,0,0,0.03);
                overflow: hidden;
            }

            /* Sidebar Cards */
            .fd-sidebar-card {
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 5px 20px rgba(0,0,0,0.03);
                margin-bottom: 25px;
                overflow: hidden;
            }
            .fd-sidebar-card-header {
                background: #0b2d55;
                color: #fff;
                padding: 15px 20px;
                font-weight: 600;
                font-size: 16px;
                display: flex;
                align-items: center;
                gap: 10px;
            }
            .fd-sidebar-card-body {
                padding: 20px;
            }
            .fd-contact-list {
                list-style: none;
                padding: 0;
                margin: 0;
            }
            .fd-contact-list li {
                display: flex;
                gap: 15px;
                margin-bottom: 20px;
            }
            .fd-contact-list li:last-child {
                margin-bottom: 0;
            }
            .fd-cl-icon {
                width: 40px;
                height: 40px;
                background: #f1f5f9;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #ab1f24;
                font-size: 16px;
                flex-shrink: 0;
            }
            .fd-cl-text strong {
                display: block;
                font-size: 13px;
                color: #64748b;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-bottom: 2px;
            }
            .fd-cl-text {
                font-size: 15px;
                color: #334155;
                word-break: break-all;
            }
            .fd-cl-text a {
                color: #0b2d55;
                text-decoration: none;
                font-weight: 500;
            }

            /* Social Links */
            .fd-social-links {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
            .fd-social-link {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 12px 15px;
                border-radius: 8px;
                color: #fff !important;
                text-decoration: none;
                font-weight: 500;
                transition: transform 0.2s;
            }
            .fd-social-link:hover {
                transform: translateX(5px);
            }
            .fd-social-link.scholar { background: #4285F4; }
            .fd-social-link.resgate { background: #00CCBB; }
            .fd-social-link.linkedin { background: #0077b5; }

            /* Tabs */
            .fd-tab-nav {
                display: flex;
                background: #f8fafc;
                border-bottom: 1px solid #e2e8f0;
                overflow-x: auto;
            }
            .fd-tab-btn {
                padding: 20px 25px;
                border: none;
                background: none;
                font-weight: 600;
                font-size: 15px;
                color: #64748b;
                cursor: pointer;
                border-bottom: 3px solid transparent;
                display: flex;
                align-items: center;
                gap: 8px;
                white-space: nowrap;
                transition: all 0.3s;
            }
            .fd-tab-btn:hover {
                color: #0b2d55;
            }
            .fd-tab-btn.fd-active {
                color: #ab1f24;
                border-bottom-color: #ab1f24;
                background: #fff;
            }
            .fd-tab-pane {
                padding: 40px;
                display: none;
            }
            .fd-tab-pane.fd-active {
                display: block;
            }
            .fd-pane-heading {
                font-size: 24px;
                font-weight: 700;
                color: #0b2d55;
                margin-bottom: 25px;
                display: flex;
                align-items: center;
                gap: 12px;
            }
            .fd-pane-heading i {
                color: #ab1f24;
                font-size: 20px;
            }
            .fd-bio-text {
                font-size: 16px;
                line-height: 1.8;
                color: #000;
            }
            .fd-bio-text p {
                margin-bottom: 15px;
            }
            .fd-bio-text ul {
                margin-bottom: 15px;
                padding-left: 20px;
            }
            .fd-bio-text li {
                margin-bottom: 8px;
            }

            /* Responsive */
            @media (max-width: 991px) {
                .fd-hero-card {
                    flex-direction: column;
                    text-align: center;
                    padding: 30px 20px;
                }
                .fd-hero-meta {
                    justify-content: center;
                }
                .fd-hero-actions {
                    justify-content: center;
                }
                .fd-stats-bar {
                    grid-template-columns: repeat(3, 1fr);
                    gap: 20px;
                }
                .fd-stat-item {
                    border-right: none;
                }
                .fd-layout {
                    flex-direction: column;
                }
                .fd-sidebar {
                    width: 100%;
                }
            }
            @media (max-width: 767px) {
                .fd-stats-bar {
                    grid-template-columns: repeat(2, 1fr);
                }
                .fd-tab-btn {
                    padding: 15px;
                    font-size: 14px;
                }
                .fd-tab-pane {
                    padding: 20px;
                }
            }
            `}</style>
        </section>
    );
}
