<?php
    // load Config
    require_once 'config/config.php';

    // Load helpers
    require_once 'helpers/url_helper.php';
    require_once 'helpers/session_helper.php';
    require_once 'helpers/error_helper.php';
    require_once 'helpers/search_helper.php';
    require_once 'helpers/address_helper.php';

    // Autoload Core Libraries
    spl_autoload_register(function($className){
        require_once 'libraries/' . $className . '.php';
    });