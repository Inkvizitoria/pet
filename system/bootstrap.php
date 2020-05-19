<?php
//Начинаем сессию
session_start();

require_once 'config.php';

include_once SMARTY_TEMPLATE;

include_once "Model.php";

include_once "Controller.php";

include_once "Router.php";

include_once 'connection.php';
