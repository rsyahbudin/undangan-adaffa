import React, { useState } from "react";
import NewspaperPage from "./NewspaperPage";
import { ChevronLeft, ChevronRight, X } from "lucide-react";

interface GalleryPageProps {
  images: string[];
}

const GalleryPage: React.FC<GalleryPageProps> = ({ images }) => {
  const [selectedImage, setSelectedImage] = useState<string | null>(null);
  const [currentIndex, setCurrentIndex] = useState(0);

  const openModal = (image: string, index: number) => {
    setSelectedImage(image);
    setCurrentIndex(index);
  };

  const closeModal = () => {
    setSelectedImage(null);
  };

  const nextImage = () => {
    setCurrentIndex((prev) => (prev + 1) % images.length);
  };

  const prevImage = () => {
    setCurrentIndex((prev) => (prev - 1 + images.length) % images.length);
  };

  // If no images provided, show placeholder
  const displayImages = images.length > 0 ? images : Array(6).fill(null);

  return (
    <>
      <NewspaperPage pageNumber={5} className="relative">
        {/* Page Title */}
        <div className="text-center mb-6">
          <h1 className="text-2xl md:text-3xl font-bold text-gray-800 font-serif mb-2">
            GALERI FOTO
          </h1>
          <div className="w-16 h-0.5 bg-gray-800 mx-auto"></div>
        </div>

        {/* Gallery Grid */}
        <div className="grid grid-cols-2 md:grid-cols-3 gap-3">
          {displayImages.map((image, index) => (
            <div
              key={index}
              className="aspect-square rounded-lg overflow-hidden cursor-pointer hover:opacity-80 transition-opacity"
              onClick={() => image && openModal(image, index)}
            >
              {image ? (
                <img
                  src={image}
                  alt={`Gallery ${index + 1}`}
                  className="w-full h-full object-cover"
                />
              ) : (
                <div className="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                  <div className="text-center text-gray-500">
                    <div className="text-2xl mb-1">📸</div>
                    <div className="text-xs font-serif">Photo {index + 1}</div>
                  </div>
                </div>
              )}
            </div>
          ))}
        </div>

        {/* Gallery Info */}
        <div className="mt-6 text-center">
          <div className="bg-gray-100 rounded-lg p-4">
            <p className="text-sm text-gray-600 font-serif">
              Klik foto untuk melihat dalam ukuran penuh
            </p>
            <p className="text-xs text-gray-500 font-serif mt-1">
              {images.length > 0
                ? `${images.length} foto tersedia`
                : "Foto akan segera diunggah"}
            </p>
          </div>
        </div>

        {/* Decorative Elements */}
        <div className="absolute top-16 left-4 w-4 h-4 border border-gray-300 rounded-full"></div>
        <div className="absolute top-16 right-4 w-4 h-4 border border-gray-300 rounded-full"></div>
        <div className="absolute bottom-16 left-4 w-3 h-3 border border-gray-300 rounded-full"></div>
        <div className="absolute bottom-16 right-4 w-3 h-3 border border-gray-300 rounded-full"></div>
      </NewspaperPage>

      {/* Image Modal */}
      {selectedImage && (
        <div className="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 p-4">
          <div className="relative max-w-4xl max-h-full">
            {/* Close Button */}
            <button
              onClick={closeModal}
              className="absolute top-4 right-4 z-10 bg-white/20 hover:bg-white/30 text-white p-2 rounded-full transition-colors"
            >
              <X size={24} />
            </button>

            {/* Navigation Buttons */}
            {images.length > 1 && (
              <>
                <button
                  onClick={prevImage}
                  className="absolute left-4 top-1/2 transform -translate-y-1/2 z-10 bg-white/20 hover:bg-white/30 text-white p-2 rounded-full transition-colors"
                >
                  <ChevronLeft size={24} />
                </button>
                <button
                  onClick={nextImage}
                  className="absolute right-4 top-1/2 transform -translate-y-1/2 z-10 bg-white/20 hover:bg-white/30 text-white p-2 rounded-full transition-colors"
                >
                  <ChevronRight size={24} />
                </button>
              </>
            )}

            {/* Image */}
            <img
              src={images[currentIndex]}
              alt={`Gallery ${currentIndex + 1}`}
              className="max-w-full max-h-full object-contain rounded-lg"
            />

            {/* Image Counter */}
            {images.length > 1 && (
              <div className="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-white/20 text-white px-3 py-1 rounded-full text-sm">
                {currentIndex + 1} / {images.length}
              </div>
            )}
          </div>
        </div>
      )}
    </>
  );
};

export default GalleryPage;

