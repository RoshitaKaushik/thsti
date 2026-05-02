import React from 'react';
import { PieChart, Pie, Cell, BarChart, Bar, XAxis, YAxis, CartesianGrid, Tooltip, ResponsiveContainer } from 'recharts';

const Infographics = () => {
    // Dummy Data for demonstration
    const publicationsData = [
        { name: '2020', publications: 150 },
        { name: '2021', publications: 230 },
        { name: '2022', publications: 340 },
        { name: '2023', publications: 410 },
        { name: '2024', publications: 520 },
    ];

    const demographicsData = [
        { name: 'Faculty & Scientists', value: 85 },
        { name: 'Researchers (Ph.D.)', value: 120 },
        { name: 'Technical Staff', value: 45 },
        { name: 'Admin Staff', value: 60 }
    ];
    
    const COLORS = ['#1a5fa8', '#00C49F', '#FFBB28', '#FF8042'];

    return (
        <section className="infographics-section" style={{ padding: '60px 0', background: '#f8f9fa' }}>
            <div className="auto-container">
                <div className="sec-title text-center">
                    <h2>THSTI at a Glance</h2>
                    <div className="text" style={{marginTop: '15px'}}>Key performance indicators and demographic distribution</div>
                </div>
                
                <div className="row clearfix">
                    {/* Bar Chart Column */}
                    <div className="col-lg-6 col-md-12 col-sm-12" style={{ marginBottom: '30px' }}>
                        <div className="inner-box" style={{ background: '#fff', padding: '30px', borderRadius: '10px', boxShadow: '0 5px 20px rgba(0,0,0,0.05)', height: '100%' }}>
                            <h4 style={{ textAlign: 'center', marginBottom: '20px', color: '#1a5fa8', fontSize: '1.25rem', fontWeight: 'bold' }}>Research Publications (Yearly)</h4>
                            <div style={{ width: '100%', height: 300 }}>
                                <ResponsiveContainer>
                                    <BarChart data={publicationsData} margin={{ top: 20, right: 30, left: 0, bottom: 5 }}>
                                        <CartesianGrid strokeDasharray="3 3" vertical={false} stroke="#eaeaea" />
                                        <XAxis dataKey="name" axisLine={false} tickLine={false} />
                                        <YAxis axisLine={false} tickLine={false} />
                                        <Tooltip cursor={{fill: '#f4f5f8'}} />
                                        <Bar dataKey="publications" fill="#1a5fa8" radius={[5, 5, 0, 0]} barSize={40} />
                                    </BarChart>
                                </ResponsiveContainer>
                            </div>
                        </div>
                    </div>
                    
                    {/* Pie Chart Column */}
                    <div className="col-lg-6 col-md-12 col-sm-12" style={{ marginBottom: '30px' }}>
                        <div className="inner-box" style={{ background: '#fff', padding: '30px', borderRadius: '10px', boxShadow: '0 5px 20px rgba(0,0,0,0.05)', height: '100%' }}>
                            <h4 style={{ textAlign: 'center', marginBottom: '20px', color: '#1a5fa8', fontSize: '1.25rem', fontWeight: 'bold' }}>Personnel Distribution</h4>
                            <div style={{ width: '100%', height: 300 }}>
                                <ResponsiveContainer>
                                    <PieChart>
                                        <Pie 
                                            data={demographicsData} 
                                            cx="50%" 
                                            cy="50%" 
                                            labelLine={true} 
                                            label={({name, percent}) => `${name}: ${(percent * 100).toFixed(0)}%`} 
                                            outerRadius={100} 
                                            innerRadius={60}
                                            fill="#8884d8" 
                                            dataKey="value"
                                        >
                                            {demographicsData.map((entry, index) => (
                                                <Cell key={`cell-${index}`} fill={COLORS[index % COLORS.length]} />
                                            ))}
                                        </Pie>
                                        <Tooltip />
                                    </PieChart>
                                </ResponsiveContainer>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
};

export default Infographics;
