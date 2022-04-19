<?php

if ($_SERVER['REQUEST_URI'] == '/') {
    # code...
    return include_once './views/front.php';
}

if ($_SERVER['REQUEST_URI'] == '/products') {
    # code...
   return include_once './views/app-product.php';
}

