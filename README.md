# Daily Task Management System

A simple daily task management system built using Laravel and Blade, featuring automatic daily email notifications for pending tasks using Cron Job and Queue.


## Features

1. **Task Management**:
   - Add a new task with a title, description, and due date.
   - View a list of tasks with the ability to change the task status between "Pending" and "Completed."
   - Edit and delete tasks.

2. **Automated Notifications**:
   - Sends a daily email to users with pending tasks using Cron Job and Queue.

3. **Authentication**:
   - Protects access to the system using authentication so only logged-in users can view and manage tasks.


- [Installation](#installation)
 1. **Clone the repository:**
 
     ```bash
     git clone https://github.com/HusseinIte/daily-tasks-management-system.git
     cd daily-tasks-management-system
     ```
 
 2. **Install dependencies:**
 
     ```bash
     composer install
     npm install
     ```
 
 3. **Copy the `.env` file:**
 
     ```bash
     cp .env.example .env
     ```
 
 4. **Generate an application key:**
 
     ```bash
     php artisan key:generate
     ```
 
 5. **Configure the database:**
 
     Update your `.env` file with your database credentials.
 
 6. **Run the migrations:**
 
     ```bash
     php artisan migrate --seed
     ```
 7. **Run the seeders:**
 
     If you want to populate the database with sample data, use the seeder command:
 
     ```bash
     php artisan db:seed
     ```
 8. **Serve the application:**
 
     ```bash
     php artisan serve
     ```
 9. **Run the queue worker as follows:**
     ```bash
     php artisan queue:work
     ```
 10. **Run the scheduler as follows:**
     ```bash
     php artisan schedule:work
     ```
You can now access the application at localhost:8000 after starting the server
