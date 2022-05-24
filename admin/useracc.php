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
<!--&& isset($_POST['description']) &&-->
<!--isset($_FILES['file']) &&-->
<!--$_FILES['file']['size'] > 1-->
<?php
require_once '../db.php';
session_start();
include('../header.php');

$imagePath='UPLOADS/Group_36.png';
if(isset($_POST['update'])){


    if (isset($_POST["update"]) && isset($_POST['description']) &&
            isset($_FILES['file']) &&
            !empty($_POST['description']) && $_FILES['file']['size'] > 1 ) {
        $allow = array("jpg", "jpeg", "gif", "png");

        $todir = 'UPLOADS/';


//        Bild uppladdning

        if (!!$_FILES['file']['tmp_name']) // is the file uploaded yet?
        {

            $info = explode('.', strtolower($_FILES['file']['name'])); // whats the extension of the file

            if (in_array(end($info), $allow)) // is this file allowed
            {
                if (move_uploaded_file($_FILES['file']['tmp_name'], $todir . basename($_FILES['file']['name']))) {

                }
            } else {
                // error this file ext is not allowed
            }
        }

        $img = $_FILES["file"]["name"];

        $content = $_POST["description"];


//                header("location:minasidor.php");
            $stmt = $conn->prepare("UPDATE `user` SET  `description` = ?, `image`=?  WHERE `id` = ?;");
            $stmt->bind_param("ssi", $content, $img, $_SESSION['user_active']['id']);


          $stmt->execute();


        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $checkIfNameExist = "Select ALL * FROM  user WHERE id = '".$_SESSION['user_active']['id'].
                "'";


        $result = mysqli_query($conn, $checkIfNameExist)or trigger_error(mysqli_error());
        $result = mysqli_fetch_assoc($result);




            $_SESSION['user_active'] = $result;

            $imagePath = 'UPLOADS/'.$_SESSION['user_active']['image'];

}}
?>

<div class="image-upload">
    <form action="" method="post" enctype="multipart/form-data">


        <div class="rov form-group">
            <div class="form-main-text">
                <label for="file-input">
                    <img src="<?=$imagePath?>"/>
                </label>

                <input id="file-input" name="file" type="file" />
            </div>
        </div>

        <div class="rov form-group">
            <div class="form-main-text">
                <label for="description"> Description</label>
                <textarea name="description" id="description" cols="70" rows="10"><?=$_SESSION['user_active']['description']?></textarea>
            </div>
        </div>
        <div class="rov form-group">
            <div class="form-title">
                <input type="submit" name="update" value="update">
            </div>
        </div>
    </form>
</div>
</body>
</html>