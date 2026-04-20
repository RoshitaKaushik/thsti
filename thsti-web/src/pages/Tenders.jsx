import React, { useEffect, useState } from 'react';
import { TendersService } from '../services/tendersService';
import { useLanguage } from '../components/LanguageContext';

export default function Tenders() {
    const { language } = useLanguage();
    const [tenders, setTenders] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const fetchTenders = async () => {
            try {
                const data = await TendersService.getPublicTenders();
                setTenders(data);
                setLoading(false);
            } catch (err) {
                console.error("Error fetching tenders:", err);
                setError("Failed to load active tenders.");
                setLoading(false);
            }
        };

        fetchTenders();
    }, []);

    // Filter logic: In a real app we might also check if closing date is > current date 
    // unless the API already handled it
    const activeTenders = tenders.filter(t => new Date(t.closingDate) >= new Date(new Date().setHours(0,0,0,0)));
    const archivedTenders = tenders.filter(t => new Date(t.closingDate) < new Date(new Date().setHours(0,0,0,0)));

    return (
        <section className="about-section pt-100 pb-100">
            <div className="container">
                <div className="section-title text-center mb-50">
                    <h2>{language === 'hi' ? 'निविदाएं' : 'Tenders'}</h2>
                    <p>{language === 'hi' ? 'हमारे नवीनतम टेंडर नीचे सूचीबद्ध हैं।' : 'Our latest active public tenders are listed below.'}</p>
                </div>

                {loading ? (
                    <div className="text-center py-10">Loading tenders...</div>
                ) : error ? (
                    <div className="text-center py-10 text-red-500">{error}</div>
                ) : (
                    <div className="table-responsive">
                        <table className="table table-bordered table-striped" style={{ width: '100%', backgroundColor: '#fff' }}>
                            <thead style={{ backgroundColor: '#2c3e50', color: '#fff' }}>
                                <tr>
                                    <th className="p-3" style={{ width: '15%' }}>{language === 'hi' ? 'संदर्भ संख्या' : 'Reference No'}</th>
                                    <th className="p-3">{language === 'hi' ? 'शीर्षक' : 'Title'}</th>
                                    <th className="p-3" style={{ width: '15%' }}>{language === 'hi' ? 'प्रकाशन तिथि' : 'Publish Date'}</th>
                                    <th className="p-3" style={{ width: '15%' }}>{language === 'hi' ? 'अंतिम तिथि' : 'Closing Date'}</th>
                                    <th className="p-3 text-center" style={{ width: '10%' }}>{language === 'hi' ? 'दस्तावेज़' : 'Document'}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {activeTenders.length > 0 ? (
                                    activeTenders.map(t => (
                                        <tr key={t.id}>
                                            <td className="p-3 font-weight-bold">{t.referenceNo}</td>
                                            <td className="p-3">{language === 'hi' && t.titleHi ? t.titleHi : t.title}</td>
                                            <td className="p-3">{new Date(t.publishDate).toLocaleDateString()}</td>
                                            <td className="p-3 text-danger font-weight-bold">{new Date(t.closingDate).toLocaleDateString()}</td>
                                            <td className="p-3 text-center">
                                                {t.documentUrl && (
                                                    <a href={t.documentUrl} target="_blank" rel="noopener noreferrer" className="btn btn-sm btn-primary" style={{ backgroundColor: '#0056b3', borderColor: '#0056b3', color: '#fff' }} title="Download PDF">
                                                        <i className="fa fa-file-pdf"></i> View
                                                    </a>
                                                )}
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="5" className="text-center p-4 text-muted">
                                            {language === 'hi' ? 'वर्तमान में कोई सक्रिय निविदा नहीं है।' : 'No active tenders at this time.'}
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                )}
            </div>
        </section>
    );
}
