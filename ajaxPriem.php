<?
$requestData = json_decode(file_get_contents('php://input'), true);

header('Content-Type: application/json');
if (valid($requestData['value'])) {
    echo json_encode($requestData);
} else {
    echo json_encode("Убери цифры");
}
function valid($name)
{
    if ((preg_match('/\d/', $name)) != "")
        return true;
    else
        return false;
}
?>