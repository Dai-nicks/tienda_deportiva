// Ejemplos de interacción con la API de tiendaRopa
// Usar Node/Vite/Browser. Guardar token en localStorage (o en memoria según tu app).

// Obtener la URL de la API desde .env (VITE_API_URL) o usar default
const API_BASE = import.meta.env?.VITE_API_URL || 'http://localhost:8000/api';

// --- Fetch (vanilla) ---
export async function loginFetch(correo, contrasena) {
  // Enviar la contraseña en la clave sin ñ para evitar problemas de encoding
  // También incluimos la variante con ñ por compatibilidad si el backend la requiere.
  const body = { correo, contrasena };

  const res = await fetch(`${API_BASE}/login`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(body)
  });
  const data = await res.json();
  if (!res.ok) throw new Error(data.message || 'Error en login');
  localStorage.setItem('token', data.token);
  return data;
}

export async function getProductosFetch() {
  const res = await fetch(`${API_BASE}/productos`, { headers: { 'Content-Type': 'application/json' } });
  if (!res.ok) throw new Error('Error al obtener productos');
  return res.json();
}

export async function getCarritosFetch() {
  const token = localStorage.getItem('token');
  const res = await fetch(`${API_BASE}/carritos`, {
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${token}`
    }
  });
  if (res.status === 401) throw new Error('No autorizado — revisa token');
  if (!res.ok) throw new Error('Error al obtener carritos');
  return res.json();
}

// --- Axios (opcional) ---
// Si quieres usar axios, instala: npm i axios
// import axios from 'axios';
// export const api = axios.create({ baseURL: API_BASE, headers: { 'Content-Type': 'application/json' } });

export async function loginAxios(correo, contrasena) {
  // Redirige a loginFetch que maneja el envío con la clave `contrasena`.
  return loginFetch(correo, contrasena);
}

export async function getProductosAxios() {
  return getProductosFetch();
}

export async function getCarritosAxios() {
  return getCarritosFetch();
}
