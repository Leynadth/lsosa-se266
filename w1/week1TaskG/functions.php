<?php

function fizzBuzz($num){
    if ($num % 2 == 0 && $num % 3 == 0)
    {
        echo 'FizzBuzz';
    }
    else if ($num % 2 == 0){
        echo 'Fizz';
    }
    else if ($num % 3 == 0){
        echo 'Buzz';
    }
    else {
        echo $num;
    }
}