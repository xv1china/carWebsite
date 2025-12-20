import { ArrowRight, Phone } from 'lucide-react';

interface CallToActionProps {
  onViewEquipment: () => void;
}

export default function CallToAction({ onViewEquipment }: CallToActionProps) {
  return (
    <section className="py-20 bg-gradient-to-r from-[#0F172A] via-[#1E293B] to-[#0F172A]">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 className="text-4xl md:text-5xl font-bold text-white mb-6">
          მზად ხარ იდეალური ტრაილერის შეძენისთვის?
        </h2>
        <p className="text-xl text-blue-100 mb-10 max-w-2xl mx-auto">
          დაათვალიერე ჩვენი ფართო ასორტიმენტი და შეიძინე შენთვის შესაფერისი ტექნიკა
        </p>

        <div className="flex flex-col sm:flex-row gap-4 justify-center items-center">
          <button
            onClick={onViewEquipment}
            className="group bg-[#F97316] hover:bg-[#EA580C] text-white px-8 py-4 rounded-lg text-lg font-semibold transition-all shadow-lg flex items-center space-x-2"
          >
            <span>გასაყიდი ტექნიკის ნახვა</span>
            <ArrowRight className="h-5 w-5 group-hover:translate-x-1 transition-transform" />
          </button>
          <button className="bg-[#1E40AF] hover:bg-[#2563EB] text-white px-8 py-4 rounded-lg text-lg font-semibold transition-all shadow-lg flex items-center space-x-2">
            <Phone className="h-5 w-5" />
            <span>დარეკვა: (555) 123-4567</span>
          </button>
        </div>
      </div>
    </section>
  );
}
