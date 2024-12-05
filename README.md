# Task Social Service
Requirements
- **PHP 8.1** or higher
- **Composer**
- **Laravel 11**
- **MySQL** or another relational database
Installation
1. Clone the repository
First, clone the repository to your local machine:
```bash
git clone https://github.com/KaremMetrial/social-service-using-api.git
cd social-service-using-api
```
2. Install dependencies
Install the required PHP dependencies using Composer:
```bash
composer install
```
3. Set up the environment
Copy the `.env.example` file to create your `.env` file:
```bash
cp .env.example .env
```
4. Generate the application key
Run the following command to generate the application key:
```bash
php artisan key:generate
```
5. Configure the database
Update your `.env` file with the correct database credentials:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
6. Add Pusher and Mail Settings in `.env`
To enable real-time notifications and email functionality, add the following to your `.env` file:
#### Pusher Configuration:
```ini
PUSHER_APP_ID=your_pusher_app_id
PUSHER_APP_KEY=your_pusher_app_key
PUSHER_APP_SECRET=your_pusher_app_secret
PUSHER_APP_CLUSTER=your_pusher_app_cluster
```
#### Mail Configuration:
```ini
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=your_mail_username
MAIL_PASSWORD=your_mail_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@example.com
MAIL_FROM_NAME="Task Social Service"
```
7. Run the migrations
Create the necessary database tables:
```bash
php artisan migrate
```
8. Serve the application
Now, you can serve the application locally:
```bash
php artisan serve
```
