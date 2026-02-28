import React from "react";
import { useNavigate } from "react-router-dom";
import "./index.css";

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
            <button onClick={() => navigate("/complaint-form")}>File Complaint</button>
            <button onClick={() => navigate("/Login")} >Track Status</button>
             <button>About Us</button>
            <button>Blog</button>
            <button>Feedback</button>
            <button></button>
            <button className="login-btn" onClick={() => navigate("/login")}>Login</button>
          </div>
        </div>
      </nav>

      {/* ================= HERO SECTION ================= */}
      <header className="hero-section">
        <div className="hero-overlay">
          <div className="hero-content">
            <h1 className="hero-title">
              Your Safety, <br />
              <span className="accent-text">Our Priority.</span>
            </h1>
            <p className="hero-subtitle">
              Securely report incidents, track investigations in real-time, 
              and contribute to a safer community with our encrypted platform.
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

      {/* ================= FEATURES SECTION ================= */}
      <section className="features-section">
        <div className="section-container">
          <div className="feature-card">
            <div className="icon">🛡️</div>
            <h3>Secure Reporting</h3>
            <p>Your identity and data are protected with end-to-end encryption.</p>
          </div>
          <div className="feature-card">
            <div className="icon">⏱️</div>
            <h3>Real-time Updates</h3>
            <p>Receive instant notifications as your case moves through investigation.</p>
          </div>
          <div className="feature-card">
            <div className="icon">📊</div>
            <h3>Transparent Process</h3>
            <p>View clear milestones and official logs regarding your filed reports.</p>
          </div>
        </div>
      </section>
    </div>
  );
};

export default Index;