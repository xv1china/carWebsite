import { Filter, X } from 'lucide-react';
import { useState } from 'react';

interface FilterSectionProps {
  selectedCategory: string;
  selectedBrand: string;
  selectedYear: string;
  selectedPrice: string;
  onCategoryChange: (category: string) => void;
  onBrandChange: (brand: string) => void;
  onYearChange: (year: string) => void;
  onPriceChange: (price: string) => void;
  onClearFilters: () => void;
}

export default function FilterSection({
  selectedCategory,
  selectedBrand,
  selectedYear,
  selectedPrice,
  onCategoryChange,
  onBrandChange,
  onYearChange,
  onPriceChange,
  onClearFilters,
}: FilterSectionProps) {
  const [showMobileFilters, setShowMobileFilters] = useState(false);

  const categories = ['ყველა', 'პიკაპი', 'მძიმე ტექნიკა', 'კომერციული'];
  const brands = ['ყველა', 'Ford', 'Chevrolet', 'Ram', 'GMC', 'Toyota', 'Nissan', 'Freightliner', 'Kenworth', 'Peterbilt'];
  const years = ['ყველა', '2023', '2022', '2021'];
  const priceRanges = ['ყველა', '50,000$-მდე', '50,000$ - 75,000$', '75,000$ - 100,000$', '100,000$-ზე მეტი'];

  const hasActiveFilters =
    selectedCategory !== 'ყველა' ||
    selectedBrand !== 'ყველა' ||
    selectedYear !== 'ყველა' ||
    selectedPrice !== 'ყველა';

  const inputClass =
    "w-full px-4 py-3 border border-gray-500 rounded-xl bg-transparent text-white shadow-sm focus:ring-2 focus:ring-[#F97316] focus:border-transparent transition-all hover:bg-gray-700 appearance-none";

  const FilterContent = () => (
    <>
      {/** Category */}
      <div>
        <label className="block text-sm font-semibold text-white mb-2">ტიპი</label>
        <select
          value={selectedCategory}
          onChange={(e) => onCategoryChange(e.target.value)}
          className={inputClass}
        >
          {categories.map(cat => (
            <option key={cat} value={cat} className="text-gray-900">
              {cat}
            </option>
          ))}
        </select>
      </div>

      {/** Brand */}
      <div>
        <label className="block text-sm font-semibold text-white mb-2">ბრენდი</label>
        <select
          value={selectedBrand}
          onChange={(e) => onBrandChange(e.target.value)}
          className={inputClass}
        >
          {brands.map(brand => (
            <option key={brand} value={brand} className="text-gray-900">
              {brand}
            </option>
          ))}
        </select>
      </div>

      {/** Year */}
      <div>
        <label className="block text-sm font-semibold text-white mb-2">წელი</label>
        <select
          value={selectedYear}
          onChange={(e) => onYearChange(e.target.value)}
          className={inputClass}
        >
          {years.map(year => (
            <option key={year} value={year} className="text-gray-900">
              {year}
            </option>
          ))}
        </select>
      </div>

      {/** Price */}
      <div>
        <label className="block text-sm font-semibold text-white mb-2">ფასის დიაპაზონი</label>
        <select
          value={selectedPrice}
          onChange={(e) => onPriceChange(e.target.value)}
          className={inputClass}
        >
          {priceRanges.map(range => (
            <option key={range} value={range} className="text-gray-900">
              {range}
            </option>
          ))}
        </select>
      </div>

      {hasActiveFilters && (
        <div className="lg:col-span-1">
          <label className="block text-sm font-semibold text-white">
            ფილტრების გასუფთავება
          </label>
          <button
            onClick={onClearFilters}
            className="w-full px-4 py-3 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-colors font-medium flex items-center justify-center space-x-2 mt-2"
          >
            <X className="h-4 w-4" />
            <span>ფილტრების გასუფთავება</span>
          </button>
        </div>
      )}
    </>
  );

  return (
    <div className="bg-[#1E293B] rounded-lg shadow-md p-6 mb-8">
      <div className="flex items-center justify-between mb-6 lg:hidden">
        <h3 className="text-lg font-bold text-white flex items-center">
          <Filter className="h-5 w-5 mr-2" />
          ფილტრები
        </h3>
        <button
          onClick={() => setShowMobileFilters(!showMobileFilters)}
          className="text-[#F97316] font-medium"
        >
          {showMobileFilters ? 'დამალვა' : 'ჩვენება'}
        </button>
      </div>

      <div className={`grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 ${showMobileFilters ? 'block' : 'hidden lg:grid'}`}>
        <FilterContent />
      </div>

      <div className="hidden lg:block pt-4">
        <div className="flex items-center text-gray-300">
          <Filter className="h-5 w-5 mr-2" />
          <span className="font-medium">ტექნიკის ფილტრაცია</span>
        </div>
      </div>
    </div>
  );
}
