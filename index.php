<?php
include "config/db.php";
include "controller/productsController.php";

header("Content-type: json/application");

$ip = $_SERVER['REMOTE_ADDR'];
if ($ip == '127.0.0.1' || $ip == '178.210.79.186') {
    $params = explode('/', $_GET['q']);
    $type = $params[0];
    $id = isset($params[1]) ? $params[1] : false;

    switch ($type) {
        case 'products':
            if (!$id) {
                $result = getAllProducts($db);
                createApiRequest($db, $result);
            } else {
                $result = getOneProduct($db, $id);
                createApiRequest($db, $result);
            }
            break;
        default:
            http_response_code(404);
            $res = [
                "status" => 404,
                "message" => "Страница не найдена"
            ];
            echo json_encode($res);
            break;
    }
} else {
    http_response_code(403);
    $res = [
        "code" => 403,
        "message" => "Недостаточно прав"
    ];
    echo json_encode($res);
}
