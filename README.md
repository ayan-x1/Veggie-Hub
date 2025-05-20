# 🥦 Veggie-Hub

**Veggie-Hub** is a PHP-based mini-project designed to streamline the management and buying/selling of vegetables online. This project is suitable for college-level assignments and demonstrates CRUD operations, user authentication, and admin functionalities using PHP and MySQL.

---

## 🚀 Features

- **User Authentication:** Separate login for Admin, Farmers, Buyers, and Consumers.
- **Product Management:** Add, edit, delete, and view vegetables/products.
- **Order Management:** Place, update, and track orders.
- **Cart System:** Add products to cart and manage purchases.
- **Role-based Dashboards:** Different dashboards for admin, farmer, buyer, and consumer.
- **Category Management:** Organize products by category.
- **Responsive UI:** Simple and intuitive interface.

---

## 📁 Folder Structure

Veggie-Hub/
│
├── admin_dashboard.php
├── admin_login.php
├── admin_logout.php
├── edit_buyer.php
├── edit_consumer.php
├── edit_farmer.php
├── edit_order.php
├── edit_product.php
├── manage_buyer.php
├── manage_cart.php
├── manage_categories.php
├── manage_consumer.php
├── manage_farmer.php
├── manage_orders.php
├── manage_products.php
├── veggie-hub.zip
└── bin.txt

---

## ⚙️ Installation & Setup

### 1. Prerequisites

- [XAMPP](https://www.apachefriends.org/) or [WAMP](https://www.wampserver.com/) (PHP >= 7.0, MySQL)
- Web browser (Chrome, Firefox, etc.)

### 2. Clone the Repository

---

## ⚙️ Installation & Setup

### 1. Prerequisites

- [XAMPP](https://www.apachefriends.org/) or [WAMP](https://www.wampserver.com/) (PHP >= 7.0, MySQL)
- Web browser (Chrome, Firefox, etc.)

### 2. Clone the Repository

- git clone https://github.com/ayan-x1/Veggie-Hub.git
  
### 3. Import Database

1. Extract `veggie-hub.zip` if provided (or use your own SQL file).
2. Open **phpMyAdmin** (usually at `http://localhost/phpmyadmin`).
3. Create a new database (e.g., `veggie_hub`).
4. Import the SQL file (`veggie-hub.sql` or from the extracted folder).

### 4. Configure Database Connection

- Open the PHP files where database connection is made (e.g., `config.php` or at the top of main files).
- Update the following variables as per your local setup:

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'veggie_hub';

### 5. Run the Application

- Place the project folder in your web server's `htdocs` (XAMPP) or `www` (WAMP) directory.
- Start Apache and MySQL from your control panel.
- Open your browser and go to:  
  `http://localhost/Veggie-Hub/admin_login.php`  
  or the appropriate entry point.

---

## 👤 Default Admin Credentials

> **Username:** `admin`  
> **Password:** `admin123`  
> *(Change these after first login for security!)*

---

## 🛠️ Usage

- **Admin:** Manage users, products, categories, and orders.
- **Farmer:** Add or update products (vegetables) for sale.
- **Buyer/Consumer:** Browse products, add to cart, and place orders.

---

## 📝 Project Details

- **Project Type:** College Mini Project
- **Language:** PHP (Core PHP, no frameworks)
- **Database:** MySQL
- **Status:** Completed

---

## 🤝 Contributing

Pull requests are welcome! For major changes, please open an issue first to discuss what you would like to change.

---

## 📄 License

This project is for educational purposes only.

---

## 🙏 Acknowledgements

- [PHP Documentation](https://www.php.net/docs.php)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [W3Schools PHP Tutorial](https://www.w3schools.com/php/)

---

> *Developed by*
 [ayan-x1](https://github.com/ayan-x1)
 [NagdevHarsh](http://github.com/NagdevHarsh)
 [deep3012-patel](https://github.com/deep3012-patel)
