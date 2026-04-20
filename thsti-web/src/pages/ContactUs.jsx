import React, { useState, useEffect } from 'react';
import api from '../api/axios';
import { useSeo } from '../hooks/useSeo';

const ContactUs = () => {
    const [settings, setSettings] = useState(null);
    const [formData, setFormData] = useState({
        name: '',
        email: '',
        phone: '',
        message: ''
    });
    const [status, setStatus] = useState({ loading: false, success: false, error: null });

    useSeo({
        title: 'Contact Us | THSTI',
        metaDescription: 'Get in touch with the Translational Health Science and Technology Institute (THSTI).'
    });

    useEffect(() => {
        // Fetch settings for contact info
        api.get('/settings')
            .then(res => setSettings(res.data))
            .catch(err => console.error("CMS Settings Fetch Error:", err));
        window.scrollTo(0, 0);
    }, []);

    const handleChange = (e) => {
        setFormData({ ...formData, [e.target.name]: e.target.value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setStatus({ loading: true, success: false, error: null });
        
        try {
            await api.post('/contact-submissions/public', formData);
            setStatus({ loading: false, success: true, error: null });
            setFormData({ name: '', email: '', phone: '', message: '' });
            setTimeout(() => setStatus(prev => ({ ...prev, success: false })), 5000);
        } catch (error) {
            console.error("Submission Error", error);
            setStatus({ loading: false, success: false, error: "Failed to send message. Please try again later." });
        }
    };

    return (
        <>
            {/* Page Title */}
            <section className="page-title" style={{backgroundImage: "url(images/background/bg-13.jpg)"}}>
                <div className="auto-container">
                    <div className="content-box">
                        <div className="content-wrapper">
                            <div className="title">
                                <h1>Contact Us</h1>
                            </div>
                            <ul className="bread-crumb style-two">
                                <li><a href="/">Home</a></li>
                                <li className="active">Contact Us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            {/* Contact Form Section */}
            <section className="contact-details-section">
                <div className="auto-container">
                    <div className="sec-title text-center">
                        <h2>We'd Love to Hear From You</h2>
                        <div className="text" style={{marginTop: '15px'}}>Have a question or want to collaborate? Send us a message below.</div>
                    </div>
                    
                    <div className="row clearfix">
                        {/* Info Column */}
                        <div className="info-column col-lg-4 col-md-12 col-sm-12">
                            <div className="inner-column" style={{padding: '40px', background: '#f4f5f8', borderRadius: '8px', height: '100%'}}>
                                <h3>Contact Information</h3>
                                <ul className="contact-info-list" style={{listStyle: 'none', padding: 0, marginTop: '30px'}}>
                                    <li style={{display: 'flex', marginBottom: '25px', alignItems: 'flex-start'}}>
                                        <div className="icon" style={{fontSize: '24px', color: '#1a5fa8', marginRight: '15px'}}><span className="flaticon-placeholder"></span></div>
                                        <div>
                                            <strong style={{display: 'block', fontSize: '18px', marginBottom: '5px', color: '#000'}}>Our Location</strong>
                                            <p style={{margin: 0, color: '#666', lineHeight: '1.6'}}>{settings?.address || 'NCR Biotech Science Cluster, 3rd Milestone, Faridabad – Gurugram Expressway, PO box #04, Faridabad – 121001'}</p>
                                        </div>
                                    </li>
                                    <li style={{display: 'flex', marginBottom: '25px', alignItems: 'flex-start'}}>
                                        <div className="icon" style={{fontSize: '24px', color: '#1a5fa8', marginRight: '15px'}}><span className="flaticon-call-1"></span></div>
                                        <div>
                                            <strong style={{display: 'block', fontSize: '18px', marginBottom: '5px', color: '#000'}}>Phone Number</strong>
                                            <p style={{margin: 0, color: '#666'}}><a href={`tel:${settings?.contactPhone || '0129-2876300'}`} style={{color: 'inherit'}}>{settings?.contactPhone || '0129-2876300/350'}</a></p>
                                        </div>
                                    </li>
                                    <li style={{display: 'flex', alignItems: 'flex-start'}}>
                                        <div className="icon" style={{fontSize: '24px', color: '#1a5fa8', marginRight: '15px'}}><span className="flaticon-email-1"></span></div>
                                        <div>
                                            <strong style={{display: 'block', fontSize: '18px', marginBottom: '5px', color: '#000'}}>Email Address</strong>
                                            <p style={{margin: 0, color: '#666'}}><a href={`mailto:${settings?.contactEmail || 'info@thsti.res.in'}`} style={{color: 'inherit'}}>{settings?.contactEmail || 'info@thsti.res.in'}</a></p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        {/* Form Column */}
                        <div className="form-column col-lg-8 col-md-12 col-sm-12">
                            <div className="inner-column" style={{padding: '40px', background: '#fff', borderRadius: '8px', boxShadow: '0 10px 30px rgba(0,0,0,0.05)'}}>
                                <div className="contact-form">
                                    {status.success && (
                                        <div style={{padding: '15px', background: '#d4edda', color: '#155724', borderRadius: '5px', marginBottom: '20px'}}>
                                            <i className="fa-solid fa-check-circle" style={{marginRight: '10px'}}></i>
                                            Thank you! Your message has been received successfully.
                                        </div>
                                    )}
                                    {status.error && (
                                        <div style={{padding: '15px', background: '#f8d7da', color: '#721c24', borderRadius: '5px', marginBottom: '20px'}}>
                                            <i className="fa-solid fa-triangle-exclamation" style={{marginRight: '10px'}}></i>
                                            {status.error}
                                        </div>
                                    )}

                                    <form onSubmit={handleSubmit}>
                                        <div className="row clearfix">
                                            <div className="col-md-6 form-group" style={{marginBottom: '20px'}}>
                                                <input type="text" name="name" placeholder="Your Name" required value={formData.name} onChange={handleChange} 
                                                    style={{width: '100%', padding: '15px 20px', border: '1px solid #e1e1e1', borderRadius: '5px', background: '#fbfbfb'}} />
                                            </div>
                                            
                                            <div className="col-md-6 form-group" style={{marginBottom: '20px'}}>
                                                <input type="email" name="email" placeholder="Email Address" required value={formData.email} onChange={handleChange}
                                                    style={{width: '100%', padding: '15px 20px', border: '1px solid #e1e1e1', borderRadius: '5px', background: '#fbfbfb'}} />
                                            </div>

                                            <div className="col-md-12 form-group" style={{marginBottom: '20px'}}>
                                                <input type="text" name="phone" placeholder="Phone Number (Optional)" value={formData.phone} onChange={handleChange}
                                                    style={{width: '100%', padding: '15px 20px', border: '1px solid #e1e1e1', borderRadius: '5px', background: '#fbfbfb'}} />
                                            </div>
                                            
                                            <div className="col-md-12 form-group" style={{marginBottom: '30px'}}>
                                                <textarea name="message" placeholder="Write your message here..." required value={formData.message} onChange={handleChange}
                                                    style={{width: '100%', padding: '15px 20px', height: '180px', border: '1px solid #e1e1e1', borderRadius: '5px', background: '#fbfbfb'}}></textarea>
                                            </div>
                                            
                                            <div className="col-md-12 form-group">
                                                <button className="theme-btn btn-style-new" type="submit" disabled={status.loading}>
                                                    <span className="btn-title">{status.loading ? 'SENDING...' : 'SEND MESSAGE'}</span>
                                                    <span></span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </>
    );
};

export default ContactUs;
