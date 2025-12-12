# Changelog

## 2025-12-11 - Fix and improvements

- Fixed database table/column mismatches: normalized password column to `contrasena`.
- Added a migration to safely rename `contraseña` to `contrasena` with data migration and hashing for legacy plaintext passwords.
- Fixed models `User` and `Usuario` to use the `tblUsuarios` table and support both `contrasena` and legacy `contraseña` attributes.
- Implemented accessors/mutators in models to transparently read/write either column when necessary.
- Updated `AuthController` login flow to accept `contrasena` and fallback to `contraseña`; it re-hashes plain passwords on first successful login.
- Switched token creation to the `User` authenticatable model (HasApiTokens) and added a robust fallback if User isn't present.
- Added an Artisan command `rehash:passwords` and a script for rehashing legacy non-hashed passwords.
- Frontend changes: persist token in `localStorage`, automatically set Authorization header on axios, and added `AuthContext`.
- Added README/DEPLOYMENT docs showing how to run migrations, seed admin, and rehash passwords.
