<?php
    require_once 'functions.php';

    // Validerar $_GET[$key], ska vara ett heltal 1 eller större
    // Returnerar heltalet eller false om det inte var ett heltal
    function validateNumberInput($key)
    {
        if(empty($_GET[$key]))
            return false;
        return filter_var($_GET[$key], FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);
    }

    // Hämtar ut eventuella värden från url-parametrarna
    $blogger = validateNumberInput('id');
    $post = validateNumberInput('post');

    // När vi bygger upp länken med url-parameterar så behöver vi
    // antingen '?post=' om vi ska ha en lista med inlägg
    // eller '?id=' om vi ska ha en lista med bloggare
    $query = '?post=';

    // Inlägg är valt, vi hämtar vem som äger inlägget
    if($post)
        $blogger = getOwnerOfPost($post);

    // Vi har en bloggare som vi ska hämta inlägg för
    if($blogger)
        $menuArray = getAllPostsFor($blogger);

    // Vi har inget i listan med menyelement
    // Vi hämtar i så fall alla bloggare
    if(empty($menuArray))
    {
        $menuArray = getBloggers();
        $query = '?id=';
    }

    // Här skriver vi ut menyn
    echo "<nav><ul>";
    // Loopa igenom arrayen, nyckel är id och värde är inläggets titel eller bloggarens namn
    // Exempel om bloggare ska skrivas ut:  <li><a href="login.php?id=1">Anna</a></li>
    // Exempel om inlägg ska skrivas ut:    <li><a href="login.php?post=4">Fjärde inlägget</a></li>
    foreach($menuArray as $id => $name)
    {
        echo '<li><a href="login.php' . $query . htmlspecialchars($id) . '">' . htmlspecialchars($name) . '</a></li>';
    }
    echo "</ul></nav>";


