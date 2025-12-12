import React, { useState } from 'react'
import { loginAxios } from '../../frontend-example/api.js'

export default function Login({ onLogin }) {
  const [correo, setCorreo] = useState('')
  const [contrasena, setContrasena] = useState('')
  const [error, setError] = useState(null)

  async function submit(e) {
    e.preventDefault()
    try {
      const data = await loginAxios(correo, contrasena)
      onLogin(data.token)
    } catch (err) {
      setError(err.message || 'Error')
    }
  }

  return (
    <form onSubmit={submit} className="login-form">
      <div>
        <label>Correo</label>
        <input value={correo} onChange={(e) => setCorreo(e.target.value)} />
      </div>
      <div>
        <label>Contraseña</label>
        <input type="password" value={contrasena} onChange={(e) => setContrasena(e.target.value)} />
      </div>
      <button type="submit">Login</button>
      {error && <div className="error">{error}</div>}
    </form>
  )
}
