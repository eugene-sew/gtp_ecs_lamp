<!DOCTYPE html>
<html lang="en">
<head>
    <title>BMDB - Movie Streaming</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
            background: #141414;
            color: #fff;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
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
        .hero {
            background: linear-gradient(rgba(20,20,20,0.8), rgba(20,20,20,0.8)), url('./siteImages/movies.jpg') center/cover no-repeat;
            min-height: 70vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 60px 20px 40px 20px;
        }
        .hero-title {
            font-size: 3em;
            font-weight: bold;
            color: #fff;
            margin-bottom: 20px;
            letter-spacing: 2px;
        }
        .hero-tagline {
            font-size: 1.5em;
            color: #fff;
            margin-bottom: 40px;
        }
        .browse-btn {
            background: #e50914;
            color: #fff;
            font-size: 1.3em;
            padding: 16px 48px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            letter-spacing: 1px;
            transition: background 0.2s;
            text-decoration: none;
            display: inline-block;
        }
        .browse-btn:hover {
            background: #b0060f;
            color: #fff;
            text-decoration: none;
        }
        @media (max-width: 600px) {
            .hero-title { font-size: 2em; }
            .hero-tagline { font-size: 1.1em; }
            .browse-btn { font-size: 1em; padding: 12px 24px; }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">BMDB</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="./movies/home.php">Movies</a></li>
        </ul>
    </div>
</nav>

<div class="hero">
    <div class="hero-title">Unlimited Movies, Anytime</div>
    <div class="hero-tagline">Dive into our collection of movies. Stream your favorites instantly.</div>
    <a href="./movies/home.php" class="browse-btn">Browse Movies</a>
</div>

<div class="must-watch container-fluid" style="margin-top: 40px;">
    <h2 style="color:#e50914; text-align:center; margin-bottom:32px; font-weight:bold; letter-spacing:1px;">Must Watch Movies</h2>
    <div class="row" style="display: flex; flex-wrap: wrap;">
        <div class="col-xs-12 col-sm-2" style="flex:1 1 16%; max-width:16.666%; min-width:180px;">
            <div style="background:#222; border-radius:12px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.15); height:100%; display:flex; flex-direction:column;">
                <img src="./siteImages/movies.jpg" alt="Movie Poster" style="width:100%; height:120px; object-fit:cover;">
                <div style="padding:16px; flex:1; display:flex; flex-direction:column;">
                    <div style="font-weight:bold; color:#fff; margin-bottom:8px;">The Red Mirage</div>
                    <div style="color:#aaa; font-size:0.95em;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque euismod.</div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-7" style="flex:4 1 66%; max-width:66.666%; min-width:320px;">
            <div style="background:#181818; border-radius:12px; overflow:hidden; box-shadow:0 4px 16px rgba(229,9,20,0.15); height:100%; display:flex; flex-direction:column;">
                <img src="./siteImages/movies.jpg" alt="Movie Poster" style="width:100%; height:220px; object-fit:cover;">
                <div style="padding:24px; flex:1; display:flex; flex-direction:column;">
                    <div style="font-weight:bold; color:#e50914; font-size:1.5em; margin-bottom:12px;">Nightfall Symphony</div>
                    <div style="color:#fff; font-size:1.1em;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, urna eu tincidunt consectetur, nisi nisl aliquam enim, eget cursus enim urna euismod nisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-2" style="flex:1 1 16%; max-width:16.666%; min-width:180px;">
            <div style="background:#222; border-radius:12px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.15); height:100%; display:flex; flex-direction:column;">
                <img src="./siteImages/movies.jpg" alt="Movie Poster" style="width:100%; height:120px; object-fit:cover;">
                <div style="padding:16px; flex:1; display:flex; flex-direction:column;">
                    <div style="font-weight:bold; color:#fff; margin-bottom:8px;">Echoes of Tomorrow</div>
                    <div style="color:#aaa; font-size:0.95em;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque euismod.</div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<?php
// Simple .env loader
function loadEnv(
    $path = __DIR__ . '/.env'
) {
    if (!file_exists($path)) return;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($key, $value) = array_map('trim', explode('=', $line, 2));
        if (!getenv($key)) {
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
}

loadEnv();
?>