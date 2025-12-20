import { Truck, Menu, X } from "lucide-react";
import { useState } from "react";

interface HeaderProps {
  currentPage: "home" | "listings" | "contact";
  onNavigate: (page: "home" | "listings" | "contact") => void;
}


export default function Header({ currentPage, onNavigate }: HeaderProps) {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

  return (
    <header className="sticky top-0 z-50 bg-[#020617]/90 backdrop-blur border-b border-white/10">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between items-center h-20">

          {/* Logo */}
          <div
            onClick={() => onNavigate("home")}
            className="flex items-center gap-3 cursor-pointer group"
          >
            <div className="p-2 rounded-lg bg-[#1E40AF]/10 group-hover:bg-[#1E40AF]/20 transition">
              <Truck className="h-7 w-7 text-[#1E40AF]" strokeWidth={2.5} />
            </div>
            <span className="text-2xl font-extrabold text-white tracking-wide">
              Truck<span className="text-[#60A5FA]">Hub</span>
            </span>
          </div>

          {/* Desktop Nav */}
          <nav className="hidden md:flex items-center gap-10">
            {[
              { label: "მთავარი", page: "home" },
              { label: "ტექნიკა", page: "listings" },
            ].map((item) => (
              <button
                key={item.page}
                onClick={() => onNavigate(item.page as any)}
                className={`relative text-lg font-medium transition ${currentPage === item.page
                  ? "text-white"
                  : "text-gray-300 hover:text-white"
                  }`}
              >
                {item.label}
                {currentPage === item.page && (
                  <span className="absolute -bottom-2 left-0 w-full h-[3px] bg-[#F97316] rounded-full" />
                )}
              </button>
            ))}

            <button
              onClick={() => onNavigate('contact')}
              className="text-lg font-medium text-gray-300 hover:text-white transition"
            >
              კონტაქტი
            </button>


            <button className="bg-[#F97316] hover:bg-[#EA580C] text-white px-6 py-2.5 rounded-lg font-semibold shadow-lg transition">
              ფასის მოთხოვნა
            </button>
          </nav>

          {/* Mobile Toggle */}
          <button
            onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
            className="md:hidden text-white"
          >
            {mobileMenuOpen ? <X className="h-6 w-6" /> : <Menu className="h-6 w-6" />}
          </button>
        </div>
      </div>

      {/* Mobile Menu */}
      {mobileMenuOpen && (
        <div className="md:hidden bg-[#020617] border-t border-white/10">
          <div className="px-4 py-6 space-y-4">
            {[
              { label: "მთავარი", page: "home" },
              { label: "ტექნიკა", page: "listings" },
            ].map((item) => (
              <button
                key={item.page}
                onClick={() => {
                  onNavigate(item.page as any);
                  setMobileMenuOpen(false);
                }}
                className={`block w-full text-left px-4 py-3 rounded-lg font-medium transition ${currentPage === item.page
                  ? "bg-[#1E40AF]/20 text-white"
                  : "text-gray-300 hover:bg-white/5"
                  }`}
              >
                {item.label}
              </button>
            ))}

            <button
              onClick={() => {
                onNavigate('contact');
                setMobileMenuOpen(false);
              }}
              className="block w-full text-left px-4 py-3 rounded-lg font-medium text-gray-300 hover:bg-white/5 transition"
            >
              კონტაქტი
            </button>


            <button className="w-full bg-[#F97316] hover:bg-[#EA580C] text-white px-6 py-3 rounded-lg font-semibold shadow-md transition">
              ფასის მოთხოვნა
            </button>
          </div>
        </div>
      )}
    </header>
  );
}
