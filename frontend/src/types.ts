// Type definitions for Wedding Invitation App

export interface WeddingData {
  couple: {
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
  };
  events: Event[];
  locations: Location[];
  gallery: string[];
  weddingDate: string;
  coverImage?: string;
}

export interface Event {
  name: string;
  date: string;
  time: string;
  location: string;
  address: string;
}

export interface Location {
  name: string;
  address: string;
  phone?: string;
  email?: string;
  mapUrl?: string;
  coordinates?: {
    lat: number;
    lng: number;
  };
}

export interface GuestData {
  name: string;
  type: "resepsi1" | "resepsi2" | "both";
}

export interface RSVPData {
  name: string;
  attendance: "yes" | "no";
  guestCount: number;
  message: string;
}

export interface RSVPResponse {
  id: number;
  name: string;
  attendance: "yes" | "no";
  guestCount: number;
  message: string;
  submittedAt: string;
}

export interface ApiResponse<T> {
  success: boolean;
  message: string;
  data?: T;
  error?: string;
}
