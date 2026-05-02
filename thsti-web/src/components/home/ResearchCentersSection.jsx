import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { API_BASE_URL } from '../../config/env';
import api from '../../api/axios';

const ResearchCentersSection = () => {
    const [centers, setCenters] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchCenters = async () => {
            try {
                const response = await api.get('/research-centers');
                if (response.data) {
                    const data = response.data;
                    if (data.items && data.items.length > 0) {
                        setCenters(data.items);
                        return;
                    } else if (Array.isArray(data)) {
                        setCenters(data);
                        return;
                    }
                }
            } catch (error) {
                console.error("Failed to fetch research centers:", error);
            } finally {
                setLoading(false);
            }
        };

        fetchCenters();
    }, []);

    const renderLink = (center, children) => {
        const linkClass = "read-more";
        const url = center.routeUrl || `/research-centers/${center.slug}`;

        if (center.isExternal && center.openInNewTab) {
            return <a href={url} target="_blank" rel="noreferrer" className={linkClass}>{children}</a>;
        } else if (center.isExternal && !center.openInNewTab) {
            return <a href={url} className={linkClass}>{children}</a>;
        } else if (!center.isExternal && center.openInNewTab) {
            // Edge case: Internal link but admin forced new tab
            return <a href={url} target="_blank" rel="noreferrer" className={linkClass}>{children}</a>;
        } else {
            return <Link to={url} className={linkClass}>{children}</Link>;
        }
    };

    const renderTitleLink = (center, children) => {
        const url = center.routeUrl || `/research-centers/${center.slug}`;
        if (center.isExternal && center.openInNewTab) {
            return <a href={url} target="_blank" rel="noreferrer">{children}</a>;
        } else if (center.isExternal && !center.openInNewTab) {
            return <a href={url}>{children}</a>;
        } else if (!center.isExternal && center.openInNewTab) {
            return <a href={url} target="_blank" rel="noreferrer">{children}</a>;
        } else {
            return <Link to={url}>{children}</Link>;
        }
    };

    if (centers.length === 0) {
        return (
            <section className="what-we-offer pt-5 pb-0 what-we-offer-first" style={{ background: '#f3f5f9' }}>
                <div className="auto-container">
                    <div className="row clearfix">
                        {/* Text Column */}
                        <div className="text-column col-lg-12 col-md-12 col-sm-12 ">
                            <div className="sec-title sec-title-box">
                                <div className="auto-container clearfix">
                                    <h2>Research Centers</h2>
                                </div>
                            </div>
                            <div className="row clearfix">
                                <div className="services-block-three col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                    <div className="inner-box wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                                        <div className="image"><a href="#"><img src="images/resource/res-1.jpg" alt="" /></a></div>
                                        <div className="lower-content">
                                            <h3><a href="#">Maternal and Child Health</a></h3>
                                            <div className="text">Pregnancy (fetal life) and the first two years of life are the most critical periods that shape a person's health...</div>
                                            <a href="details.html" className="read-more">Read More <span className="fas fa-angle-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                                <div className="services-block-three col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                    <div className="inner-box wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                                        <div className="image"><a href="#"><img src="images/resource/res-2.jpg" alt="" /></a></div>
                                        <div className="lower-content">
                                            <h3><a href="#">Virus Research, Therapeutics and Vaccines</a></h3>
                                            <div className="text">The centre is dedicated to understand how the tools, technologies platforms and knowledge can be harnessed to...</div>
                                            <a href="#" className="read-more">Read More <span className="fas fa-angle-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                                <div className="services-block-three col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                    <div className="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                                        <div className="image"><a href="#"><img src="images/resource/res-3.jpg" alt="" /></a></div>
                                        <div className="lower-content">
                                            <h3><a href="#">Tuberculosis Research</a></h3>
                                            <div className="text">Center for Tuberculosis Research has pioneered in designing the CRISPRi tool for conditional silencing of genes...</div>
                                            <a href="#" className="read-more">Read More <span className="fas fa-angle-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                                <div className="services-block-three col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                    <div className="inner-box wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                                        <div className="image"><a href="#"><img src="images/resource/res-4.jpg" alt="" /></a></div>
                                        <div className="lower-content">
                                            <h3><a href="#">Microbial Research</a></h3>
                                            <div className="text">The Centre for Microbial Research (CMR) was created as a niche Centre of THSTI to explore the interactions...</div>
                                            <a href="#" className="read-more">Read More <span className="fas fa-angle-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                                <div className="services-block-three col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                    <div className="inner-box wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                                        <div className="image"><a href="#"><img src="images/resource/res-5.jpg" alt="" /></a></div>
                                        <div className="lower-content">
                                            <h3><a href="#">Immunobiology and Immunotherapy</a></h3>
                                            <div className="text">Understanding effector and regulatory T cell response in autoimmune, inflammatory diseases and cancer...</div>
                                            <a href="#" className="read-more">Read More <span className="fas fa-angle-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                                <div className="services-block-three col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                    <div className="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                                        <div className="image"><a href="#"><img src="images/resource/res-6.jpg" alt="" /></a></div>
                                        <div className="lower-content">
                                            <h3><a href="#">Drug Discovery</a></h3>
                                            <div className="text">The Center for Drug Discovery (CDD) is a multi-disciplinary unit that integrates basic with translational research to...</div>
                                            <a href="#" className="read-more">Read More <span className="fas fa-angle-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                                <div className="services-block-three col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                    <div className="inner-box wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                                        <div className="image"><a href="#"><img src="images/resource/res-7.jpg" alt="" /></a></div>
                                        <div className="lower-content">
                                            <h3><a href="#">Clinical Development Services Agency</a></h3>
                                            <div className="text">The Clinical Development Services Agency (CDSA) functions as an academic research unit established...</div>
                                            <a href="#" className="read-more">Read More <span className="fas fa-angle-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                                <div className="services-block-three col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                    <div className="inner-box wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                                        <div className="image"><a href="#"><img src="images/resource/res-8.jpg" alt="" /></a></div>
                                        <div className="lower-content">
                                            <h3><a href="#">Computational and Mathematical Biology</a></h3>
                                            <div className="text">Develop novel computational tools and mathematical models to address biological problems...</div>
                                            <a href="#" className="read-more">Read More <span className="fas fa-angle-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        );
    }

    return (
        <section className="what-we-offer pt-5 pb-0 what-we-offer-first" style={{}}>
            <div className="auto-container">
                <div className="row clearfix">
                    {/* Text Column */}
                    <div className="text-column col-lg-12 col-md-12 col-sm-12 ">
                        <div className="sec-title sec-title-box">
                            <div className="auto-container clearfix">
                                <h2>Research Centers</h2>
                            </div>
                        </div>

                        <div className="row clearfix">
                            {centers.map((center, index) => {
                                // Calculate delay to stagger animation like original template
                                const delay = index % 4 === 1 || index % 4 === 3 ? "300ms" : index % 4 === 2 ? "0ms" : "600ms";

                                let finalImageUrl = '';
                                if (center.imageUrl) {
                                    if (center.imageUrl.startsWith('http')) {
                                        finalImageUrl = center.imageUrl;
                                    } else if (center.imageUrl.includes('uploads/')) {
                                        finalImageUrl = `${API_BASE_URL.replace('/api', '')}/${center.imageUrl.replace(/^\//, '')}`;
                                    } else {
                                        finalImageUrl = `/${center.imageUrl.replace(/^\//, '')}`;
                                    }
                                } else {
                                    finalImageUrl = '/images/resource/res-1.jpg';
                                }

                                return (
                                    <div key={center.id || index} className="services-block-three col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                        <div className="inner-box wow fadeInUp h-100 d-flex flex-column" data-wow-delay={delay} data-wow-duration="1500ms">
                                            <div className="image">
                                                {finalImageUrl ? renderTitleLink(center, <img src={finalImageUrl} alt={center.title} onError={(e) => { e.target.style.display = 'none'; }} />) : renderTitleLink(center, <div style={{width: '100%', height: '260px', backgroundColor: '#e2e8f0'}}></div>)}
                                            </div>
                                            <div className="lower-content flex-grow-1 d-flex flex-column">
                                                <h3>{renderTitleLink(center, center.title)}</h3>
                                                <div className="text" style={{ display: '-webkit-box', WebkitLineClamp: 3, WebkitBoxOrient: 'vertical', overflow: 'hidden' }} dangerouslySetInnerHTML={{ __html: center.excerpt }}></div>
                                                <div className="mt-auto">
                                                    {renderLink(center, <React.Fragment>Read More <span className="fas fa-angle-right"></span></React.Fragment>)}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                );
                            })}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
};

export default ResearchCentersSection;
