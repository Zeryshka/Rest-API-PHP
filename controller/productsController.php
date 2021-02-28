<?php
function getAllProducts($db)
{
    $products = pg_query($db, "SELECT * FROM products");
    $products = pg_fetch_all($products);
    echo json_encode($products);
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
    } else {
        $product = pg_fetch_all($product);
        echo json_encode($product);
    }
}
