import React, { useRef, useEffect } from "react";
import HTMLFlipBook from "react-pageflip";
import { ChevronLeft, ChevronRight } from "lucide-react";

interface NewspaperLayoutProps {
  children: React.ReactNode[];
  className?: string;
}

const NewspaperLayout: React.FC<NewspaperLayoutProps> = ({
  children,
  className = "",
}) => {
  const flipBookRef = useRef<any>(null);

  const nextPage = () => {
    if (flipBookRef.current) {
      flipBookRef.current.pageFlip().flipNext();
    }
  };

  const prevPage = () => {
    if (flipBookRef.current) {
      flipBookRef.current.pageFlip().flipPrev();
    }
  };

  return (
    <div className={`relative w-full h-screen bg-gray-100 ${className}`}>
      {/* Navigation Controls */}
      <div className="absolute top-4 left-4 z-10 flex gap-2">
        <button
          onClick={prevPage}
          className="bg-white/80 hover:bg-white text-gray-800 p-2 rounded-full shadow-lg transition-all duration-200"
          aria-label="Previous page"
        >
          <ChevronLeft size={20} />
        </button>
        <button
          onClick={nextPage}
          className="bg-white/80 hover:bg-white text-gray-800 p-2 rounded-full shadow-lg transition-all duration-200"
          aria-label="Next page"
        >
          <ChevronRight size={20} />
        </button>
      </div>

      {/* Page Counter */}
      <div className="absolute top-4 right-4 z-10 bg-white/80 px-3 py-1 rounded-full shadow-lg">
        <span className="text-sm text-gray-800 font-medium">
          Page <span id="current-page">1</span> of {children.length}
        </span>
      </div>

      {/* Flip Book Container */}
      <div className="w-full h-full flex items-center justify-center p-4">
        <HTMLFlipBook
          ref={flipBookRef}
          width={400}
          height={600}
          size="stretch"
          minWidth={300}
          maxWidth={500}
          minHeight={400}
          maxHeight={700}
          maxShadowOpacity={0.5}
          showCover={true}
          mobileScrollSupport={true}
          className="shadow-2xl"
          onFlip={(e) => {
            const currentPageElement = document.getElementById("current-page");
            if (currentPageElement) {
              currentPageElement.textContent = (e.data + 1).toString();
            }
          }}
        >
          {children}
        </HTMLFlipBook>
      </div>

      {/* Mobile Instructions */}
      <div className="absolute bottom-4 left-1/2 transform -translate-x-1/2 z-10 md:hidden">
        <div className="bg-white/90 px-4 py-2 rounded-full shadow-lg">
          <p className="text-xs text-gray-600 text-center">
            Swipe or tap to turn pages
          </p>
        </div>
      </div>
    </div>
  );
};

export default NewspaperLayout;

