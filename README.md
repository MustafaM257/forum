# Forum Website Documentation

## Introduction

This documentation provides a comprehensive overview of a forum website built using Laravel 11, Vue 3, and Inertia.js. The application allows users to create posts and comments with rich text and markdown support. Authentication is handled via Jetstream's starter kit, ensuring secure and efficient user management.

## Table of Contents

1. [Installation](#installation)
2. [Configuration](#configuration)
3. [Features](#features)
4. [Architecture](#architecture)
5. [Resources and Policies](#resources-and-policies)
6. [Usage](#usage)
7. [Contributing](#contributing)
8. [License](#license)

## Installation

### Prerequisites

- PHP 8.1+
- Composer
- Node.js and NPM
- MySQL or PostgreSQL

### Steps

1. **Clone the repository:**
    ```sh
    git clone git@github.com:MustafaM257/forum.git
    cd forum
    ```

2. **Install dependencies:**
    ```sh
    composer install
    npm install
    npm run dev
    ```

3. **Set up environment file:**
    ```sh
    cp .env.example .env
    ```

4. **Configure database in `.env` file:**
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

5. **Run migrations and seeders:**
    ```sh
    php artisan migrate --seed
    ```

6. **Serve the application:**
    ```sh
    php artisan serve
    ```

## Configuration

Ensure to configure other services and settings in the `.env` file according to your requirements, such as mail services, broadcasting, and cache drivers.

## Features

- **User Authentication:** Managed by Laravel Jetstream.
- **Posts and Comments:** Users can create posts and comments with rich text and markdown.
- **Real-time Updates:** Utilizing Inertia.js for smooth single-page application behavior.
- **Resourceful Routes:** CRUD operations for posts and comments.
- **Rich Text Editing:** Integrated rich text and markdown support for posts and comments.

## Architecture

The application follows a clean architecture approach, emphasizing separation of concerns and modularity.

### Folders Structure

- `app/Models`: Eloquent models.
- `app/Http/Controllers`: Controllers handling HTTP requests.
- `app/Providers`: manage data to be provided to frontend
- `app/Policies`: Authorization policies.
- `resources/js`: Vue 3 components and Inertia pages.
- `resources/views`: Blade templates for initial HTML.

## Resources and Policies

### Resources

Resources are used to transform models into JSON responses, ensuring a clear separation between the model data and the JSON structure exposed to the API.

- `app/Http/Resources/PostResource.php`
- `app/Http/Resources/CommentResource.php`
- `app/Http/Resources/UserResource.php`
### Policies

Policies manage the authorization logic for different actions within the application. Ensure policies are registered in the `AuthServiceProvider`.

- `app/Policies/PostPolicy.php`
- `app/Policies/CommentPolicy.php`


## Usage

### Authentication

- **Register**: Users can register via the registration form.
- **Login**: Registered users can log in to access their account.
- **Password Reset**: Users can reset their passwords via email.

### Posts and Comments

- **Create Post**: Authenticated users can create new posts.
- **Edit/Delete Post**: Users can edit or delete their own posts.
- **Comment on Post**: Authenticated users can comment on posts.
- **Edit/Delete Comment**: Users can edit or delete their own comments.

## Contributing

We welcome contributions! Please fork the repository and submit pull requests.

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make your changes.
4. Commit your changes (`git commit -m 'Add new feature'`).
5. Push to the branch (`git push origin feature-branch`).
6. Open a pull request.

## License

This project is open-source and licensed under the MIT License. For more information, see the [LICENSE](LICENSE) file.

---

Feel free to customize this documentation to better fit the specifics of your project.
