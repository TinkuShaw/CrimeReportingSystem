import { Routes, Route } from "react-router-dom";
import Index from "./components/Index";
import Login from "./components/Login";
import ComplaintForm from "./components/Complaint";
import CitizenDashboard from "./pages/CitizenDashboard";
import TrackComplaint from "./pages/TrackComplaint";
import TrackStatusSearch from "./pages/TrackStatusSearch";

const PoliceDashboard = () => (
  <h1 style={{ padding: "20px" }}>Police Dashboard</h1>
);

const AdminDashboard = () => (
  <h1 style={{ padding: "20px" }}>Admin Dashboard</h1>
);

function App() {
  return (
    <div className="App">
      <Routes>
        <Route path="/" element={<Index />} />
        <Route path="/login" element={<Login />} />
        <Route path="/complaint-form" element={<ComplaintForm />} />
        <Route path="/track-status" element={<TrackStatusSearch />} />
        <Route path="/track/:id" element={<TrackComplaint />} />
        <Route path="/citizen-dashboard" element={<CitizenDashboard />} />
        <Route path="/police-dashboard" element={<PoliceDashboard />} />
        <Route path="/admin-dashboard" element={<AdminDashboard />} />
      </Routes>
    </div>
  );
}

export default App;
