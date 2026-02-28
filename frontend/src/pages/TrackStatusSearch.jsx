import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { Search, Eye, ShieldCheck, ArrowLeft } from 'lucide-react';
import "./TrackStatusSearch.css";

const TrackStatusSearch = () => {
    const [complaintId, setComplaintId] = useState('');
    const navigate = useNavigate();

    const handleSearch = (e) => {
        e.preventDefault();
        if (complaintId.trim()) {
            // This navigates to the detailed tracking page using the ID provided
            navigate(`/track/${complaintId.trim()}`);
        }
    };

    return (
        <div className="search-page-bg">
            <div className="search-portal-container">
                {/* Blue Gradient Banner Section */}
                <div className="search-banner">
                    <div className="icon-circle">
                        <Eye size={42} color="white" />
                    </div>
                    <h1>Track Complaint Status</h1>
                    <p>Enter your Complaint ID to check real-time status and updates</p>
                </div>

                {/* White Search Card Section */}
                <div className="search-card-wrapper">
                    <form className="search-card" onSubmit={handleSearch}>
                        <div className="input-group">
                            <label>
                                <ShieldCheck size={18} className="blue-icon" /> 
                                Enter Complaint ID
                            </label>
                            <input 
                                type="text" 
                                placeholder="e.g., JS-2026-12345" 
                                value={complaintId}
                                onChange={(e) => setComplaintId(e.target.value)}
                                required
                            />
                        </div>
                        <button type="submit" className="search-submit-btn">
                            <Search size={20} /> Check Status
                        </button>
                    </form>
                    
                    <button className="back-to-dash" onClick={() => navigate("/citizen-dashboard")}>
                        <ArrowLeft size={16} /> Return to Portal
                    </button>
                </div>
            </div>
        </div>
    );
};

export default TrackStatusSearch;