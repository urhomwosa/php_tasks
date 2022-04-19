<?php

namespace App\Model;

require_once __DIR__ . '/product.php';

class Furniture extends Product
{
    public function getAttribute()
    {
        return  "Dimension: $this->attribute";
    }
}