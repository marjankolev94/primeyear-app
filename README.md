# PrimeYear App

PrimeYear App is a PHP/Laravel application designed to calculate and display prime years. Given a specific year as input, the app outputs the first 30 prime years counted backward from that point.

## Features

- **Prime Year Calculation**: Enter any year, and the app will calculate the first 30 prime years before that year.
- **Simple Interface**: Easy-to-use input field for entering the starting year.

## Getting Started

### Prerequisites
- PHP and Laravel installed on your system
- A web server environment (such as XAMPP or Laravel Sail)

### Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/marjankolev94/primeyear-app.git

2. Navigate to the project directory:
   ```bash
   cd primeyear-app

3. Install dependencies:
   ```bash
   composer install

4. Set up environment variables:
- Copy .env.example to .env and configure your database and application settings as needed.

5. Run migrations:
   ```bash
   php artisan migrate

6. Serve the application
   ```bash
   php artisan serve

   The app will be available at http://localhost:8000.

### Usage
- Open the app in your browser.
- Enter a starting year in the input field.
- Click "Submit" to view the first 30 prime years counted backward from the entered year.
### Technologies Used
- PHP: Server-side scripting language.
- Laravel: PHP framework for building modern web applications.
### Contributing
Contributions are welcome! Please fork the repository and create a pull request with any improvements or bug fixes.

### License
This project is open-source and available under the MIT License.
