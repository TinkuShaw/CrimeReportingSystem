import React from "react";
import { useNavigate } from "react-router-dom";
import "./Index.css";

const Index = () => {
  const navigate = useNavigate();

  return (
    <div className="app-wrapper">
      {/* ================= NAVBAR ================= */}
      <nav className="navbar">
        <div className="nav-container">
          <div className="logo" onClick={() => navigate("/")}>
            Crime<span>Reporting</span>
          </div>
          <div className="nav-links">
            <button onClick={() => navigate("/")}>Home</button>
            <button onClick={() => navigate("/login")}>File Complaint</button>
            <button>Track Status</button>
            <button>About Us</button>
            <button>Feedback</button>
            <button className="login-btn" onClick={() => navigate("/login")}>Login</button>
          </div>
        </div>
      </nav>

      {/* ================= HERO SECTION  ================= */}
      <header className="hero-section">
        <div className="hero-overlay">
          <div className="hero-content">
            <h1 className="hero-title">
              Your Safety, <br />
              <span className="accent-text">Our Priority.</span>
            </h1>
            <p className="hero-subtitle">
              Securely report incidents, track investigations in real-time, 
              and contribute to a safer community.
            </p>
            <div className="hero-buttons">
              <button className="primary-btn" onClick={() => navigate("/login")}>
                Report a Crime
              </button>
              <button className="secondary-btn">How it works</button>
            </div>
          </div>
        </div>
      </header>
    </div>
  );
};

export default Index;