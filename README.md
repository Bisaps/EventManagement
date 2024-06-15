This README file provides a comprehensive guide to set up, use, and understand your event management application, covering all required points in detail.

EventManagement
Project Overview
The EventManagement application is a PHP-based event management system that allows users to create, read, update, and delete events such as hackathons, seminars, and college fests. The application uses a JSON file to store event data, and it incorporates Bootstrap for styling. The site is hosted locally using XAMPP server.

Features
User authentication (login with username and password)
Create, read, update, and delete (CRUD) operations for events
Event filtering by title, start date, and end date
Client-side and server-side validation
Separate page for adding and editing events
Prerequisites
XAMPP server
PHP 7.4 or higher
Bootstrap 4 or higher
Installation
XAMPP Server Setup
Download and Install XAMPP:

Download XAMPP from the official Apache Friends website.
Install XAMPP following the installation instructions for your operating system.
Start Apache Server:

Open the XAMPP Control Panel.
Start the Apache server by clicking on the "Start" button next to "Apache".
Move the Project to XAMPP's htdocs Directory: Move the cloned repository folder EventManagement to the htdocs directory inside your XAMPP installation directory (e.g., C:\xampp\htdocs on Windows or /Applications/XAMPP/htdocs on macOS).

Access the Application: Open your web browser and navigate to http://localhost/EventManagement/Login.php.

####Usage Login Page

URL: http://localhost/EventManagement/Login.php
Credentials:
    Username: admin
    Password: password
Enter the above credentials and click "Login".
Redirects to the index page where you can manage events.
Index Page

URL: http://localhost/EventManagement/index.php
From the index page, you can:
    View the list of events.
    Filter events by title, start date, and end date.
    Edit an existing event by clicking the "Edit" button.
    Delete an event by clicking the "Delete" button.
Add/Edit Event Page

URL: http://localhost/EventManagement/addEdit.php
From the index page, click "Add Event" to go to the Add/Edit Event page.
Add a new event or edit an existing event.
Screenshots

Login Page: images/Login.png
Index Page: images/Events.png
Add/Edit Event Page: images/AddEvent.png , images/Editevent.png And images/Deleteevent.png
File Structure

EventManagement/
    login.php: Login page for user authentication.
    index.php: Main page to list and manage events.
    addEdit.php: Page for adding and editing events.
    json_files/events.json: JSON file to store event data.
    images/: Folder containing screenshots of the application.
    README.md: Instructions and details about the project.
Troubleshooting

Apache Server Not Starting:
    Ensure no other application is using port 80 or 443 (common ports for Apache).
    Run XAMPP Control Panel as an administrator.

Changes Not Reflected:
    Clear your browser cache and refresh the page.
    Ensure you have saved changes to your PHP files and the JSON file.
By following these instructions, you can successfully set up, run, and understand the EventManagement application. This README file provides all the necessary details for installation, usage, and troubleshooting.

This README file uses bullet points to clearly organize the necessary information, making it easy to follow
