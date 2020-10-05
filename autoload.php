<?php

function Config() {
    require "includes/config.php";
}

function Database() {
    require "includes/DB.php";
}


spl_autoload_register("Config");
spl_autoload_register("Database");

$db = new DB();

?>