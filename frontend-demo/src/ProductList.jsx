import React from 'react'

export default function ProductList({ products }) {
  return (
    <div className="products">
      <h2>Productos</h2>
      {Array.isArray(products) && products.length > 0 ? (
        <ul>
          {products.map((p) => (
            <li key={p.id}>{p.nombre || p.nombre_producto || p.title || JSON.stringify(p)}</li>
          ))}
        </ul>
      ) : (
        <p>No hay productos</p>
      )}
    </div>
  )
}
