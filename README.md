# Heritage Reservoir Archive

A small full-stack catalog of Sri Lanka's ancient tank-and-reservoir engineering —
built with PHP and MySQL. Search, view, add, edit, and delete entries, with a
simple login system protecting the write operations.

This is the third project in a three-part portfolio series themed around
Anuradhapura's ancient hydraulic engineering (the **bisokotuwa** valve pit and
the tank-cascade system) — see the portfolio site and the Tank Cascade
Simulator for the other two.

## Tech stack
- PHP 8+ (PDO, prepared statements, `password_hash`/`password_verify`)
- MySQL / MariaDB
- Vanilla HTML/CSS (no framework) — same design system as the rest of the series

## Setup (XAMPP)

1. **Copy the project folder** into your XAMPP `htdocs` directory, e.g.
   `C:\xampp\htdocs\heritage-archive` (Windows) or `/Applications/XAMPP/htdocs/heritage-archive` (Mac).

2. **Start Apache and MySQL** from the XAMPP control panel.

3. **Import the database.** Open `http://localhost/phpmyadmin`, click **Import**,
   choose `schema.sql` from this folder, and run it. This creates the
   `heritage_archive` database, the `users` and `reservoirs` tables, and seeds
   six sample reservoirs.

4. **Check `config.php`.** Default XAMPP settings (`root` user, no password)
   are already filled in — only change this if your MySQL setup differs.

5. **Visit the site**: `http://localhost/heritage-archive/`

6. **Create your admin account.** Go to
   `http://localhost/heritage-archive/setup_admin.php` and create a username
   and password. This page disables itself automatically once an account
   exists — for extra safety, delete `setup_admin.php` after you've used it.

7. **Log in** at `login.php` to add, edit, or delete reservoirs.

## Project structure
```
heritage-archive/
├── config.php          # DB connection + auth helpers
├── schema.sql           # Database schema + seed data
├── setup_admin.php      # One-time admin account creation
├── login.php / logout.php
├── index.php             # Search + listing
├── view.php              # Reservoir detail page
├── add.php / edit.php / delete.php   # CRUD (login required)
├── style.css
└── includes/
    ├── header.php
    └── footer.php
```

## Notes
- All database queries use PDO prepared statements to prevent SQL injection.
- Passwords are hashed with PHP's `password_hash()` (bcrypt) — never stored in plain text.
- The seeded historical details (dates, builders) reflect commonly cited
  tradition, simplified for a demo dataset — treat them as a starting point
  to expand on, not a verified historical source.
