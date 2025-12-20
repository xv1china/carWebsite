import { Calendar } from "lucide-react";
import { Truck } from "../data/trucks";

interface TruckCardProps {
  truck: Truck;
}

export default function TruckCard({ truck }: TruckCardProps) {
  return (
    <div className="bg-[#1F2937] rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 cursor-pointer border border-transparent hover:border-[#1E40AF]/30">
      
      {/* Image */}
      <div className="relative h-56 overflow-hidden">
        <img
          src={truck.image}
          alt={truck.name}
          className="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
        />
        <div className="absolute top-4 right-4 bg-[#1E40AF] text-white px-3 py-1 rounded-full text-sm font-semibold shadow">
          {truck.category}
        </div>
      </div>

      {/* Content */}
      <div className="p-6">
        <h3 className="text-xl font-bold text-white mb-1">{truck.name}</h3>
        <p className="text-gray-300 mb-4">{truck.model}</p>

        {/* Year & Price */}
        <div className="flex items-center justify-between mb-4">
          <div className="flex items-center space-x-2 text-gray-300">
            <Calendar className="h-4 w-4 text-[#60A5FA]" />
            <span className="text-sm font-medium">{truck.year}</span>
          </div>
          <div className="text-[#F97316] font-bold text-lg">
            {truck.price.toLocaleString()} ₾
          </div>
        </div>

        {/* Description */}
        <p className="text-gray-400 text-sm mb-4 line-clamp-2">{truck.description}</p>

        {/* CTA Button */}
        <button className="w-full bg-[#F97316] hover:bg-[#EA580C] text-white py-3 rounded-lg font-semibold shadow-md transition-all">
          დეტალების ნახვა
        </button>
      </div>
    </div>
  );
}
