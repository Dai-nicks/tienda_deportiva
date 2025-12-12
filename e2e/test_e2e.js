const axios = require('axios');

const API_URL = process.env.API_URL || 'http://localhost:8000/api';
const ADMIN_EMAIL = process.env.ADMIN_EMAIL || 'admin@local.dev';
const ADMIN_PW = process.env.ADMIN_PW || 'admin123';

(async () => {
  try {
    console.log('Trying to login to API to check availability:', API_URL);
  } catch (e) {
    console.error('Unexpected error while preparing E2E');
    process.exit(1);
  }

  try {
    const login = await axios.post(API_URL + '/login', { correo: ADMIN_EMAIL, contrasena: ADMIN_PW });
    const token = login.data?.token;
    if (!token) throw new Error('No token received');

    console.log('Login success, token length:', token.length);

    const users = await axios.get(API_URL + '/usuarios', { headers: { Authorization: `Bearer ${token}` } });
    console.log('Protected endpoint /usuarios returned:', users.status);

    console.log('E2E checks OK');
    process.exit(0);
  } catch (e) {
    console.error('E2E failed:', e.message || e);
    process.exit(2);
  }
})();
