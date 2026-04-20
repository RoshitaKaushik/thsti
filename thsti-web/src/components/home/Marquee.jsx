import React, { useState, useEffect, useRef } from 'react';
import api from '../../api/axios';

const Marquee = () => {
    const [items, setItems] = useState([]);
    const [isPaused, setIsPaused] = useState(false);
    const marqueeRef = useRef(null);

    useEffect(() => {
        api.get('/marquee')
            .then(res => {
                if (res.data && res.data.length > 0) setItems(res.data);
            })
            .catch(err => console.error('Marquee fetch error:', err));
    }, []);

    // Fallback data mapping to the exact design9 template
    const displayItems = items.length > 0 ? items : [
        { id: 1, title: "CAR-T Cell Therapy Symposia & Workshop", url: "#" },
        { id: 2, title: "Vigilance Awareness Week- 2024 (“ सत्यनिष्ठा की संस्कृति से राष्ट्र की समृद्धि”/“Culture of Integrity for Nation's Prosperity”). Click here to take the pledge and be a part of this movement.", url: "#" },
        { id: 3, title: "Link for Online Vendor Registration Portal for WORKS related matter.", url: "#" },
        { id: 4, title: "Online Vendor Registration Portal - Reopened.", url: "#" }
    ];

    const togglePause = () => {
        if (marqueeRef.current) {
            if (isPaused) {
                marqueeRef.current.start();
            } else {
                marqueeRef.current.stop();
            }
            setIsPaused(!isPaused);
        }
    };

    return (
        <div className="banner-img-footer-box d-flex align-items-center">
            <div className="annoucement-box me-5 d-flex align-items-center justify-content-center">
               <h2 className="h3"><strong>What's New</strong></h2>
            </div>
            <div className="marquee-container w-100 position-relative overflow-hidden">
               <div className="marquee" style={{ paddingLeft: '16px' }}>
                  <marquee 
                    ref={marqueeRef}
                    behavior="scroll" 
                    direction="left" 
                    onMouseOver={(e) => { e.target.stop(); setIsPaused(true); }} 
                    onMouseOut={(e) => { e.target.start(); setIsPaused(false); }}
                  >
                     {displayItems.map((item) => (
                        <a 
                            key={item.id} 
                            className="h3 pointer" 
                            href={item.url || '#'}
                            target={item.openInNewTab ? '_blank' : '_self'}
                        >
                            {item.title}{' '}
                        </a>
                     ))}
                  </marquee>
               </div>
            </div>
            <button 
                className="play-pause-btn ms-5" 
                aria-label={isPaused ? "Play" : "Pause"}
                onClick={togglePause}
            >
                <span className="material-symbols-outlined bhashini-skip-translation">
                    <i className={`fa ${isPaused ? 'fa-play' : 'fa-pause'}`} aria-hidden="true"></i>
                </span>
            </button>
        </div>
    );
};

export default Marquee;