import React from 'react';

const CitizenDashboard = () => {
    const user = JSON.parse(localStorage.getItem('user'));

    return (
        <div style={{ padding: '20px' }}>
            <h2>Welcome, {user.name}!</h2>
            <p>You can now report a crime below.</p>
            <button style={{ padding: '10px 20px', cursor: 'pointer' }}>
                + File a New Report
            </button>
        </div>
    );
};

export default CitizenDashboard;