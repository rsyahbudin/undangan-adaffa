import { PageFlip } from 'page-flip';
import React, { useEffect, useRef } from 'react';

interface FlipbookProps {
    pages: string[];
}

const Flipbook: React.FC<FlipbookProps> = ({ pages }) => {
    const flipbookRef = useRef<HTMLDivElement>(null);

    useEffect(() => {
        if (!flipbookRef.current) return;

        const isMobile = window.innerWidth <= 768;
        const isDesktop = window.innerWidth > 768;

        const pageFlip = new PageFlip(flipbookRef.current, {
            width: isMobile ? 350 : isDesktop ? 700 : 500,
            height: isMobile ? 500 : isDesktop ? 900 : 650,
            drawShadow: true,
            flippingTime: isMobile ? 500 : 700,
            useTouchEvents: isMobile,
            mobileScrollSupport: isMobile,
            usePortrait: isMobile,
            swipeDistance: isMobile ? 10 : 30, // Reduce swipe distance for easier flipping on mobile
            clickEventForward: true, // Allow clicking to flip on mobile
            showCover: false,
        });

        // buat halaman dari props
        const pageElements = pages.map((content) => {
            const div = document.createElement('div');
            div.className = 'page';
            div.innerHTML = content;
            return div;
        });

        pageFlip.loadFromHTML(pageElements);

        return () => pageFlip.destroy(); // bersihkan ketika unmount
    }, [pages]);

    return <div ref={flipbookRef} />;
};

export default Flipbook;
