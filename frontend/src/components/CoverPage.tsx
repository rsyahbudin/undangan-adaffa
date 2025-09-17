import React from "react";
import NewspaperPage from "./NewspaperPage";

interface CoverPageProps {
  guestName: string;
  coverImage?: string;
  coupleNames: {
    groom: string;
    bride: string;
  };
  weddingDate: string;
  weddingLocation: string;
}

const CoverPage: React.FC<CoverPageProps> = ({
  guestName,
  coverImage,
  coupleNames,
  weddingDate,
  weddingLocation,
}) => {
  return (
    <NewspaperPage pageNumber={1} className="relative">
      {/* Cover Image */}
      <div className="h-1/3 mb-6 relative overflow-hidden rounded-lg">
        {coverImage ? (
          <img
            src={coverImage}
            alt="Wedding Cover"
            className="w-full h-full object-cover"
          />
        ) : (
          <div className="w-full h-full bg-gradient-to-br from-rose-100 to-pink-200 flex items-center justify-center">
            <div className="text-center text-gray-600">
              <div className="text-4xl mb-2">💒</div>
              <div className="text-sm font-serif">Wedding Photo</div>
            </div>
          </div>
        )}
      </div>

      {/* Main Title */}
      <div className="text-center mb-6">
        <h1 className="text-3xl md:text-4xl font-bold text-gray-800 font-serif mb-2">
          WEDDING INVITATION
        </h1>
        <div className="w-24 h-0.5 bg-gray-800 mx-auto mb-4"></div>
      </div>

      {/* Guest Name */}
      <div className="text-center mb-6">
        <p className="text-sm text-gray-600 font-serif mb-2">Kepada Yth.</p>
        <h2 className="text-xl md:text-2xl font-bold text-gray-800 font-serif">
          {guestName}
        </h2>
      </div>

      {/* Couple Names */}
      <div className="text-center mb-6">
        <div className="flex items-center justify-center gap-4 mb-4">
          <div className="text-right">
            <h3 className="text-lg md:text-xl font-bold text-gray-800 font-serif">
              {coupleNames.groom}
            </h3>
            <p className="text-sm text-gray-600 font-serif">Putra dari</p>
            <p className="text-sm text-gray-600 font-serif">Bapak & Ibu</p>
          </div>

          <div className="text-2xl text-gray-400">&</div>

          <div className="text-left">
            <h3 className="text-lg md:text-xl font-bold text-gray-800 font-serif">
              {coupleNames.bride}
            </h3>
            <p className="text-sm text-gray-600 font-serif">Putri dari</p>
            <p className="text-sm text-gray-600 font-serif">Bapak & Ibu</p>
          </div>
        </div>
      </div>

      {/* Wedding Details */}
      <div className="text-center space-y-2">
        <div className="text-sm text-gray-600 font-serif">
          Dengan memohon rahmat dan ridho Allah SWT
        </div>
        <div className="text-sm text-gray-600 font-serif">
          bermaksud menyelenggarakan pernikahan putra-putri kami
        </div>

        <div className="mt-4 p-4 bg-gray-50 rounded-lg">
          <div className="text-sm font-bold text-gray-800 font-serif mb-2">
            {weddingDate}
          </div>
          <div className="text-sm text-gray-600 font-serif">
            {weddingLocation}
          </div>
        </div>
      </div>

      {/* Decorative Elements */}
      <div className="absolute top-4 left-4 w-8 h-8 border-2 border-gray-300 rounded-full"></div>
      <div className="absolute top-4 right-4 w-8 h-8 border-2 border-gray-300 rounded-full"></div>
      <div className="absolute bottom-20 left-4 w-6 h-6 border-2 border-gray-300 rounded-full"></div>
      <div className="absolute bottom-20 right-4 w-6 h-6 border-2 border-gray-300 rounded-full"></div>
    </NewspaperPage>
  );
};

export default CoverPage;

