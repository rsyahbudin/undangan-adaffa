import React, { useState, useEffect } from "react";
import NewspaperPage from "./NewspaperPage";

interface CountdownPageProps {
  weddingDate: string; // Format: 'YYYY-MM-DD HH:mm:ss'
}

interface TimeLeft {
  days: number;
  hours: number;
  minutes: number;
  seconds: number;
}

const CountdownPage: React.FC<CountdownPageProps> = ({ weddingDate }) => {
  const [timeLeft, setTimeLeft] = useState<TimeLeft>({
    days: 0,
    hours: 0,
    minutes: 0,
    seconds: 0,
  });

  useEffect(() => {
    const calculateTimeLeft = (): TimeLeft => {
      const difference = +new Date(weddingDate) - +new Date();

      if (difference > 0) {
        return {
          days: Math.floor(difference / (1000 * 60 * 60 * 24)),
          hours: Math.floor((difference / (1000 * 60 * 60)) % 24),
          minutes: Math.floor((difference / 1000 / 60) % 60),
          seconds: Math.floor((difference / 1000) % 60),
        };
      }

      return { days: 0, hours: 0, minutes: 0, seconds: 0 };
    };

    const timer = setInterval(() => {
      setTimeLeft(calculateTimeLeft());
    }, 1000);

    // Initial calculation
    setTimeLeft(calculateTimeLeft());

    return () => clearInterval(timer);
  }, [weddingDate]);

  const isWeddingDay =
    timeLeft.days === 0 &&
    timeLeft.hours === 0 &&
    timeLeft.minutes === 0 &&
    timeLeft.seconds === 0;

  return (
    <NewspaperPage pageNumber={3} className="relative">
      {/* Page Title */}
      <div className="text-center mb-8">
        <h1 className="text-2xl md:text-3xl font-bold text-gray-800 font-serif mb-2">
          COUNTDOWN
        </h1>
        <div className="w-16 h-0.5 bg-gray-800 mx-auto"></div>
      </div>

      {/* Wedding Date Display */}
      <div className="text-center mb-8">
        <div className="text-sm text-gray-600 font-serif mb-2">
          Menuju hari bahagia
        </div>
        <div className="text-lg md:text-xl font-bold text-gray-800 font-serif">
          {new Date(weddingDate).toLocaleDateString("id-ID", {
            weekday: "long",
            year: "numeric",
            month: "long",
            day: "numeric",
          })}
        </div>
        <div className="text-sm text-gray-600 font-serif">
          {new Date(weddingDate).toLocaleTimeString("id-ID", {
            hour: "2-digit",
            minute: "2-digit",
          })}
        </div>
      </div>

      {/* Countdown Display */}
      {isWeddingDay ? (
        <div className="text-center">
          <div className="text-4xl mb-4">🎉</div>
          <h2 className="text-2xl md:text-3xl font-bold text-gray-800 font-serif mb-2">
            WEDDING DAY!
          </h2>
          <p className="text-gray-600 font-serif">
            Hari yang dinanti telah tiba!
          </p>
        </div>
      ) : (
        <div className="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
          {/* Days */}
          <div className="text-center">
            <div className="bg-gray-100 rounded-lg p-4 border-2 border-gray-200">
              <div className="text-2xl md:text-3xl font-bold text-gray-800 font-serif">
                {timeLeft.days}
              </div>
              <div className="text-xs md:text-sm text-gray-600 font-serif mt-1">
                Hari
              </div>
            </div>
          </div>

          {/* Hours */}
          <div className="text-center">
            <div className="bg-gray-100 rounded-lg p-4 border-2 border-gray-200">
              <div className="text-2xl md:text-3xl font-bold text-gray-800 font-serif">
                {timeLeft.hours}
              </div>
              <div className="text-xs md:text-sm text-gray-600 font-serif mt-1">
                Jam
              </div>
            </div>
          </div>

          {/* Minutes */}
          <div className="text-center">
            <div className="bg-gray-100 rounded-lg p-4 border-2 border-gray-200">
              <div className="text-2xl md:text-3xl font-bold text-gray-800 font-serif">
                {timeLeft.minutes}
              </div>
              <div className="text-xs md:text-sm text-gray-600 font-serif mt-1">
                Menit
              </div>
            </div>
          </div>

          {/* Seconds */}
          <div className="text-center">
            <div className="bg-gray-100 rounded-lg p-4 border-2 border-gray-200">
              <div className="text-2xl md:text-3xl font-bold text-gray-800 font-serif">
                {timeLeft.seconds}
              </div>
              <div className="text-xs md:text-sm text-gray-600 font-serif mt-1">
                Detik
              </div>
            </div>
          </div>
        </div>
      )}

      {/* Message */}
      <div className="text-center">
        <div className="bg-gray-50 rounded-lg p-6">
          <p className="text-sm text-gray-600 font-serif italic">
            "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan
            untukmu isteri-isteri dari jenismu sendiri, supaya kamu cenderung
            dan merasa tenteram kepadanya, dan dijadikan-Nya diantaramu rasa
            kasih dan sayang."
          </p>
          <p className="text-xs text-gray-500 font-serif mt-2">
            - QS. Ar-Rum: 21
          </p>
        </div>
      </div>

      {/* Decorative Elements */}
      <div className="absolute top-16 left-4 w-6 h-6 border-2 border-gray-300 rounded-full"></div>
      <div className="absolute top-16 right-4 w-6 h-6 border-2 border-gray-300 rounded-full"></div>
      <div className="absolute bottom-20 left-4 w-4 h-4 border border-gray-300 rounded-full"></div>
      <div className="absolute bottom-20 right-4 w-4 h-4 border border-gray-300 rounded-full"></div>
    </NewspaperPage>
  );
};

export default CountdownPage;

