# Todo App - DMS

This is a Todo application built with Laravel, Vue.js, and Tailwind CSS.


https://github.com/RobbeSaelens/DMS-TodoApp/assets/43599480/0866df28-aaed-47fc-807a-4ced49377e4a




## Prerequisites

Before starting the project, ensure that Docker Desktop is installed and running on your machine.

## Installing the project

Clone the repository to your local device.
Execute the following commands
```bash
npm i
composer install
```
Insert the .env file that is given by mail
```bash
Docker on Windows = bash ./vendor/laravel/sail/bin/sail up
Docker on Mac = ./vendor/bin/sail up
```
If it is the first time running the project -> run these commands to make the 'todos' table & fill the table with some data
```bash
php artisan migrate
php artisan db:seed --class=TodoSeeder
```

## Running the Project

To run the project, execute the following commands in your terminal:

```bash
php artisan serve
npm run dev
./vendor/bin/sail up / ./vendor/laravel/sail/bin/sail up
```

Now the project can be used on [http://localhost](http://localhost:8000/)

## Backend (Laravel)

The backend of this application is built using Laravel.
All requests are handled through the /admin route. For example, to access tasks, you can make requests to '/admin/tasks'.
SwaggerUI is integrated to provide documentation for all available requests under the '/admin' route, along with detailed descriptions.

## Frontend (Vue.js)

Vue.js is used for the frontend of the application.
The main route of the application is '/', which displays the ToDo list.

Implemented Functionalities:
- Index: Provides an overview of all tasks.
- Create: Allows users to add new tasks.
- Store: Saves new tasks to the database.
- Edit: Enables users to edit existing tasks.
- Update: Updates existing tasks in the database.
- Delete: Allows users to delete tasks.

## Authentication

Authentication functionality has not been implemented in this application.

## Styling

Tailwind CSS is used for styling the application.

## Vue Components

Various Vue components have been created to organize and manage the frontend of the application. Additionally, the Lucide.dev online component library has been utilized for icons.

## Validation

Validation is implemented using Laravel Validation and Request files. Here are the validation rules:
  - When creating a new task, the title is required, must be a maximum of 50 characters, and cannot contain numbers. The description is also required.
  - When updating a task, no fields are required. However, the title must still be a maximum of 50 characters and cannot contain numbers.
