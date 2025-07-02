<!DOCTYPE html>
<html lang="en">
<head>
    <title>Insert Movie</title>
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
            background: linear-gradient(rgba(20,20,20,0.7), rgba(20,20,20,0.7)), url('../movies/images/background_image.jpg') center/cover no-repeat;
            color: #fff;
            border-radius: 0;
            margin-bottom: 30px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.3);
        }
        .jumbotron h1 {
            color: #fff;
            font-size: 2.5em;
            font-weight: bold;
            letter-spacing: 2px;
            text-shadow: 0 2px 8px #000;
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
        label {
            color: #e50914;
            font-weight: bold;
        }
        .btn-info, .btn-success, .btn-danger, .btn-warning {
            border: none;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .btn-info {
            background: #e50914;
        }
        .btn-info:hover {
            background: #b0060f;
        }
        .btn-success {
            background: #21d07a;
            color: #111;
        }
        .btn-success:hover {
            background: #1bb36a;
        }
        .btn-danger {
            background: #e50914;
        }
        .btn-danger:hover {
            background: #b0060f;
        }
        .btn-warning {
            background: #f5c518;
            color: #111;
        }
        .btn-warning:hover {
            background: #e4b007;
        }
        .form-group, .table {
            background: #181818;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        .collapse {
            background: #222;
            padding: 10px;
            border-radius: 4px;
        }
        .caption p {
            color: #fff;
        }
        @media (max-width: 600px) {
            .jumbotron h1 { font-size: 1.5em; }
            .form-group, .table { padding: 8px; }
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script>
        function addCountry(str) {
            document.getElementById("countries").innerHTML = "<option>" + str + "</option>"
        }
        function addDirector(str) {
            document.getElementById("directors").innerHTML = "<option>" + str + "</option>"
        }
        function addGenre(str) {
            if (str.length == 0) {
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET", "insertmovie.php?add_Genre=" + str, true);
                xmlhttp.send();
                window.location.reload();
            }
        }
        function _reset() {
            window.location.href = "insert_movies.php";
        }
    </script>
</head>
<body>

<?php
include("../movies/includes/movieDatabase.php");
include("../movies/functions/functions.php");
?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">BMDB</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="../index.php">Home</a></li>
            <li><a href="../movies/home.php">Movies</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="jumbotron" style="background-image: url('../movies/images/background_image.jpg')">
        <h1 style="color: lightcyan">Insert Movie</h1>
    </div>

    <form action="insert_movies.php" method="get" enctype="multipart/form-data">
        <div class="form-group">
            <label>Movie Name</label>
            <input type="text" name="movieName" class="form-control" placeholder="Enter Movie Name" required>
        </div>

        <div class="form-group">
            <label>Genre</label>
            <div class="row">
                <div class="col-xs-8">
                    <select class="form-control" multiple name="__genres[]" required>
                        <?php optgenres(); ?>
                    </select>
                </div>
                <div class="col-xs-4">
                    <button type="button" class="btn btn-info btn-md" data-toggle="collapse" data-target="#genre">Add Genre</button>
                    <div id="genre" class="collapse" style="margin-top:10px;">
                        <input type="text" id="genreT" name="genreT" class="form-control" placeholder="Enter Genre">
                        <input type="button" name="addG" class="btn btn-info" value="Add" onclick="addGenre(document.getElementById('genreT').value)">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Director</label>
            <div class="row">
                <div class="col-xs-8">
                    <select class="form-control" id="directors" name="directors" required>
                        <?php optdirectors(); ?>
                    </select>
                </div>
                <div class="col-xs-4">
                    <button type="button" class="btn btn-info btn-md" data-toggle="collapse" data-target="#director">Add Director</button>
                    <div id="director" class="collapse" style="margin-top:10px;">
                        <input type="text" id="directorT" name="directorT" class="form-control" placeholder="Enter Director Name">
                        <input type="button" name="addD" class="btn btn-info" value="Add" onclick="addDirector(document.getElementById('directorT').value)">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Release Year</label>
            <input type="number" name="releaseDate" class="form-control" placeholder="Enter Release Year" required/>
        </div>

        <div class="form-group">
            <label>Country</label>
            <div class="row">
                <div class="col-xs-8">
                    <select class="form-control" id="countries" name="countries" required>
                        <?php optCountries(); ?>
                    </select>
                </div>
                <div class="col-xs-4">
                    <button type="button" class="btn btn-info btn-md" data-toggle="collapse" data-target="#country">Add Country</button>
                    <div id="country" class="collapse" style="margin-top:10px;">
                        <input type="text" id="countryT" name="countryT" class="form-control" placeholder="Enter Country Name">
                        <input type="button" name="addCn" class="btn btn-info" value="Add" onclick="addCountry(document.getElementById('countryT').value)">
                    </div>
                </div>
            </div>
        </div>

        <div style="text-align:center; margin-top:30px;">
            <button type="submit" name="submit" class="btn btn-success" style="width:30%">Submit</button>
            &nbsp;&nbsp;&nbsp;
            <button type="reset" name="reset" class="btn btn-warning" style="width:30%" onclick="_reset()">Reset</button>
            &nbsp;&nbsp;&nbsp;
            <a href="../movies/home.php" class="btn btn-danger" style="width:30%">Cancel</a>
        </div>
        <br/>
    </form>
</div>

</body>
</html>

<?php
global $conn;
if (isset($_GET['genreT'])) {
    $catT = $_GET['genreT'];
    //echo $catT;
}
if (isset($_GET['directorT'])) {
    $directorT = $_GET['directorT'];
    //echo $authorT;
}
if (isset($_GET['countryT'])) {
    $countryT = $_GET['countryT'];
    //echo $countryT;
}

//getting values
if (isset($_GET['submit'])) {
    //echo "<h2>Your Input:</h2>";

    $movieName = $_GET['movieName'];
    //echo $bookName;

    if (isset($_GET['directors'])) {
        $director = $_GET['directors'];
        //echo $author;
    }
    $releaseDate = $_GET['releaseDate'];

    if (isset($_GET['countries'])) {
        $country = $_GET['countries'];
        //echo $country;
    }

    $sql = "INSERT INTO films (`_title`, `director`, `release_year`, `country`) VALUES ('$movieName', '$director' , '$releaseDate', '$country')";
//    echo $sql;
    if (mysqli_query($conn, $sql)) {
        //echo "New record created successfully";
    } else {
        echo "Error";
    }
    $outputsql = "INSERT INTO genre_film_relationship (film_id, genre_id) 
                    VALUES ( (select _id from films where _title='$movieName'),
                    (SELECT _id FROM genre where _title='";
    if (isset($_GET['__genres'])) {
        $a = 1;
        foreach ($_GET['__genres'] as $gen) {

            $gen_rel = $outputsql . $gen . "'))";
            //echo $gen_rel;
            if (mysqli_query($conn, $gen_rel)) {
                //echo "New record created successfully";
            } else {
                echo "Error";
            }
        }
    }
}

?>


