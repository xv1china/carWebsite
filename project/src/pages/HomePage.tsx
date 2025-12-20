import Hero from '../components/Hero';
import FeaturedTrucks from '../components/FeaturedTrucks';
import Categories from '../components/Categories';
import Testimonials from '../components/Testimonials';
import CallToAction from '../components/CallToAction';

interface HomePageProps {
  onNavigateToListings: () => void;
}

export default function HomePage({ onNavigateToListings }: HomePageProps) {
  return (
    <div>
      <Hero onViewEquipment={onNavigateToListings} />
      <FeaturedTrucks />
      <Categories onViewEquipment={onNavigateToListings} />
      <Testimonials />
      <CallToAction onViewEquipment={onNavigateToListings} />
    </div>
  );
}
