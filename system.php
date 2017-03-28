<?php

    session_start();

    require('vendor/autoload.php');

    foreach (glob(__DIR__ . "/app/model/*.php") as $filename)
    {
        include $filename;
    }

    $klein = new \Klein\Klein();
    $smarty = new Smarty();
    $smarty->setTemplateDir(__DIR__ . DIRECTORY_SEPARATOR . "app/templates");
    $smarty->addTemplateDir(__DIR__ . DIRECTORY_SEPARATOR . "app/layout");
    $smarty->setCompileDir(__DIR__ . DIRECTORY_SEPARATOR . "cache");
    $smarty->assign('base_dir', BASE_DIR);

    require('routes.php');
    $klein->dispatch();