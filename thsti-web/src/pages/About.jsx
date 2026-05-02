import React, { useEffect } from 'react';
import { Link } from 'react-router-dom';
import Infographics from '../components/Infographics';

const About = () => {
    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);

    return (
        <>
            {/* Page Title */}
    <section className="page-banner style-two" style={{"backgroundImage":`url(/images/background/about-page-title-bg.jpg)`}}>
        <div className="auto-container">
            <div className="inner-container clearfix">
                <h1>About Solustrid</h1>
                <ul className="bread-crumb clearfix">
                    <li><a href="/">Home</a></li>
                    <li>About Solustrid</li>
                </ul>
            </div>
        </div>
    </section>
    {/* End Page Title */}

    {/*  Fun Facts Section  */}
    <section className="about-section-two" style={{"backgroundImage":`url(/images/background/about-section-two-bg.png)`}}>
        <div className="auto-container">
            <div className="title-style-one style-two centered">
                <div className="icon"><img src={`/images/icons/logo-icon.png`} alt="" /></div>
                <div className="subtitle">We are Solustrid</div>
                <h2>We are committed to provide safe <br />industrial solutions to many factories</h2>
                <div className="text">At Solustrid, Our goal is to generate oriented sales by our staff  members which enables us to meet the clients expectations in timely manner ipsum dolor sit amet consectetur adipisicing elit sed ipsum eiusmod tempor incididunt labore</div>
            </div>

            <div className="row">
                <div className="image-column col-lg-6 col-md-12 col-sm-12">
                    <div className="inner-column" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <figure className="image"><a href="images/resource/about-img-1.jpg" className="lightbox-image"><img src={`/images/resource/about-img-1.jpg`} alt="" /></a></figure> 
                    </div>
                </div>

                <div className="content-column col-lg-6 col-md-12 col-sm-12">
                    <div className="inner-column" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div className="text">
                            <p><strong>Consectetur adipisicing elit sed do eiusmod tempor dolor magna aliquat enim veniam quis nostrud exercitation ullamco consequat.</strong></p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis node trud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit.</p>
                        </div>
                        <div className="fact-counter" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div className="clearfix">
                                {/* Column */}
                                <div className="column counter-column col-lg-4 col-md-4 col-sm-12">
                                    <div className="inner">
                                        <div className="count-outer count-box">
                                            <span className="count-text" data-speed="2000" data-stop="25">25</span>+
                                            <h4 className="counter-title">Years Experience</h4>
                                        </div>
                                    </div>
                                </div>
                                
                                {/* Column */}
                                <div className="column counter-column col-lg-4 col-md-4 col-sm-12">
                                    <div className="inner">
                                        <div className="count-outer count-box">
                                            <span className="count-text" data-speed="2500" data-stop="36">36</span>
                                            <h4 className="counter-title">Industries Served</h4>
                                        </div>
                                    </div>
                                </div>
                                
                                {/* Column */}
                                <div className="column counter-column col-lg-4 col-md-4 col-sm-12">
                                    <div className="inner">
                                        <div className="count-outer count-box">
                                            <span className="count-text" data-speed="3000" data-stop="105">105</span>
                                            <h4 className="counter-title">Factories Built</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {/*  Fun Facts Section  */}

    {/* Infographics Module */}
    <Infographics />

    {/*  Missin Section  */}
    <section className="mission-section" style={{"backgroundImage":`url(/images/background/mission-bg.jpg)`}}>
        <div className="auto-container">
            <div className="row no-gutters">
                <div className="colum col-lg-6 col-md-12 col-sm-12">
                    <div className="inner-column" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div className="content-box" style={{"backgroundImage":`url(/images/icons/logo-icon-2.png)`}}>
                            <h4>Our Mission</h4>
                            <div className="text">Incididunt ut labore et dolore magna aliqua veniamtion ullamco laboris nisi ut aliquip ex eac consequat duis derit velit culpa quis labore dolore magna.</div>
                        </div>
                        <div className="image-box" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <figure className="image"><a href="images/resource/mission.jpg" className="lightbox-image"><img src={`/images/resource/mission.jpg`} alt="" /></a></figure>
                        </div>
                    </div>
                </div>

                <div className="colum right-column col-lg-6 col-md-12 col-sm-12">
                    <div className="inner-column">
                        <div className="image-box" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <figure className="image"><a href="images/resource/vision.jpg" className="lightbox-image"><img src={`/images/resource/vision.jpg`} alt="" /></a></figure>
                        </div>
                        <div className="content-box" data-wow-delay="0ms" data-wow-duration="1500ms" style={{"backgroundImage":`url(/images/icons/logo-icon-2.png)`}}>
                            <h4>Industry Vision</h4>
                            <div className="text">Incididunt ut labore et dolore magna aliqua veniamtion ullamco laboris nisi ut aliquip ex eac consequat duis derit velit culpa quis labore dolore magna.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {/* End Missin Section  */}

    {/*  Quote Section  */}
    <section className="quote-section" data-wow-delay="0ms" data-wow-duration="1500ms">
        <div className="auto-container">
            <div className="inner-section">
                <div className="clearfix">
                    <div className="pull-left">
                        <div className="content">
                            <div className="icon flaticon-hammer"></div>
                            <h3>Get A Free Quote For Industrial Project</h3>
                            <div className="text">We always bring good quality services with 100% safety measures</div>
                        </div>
                    </div>
                    <div className="pull-right">
                        <a href="contact.html" className="theme-btn btn-style-three">Get A Quote</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {/*  End Quote Section  */}

    {/*  FAQ Section  */}
    <section className="faq-section">
        <div className="auto-container">
            <div className="row">
                {/*  Accordion Column  */}
                <div className="accordion-column col-lg-7 col-md-12 col-sm-12">
                    <div className="inner-column">
                        <div className="title-style-one">
                            <div className="icon"><img src={`/images/icons/logo-icon.png`} alt="" /></div>
                            <div className="subtitle">We are Solustrid</div>
                            <h2>We offer Industrial Solutions that are reliable, efficient, safe and sustainable.</h2>
                        </div>

                        {/* Accordian Box */}
                        <ul className="accordion-box">
                            {/* Block */}
                            <li className="accordion block">
                                <div className="acc-btn"><div className="icon-outer"><span className="icon icon-plus fa fa-angle-right"></span> </div>Leading industrial solutions with best machinery</div>
                                <div className="acc-content">
                                    <div className="content">
                                        <div className="text">Officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis istedy natus error sit voluptatem accusantium doloremque laudantium, totam rem apra eaque ipsa quae ab illo inventore veritatis et quasis.</div>
                                    </div>
                                </div>
                            </li>

                            {/* Block */}
                            <li className="accordion block active-block">
                                <div className="acc-btn active"><div className="icon-outer"><span className="icon icon-plus fa fa-angle-right"></span> </div>Accurate responses to client’s requirments</div>
                                <div className="acc-content current">
                                    <div className="content">
                                        <div className="text">Officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis istedy natus error sit voluptatem accusantium doloremque laudantium, totam rem apra eaque ipsa quae ab illo inventore veritatis et quasis.</div>
                                    </div>
                                </div>
                            </li>
                            
                            {/* Block */}
                            <li className="accordion block">
                                <div className="acc-btn"><div className="icon-outer"><span className="icon icon-plus fa fa-angle-right"></span> </div>World’s leader in engineering business</div>
                                <div className="acc-content">
                                    <div className="content">
                                        <div className="text">Officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis istedy natus error sit voluptatem accusantium doloremque laudantium, totam rem apra eaque ipsa quae ab illo inventore veritatis et quasis.</div>
                                    </div>
                                </div>
                            </li>
                            
                            {/* Block */}
                            <li className="accordion block">
                                <div className="acc-btn"><div className="icon-outer"><span className="icon icon-plus fa fa-angle-right"></span> </div>Solustrid has potential to find efficient solutions</div>
                                <div className="acc-content">
                                    <div className="content">
                                        <div className="text">Officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis istedy natus error sit voluptatem accusantium doloremque laudantium, totam rem apra eaque ipsa quae ab illo inventore veritatis et quasis.</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                {/*  image Column  */}
                <div className="image-column col-lg-5 col-md-12 col-sm-12">
                    <div className="inner-column">
                        <figure className="image" data-wow-delay="0ms" data-wow-duration="1500ms"><img src={`/images/resource/man-img-1.png`} alt="" /></figure>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {/* End FAQ Section  */}

    <Infographics />

     {/*  Featured Services  */}
    <section className="featured-services">
        <div className="row no-gutters">
            {/*  Feature Block Five  */}
            <div className="feature-block-five col-lg-4 col-md-6 col-sm-12">
                <div className="inner-box" style={{"backgroundImage":`url(/images/resource/featured-bg-1.jpg)`}}>
                    <div className="content">
                        <div className="icon-box"><span className="icon flaticon-engineer-2"></span></div>
                        <h4><a href="oil-gas.html">Experts Engineers Support</a></h4>
                        <div className="text">Aliquip ex ea commodo consequat duis aute irure dolor in reprehenderit voluptate sed velit sunt in culpa qui officia deseru mollit anim ipsum id est laborum.</div>
                        <div className="link-box"><a href="services-1.html">Read More <i className="fa fa-angle-right"></i></a></div>
                    </div>
                </div>
            </div>

            {/*  Feature Block Five  */}
            <div className="feature-block-five col-lg-4 col-md-6 col-sm-12" data-wow-delay="400ms">
                <div className="inner-box" style={{"backgroundImage":`url(/images/resource/featured-bg-2.jpg)`}}>
                    <div className="content">
                        <div className="icon-box"><span className="icon flaticon-earth-globe"></span></div>
                        <h4><a href="plants.html">Well Maintained Services</a></h4>
                        <div className="text">Aliquip ex ea commodo consequat duis aute irure dolor in reprehenderit voluptate sed velit sunt in culpa qui officia deseru mollit anim ipsum id est laborum.</div>
                        <div className="link-box"><a href="services-2.html">Read More <i className="fa fa-angle-right"></i></a></div>
                    </div>
                </div>
            </div>

            {/*  Feature Block Five  */}
            <div className="feature-block-five col-lg-4 col-md-12 col-sm-12" data-wow-delay="800ms">
                <div className="inner-box" style={{"backgroundImage":`url(/images/resource/featured-bg-3.jpg)`}}>
                    <div className="content">
                        <div className="icon-box"><span className="icon flaticon-flask"></span></div>
                        <h4><a href="chemical-research.html">Modern Research Ideology</a></h4>
                        <div className="text">Aliquip ex ea commodo consequat duis aute irure dolor in reprehenderit voluptate sed velit sunt in culpa qui officia deseru mollit anim ipsum id est laborum.</div>
                        <div className="link-box"><a href="services-1.html">Read More <i className="fa fa-angle-right"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {/* End Featured Services  */}

    {/*  Team Section  */}
    <section className="team-section">
        <div className="auto-container">
            {/*  Sec Title  */}
            <div className="sec-title centered">
                <div className="title">We are Solustrid</div>
                <h2>Board of Directors</h2>
            </div>

            <div className="row">
                {/*  Team Block  */}
                <div className="team-block col-lg-3 col-md-6 col-sm-12">
                    <div className="inner-box" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div className="image-box">
                            <figure className="image"><a href="team.html"><img src={`/images/resource/team-1.jpg`} alt="" /></a></figure>
                        </div>
                        <div className="lower-content">
                            <h3 className="name"><a href="blog-single.html">Daniel Ricardo</a></h3>
                            <span className="designation">Director & CEO</span>
                            <a className="arrow" href="blog-single.html"><span className="icon flaticon-next"></span></a>
                        </div>
                    </div>
                </div>

                {/*  Team Block  */}
                <div className="team-block col-lg-3 col-md-6 col-sm-12">
                    <div className="inner-box" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div className="image-box">
                            <figure className="image"><a href="team.html"><img src={`/images/resource/team-2.jpg`} alt="" /></a></figure>
                        </div>
                        <div className="lower-content">
                            <h3 className="name"><a href="blog-single.html">Thomas Ralph</a></h3>
                            <span className="designation">Senior Director</span>
                            <a className="arrow" href="blog-single.html"><span className="icon flaticon-next"></span></a>
                        </div>
                    </div>
                </div>

                {/*  Team Block  */}
                <div className="team-block col-lg-3 col-md-6 col-sm-12">
                    <div className="inner-box" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div className="image-box">
                            <figure className="image"><a href="team.html"><img src={`/images/resource/team-3.jpg`} alt="" /></a></figure>
                        </div>
                        <div className="lower-content">
                            <h3 className="name"><a href="blog-single.html">Alexander  Max</a></h3>
                            <span className="designation">HR Manager</span>
                            <a className="arrow" href="blog-single.html"><span className="icon flaticon-next"></span></a>
                        </div>
                    </div>
                </div>

                {/*  Team Block  */}
                <div className="team-block col-lg-3 col-md-6 col-sm-12">
                    <div className="inner-box" data-wow-delay="900ms" data-wow-duration="1500ms">
                        <div className="image-box">
                            <figure className="image"><a href="team.html"><img src={`/images/resource/team-4.jpg`} alt="" /></a></figure>
                        </div>
                        <div className="lower-content">
                            <h3 className="name"><a href="blog-single.html">Ruby Charlotte</a></h3>
                            <span className="designation">Engineering Head</span>
                            <a className="arrow" href="blog-single.html"><span className="icon flaticon-next"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {/* End Team Section  */}
    
    {/* Newsleter Section */}
    <section className="newsletter-section" data-wow-delay="0ms" data-wow-duration="1500ms">
        <div className="auto-container">
            <div className="inner-container">
                <div className="row clearfix">
                    
                    {/* Title Column */}
                    <div className="title-column col-lg-6 col-md-12 col-sm-12">
                        <div className="inner-column">
                            <h2>Stay Updated With Our Newsletter</h2>
                        </div>
                    </div>
                    
                    {/* Form Column */}
                    <div className="form-column col-lg-6 col-md-12 col-sm-12">
                        <div className="inner-column">
                            
                            {/* Subscribe Form */}
                            <div className="subscribe-form">
                                <form method="post" action="contact.html">
                                    <div className="form-group">
                                        <span className="icon far fa-envelope"></span>
                                        <input type="email" name="email" defaultValue="" placeholder="Email address ..." required />
                                        <button type="submit" className="theme-btn submit-btn">Submit</button>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    {/* End Newsleter Section */}

	
        </>
    );
};

export default About;
