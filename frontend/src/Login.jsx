import { useState } from 'react';
import api from './api';

export default function Login({ onLogin }) {
    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            const res = await api.post('/login_check', { 
                username: username, 
                password: password 
            });
            localStorage.setItem('token', res.data.token);
            onLogin();
        } catch (err) {
            alert("Erreur de connexion : vérifie tes identifiants");
        }
    };

    return (
        <div style={{ textAlign: 'center', marginTop: '100px', color: 'white' }}>
            <h2>Connexion BookMe</h2>
            <form onSubmit={handleSubmit}>
                <input type="email" placeholder="Email (test@example.com)" 
                    onChange={e => setUsername(e.target.value)} /><br/><br/>
                <input type="password" placeholder="Mot de passe" 
                    onChange={e => setPassword(e.target.value)} /><br/><br/>
                <button type="submit">Se connecter</button>
            </form>
        </div>
    );
}
