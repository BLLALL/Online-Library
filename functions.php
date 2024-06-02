<?php


// use Core\Response;

const NOT_FOUND = 404;
const FORBIDDEN = 403;
function dd($value)
{
    echo "<pre>";
    ?> <h1> <?php var_dump($value); ?></h1>
    <?php
    echo "</pre>";

    die();
}


function date_comp($book1, $book2) {
    $date1 = strtotime($book1['publishing_date']);
    $date2 = strtotime($book2['publishing_date']);
    return $date2 - $date1;
}

function authorize($condition, $status = FORBIDDEN)
{
    if (! $condition) {
        // abort($status);
        
    }
}


