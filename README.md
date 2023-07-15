<div align="center">

# <span style="font-size: larger;">Task Navigator</span>

</div>

Task Navigator is a robust backend project that provides an API for managing tasks and projects efficiently. It is designed to streamline task management, collaboration, and project organization, leveraging the power of Laravel, Spatie, and Tymon packages.

<div align="center">

![Task Navigator](images/logo/task-navigator-logo.png)

</div>

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Technologies](#technologies)
- [Installation](#installation)
- [Usage](#usage)
- [API Routes](#api-routes)
- [Contributing](#contributing)
- [License](#license)

[//]: # (- [Docker Deployment]&#40;#docker-deployment&#41;)

[//]: # (- [Version Control with Git]&#40;#version-control-with-git&#41;)


## Overview

Task Navigator is a backend project that offers a range of features for efficient task and project management. It provides a robust API architecture to handle various operations related to tasks and projects. The API is built with a focus on performance, scalability, and security.

## Features

- User Management: Register, login, and manage user accounts.
- Task Management: Create, update, and delete tasks associated with projects.
- Project Management: Create, update, and delete projects within a workspace.
- Status Tracking: Track the status of tasks to monitor progress.
- API Security: Implement authentication and authorization mechanisms to secure the API.
- Service Management: Connect with MongoDB for seamless integration and data management.

## Technologies

Task Navigator uses the following technologies:

- Laravel: A popular PHP framework for web application development.
- Spatie: A Laravel package for managing roles and permissions.
- Tymon: A Laravel package for handling JSON Web Tokens (JWT) for authentication.

## Installation

To set up Task Navigator on your local machine, follow these steps:

1. Clone the repository to your local machine using `git clone`.
2. Install the required dependencies using `composer install`.
3. Copy `.env.example` to `.env` and configure the environment variables.
4. Run the necessary database migrations using `php artisan migrate`.
5. Start the development server using `php artisan serve`.

## Usage

Task Navigator provides a set of endpoints to interact with the system. You can use tools like cURL or Postman to make HTTP requests to these endpoints. Make sure to include the necessary authentication tokens or headers as required.

## API Routes

Task Navigator provides a comprehensive set of API routes to interact with the system:

- User Management:
    - `POST /api/register`: Register a new user.
    - `POST /api/login`: Authenticate a user and return a JWT.
    - `POST /api/logout`: Logout user.

[//]: # (- Workspace Management:)

[//]: # (    - `GET /api/workspaces`: Get all workspaces for the authenticated user.)

[//]: # (    - `POST /api/workspaces`: Create a new workspace.)

[//]: # (    - `GET /api/workspaces/{workspaceId}`: Get a specific workspace.)

[//]: # (    - `PUT /api/workspaces/{workspaceId}`: Update a specific workspace.)

[//]: # (    - `DELETE /api/workspaces/{workspaceId}`: Delete a specific workspace.)

[//]: # (- Project Management:)

[//]: # (    - `GET /api/projects`: Get all projects for the authenticated user.)

[//]: # (    - `POST /api/projects`: Create a new project.)

[//]: # (    - `GET /api/projects/{projectId}`: Get a specific project.)

[//]: # (    - `PUT /api/projects/{projectId}`: Update a specific project.)

[//]: # (    - `DELETE /api/projects/{projectId}`: Delete a specific project.)

- Task Management:
    - `GET /api/tasks`: Get all tasks for the authenticated user.
    - `GET /api/fetch-top-tasks/{userId}`: Get top-priority tasks for the authenticated user.
    - `GET /api/tasks/{taskId}`: Delete a specific task.
    - `POST /api/tasks`: Create a new task.
    - `POST /api/save-top-tasks/{userId}`: Save top-priority tasks 
    - `GET /api/tasks/{taskId}`: Get a specific task.
    - `PUT /api/tasks/{taskId}`: Update a specific task.
    - `DELETE /api/tasks/{taskId}`: Delete a specific task.
    



[//]: # (- Status Management:)

[//]: # (    - `GET /api/statuses`: Get all statuses for the authenticated user.)

[//]: # (    - `POST /api/statuses`: Create a new status.)

[//]: # (    - `GET /api/statuses/{statusId}`: Get a specific status.)

[//]: # (    - `PUT /api/statuses/{statusId}`: Update a specific status.)

[//]: # (    - `DELETE /api/statuses/{statusId}`: Delete a specific status.)

## Contributing

Contributions to Task Navigator are welcome! If you find any bugs, have suggestions for improvements, or would like to add new features, please feel free to submit a pull request. Follow the guidelines outlined in the contributing guide.

[//]: # (## Docker Deployment)

[//]: # ()
[//]: # (To deploy Task Navigator using Docker, follow these steps:)

[//]: # ()
[//]: # (1. Build the Docker image using `docker build -t task-navigator .`.)

[//]: # (2. Run the Docker container using `docker run -p 8000:80 task-navigator`.)

[//]: # (## Version Control with Git)

[//]: # ()
[//]: # (Task Navigator uses Git for version control. To clone the repository, use `git clone`. To create a new branch, use `git branch`. To switch to a branch, use `git checkout`. To commit changes, use `git commit`. To push changes to the remote repository, use `git push`.)

## License

Task Navigator is licensed under the [MIT License](LICENSE).
