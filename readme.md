# University Project

## Overview
This project is a web-based application designed to manage medical and dental cases. It allows doctors to submit and view cases, while patients can be assigned cases and view their progress. The platform features filtering by category, viewing case details in modals, and an easy-to-use interface for all users.

## Features
- **User Authentication**: Signup and login for doctors and patients with role-based session management.
- **Case Creation**:
  - Patients can create new cases with detailed descriptions, images, and funding targets.
- **Case Assignment**:
  - Doctors can view unassigned cases and assign themselves through a modal interface.
- **Donation System**:
  - Patients can donate to cases with visible progress bars showing amount raised vs target.
- **Case Filtering**:
  - Users can filter cases by category (Medical, Dental).
- **Role-based UI Controls**:
  - “Take the Case” button is only enabled for doctors.
  - “Help” button (donation) is only enabled for patients.
- **Case Details Modal**:
  - Clicking “Take the Case” or “Help” shows a modal with case description, tags, and funding info.
- **Progress Visualization**:
  - Cases display a progress bar and textual breakdown of raised funds above the donation section.
- **Case Assignment Visibility**:
  - If a doctor is assigned, their name is shown above the funding bar.
- **Responsive Design**:
  - Works well on both desktop and mobile devices.

## Technologies Used
- **Frontend**: HTML, CSS, JavaScript, Bootstrap
- **Backend**: PHP
- **Database**: MySQL
- **Web Server**: Apache (or any local/remote PHP server)
- **Containerization**: Docker Compose

## Installation

### Requirements
1. **Docker** (for containerization)
2. **Docker Compose** (for managing multi-container applications)

### Steps to Set Up with Docker Compose:
1. **Clone the repository**:
    ```bash
    git clone https://github.com/your-repository.git
    cd your-repository
    ```

2. **Set up Docker Compose**:
   - Ensure Docker and Docker Compose are installed on your system.
   - From the project root, run the following command to build and start the containers:
     ```bash
     docker-compose up --build
     ```

3. **Access the application**:
   - Once the containers are up and running, open your browser and navigate to:
     ```bash
     http://localhost:8080
     ```

4. **Set up the database**:
   - The `docker-compose.yml` file will configure and set up the MySQL container automatically.
   - If needed, run migrations or import the `init.sql` script to the MySQL container using:
     ```bash
     docker-compose exec db mysql -u root -p your-database < init.sql
     ```

5. **Access PHPMyAdmin** (optional):
   - If you want to manage the database via a GUI, you can access **PHPMyAdmin** at:
     ```bash
     http://localhost:8081
     ```

6. **Running the Project**:
   - After starting the containers with Docker Compose, your application will be available at:
     ```bash
     http://localhost:8080
     ```

## Rebuilding the Project
If you've made changes to the Docker configuration or the database, follow these steps:

1. **Rebuild the containers**:
   - If you have updated the Docker configuration, rebuild the containers using:
     ```bash
     docker compose down -v
     docker-compose up --build
     ```

2. **Clear browser cache** (for frontend updates):
   - If frontend changes (CSS/JS) are not reflecting, clear your browser cache or do a hard refresh (`Ctrl + F5`).

3. **Restart the containers**:
   - Restart the containers to apply backend changes:
     ```bash
     docker-compose restart
     ```

## Contributing
1. **Fork the repository**.
2. **Create a new branch** (`git checkout -b feature-branch`).
3. **Make your changes** and **commit** (`git commit -m 'Add new feature'`).
4. **Push to your fork** (`git push origin feature-branch`).
5. **Open a pull request** for review.

## License
This project is licensed under the MIT License.

## Contact
- **Developer**: Your Name
- **Email**: your.email@example.com