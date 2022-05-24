<?php
// Hårdkodade funktioner bara så vi kan testa koden ovan
// Data ska ju hämtas från databasen egentligen
function getOwnerOfPost($post)
{
    $id = 0;
    switch($post)
    {
        case 1:
            $id = 3;    // Britta
            break;
        case 2:
            $id = 2;    // Doris
            break;
        case 5:
        case 3:
            $id = 4;    // Clara
            break;
        case  4:
            $id = 1;    // Anna
            break;
    }
    return $id;
}

function getAllPostsFor($blogger)
{
    switch($blogger)
    {
        case 1: // Anna
            return array(4 => 'Fjärde inlägget');
        case 2: // Doris
            return array(2 => 'Andra inlägget');
        case 3: // Britta
            return array(1 => 'Första inlägget');
        case  4: // Clara
            return array(3 => 'Tredje inlägget', 5 => 'Senaste inlägget');
    }
}

function getBloggers()
{
    return array(
        1 => 'Anna',
        2 => 'Doris',
        3 => 'Britta',
        4 => 'Clara');
}
?>