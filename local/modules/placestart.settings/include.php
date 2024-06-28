<?php
  require_once $_SERVER["DOCUMENT_ROOT"].'/local/modules/placestart.settings/vendor/autoload.php';
  require_once $_SERVER["DOCUMENT_ROOT"].'/local/modules/placestart.settings/constants.php';
  require_once $_SERVER["DOCUMENT_ROOT"].'/local/modules/placestart.settings/utils.php';

  $dotenv = Dotenv\Dotenv::createMutable(__DIR__);
  $dotenv->load();

  CModule::AddAutoloadClasses('placestart.settings', [
    'Placestart\Utils' => 'lib/Utils.php',
    'Placestart\Mailer' => 'lib/Mailer.php',
    'Placestart\WebpackAssets' => 'lib/WebpackAssets.php',
    'Placestart\ComponentParameters' => 'lib/ComponentParameters.php',
    'PHPInterface\ComponentHelper' => 'lib/ComponentHelper.php',
    'Placestart\Controller\ShopHelper' => 'lib/controller/ShopHelper.php'
  ]);
?>