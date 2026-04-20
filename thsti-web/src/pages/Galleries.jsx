import React, { useState, useEffect } from 'react';
import api from '../api/axios';
import { ASSETS_BASE_URL } from '../config/env';
import { useSeo } from '../hooks/useSeo';

const Galleries = () => {
    const [galleries, setGalleries] = useState([]);
    const [loading, setLoading] = useState(true);

    useSeo({
        title: 'Photo Galleries | THSTI',
        metaDescription: 'Explore photo galleries and visual stories from the Translational Health Science and Technology Institute (THSTI).'
    });

    useEffect(() => {
        window.scrollTo(0, 0);
        api.get('/gallery')
            .then(res => setGalleries(res.data))
            .catch(err => console.error("CMS Galleries Fetch Error:", err))
            .finally(() => setLoading(false));
    }, []);

    // Filter active items and format date
    const activeItems = galleries.filter(g => g.isActive !== false).sort((a, b) => {
        if(a.date && b.date) return new Date(b.date) - new Date(a.date);
        return 0;
    });

    return (
        <>
            {/* Page Title */}
            <section className="page-title" style={{backgroundImage: "url(images/background/bg-13.jpg)"}}>
                <div className="auto-container">
                    <div className="content-box">
                        <div className="content-wrapper">
                            <div className="title">
                                <h1>Photo Galleries</h1>
                            </div>
                            <ul className="bread-crumb style-two">
                                <li><a href="/">Home</a></li>
                                <li className="active">Galleries</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            {/* Galleries Grid */}
            <section className="news-section alternate pt-10 pb-10">
                <div className="auto-container">
                    {loading ? (
                        <div className="text-center py-20 text-xl font-bold">Loading Galleries...</div>
                    ) : activeItems.length === 0 ? (
                        <div className="text-center py-20 text-xl text-gray-500">No galleries available at the moment.</div>
                    ) : (
                        <div className="row clearfix">
                            {activeItems.map((item, index) => {
                                const delay = `${(index % 3) * 300}ms`;
                                return (
                                    <div key={item.id || index} className="news-block col-lg-4 col-md-6 col-sm-12">
                                        <div className="inner-box wow fadeInUp" data-wow-delay={delay} data-wow-duration="1500ms">
                                            <div className="image">
                                                {/* If there's an explicit URL, wrap image in it, else just show the cover image */}
                                                <a href={item.url || '#'} onClick={e => !item.url && e.preventDefault()}>
                                                    <img src={item.coverImageUrl ? `${ASSETS_BASE_URL.replace('/api', '')}/${item.coverImageUrl.replace(new RegExp('^/+'), '')}` : "images/resource/news-1.jpg"}                                                          alt={item.title} 
                                                         style={{ width: '100%', height: '240px', objectFit: 'cover' }} 
                                                         onError={(e)=>{ e.target.src='images/resource/news-1.jpg' }}/>
                                                </a>
                                            </div>
                                            <div className="lower-content">
                                                <ul className="post-meta">
                                                    <li><span className="fa fa-calendar"></span> {item.date ? new Date(item.date).toLocaleDateString('en-GB') : 'Gallery'}</li>
                                                </ul>
                                                <h3>
                                                    <a href={item.url || '#'} onClick={e => !item.url && e.preventDefault()}>{item.title}</a>
                                                </h3>
                                                {item.description && (
                                                    <div className="text" style={{marginTop: '10px'}}>{item.description.length > 100 ? item.description.substring(0, 100) + '...' : item.description}</div>
                                                )}
                                                {item.url && (
                                                    <a className="arrow" href={item.url}>
                                                        <span className="icon flaticon-next"></span>
                                                    </a>
                                                )}
                                            </div>
                                        </div>
                                    </div>
                                );
                            })}
                        </div>
                    )}
                </div>
            </section>
        </>
    );
};

export default Galleries;
