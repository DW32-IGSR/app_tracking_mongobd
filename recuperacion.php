<?php
session_start();
require 'vendor/autoload.php';
include_once("model/model.php");

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('view');
$twig = new Twig_Environment($loader);

echo $twig->render('recuperarpassword.html',array());