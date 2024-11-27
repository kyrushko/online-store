# Art Store PHP Application

## Project Description

This project is a PHP-based web application designed for managing an online art store. Users can browse available artwork, add items to a cart, and place orders, while administrators can manage the catalog and orders. The system implements basic CRUD (Create, Read, Update, Delete) functionalities to handle items and orders efficiently.

File Structure

Main Files

	•	index.php: The landing page of the application where users can view available artwork or navigate to other sections.
	•	artPage.php: Displays details of individual artworks, allowing users to learn more or add items to their cart.
	•	cart.php: Manages the shopping cart, enabling users to view, modify, or proceed to checkout.
	•	order.php: Handles the order placement and confirmation process.

Admin Features

	•	admin.php: The main dashboard for administrators to manage the store.
	•	add_item.php: Allows admins to add new artwork or items to the catalog.
	•	delete_order.php: Provides functionality to remove orders from the system.

Utility Pages

	•	contact.php: A contact page where users can submit inquiries or feedback.
	•	message.php: Handles user-submitted messages or feedback.

Others

	•	public/: Contains necessary assets like CSS, JavaScript, all the media is stored in the database
	•	README.md: Documentation for understanding the project setup and functionality (this file).

Installation and Setup

	1.	Clone or download the project to your local machine.
	2.	Ensure you have a local server environment set up (e.g., XAMPP or MAMP).
	3.	Place the project folder in the server’s root directory (htdocs for XAMPP, www for WAMP/MAMP).
	4.	Import the database.
	5.	Update the database configuration in a central PHP file (if one exists, typically named config.php or similar).
	6.	Start your server and navigate to http://localhost/your_project_folder/ in your browser.

Features

User Functionality:

	•	View available artwork on the homepage.
	•	Explore detailed information about specific artworks.
	•	Add items to the shopping cart.
	•	Place orders.

Admin Functionality:

	•	Add new items to the catalog.
	•	Manage existing orders.
	•	Delete orders when necessary.

Requirements

	•	PHP 7.4 or higher
	•	MySQL database
	•	A web server like Apache or Nginx
	•	Browser with JavaScript enabled

License

This project is for educational purposes only. Feel free to modify and expand upon the code as needed.
