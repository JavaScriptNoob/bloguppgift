<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="admin/styles/styles.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<?php
include "header.php";

$postId = $_GET['id'];
$postImage = $_GET['image'];
$postTitle = $_GET['title'];
$postContent = $_GET['content'];
echo '<div class="post">
    <div class="container-sp">
        <div class="sp-cover-container">
        <img class="sp-cover-image" src="admin/UPLOADS/' . $postImage . '" alt="">
        </div>
    </div>
    <div class="sp-title">
        <h3>
               ' . $postTitle . '     </h3>
    </div>
    <div class="sp-content-body">
        <p>'.$postContent.'</p>
    </div>
</div>'

?>


</body>
</html>