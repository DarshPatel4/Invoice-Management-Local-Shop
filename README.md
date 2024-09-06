# 🧾 Invoice Management for Local Shop

## Project Overview
The Invoice Management System for Local Shop is a web-based application developed using PHP. This project aims to streamline the invoicing process for small local shops, making it easier to manage sales, track inventory, and generate invoices efficiently.

## Features
- 🔒 **User Authentication:** Secure login and registration for shop owners and employees.
- 🛒 **Product Management:** Add, update, and delete products with details like name, price, and stock quantity.
- 🧾 **Invoice Generation:** Create and print invoices for customer purchases.
- 📈 **Sales Tracking:** Keep track of all sales and generate reports.
- 📦 **Inventory Management:** Monitor stock levels.
- 👥 **Customer Management:** Maintain a database of customers with their contact details and purchase history.
- 🔄 **Select Products from Inventory or Add Manually:** Choose between adding products manually or selecting from the existing inventory.

## Technologies we are Using
- 🌐 **Frontend:** HTML, CSS, JavaScript
- ⚙️ **Backend:** PHP
- 🗄️ **Database:** MySQL
- 🛠️ **Tools:** XAMPP, phpMyAdmin

## Getting Started

### Prerequisites
- 📥 [XAMPP](https://www.apachefriends.org/index.html) (or any other local server environment)
- 🌐 Web browser
- 🖊️ Code editor (e.g., VSCode, Sublime Text)

### Installation

1. **Clone the Repository:**
    ```bash
    git clone https://github.com/DarshPatel4/Invoice-Management-Local-Shop.git
    ```

2. **Setup Database:**
    - Open `phpMyAdmin` and create a new database named `local_shop`.
    - Import the database schema from the `database/local_shop.sql` file.

3. **Configure Project:**
    - Navigate to the project directory and open the `config.php` file.
    - Update the database connection settings:
      ```php
      define('DB_SERVER', 'localhost');
      define('DB_USERNAME', 'root');
      define('DB_PASSWORD', '');
      define('DB_NAME', 'invoice_system');
      ```

4. **Start Local Server:**
    - Open XAMPP and start the Apache and MySQL services.
    - Navigate to `http://localhost/Invoice-Management-Local-Shop` in your web browser.

## Usage

1. **Register/Login:**
   - 🔐 Register a new account or login with existing credentials.

2. **Manage Products:**
   - 🛒 Add new products to the inventory, update existing ones, or delete products.

3. **Create Invoices:**
   - 🧾 Generate invoices for customer purchases and print them for records.

4. **Track Sales:**
   - 📊 View sales history and generate sales reports.

5. **Add Products:**
   - 🛒 Choose between adding products manually or selecting from inventory. When selecting from inventory, details of the selected products will automatically be filled in the "Product Information" section.

## Contributing

We welcome contributions from the community! To contribute, follow these steps:

1. 🍴 Fork the repository.
2. 🌿 Create a new branch (`git checkout -b feature/YourFeature`).
3. 💻 Make your changes.
4. ✅ Commit your changes (`git commit -m 'Add some feature'`).
5. 📤 Push to the branch (`git push origin feature/YourFeature`).
6. 🔄 Open a pull request.

## License

This project is licensed under the GNU General Public License v3.0 - see the [LICENSE](LICENSE) file for details.

## Contact

If you have any questions or suggestions, feel free to reach out to us at:

- 📧 **Darsh Patel** - 22cs051@charusat.edu.in
- 🐙 **GitHub:** [DarshPatel4](https://github.com/DarshPatel4)

## Acknowledgements

We would like to thank our team members and mentors for their support and contributions to this project.
