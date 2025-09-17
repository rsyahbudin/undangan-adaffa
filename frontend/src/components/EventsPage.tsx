import React from "react";
import NewspaperPage from "./NewspaperPage";
import { Calendar, Clock, MapPin } from "lucide-react";
import { Event } from "../types";

interface EventsPageProps {
  events: Event[];
  guestType: "resepsi1" | "resepsi2" | "both";
}

const EventsPage: React.FC<EventsPageProps> = ({ events, guestType }) => {
  const getFilteredEvents = () => {
    if (guestType === "both") {
      return events;
    } else if (guestType === "resepsi1") {
      return events.filter(
        (event) =>
          event.name.toLowerCase().includes("akad") ||
          event.name.toLowerCase().includes("resepsi 1")
      );
    } else if (guestType === "resepsi2") {
      return events.filter(
        (event) =>
          event.name.toLowerCase().includes("akad") ||
          event.name.toLowerCase().includes("resepsi 2")
      );
    }
    return events;
  };

  const filteredEvents = getFilteredEvents();

  return (
    <NewspaperPage pageNumber={4} className="relative">
      {/* Page Title */}
      <div className="text-center mb-6">
        <h1 className="text-2xl md:text-3xl font-bold text-gray-800 font-serif mb-2">
          JADWAL ACARA
        </h1>
        <div className="w-16 h-0.5 bg-gray-800 mx-auto"></div>
      </div>

      {/* Guest Type Info */}
      <div className="text-center mb-6">
        <div className="inline-block bg-gray-100 px-4 py-2 rounded-full">
          <p className="text-sm text-gray-600 font-serif">
            {guestType === "both" && "Undangan untuk semua acara"}
            {guestType === "resepsi1" && "Undangan untuk Akad & Resepsi 1"}
            {guestType === "resepsi2" && "Undangan untuk Akad & Resepsi 2"}
          </p>
        </div>
      </div>

      {/* Events List */}
      <div className="space-y-6">
        {filteredEvents.map((event, index) => (
          <div
            key={index}
            className="border border-gray-200 rounded-lg p-4 bg-gray-50"
          >
            {/* Event Name */}
            <div className="text-center mb-4">
              <h2 className="text-lg md:text-xl font-bold text-gray-800 font-serif">
                {event.name.toUpperCase()}
              </h2>
              <div className="w-12 h-0.5 bg-gray-600 mx-auto mt-2"></div>
            </div>

            {/* Event Details */}
            <div className="space-y-3">
              {/* Date */}
              <div className="flex items-center gap-3">
                <Calendar size={16} className="text-gray-600 flex-shrink-0" />
                <div>
                  <p className="text-sm font-semibold text-gray-800 font-serif">
                    {event.date}
                  </p>
                </div>
              </div>

              {/* Time */}
              <div className="flex items-center gap-3">
                <Clock size={16} className="text-gray-600 flex-shrink-0" />
                <div>
                  <p className="text-sm font-semibold text-gray-800 font-serif">
                    {event.time}
                  </p>
                </div>
              </div>

              {/* Location */}
              <div className="flex items-start gap-3">
                <MapPin
                  size={16}
                  className="text-gray-600 flex-shrink-0 mt-0.5"
                />
                <div>
                  <p className="text-sm font-semibold text-gray-800 font-serif">
                    {event.location}
                  </p>
                  <p className="text-xs text-gray-600 font-serif mt-1">
                    {event.address}
                  </p>
                </div>
              </div>
            </div>
          </div>
        ))}
      </div>

      {/* Additional Info */}
      <div className="mt-6 text-center">
        <div className="bg-gray-100 rounded-lg p-4">
          <p className="text-xs text-gray-600 font-serif">
            * Mohon konfirmasi kehadiran melalui halaman RSVP
          </p>
          <p className="text-xs text-gray-600 font-serif mt-1">
            * Dress code: Formal / Semi Formal
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

export default EventsPage;
