import React, { useState, useEffect } from 'react';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Autoplay, EffectFade, Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/effect-fade';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

import { API_BASE_URL, ASSETS_BASE_URL } from '../../config/env';
import api from '../../api/axios';

const STATIC_SLIDES = [
    {
        id: 'fallback-1',
        title: 'Translational Health Science \nand Technology Institute',
        subtitle: 'Heart of India\'s Biotech Revolution',
        mediaUrl: '/images/main-slider/1.jpg',
        type: 'IMAGE'
    },
    {
        id: 'fallback-2',
        title: 'Translational Health Science \nand Technology Institute',
        subtitle: 'Leading Scientists, Cutting-Edge Research',
        mediaUrl: '/images/main-slider/2.jpg',
        type: 'IMAGE'
    },
    {
        id: 'fallback-3',
        title: 'Translational Health Science \nand Technology Institute',
        subtitle: 'Teamwork, Dedication and Innovation',
        mediaUrl: '/images/main-slider/3.jpg',
        type: 'IMAGE'
    }
];

const HeroSlider = () => {
    const [slides, setSlides] = useState([
        { id: 'live-1', title: '16th Foundation Day Celebrations', subtitle: 'Translational Health Science and Technology Institute', mediaUrl: 'https://thsti.res.in/public/slider/1752813878banner.png', type: 'IMAGE', showText: false },
        { id: 'live-2', title: 'General Slider', subtitle: "Heart of India's Biotech Revolution", mediaUrl: 'https://thsti.res.in/public/slider/1766032829banner.jpg', type: 'IMAGE', showText: false },
        { id: 'live-3', title: 'IISF-2025 Curtain Raiser', subtitle: 'Science for society', mediaUrl: 'https://thsti.res.in/public/slider/1765947193banner.jpg', type: 'IMAGE', showText: false }
    ]);
    const [isOffline, setIsOffline] = useState(false);

    useEffect(() => {
        const fetchSlides = async () => {
            try {
                const response = await api.get('/hero-slides/public');
                const data = response.data;
                if (data && data.items && data.items.length > 0) {
                    setSlides(data.items);
                } else if (data && Array.isArray(data) && data.length > 0) {
                    setSlides(data);
                }
            } catch (error) {
                console.error('API Error:', error);
                setIsOffline(true);
            }
        };
        fetchSlides();
    }, []);

    if (!slides) return null;

    if (slides.length === 0) {
        return (
            <section className="main-slider-two">
                <Swiper
                    modules={[Autoplay, EffectFade, Navigation, Pagination]}
                    effect="fade"
                    navigation
                    pagination={{ clickable: true }}
                    autoplay={{ delay: 6000, disableOnInteraction: false }}
                    loop={true}
                    className="mySwiper"
                    style={{ width: '100%', height: '670px' }}
                >
                    <SwiperSlide>
                         <div className="slide-inner" style={{ position: 'relative', width: '100%', height: '100%' }}>
                            <div className="image-layer" style={{ backgroundImage: "url('/images/main-slider/1.jpg')", backgroundColor: '#000', width: '100%', height: '100%', backgroundSize: 'cover', backgroundPosition: 'top center' }}></div>
                            <div style={{ position: 'absolute', top: 0, left: 0, width: '100%', height: '100%', backgroundColor: 'rgba(0,0,0,0.5)', zIndex: 1 }}></div>
                            <div className="hero-content" style={{ position: 'absolute', top: '40%', left: '10%', transform: 'translateY(-50%)', zIndex: 10, color: '#fff', maxWidth: '80%', pointerEvents: 'auto' }}>
                                <span style={{ color: '#ffcc00', fontWeight: 'bold', fontSize: '1.2rem', marginBottom: '10px', display: 'block' }}>LOCAL .NET SERVER IS OFFLINE</span>
                                <h1 style={{ fontSize: 'clamp(2rem, 5vw, 3.5rem)', fontWeight: '800', lineHeight: '1.2', marginBottom: '1rem', fontFamily: '"Familjen Grotesk", sans-serif' }}>
                                    Translational Health Science <br />and Technology Institute
                                </h1>
                                <p style={{ fontSize: 'clamp(1rem, 2vw, 1.25rem)', marginBottom: '2rem' }}>
                                    (Currently displaying template images. Please restart your local API to fetch the live "16th Foundation Day" slides from your database!)
                                </p>
                            </div>
                        </div>
                    </SwiperSlide>
                </Swiper>
            </section>
        );
    }

    return (
        <section className="main-slider-two">
            <Swiper
                modules={[Autoplay, EffectFade, Navigation, Pagination]}
                effect="fade"
                navigation
                pagination={{ clickable: true }}
                autoplay={{ delay: 6000, disableOnInteraction: false }}
                loop={true}
                className="mySwiper"
                style={{ width: '100%', height: '670px' }}
            >
                {slides.map((slide) => {
                    const isFallback = String(slide.id).startsWith('fallback-') || String(slide.id).startsWith('live-');
                    const bgMedia = slide.mediaUrl 
                        ? (slide.mediaUrl.startsWith('http') ? slide.mediaUrl : `${ASSETS_BASE_URL}${slide.mediaUrl}`) 
                        : '';
                    const posterMedia = slide.posterUrl 
                        ? (slide.posterUrl.startsWith('http') ? slide.posterUrl : `${ASSETS_BASE_URL}${slide.posterUrl}`) 
                        : '';
                    const isVideoSlide = slide.type === 'VIDEO' && slide.isActiveVideo;

                    return (
                        <SwiperSlide key={slide.id}>
                            <div className="slide-inner" style={{ position: 'relative', width: '100%', height: '100%' }}>
                                {isVideoSlide ? (
                                    <video
                                        autoPlay loop muted playsInline preload="auto"
                                        {...(!posterMedia.toLowerCase().endsWith('.mp4') ? { poster: posterMedia } : {})}
                                        style={{ width: '100%', height: '100%', objectFit: 'cover' }}
                                    >
                                        <source src={bgMedia} type="video/mp4" />
                                    </video>
                                ) : (
                                    <div
                                        className="image-layer"
                                        style={{
                                            backgroundImage: bgMedia ? `url(${bgMedia})` : 'none',
                                            backgroundColor: '#000',
                                            width: '100%',
                                            height: '100%',
                                            backgroundSize: 'cover',
                                            backgroundPosition: 'top center',
                                        }}
                                    ></div>
                                )}
                                <div style={{ position: 'absolute', top: 0, left: 0, width: '100%', height: '100%', backgroundColor: 'rgba(0,0,0,0.3)', zIndex: 1 }}></div>

                                {slide.showText !== false && (slide.title || slide.subtitle) && (
                                    <div className="hero-content" style={{ position: 'absolute', top: '40%', left: '10%', transform: 'translateY(-50%)', zIndex: 10, color: '#fff', maxWidth: '80%', pointerEvents: 'auto' }}>
                                        {slide.title && (
                                            <h1 style={{ fontSize: 'clamp(2rem, 5vw, 3.5rem)', fontWeight: '800', textShadow: '2px 2px 4px rgba(0,0,0,0.6)', lineHeight: '1.2', marginBottom: '1rem', whiteSpace: 'pre-line', fontFamily: '"Familjen Grotesk", sans-serif' }}>
                                                {slide.title}
                                            </h1>
                                        )}
                                        {slide.subtitle && (
                                            <p style={{ fontSize: 'clamp(1rem, 2vw, 1.25rem)', textShadow: '1px 1px 3px rgba(0,0,0,0.8)', marginBottom: '2rem' }}>
                                                {slide.subtitle}
                                            </p>
                                        )}
                                        {(slide.buttonText || slide.buttonUrl) && !isFallback && (
                                            <a href={slide.buttonUrl || '#'} className="theme-btn btn-style-one" style={{ padding: '12px 30px', backgroundColor: '#e53935', color: '#fff', textDecoration: 'none', borderRadius: '4px', fontWeight: 'bold' }}>
                                                {slide.buttonText || 'Learn More'}
                                            </a>
                                        )}
                                    </div>
                                )}
                            </div>
                        </SwiperSlide>
                    );
                })}
            </Swiper>
        </section>
    );
};

export default HeroSlider;
