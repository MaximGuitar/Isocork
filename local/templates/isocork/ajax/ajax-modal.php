<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
$inputJSON = file_get_contents('php://input');
if($inputJSON !== null):
    $result = json_decode($inputJSON, TRUE);
    
    $action = $result["action"];
    
    if($action == 'project') {
        require $_SERVER['DOCUMENT_ROOT'] . '/local/templates/isocork/ajax/modal/project.php';
    } else if($action == 'contact') {
        require $_SERVER['DOCUMENT_ROOT'] . '/local/templates/isocork/ajax/modal/contact.php';
    } else if($action == 'seo') {
        require $_SERVER['DOCUMENT_ROOT'] . '/local/templates/isocork/ajax/modal/seo.php';
    } 
    else if($action == 'order_tabs') {
        require $_SERVER['DOCUMENT_ROOT'] . '/local/templates/isocork/ajax/modal/order_tabs.php';
    } 
    else if($action == 'just_text') {
        require $_SERVER['DOCUMENT_ROOT'] . '/local/templates/isocork/ajax/modal/just_text.php';
    } 
    else if($action == 'infoblock') {
        require $_SERVER['DOCUMENT_ROOT'] . '/local/templates/isocork/ajax/modal/infoblock.php';
    } 
endif;?>