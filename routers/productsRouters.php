<?php
include "$_SERVER[DOCUMENT_ROOT]/controller/productsController.php";

class Products
{
    public static function getProducts($db, $args)
    {
        $params = explode('/', $args['q']);
        $type = $params[0];
        $id = isset($params[1]) ? $params[1] : false;
        
        switch ($type) {
            case 'products':
                if (!$id) {
                    getAllProducts($db);
                } else {
                    getOneProduct($db, $id);
                }
                break;
        }
    }
}
