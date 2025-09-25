import { PageFlip } from 'page-flip';
import React, { useEffect, useRef } from 'react';

interface FlipbookProps {
    pages: string[];
}

const Flipbook: React.FC<FlipbookProps> = ({ pages }) => {
    const flipbookRef = useRef<HTMLDivElement>(null);

    useEffect(() => {
        if (!flipbookRef.current) return;

        const pageFlip = new PageFlip(flipbookRef.current, {
            width: 400,
            height: 300,
            drawShadow: true,
            flippingTime: 700,
        });

        // buat halaman dari props
        const pageElements = pages.map((content, index) => {
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
