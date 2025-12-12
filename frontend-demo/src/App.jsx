import React, { useState, useEffect } from 'react'
import Login from './Login'
import ProductList from './ProductList'
import { getProductosAxios } from '../../frontend-example/api.js'

export default function App() {
  const [token, setToken] = useState(localStorage.getItem('token'))
  const [products, setProducts] = useState([])

  useEffect(() => {
    async function load() {
      try {
        const data = await getProductosAxios()
        setProducts(data)
      } catch (e) {
        console.error(e)
      }
    }
    load()
  }, [])

  return (
    <div className="app">
      <h1>TiendaRopa - Demo</h1>
      {!token ? <Login onLogin={(t) => setToken(t)} /> : <p>Autenticado</p>}
      <ProductList products={products} />
    </div>
  )
}
