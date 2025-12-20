import { TruckIcon, Package, Building2 } from "lucide-react";

interface CategoriesProps {
  onViewEquipment: () => void;
}

export default function Categories({ onViewEquipment }: CategoriesProps) {
  const categories = [
    {
      name: "პიკაპები",
      icon: TruckIcon,
      description: "მრავალფუნქციური პიკაპები სამუშაოსა და პირადი გამოყენებისთვის",
      count: "50+ ხელმისაწვდომი",
      color: "bg-[#1E40AF]",
      hoverColor: "group-hover:bg-[#60A5FA]",
    },
    {
      name: "მძიმე ტექნიკა",
      icon: Package,
      description: "ძლიერი სატვირთოები რთული სამუშაოებისთვის",
      count: "30+ ხელმისაწვდომი",
      color: "bg-[#F97316]",
      hoverColor: "group-hover:bg-[#EA580C]",
    },
    {
      name: "კომერციული",
      icon: Building2,
      description: "სედლიანი ტრაქტორები და კომერციული სატრანსპორტო საშუალებები",
      count: "20+ ხელმისაწვდომი",
      color: "bg-gray-600",
      hoverColor: "group-hover:bg-gray-500",
    },
  ];

  return (
    <section className="py-20 bg-[#111827]">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section Header */}
        <div className="text-center mb-16">
          <h2 className="text-4xl md:text-5xl font-extrabold text-white mb-4">
            კატეგორიების მიხედვით ძიება
          </h2>
          <p className="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto leading-relaxed">
            იპოვე შენს საჭიროებებზე მორგებული სატრანსპორტო საშუალება
          </p>
        </div>

        {/* Category Grid */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          {categories.map((category) => {
            const Icon = category.icon;
            return (
              <div
                key={category.name}
                onClick={onViewEquipment}
                className="group relative bg-[#1F2937] rounded-xl p-8 hover:shadow-2xl transition-all duration-300 cursor-pointer border border-transparent hover:border-[#1E40AF]"
              >
                {/* Icon */}
                <div
                  className={`${category.color} ${category.hoverColor} w-16 h-16 rounded-lg flex items-center justify-center mb-6 transition-colors shadow-lg`}
                >
                  <Icon className="h-8 w-8 text-white" />
                </div>

                {/* Text */}
                <h3 className="text-2xl font-bold text-white mb-2 group-hover:text-[#60A5FA] transition-colors">
                  {category.name}
                </h3>
                <p className="text-gray-300 mb-4">{category.description}</p>
                <p className="text-[#F97316] font-semibold">{category.count}</p>

                {/* Arrow */}
                <div className="absolute bottom-4 right-4 text-gray-400 group-hover:text-[#60A5FA] transition-colors">
                  <svg
                    className="w-6 h-6 group-hover:translate-x-1 transition-transform"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      strokeLinecap="round"
                      strokeLinejoin="round"
                      strokeWidth={2}
                      d="M9 5l7 7-7 7"
                    />
                  </svg>
                </div>
              </div>
            );
          })}
        </div>
      </div>
    </section>
  );
}
