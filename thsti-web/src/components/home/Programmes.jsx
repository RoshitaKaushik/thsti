import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { API_BASE_URL } from '../../config/env';
import api from '../../api/axios';

const Programmes = () => {
	const [programmes, setProgrammes] = useState([]);
	const [loading, setLoading] = useState(true);
	const navigate = useNavigate();

	useEffect(() => {
		const fetchProgrammes = async () => {
			try {
				const response = await api.get('/programmes');
				if (response.data) {
					const data = response.data;
					if (data.items && data.items.length > 0) {
						setProgrammes(data.items);
						return;
					} else if (Array.isArray(data)) {
                        setProgrammes(data);
                        return;
                    }
				}
			} catch (error) {
				console.error("Failed to fetch programmes:", error);
			} finally {
				setLoading(false);
			}
		};

		fetchProgrammes();
	}, []);

	const handleLinkClick = (e, item) => {
		e.preventDefault();
		const url = item.routeUrl || '#';
		if (url === '#') return;

		if (item.isExternal || item.openInNewTab) {
			window.open(url, '_blank', 'noopener,noreferrer');
		} else {
			navigate(url);
		}
	};

	const getImageUrl = (url) => {
		if (!url) return '';
		if (url.startsWith('http') || url.startsWith('data:')) return url;
		if (url.startsWith('images/')) return `/${url}`;
		const base = import.meta.env.VITE_ASSETS_BASE_URL || 'http://localhost:5000';
		const clean = url.startsWith('/') ? url.slice(1) : url;
		return `${base}/${clean}`;
	};

	if (programmes.length === 0) {
		return (
			<section className="what-we-offer Explore-our-Programmes-outer-box pt-5" style={{ background: '#f3f5f9' }}>
				<div className="auto-container">
					<div className="row clearfix">
						<div className="title-column col-lg-12 col-md-12 col-sm-12 mb-2">
							<div className="sec-title">
								<h2>Explore our Programmes</h2>
							</div>
						</div>
						<div className="title-column col-lg-12 col-md-12 col-sm-12">
							<div className="programmes">
								<div className="prog-box">
									<img src="images/student-1.jpg" alt="" />
									<div className="overlay"></div>
									<div className="vertical-text">Ph. D. Program</div>
									<div className="content">
										<span className="number">01</span>
										<h2>Ph. D. Program</h2>
										<p>Lorem ipsum dolor sit amet, consec teturadipsi cing elit. Nobis commodi esse aliquam eligend reprehenderit, numquam a odio.</p>
										<a href="#">VIEW PROGRAMS →</a>
									</div>
								</div>
								<div className="prog-box">
									<img src="images/student-2.png" alt="" />
									<div className="overlay"></div>
									<div className="vertical-text">M.Sc. Clinical Research</div>
									<div className="content">
										<span className="number">02</span>
										<h2>M.Sc. Clinical Research</h2>
										<p>Lorem ipsum dolor sit amet, consec teturadipsi cing elit. Nobis commodi esse aliquam eligend reprehenderit, numquam a odio.</p>
										<a href="#">VIEW PROGRAMS →</a>
									</div>
								</div>
								<div className="prog-box">
									<img src="images/student-3.png" alt="" />
									<div className="overlay"></div>
									<div className="vertical-text">MS-PhD in Biotechnology</div>
									<div className="content">
										<span className="number">03</span>
										<h2>MS-PhD in Biotechnology</h2>
										<p>Lorem ipsum dolor sit amet, consec teturadipsi cing elit. Nobis commodi esse aliquam eligend reprehenderit, numquam a odio.</p>
										<a href="#">VIEW PROGRAMS →</a>
									</div>
								</div>
								<div className="prog-box">
									<img src="images/student-4.png" alt="" />
									<div className="overlay"></div>
									<div className="vertical-text">RCB PhD in Biotechnology</div>
									<div className="content">
										<span className="number">04</span>
										<h2>RCB PhD in Biotechnology</h2>
										<p>Lorem ipsum dolor sit amet, consec teturadipsi cing elit. Nobis commodi esse aliquam eligend reprehenderit, numquam a odio.</p>
										<a href="#">VIEW PROGRAMS →</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		);
	}	return (
		<section className="what-we-offer Explore-our-Programmes-outer-box pt-5" style={{}}>
			<div className="auto-container">
				<div className="row clearfix">
					<div className="title-column col-lg-12 col-md-12 col-sm-12 mb-2">
						<div className="sec-title">
							<h2>Explore our Programmes</h2>
						</div>
					</div>

					<div className="title-column col-lg-12 col-md-12 col-sm-12">
						<div className="programmes">
							{programmes.map((item, index) => (
								<div className="prog-box" key={item.id || index}>
									{item.imageUrl ? (
										<img
											src={getImageUrl(item.imageUrl)}
											alt={item.title}
											onError={(e) => {
												e.target.onerror = null;
												e.target.style.display = 'none';
												e.target.parentElement.style.backgroundColor = '#1e293b';
											}}
										/>
									) : (
										<div style={{ width: '100%', height: '100%', backgroundColor: '#1e293b', position: 'absolute', top: 0, left: 0 }}></div>
									)}
									<div className="overlay"></div>

									<div className="vertical-text">{item.title}</div>

									<div className="content">
										<span className="number">{String(index + 1).padStart(2, '0')}</span>
										<h2>{item.title}</h2>
										<p>{item.shortDescription}</p>
										<a href={item.routeUrl || "#"} onClick={(e) => handleLinkClick(e, item)}>VIEW PROGRAMS →</a>
									</div>
								</div>
							))}
						</div>
					</div>
				</div>
			</div>
		</section>
	);
};

export default Programmes;
