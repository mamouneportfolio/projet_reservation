import { useState, useEffect } from 'react';
import api from './api';
import Login from './Login';

function App() {
    const [isLoggedIn, setIsLoggedIn] = useState(!!localStorage.getItem('token'));
    const [services, setServices] = useState([]);
    const [appointments, setAppointments] = useState([]);

    useEffect(() => { if (isLoggedIn) fetchData(); }, [isLoggedIn]);

    const fetchData = async () => {
        try {
            const resS = await api.get('/services');
            setServices(resS.data);
            const resA = await api.get('/appointments');
            setAppointments(resA.data);
        } catch (e) { console.error("Erreur chargement"); }
    };

    const handleBook = async (serviceId) => {
        if (!serviceId) return alert("ID manquant");
        try {
            await api.post('/appointments', { service_id: serviceId });
            alert("Réservé !");
            fetchData();
        } catch (e) { alert("Erreur réservation"); }
    };

    if (!isLoggedIn) return <Login onLogin={() => setIsLoggedIn(true)} />;

    return (
        <div style={{ padding: '20px', fontFamily: 'sans-serif' }}>
            <h1>Mon Espace BookMe</h1>
            <button onClick={() => {localStorage.clear(); setIsLoggedIn(false)}}>Déconnexion</button>
            
            <h2>1. Services disponibles</h2>
            <div style={{ display: 'flex', gap: '15px', flexWrap: 'wrap' }}>
                {services.map(s => (
                    <div key={s.id} style={{ border: '1px solid #ccc', padding: '15px', borderRadius: '8px', minWidth: '150px' }}>
                        <h3 style={{ margin: '0' }}>{s.name}</h3>
                        <p style={{ color: 'green', fontWeight: 'bold' }}>{s.price} €</p>
                        <button onClick={() => handleBook(s.id)} style={{ backgroundColor: '#007bff', color: 'white', border: 'none', padding: '8px', borderRadius: '4px', cursor: 'pointer' }}>Réserver</button>
                    </div>
                ))}
            </div>

            <h2>2. Mes RDV</h2>
            <ul>
                {appointments.map(a => <li key={a.id}>{a.service_name} le {a.date}</li>)}
            </ul>
        </div>
    );
}
export default App;
