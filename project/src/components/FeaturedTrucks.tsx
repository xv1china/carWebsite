import { trucks } from "../data/trucks";
import TruckCard from "./TruckCard";

export default function FeaturedTrucks() {
  const featuredTrucks = trucks.filter((truck) => truck.featured);

  return (
    <section className="py-20 bg-[#020617]">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-16">
          <h2 className="text-4xl md:text-5xl font-extrabold text-white mb-4">
            გამორჩეული ტექნიკა
          </h2>
          <p className="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto leading-relaxed">
            გაეცანი ჩვენს სპეციალურად შერჩეულ პრემიუმ სატვირთოებსა და ტექნიკას, რომლებიც ამჟამად ხელმისაწვდომია
          </p>
        </div>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
          {featuredTrucks.map((truck) => (
            <TruckCard key={truck.id} truck={truck} />
          ))}
        </div>
      </div>
    </section>
  );
}
