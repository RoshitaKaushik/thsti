import React, { useState, useEffect } from 'react';
import { Link, useLocation } from 'react-router-dom';
import { LayoutDashboard, Menu as MenuIcon, Settings, LogOut, LayoutTemplate, Image, FileText, Newspaper, ChevronRight, ChevronLeft, Languages, Beaker, Home, ChevronDown, Bell, Megaphone, Users, UserCircle, Globe, GraduationCap } from 'lucide-react';
import { toast } from 'react-hot-toast';
import api from '../api/axios';

const ICON_MAP = {
    LayoutDashboard,
    MenuIcon,
    Settings,
    LogOut,
    LayoutTemplate,
    Image,
    FileText,
    Newspaper,
    Languages,
    Beaker,
    Home,
    Bell,
    Megaphone,
    Users,
    UserCircle,
    Globe,
    GraduationCap
};

const renderIcon = (iconName, size = 18) => {
    const IconComponent = ICON_MAP[iconName] || FileText;
    return <IconComponent size={size} strokeWidth={1.5} />;
};

export default function Sidebar() {
    const location = useLocation();
    const currentPath = location.pathname;

    const [isCollapsed, setIsCollapsed] = useState(() => {
        const saved = localStorage.getItem('thsti_admin_sidebar_collapsed');
        return saved === 'true';
    });

    const [navItems, setNavItems] = useState([]);

    useEffect(() => {
        api.get('/admin-sidebar')
            .then(res => setNavItems(res.data || []))
            .catch(err => {
                console.error("Failed to fetch sidebar modules:", err);
                toast.error("Failed to load navigation menu.");
            });
    }, []);

    useEffect(() => {
        localStorage.setItem('thsti_admin_sidebar_collapsed', isCollapsed);
    }, [isCollapsed]);

    const handleLogout = () => {
        localStorage.removeItem('thsti_admin_token');
        localStorage.removeItem('thsti_admin_user');
        window.location.href = '/';
    };

    const [isHomeMenuOpen, setIsHomeMenuOpen] = useState(true);

    const [hoveredItemId, setHoveredItemId] = useState(null);
    const [flyoutAnchorRect, setFlyoutAnchorRect] = useState(null);
    const hoverTimeout = React.useRef(null);

    const handleItemEnter = (e, itemName) => {
        if (!isCollapsed) return;
        if (hoverTimeout.current) clearTimeout(hoverTimeout.current);
        const rect = e.currentTarget.getBoundingClientRect();
        setFlyoutAnchorRect(rect);
        setHoveredItemId(itemName);
    };

    const handleItemLeave = () => {
        if (!isCollapsed) return;
        hoverTimeout.current = setTimeout(() => {
            setHoveredItemId(null);
        }, 150);
    };

    const handleFlyoutEnter = () => {
        if (hoverTimeout.current) clearTimeout(hoverTimeout.current);
    };

    const handleFlyoutLeave = () => {
        hoverTimeout.current = setTimeout(() => {
            setHoveredItemId(null);
        }, 150);
    };

    useEffect(() => {
        const handleKeyDown = (e) => {
            if (e.key === 'Escape') setHoveredItemId(null);
        };
        window.addEventListener('keydown', handleKeyDown);
        return () => window.removeEventListener('keydown', handleKeyDown);
    }, []);

    useEffect(() => {
        setHoveredItemId(null);
    }, [currentPath]);

    const isChildActive = (children) => {
        if (!children) return false;
        return children.some(child => currentPath.startsWith(child.path));
    };

    useEffect(() => {
        const homePageItem = navItems.find(item => item.name === 'Home Page');
        if (homePageItem && isChildActive(homePageItem.children)) {
            setIsHomeMenuOpen(true);
        }
    }, [currentPath, navItems]);

    const isMatch = (path) => {
        if (path === '/dashboard') {
            return currentPath === '/dashboard';
        }
        return currentPath.startsWith(path);
    };

    return (
        <div
            className={`bg-secondary text-white min-h-screen flex flex-col shrink-0 transition-all duration-200 ease-in-out relative z-20 ${isCollapsed ? 'w-[65px]' : 'w-[260px]'}`}
        >
            <div className={`flex items-center h-16 shrink-0 px-5 justify-between border-b border-white/10`}>
                {!isCollapsed && (
                    <div className="flex items-center gap-2 overflow-hidden whitespace-nowrap">
                        <span className="font-medium text-white text-base">Navigation</span>
                    </div>
                )}
                
                <button
                    onClick={() => setIsCollapsed(!isCollapsed)}
                    className="text-gray-400 hover:text-white focus:outline-none ml-auto transition-colors"
                    title={isCollapsed ? "Expand Sidebar" : "Collapse Sidebar"}
                >
                    {isCollapsed ? <MenuIcon size={20} strokeWidth={1.5} /> : <ChevronLeft size={20} strokeWidth={1.5} />}
                </button>
            </div>

            <div className="flex-1 py-4 overflow-y-auto overflow-x-hidden sidebar-scrollbar">
                <ul className="flex flex-col m-0 p-0 list-none space-y-0.5 px-3">
                    {navItems.map((item, index) => {
                        if (item.children && item.children.length > 0) {
                            const parentActive = isChildActive(item.children);

                            return (
                                <li
                                    key={item.name}
                                    className="relative flex flex-col"
                                    onMouseEnter={(e) => handleItemEnter(e, item.name)}
                                    onMouseLeave={handleItemLeave}
                                    onFocus={(e) => handleItemEnter(e, item.name)}
                                    onBlur={handleItemLeave}
                                >
                                    <button
                                        onClick={() => setIsHomeMenuOpen(!isHomeMenuOpen)}
                                        title={isCollapsed ? item.name : undefined}
                                        className={`flex items-center justify-between py-2 px-3 w-full text-left rounded transition-colors
                                            ${parentActive ? 'bg-white/10 text-white font-medium' : 'text-gray-300 hover:bg-white/5 hover:text-white'} 
                                            ${isCollapsed ? 'justify-center' : ''}`}
                                    >
                                        <div className={`flex items-center gap-3 ${isCollapsed ? 'mx-auto' : ''}`}>
                                            <span className="shrink-0">
                                                {renderIcon(item.icon, 18)}
                                            </span>
                                            {!isCollapsed && (
                                                <span className="truncate text-[14px]">
                                                    {item.name}
                                                </span>
                                            )}
                                        </div>
                                        {!isCollapsed && (
                                            <ChevronDown size={14} className={`text-gray-400 transition-transform duration-200 ${isHomeMenuOpen ? 'rotate-180' : ''}`} />
                                        )}
                                    </button>

                                    {(!isCollapsed && isHomeMenuOpen) && (
                                        <ul className="m-0 p-0 list-none mt-1 space-y-0.5 ml-[22px]">
                                            {item.children.map((child) => {
                                                const childActive = isMatch(child.path);
                                                return (
                                                    <li key={child.path}>
                                                        <Link
                                                            to={child.path}
                                                            className={`flex items-center gap-3 py-1.5 px-3 rounded transition-colors text-[13.5px] ${childActive
                                                                ? 'text-white font-medium bg-white/10'
                                                                : 'text-gray-400 hover:text-white hover:bg-white/5'
                                                                }`}
                                                        >
                                                            <span className="shrink-0">
                                                                {renderIcon(child.icon, 16)}
                                                            </span>
                                                            <span className="truncate">{child.name}</span>
                                                        </Link>
                                                    </li>
                                                );
                                            })}
                                        </ul>
                                    )}
                                </li>
                            );
                        }

                        const active = isMatch(item.path);
                        return (
                            <li
                                key={item.path || index}
                                className="relative"
                                onMouseEnter={(e) => handleItemEnter(e, item.name)}
                                onMouseLeave={handleItemLeave}
                                onFocus={(e) => handleItemEnter(e, item.name)}
                                onBlur={handleItemLeave}
                            >
                                <Link
                                    to={item.path}
                                    title={isCollapsed ? item.name : undefined}
                                    className={`flex items-center gap-3 py-2 px-3 rounded transition-colors w-full
                                        ${active ? 'bg-white/10 text-white font-medium' : 'text-gray-300 hover:bg-white/5 hover:text-white'} 
                                        ${isCollapsed ? 'justify-center' : 'justify-start'}`}
                                >
                                    <span className="shrink-0">
                                        {renderIcon(item.icon, 18)}
                                    </span>
                                    {!isCollapsed && (
                                        <span className="truncate text-[14px]">
                                            {item.name}
                                        </span>
                                    )}
                                </Link>
                            </li>
                        );
                    })}
                </ul>
            </div>

            {isCollapsed && hoveredItemId && flyoutAnchorRect && (() => {
                const hoveredItem = navItems.find(i => i.name === hoveredItemId);
                if (!hoveredItem) return null;
                return (
                    <div
                        className="fixed bg-secondary border border-gray-600 shadow-lg rounded-md flex flex-col z-[9999]"
                        style={{
                            top: flyoutAnchorRect.top,
                            left: flyoutAnchorRect.right + 4,
                            minWidth: '200px',
                            padding: '6px'
                        }}
                        onMouseEnter={handleFlyoutEnter}
                        onMouseLeave={handleFlyoutLeave}
                        role="menu"
                    >
                        <div className="font-medium text-white px-3 pb-2 text-[14px] border-b border-white/10 mb-1">
                            {hoveredItem.name}
                        </div>
                        {hoveredItem.children && hoveredItem.children.length > 0 ? (
                            <ul className="m-0 p-0 list-none space-y-0.5">
                                {hoveredItem.children.map(child => {
                                    const active = isMatch(child.path);
                                    return (
                                        <li key={child.path} role="menuitem">
                                            <Link
                                                to={child.path}
                                                onClick={() => setHoveredItemId(null)}
                                                className={`flex items-center gap-2 py-1.5 px-3 rounded text-[13.5px] ${active ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5'} transition-colors`}
                                            >
                                                <span className="shrink-0">{renderIcon(child.icon, 16)}</span>
                                                <span className="truncate">{child.name}</span>
                                            </Link>
                                        </li>
                                    );
                                })}
                            </ul>
                        ) : (
                            <div className="p-0" role="menuitem">
                                <Link
                                    to={hoveredItem.path}
                                    onClick={() => setHoveredItemId(null)}
                                    className="text-[13.5px] text-gray-300 pt-1 px-3 hover:text-white flex items-center gap-1"
                                >
                                    Open {hoveredItem.name} <ChevronRight size={14} />
                                </Link>
                            </div>
                        )}
                    </div>
                );
            })()}

            <div className="border-t border-white/10 shrink-0 p-3">
                <button
                    onClick={handleLogout}
                    title={isCollapsed ? "Logout" : undefined}
                    className={`flex items-center gap-3 w-full py-2 px-3 rounded text-gray-400 hover:text-white hover:bg-white/5 transition-colors ${isCollapsed ? 'justify-center' : 'justify-start'}`}
                >
                    <span className="shrink-0">
                        <LogOut size={18} strokeWidth={1.5} />
                    </span>
                    {!isCollapsed && <span className="truncate text-[14px]">Log Out</span>}
                </button>
            </div>
        </div>
    );
}
