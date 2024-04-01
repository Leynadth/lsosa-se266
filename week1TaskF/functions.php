<?php

function dd($data)
{
    echo '<pre>';
    die(var_dump($data));
    echo '</pre>';

}

function ageVerification($data)
{
    if($data > 21)
    {
        echo 'You can come in';
    }
    else if ($data < 21)
    {
        echo 'you arent old enough';
    }
}