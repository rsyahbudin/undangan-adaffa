import React, { useState } from "react";
import NewspaperPage from "./NewspaperPage";
import { Send, CheckCircle, XCircle } from "lucide-react";
import { RSVPData } from "../types";

interface RSVPPageProps {
  onSubmit: (data: RSVPData) => void;
  isSubmitted?: boolean;
}

const RSVPPage: React.FC<RSVPPageProps> = ({
  onSubmit,
  isSubmitted = false,
}) => {
  const [formData, setFormData] = useState<RSVPData>({
    name: "",
    attendance: "yes",
    guestCount: 1,
    message: "",
  });

  const [errors, setErrors] = useState<Partial<RSVPData>>({});

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();

    // Validation
    const newErrors: Partial<RSVPData> = {};
    if (!formData.name.trim()) {
      newErrors.name = "Nama harus diisi";
    }
    if (formData.attendance === "yes" && formData.guestCount < 1) {
      newErrors.guestCount = "Jumlah tamu minimal 1";
    }

    if (Object.keys(newErrors).length > 0) {
      setErrors(newErrors);
      return;
    }

    setErrors({});
    onSubmit(formData);
  };

  const handleInputChange = (field: keyof RSVPData, value: any) => {
    setFormData((prev) => ({ ...prev, [field]: value }));
    // Clear error when user starts typing
    if (errors[field]) {
      setErrors((prev) => ({ ...prev, [field]: undefined }));
    }
  };

  if (isSubmitted) {
    return (
      <NewspaperPage pageNumber={7} className="relative">
        {/* Success Message */}
        <div className="text-center">
          <div className="mb-6">
            <CheckCircle size={64} className="text-green-500 mx-auto mb-4" />
            <h1 className="text-2xl md:text-3xl font-bold text-gray-800 font-serif mb-2">
              TERIMA KASIH!
            </h1>
            <div className="w-16 h-0.5 bg-gray-800 mx-auto"></div>
          </div>

          <div className="bg-gray-100 rounded-lg p-6">
            <p className="text-sm text-gray-600 font-serif mb-4">
              Konfirmasi kehadiran Anda telah berhasil dikirim.
            </p>
            <p className="text-sm text-gray-600 font-serif">
              Kami sangat menantikan kehadiran Anda di hari bahagia kami.
            </p>
          </div>

          <div className="mt-6">
            <div className="text-4xl mb-2">💕</div>
            <p className="text-sm text-gray-600 font-serif">
              "Barakallahu laka wa baraka alaika wa jama'a bainakuma fi khair"
            </p>
            <p className="text-xs text-gray-500 font-serif mt-2">
              Semoga Allah memberkahi kalian berdua
            </p>
          </div>
        </div>
      </NewspaperPage>
    );
  }

  return (
    <NewspaperPage pageNumber={7} className="relative">
      {/* Page Title */}
      <div className="text-center mb-6">
        <h1 className="text-2xl md:text-3xl font-bold text-gray-800 font-serif mb-2">
          KONFIRMASI KEHADIRAN
        </h1>
        <div className="w-16 h-0.5 bg-gray-800 mx-auto"></div>
      </div>

      {/* RSVP Form */}
      <form onSubmit={handleSubmit} className="space-y-4">
        {/* Name Field */}
        <div>
          <label className="block text-sm font-semibold text-gray-800 font-serif mb-2">
            Nama Lengkap *
          </label>
          <input
            type="text"
            value={formData.name}
            onChange={(e) => handleInputChange("name", e.target.value)}
            className={`w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 text-sm ${
              errors.name ? "border-red-500" : "border-gray-300"
            }`}
            placeholder="Masukkan nama lengkap Anda"
          />
          {errors.name && (
            <p className="text-red-500 text-xs mt-1">{errors.name}</p>
          )}
        </div>

        {/* Attendance Field */}
        <div>
          <label className="block text-sm font-semibold text-gray-800 font-serif mb-2">
            Apakah Anda akan hadir? *
          </label>
          <div className="space-y-2">
            <label className="flex items-center">
              <input
                type="radio"
                name="attendance"
                value="yes"
                checked={formData.attendance === "yes"}
                onChange={(e) =>
                  handleInputChange("attendance", e.target.value)
                }
                className="mr-2"
              />
              <span className="text-sm text-gray-700 font-serif">
                Ya, saya akan hadir
              </span>
            </label>
            <label className="flex items-center">
              <input
                type="radio"
                name="attendance"
                value="no"
                checked={formData.attendance === "no"}
                onChange={(e) =>
                  handleInputChange("attendance", e.target.value)
                }
                className="mr-2"
              />
              <span className="text-sm text-gray-700 font-serif">
                Maaf, saya tidak bisa hadir
              </span>
            </label>
          </div>
        </div>

        {/* Guest Count Field (only if attending) */}
        {formData.attendance === "yes" && (
          <div>
            <label className="block text-sm font-semibold text-gray-800 font-serif mb-2">
              Jumlah Tamu *
            </label>
            <select
              value={formData.guestCount}
              onChange={(e) =>
                handleInputChange("guestCount", parseInt(e.target.value))
              }
              className={`w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 text-sm ${
                errors.guestCount ? "border-red-500" : "border-gray-300"
              }`}
            >
              {[1, 2, 3, 4, 5].map((num) => (
                <option key={num} value={num}>
                  {num} {num === 1 ? "orang" : "orang"}
                </option>
              ))}
            </select>
            {errors.guestCount && (
              <p className="text-red-500 text-xs mt-1">{errors.guestCount}</p>
            )}
          </div>
        )}

        {/* Message Field */}
        <div>
          <label className="block text-sm font-semibold text-gray-800 font-serif mb-2">
            Pesan untuk Mempelai
          </label>
          <textarea
            value={formData.message}
            onChange={(e) => handleInputChange("message", e.target.value)}
            rows={3}
            className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 text-sm"
            placeholder="Tuliskan pesan atau doa untuk mempelai..."
          />
        </div>

        {/* Submit Button */}
        <div className="text-center pt-4">
          <button
            type="submit"
            className="inline-flex items-center gap-2 bg-gray-800 hover:bg-gray-700 text-white px-6 py-3 rounded-lg transition-colors font-serif"
          >
            <Send size={16} />
            Kirim Konfirmasi
          </button>
        </div>
      </form>

      {/* Additional Info */}
      <div className="mt-6 text-center">
        <div className="bg-gray-100 rounded-lg p-4">
          <p className="text-xs text-gray-600 font-serif">
            * Mohon konfirmasi kehadiran maksimal 3 hari sebelum acara
          </p>
          <p className="text-xs text-gray-600 font-serif mt-1">
            * Untuk pertanyaan lebih lanjut, hubungi panitia
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

export default RSVPPage;
