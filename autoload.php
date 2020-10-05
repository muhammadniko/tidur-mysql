<?php

function Config() {
    require_once "includes/config.php";
}

function Database() {
    require_once "includes/DB.php";
}


spl_autoload_register("Config");
spl_autoload_register("Database");

?>