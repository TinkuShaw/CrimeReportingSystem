import { Routes, Route } from 'react-router-dom';
import Login from './components/Login';

// --- Dashboard Components ---
// These are placeholder components for different user roles. 
// You will later replace these with your actual Dashboard files.
const CitizenDashboard = () => <h1 style={{padding: '20px'}}>Citizen Dashboard</h1>;
const PoliceDashboard = () => <h1 style={{padding: '20px'}}>Police Dashboard</h1>;
const AdminDashboard = () => <h1 style={{padding: '20px'}}>Admin Dashboard</h1>;

function App() {
  return (
    <div className="App">
      {/* The Routes container defines all available paths in your application.
          It listens to the URL and renders the corresponding component.
      */}
      <Routes>
        
        {/* Root Route: 
            The '/' path is the entry point of your app. 
            It defaults to showing the Login page.
        */}
        <Route path="/" element={<Login />} /> 
        
        {/* Role-Based Redirection Targets:
            After a successful OTP verification, the user is redirected 
            to one of these paths based on their 'role' in the database.
        */}
        
        {/* Accessible by general users after login */}
        <Route path="/citizen-dashboard" element={<CitizenDashboard />} />
        
        {/* Accessible by authorized law enforcement officers */}
        <Route path="/police-dashboard" element={<PoliceDashboard />} />
        
        {/* Accessible by system administrators only */}
        <Route path="/admin-dashboard" element={<AdminDashboard />} />

      </Routes>
    </div>
  );
}

export default App;