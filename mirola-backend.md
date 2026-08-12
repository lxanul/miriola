# Specyfikacja Backend (PHP/Laravel) dla Ośrodka Wypoczynkowego MIRiOLA

## Overview
Projekt polega na stworzeniu backendu opartego na PHP (Laravel 11) dla Ośrodka MIRiOLA. Backend będzie oparty o bazę danych **MySQL**, autoryzację opartą o role z wykorzystaniem tokenów **JWT** (`tymon/jwt-auth`) dla API, oraz integrację obecnego szablonu z **szablonami Blade** (Server-Side Rendering) sprzężonymi z panelem administracyjnym **Filament** do łatwego zarządzania rezerwacjami, pokojami i CMS.

## Project Type
**WEB/BACKEND** (Laravel z widokami Blade, panel admina Filament, API pod integracje)

## Success Criteria
- [ ] Laravel 11 poprawnie zainstalowany w katalogu `/backend`.
- [ ] Baza danych MySQL skonfigurowana, a migracje wykonane pomyślnie.
- [ ] Konfiguracja panelu Filament do obsługi pokoi i rezerwacji.
- [ ] Autoryzacja klientów/pracowników za pomocą JWT działająca poprawnie.
- [ ] CMS (zarządzanie tekstami i galerią) pozwala na edycję zawartości strony głównej.
- [ ] Logowanie operacji administracyjnych w tabeli `audit_logs`.

## Tech Stack
- **Framework:** PHP 8.2+ / Laravel 11
- **Admin Panel:** Filament PHP v3
- **Database:** MySQL 8.0+
- **Authentication:** JWT (`tymon/jwt-auth`)
- **Frontend Engine:** Laravel Blade
- **File Storage:** Local Laravel Storage (`storage/app/public/cms`)

## Database Schema

### Tabela `users`
- `id` (bigint, PK)
- `name` (string)
- `email` (string, unique)
- `password` (string)
- `role` (enum: ['client', 'employee', 'admin'], default: 'client')
- `phone` (string, nullable)
- `created_at`, `updated_at`

### Tabela `rooms`
- `id` (bigint, PK)
- `name` (string) - np. "Pokój 2-osobowy"
- `slug` (string, unique)
- `description` (text)
- `capacity` (integer) - liczba osób
- `price_per_night` (decimal, 8, 2)
- `image_path` (string, nullable)
- `is_active` (boolean, default: true)
- `created_at`, `updated_at`

### Tabela `bookings`
- `id` (bigint, PK)
- `user_id` (bigint, FK users)
- `room_id` (bigint, FK rooms)
- `check_in` (date)
- `check_out` (date)
- `total_price` (decimal, 10, 2)
- `status` (enum: ['pending', 'confirmed', 'cancelled', 'completed'], default: 'pending')
- `notes` (text, nullable)
- `created_at`, `updated_at`

### Tabela `services` (Dodatkowe usługi)
- `id` (bigint, PK)
- `name` (string) - np. "Wypożyczenie roweru"
- `description` (text, nullable)
- `price` (decimal, 8, 2)
- `is_active` (boolean, default: true)
- `created_at`, `updated_at`

### Tabela `cms_contents`
- `id` (bigint, PK)
- `key` (string, unique) - np. "hero_title"
- `value` (text)
- `created_at`, `updated_at`

### Tabela `gallery_photos`
- `id` (bigint, PK)
- `title` (string, nullable)
- `file_path` (string)
- `is_active` (boolean, default: true)
- `created_at`, `updated_at`

### Tabela `audit_logs`
- `id` (bigint, PK)
- `user_id` (bigint, FK users, nullable)
- `action` (string) - np. "created_booking"
- `model_type` (string)
- `model_id` (bigint)
- `old_values` (json, nullable)
- `new_values` (json, nullable)
- `ip_address` (string, nullable)
- `created_at`
