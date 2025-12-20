import { ArrowRight, CheckCircle2 } from "lucide-react";
import { Swiper, SwiperSlide } from "swiper/react";
import { Autoplay, EffectFade } from "swiper/modules";

import "swiper/css";
import "swiper/css/effect-fade";

interface HeroProps {
  onViewEquipment: () => void;
}

const slides = [
  "https://images.pexels.com/photos/2199293/pexels-photo-2199293.jpeg?auto=compress&cs=tinysrgb&w=1600",
  "https://images.pexels.com/photos/1117210/pexels-photo-1117210.jpeg?auto=compress&cs=tinysrgb&w=1600",
  "https://images.pexels.com/photos/193003/pexels-photo-193003.jpeg?auto=compress&cs=tinysrgb&w=1600",
];

export default function Hero({ onViewEquipment }: HeroProps) {
  return (
    <section className="relative min-h-[700px] lg:h-[85vh] overflow-hidden bg-[#020617]">
      
      {/* Background Slider with refined overlays */}
      <Swiper
        modules={[Autoplay, EffectFade]}
        effect="fade"
        loop
        autoplay={{ delay: 5000, disableOnInteraction: false }}
        className="absolute inset-0 z-0"
      >
        {slides.map((img, i) => (
          <SwiperSlide key={i}>
            <div
              className="h-full w-full bg-cover bg-center transition-transform duration-[5000ms] scale-110"
              style={{ backgroundImage: `url(${img})` }}
            >
              {/* Modern Multi-layer Overlay */}
              <div className="absolute inset-0 bg-slate-950/60" /> {/* Darken */}
              <div className="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/40 to-transparent" /> {/* Left-to-right focus */}
            </div>
          </SwiperSlide>
        ))}
      </Swiper>

      {/* Content Container */}
      <div className="relative z-10 h-full flex items-center pt-20 pb-12 lg:pt-0 lg:pb-0">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
          
          <div className="max-w-4xl">
            {/* Animated Accent line */}
            <div className="w-16 h-1.5 bg-orange-500 mb-8 rounded-full animate-pulse" />

            <h1 className="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-white leading-[1.1] tracking-tight">
              მძიმე სატვირთოები
              <span className="block text-blue-400 mt-2">
                რეალური სამუშაოსთვის
              </span>
            </h1>

            <p className="mt-8 text-lg sm:text-xl text-slate-300 max-w-2xl leading-relaxed">
              სანდო კომერციული სატვირთოები და პროფესიონალური სერვისი,
              რომელიც ენდობა ბიზნესებს მთელი ქვეყნის მასშტაბით.
            </p>

            {/* Responsive Button Group */}
            <div className="mt-12 flex flex-col sm:flex-row items-center gap-4 lg:gap-6">
              <button
                onClick={onViewEquipment}
                className="w-full sm:w-auto group bg-orange-500 hover:bg-orange-600 text-white px-10 py-5 rounded-xl text-lg font-bold shadow-2xl shadow-orange-950/20 flex items-center justify-center gap-3 transition-all active:scale-95"
              >
                ტექნიკის ნახვა
                <ArrowRight className="h-5 w-5 group-hover:translate-x-2 transition-transform" />
              </button>

              <button className="w-full sm:w-auto border border-white/20 text-white px-10 py-5 rounded-xl text-lg font-bold hover:bg-white/10 backdrop-blur-md transition-all">
                სერვისი & მხარდაჭერა
              </button>
            </div>

            {/* Mobile-Friendly Trust Indicators */}
            <div className="mt-16 grid grid-cols-1 sm:grid-cols-3 gap-y-4 gap-x-8 border-t border-white/10 pt-8">
              {[
                "სერტიფიცირებული სერვისი",
                "მზად ფლოტისთვის",
                "მიწოდება ქვეყნის მასშტაბით"
              ].map((text, idx) => (
                <div key={idx} className="flex items-center gap-2 text-slate-400 text-xs sm:text-sm font-medium uppercase tracking-widest">
                  <CheckCircle2 className="h-4 w-4 text-orange-500" />
                  {text}
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>

      {/* Decorative Bottom Gradient for Section Blending */}
      <div className="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-slate-950 to-transparent z-20" />
    </section>
  );
}