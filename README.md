# WaarneemApp Challenge

A simple app for managing companies and users

## Table of Contents

- [Installation](#installation)
    - [Prerequisites](#prerequisites)
    - [Installation Steps](#installation-steps)
- [Usage](#usage)

## Installation

### Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP (version 8.2)
- Composer (version 2.2 at least)
- Git

### Installation Steps

1. Clone the repository:

```
git clone git@github.com:nour-eddin-badran/waarneem-app.git
```


2. Navigate to the project directory:

```
cd project-directory
```


3. Install PHP dependencies using Composer:

```
composer install
```


4. Create a copy of the `.env.example` file and rename it to `.env`:

```
cp .env.example .env
```


5. Generate the application key:

```
php artisan key:generate
```


6. Run database migrations:

```
php artisan migrate
```


7. Serve the application:

```
php artisan serve
```


8. Test the APIs easily using the Postman-collection attached with the project

## Usage

1. Use POST /import API to import a json file contains companies and users info
2. Use GET /companies API to get and filter all the companies based on user's age
3. Use POST /companies to add a new company
4. Use POST /users to Add a new user
