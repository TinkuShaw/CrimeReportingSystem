import "./complaint.css";
import { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import { Shield, User, MapPin, AlertCircle, FileUp, RotateCcw, Send } from "lucide-react";

function ComplaintForm() {
  const navigate = useNavigate();
  const token = localStorage.getItem("token");

  const initialFormState = {
    name: "", phone: "", address: "", city: "", state: "", zip: "",
    accused_names: "", incident_date: "", incident_time: "",
    incident_location: "", police_unit_id: "", police_station_id: "",
    complaint_type_id: "", description: ""
  };

  const [formData, setFormData] = useState(initialFormState);
  const [dropdowns, setDropdowns] = useState({ unitTypes: [], units: [], stations: [], types: [] });
  const [evidence, setEvidence] = useState(null);

  useEffect(() => {
    if (!token) {
      alert("Please login before submitting a complaint.");
      navigate("/login");
      return;
    }

    const loadInitialData = async () => {
      try {
        const [uTypes, cTypes] = await Promise.all([
          fetch("http://127.0.0.1:8000/api/police-unit-types").then(res => res.json()),
          fetch("http://127.0.0.1:8000/api/complaint-types").then(res => res.json())
        ]);
        setDropdowns(prev => ({ ...prev, unitTypes: uTypes, types: cTypes }));
      } catch (err) {
        console.error("Failed to load dropdown data");
      }
    };
    loadInitialData();
  }, [token, navigate]);

  const handleUnitTypeChange = async (e) => {
    const type = e.target.value;
    const res = await fetch(`http://127.0.0.1:8000/api/police-units/${type}`);
    const data = await res.json();
    setDropdowns(prev => ({ ...prev, units: data, stations: [] }));
  };

  const handleUnitChange = async (e) => {
    const unitId = e.target.value;
    setFormData({ ...formData, police_unit_id: unitId });
    const res = await fetch(`http://127.0.0.1:8000/api/police-stations/${unitId}`);
    const data = await res.json();
    setDropdowns(prev => ({ ...prev, stations: data }));
  };

  const handleReset = () => {
    if (window.confirm("Are you sure you want to clear all data?")) {
      setFormData(initialFormState);
      setEvidence(null);
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    const data = new FormData();
    Object.keys(formData).forEach(key => data.append(key, formData[key]));
    if (evidence) data.append("evidence", evidence);

    try {
      const response = await fetch("http://127.0.0.1:8000/api/complaint", {
        method: "POST",
        headers: { Accept: "application/json", Authorization: `Bearer ${token}` },
        body: data
      });

      if (response.ok) {
        alert("Complaint submitted successfully!");
        navigate("/citizen-dashboard");
      } else {
        const errorData = await response.json();
        alert("Error: " + (errorData.message || "Validation failed"));
      }
    } catch (err) {
      alert("Server connection failed.");
    }
  };

  return (
    <div className="form-page-wrapper">
      <div className="complaint-container">
        <header className="form-header">
          <div className="form-icon">
            <Shield size={32} color="white" fill="white" />
          </div>
          <h2>Official Complaint Filing</h2>
          <p>Provide accurate details to ensure timely investigation.</p>
        </header>

        <form onSubmit={handleSubmit} className="styled-form">
          {/* Section 1: Personal Info */}
          <div className="form-section">
            <div className="section-title">
              <User size={18} /> Complainant Information
            </div>
            <div className="input-grid">
              <input value={formData.name} placeholder="Full Name *" required onChange={(e) => setFormData({ ...formData, name: e.target.value })} />
              <input value={formData.phone} placeholder="Phone Number *" required onChange={(e) => setFormData({ ...formData, phone: e.target.value })} />
              <textarea className="full-width" value={formData.address} placeholder="Home Address *" required onChange={(e) => setFormData({ ...formData, address: e.target.value })} />
              <input value={formData.city} placeholder="City *" required onChange={(e) => setFormData({ ...formData, city: e.target.value })} />
              <input value={formData.state} placeholder="State *" required onChange={(e) => setFormData({ ...formData, state: e.target.value })} />
              <input value={formData.zip} placeholder="ZIP Code *" required onChange={(e) => setFormData({ ...formData, zip: e.target.value })} />
            </div>
          </div>

          {/* Section 2: Incident Details */}
          <div className="form-section">
            <div className="section-title">
              <AlertCircle size={18} /> Incident Details
            </div>
            <div className="input-grid">
              <input type="date" required value={formData.incident_date} onChange={(e) => setFormData({ ...formData, incident_date: e.target.value })} />
              <input type="time" required value={formData.incident_time} onChange={(e) => setFormData({ ...formData, incident_time: e.target.value })} />
              <input className="full-width" placeholder="Specific Incident Location *" required value={formData.incident_location} onChange={(e) => setFormData({ ...formData, incident_location: e.target.value })} />
              <input className="full-width" placeholder="Accused Names (If known)" value={formData.accused_names} onChange={(e) => setFormData({ ...formData, accused_names: e.target.value })} />
            </div>
          </div>

          {/* Section 3: Jurisdiction */}
          <div className="form-section">
            <div className="section-title">
              <MapPin size={18} /> Police Station Selection
            </div>
            <div className="input-grid">
              <select required onChange={handleUnitTypeChange}>
                <option value="">Select Unit Type</option>
                {dropdowns.unitTypes.map((t) => <option key={t} value={t}>{t}</option>)}
              </select>
              <select required onChange={handleUnitChange}>
                <option value="">Select Police Unit</option>
                {dropdowns.units.map((u) => <option key={u.id} value={u.id}>{u.name}</option>)}
              </select>
              <select required onChange={(e) => setFormData({ ...formData, police_station_id: e.target.value })}>
                <option value="">Select Police Station</option>
                {dropdowns.stations.map((s) => <option key={s.id} value={s.id}>{s.station_name}</option>)}
              </select>
              <select required onChange={(e) => setFormData({ ...formData, complaint_type_id: e.target.value })}>
                <option value="">Select Complaint Type</option>
                {dropdowns.types.map((t) => <option key={t.id} value={t.id}>{t.name}</option>)}
              </select>
            </div>
          </div>

          <div className="form-section">
            <div className="section-title">Description & Evidence</div>
            <textarea className="full-width desc-area" placeholder="Describe the incident in detail..." required value={formData.description} onChange={(e) => setFormData({ ...formData, description: e.target.value })} />
            
            <div className="file-input-wrapper">
              <label className="custom-file-upload">
                <FileUp size={20} />
                {evidence ? evidence.name : "Upload Evidence (Photo/Video/PDF)"}
                <input type="file" onChange={(e) => setEvidence(e.target.files[0])} />
              </label>
            </div>
          </div>

          <div className="form-actions">
            <button type="button" className="btn-secondary" onClick={handleReset}>
              <RotateCcw size={18} /> Reset Form
            </button>
            <button type="submit" className="btn-primary">
              Submit Complaint <Send size={18} />
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}

export default ComplaintForm;