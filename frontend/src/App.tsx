import React, { useState, useEffect } from "react";
import "./App.css";
import NewspaperLayout from "./components/NewspaperLayout";
import CoverPage from "./components/CoverPage";
import CouplePage from "./components/CouplePage";
import CountdownPage from "./components/CountdownPage";
import EventsPage from "./components/EventsPage";
import GalleryPage from "./components/GalleryPage";
import LocationPage from "./components/LocationPage";
import RSVPPage from "./components/RSVPPage";
import { WeddingData, GuestData, RSVPData } from "./types";
import { api } from "./utils/api";
import { DEFAULT_WEDDING_DATA, MESSAGES } from "./utils/constants";

function App() {
  const [weddingData, setWeddingData] = useState<WeddingData | null>(null);
  const [guestData, setGuestData] = useState<GuestData | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);
  const [rsvpSubmitted, setRsvpSubmitted] = useState(false);

  // Get guest ID from URL parameters
  const getGuestId = () => {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get("guest") || "default";
  };

  // Fetch wedding data
  useEffect(() => {
    const fetchWeddingData = async () => {
      try {
        setLoading(true);
        const guestId = getGuestId();

        // Fetch guest-specific data
        const data = await api.getGuestData(guestId);
        setWeddingData(data);
        setGuestData({
          name: data.name,
          type: data.type,
        });
      } catch (err) {
        console.error("Error fetching wedding data:", err);
        setError(MESSAGES.error);

        // Fallback data for development
        setWeddingData(DEFAULT_WEDDING_DATA);
        setGuestData({
          name: "Tamu Undangan",
          type: "both",
        });
      } finally {
        setLoading(false);
      }
    };

    fetchWeddingData();
  }, []);

  // Handle RSVP submission
  const handleRSVPSubmit = async (rsvpData: RSVPData) => {
    try {
      await api.submitRSVP(rsvpData);
      setRsvpSubmitted(true);
    } catch (err) {
      console.error("Error submitting RSVP:", err);
      // For development, still show success message
      setRsvpSubmitted(true);
    }
  };

  if (loading) {
    return (
      <div className="min-h-screen bg-gray-100 flex items-center justify-center">
        <div className="text-center">
          <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-gray-800 mx-auto mb-4"></div>
          <p className="text-gray-600 font-serif">{MESSAGES.loading}</p>
        </div>
      </div>
    );
  }

  if (error) {
    return (
      <div className="min-h-screen bg-gray-100 flex items-center justify-center">
        <div className="text-center max-w-md mx-auto p-6">
          <div className="text-4xl mb-4">😔</div>
          <h2 className="text-xl font-bold text-gray-800 font-serif mb-2">
            Oops! Something went wrong
          </h2>
          <p className="text-gray-600 font-serif mb-4">{error}</p>
          <button
            onClick={() => window.location.reload()}
            className="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors font-serif"
          >
            {MESSAGES.tryAgain}
          </button>
        </div>
      </div>
    );
  }

  if (!weddingData || !guestData) {
    return null;
  }

  // Create pages array
  const pages = [
    <CoverPage
      key="cover"
      guestName={guestData.name}
      coverImage={weddingData.coverImage}
      coupleNames={{
        groom: weddingData.couple.groom.name,
        bride: weddingData.couple.bride.name,
      }}
      weddingDate={weddingData.events[0]?.date || "TBA"}
      weddingLocation={weddingData.events[0]?.location || "TBA"}
    />,
    <CouplePage
      key="couple"
      groom={weddingData.couple.groom}
      bride={weddingData.couple.bride}
    />,
    <CountdownPage key="countdown" weddingDate={weddingData.weddingDate} />,
    <EventsPage
      key="events"
      events={weddingData.events}
      guestType={guestData.type}
    />,
    <GalleryPage key="gallery" images={weddingData.gallery} />,
    <LocationPage key="location" locations={weddingData.locations} />,
    <RSVPPage
      key="rsvp"
      onSubmit={handleRSVPSubmit}
      isSubmitted={rsvpSubmitted}
    />,
  ];

  return (
    <div className="App">
      <NewspaperLayout>{pages}</NewspaperLayout>
    </div>
  );
}

export default App;
