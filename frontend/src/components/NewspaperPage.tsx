import React from "react";

interface NewspaperPageProps {
  children: React.ReactNode;
  className?: string;
  pageNumber?: number;
}

const NewspaperPage: React.FC<NewspaperPageProps> = ({
  children,
  className = "",
  pageNumber,
}) => {
  return (
    <div
      className={`newspaper-page bg-white border border-gray-200 ${className}`}
    >
      {/* Page Header */}
      <div className="border-b-2 border-gray-800 pb-2 mb-4">
        <div className="flex justify-between items-center">
          <div className="text-xs text-gray-600 font-serif">
            WEDDING INVITATION
          </div>
          {pageNumber && (
            <div className="text-xs text-gray-600 font-serif">
              Page {pageNumber}
            </div>
          )}
        </div>
        <div className="text-xs text-gray-500 font-serif mt-1">
          {new Date().toLocaleDateString("id-ID", {
            weekday: "long",
            year: "numeric",
            month: "long",
            day: "numeric",
          })}
        </div>
      </div>

      {/* Page Content */}
      <div className="h-full overflow-hidden">{children}</div>

      {/* Page Footer */}
      <div className="absolute bottom-0 left-0 right-0 border-t border-gray-200 pt-2">
        <div className="text-xs text-gray-500 text-center font-serif">
          "Two souls, one heart, forever together"
        </div>
      </div>
    </div>
  );
};

export default NewspaperPage;

