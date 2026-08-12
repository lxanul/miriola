# Plan Implementacji Backend (PHP/Laravel) dla Ośrodka MIRiOLA

## Cel
Stworzenie kompletnej architektury backendu w języku PHP (Laravel 11), schematu bazy danych, mechanizmów autoryzacji oraz panelu administracyjnego Filament, umożliwiającego zarządzenie rezerwacjami, pokojami, galeriami oraz edycją tekstów dynamicznych (CMS) na stronie.

## Zadania
- [ ] Zadanie 1: Przygotowanie struktury folderów backendu (katalog `/backend`) i instalacja Laravela.
- [ ] Zadanie 2: Konfiguracja połączenia z bazą danych MySQL w pliku `.env`.
- [ ] Zadanie 3: Stworzenie migracji bazy danych dla tabel: `users`, `rooms`, `bookings`, `services`, `cms_contents`, `gallery_photos`, `audit_logs`.
- [ ] Zadanie 4: Instalacja i konfiguracja panelu administracyjnego Filament.
- [ ] Zadanie 5: Implementacja autoryzacji użytkowników i ról (Admin / Klient / Pracownik) za pomocą JWT (`tymon/jwt-auth`).
- [ ] Zadanie 6: Implementacja API CMS do edycji tekstów i przesyłania zdjęć (CmsController + obsługa File Storage).
- [ ] Zadanie 7: Stworzenie kontrolerów CRUD dla pokoi, rezerwacji i dodatkowych usług.
- [ ] Zadanie 8: Konfiguracja logowania zdarzeń (Audit Logs) i walidacji danych.

## Done When
- [ ] Backend poprawnie obsługuje role i autoryzację.
- [ ] Administrator może zarządzać rezerwacjami, pokojami i galeriami przez panel Filament.
- [ ] Dynamiczne teksty i zdjęcia na stronie głównej są pobierane z bazy danych.
- [ ] Działa pełny schemat bazy danych dla systemu rezerwacji.

## Uwagi
- Zdjęcia przesyłane przez panel admina będą zapisywane lokalnie w `storage/app/public/cms/`.
- Konfiguracja tekstów CMS będzie trzymana w tabeli `cms_contents` jako klucz-wartość (np. `hero_title` => `Odkryj spokój...`).
