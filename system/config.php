<?php

//Доменное имя приложения
define('SERVER_NAME', 'http://' . $_SERVER['HTTP_HOST']);
//Папка с моделями
define("DIR_MODEL", 'API/Model/');
//Папка с контроллерами
define("DIR_CONTROLLER", 'API/Controller/');
define("DIR_TEMPLATE", 'API/Template/');
define("SMARTY_TEMPLATE", 'vendor/smarty/smarty/libs/Smarty.class.php');
//define("COMPILE_TEMPLATE", 'system/compile_template');
//Папка с файлами javascript
define('DIR_JS', 'API/Template/js/');
//Папка с файлами css
define('DIR_CSS', 'API/Template/css/stylesheet.css');
//папка с файлами images
define('DIR_IMAGE', SERVER_NAME.'/Image/');
/**
 * Настройки базы данных
 */
//Хост базы данных
define('HOST', 'localhost');
//Логин базы данных
define('USER', 'root');
//Порт базы данных
define('PORT', '3306');
//Пароль базы данных
define('PASSWORD', 'password');
//Название базы данных
define('NAME_DB', 'for_soul');
/**
 * Настройки роутера
 */
//Контроллер по умолчанию
define("DEFAULT_CONTROLLER", 'main');
//Действие по умолчанию
define("DEFAULT_ACTION", 'index');