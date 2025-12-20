import { useState, useEffect } from 'react';
import Header from './components/Header';
import Footer from './components/Footer';
import HomePage from './pages/HomePage';
import ListingsPage from './pages/ListingsPage';
import ContactPage from './pages/ContactPage';


function App() {
  const [currentPage, setCurrentPage] = useState<'home' | 'listings' | 'contact'>('home');

  useEffect(() => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }, [currentPage]);

  return (
    <div className="min-h-screen bg-white">
      <Header currentPage={currentPage} onNavigate={setCurrentPage} />

      {currentPage === 'home' ? (
        <HomePage onNavigateToListings={() => setCurrentPage('listings')} />
      ) : currentPage === 'listings' ? (
        <ListingsPage />
      ) : (
        <ContactPage />
      )}



      <Footer onNavigate={setCurrentPage} />
    </div>
  );
}

export default App;
