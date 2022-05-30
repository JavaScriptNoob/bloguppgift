<div class="aside">

    <div class="aside-container">
        <h4>
            Info
        </h4>
        <ul class="aside-info">

            <?php

            class DisplayBloggersInfo
            {
                public function DisplayRandomBlogger($conn)
                {
                    $checkIfNameExist = "select * from user ORDER BY RAND() LIMIT 1;";
                    $result = mysqli_query($conn, $checkIfNameExist) or trigger_error(mysqli_error());
                    $multipleRows = mysqli_fetch_assoc($result);

                    echo '<li>';
                    echo '<div class="image-aside">
                    <img src="admin/UPLOADS/' . $multipleRows['image'] . '" alt="">
                    </div>';
                    echo '<div>';
                    echo '<p>' . $multipleRows['username'] . '</p>';
                    echo '</div>';
                    echo '<div>';
                    echo '<p>' . $multipleRows['description'] . '</p>';
                    echo '</div>';

                    echo '</li>';


                }

            }

            if (!isset($_GET['id']) && !isset($_GET['currentpost'])) {
                $initiateInfo = new DisplayBloggersInfo();
                $initiateInfo->DisplayRandomBlogger($conn);

            } elseif (isset($_GET['id'])) {

                echo '<li>';
                echo '<div class="image-aside">
                    <img src="admin/UPLOADS/' . $_GET['image'] . '" alt="">
                    </div>';
                echo '<div>';
                echo '<p>' . $_GET['username'] . '</p>';
                echo '</div>';
                echo '<div>';
                echo '<p>' . $_GET['description'] . '</p>';
                echo '</div>';

                echo '</li>';

            } elseif(isset($_GET['currentpost'])) {

                function getUser($conn, $user)
                {
                    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

                    $checkIfNameExist = "Select ALL * FROM  user WHERE id = '" . $user .
                            "'";


                    $result = mysqli_query($conn, $checkIfNameExist) or trigger_error(mysqli_error());
                    $result = mysqli_fetch_assoc($result);


                    echo '<li>';
                    echo '<div class="image-aside">
                    <img src="admin/UPLOADS/' .$result['image'] . '" alt="">
                    </div>';
                    echo '<div>';
                    echo '<p>' . $result['username'] . '</p>';
                    echo '</div>';
                    echo '<div>';
                    echo '<p>' . $result['description'] . '</p>';
                    echo '</div>';

                    echo '</li>';

                }

                getUser($conn,$_GET['currentuser']);
            }

            ?>
        </ul>
    </div>
</div>