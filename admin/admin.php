<?php
session_start();
require '../db.php';
$userData = $_SESSION['user_active'];

class NewData
{


    public function AppendNewData($conn)
    {
        if (isset($_POST["append"]) && isset($_POST['textarea']) &&
                isset($_FILES['file']) && isset($_POST['title']) &&
                !empty($_POST['textarea']) && $_FILES['file']['size'] > 1 && !empty($_POST['title'])) {
            $allow = array("jpg", "jpeg", "gif", "png");
            print_r($_FILES['file']);
            $todir = 'UPLOADS/';


//        Bild uppladdning

            if (!!$_FILES['file']['tmp_name']) // is the file uploaded yet?
            {

                $info = explode('.', strtolower($_FILES['file']['name'])); // whats the extension of the file

                if (in_array(end($info), $allow)) // is this file allowed
                {
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $todir . basename($_FILES['file']['name']))) {
                        echo $_FILES["file"]["name"] . 'aaaaa';
                    }
                } else {
                  echo 'rrrrrrrrrrrrrrrrrrrrrrrrrrrrr';
                }
            }

            $img = $_FILES["file"]["name"];
            $title = $_POST["title"];
            $content = $_POST["textarea"];
            $id = $_SESSION['user_active']['id'];
            $checkIfNameExist = "Select * FROM  post WHERE content = '" . $content .
                    "'";
            $result = mysqli_query($conn, $checkIfNameExist) or trigger_error(mysqli_error());
            if (mysqli_num_rows($result) === 0) {
                $stmt = $conn->prepare("INSERT INTO post (title, content, image, userId) VALUES (?,?,?,?)");
                $stmt->bind_param("sssi", $title, $content, $img, $id);


                $stmt->execute();
            }
        }
    }

}

class Display
{
    public function DisplayData($conn, $userData)
    {
        $checkIfNameExist = "Select ALL * FROM  post WHERE userid = " . $userData['id'];
        $result = mysqli_query($conn, $checkIfNameExist) or trigger_error(mysqli_error());
        while ($multipleRows = mysqli_fetch_assoc($result)) {
            $multipleObjects[] = $multipleRows;

            echo '<div class="feature col" id="' . $multipleRows['id'] . '">';
            echo '<div class = "article">';
            echo '<h3>' . $multipleRows['title'], '</h3>';
            echo '<img src="UPLOADS/' . $multipleRows['image'] . '" class="image-post" >';
            echo '<p class="hide">' . $multipleRows['content'] . '</p>';
            echo '</div>';
            echo '<form action="" method="post">
            <input type="submit" name="someAction" value="delete"/>
            <input type=hidden name=id value="' . $multipleRows['id'] . '"/>
          
            </form>';
            echo '<form action="" method="post">
           
            <input type=hidden name=id value="' . $multipleRows['id'] . '"/>
            <input type="submit" name="someAction" value="update" />
            </form>';
            echo '</div>';
        }


    }
}

class  Delete
{

    public function DeleteData($conn, $userData)
    {
        $checkIfNameExist = "DELETE FROM post WHERE id ='{$_POST['id']}';";
        mysqli_query($conn, $checkIfNameExist) or trigger_error(mysqli_error());





    }
}


if (isset($_SESSION['user_active']) && !empty($_SESSION['user_active'])) {

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $initateDisplay = new Display();
    $initateDisplay = $initateDisplay->DisplayData($conn, $userData);


}

if($_POST['append']==='append'){
    echo 'append';
    $initateNewData = new NewData();
    $initateNewData = $initateNewData->AppendNewData($conn);
    header("location:minasidor.php");

}



if ($_POST['someAction'] === 'delete') {
    $initateDelete = new Delete();
    $initateDelete->DeleteData($conn, $userData);
    header("location:minasidor.php");
}elseif($_POST['someAction'] === 'update') {

    header("location:update.php");
    $_SESSION['hidden'] = $_POST['id'];
    echo $_SESSION['hidden'];
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
    <link rel="stylesheet" href="../css/bootstrap.min.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="center-container">
        <form enctype="multipart/form-data" action="" method="post">
            <div class="rov form-group">
                <div class="form-title">
                    <input type="text" name="title">
                </div>
            </div>
            <div class="rov form-group">
                <div class="form-image">
                    <input type="file" name="file">
                </div>
            </div>
            <div class="rov form-group">
                <div class="form-main-text">
                    <textarea name="textarea"></textarea>
                </div>
            </div>
            <div class="rov form-group">
                <div class="form-title">
                    <input type="submit" name="append" value="append">
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/JavaScript">

</script>
</body>
</html>
