<header>
    <nav class = "header-nav">


        <?php
        session_start();
        $data = $_SESSION['user_active'];

        class UserData
        {


        }

        if ($_SESSION['access'] === true) {

            echo '<ul class="container">
            <li class ="list-container">
                <a href="useracc.php">
                    <img src="UPLOADS/' . $data['image'] . '" alt="" class="user-image" width="30">
                    <span class="user-name">'.$data['username'].'</span>
                </a>
                
            </li>
            <li class="list-container">
            <a href="logout.php">Logga ut</a>
            </li>
        </ul>';

        }

        ?>

    </nav>
</header>



