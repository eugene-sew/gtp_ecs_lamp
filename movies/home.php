<!DOCTYPE html>
<html lang="en">
<head>
    <title>BMDB - Movies</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
            background: #141414;
            color: #fff;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }
        .navbar {
            background: #111;
            border: none;
        }
        .navbar-brand {
            color: #e50914 !important;
            font-weight: bold;
            font-size: 2em;
            letter-spacing: 2px;
        }
        .jumbotron {
            background: linear-gradient(rgba(20,20,20,0.7), rgba(20,20,20,0.7)), url('./images/background_image.jpg') center/cover no-repeat;
            color: #fff;
            border-radius: 0;
            margin-bottom: 30px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.3);
        }
        .jumbotron h1 {
            color: #fff;
            font-size: 3em;
            font-weight: bold;
            letter-spacing: 2px;
            text-shadow: 0 2px 8px #000;
        }
        .nav-pills > li > a, .dropdown-menu > li > a {
            background: #222;
            color: #fff;
            border-radius: 4px;
            margin: 2px 0;
            transition: background 0.2s;
        }
        .nav-pills > li.active > a, .nav-pills > li > a:hover, .dropdown-menu > li > a:hover {
            background: #e50914 !important;
            color: #fff !important;
        }
        .panel-info {
            background: #222;
            border-color: #333;
        }
        .panel-info > .panel-heading {
            background: #e50914;
            color: #fff;
            font-weight: bold;
            font-size: 1.3em;
            letter-spacing: 1px;
        }
        .form-control, .input-group-addon {
            background: #222;
            color: #fff;
            border: 1px solid #333;
        }
        .form-control:focus {
            border-color: #e50914;
            box-shadow: 0 0 4px #e50914;
        }
        .input-group-addon {
            background: #e50914;
            color: #fff;
            border: none;
        }
        .movie-table {
            background: #181818;
            color: #fff;
        }
        .movie-table th, .movie-table td {
            border-color: #333 !important;
        }
        .movie-table th {
            background: #222;
            color: #e50914;
            font-weight: bold;
        }
        .movie-table tr:hover {
            background: #222;
        }
        @media (max-width: 600px) {
            .jumbotron h1 { font-size: 2em; }
            .panel-info > .panel-heading { font-size: 1em; }
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script>
        function showFilm(str) {
            if (str.length == 0) {
                document.getElementById("data").innerHTML = "";
                document.getElementById("pnl-result").style.display = "block";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("data").innerHTML = this.responseText;
                        document.getElementById("pnl-result").style.display = "none";
                    }
                };
                xmlhttp.open("GET", "functions/fetch.php?search=" + str, true);
                xmlhttp.send();
            }
        }
    </script>
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">BMDB</a>
        </div>
        <ul class="nav navbar-nav">
            <li ><a href="../index.php">Home</a></li>
            <li class="active"><a href="./home.php">Movies</a></li>
        </ul>
    </div>
</nav>

<?php
include("./includes/movieDatabase.php");
include("./functions/functions.php");
include("./functions/getmovie.php");
function get_result(){
    if (isset($_GET['genre'])){
        $result = $_GET['genre'];
        get_films($result);
    } elseif (isset($_GET['country'])){
        $result = $_GET['country'];
        get_country($result);
    } elseif (isset($_GET['director'])){
        $result = $_GET['director'];
        get_director($result);
    } elseif (isset($_GET['year'])){
        $result = $_GET['year'];
        get_year($result);
    } else {
        // Show all movies by default
        show_all_movies();
    }
}
?>

<div class="container">
    <div class="jumbotron" style="background-image: url('./images/background_image.jpg')">
        <h1 style="color: lightcyan">Browse Movies</h1>
    </div>
</div>
<div class="container">
    <ul class="nav nav-pills">
        <li class="active"><a href="home.php">Movie Collection</a></li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">By Genres
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <?php
                    getgenres();
                    ?>
                </ul>
        </li>

        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">By Directors
                <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <?php
                getDirectors();
                ?>
            </ul>
        </li>

        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">By Years
                <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <?php
                getYears();
                ?>
            </ul>
        </li>

        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">By Countries
                <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <?php
                getCountries();
                ?>
            </ul>
        </li>

        <li><a href="../admin_area/insert_movies.php">Add Movie</a></li>
    </ul>
    <br>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Search</span>
            <input type="text" name="searchText" class="form-control" id="searchText"
                   placeholder="Enter Movie Name" onkeyup="showFilm(this.value)">

        </div>
        <p> <span id="data"></span></p>
        <br>

    </div>

    <div class="panel-group" id="pnl-result">
        <div class="panel panel-info">
            <div class="panel-heading"><b>Movies</b></div>
            <div id="result"><?php get_result()?></div>
        </div>

    </div>
</div>



</body>
</html>


