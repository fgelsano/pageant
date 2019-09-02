<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="vendor/animate.css/animate.min.css">
    <link rel="stylesheet" href="contents/fonts/BerkshireSwash-Regular.ttf">
    <link rel="stylesheet" href="contents/fonts/Montserrat/Montserrat-Black.ttf">

    <style type="text/css">
        @font-face{
            font-family: "monserat";
            src: url("contents/fonts/Montserrat/Montserrat-Black.ttf");
        }
    </style>
    

    <link rel="stylesheet" href="contents/css/style.css">
    <title>Top 5 <?php echo $_GET['cat'] ?></title>
</head>
<body>
    <section class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="overlay">
                </div>
                <video autoplay muted loop id="videoBackground">
                    <source src="video_background.mp4" type="video/mp4">
                </video>
            </div>
        </div>
    </section>
    <section class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="image-content" style = "width: 55%;margin:0 auto;">
                    <?php 
                        $cat = strtolower($_GET['cat']);
                        $cat = str_replace(" ", "", $cat);

                    ?>
                    <?php if (isset($_GET['cat'])): ?>
                        <img class="image-top" src="contents/image/<?php echo $cat; ?>.png" alt="" srcset="">
                    <?php else: ?>
                        <h2 style="color:#fff;text-align:center;border-bottom:4px solid #fc0;font-size: 10em;"><?php echo $_GET['cat'] ?></h2>
                    <?php endif ?>
                    
                    <!-- <img class="image-top" src="contents/image/logo_evening.png" alt="" srcset=""> -->
                    
                </div>
                
                <div class="content">
                    <!-- <h1><?php echo $_GET['cat']; ?> Category</h1> -->
                    <div id = "showcandidate" class="content-item">
                        <h1 id="candidate1" class="hidden candidate">Vivamus Suscipit</h1>
                        <h1 id="candidate2" class="hidden candidate">Donec Rutrum</h1>
                        <h1 id="candidate3" class="hidden candidate">Curabitur Arcu</h1>
                        <h1 id="candidate4" class="hidden candidate">Accumsan Imperdiet</h1>
                        <h1 id="candidate5" class="hidden candidate">Curabitur Non</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="vendor/jquery/dist/jquery.js"></script>
    <script src="script/script.js"></script>
</body>
</html>