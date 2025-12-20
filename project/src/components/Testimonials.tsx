import { Star, Quote } from "lucide-react";

export default function Testimonials() {
  const testimonials = [
    {
      name: "მიხაელ როდრიგეზი",
      role: "შენობის მენეჯერი",
      image: "https://images.pexels.com/photos/1222271/pexels-photo-1222271.jpeg?auto=compress&cs=tinysrgb&w=200",
      content:
        "გამორჩეული სერვისი და ხარისხიანი სატვირთოები! ვიყიდე მძიმე F-250 ჩვენი სამშენებლო ბიზნესისთვის და ის სცდება ყველა მოლოდინს. გუნდი პროფესიონალური იყო და დაეხმარა ზუსტად საჭირო მანქანის პოვნაში.",
      rating: 5,
    },
    {
      name: "სარა ჯონსონი",
      role: "ფლოტის მენეჯერი",
      image: "https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=200",
      content:
        "მივიღეთ სამი კომერციული სატვირთო TruckHub-დან და მთელი პროცესი შეუფერხებელი იყო. შესანიშნავი ფასი, გამჭვირვალე კომუნიკაცია და მანქანები იდეალურ მდგომარეობაში. ძალზე რეკომენდებულია!",
      rating: 5,
    },
    {
      name: "დევიდ ჩენი",
      role: "პატარა ბიზნესის მფლობელი",
      image: "https://images.pexels.com/photos/1681010/pexels-photo-1681010.jpeg?auto=compress&cs=tinysrgb&w=200",
      content:
        "შესანიშნავი გამოცდილება თავიდან ბოლომდე. ვიპოვე იდეალური პიკაპი ჩემი ლანდშაფტის ბიზნესისთვის კარგი ფასით. პერსონალი ცოდნიერი და მოთმინებით იყო ყველა ჩემს კითხვაზე.",
      rating: 5,
    },
  ];

  return (
    <section id="testimonials" className="py-20 bg-[#111827]">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section Header */}
        <div className="text-center mb-16">
          <h2 className="text-4xl md:text-5xl font-extrabold text-white mb-4">
            რას ამბობენ ჩვენი მომხმარებლები
          </h2>
          <p className="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto leading-relaxed">
            ნუ გჯერათ მხოლოდ ჩვენს სიტყვებს — მოისმინეთ ჩვენი კმაყოფილი მომხმარებლების აზრი
          </p>
        </div>

        {/* Testimonials Grid */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          {testimonials.map((testimonial, index) => (
            <div
              key={index}
              className="bg-[#1F2937] rounded-xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 relative border border-transparent hover:border-[#1E40AF]"
            >
              {/* Quote Icon */}
              <Quote className="absolute top-6 right-6 h-12 w-12 text-[#60A5FA]/30" />

              {/* User Info */}
              <div className="flex items-center mb-6">
                <img
                  src={testimonial.image}
                  alt={testimonial.name}
                  className="w-16 h-16 rounded-full object-cover mr-4 border-4 border-[#60A5FA]/20"
                />
                <div>
                  <h4 className="font-bold text-white">{testimonial.name}</h4>
                  <p className="text-gray-300 text-sm">{testimonial.role}</p>
                </div>
              </div>

              {/* Rating */}
              <div className="flex mb-4">
                {[...Array(testimonial.rating)].map((_, i) => (
                  <Star key={i} className="h-5 w-5 text-yellow-400 fill-current" />
                ))}
              </div>

              {/* Testimonial Text */}
              <p className="text-gray-300 leading-relaxed relative z-10">{testimonial.content}</p>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
