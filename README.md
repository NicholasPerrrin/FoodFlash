# FoodFlash

FoodFlash is a web application that facilitates restaurant management and reviewing system. The platform consists of two main interfaces: a customer-facing system for browsing restaurants and placing orders, and an administrative interface for restaurant owners to manage their menus and track orders. The application is built using PHP for the backend, with HTML5, CSS3, and JavaScript for the frontend, implementing features such as user authentication, order processing, and restaurant management tools.

## Features

### For Customers
- Search and discover restaurants
- Browse restaurant menus
- Add items to cart
- Place orders
- Add tips
- Bookmark favorite restaurants
- User account management

### For Restaurant Owners
- Menu management (add/update/remove items)
- Order tracking
- Restaurant profile management

## Tech Stack

- **Frontend:**
  - HTML5
  - CSS3
  - JavaScript
  - PHP

- **Backend:**
  - PHP
  - MySQL/PostgreSQL (Database)

## Project Structure

```
FoodFlash/
├── css/                  # Stylesheets
├── images/              # Image assets
├── javascript/          # Client-side scripts
├── phpscripts/          # Backend PHP scripts
├── readMe/              # Additional documentation
├── *.php               # Main application pages
└── *.html              # Static pages
```

## Getting Started

### Prerequisites
- PHP 7.0 or higher
- MySQL/PostgreSQL database
- Web server (Apache/Nginx)

### Installation

1. Clone the repository
```bash
git clone https://github.com/yourusername/FoodFlash.git
```

2. Set up your web server to point to the project directory

3. Configure your database settings in the appropriate configuration file

4. Import the database schema (if provided)

5. Start your web server and access the application through your browser

## Usage

1. **Customer Flow:**
   - Register/Login to your account
   - Browse restaurants or search for specific cuisines
   - Add items to cart
   - Place order
   - Track order status

2. **Restaurant Owner Flow:**
   - Login to restaurant dashboard
   - Manage menu items
   - View and process orders
   - Update restaurant information
