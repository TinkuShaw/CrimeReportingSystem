import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import {
  LayoutDashboard,
  FileText,
  Search,
  Bell,
  LogOut,
  Plus,
  CheckCircle,
  Clock,
  AlertCircle,
  Shield,
} from "lucide-react";
import "./CitizenDashboard.css";

function CitizenDashboard() {
  const navigate = useNavigate();
  const token = localStorage.getItem("token");
  const user = JSON.parse(localStorage.getItem("user") || "{}");

  const [complaints, setComplaints] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    if (!token) {
      navigate("/login");
      return;
    }

    const fetchComplaints = async () => {
      try {
        const response = await fetch(
          "http://127.0.0.1:8000/api/my-complaints",
          {
            headers: {
              Authorization: `Bearer ${token}`,
              Accept: "application/json",
            },
          }
        );

        if (response.status === 401) {
          localStorage.clear();
          navigate("/login");
          return;
        }

        const data = await response.json();
        setComplaints(Array.isArray(data) ? data : []);
      } catch (error) {
        console.error("Failed to load complaints:", error);
      } finally {
        setLoading(false);
      }
    };

    fetchComplaints();
  }, [token, navigate]);

  const handleLogout = () => {
    localStorage.clear();
    navigate("/login");
  };

  // 📊 Stats Calculation
  const stats = {
    total: complaints.length,
    pending: complaints.filter((c) => c.status?.toLowerCase() === "pending").length,
    progress: complaints.filter(
      (c) =>
        c.status?.toLowerCase().includes("investigation") ||
        c.status?.toLowerCase().includes("progress")
    ).length,
    resolved: complaints.filter((c) => c.status?.toLowerCase() === "resolved").length,
  };

  if (loading) {
    return <div className="loader">Loading Dashboard...</div>;
  }

  return (
    <div className="dashboard-wrapper">
      {/* Sidebar */}
      <aside className="sidebar">
        <div className="sidebar-logo">
          <Shield className="logo-icon" size={24} />
          <span>Crime Reporting</span>
        </div>

        <nav className="sidebar-nav">
          <div className="nav-item active" onClick={() => navigate("/citizen-dashboard")}>
            <LayoutDashboard size={20} /> Dashboard
          </div>

          <div className="nav-item" onClick={() => navigate("/complaint-form")}>
            <FileText size={20} /> File Complaint
          </div>

          {/* FIXED: Added onClick to Sidebar Track Status */}
          <div className="nav-item" onClick={() => navigate("/track-status")}>
            <Search size={20} /> Track Status
          </div>

          <div className="nav-item">
            <Bell size={20} /> Notifications
          </div>
        </nav>

        <div className="sidebar-footer">
          <div className="user-info">
            <div className="user-avatar">{user?.name?.charAt(0)?.toUpperCase()}</div>
            <div>
              <p className="user-name">{user?.name}</p>
              <p className="user-email">{user?.email}</p>
            </div>
          </div>

          <button className="logout-btn" onClick={handleLogout}>
            <LogOut size={18} /> Logout
          </button>
        </div>
      </aside>

      {/* Main Content */}
      <main className="dashboard-main">
        <header className="main-header">
          <h1>Citizen Portal</h1>
          <button className="new-btn" onClick={() => navigate("/complaint-form")}>
            <Plus size={18} /> New Complaint
          </button>
        </header>

        {/* Stats Section */}
        <section className="stats-grid">
          <div className="stat-card total">
            <div className="stat-info">
              <p>Total Filed</p>
              <h2>{stats.total}</h2>
            </div>
            <div className="stat-icon"><FileText /></div>
          </div>

          <div className="stat-card pending">
            <div className="stat-info">
              <p>Pending</p>
              <h2>{stats.pending}</h2>
            </div>
            <div className="stat-icon"><Clock /></div>
          </div>

          <div className="stat-card progress">
            <div className="stat-info">
              <p>Under Progress</p>
              <h2>{stats.progress}</h2>
            </div>
            <div className="stat-icon"><AlertCircle /></div>
          </div>

          <div className="stat-card resolved">
            <div className="stat-info">
              <p>Resolved</p>
              <h2>{stats.resolved}</h2>
            </div>
            <div className="stat-icon"><CheckCircle /></div>
          </div>
        </section>

        {/* Complaints Table */}
        <section className="table-container">
          <div className="table-header"><h3>Recent Complaints</h3></div>

          {complaints.length === 0 ? (
            <div className="empty-state">No complaints submitted yet.</div>
          ) : (
            <table className="custom-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Type</th>
                  <th>Police Station</th>
                  <th>Status</th>
                  <th>Filed Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                {complaints.map((c) => (
                  <tr key={c.id}>
                    <td className="id-cell">#{c.id}</td>
                    <td>{c.type}</td>
                    <td>{c.station}</td>
                    <td>
                      <span className={`status-pill ${c.status?.toLowerCase().replace(/\s+/g, "-")}`}>
                        {c.status}
                      </span>
                    </td>
                    <td>{new Date(c.created_at).toLocaleDateString()}</td>
                    <td>
                      {/* FIXED: Dynamic navigation to the specific complaint track page */}
                      <button 
                        className="track-btn" 
                        onClick={() => navigate(`/track/${c.id}`)}
                      >
                        Track
                      </button>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          )}
        </section>
      </main>
    </div>
  );
}

export default CitizenDashboard;