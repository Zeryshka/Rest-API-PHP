<?php
function getAllProducts($db)
{
    $products = pg_query($db, "SELECT * FROM products");
    $products = pg_fetch_all($products);
    echo json_encode($products);
    return "Success";
}

function getOneProduct($db, $id)
{
    $product = pg_query_params($db, "SELECT * FROM products WHERE id=$1", [$id]);

    if (pg_num_rows($product) === 0) {
        http_response_code(404);
        $res =  [
            "status" => 404,
            "message" => "Товар не найден"
        ];
        echo json_encode($res);
        return "Error";
    } else {
        $product = pg_fetch_all($product);
        echo json_encode($product);
        return "Success";
    }
}

function createApiRequest($db, $result)
{
    $date = new DateTime();
    $date = $date->format('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'];
    pg_insert($db, 'api_requests', ["ip" => $ip, "date" => $date, "status" => $result]);
}
