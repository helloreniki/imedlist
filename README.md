## About

MedList is Laravel, Inertia, Vue3 application that let's you create and export to pdf your personal medication list for you or someone else.

- Landing Page
- Authetication with Laravel Jetstream
- Eloquent Relationships:
  - User hasMany Patients, Patient belongsTo User
  - Patient has Many Drugs, Drug belongsTo Patient

Auth user can:
- create, edit and delete a patient
- Search through list of patients by first_name and last_name
- Filter through list of patients by updated_at field
- Show patient's data and list of drugs they are taking
- Add new drug, edit, delete drug for a patient
- Export to PDF with DOMPdf
- Seeder for test user: seed patients with drugs

## Setup

- Laravel, Inertia, Vue
- TailwindCSS
- Date-fns
- Heroicons/vue
- Vue-Tailwind-Datepicker
- Laravel DOMPdf

## Installation

clone repository, adjust .env, create database

```composer install```

```npm install && npm run dev```

```php artisan key:generate```

```php artisan migrate```

```php artisan db:seed```


## Credentials

These are credentials for test user that already has seeded few patients and each patient has seeded drugs.

username: first@test.com
password: password
