<?php

namespace App\Model;

require_once __DIR__ . '/product.php';

class Disc extends Product
{
    public function getAttribute()
    {
        return  "Size: $this->attribute MB";
    }
}