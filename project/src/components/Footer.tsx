import { Truck, Mail, Phone, MapPin, Facebook, Twitter, Instagram, Linkedin } from 'lucide-react';

interface FooterProps {
  onNavigate: (page: 'home' | 'listings') => void;
}

export default function Footer({ onNavigate }: FooterProps) {
  return (
    <footer className="bg-gray-900 text-gray-300">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          
          {/* Brand */}
          <div>
            <div className="flex items-center space-x-2 mb-4">
              <Truck className="h-8 w-8 text-blue-500" strokeWidth={2.5} />
              <span className="text-2xl font-bold text-white">TruckHub</span>
            </div>
            <p className="text-gray-400 leading-relaxed">
              თქვენი სანდო პარტნიორი ხარისხიანი სატვირთოებისა და ტექნიკის შესაძენად.
              იპოვეთ იდეალური ტრანსპორტი თქვენი ბიზნესის საჭიროებებისთვის.
            </p>
          </div>

          {/* Quick Links */}
          <div>
            <h3 className="text-white font-semibold text-lg mb-4">სწრაფი ბმულები</h3>
            <ul className="space-y-2">
              <li>
                <button
                  onClick={() => onNavigate('home')}
                  className="hover:text-blue-400 transition-colors"
                >
                  მთავარი
                </button>
              </li>
              <li>
                <button
                  onClick={() => onNavigate('listings')}
                  className="hover:text-blue-400 transition-colors"
                >
                  ტექნიკა
                </button>
              </li>
              <li>
                <a href="#about" className="hover:text-blue-400 transition-colors">
                  ჩვენს შესახებ
                </a>
              </li>
              <li>
                <a href="#testimonials" className="hover:text-blue-400 transition-colors">
                  მომხმარებელთა შეფასებები
                </a>
              </li>
            </ul>
          </div>

          {/* Contact Info */}
          <div>
            <h3 className="text-white font-semibold text-lg mb-4">საკონტაქტო ინფორმაცია</h3>
            <ul className="space-y-3">
              <li className="flex items-start space-x-3">
                <MapPin className="h-5 w-5 text-blue-500 mt-0.5 flex-shrink-0" />
                <span>ტრაკების ქუჩა 123, დეტროიტი, მიჩიგანი, 48201</span>
              </li>
              <li className="flex items-center space-x-3">
                <Phone className="h-5 w-5 text-blue-500 flex-shrink-0" />
                <span>(555) 123-4567</span>
              </li>
              <li className="flex items-center space-x-3">
                <Mail className="h-5 w-5 text-blue-500 flex-shrink-0" />
                <span>sales@truckhub.com</span>
              </li>
            </ul>
          </div>

          {/* Social */}
          <div>
            <h3 className="text-white font-semibold text-lg mb-4">გამოგვყევით</h3>
            <p className="text-gray-400 mb-4">
              იყავით დაკავშირებული უახლესი სიახლეებისა და შეთავაზებების გასაგებად
            </p>
            <div className="flex space-x-4">
              <a
                href="#"
                className="bg-gray-800 p-2 rounded-full hover:bg-blue-600 transition-colors"
              >
                <Facebook className="h-5 w-5" />
              </a>
              <a
                href="#"
                className="bg-gray-800 p-2 rounded-full hover:bg-blue-400 transition-colors"
              >
                <Twitter className="h-5 w-5" />
              </a>
              <a
                href="#"
                className="bg-gray-800 p-2 rounded-full hover:bg-pink-600 transition-colors"
              >
                <Instagram className="h-5 w-5" />
              </a>
              <a
                href="#"
                className="bg-gray-800 p-2 rounded-full hover:bg-blue-700 transition-colors"
              >
                <Linkedin className="h-5 w-5" />
              </a>
            </div>
          </div>
        </div>

        <div className="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
          <p>&copy; 2025 xv1cha. ყველა უფლება დაცულია.</p>
        </div>
      </div>
    </footer>
  );
}
