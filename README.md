<h1 align="center">
  <img src="https://user-images.githubusercontent.com/50162243/231926644-cc40e9de-1978-4346-a7bd-63b404e1f09d.png">
</h1>

<h3 align="center">An examination system. Built using <a href="https://laravel.com" target="_blank">Laravel</a>.</h3>

<h3>
<p align="center">
  <a href="#about">About</a> •
  <a href="#demo">Demo</a> •
  <a href="#installation">Installation</a> •
  <a href="#how-to-use">How To Use</a> 
</p>
</h3>



## About
This project is a proposed examination system for Philippine Marines. It features a unique system that is tailored to the department's needs. It is made with Laravel 7. The frontend was made using vuejs and has a custom made pagination. The main UI is styled using bootstrap. For the database, it uses Mysql 5.7. The whole program is containerized including the database using docker compose to easily reproduce the environment required by the program. A `dev` variant of docker compose and dockerfile is included intended for development of this system.

## Demo
<div align="center">
 <img src="https://marvielb.com/images/ss-exam.png"/>
</div>
Click <a href="https://exam.marvielb.com">here</a> to experience a live demo

## Installation
The only requirement is docker. Everything is containerized so you don't have to install anything besides it.

```bash
# Clone this repository
$ git clone https://github.com/marvielb/laravel_marines.git

# Go into the repository
$ cd laravel_marines

# Copy .env.example to .env or rename it to .env and configure the variables
$ cp .env.example .env

# Run docker compose
$ docker compose up

# Run the seeder for initial seeding of test data
$ docker compose exec web php artisan migrate:fresh --seed
```

## How To Use

Assuming you have followed the installation instructions, the program will be served on `http://localhost:8000/`.  You can go right ahead and login using the following credentials:

```
Username: 123
Password: password
```

After that, head over to the code generator to generate a exam code. Just input `123` to the Marines Exam Code for the sample data. Then head over to Exam Sheet to Take an Exam and paste the generated exam code.
