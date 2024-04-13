<?php
require 'functions.php';

foreach (range(1, 100) as $number) {
    echo fizzBuzz($number) . PHP_EOL;
}

require 'index.view.php';