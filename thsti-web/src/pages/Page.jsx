import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import api from '../api/axios';
import { ASSETS_BASE_URL } from '../config/env';
import { useSeo } from '../hooks/useSeo';
import FacultyGrid from '../components/faculty/FacultyGrid';

const Page = () => {
    const { slug } = useParams();
    const [pageData, setPageData] = useState(null);
    const [error, setError] = useState(false);
    const [loading, setLoading] = useState(true);

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

    const showSidebar = templateConfig.showSidebar === true;
    const showTextBox = templateConfig.showTextBox === true;
    const showStickyNav = templateConfig.showStickyNav === true;

    return (
        <main className="main-content">
            {/* Standard Page Title Header matching THSTI design templates */}
            <section className="page-banner" style={{ backgroundImage: `url(${pageData.bannerImageUrl ? (pageData.bannerImageUrl.startsWith('http') ? pageData.bannerImageUrl : ASSETS_BASE_URL + pageData.bannerImageUrl) : '/images/background/baby-11.png'})`, position: "relative" }}>
                <div className="auto-container">
                    <div className="inner-container clearfix">
                        <h1>{pageData.title}</h1>
                        <ul className="bread-crumb clearfix">
                            <li><Link to="/">Home</Link></li>
                            <li>{pageData.breadcrumbTitle || pageData.title}</li>
                        </ul>
                    </div>
                </div>
            </section>

            {/* ===== STICKY SCROLL NAV ===== */}
            {showStickyNav && (
                <nav className="fp2-sticky-nav">
                    <div className="auto-container">
                        <div className="fp2-sticky-nav-inner">
                            <Link to="#" className="fp2-nav-link fp2-nav-active"><i className="fa-solid fa-user"></i> Mission and Vision</Link>
                            <Link to="/directors-message" className="fp2-nav-link"><i className="fa-solid fa-graduation-cap"></i> Director's Message</Link>
                            <Link to="#" className="fp2-nav-link"><i className="fa-solid fa-flask"></i> Former Directors</Link>
                            <Link to="#" className="fp2-nav-link"><i className="fa-solid fa-book-open"></i> Annual Reports</Link>
                            <Link to="#" className="fp2-nav-link"><i className="fa-solid fa-book"></i> DBT-THSTI MoU</Link>
                            <Link to="#" className="fp2-nav-link"><i className="fa-solid fa-lightbulb"></i> Documentary</Link>
                        </div>
                    </div>
                </nav>
            )}

            {/* Render Standard Page Content */}
            {pageData.pageType === 'Standard' && pageData.content && pageData.content.trim() !== '' && pageData.content.trim() !== '<p></p>' && (
                <div className="sidebar-page-container pt-5 pb-5">
                    <div className="auto-container">
                        <div className="row clearfix">
                            {/* Sidebar Side */}
                            {showSidebar && (
                                <div className="col-lg-4 col-md-12 col-sm-12">
                                    <div className="sidebar-side sidebar">
                                        <aside className="padding-right">
                                            {/* Category Widget / Side Menu */}
                                            <div className="sidebar-widget categories-two">
                                                <div className="widget-content">
                                                    <ul className="services-categories">
                                                        {templateConfig.sidebarLinks && templateConfig.sidebarLinks.length > 0 ? (
                                                            templateConfig.sidebarLinks.map((link, idx) => (
                                                                <li key={idx} className={idx === 0 ? "active" : ""}>
                                                                    {link.url.startsWith('/') ? (
                                                                        <Link to={link.url}>{link.label}</Link>
                                                                    ) : (
                                                                        <a href={link.url}>{link.label}</a>
                                                                    )}
                                                                </li>
                                                            ))
                                                        ) : (
                                                            <>
                                                                <li className="active"><a href="#">Current Page</a></li>
                                                                <li><Link to="/">Back to Home</Link></li>
                                                            </>
                                                        )}
                                                    </ul>
                                                </div>
                                            </div>
                                        </aside>
                                    </div>
                                    
                                    {/* Text Box Below Sidebar */}
                                    {showTextBox && (
                                        <>
                                            {templateConfig.textBoxContent ? (
                                                <div className="visionbox-wrapper" dangerouslySetInnerHTML={{ __html: templateConfig.textBoxContent }}></div>
                                            ) : (
                                                <>
                                                    <div className="visionbox">
                                                        <h2>Mission</h2>
                                                        <p>
                                                            By integrating the fields of medicine, science engineering and technology
                                                            into translational knowledge and making the resulting biomedical innovations
                                                            accessible to public health, to improve the health of the most disadvantaged
                                                            people in India and throughout the world.
                                                        </p>
                                                    </div>
                                                    <div className="visionbox">
                                                        <h2>Vision</h2>
                                                        <p>
                                                            As a networked organization linking many centers of excellence, THSTI is envisioned as a collective of scientists, engineers and physicians that will effectively enhance the quality of human life through integrating a culture of shared excellence in research, education
                                                        </p>
                                                    </div>
                                                </>
                                            )}
                                        </>
                                    )}
                                </div>
                            )}

                            {/* Content Side */}
                            <div className={`content-side ${showSidebar ? 'col-lg-8' : 'col-lg-12'} col-md-12 col-sm-12`}>
                                <div className="services-detail">
                                    <div className="inner-box">
                                        <div className="lower-content pt-0">
                                            <div className="title-box">
                                                <h2>{pageData.title}</h2>
                                            </div>
                                        </div>
                                        <div className="text" dangerouslySetInnerHTML={{ __html: pageData.content.replace(/&nbsp;/g, ' ') }}></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            )}

            {/* Render Dynamic Listing Content */}
            {pageData.pageType === 'DynamicListing' && (
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
