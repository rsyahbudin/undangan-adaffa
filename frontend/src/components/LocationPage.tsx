import React from "react";
import NewspaperPage from "./NewspaperPage";
import { MapPin, Navigation, Phone, Mail } from "lucide-react";
import { Location } from "../types";

interface LocationPageProps {
  locations: Location[];
}

const LocationPage: React.FC<LocationPageProps> = ({ locations }) => {
  const openMaps = (location: any) => {
    if (location.mapUrl) {
      window.open(location.mapUrl, "_blank");
    } else if (location.coordinates) {
      const { lat, lng } = location.coordinates;
      const mapsUrl = `https://www.google.com/maps?q=${lat},${lng}`;
      window.open(mapsUrl, "_blank");
    }
  };

  return (
    <NewspaperPage pageNumber={6} className="relative">
      {/* Page Title */}
      <div className="text-center mb-6">
        <h1 className="text-2xl md:text-3xl font-bold text-gray-800 font-serif mb-2">
          LOKASI ACARA
        </h1>
        <div className="w-16 h-0.5 bg-gray-800 mx-auto"></div>
      </div>

      {/* Locations List */}
      <div className="space-y-6">
        {locations.map((location, index) => (
          <div
            key={index}
            className="border border-gray-200 rounded-lg p-4 bg-gray-50"
          >
            {/* Location Name */}
            <div className="text-center mb-4">
              <h2 className="text-lg md:text-xl font-bold text-gray-800 font-serif">
                {location.name.toUpperCase()}
              </h2>
              <div className="w-12 h-0.5 bg-gray-600 mx-auto mt-2"></div>
            </div>

            {/* Location Details */}
            <div className="space-y-3">
              {/* Address */}
              <div className="flex items-start gap-3">
                <MapPin
                  size={16}
                  className="text-gray-600 flex-shrink-0 mt-0.5"
                />
                <div>
                  <p className="text-sm text-gray-800 font-serif">
                    {location.address}
                  </p>
                </div>
              </div>

              {/* Phone */}
              {location.phone && (
                <div className="flex items-center gap-3">
                  <Phone size={16} className="text-gray-600 flex-shrink-0" />
                  <div>
                    <p className="text-sm text-gray-800 font-serif">
                      {location.phone}
                    </p>
                  </div>
                </div>
              )}

              {/* Email */}
              {location.email && (
                <div className="flex items-center gap-3">
                  <Mail size={16} className="text-gray-600 flex-shrink-0" />
                  <div>
                    <p className="text-sm text-gray-800 font-serif">
                      {location.email}
                    </p>
                  </div>
                </div>
              )}
            </div>

            {/* Map Button */}
            <div className="mt-4 text-center">
              <button
                onClick={() => openMaps(location)}
                className="inline-flex items-center gap-2 bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors text-sm font-serif"
              >
                <Navigation size={16} />
                Buka di Maps
              </button>
            </div>
          </div>
        ))}
      </div>

      {/* Map Placeholder */}
      <div className="mt-6">
        <div className="bg-gray-100 rounded-lg p-6 text-center">
          <div className="text-4xl mb-2">🗺️</div>
          <p className="text-sm text-gray-600 font-serif mb-2">Peta Lokasi</p>
          <p className="text-xs text-gray-500 font-serif">
            Klik tombol "Buka di Maps" untuk melihat lokasi di Google Maps
          </p>
        </div>
      </div>

      {/* Additional Info */}
      <div className="mt-4 text-center">
        <div className="bg-gray-100 rounded-lg p-4">
          <p className="text-xs text-gray-600 font-serif">
            * Pastikan untuk datang tepat waktu
          </p>
          <p className="text-xs text-gray-600 font-serif mt-1">
            * Parkir tersedia di lokasi acara
          </p>
        </div>
      </div>

      {/* Decorative Elements */}
      <div className="absolute top-16 left-4 w-4 h-4 border border-gray-300 rounded-full"></div>
      <div className="absolute top-16 right-4 w-4 h-4 border border-gray-300 rounded-full"></div>
      <div className="absolute bottom-16 left-4 w-3 h-3 border border-gray-300 rounded-full"></div>
      <div className="absolute bottom-16 right-4 w-3 h-3 border border-gray-300 rounded-full"></div>
    </NewspaperPage>
  );
};

export default LocationPage;
