import React from "react";
import NewspaperPage from "./NewspaperPage";

interface CouplePageProps {
  groom: {
    name: string;
    father: string;
    mother: string;
    photo?: string;
  };
  bride: {
    name: string;
    father: string;
    mother: string;
    photo?: string;
  };
}

const CouplePage: React.FC<CouplePageProps> = ({ groom, bride }) => {
  return (
    <NewspaperPage pageNumber={2} className="relative">
      {/* Page Title */}
      <div className="text-center mb-6">
        <h1 className="text-2xl md:text-3xl font-bold text-gray-800 font-serif mb-2">
          THE COUPLE
        </h1>
        <div className="w-16 h-0.5 bg-gray-800 mx-auto"></div>
      </div>

      {/* Groom Section */}
      <div className="mb-8">
        <div className="text-center mb-4">
          <h2 className="text-lg font-bold text-gray-800 font-serif mb-2">
            MEMPELAI PRIA
          </h2>
          <div className="w-12 h-0.5 bg-gray-600 mx-auto"></div>
        </div>

        <div className="flex flex-col md:flex-row items-center gap-6">
          {/* Groom Photo */}
          <div className="w-32 h-32 md:w-40 md:h-40 rounded-full overflow-hidden border-4 border-gray-200 shadow-lg">
            {groom.photo ? (
              <img
                src={groom.photo}
                alt={groom.name}
                className="w-full h-full object-cover"
              />
            ) : (
              <div className="w-full h-full bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                <div className="text-center text-gray-600">
                  <div className="text-3xl mb-1">👨</div>
                  <div className="text-xs font-serif">Groom</div>
                </div>
              </div>
            )}
          </div>

          {/* Groom Details */}
          <div className="text-center md:text-left flex-1">
            <h3 className="text-xl md:text-2xl font-bold text-gray-800 font-serif mb-2">
              {groom.name}
            </h3>
            <div className="space-y-1 text-sm text-gray-600 font-serif">
              <p>Putra dari</p>
              <p className="font-semibold text-gray-800">{groom.father}</p>
              <p className="font-semibold text-gray-800">{groom.mother}</p>
            </div>
          </div>
        </div>
      </div>

      {/* Divider */}
      <div className="flex items-center justify-center mb-8">
        <div className="flex-1 h-0.5 bg-gray-300"></div>
        <div className="mx-4 text-2xl text-gray-400">&</div>
        <div className="flex-1 h-0.5 bg-gray-300"></div>
      </div>

      {/* Bride Section */}
      <div>
        <div className="text-center mb-4">
          <h2 className="text-lg font-bold text-gray-800 font-serif mb-2">
            MEMPELAI WANITA
          </h2>
          <div className="w-12 h-0.5 bg-gray-600 mx-auto"></div>
        </div>

        <div className="flex flex-col md:flex-row items-center gap-6">
          {/* Bride Photo */}
          <div className="w-32 h-32 md:w-40 md:h-40 rounded-full overflow-hidden border-4 border-gray-200 shadow-lg">
            {bride.photo ? (
              <img
                src={bride.photo}
                alt={bride.name}
                className="w-full h-full object-cover"
              />
            ) : (
              <div className="w-full h-full bg-gradient-to-br from-pink-100 to-pink-200 flex items-center justify-center">
                <div className="text-center text-gray-600">
                  <div className="text-3xl mb-1">👩</div>
                  <div className="text-xs font-serif">Bride</div>
                </div>
              </div>
            )}
          </div>

          {/* Bride Details */}
          <div className="text-center md:text-left flex-1">
            <h3 className="text-xl md:text-2xl font-bold text-gray-800 font-serif mb-2">
              {bride.name}
            </h3>
            <div className="space-y-1 text-sm text-gray-600 font-serif">
              <p>Putri dari</p>
              <p className="font-semibold text-gray-800">{bride.father}</p>
              <p className="font-semibold text-gray-800">{bride.mother}</p>
            </div>
          </div>
        </div>
      </div>

      {/* Decorative Elements */}
      <div className="absolute top-20 left-4 w-4 h-4 border border-gray-300 rounded-full"></div>
      <div className="absolute top-20 right-4 w-4 h-4 border border-gray-300 rounded-full"></div>
      <div className="absolute bottom-16 left-4 w-3 h-3 border border-gray-300 rounded-full"></div>
      <div className="absolute bottom-16 right-4 w-3 h-3 border border-gray-300 rounded-full"></div>
    </NewspaperPage>
  );
};

export default CouplePage;

