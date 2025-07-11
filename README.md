# TourMate Website

## Description
TourMate is a web application built with Flask that provides a platform for users to explore travel packages, register and log in, book trips, and make payments securely. The app also features a chatbot powered by the Gemini API to assist users with their queries.

## Features
- User registration and login with secure password hashing
- Browse travel packages and detailed information
- Book trips with guest details and travel dates
- Checkout and payment processing with validation
- Booking confirmation and payment history
- Interactive chatbot for user assistance

## Technologies Used
- Python 3
- Flask web framework
- MySQL database
- Flask-MySQLdb for database integration
- Werkzeug for password hashing
- HTML, CSS, JavaScript for frontend
- Gemini API for chatbot integration

## Installation

1. Clone the repository:
   ```
   git clone <repository-url>
   cd TOURMATE_WEBSITE
   ```

2. Set up a Python virtual environment and activate it:
   ```
   python -m venv venv
   venv\Scripts\activate   # On Windows
   source venv/bin/activate  # On macOS/Linux
   ```

3. Install required packages:
   ```
   pip install flask flask-mysqldb werkzeug requests
   ```

4. Configure MySQL database:
   - Create a database named `book_db`.
   - Import the schema from `db_schema.sql`.
   - Update MySQL credentials in `app.py` if needed.

5. Run the application:
   ```
   python app.py
   ```

6. Open your browser and navigate to `http://localhost:5000`.

## File Structure
- `app.py` - Main Flask application with routes and logic
- `db_schema.sql` - SQL script to create necessary database tables
- `users.json` - User data (if used)
- `static/` - Static assets including images, CSS, and JavaScript
- `templates/` - HTML templates for rendering pages

## Notes
- The chatbot feature uses the Gemini API. You will need a valid API key to enable this functionality.
- Ensure your MySQL server is running and accessible with the configured credentials.

