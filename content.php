<div class="content-grid">

    <?php

    class DisplayPosts
    {
        public function DisplayUserPosts($conn)
        {
            $checkIfNameExist = "select * from post order by id desc limit 20;";
            $result = mysqli_query($conn, $checkIfNameExist) or trigger_error(mysqli_error());
            echo '<div class="row">';
            while ($multipleRows = mysqli_fetch_assoc($result)) {
                $multipleObjects[] = $multipleRows;

                echo '<div>';
                echo '<a href="singlepost.php?' . http_build_query($multipleRows) . '"><div class="card-group d-flex"' . $multipleRows['id'] . '">';
                echo '<div class = "article card">';
                echo '<h4 class="card-title">' . $multipleRows['title'], '</h3>';
                echo '<img src="admin/UPLOADS/' . $multipleRows['image'] . '" class="image-post-index" >';
                echo '<p class="hide">' . $multipleRows['content'] . '</p>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
                echo '</div>';

            }
            echo '</div>';
        }

        public function DisplayCurrentPost($conn, $data)
        {
            $checkIfNameExist = "select * from post WHERE  id=" . $data . ";";
            $result = mysqli_query($conn, $checkIfNameExist) or trigger_error(mysqli_error());
            while ($multipleRows = mysqli_fetch_assoc($result)) {
                $multipleObjects[] = $multipleRows;
                echo '<div class="container-xs">';
                echo '<div class="xs-title">
                        <h5>'.$multipleRows['title'].'</h5>
                    </div>';
                echo '<div class="cover-xs">
                        <img src="admin/UPLOADS/' . $multipleRows['image'] . '" alt="">
                    </div>';
                echo ' <div class="xs-content">
                        <p>'.$multipleRows['content'].'</p>
                    </div>';
                echo '</div>';
            }


        }
    }

    if (!isset($_GET['currentpost'])) {
        $initiateUsersPost = new DisplayPosts();
        $initiateUsersPost->DisplayUserPosts($conn);
    } else {
        $initiateUsersPost = new DisplayPosts();
        $initiateUsersPost->DisplayCurrentPost($conn, $_GET['currentpost']);
    }

    ?>


</div>
