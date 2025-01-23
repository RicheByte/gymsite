# Dolphin Gym Management System


Welcome to the Dolphin Gym Management System! This project is designed to help gym owners manage their facilities efficiently while providing a user-friendly experience for gym members. The system includes features for user authentication, diet tracking, shopping cart functionality, a blog, and more.


## Table of Contents


- [Features](#features)

- [Technologies Used](#technologies-used)

- [Installation](#installation)

- [Usage](#usage)

- [Database Structure](#database-structure)

- [Contributing](#contributing)

- [License](#license)


## Features


- **User  Authentication**: Admins can log in to manage the gym's operations.

- **Admin Dashboard**: View user statistics, manage products, and oversee orders.

- **Blog**: Create, edit, and delete blog posts to engage with gym members.

- **Shopping Cart**: Users can browse products, add them to their cart, and place orders.

- **Diet Tracker**: Users can log their calorie intake and track their diet.

- **Leaderboard**: Display user rankings based on calories burned or points earned.

- **Live Trainer**: Interactive chat feature for users to communicate with trainers.

- **Responsive Design**: The application is designed to work on various devices.


## Technologies Used


- **Frontend**: HTML, CSS, JavaScript, Bootstrap

- **Backend**: PHP

- **Database**: MySQL (MariaDB)

- **Version Control**: Git


## Installation


1. Clone the repository:

   ```bash

   git clone https://github.com/yourusername/Dolphin_Gym.git

    Navigate to the project directory:

    bash

cd Dolphin_Gym

Import the database schema:

    Use the gym.sql file to create the database structure in your MySQL server.

Update the database connection settings in connect.php (located in the blog directory) to match your local database credentials.

Start a local server (e.g., XAMPP, WAMP) and place the project folder in the server's root directory (e.g., htdocs for XAMPP).

Access the application in your web browser:

    http://localhost/Dolphin_Gym/index/

Usage

    Admin Login: Access the admin dashboard by navigating to index/admin/login.php.
    User Features: Users can register, log in, and access features like the diet tracker and shopping cart.

Database Structure

The project includes the following key tables in the database:

    admin: Stores admin user information.
    users: Stores regular user information.
    posts: Contains blog posts.
    foods: Lists food items with their calorie counts.
    orders and order_details: For managing product orders.
    calorie_log: For tracking user calorie intake.
    calorie_leaderboard: For displaying user rankings.

Contributing

Contributions are welcome! If you have suggestions or improvements, please fork the repository and submit a pull request.
License

This project is licensed under the MIT License. See the LICENSE file for details.

Thank you for checking out the Dolphin Gym Management System! We hope you find it useful for managing your gym operations.


### Instructions for Use:

- Replace `yourusername` in the clone URL with your actual GitHub username.

- Adjust any sections as necessary to better fit your project's specifics or to add any additional information you think is relevant.

