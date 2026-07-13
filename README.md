# Thought Threads

Thought Threads is a premium, modern blogging platform built with Laravel 11 and Tailwind CSS. It provides a sleek, distraction-free environment for writers to publish their ideas and interact through comments.

## Features

- **User Authentication**: Standard registration & login as well as "Login with Google" via Laravel Socialite.
- **Email Verification**: Secure registration verified through a 6-digit OTP code sent via mail.
- **User Dashboard**:
  - View and manage published articles.
  - Publish new articles using the integrated Quill Rich Text Editor.
  - Update account profile settings (Name, Email, Phone Number).
  - Securely update password.
- **Article Filtering**: Quick filter articles by author's name directly from the homepage.
- **Responsive Layout**: Modern, mobile-first design with glassmorphic dark-theme aesthetics.
- **Notification Toast System**: Sleek dismissible success and error notifications with interactive status timers.

## Tech Stack

- **Backend**: PHP 8.2+ & Laravel 11
- **Database**: MySQL / SQLite
- **Frontend**: Blade Templating, Tailwind CSS v3 (custom theme layout), jQuery
- **Integrations**: Quill Editor (WYSIWYG), Laravel Socialite (Google OAuth), Mail (OTP)

## Getting Started

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js & npm

### Installation

1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd laravelOne
   ```

2. Install PHP and JS dependencies:
   ```bash
   composer install
   npm install
   ```

3. Setup environment configuration:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure your `.env` database details and mail settings:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravelone
   DB_USERNAME=root
   DB_PASSWORD=
   
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.mailtrap.io
   # Add your mail configuration for OTP delivery...
   ```

5. Run database migrations:
   ```bash
   php artisan migrate
   ```

6. Compile Tailwind assets:
   ```bash
   npm run build:tailwind
   ```

7. Start the development server:
   ```bash
   php artisan serve
   ```
