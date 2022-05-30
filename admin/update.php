<?php
require_once '../db.php';


include '../header.php';

session_start();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$checkIfNameExist = "Select * FROM  post WHERE id = '". $_SESSION['hidden'].
        "'";
$result = mysqli_query($conn, $checkIfNameExist)or trigger_error(mysqli_error());
$data = mysqli_fetch_assoc($result);


if($_POST['update']==='update'){
 function AppendNewData($conn)
{
    if (isset($_POST["update"]) && isset($_POST['textarea']) &&
            isset($_FILES['file']) && isset($_POST['title']) &&
            !empty($_POST['textarea']) && $_FILES['file']['size'] > 1 && !empty($_POST['title'])) {
        $allow = array("jpg", "jpeg", "gif", "png");
        print_r($_FILES['file']);
        $todir = 'UPLOADS/';


//        Bild uppladdning



            $info = explode('.', strtolower($_FILES['file']['name'])); // whats the extension of the file

            if (in_array(end($info), $allow)) // is this file allowed
            {
                if (move_uploaded_file($_FILES['file']['tmp_name'], $todir . basename($_FILES['file']['name']))) {
                    echo $_FILES["file"]["name"] . 'aaaaa';
                }
            } else {
                // error this file ext is not allowed
            }


        $img = $_FILES["file"]["name"];
        $title = $_POST["title"];
        $content = $_POST["textarea"];
        echo "<pre>";
        echo $img;
        echo "</pre>";
        echo $img;
            if (strlen($img)>0){
//                header("location:minasidor.php");
                $stmt = $conn->prepare("UPDATE `post` SET `title`= ?, `content` = ?, `image`=?  WHERE `id` = ?;");
                $stmt->bind_param("sssi", $title, $content, $img, $_SESSION['hidden']);
                $stmt->execute();
                header('location:minasidor.php');

            }elseif(empty($img)){
               echo 'Välja bild';
            }


    }
}
AppendNewData($conn);

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/styles.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body>

<div class="container">
    <div class="center-container">
        <form enctype="multipart/form-data" action="" method="post">
            <div class="rov form-group">
                <div class="form-title">
                    <input type="text" name="title" value="<?=$data['title']?>">
                </div>
            </div>
            <div class="rov form-group">
                <div class="form-image">
                    <input type="file" name="file" value="">
                </div>
            </div>
            <div class="rov form-group">
                <div class="form-main-text">
                    <textarea name="textarea" rows="5"><?=$data['content']?></textarea>
                </div>
            </div>
            <div class="rov form-group">
                <div class="form-title">
                    <input type="submit" name="update" value="update">
                </div>
            </div>
        </form>
    </div>

</div>
</body>
</html>