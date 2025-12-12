# PR: Normalize password column and fix auth flow

Summary:

- Normalize and migrate the password column to `contrasena` and remove `contraseña` when safe.
- Resilient code: models and utilities handle either column during migration.
- Models `User` and `Usuario` map to `tblUsuarios` and support both attribute names via accessors/mutators.
- Update `AuthController` to normalize request field names and re-hash legacy plaintext passwords on first login.
- Add `rehash:passwords` command to re-hash any non-bcrypt passwords.
- Frontend: persist token, set Authorization header on axios, create `AuthContext` and usage in `Login.jsx`.
- Add docs: `CHANGELOG.md`, `DEPLOYMENT.md`, README updates.

Files changed:
- app/Models/Usuario.php
- app/Models/User.php
- app/Http/Controllers/AuthController.php
- app/Console/Commands/RehashPasswords.php
- database/migrations/*
- database/seeders/*
- scripts/rehash_passwords.php
- Front-end-tienda-/src/services/api.js
- Front-end-tienda-/src/context/AuthContext.jsx
- Front-end-tienda-/src/pages/Login.jsx
- README.md, DEPLOYMENT.md, CHANGELOG.md

How to test:

1. Run migrations and check column `contrasena` exists; if not, run the rename migration.
2. Seed admin and run rehash command as described in `README.md`.
3. Start backend and frontend; login as admin and ensure token persistence and protected endpoints work.

Notes:
- If your DB already has `contraseña` column, the migration will copy values to `contrasena` and drop the old column.
- If you are running this on production, ensure to run `rehash:passwords` after seeding and before restarting services.
