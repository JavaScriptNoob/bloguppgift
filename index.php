<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/styles/styles.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <title>The blog</title>
</head>
<body>
<?php
require 'db.php';

require_once "header.php";
echo '<br>';
print_r( $_SESSION);
echo '<br>';
print_r( $_GET);
echo '<br>';
print_r( $_POST);
echo '<div class="main-container">';
echo '<div class="grid-container" >';
echo '<div  class="grid-wrapper">';
require_once "menu.php";
echo '</div>';
echo  '<div  class="grid-wrapper">';
require_once "content.php";
echo '</div>';
echo  '<div  class="grid-wrapper">';
require_once "info.php";
echo '</div>';

echo '</div>';
echo '</div>';

?>


</body>
</html>
