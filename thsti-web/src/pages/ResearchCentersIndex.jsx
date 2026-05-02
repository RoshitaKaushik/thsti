import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import api from '../api/axios';
import { ASSETS_BASE_URL } from '../config/env';

const ResearchCentersIndex = () => {
    const [centers, setCenters] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        window.scrollTo(0, 0);
        const fetchCenters = async () => {
            try {
                setLoading(true);
                const response = await api.get('/research-centers');
                setCenters(response.data.items || []);
            } catch (err) {
                console.error("Failed to load research centers:", err);
                setError("Failed to load Research Centers.");
            } finally {
                setLoading(false);
            }
        };

        fetchCenters();
    }, []);

    const getImageUrl = (path) => {
        if (!path) return '/images/resource/res-1.jpg';
        if (path.startsWith('http')) return path;
        if (path.startsWith('/images/') || path.startsWith('images/')) {
            return path.startsWith('/') ? path : `/${path}`;
        }
        return `${ASSETS_BASE_URL}${path.startsWith('/') ? path : '/' + path}`;
    };

    const getLocalImageUrl = (path) => {
        return path.startsWith('/') ? path : `/${path}`;
    };

    return (
        <>
            {/* Page Banner */}
            <section className="page-banner" style={{ backgroundImage: `url(${getLocalImageUrl('images/background/baby-1.png')})`, backgroundSize: 'cover', backgroundPosition: 'center' }}>
                <div className="auto-container">
                    <div className="inner-container clearfix">
                        <h1>Research Centers</h1>
                        <ul className="bread-crumb clearfix">
                            <li><Link to="/">Home</Link></li>
                            <li>Research Centers</li>
                        </ul>
                    </div>
                </div>
            </section>

            {/* Main Content */}
            <div className="sidebar-page-container pt-5 pb-5">
                <div className="auto-container">
                    <div className="sec-title">
                        <div className="row clearfix">
                            <div className="pull-left col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <h2>Our Research Centers</h2>
                                <div className="text mt-3">
                                    THSTI has developed multiple thematic research centers to address complex biological problems. These centers work in tandem, utilizing interdisciplinary approaches.
                                </div>
                            </div>
                        </div>
                    </div>

                    {loading ? (
                        <div className="text-center mt-5 mb-5">
                            <div className="spinner-border text-primary" role="status">
                                <span className="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    ) : error ? (
                        <div className="text-center mt-5 mb-5">
                            <h3 className="text-danger">{error}</h3>
                        </div>
                    ) : (
                        <div className="row mt-5">
                            {centers.map(center => (
                                <div key={center.id} className="col-xl-3 col-lg-4 col-md-6 col-sm-12 services-block-three mb-5">
                                    <div className="inner-box shadow-sm" style={{ borderRadius: '24px', backgroundColor: '#fff', overflow: 'hidden' }}>
                                        <div className="image">
                                            {center.isExternal ? (
                                                <a href={center.routeUrl} target={center.openInNewTab ? "_blank" : "_self"} rel={center.openInNewTab ? "noreferrer" : ""}>
                                                    <img 
                                                        src={center.imageUrl ? getImageUrl(center.imageUrl) : getLocalImageUrl('images/resource/res-2.jpg')} 
                                                        alt={center.title} 
                                                        style={{ height: '200px', objectFit: 'cover', width: '100%', borderTopLeftRadius: '24px', borderTopRightRadius: '24px' }}
                                                    />
                                                </a>
                                            ) : (
                                                <Link to={center.routeUrl || `/research-centers/${center.slug}`}>
                                                    <img 
                                                        src={center.imageUrl ? getImageUrl(center.imageUrl) : getLocalImageUrl('images/resource/res-2.jpg')} 
                                                        alt={center.title} 
                                                        style={{ height: '200px', objectFit: 'cover', width: '100%', borderTopLeftRadius: '24px', borderTopRightRadius: '24px' }}
                                                    />
                                                </Link>
                                            )}
                                        </div>
                                        <div className="lower-content" style={{ padding: '25px 20px' }}>
                                            <h3>
                                                {center.isExternal ? (
                                                    <a 
                                                        href={center.routeUrl} 
                                                        target={center.openInNewTab ? "_blank" : "_self"} 
                                                        rel={center.openInNewTab ? "noreferrer" : ""}
                                                        style={{ fontSize: '20px', fontWeight: '800', color: '#1a1a1a', textDecoration: 'none' }}
                                                    >
                                                        {center.title}
                                                    </a>
                                                ) : (
                                                    <Link 
                                                        to={center.routeUrl || `/research-centers/${center.slug}`}
                                                        style={{ fontSize: '20px', fontWeight: '800', color: '#1a1a1a', textDecoration: 'none' }}
                                                    >
                                                        {center.title}
                                                    </Link>
                                                )}
                                            </h3>
                                            {center.excerpt && (
                                                <p className="mt-3" style={{ fontSize: '14px', lineHeight: '1.6', color: '#4a4a4a', display: '-webkit-box', WebkitLineClamp: 3, WebkitBoxOrient: 'vertical', overflow: 'hidden' }}>
                                                    {center.excerpt}
                                                </p>
                                            )}
                                            <div className="mt-4">
                                                {center.isExternal ? (
                                                    <a 
                                                        href={center.routeUrl} 
                                                        target={center.openInNewTab ? "_blank" : "_self"} 
                                                        rel={center.openInNewTab ? "noreferrer" : ""}
                                                        style={{ fontSize: '14px', fontWeight: '700', color: '#4a4a4a', textDecoration: 'none', display: 'flex', alignItems: 'center', textTransform: 'uppercase' }}
                                                    >
                                                        <span style={{ borderBottom: '2px solid #4a4a4a', paddingBottom: '2px' }}>Read More</span>
                                                        <i className="fa-solid fa-chevron-right ms-2" style={{ color: '#0056b3', fontSize: '12px' }}></i>
                                                    </a>
                                                ) : (
                                                    <Link 
                                                        to={center.routeUrl || `/research-centers/${center.slug}`}
                                                        style={{ fontSize: '14px', fontWeight: '700', color: '#4a4a4a', textDecoration: 'none', display: 'flex', alignItems: 'center', textTransform: 'uppercase' }}
                                                    >
                                                        <span style={{ borderBottom: '2px solid #4a4a4a', paddingBottom: '2px' }}>Read More</span>
                                                        <i className="fa-solid fa-chevron-right ms-2" style={{ color: '#0056b3', fontSize: '12px' }}></i>
                                                    </Link>
                                                )}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    )}
                </div>
            </div>
        </>
    );
};

export default ResearchCentersIndex;
