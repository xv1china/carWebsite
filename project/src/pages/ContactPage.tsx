import { MapPin, Phone, Mail } from 'lucide-react';

export default function ContactPage() {
  return (
    <section className="min-h-screen bg-[#111827] py-20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {/* Section Header */}
        <div className="text-center mb-16">
          <h2 className="text-4xl md:text-5xl font-extrabold text-white mb-4">
            კონტაქტი
          </h2>
          <p className="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto leading-relaxed">
            შეგვიტანეთ კითხვები, შეკვეთები ან ნებისმიერი მოთხოვნა
          </p>
        </div>

        <div className="grid grid-cols-1 lg:grid-cols-2 gap-12">

          {/* Contact Info */}
          <div className="space-y-8">
            <div className="flex items-start gap-4 bg-[#1F2937] p-6 rounded-xl shadow-lg border border-transparent hover:border-[#1E40AF]/50 transition-all">
              <MapPin className="h-6 w-6 text-[#60A5FA]" />
              <div>
                <h4 className="text-white font-semibold mb-1">მისამართი</h4>
                <p className="text-gray-300">123 Truck Boulevard, Detroit, MI 48201</p>
              </div>
            </div>

            <div className="flex items-start gap-4 bg-[#1F2937] p-6 rounded-xl shadow-lg border border-transparent hover:border-[#1E40AF]/50 transition-all">
              <Phone className="h-6 w-6 text-[#60A5FA]" />
              <div>
                <h4 className="text-white font-semibold mb-1">ტელეფონი</h4>
                <p className="text-gray-300">(555) 123-4567</p>
              </div>
            </div>

            <div className="flex items-start gap-4 bg-[#1F2937] p-6 rounded-xl shadow-lg border border-transparent hover:border-[#1E40AF]/50 transition-all">
              <Mail className="h-6 w-6 text-[#60A5FA]" />
              <div>
                <h4 className="text-white font-semibold mb-1">ელ. ფოსტა</h4>
                <p className="text-gray-300">sales@truckhub.com</p>
              </div>
            </div>
          </div>

          {/* Contact Form */}
          <form className="bg-[#1F2937] p-8 rounded-xl shadow-lg border border-transparent hover:border-[#1E40AF]/50 transition-all space-y-6">
            <div>
              <label className="block text-sm font-semibold text-white mb-2">სახელი</label>
              <input
                type="text"
                placeholder="თქვენი სახელი"
                className="w-full px-4 py-3 rounded-xl bg-[#111827] border border-gray-500 text-white placeholder-gray-400 focus:ring-2 focus:ring-[#F97316] focus:border-transparent transition-all"
              />
            </div>

            <div>
              <label className="block text-sm font-semibold text-white mb-2">ელ. ფოსტა</label>
              <input
                type="email"
                placeholder="თქვენი ელ. ფოსტა"
                className="w-full px-4 py-3 rounded-xl bg-[#111827] border border-gray-500 text-white placeholder-gray-400 focus:ring-2 focus:ring-[#F97316] focus:border-transparent transition-all"
              />
            </div>

            <div>
              <label className="block text-sm font-semibold text-white mb-2">მომსახურების ტიპი</label>
              <select
                className="w-full px-4 py-3 rounded-xl bg-[#111827] border border-gray-500 text-white focus:ring-2 focus:ring-[#F97316] focus:border-transparent transition-all"
              >
                <option>შეკვეთა</option>
                <option>ტექნიკური მხარდაჭერა</option>
                <option>სხვა</option>
              </select>
            </div>

            <div>
              <label className="block text-sm font-semibold text-white mb-2">მესიჯი</label>
              <textarea
                placeholder="თქვენი შეტყობინება"
                rows={5}
                className="w-full px-4 py-3 rounded-xl bg-[#111827] border border-gray-500 text-white placeholder-gray-400 focus:ring-2 focus:ring-[#F97316] focus:border-transparent transition-all"
              />
            </div>

            <button className="w-full bg-[#F97316] hover:bg-[#EA580C] text-white py-4 rounded-xl font-semibold shadow-lg transition-all">
              გაგზავნა
            </button>
          </form>
        </div>
      </div>
    </section>
  );
}
