<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
$inputJSON = file_get_contents('php://input');
if($inputJSON !== null):
    $result = json_decode($inputJSON, TRUE);
    
    $action = $result["action"];
    
    if($action == 'contact') {
        require $_SERVER['DOCUMENT_ROOT'] . '/local/templates/isocork/ajax/contact/contact.php';
    } else if($action == 'distributors') {
        require $_SERVER['DOCUMENT_ROOT'] . '/local/templates/isocork/ajax/contact/distributors.php';
    } else if($action == 'distributorsMap') {
        require $_SERVER['DOCUMENT_ROOT'] . '/local/templates/isocork/ajax/contact/distributorsMap.php';
    } else if($action == 'search') {
        require $_SERVER['DOCUMENT_ROOT'] . '/local/templates/isocork/ajax/contact/searchRegion.php';
    } else if($action == 'region') {
        require $_SERVER['DOCUMENT_ROOT'] . '/local/templates/isocork/ajax/contact/region.php';
    }
endif; ?>