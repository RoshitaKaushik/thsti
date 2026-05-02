import React, { useState, useEffect, useMemo } from 'react';
import { Link } from 'react-router-dom';
import api from '../../api/axios';
import { ASSETS_BASE_URL } from '../../config/env';

const FacultyGrid = ({ config = { showSearch: true, showCategory: true, showPagination: true } }) => {
    const [faculty, setFaculty] = useState([]);
    const [loading, setLoading] = useState(true);

    // Filter & Pagination States
    const [searchQuery, setSearchQuery] = useState('');
    const [sortOption, setSortOption] = useState('Sort by');
    const [categoryFilter, setCategoryFilter] = useState('Category');
    const [perPage, setPerPage] = useState(10);
    const [currentPage, setCurrentPage] = useState(1);

    useEffect(() => {
        const fetchFaculty = async () => {
            try {
                const res = await api.get('/faculty');
                const active = res.data.filter(f => f.isActive);
                setFaculty(active);
            } catch (err) {
                console.error('Failed to fetch faculty:', err);
            } finally {
                setLoading(false);
            }
        };
        fetchFaculty();
    }, []);

    // Get unique categories (designations)
    const designations = useMemo(() => {
        const set = new Set(faculty.map(f => f.designation).filter(Boolean));
        return Array.from(set).sort();
    }, [faculty]);

    // Apply filtering, sorting and pagination
    const { displayedFaculty, totalPages } = useMemo(() => {
        let filtered = [...faculty];

        // 1. Search Filter
        if (searchQuery.trim()) {
            const query = searchQuery.toLowerCase();
            filtered = filtered.filter(f => 
                f.name.toLowerCase().includes(query) || 
                (f.department && f.department.toLowerCase().includes(query)) ||
                (f.designation && f.designation.toLowerCase().includes(query))
            );
        }

        // 2. Category Filter
        if (categoryFilter !== 'Category') {
            filtered = filtered.filter(f => f.designation === categoryFilter);
        }

        // 3. Sorting
        if (sortOption === 'Name') {
            filtered.sort((a, b) => a.name.localeCompare(b.name));
        } else if (sortOption === 'Oldest') {
            filtered.sort((a, b) => new Date(a.createdAt) - new Date(b.createdAt));
        } else if (sortOption === 'Latest') {
            filtered.sort((a, b) => new Date(b.createdAt) - new Date(a.createdAt));
        } else {
            // Default "Sort by" => use displayOrder
            filtered.sort((a, b) => a.displayOrder - b.displayOrder);
        }

        const totalPages = Math.ceil(filtered.length / perPage) || 1;
        
        // Reset to page 1 if current page is out of bounds
        const validPage = Math.min(currentPage, totalPages);
        if (validPage !== currentPage) {
            setCurrentPage(validPage);
        }

        // 4. Pagination
        const startIndex = (validPage - 1) * perPage;
        const displayed = filtered.slice(startIndex, startIndex + perPage);

        return { displayedFaculty: displayed, totalPages };
    }, [faculty, searchQuery, categoryFilter, sortOption, perPage, currentPage]);

    if (loading) {
        return (
            <div className="text-center py-5">
                <div className="spinner-border text-primary" role="status">
                    <span className="visually-hidden">Loading...</span>
                </div>
            </div>
        );
    }

    return (
        <section className="team-section pt-5">
            <div className="auto-container">
                 
                {/* Sec Title */}
                <div className="sec-title centered">
                    <h2>Faculty & Scientists</h2>
                </div>
                
                <div className="row">
                    <div className="col-lg-12 col-md-12 col-sm-12">
                        <div className="filter-bar">
                            {/* Search */}
                            {config.showSearch && (
                                <div className="search-box">
                                    <span className="icon">
                                        <i className="fa fa-search" aria-hidden="true"></i>
                                    </span>
                                    <input 
                                        type="text" 
                                        placeholder="Search..." 
                                        value={searchQuery}
                                        onChange={(e) => { setSearchQuery(e.target.value); setCurrentPage(1); }}
                                    />
                                </div>
                            )}

                            {/* Sort */}
                            <div className="select-box">
                                <span className="icon">
                                    <i className="fa fa-sort-amount-desc" aria-hidden="true"></i>
                                </span>
                                <select 
                                    value={sortOption} 
                                    onChange={(e) => { setSortOption(e.target.value); setCurrentPage(1); }}
                                >
                                    <option>Sort by</option>
                                    <option>Name</option>
                                    <option>Latest</option>
                                    <option>Oldest</option>
                                </select>
                            </div>

                            {/* Category */}
                            {config.showCategory && (
                                <div className="select-box">
                                    <span className="icon">
                                        <i className="fa fa-tag" aria-hidden="true"></i>
                                    </span>
                                    <select 
                                        value={categoryFilter} 
                                        onChange={(e) => { setCategoryFilter(e.target.value); setCurrentPage(1); }}
                                    >
                                        <option>Category</option>
                                        {designations.map(desig => (
                                            <option key={desig} value={desig}>{desig}</option>
                                        ))}
                                    </select>
                                </div>
                            )}

                            {/* Per Page */}
                            <div className="select-box small">
                                <span className="icon">
                                    <i className="fa fa-bars" aria-hidden="true"></i>
                                </span>
                                <select 
                                    value={perPage} 
                                    onChange={(e) => { setPerPage(Number(e.target.value)); setCurrentPage(1); }}
                                >
                                    <option value={10}>10 per page</option>
                                    <option value={20}>20 per page</option>
                                    <option value={50}>50 per page</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div className="row">
                    {displayedFaculty.length === 0 ? (
                        <div className="col-12 text-center py-5 text-muted">
                            <p>No faculty members found matching your criteria.</p>
                        </div>
                    ) : (
                        displayedFaculty.map((member) => (
                            <div key={member.id} className="team-block-two col-lg-3 col-md-6 col-sm-12 mb-4">
                                <div className="inner-box">
                                    <div className="image-box">
                                        <figure className="image">
                                            <Link to={`/faculty/${member.slug}`}>
                                                {member.imageUrl ? (
                                                    <img 
                                                        src={member.imageUrl.startsWith('http') ? member.imageUrl : `${ASSETS_BASE_URL}${member.imageUrl}`} 
                                                        alt={member.name} 
                                                        onError={(e) => { e.target.onerror = null; e.target.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(member.name)}&background=0b2d55&color=fff&size=300`; }}
                                                    />
                                                ) : (
                                                    <img src={`https://ui-avatars.com/api/?name=${encodeURIComponent(member.name)}&background=0b2d55&color=fff&size=300`} alt={member.name} />
                                                )}
                                            </Link>
                                        </figure>
                                        <div className="overlay-box">
                                            <ul className="contact-list">
                                                {member.phone && <li><i className="icon icon-call-in"></i> <a href={`tel:${member.phone.replace(/\D/g,'')}`}>{member.phone}</a></li>}
                                                {member.email && <li><i className="icon icon-envelope-open"></i> <a href={`mailto:${member.email}`}>{member.email}</a></li>}
                                            </ul>
                                        </div>
                                    </div>
                                    <div className="lower-content">
                                        <h3 className="name"><Link to={`/faculty/${member.slug}`}>{member.name}</Link></h3>
                                        <span className="designation">{member.designation}</span>
                                        {member.department && <p className="mb-2 department-text text-muted small"><i className="fa fa-building-o mr-1"></i> {member.department}</p>}
                                        
                                        <ul className="social-links">
                                            {member.linkedinUrl && <li><a href={member.linkedinUrl} target="_blank" rel="noreferrer"><i className="fab fa-linkedin-in"></i></a></li>}
                                            {member.googleScholarUrl && <li><a href={member.googleScholarUrl} target="_blank" rel="noreferrer"><i className="fab fa-google"></i></a></li>}
                                            {member.researchGateUrl && <li><a href={member.researchGateUrl} target="_blank" rel="noreferrer"><i className="fab fa-researchgate"></i></a></li>}
                                        </ul>
                                        <Link className="arrow" to={`/faculty/${member.slug}`}><span className="icon flaticon-next"></span></Link>
                                    </div>
                                </div>
                            </div>
                        ))
                    )}
                </div>

                {/* Pagination Controls */}
                {config.showPagination && totalPages > 1 && (
                    <div className="styled-pagination text-center pb-5">
                        <ul className="clearfix list-unstyled d-flex justify-content-center gap-2">
                            {currentPage > 1 && (
                                <li>
                                    <button onClick={() => setCurrentPage(prev => prev - 1)} className="btn btn-outline-primary rounded-circle">
                                        <span className="fa fa-angle-left"></span>
                                    </button>
                                </li>
                            )}
                            
                            {Array.from({ length: totalPages }).map((_, idx) => {
                                const pageNum = idx + 1;
                                return (
                                    <li key={pageNum}>
                                        <button 
                                            onClick={() => setCurrentPage(pageNum)}
                                            className={`btn ${currentPage === pageNum ? 'btn-primary' : 'btn-outline-primary'} rounded-circle`}
                                            style={{ width: '40px', height: '40px' }}
                                        >
                                            {pageNum}
                                        </button>
                                    </li>
                                );
                            })}
                            
                            {currentPage < totalPages && (
                                <li>
                                    <button onClick={() => setCurrentPage(prev => prev + 1)} className="btn btn-outline-primary rounded-circle">
                                        <span className="fa fa-angle-right"></span>
                                    </button>
                                </li>
                            )}
                        </ul>
                    </div>
                )}
            </div>
            
            <style>{`
            /* Filter Bar */
            .filter-bar{
                display: flex;
                gap: 18px;
                align-items: center;
                flex-wrap: wrap;
                margin-bottom: 20px;
                justify-content: space-around;
                background: #f5f5f5;
                padding: 10px;
                border-radius: 10px;
            }

            /* Common Box Style */
            .filter-bar .search-box,
            .filter-bar .select-box{
                display: flex;
                align-items: center;
                background: #fff;
                border: 1px solid #dddddd;
                border-radius: 6px;
                height: 50px;
                padding: 0 14px;
                transition: 0.3s;
                width: 24%;
                justify-content: space-between;
            }

            /* Hover Effect */
            .filter-bar .search-box:hover,
            .filter-bar .select-box:hover{
                border-color:#2f5ed3;
            }

            /* Search Box */
            .filter-bar .search-box{
                width:360px;
            }

            .filter-bar .search-box input{
                width:100%;
                border:none;
                outline:none;
                font-size:15px;
                padding-left:10px;
            }

            /* Dropdown Box */
            .filter-bar .select-box select{
                border:none;
                outline:none;
                font-size:15px;
                background:transparent;
                cursor:pointer;
                padding-left:10px;
                width: 100%;
                -webkit-appearance: auto;
                -moz-appearance: auto;
                appearance: auto;
            }

            /* Small Box */
            .filter-bar .select-box.small{
                width:165px;
            }

            /* Icon */
            .filter-bar .icon{
                color:#4c73d9;
                font-size:18px;
            }
            `}</style>
        </section>
    );
};

export default FacultyGrid;
