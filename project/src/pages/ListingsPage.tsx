import { useState, useMemo } from 'react';
import { trucks } from '../data/trucks';
import TruckCard from '../components/TruckCard';
import FilterSection from '../components/FilterSection';

export default function ListingsPage() {
  const [selectedCategory, setSelectedCategory] = useState('All');
  const [selectedBrand, setSelectedBrand] = useState('All');
  const [selectedYear, setSelectedYear] = useState('All');
  const [selectedPrice, setSelectedPrice] = useState('All');

  const filteredTrucks = useMemo(() => {
    return trucks.filter(truck => {
      if (selectedCategory !== 'All' && truck.category !== selectedCategory) return false;
      if (selectedBrand !== 'All' && truck.brand !== selectedBrand) return false;
      if (selectedYear !== 'All' && truck.year.toString() !== selectedYear) return false;

      if (selectedPrice !== 'All') {
        if (selectedPrice === 'Under $50k' && truck.price >= 50000) return false;
        if (selectedPrice === '$50k - $75k' && (truck.price < 50000 || truck.price >= 75000)) return false;
        if (selectedPrice === '$75k - $100k' && (truck.price < 75000 || truck.price >= 100000)) return false;
        if (selectedPrice === 'Over $100k' && truck.price < 100000) return false;
      }

      return true;
    });
  }, [selectedCategory, selectedBrand, selectedYear, selectedPrice]);

  const handleClearFilters = () => {
    setSelectedCategory('All');
    setSelectedBrand('All');
    setSelectedYear('All');
    setSelectedPrice('All');
  };

  return (
    <div className="min-h-screen bg-[#111827] py-12">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Page Header */}
        <div className="mb-8 text-center md:text-left">
          <h1 className="text-4xl md:text-5xl font-extrabold text-white mb-2">
            სატრანსპორტო აღჭურვილობა
          </h1>
          <p className="text-gray-300 text-lg md:text-xl">
            გაეცანით ჩვენი სრულ სიის ტვირთიან მანქანებსა და აღჭურვილობას
          </p>
        </div>

        {/* Filters */}
        <FilterSection
          selectedCategory={selectedCategory}
          selectedBrand={selectedBrand}
          selectedYear={selectedYear}
          selectedPrice={selectedPrice}
          onCategoryChange={setSelectedCategory}
          onBrandChange={setSelectedBrand}
          onYearChange={setSelectedYear}
          onPriceChange={setSelectedPrice}
          onClearFilters={handleClearFilters}
        />

        {/* Results Info */}
        <div className="mb-6 text-gray-300">
          ნაჩვენებია <span className="font-semibold text-white">{filteredTrucks.length}</span> 
          / <span className="font-semibold text-white">{trucks.length}</span> მანქანა
        </div>

        {/* No Results */}
        {filteredTrucks.length === 0 ? (
          <div className="text-center py-16">
            <div className="text-gray-500 mb-4">
              <svg
                className="mx-auto h-24 w-24"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth={1}
                  d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
            </div>
            <h3 className="text-xl font-semibold text-white mb-2">მანქანები ვერ მოიძებნა</h3>
            <p className="text-gray-300 mb-6">გთხოვთ შეცვალოთ ფილტრები უკეთესი შედეგისთვის</p>
            <button
              onClick={handleClearFilters}
              className="bg-[#F97316] hover:bg-[#EA580C] text-white px-6 py-3 rounded-lg font-semibold transition-all shadow-lg"
            >
              ყველა ფილტრის გასუფთავება
            </button>
          </div>
        ) : (
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {filteredTrucks.map(truck => (
              <TruckCard key={truck.id} truck={truck} />
            ))}
          </div>
        )}
      </div>
    </div>
  );
}
