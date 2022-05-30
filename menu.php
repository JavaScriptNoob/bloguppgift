<div class="aside">
    <div class="aside-container">
        <h4>Our Blogs</h4>
        <ul>
            <?php

            class DisplayBloggers
            {
                public function DisplayBlogersName($conn)
                {
                    $checkIfNameExist = "select * from user order by id desc limit 10;";
                    $result = mysqli_query($conn, $checkIfNameExist) or trigger_error(mysqli_error());
                    while ($multipleRows = mysqli_fetch_assoc($result)) {

                        echo '<li>';
                        echo '<div>';
                        echo '<a href="index.php?'. http_build_query($multipleRows) . '"><div class="card-group d-flex"' . $multipleRows['id'] . '">';
                        echo '<p>'.$multipleRows['username'].'</p>';
                        echo '</div>';
                        echo '</a>';
                        echo '</div>';
                        echo '</li>';


                    }
                }

            }
            class  DisplayUsersPosts
            {
                public function DisplayPosts($conn, $data)
                {
                    $checkIfNameExist = "select * from post   where  userId = ".$data.";";
                    $result = mysqli_query($conn, $checkIfNameExist) or trigger_error(mysqli_error());
                    while ($multipleRows = mysqli_fetch_assoc($result)) {

                        echo '<li>';
                        echo '<div>';
                        echo '<a href="index.php?currentpost=' .$multipleRows['id'] .'&currentuser='.$multipleRows['userId']. '"><div class="card-group d-flex"' . $multipleRows['id'] . '">';
                        echo '<p>' . $multipleRows['title'] . '</p>';
                        echo '</div>';
                        echo '</a>';
                        echo '</div>';
                        echo '</li>';
                    }
                }
            }

//            $str = 'http://localhost:8888/App.php#?ID=1S';
//            $temp = explode( "?", $str );
//            $result = explode( "=", $temp['1'] );
//            echo $result['1'];

            if(!isset($_GET['id'])){
                $initiateBloggers = new DisplayBloggers();
                $initiateBloggers->DisplayBlogersName($conn);
            }else{
                $initiateBloggers = new DisplayUsersPosts();
                $initiateBloggers->DisplayPosts($conn, $_GET['id']);
            }
            ?>




        </ul>
    </div>
</div>