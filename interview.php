<?php
var_dump('Hello');


spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});
