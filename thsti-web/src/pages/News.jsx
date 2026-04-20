import React, { useEffect, useState } from 'react';
import { NewsService } from '../services/newsService';
import { useLanguage } from '../components/LanguageContext';

export default function News() {
    const { language } = useLanguage();
    const [news, setNews] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const fetchNews = async () => {
            try {
                const data = await NewsService.getPublicNews();
                setNews(data);
                setLoading(false);
            } catch (err) {
                console.error("Error fetching news:", err);
                setError("Failed to load news & events.");
                setLoading(false);
            }
        };

        fetchNews();
    }, []);

    const featuredNews = news.filter(n => n.isFeatured);
    const regularNews = news.filter(n => !n.isFeatured);

    return (
        <section className="blog-section pt-100 pb-100">
            <div className="container">
                <div className="section-title text-center mb-50">
                    <h2>{language === 'hi' ? 'समाचार और घटनाक्रम' : 'News & Events'}</h2>
                    <p>{language === 'hi' ? 'टीएचएसटीआई से नवीनतम घोषणाएँ और समाचार।' : 'Latest announcements, breakthroughs, and events from THSTI.'}</p>
                </div>

                {loading ? (
                    <div className="text-center py-10">Loading news...</div>
                ) : error ? (
                    <div className="text-center py-10 text-red-500">{error}</div>
                ) : (
                    <>
                        {featuredNews.length > 0 && (
                            <div className="row mb-5">
                                <div className="col-12">
                                    <h3 className="mb-4" style={{ fontSize: '1.5rem', color: '#B31B1B', borderBottom: '2px solid #eee', paddingBottom: '10px' }}>
                                        {language === 'hi' ? 'विशेष समाचार' : 'Featured News'}
                                    </h3>
                                </div>
                                {featuredNews.map(item => (
                                    <div key={item.id} className="col-lg-6 col-md-12 mb-4">
                                        <div className="blog-item h-100" style={{ boxShadow: '0 5px 15px rgba(0,0,0,0.1)', borderRadius: '8px', overflow: 'hidden', backgroundColor: '#fff', transition: 'transform 0.3s' }}>
                                            {item.imageUrl && (
                                                <div className="blog-image">
                                                    <img src={item.imageUrl} alt={item.title} style={{ width: '100%', height: '250px', objectFit: 'cover' }} />
                                                </div>
                                            )}
                                            <div className="blog-content p-4">
                                                <span className="date text-muted d-block mb-2" style={{ fontSize: '0.9rem' }}>
                                                    <i className="fa fa-calendar-alt text-primary mr-1"></i> {new Date(item.publishDate).toLocaleDateString()}
                                                </span>
                                                <h4 className="title mb-3" style={{ fontSize: '1.25rem', fontWeight: 'bold', color: '#2c3e50' }}>
                                                    {language === 'hi' && item.titleHi ? item.titleHi : item.title}
                                                </h4>
                                                <div className="text-muted mb-3" style={{ fontSize: '0.95rem', display: '-webkit-box', WebkitLineClamp: 3, WebkitBoxOrient: 'vertical', overflow: 'hidden' }}>
                                                    <div dangerouslySetInnerHTML={{ __html: language === 'hi' && item.bodyHi ? item.bodyHi : item.body }} />
                                                </div>
                                                {item.documentUrl && (
                                                    <a href={item.documentUrl} target="_blank" rel="noopener noreferrer" className="read-more font-weight-bold" style={{ color: '#0056b3' }}>
                                                        {language === 'hi' ? 'दस्तावेज़ पढ़ें' : 'Read Document'} <i className="fa fa-arrow-right ml-1"></i>
                                                    </a>
                                                )}
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        )}

                        <div className="row">
                            <div className="col-12">
                                <h3 className="mb-4" style={{ fontSize: '1.5rem', color: '#2c3e50', borderBottom: '2px solid #eee', paddingBottom: '10px' }}>
                                    {language === 'hi' ? 'संस्थान अद्यतन' : 'Institute Updates'}
                                </h3>
                            </div>
                            {regularNews.map(item => (
                                <div key={item.id} className="col-lg-4 col-md-6 mb-4">
                                    <div className="blog-item h-100" style={{ border: '1px solid #eee', borderRadius: '8px', overflow: 'hidden', backgroundColor: '#fff' }}>
                                        {item.imageUrl && (
                                            <div className="blog-image">
                                                <img src={item.imageUrl} alt={item.title} style={{ width: '100%', height: '200px', objectFit: 'cover' }} />
                                            </div>
                                        )}
                                        <div className="blog-content p-3">
                                            <span className="date text-muted d-block mb-2" style={{ fontSize: '0.85rem' }}>
                                                <i className="fa fa-clock text-primary mr-1"></i> {new Date(item.publishDate).toLocaleDateString()}
                                            </span>
                                            <h5 className="title mb-2" style={{ fontSize: '1.1rem', fontWeight: 'bold' }}>
                                                {language === 'hi' && item.titleHi ? item.titleHi : item.title}
                                            </h5>
                                            <div className="text-muted mb-3" style={{ fontSize: '0.9rem', display: '-webkit-box', WebkitLineClamp: 2, WebkitBoxOrient: 'vertical', overflow: 'hidden' }}>
                                                <div dangerouslySetInnerHTML={{ __html: language === 'hi' && item.bodyHi ? item.bodyHi : item.body }} />
                                            </div>
                                            {item.documentUrl && (
                                                <a href={item.documentUrl} target="_blank" rel="noopener noreferrer" className="btn btn-sm btn-outline-primary" style={{ fontSize: '0.8rem' }}>
                                                    <i className="fa fa-download"></i> Attachment
                                                </a>
                                            )}
                                        </div>
                                    </div>
                                </div>
                            ))}
                            {news.length === 0 && (
                                <div className="col-12 text-center py-5 text-muted">
                                    {language === 'hi' ? 'कोई समाचार उपलब्ध नहीं है।' : 'No news updates available at this time.'}
                                </div>
                            )}
                        </div>
                    </>
                )}
            </div>
        </section>
    );
}
