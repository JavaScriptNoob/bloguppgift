<header>
    <nav class = "header-nav">


        <?php
        session_start();
        $data = $_SESSION['user_active'];
        echo  $_SERVER['HTTP_HOST'];
        echo dirname(__FILE__);
        echo $currentplace = str_replace('\\', '/', $_SERVER['HTTP_HOST']);
        echo '<br>';
        echo $url =  $_SERVER['REQUEST_URI'];


        if ($_SESSION['access'] === true) {

            echo '<ul class="container-navbar">
            <li class ="list-container">
                <a href="'.$currentplace.'/admin/useracc.php">
                    <img src="/admin/UPLOADS/' . $data['image'].'" alt="" class="user-image" >
                    <span class="user-name">'.$data['username'].'</span>
                </a>
                
            </li>
            <li class="list-container-2">
            
            <a href="admin/minasidor.php">HEM</a>
            <a href="logout.php">Logga ut</a>
            </li>
        </ul>';

        }elseif(!isset($_SESSION['access'])|| empty($_SESSION)){

            echo '<ul class="container-navbar">
            <li class ="list-container">
                <a href="'.$currentplace.'/index.php">Hem</a>
                
            </li>
            <li class="list-container">
            
            
            <a href="/login.php">Logga in</a>
            </li>
        </ul>';
        }elseif(!isset($_SESSION['access']) && strpos($url,'login') !== false|| empty($_SESSION)){

        }

        ?>

    </nav>
</header>



