import React from 'react';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Autoplay } from 'swiper/modules';
import 'swiper/css';

const Partners = () => {
    const logos = [
        "https://thsti.res.in/public/upload/home/1583229538img.png",
        "https://thsti.res.in/public/upload/home/1583229560img.png",
        "https://thsti.res.in/public/upload/home/1703592349img.jpg",
        "https://thsti.res.in/public/upload/home/1710930997img.jpg",
        "https://thsti.res.in/public/upload/home/1583229573img.png",
        "https://thsti.res.in/public/upload/home/1710931230img.jpg",
        "https://thsti.res.in/public/upload/home/1583229582img.png",
        "https://thsti.res.in/public/upload/home/1666269460img.png",
        "https://thsti.res.in/public/upload/home/1666269488img.jpg",
        "https://thsti.res.in/public/upload/home/1583229618img.png"
    ];

    return (
        <section className="sponsors-section py-4" style={{ background: '#f3f5f9' }}>
            <div className="auto-container">
                <Swiper
                    modules={[Autoplay]}
                    spaceBetween={30}
                    slidesPerView={2}
                    autoplay={{
                        delay: 3000,
                        disableOnInteraction: false,
                    }}
                    breakpoints={{
                        640: { slidesPerView: 3 },
                        768: { slidesPerView: 4 },
                        1024: { slidesPerView: 5 },
                        1200: { slidesPerView: 5 },
                    }}
                >
                    {logos.map((logo, index) => (
                        <SwiperSlide key={index}>
                            <div className="logo bg-white d-flex justify-content-center align-items-center shadow-sm" style={{ height: '110px', padding: '15px', borderRadius: '4px' }}>
                                <a href="#" style={{ display: 'block', width: '100%', height: '100%' }}>
                                    <img src={logo} alt={`Partner ${index + 1}`} style={{ width: '100%', height: '100%', objectFit: 'contain' }} />
                                </a>
                            </div>
                        </SwiperSlide>
                    ))}
                </Swiper>
            </div>
        </section>
    );
};

export default Partners;
