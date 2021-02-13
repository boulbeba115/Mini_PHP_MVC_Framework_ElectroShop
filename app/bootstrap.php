<?php
require_once("config/env.php");
require_once("helpers/flashMessage.helper.php");
require_once("helpers/redirect.helper.php");
require_once("helpers/imgHundler.helper.php");
require_once("helpers/hundleJson.helper.php");

//Autoload libs
spl_autoload_register(function ($classname) {
    require_once("libs/" . $classname . ".php");
});

$core = new Core;
