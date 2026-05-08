import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import api from '../api/axios';
import { ASSETS_BASE_URL } from '../config/env';
import { useSeo } from '../hooks/useSeo';
import FacultyGrid from '../components/faculty/FacultyGrid';
import { useLanguage } from '../components/LanguageContext';

const Page = () => {
    const { slug } = useParams();
    const { language } = useLanguage();
    const [pageData, setPageData] = useState(null);
    const [error, setError] = useState(false);
    const [loading, setLoading] = useState(true);
    const [activeSidebarIndex, setActiveSidebarIndex] = useState(0);

    const handleScrollToHeading = (e, targetUrl, label, idx) => {
        if (targetUrl && targetUrl.startsWith('#')) {
            e.preventDefault();
            setActiveSidebarIndex(idx);
            let element = null;

            if (targetUrl.length > 1 && targetUrl !== '#') {
                element = document.getElementById(targetUrl.substring(1));
            }

            if (!element && label) {
                const headings = document.querySelectorAll('.content-side .text h1, .content-side .text h2, .content-side .text h3, .content-side .text h4, .content-side .text h5, .content-side .text h6');
                for (let i = 0; i < headings.length; i++) {
                    if (headings[i].innerText.trim().toLowerCase() === label.trim().toLowerCase()) {
                        element = headings[i];
                        break;
                    }
                }
            }

            if (element) {
                const headerOffset = 150;
                const elementPosition = element.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            }
        }
    };

    // Dynamically update document head tags when pageData loads
    useSeo({
        title: pageData?.title,
        metaTitle: pageData?.metaTitle,
        metaDescription: pageData?.metaDescription,
        ogImage: pageData?.ogImage ? ASSETS_BASE_URL + pageData.ogImage : null
    });

    useEffect(() => {
        window.scrollTo(0, 0);
        setLoading(true);

        const fetchData = async () => {
            try {
                // Fetch the current page content
                const pageRes = await api.get(`/pages/slug/${slug}`);
                setPageData(pageRes.data);
                setError(false);
            } catch (err) {
                console.error('Error fetching page content:', err);
                setError(true);
            } finally {
                setLoading(false);
            }
        };

        fetchData();
    }, [slug]);

    if (error) {
        return (
            <div className="container py-5 text-center mt-5 mb-5" style={{ minHeight: '50vh' }}>
                <h3>Page Not Found</h3>
                <p>The page you are looking for does not exist or has been moved.</p>
            </div>
        );
    }

    if (loading || !pageData) {
        return (
            <div className="container py-5 text-center mt-5 mb-5" style={{ minHeight: '50vh' }}>
                <p>Loading content...</p>
            </div>
        );
    }

    let templateConfig = {};
    if (pageData?.templateConfigJson) {
        try {
            templateConfig = JSON.parse(pageData.templateConfigJson);
        } catch (e) {
            console.error("Failed to parse templateConfigJson");
        }
    }

    // Auto-migrate legacy data for rendering
    if (!templateConfig.sidebarBlocks) {
        const blocks = [];
        if (templateConfig.showSidebar !== false) {
            // Include legacy fallback links if empty
            const links = (templateConfig.sidebarLinks && templateConfig.sidebarLinks.length > 0) ? templateConfig.sidebarLinks : [
                { label: 'Current Page', url: '#' },
                { label: 'Back to Home', url: '/' }
            ];
            blocks.push({
                id: 'legacy-links',
                type: 'quickLinks',
                title: 'QUICK LINKS',
                links: links
            });
        }
        if (templateConfig.showTextBox !== false) {
            // Include legacy fallback text if empty
            const content = templateConfig.textBoxContent || `<h2>Mission</h2><p>By integrating the fields of medicine...</p>`;
            blocks.push({
                id: 'legacy-text',
                type: 'textBox',
                title: 'Mission Box',
                content: content
            });
        }
        templateConfig.sidebarBlocks = blocks;
    }

    if (!templateConfig.stickyNavItems) {
        if (templateConfig.showStickyNav !== false) {
            templateConfig.stickyNavItems = [
                { label: "Mission and Vision", url: "#", icon: "fa-user", isActive: true },
                { label: "Director's Message", url: "/directors-message", icon: "fa-graduation-cap" },
                { label: "Former Directors", url: "#", icon: "fa-flask" },
                { label: "Annual Reports", url: "#", icon: "fa-book-open" },
                { label: "DBT-THSTI MoU", url: "#", icon: "fa-book" },
                { label: "Documentary", url: "#", icon: "fa-lightbulb" }
            ];
        } else {
            templateConfig.stickyNavItems = [];
        }
    }

    return (
        <main className="main-content">
            {/* Standard Page Title Header matching THSTI design templates */}
            <section className="page-banner" style={{ backgroundImage: `url(${pageData.bannerImageUrl ? (pageData.bannerImageUrl.startsWith('http') ? pageData.bannerImageUrl : ASSETS_BASE_URL + pageData.bannerImageUrl) : '/images/background/baby-11.png'})`, position: "relative" }}>
                <div className="auto-container">
                    <div className="inner-container clearfix notranslate bhashini-skip-translation">
                        <h1>{language === 'hi' && pageData.titleHi ? pageData.titleHi : pageData.title}</h1>
                        <ul className="bread-crumb clearfix">
                            <li><Link to="/">Home</Link></li>
                            <li>{pageData.breadcrumbTitle || (language === 'hi' && pageData.titleHi ? pageData.titleHi : pageData.title)}</li>
                        </ul>
                    </div>
                </div>
            </section>

            {/* ===== STICKY SCROLL NAV ===== */}
            {templateConfig.stickyNavItems && templateConfig.stickyNavItems.length > 0 && (
                <nav className="fp2-sticky-nav">
                    <div className="auto-container">
                        <div className="fp2-sticky-nav-inner">
                            {templateConfig.stickyNavItems.map((item, index) => (
                                <Link key={index} to={item.url || '#'} className={`fp2-nav-link ${item.isActive ? 'fp2-nav-active' : ''}`}>
                                    {item.icon && <i className={`fa-solid ${item.icon}`}></i>} {item.label}
                                </Link>
                            ))}
                        </div>
                    </div>
                </nav>
            )}

            {/* Render Standard Page Content */}
            {(pageData.pageType === 'Template' || pageData.pageType === 'Standard') && pageData.content && pageData.content.trim() !== '' && pageData.content.trim() !== '<p></p>' && (
                <div className="sidebar-page-container pt-5 pb-5">
                    <div className="auto-container">
                        <div className="row clearfix">
                            {/* Sidebar Side */}
                            {templateConfig.sidebarBlocks && templateConfig.sidebarBlocks.length > 0 && (
                                <div className="sidebar-side col-lg-4 col-md-12 col-sm-12" style={{ position: 'sticky', top: '20px', alignSelf: 'flex-start', zIndex: 10 }}>
                                    {templateConfig.sidebarBlocks.map((block, index) => {
                                        if (block.type === 'quickLinks') {
                                            return (
                                                <div key={block.id || index} className="sidebar-side sidebar mb-4">
                                                    <aside className="padding-right">
                                                        <div className="sidebar-widget categories-two">
                                                            <div className="widget-content">
                                                                <ul className="services-categories">
                                                                    {block.links && block.links.map((link, idx) => (
                                                                        <li key={idx} className={activeSidebarIndex === idx ? "active" : ""}>
                                                                            {link.url?.startsWith('#') ? (
                                                                                <a href={link.url} onClick={(e) => handleScrollToHeading(e, link.url, link.label, idx)}>
                                                                                    {link.label || link.url}
                                                                                </a>
                                                                            ) : link.url?.startsWith('/') ? (
                                                                                <Link to={link.url}>{link.label || link.url}</Link>
                                                                            ) : (
                                                                                <a href={link.url || '#'}>{link.label || link.url || 'Link'}</a>
                                                                            )}
                                                                        </li>
                                                                    ))}
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </aside>
                                                </div>
                                            );
                                        } else if (block.type === 'textBox') {
                                            return (
                                                <div key={block.id || index} className="visionbox mb-4" dangerouslySetInnerHTML={{ __html: block.content }}></div>
                                            );
                                        }
                                        return null;
                                    })}
                                </div>
                            )}

                            {/* Content Side */}
                            <div className={`content-side ${(templateConfig.sidebarBlocks && templateConfig.sidebarBlocks.length > 0) ? 'col-lg-8' : 'col-lg-12'} col-md-12 col-sm-12`}>
                                <div className="services-detail">
                                    <div className="inner-box notranslate bhashini-skip-translation">
                                        <div className="lower-content pt-0">
                                            <div className="title-box">
                                                <h2>{language === 'hi' && pageData.titleHi ? pageData.titleHi : pageData.title}</h2>
                                            </div>
                                        </div>
                                        <div className="text" dangerouslySetInnerHTML={{ __html: (language === 'hi' && pageData.contentHi ? pageData.contentHi : pageData.content).replace(/&nbsp;/g, ' ') }}></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            )}

            {/* Render Dynamic Listing Content */}
            {(pageData.pageType === 'ModuleLinked' || pageData.pageType === 'DynamicListing') && (
                <div className="dynamic-listing-container pt-5 pb-5">
                    <div className="auto-container">
                        {pageData.slug === 'faculty-and-scientists' && (
                            <FacultyGrid config={{ showSearch: true, showCategory: true, showPagination: true }} />
                        )}
                        {/* Add more dynamic modules here in the future if needed, e.g. Tenders, Events */}
                    </div>
                </div>
            )}
        </main>
    );
}

export default Page;
