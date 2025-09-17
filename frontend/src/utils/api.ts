// API utility functions

const API_BASE_URL = "http://localhost:3001/api";

export const api = {
  // Get wedding data
  getWeddingData: async () => {
    const response = await fetch(`${API_BASE_URL}/wedding-data`);
    if (!response.ok) {
      throw new Error("Failed to fetch wedding data");
    }
    return response.json();
  },

  // Get guest-specific data
  getGuestData: async (guestId: string) => {
    const response = await fetch(`${API_BASE_URL}/guest/${guestId}`);
    if (!response.ok) {
      throw new Error("Failed to fetch guest data");
    }
    return response.json();
  },

  // Submit RSVP
  submitRSVP: async (rsvpData: any) => {
    const response = await fetch(`${API_BASE_URL}/rsvp`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(rsvpData),
    });

    if (!response.ok) {
      throw new Error("Failed to submit RSVP");
    }

    return response.json();
  },

  // Get RSVP responses (admin)
  getRSVPResponses: async () => {
    const response = await fetch(`${API_BASE_URL}/rsvp-responses`);
    if (!response.ok) {
      throw new Error("Failed to fetch RSVP responses");
    }
    return response.json();
  },

  // Update wedding data (admin)
  updateWeddingData: async (data: any) => {
    const response = await fetch(`${API_BASE_URL}/wedding-data`, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    });

    if (!response.ok) {
      throw new Error("Failed to update wedding data");
    }

    return response.json();
  },

  // Health check
  healthCheck: async () => {
    const response = await fetch(`${API_BASE_URL}/health`);
    if (!response.ok) {
      throw new Error("API is not healthy");
    }
    return response.json();
  },
};

