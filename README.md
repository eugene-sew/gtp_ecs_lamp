# phpMySQLapp

A sample LAMP based web service stack.
LAMP stack is a popular open source web platform commonly used to run dynamic web sites and servers.
It includes Linux, Apache, MySQL, and PHP and is considered by many the platform of choice for development
and deployment of high performance web applications which require a solid and reliable foundation.

![Alt text](https://github.com/Anirban2404/phpMySQLapp/blob/master/homePage.JPG "Screen Shot")

### Setup Databases

- We are using MySQL as the database, so you need to Install MySQL and Configure MySQL properly.
- Install git and clone the repository.
- The \*.sql files are located in the mySqlDB folder.
- Create a database named `media` and set collation to `utf8_unicode_ci`.
- Import the `mySqlDB/combinedDB.sql` file, which will create all tables and populate them with initial data for both books and movies.
  You can use phpmyadmin to import or you can do it from the terminal:

```
mysql -u <username> -p media < mySqlDB/combinedDB.sql
```

### Setup WebApplication

- You have to install Apache2 and PHP and configure it.
- Install git and clone the repository.
- In order for Apache to find the file and serve it correctly, it must be saved to a very specific directory, which is called the "web root". In Ubuntu 16.04, this directory is located at /var/www/html/ -- copy the git source code inside it. Folder Structure will be like below.

```
ubuntu@mywebserver:/var/www/html$ tree
.
├── admin_area
│   ├── insertbook.php
│   ├── insert_books.php
│   ├── insertmovie.php
│   └── insert_movies.php
├── books
│   ├── functions
│   │   ├── fetch.php
│   │   ├── functions.php
│   │   └── getbook.php
│   ├── home.php
│   ├── images
│   │   └── background_image.jpg
│   └── includes
│       └── bookDatabase.php
├── homePage.JPG
├── index.php
├── movies
│   ├── functions
│   │   ├── fetch.php
│   │   ├── functions.php
│   │   └── getmovie.php
│   ├── home.php
│   ├── images
│   │   └── background_image.jpg
│   └── includes
│       └── movieDatabase.php
├── mySqlDB
│   └── combinedDB.sql
├── README.md
└── siteImages
    ├── books.jpg
    └── movies.jpg
```

### Environment Variables & Docker Usage

The application uses environment variables for database configuration. When running in Docker, pass these variables using `-e` flags or an `.env` file:

**Example Docker run:**

```
docker run -e DATABASE_HOST=localhost -e DATABASE_USER=root -e DATABASE_PASSWORD=admin -e DATABASE_NAME=media my-php-image
```

**Or with a .env file:**

```
DATABASE_HOST=localhost
DATABASE_USER=root
DATABASE_PASSWORD=admin
DATABASE_NAME=media
```

Then run:

```
docker run --env-file .env my-php-image
```

The PHP code will automatically use these environment variables for database connections.

---

**Note:**

- The old `bookDB.sql` and `movieDB.sql` files are no longer needed; use `combinedDB.sql` for all data.
- Make sure your MySQL server is running and accessible from your container or host.

---

**Repository Source:**
This repository was originally sourced from [https://github.com/Anirban2404/phpMySQLapp#](https://github.com/Anirban2404/phpMySQLapp#)
