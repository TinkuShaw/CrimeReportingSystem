import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

const Login = () => {
    // --- State Management ---
    const [step, setStep] = useState(1); // Manages Step 1 (Info) vs Step 2 (OTP)
    const [loading, setLoading] = useState(false); // Controls button loading states
    const [timer, setTimer] = useState(0); // Resend OTP countdown timer
    const [successMsg, setSuccessMsg] = useState(""); // Inline success feedback
    const navigate = useNavigate(); // Handles redirection
    
    const [formData, setFormData] = useState({
        name: '',
        email: '',
        mobile: '',
        otp: ''
    });

    // --- Resend Timer Logic ---
    // Decrements the timer every second if active
    useEffect(() => {
        let interval;
        if (timer > 0) {
            interval = setInterval(() => setTimer(prev => prev - 1), 1000);
        }
        return () => clearInterval(interval);
    }, [timer]);

    // --- Input Handling ---
    // Updates state based on input field changes
    const handleChange = (e) => {
        setFormData({ ...formData, [e.target.name]: e.target.value });
    };

    // --- Step 1: Send OTP ---
    // Calls Backend API to generate and send OTP via email
    const handleSendOtp = async (isResend = false) => {
        if (!formData.email) return alert("Please enter your email address");
        
        setLoading(true);
        setSuccessMsg(""); 
        
        try {
            await axios.post('http://127.0.0.1:8000/api/send-otp', { email: formData.email });
            setTimer(60); // Enable 60s cooldown for resend
            setSuccessMsg("OTP sent to your email!"); 
            
            // Auto-transition to Step 2 after a small delay
            if (!isResend) {
                setTimeout(() => setStep(2), 1500);
            }
        } catch (error) {
            alert("Failed to send OTP. Please check your network.");
        } finally {
            setLoading(false);
        }
    };

    // --- Step 2: Verify OTP ---
    // Validates OTP and authenticates the user
    const handleVerifyOtp = async () => {
        if (formData.otp.length < 4) return alert("Please enter the full code");
        
        setLoading(true);
        try {
            const res = await axios.post('http://127.0.0.1:8000/api/verify-otp', formData);
            const { token, user } = res.data;
            
            // Persistent storage of auth data
            localStorage.setItem('token', token);
            localStorage.setItem('user', JSON.stringify(user));

            // Role-based Access Control (RBAC) redirection
            if (user.role === 'admin') navigate('/admin-dashboard');
            else if (user.role === 'police') navigate('/police-dashboard');
            else navigate('/citizen-dashboard');
            
        } catch (error) {
            alert("Verification failed. Invalid or expired OTP.");
        } finally {
            setLoading(false);
        }
    };

    return (
        <div style={pageWrapper}>
            <div style={cardContainer}>
                {/* Branding Section */}
                <div style={headerStyle}>
                    <h2 style={brandTitle}>Crime Reporting System</h2>
                    <p style={brandSubtitle}>Secure Access & Verification</p>
                </div>

                <div style={formWrapper}>
                    {step === 1 ? (
                        /* --- Step 1 Layout: User Registration/Details --- */
                        <div style={animationFade}>
                            <div style={inputGroup}>
                                <label style={labelStyle}>Full Name</label>
                                <input name="name" value={formData.name} placeholder="Enter your name" onChange={handleChange} style={inputStyle} />
                            </div>
                            <div style={inputGroup}>
                                <label style={labelStyle}>Email Address</label>
                                <input name="email" value={formData.email} type="email" placeholder="example@mail.com" onChange={handleChange} style={inputStyle} />
                            </div>
                            <div style={inputGroup}>
                                <label style={labelStyle}>Mobile Number</label>
                                <input name="mobile" value={formData.mobile} placeholder="e.g. 017XXXXXXXX" onChange={handleChange} style={inputStyle} />
                            </div>

                            <div style={actionRow}>
                                <button onClick={() => handleSendOtp(false)} disabled={loading} style={primaryBtn}>
                                    {loading ? "Sending..." : "Send OTP"}
                                </button>
                                {successMsg && <span style={msgBadge}>{successMsg}</span>}
                            </div>
                        </div>
                    ) : (
                        /* --- Step 2 Layout: Verification Code Entry --- */
                        <div style={animationFade}>
                            <div style={notifyBox}>
                                <span>Code sent to <strong>{formData.email}</strong></span>
                                <button onClick={() => setStep(1)} style={linkBtn}>Change</button>
                            </div>
                            
                            <div style={inputGroup}>
                                <label style={labelStyle}>Verification Code</label>
                                <input 
                                    name="otp" 
                                    value={formData.otp} 
                                    placeholder="Enter 6-digit OTP" 
                                    onChange={handleChange} 
                                    style={{ ...inputStyle, textAlign: 'center', letterSpacing: '4px', fontWeight: 'bold' }} 
                                    maxLength="6"
                                />
                            </div>

                            <button onClick={handleVerifyOtp} disabled={loading} style={successBtn}>
                                {loading ? "Verifying..." : "Verify & Login"}
                            </button>

                            {/* Resend Logic Section */}
                            <div style={footerRow}>
                                {timer > 0 ? (
                                    <span style={timerStyle}>Request new code in {timer}s</span>
                                ) : (
                                    <div style={actionRow}>
                                        <button onClick={() => handleSendOtp(true)} style={linkBtn}>Resend OTP</button>
                                        {successMsg && <span style={msgBadge}>{successMsg}</span>}
                                    </div>
                                )}
                            </div>
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
};

// CSS-in-JS) ---
const pageWrapper = {
    display: 'flex', justifyContent: 'center', alignItems: 'center',
    height: '100vh', width: '100vw', backgroundColor: '#f0f4f8',
    position: 'fixed', top: 0, left: 0
};

const cardContainer = {
    width: '90%', maxWidth: '420px', backgroundColor: '#fff',
    padding: '45px', borderRadius: '24px', boxShadow: '0 20px 40px rgba(0,0,0,0.08)',
    textAlign: 'left'
};

const headerStyle = { textAlign: 'center', marginBottom: '35px' };
const brandTitle = { color: '#1a365d', margin: '0 0 8px 0', fontSize: '26px', fontWeight: '800' };
const brandSubtitle = { color: '#718096', fontSize: '14px', margin: 0 };

const formWrapper = { display: 'flex', flexDirection: 'column', gap: '10px' };

const inputGroup = { marginBottom: '20px' };
const labelStyle = { display: 'block', fontSize: '13px', color: '#4a5568', fontWeight: '600', marginBottom: '8px' };
const inputStyle = {
    width: '100%', padding: '14px 16px', border: '1.5px solid #e2e8f0',
    borderRadius: '12px', fontSize: '15px', outline: 'none', transition: '0.3s',
    boxSizing: 'border-box', backgroundColor: '#f8fafc'
};

const actionRow = { display: 'flex', alignItems: 'center', gap: '15px', marginTop: '10px' };
const primaryBtn = {
    backgroundColor: '#3182ce', color: '#fff', padding: '13px 28px',
    border: 'none', borderRadius: '12px', cursor: 'pointer', fontWeight: '700', fontSize: '15px'
};
const successBtn = { ...primaryBtn, width: '100%', backgroundColor: '#38a169', marginTop: '10px' };
const msgBadge = { color: '#2f855a', fontSize: '13px', fontWeight: '600' };

const notifyBox = {
    display: 'flex', justifyContent: 'space-between', alignItems: 'center',
    padding: '12px 16px', backgroundColor: '#ebf8ff', borderRadius: '12px',
    fontSize: '13px', marginBottom: '25px', color: '#2b6cb0', border: '1px solid #bee3f8'
};

const linkBtn = { background: 'none', border: 'none', color: '#3182ce', cursor: 'pointer', fontWeight: '700', fontSize: '14px' };
const footerRow = { textAlign: 'center', marginTop: '20px' };
const timerStyle = { color: '#a0aec0', fontSize: '13px' };
const animationFade = { animation: 'fadeIn 0.5s ease-in-out' };

export default Login;