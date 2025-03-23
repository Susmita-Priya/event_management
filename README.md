---

# Ollyo Event Management System

The **Ollyo Event Management System** is a comprehensive platform designed to simplify event management for organizers and attendees. It provides a seamless experience for creating, managing, and attending events, along with robust user authentication, role-based access control, and reporting features. This system is ideal for event organizers who want to streamline event planning, attendee registration, and reporting.

---

## Features

### 1. **Event Management**
- **View All Events**: Display a list of all events with essential details.
- **Create Event**: Authenticated users with appropriate permissions can create new events with details such as event name, description, date, time, location, capacity, and ticket price.
- **View Event Details**: View full information about a specific event.
- **Edit Event**: Update event details as needed.
- **Delete Event**: Remove an event from the system.

### 2. **Attendee Registration**
- **Booking Form**: Attendees can register for a specific event by filling out a booking form.
- **Guest Limit**: The number of guests cannot exceed the event's capacity.
- **Auto-Calculated Payment**: The system automatically calculates the total payment based on the number of guests and ticket price.

### 3. **Reporting**
- **Event Selection**: A dropdown menu allows users to select a specific event.
- **Attendee List**: Displays a list of attendees for the selected event.
- **Print Attendee Information**: Option to print specific attendee details.
- **Download Attendee List**: Download the full list of attendees for a specific event in CSV format.

### 4. **User Authentication**
- **User Registration**: New users can create an account. By default, they are assigned the "User" role.
- **Login**: Registered users can log in to access their accounts.
- **Profile Update**: Users can update their profile information.
- **Change Password**: Option to change the account password.
- **Forgot Password**: Reset password functionality for users who forget their credentials.
- **Logout**: Secure logout option.

### 5. **User Management Module**
The **User Management Module** is a centralized module with three sub-menus for managing users, roles, and permissions.

#### **5.1 User Manage**
- **Add User**: Admin can add new users and assign roles to them.
- **Edit User**: Update user details and roles.
- **Delete User**: Remove a user from the system.
- **View Users**: Display a list of all users with their details.

#### **5.2 Role Manage**
- **Add Role**: Admin can create new roles and assign permissions to them.
- **Edit Role**: Update role details and permissions.
- **Delete Role**: Remove a role from the system.
- **View Roles**: Display a list of all roles with their details.

#### **5.3 Permission Manage**
- **Add Permission**: Admin can create new permissions.
- **Edit Permission**: Update permission details.
- **Delete Permission**: Remove a permission from the system.
- **View Permissions**: Display a list of all permissions.

---

## Overview

The **Ollyo Event Management System** is built to cater to the needs of event organizers and attendees. It provides a user-friendly interface for managing events, handling attendee registrations, and generating reports. The system ensures that event capacities are respected, payments are calculated automatically, and attendee data is easily accessible for organizers. Additionally, the system now includes a centralized **User Management Module** with sub-menus for managing users, roles, and permissions, ensuring secure and role-based access control.

### Key Benefits:
- **Efficient Event Management**: Organizers can create, edit, and delete events with ease.
- **Seamless Attendee Registration**: Attendees can book events without exceeding capacity limits.
- **Comprehensive Reporting**: Generate and download attendee lists for better event analysis.
- **Secure User Authentication**: Robust user management features ensure data security and privacy.
- **Role-Based Access Control**: Manage users, roles, and permissions to control access to system features.

---

## How to Use

1. **User Registration**: Create an account to access the system. By default, new users are assigned the "User" role.
2. **Login**: Log in to your account to manage events and view attendee details.
3. **Create Event**: Fill out the event creation form to add a new event.
4. **Attendee Registration**: Use the booking form to register attendees for an event.
5. **Generate Reports**: Select an event from the dropdown to view and download attendee lists.
6. **User Management Module**:
   - **User Manage**: Add, edit, delete, and view users, as well as assign roles.
   - **Role Manage**: Add, edit, delete, and view roles, as well as assign permissions.
   - **Permission Manage**: Add, edit, delete, and view permissions.

---

## Technologies Used
- **Frontend**: HTML, CSS, Bootstrap, JavaScript, Ajax
- **Backend**: PHP
- **Database**: MySQL

---

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/Susmita-Priya/event_management.git
   ```
2. Set up the database:
   - Import the SQL file located in the database folder: `ollyo_event_management.sql`.
3. Run the application:
   - Start your local server and navigate to `http://localhost:3000/login.php`.

---

## Login Credentials

- **Email**: susmita@gmail.com
- **Password**: 123456

---
