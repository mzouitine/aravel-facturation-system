# Laravel Facturation System 💼

Ein webbasiertes Rechnungssystem mit Laravel und SQL Server. Entwickelt zur Verwaltung von Kunden, Produkten und Rechnungen – inklusive PDF-Export und Mehrwertsteuerberechnung.

## 🚀 Funktionen

- Kundenverwaltung (CRUD)
- Produktkatalog mit Preisen und Lager
- Erstellung und Verwaltung von Rechnungen
- PDF-Download der Rechnungen
- Mehrwertsteuer & Rabatte
- Dashboard mit Statistiken

## 🛠️ Technologien

- Laravel 10+
- Microsoft SQL Server
- Bootstrap / Tailwind (Frontend)
- DomPDF oder Snappy für PDF-Generierung

## ⚙️ Installation

```bash
git clone https://github.com/dein-benutzername/laravel-facturation-system.git
cd laravel-facturation-system
composer install
cp .env.example .env
php artisan key:generate
# .env für SQL Server konfigurieren
php artisan migrate
php artisan serve
