// Application constants

export const APP_CONFIG = {
  name: "Wedding Invitation",
  version: "1.0.0",
  description: "Digital wedding invitation with newspaper theme",
};

export const GUEST_TYPES = {
  BOTH: "both",
  RESEPSI_1: "resepsi1",
  RESEPSI_2: "resepsi2",
} as const;

export const RSVP_ATTENDANCE = {
  YES: "yes",
  NO: "no",
} as const;

export const DEFAULT_WEDDING_DATA = {
  couple: {
    groom: {
      name: "Ahmad Rizki",
      father: "Bapak Budi Santoso",
      mother: "Ibu Siti Aminah",
    },
    bride: {
      name: "Siti Nurhaliza",
      father: "Bapak Agus Wijaya",
      mother: "Ibu Dewi Kartika",
    },
  },
  events: [
    {
      name: "Akad Nikah",
      date: "Sabtu, 15 Maret 2025",
      time: "08:00 WIB",
      location: "Masjid Al-Ikhlas",
      address: "Jl. Merdeka No. 123, Jakarta Pusat",
    },
    {
      name: "Resepsi 1",
      date: "Sabtu, 15 Maret 2025",
      time: "10:00 - 14:00 WIB",
      location: "Gedung Serbaguna",
      address: "Jl. Sudirman No. 456, Jakarta Selatan",
    },
    {
      name: "Resepsi 2",
      date: "Minggu, 16 Maret 2025",
      time: "10:00 - 14:00 WIB",
      location: "Hotel Grand Ballroom",
      address: "Jl. Thamrin No. 789, Jakarta Pusat",
    },
  ],
  locations: [
    {
      name: "Masjid Al-Ikhlas",
      address: "Jl. Merdeka No. 123, Jakarta Pusat 10110",
      phone: "+62 21 1234 5678",
      email: "info@masjid-alikhlas.com",
      mapUrl: "https://maps.google.com/?q=Masjid+Al-Ikhlas+Jakarta",
    },
    {
      name: "Gedung Serbaguna",
      address: "Jl. Sudirman No. 456, Jakarta Selatan 12190",
      phone: "+62 21 2345 6789",
      email: "info@gedungserbaguna.com",
      mapUrl: "https://maps.google.com/?q=Gedung+Serbaguna+Jakarta",
    },
    {
      name: "Hotel Grand Ballroom",
      address: "Jl. Thamrin No. 789, Jakarta Pusat 10350",
      phone: "+62 21 3456 7890",
      email: "info@grandhotel.com",
      mapUrl: "https://maps.google.com/?q=Hotel+Grand+Ballroom+Jakarta",
    },
  ],
  gallery: [],
  weddingDate: "2025-03-15 08:00:00",
};

export const MESSAGES = {
  loading: "Loading wedding invitation...",
  error: "Failed to load wedding invitation. Please try again later.",
  rsvpSuccess: "Konfirmasi kehadiran Anda telah berhasil dikirim.",
  rsvpError: "Failed to submit RSVP",
  tryAgain: "Try Again",
  weddingDay: "WEDDING DAY!",
  weddingDayMessage: "Hari yang dinanti telah tiba!",
} as const;

export const QURAN_VERSE = {
  text: "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-Nya diantaramu rasa kasih dan sayang.",
  reference: "QS. Ar-Rum: 21",
} as const;

export const BLESSING = {
  arabic: "Barakallahu laka wa baraka alaika wa jama'a bainakuma fi khair",
  translation: "Semoga Allah memberkahi kalian berdua",
} as const;

