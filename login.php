<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/admin/styles/styles.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
<?php
require_once 'header.php';
?>

<h2>
    Welcome to blog
</h2>

<div class="sign-container">
    <form action="" method="post" class="sign-form">

        <div><input type="text" name="name" placeholder="Login"></div>
        <div> <input type="password" name="password" placeholder="Lösenord"></div>
        <div class="sign-inputs"><input name="login" type="submit" value="login">
            <input name="register" type="submit" value="register"></div>





    </form>
</div>

<?php
require_once 'db.php';
session_start();

echo  $_SERVER['DOCUMENT_ROOT'];;


class NewUser
{
    public $name;
    public $password;
    public $dataDB;

    public function __construct($n, $p, $conn)
    {
        $this->name = $n;
        $this->password = $p;
        $this->conn=$conn;

    }

    public function Register($conn)
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $checkIfNameExist = "Select * FROM  user WHERE username = '".$this->name.
                "'";


        $result = mysqli_query($conn, $checkIfNameExist)or trigger_error(mysqli_error());
        $num = mysqli_num_rows($result);

        if($num === 0){

            echo "<br>";
            $stmt =$conn->prepare("INSERT INTO user ( username , password) VALUES (?, ?)");
            $stmt->bind_param("ss", $this->name, $this->password);
            $stmt->execute();
//            $_SESSION['NAME'] = $this->name;


        }

        return $num;


    }

    public function appendData()
    {

    }

    public function Login($conn)
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $checkIfNameExist = "Select ALL * FROM  user WHERE username = '".$this->name.
                "'";


        $result = mysqli_query($conn, $checkIfNameExist)or trigger_error(mysqli_error());
        $result = mysqli_fetch_assoc($result);



        if($result['username']===$this->name && $result['password']===$this->password){
            $_SESSION['user_active'] = $result;
            echo "<script>window.close();</script>";
            echo $result['username']===$this->name;
            echo $result['password']===$this->password;

            return true;
        }




//        $dataDB = $this->dataDB;
//        $trashdbArray = explode(";", $dataDB);
//        array_pop($trashdbArray);
//        $newDBArray = array_combine(
//                array_filter($trashdbArray, function ($key) {
//                    return $key % 2 == 0;
//                }, ARRAY_FILTER_USE_KEY),
//                array_filter($trashdbArray, function ($key) {
//                    return $key % 2 != 0;
//                }, ARRAY_FILTER_USE_KEY)
//        );
//
//
//        return $newDBArray;
    }

    public function verifyUser($data, $name)
    {


    }

}


$toLower = strtolower($_POST['name']);
$withoutWhiteSpace = str_replace(' ', '', $toLower);
if (isset($_POST['register']) && !empty($_POST['name']) && !empty($_POST['password'])) {
    echo $_POST['name'] . $_POST['password'];

    $init = new NewUser($withoutWhiteSpace, $_POST['password'], $conn);
    $init->Register($conn);
    echo "<pre>";
    $num = $init->Register($conn);
    print_r($_SESSION);

//    $dbArray = $init->createArray();
//    if (array_key_exists($withoutWhiteSpace, $dbArray)) {
//        echo '<footer><div ><p>' . 'Användarnamn finns redan' . '</p></div></footer>';
//    } else {
//        echo '<footer><div ><p class="success">' . $_POST['name'] . " är registrerad som användare" . "</p></div></footer>  ";
//        $init->appendData();
//    }
}
if( isset( $_POST['login']) && !empty($_POST['login']) && !empty($_POST['name']) && !empty($_POST['password'])){
    $init = new NewUser($withoutWhiteSpace,$_POST['password'],$conn);
    $bool = $init->Login($conn);
    $_SESSION['access'] =$bool;
    echo '<br>'. '   '.     gettype($_SESSION['access']);
    header("location:minasidor.php");
}
?>

</body>
</html>


