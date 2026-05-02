import React, { useEffect, useState } from 'react';
import { Link, useParams, useNavigate } from 'react-router-dom';
import api from '../api/axios';
import { ASSETS_BASE_URL } from '../config/env';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Navigation, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import './ResearchDetails.css';
import { parseCmsContent } from '../utils/cmsParser';
const FacilityDetails = () => {
    const { slug } = useParams();
    const navigate = useNavigate();
    const [facility, setFacility] = useState(null);
    const [allFacilities, setAllFacilities] = useState([]);
    const [otherFacilities, setOtherFacilities] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        window.scrollTo(0, 0);
        const fetchFacilityDetails = async () => {
            try {
                setLoading(true);
                // Fetch the specific facility by slug
                const response = await api.get(`/research-facilities/slug/${slug}`);
                setFacility(response.data);

                // Fetch other active facilities for the sidebar and bottom grid
                const listResponse = await api.get('/research-facilities');
                const listData = listResponse.data.items || listResponse.data || [];
                setAllFacilities(listData);
                
                // Filter out the current one and show all others for bottom carousel
                const others = listData.filter(c => c.slug !== slug);
                setOtherFacilities(others);

            } catch (err) {
                console.error("Failed to load research facility:", err);
                setError("Research Facility not found.");
            } finally {
                setLoading(false);
            }
        };

        if (slug) {
            fetchFacilityDetails();
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

    if (error || !facility) {
        return (
            <div className="sidebar-page-container pt-5 text-center">
                <h2>{error || "Facility not found"}</h2>
                <Link to="/" className="theme-btn btn-style-one mt-3"><span className="txt">Back to Home</span></Link>
            </div>
        );
    }

    // Determine banner image
    const bannerImage = facility.imageUrl ? getImageUrl(facility.imageUrl) : getLocalImageUrl('images/background/baby-1.png');

    const cleanedContent = parseCmsContent(facility.content, facility.title);

    return (
        <>
            {/* Page Banner */}
            <section className="page-banner" style={{ backgroundImage: `url(${bannerImage})`, backgroundSize: 'cover', backgroundPosition: 'center' }}>
                <div className="auto-container">
                    <div className="inner-container clearfix">
                        <h1>{facility.title}</h1>
                        <ul className="bread-crumb clearfix">
                            <li><Link to="/">Home</Link></li>
                            <li><Link to="/">Research Facilities</Link></li>
                            <li>{facility.title}</li>
                        </ul>
                    </div>
                </div>
            </section>

            {/* Sidebar Page Container */}
            <div className="sidebar-page-container pt-5">
                <div className="auto-container">
                    <div className="row justify-content-center clearfix">
                        {/* Content Side */}
                        <div className="content-side col-lg-10 col-md-12 col-sm-12">
                            <div className="services-detail">
                                <div className="inner-box" style={{ background: '#fff', borderRadius: '15px', padding: '50px', boxShadow: '0 15px 50px rgba(0,0,0,0.04)', border: '1px solid #f5f6f8', marginTop: '-30px', position: 'relative', zIndex: 2 }}>
                                    <div className="lower-content pt-0">
                                        <div className="title-box mb-4" style={{ paddingBottom: '10px', borderBottom: '1px solid #eee' }}>
                                            <h2 style={{ fontSize: '2.4rem', color: '#002147', fontWeight: '800', margin: 0, paddingBottom: '15px' }}>{facility.title}</h2>
                                        </div>
                                        <div id="overview" className="mt-4">
                                        {cleanedContent ? (
                                            <div className="text cms-rich-text" dangerouslySetInnerHTML={{ __html: cleanedContent }} />
                                        ) : (
                                            <p>No detailed content available for this research facility yet.</p>
                                        )}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Other Research Facilities Section */}
            {otherFacilities && otherFacilities.length > 0 && (
                <section className="services-section-two mb-0 py-5" style={{ overflow: 'hidden' }}>
                    <div className="auto-container">
                        <div className="inner-container">
                            <span className="icon big-icon fas fa-flask" style={{ left: '-150px', top: '-10px', fontSize: '350px', color: 'rgba(255,255,255,0.08)' }}></span>
                            
                            <div className="d-flex justify-content-between align-items-start mb-5" style={{ position: 'relative', zIndex: 2 }}>
                                <div className="sec-title light mb-0">
                                    <h2 style={{ margin: 0 }}>Other Research Facilities</h2>
                                </div>
                                <div className="swiper-nav-buttons d-none d-md-block mt-2">
                                    <button className="other-facility-prev" style={{ background: 'transparent', border: 'none', color: '#fff', fontSize: '15px', padding: '5px 15px', cursor: 'pointer' }}><i className="fas fa-chevron-left"></i></button>
                                    <span style={{ color: 'rgba(255,255,255,0.3)', margin: '0 5px', fontSize: '18px' }}>|</span>
                                    <button className="other-facility-next" style={{ background: 'transparent', border: 'none', color: '#fff', fontSize: '15px', padding: '5px 15px', cursor: 'pointer' }}><i className="fas fa-chevron-right"></i></button>
                                </div>
                            </div>

                            <Swiper
                                modules={[Navigation, Autoplay]}
                                spaceBetween={25}
                                slidesPerView={1}
                                navigation={{
                                    nextEl: '.other-facility-next',
                                    prevEl: '.other-facility-prev',
                                }}
                                autoplay={{
                                    delay: 5000,
                                    disableOnInteraction: false,
                                }}
                                breakpoints={{
                                    640: { slidesPerView: 2 },
                                    768: { slidesPerView: 3 },
                                    1024: { slidesPerView: 4 },
                                    1200: { slidesPerView: 5 },
                                }}
                                style={{ position: 'relative', zIndex: 2 }}
                            >
                                {otherFacilities.map((item, index) => {
                                    const finalImageUrl = item.imageUrl ? getImageUrl(item.imageUrl) : '/images/resource/res-1.jpg';
                                    return (
                                        <SwiperSlide key={item.id || index}>
                                            {item.isExternal ? (
                                                <a href={item.routeUrl} target={item.openInNewTab ? "_blank" : "_self"} rel={item.openInNewTab ? "noreferrer" : ""} className="d-block h-100" style={{ textDecoration: 'none' }}>
                                                    <div className="services-block-two mb-0 h-100" style={{ transition: 'transform 0.3s ease' }}
                                                        onMouseEnter={(e) => e.currentTarget.style.transform = 'translateY(-5px)'}
                                                        onMouseLeave={(e) => e.currentTarget.style.transform = 'translateY(0)'}
                                                    >
                                                        <div className="inner-box bg-white h-100 shadow-sm" style={{ borderRadius: '20px', overflow: 'hidden', display: 'flex', flexDirection: 'column' }}>
                                                            <div className="image" style={{ width: '100%', height: '170px' }}>
                                                                <img src={finalImageUrl} alt={item.title} style={{ width: '100%', height: '100%', objectFit: 'cover' }} onError={(e) => { e.target.style.display = 'none'; }} />
                                                            </div>
                                                            <div className="lower-content flex-grow-1" style={{ padding: '25px 20px', paddingTop: '20px' }}>
                                                                <h3 style={{ fontSize: '16px', fontWeight: '800', color: '#1a1a1a', margin: 0, lineHeight: '1.4' }}>{item.title}</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            ) : (
                                                <Link to={item.routeUrl || `/research-facilities/${item.slug}`} className="d-block h-100" style={{ textDecoration: 'none' }}>
                                                    <div className="services-block-two mb-0 h-100" style={{ transition: 'transform 0.3s ease' }}
                                                        onMouseEnter={(e) => e.currentTarget.style.transform = 'translateY(-5px)'}
                                                        onMouseLeave={(e) => e.currentTarget.style.transform = 'translateY(0)'}
                                                    >
                                                        <div className="inner-box bg-white h-100 shadow-sm" style={{ borderRadius: '20px', overflow: 'hidden', display: 'flex', flexDirection: 'column' }}>
                                                            <div className="image" style={{ width: '100%', height: '170px' }}>
                                                                <img src={finalImageUrl} alt={item.title} style={{ width: '100%', height: '100%', objectFit: 'cover' }} onError={(e) => { e.target.style.display = 'none'; }} />
                                                            </div>
                                                            <div className="lower-content flex-grow-1" style={{ padding: '25px 20px', paddingTop: '20px' }}>
                                                                <h3 style={{ fontSize: '16px', fontWeight: '800', color: '#1a1a1a', margin: 0, lineHeight: '1.4' }}>{item.title}</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </Link>
                                            )}
                                        </SwiperSlide>
                                    );
                                })}
                            </Swiper>
                        </div>
                    </div>
                </section>
            )}
        </>
    );
};

export default FacilityDetails;
