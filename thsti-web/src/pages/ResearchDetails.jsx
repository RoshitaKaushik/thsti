import React, { useEffect, useState, useRef } from 'react';
import { Link, useParams, useNavigate } from 'react-router-dom';
import api from '../api/axios';
import { ASSETS_BASE_URL } from '../config/env';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Navigation, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import './ResearchDetails.css';
import { parseCmsContent } from '../utils/cmsParser';

const ResearchDetails = () => {
    const { slug } = useParams();
    const navigate = useNavigate();
    const [center, setCenter] = useState(null);
    const [otherCenters, setOtherCenters] = useState([]);
    const prevRef = useRef(null);
    const nextRef = useRef(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [activeTab, setActiveTab] = useState('contents');

    useEffect(() => {
        window.scrollTo(0, 0);
        const fetchCenterDetails = async () => {
            try {
                setLoading(true);
                // Fetch the specific center by slug
                const response = await api.get(`/research-centers/slug/${slug}`);
                setCenter(response.data);

                // Fetch other active centers for the bottom grid
                const listResponse = await api.get('/research-centers');
                const allCenters = listResponse.data.items || [];
                // Filter out the current one and show all others
                const others = allCenters.filter(c => c.slug !== slug);
                setOtherCenters(others);

            } catch (err) {
                console.error("Failed to load research center:", err);
                setError("Research Center not found.");
            } finally {
                setLoading(false);
            }
        };

        if (slug) {
            fetchCenterDetails();
        }
    }, [slug]);

    const getImageUrl = (path) => {
        if (!path) return '/images/resource/res-1.jpg'; // default placeholder
        if (path.startsWith('http')) return path;
        if (path.startsWith('/images/') || path.startsWith('images/')) {
            return path.startsWith('/') ? path : `/${path}`;
        }
        return `${ASSETS_BASE_URL}${path.startsWith('/') ? path : '/' + path}`;
    };

    const getLocalImageUrl = (path) => {
        return path.startsWith('/') ? path : `/${path}`;
    };

    if (loading) {
        return (
            <div className="sidebar-page-container pt-5 text-center">
                <div className="spinner-border text-primary" role="status">
                    <span className="visually-hidden">Loading...</span>
                </div>
            </div>
        );
    }

    if (error || !center) {
        return (
            <div className="sidebar-page-container pt-5 text-center">
                <h2>{error || "Center not found"}</h2>
                <Link to="/" className="theme-btn btn-style-one mt-3"><span className="txt">Back to Home</span></Link>
            </div>
        );
    }

    // Determine banner image
    const bannerImage = center.imageUrl ? getImageUrl(center.imageUrl) : getLocalImageUrl('images/background/baby-1.png');

    let cleanedContent = parseCmsContent(center.content, center.title);
    
    // Fix: Strip the duplicate excerpt from the beginning of the CMS content if present
    if (center.excerpt && cleanedContent) {
        try {
            const excerptRegex = new RegExp(`^[\\s\\S]{0,300}?(?:<p[^>]*>|<div[^>]*>)\\s*(?:<span[^>]*>|<strong[^>]*>|<b>|<i>)?\\s*${center.excerpt.substring(0, 15).replace(/[.*+?^\\${}()|[\\]\\\\]/g, '\\\\$&')}.*?(?:</p>|</div>)`, 'i');
            cleanedContent = cleanedContent.replace(excerptRegex, '');
        } catch (err) {
            console.error("Failed to clean excerpt:", err);
        }
    }

    const tabs = [
        { id: 'contents', label: 'Contents', content: cleanedContent },
        { id: 'overview', label: 'Overview', content: center.overviewContent },
        { id: 'careers', label: 'Careers', content: center.careersContent },
        { id: 'admissions', label: 'Admissions', content: center.admissionsContent }
    ].filter(t => t.content && t.content.trim() !== '' && t.content.trim() !== '<p></p>');

    if (!tabs.find(t => t.id === activeTab) && tabs.length > 0) {
        setActiveTab(tabs[0].id);
    }

    return (
        <>
            {/* Page Banner */}
            <section className="page-banner" style={{ backgroundImage: `url(${bannerImage})`, backgroundSize: 'cover', backgroundPosition: 'center' }}>
                <div className="auto-container">
                    <div className="inner-container clearfix">
                        <h1>{center.title}</h1>
                        <ul className="bread-crumb clearfix">
                            <li><Link to="/">Home</Link></li>
                            <li>{center.title}</li>
                        </ul>
                    </div>
                </div>
            </section>

            {/* Sidebar Page Container */}
            <div className="sidebar-page-container pt-5">
                <div className="auto-container">
                    <div className="row clearfix">
                        {/* Sidebar Side */}
                        <div className="sidebar-side col-lg-4 col-md-12 col-sm-12" style={{ position: 'sticky', top: '20px', alignSelf: 'flex-start', zIndex: 10 }}>
                            <aside className="sidebar padding-right">
                                {/* Category Widget */}
                                <div className="sidebar-widget categories-two">
                                    <div className="widget-content">
                                        <ul className="services-categories">
                                            {tabs.map(tab => (
                                                <li key={tab.id} className={activeTab === tab.id ? 'active' : ''}>
                                                    <a href="#" onClick={(e) => { e.preventDefault(); setActiveTab(tab.id); }}>{tab.label}</a>
                                                </li>
                                            ))}
                                        </ul>
                                    </div>
                                </div>
                            </aside>
                        </div>
                        
                        {/* Content Side */}
                        <div className="content-side col-lg-8 col-md-12 col-sm-12">
                            <div className="services-detail">
                                <div className="inner-box">
                                    <div className="lower-content pt-0">
                                        <div className="title-box mb-4" style={{ paddingBottom: '10px', borderBottom: '1px solid #eee' }}>
                                            <h2 style={{ fontSize: '2.4rem', color: '#002147', fontWeight: '800', margin: 0, paddingBottom: '15px' }}>{center.title}</h2>
                                        </div>
                                        
                                        <div className="mt-4">
                                            {tabs.length > 0 ? (
                                                tabs.map(tab => (
                                                    activeTab === tab.id && (
                                                        <div key={tab.id} className="text cms-rich-text" dangerouslySetInnerHTML={{ __html: tab.content }} />
                                                    )
                                                ))
                                            ) : (
                                                <p>No detailed content available for this research center yet.</p>
                                            )}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Other Research Centers Section */}
            {otherCenters && otherCenters.length > 0 && (
                <section className="services-section-two mb-0 what-we-offer">
                    <div className="auto-container">
                        <div className="inner-container">
                            <div className="big-icon flaticon-settings-4"></div>
                            
                            <div className="sec-title light">
                                <div className="row clearfix">
                                    <div className="pull-left col-xl-12 col-lg-5 col-md-12 col-sm-12">
                                        <h2>Other Research Centers</h2>
                                    </div>
                                </div>
                            </div>

                            <div style={{ position: 'relative' }}>
                                {/* Custom Navigation Arrows to match design9 */}
                                <div className="owl-nav">
                                    <div className="owl-prev" ref={prevRef}><span className="fas fa-angle-left"></span></div>
                                    <div className="owl-next" ref={nextRef}><span className="fas fa-angle-right"></span></div>
                                </div>

                                <Swiper
                                    modules={[Navigation, Autoplay]}
                                    spaceBetween={30}
                                    slidesPerView={1}
                                    navigation={{
                                        prevEl: prevRef?.current,
                                        nextEl: nextRef?.current,
                                    }}
                                    onBeforeInit={(swiper) => {
                                        swiper.params.navigation.prevEl = prevRef.current;
                                        swiper.params.navigation.nextEl = nextRef.current;
                                    }}
                                    autoplay={{
                                        delay: 5000,
                                        disableOnInteraction: false,
                                    }}
                                    breakpoints={{
                                        640: { slidesPerView: 1 },
                                        768: { slidesPerView: 2 },
                                        1024: { slidesPerView: 4 },
                                        1200: { slidesPerView: 5 },
                                    }}
                                    className="three-item-carousel"
                                >
                                {otherCenters.map((item, index) => {
                                    const finalImageUrl = item.imageUrl ? getImageUrl(item.imageUrl) : '/images/resource/res-1.jpg';
                                    return (
                                        <SwiperSlide key={item.id || index}>
                                            <div className="services-block-three">
                                                <div className="inner-box">
                                                    <div className="image">
                                                        {item.isExternal ? (
                                                            <a href={item.routeUrl} target={item.openInNewTab ? "_blank" : "_self"} rel={item.openInNewTab ? "noreferrer" : ""}>
                                                                <img src={finalImageUrl} alt={item.title} />
                                                            </a>
                                                        ) : (
                                                            <Link to={item.routeUrl || `/research-centers/${item.slug}`}>
                                                                <img src={finalImageUrl} alt={item.title} />
                                                            </Link>
                                                        )}
                                                    </div>
                                                    <div className="lower-content">
                                                        <h3>
                                                            {item.isExternal ? (
                                                                <a href={item.routeUrl} target={item.openInNewTab ? "_blank" : "_self"} rel={item.openInNewTab ? "noreferrer" : ""}>
                                                                    {item.title}
                                                                </a>
                                                            ) : (
                                                                <Link to={item.routeUrl || `/research-centers/${item.slug}`}>
                                                                    {item.title}
                                                                </Link>
                                                            )}
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </SwiperSlide>
                                    );
                                })}
                                </Swiper>
                            </div>
                        </div>
                    </div>
                </section>
            )}

        </>
    );
};

export default ResearchDetails;
