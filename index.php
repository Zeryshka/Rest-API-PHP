<?php
include "config/db.php";
include "routers/productsRouters.php";
header("Content-type: json/application");

Products::getProducts($db, $_GET);
