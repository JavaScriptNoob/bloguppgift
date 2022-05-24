<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/bootstrap.min.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
<?php
include('../header.php');
?>
<div><h1>Welcome to my home page!</h1>
    <div class="container">
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">


               <?php
            session_start();

            if ( !$_SESSION['access'] === true ){

                header("location:login.php");
            }else{
            include('admin.php');
            }
            ?> </div>
        </div>
    </div>

</body>
</html>