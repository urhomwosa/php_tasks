<?php

namespace App\Model;

require_once __DIR__ . '/product.php';

class Book extends Product
{
    public function getAttribute()
    {
        return  "Weight: $this->attribute KG";
    }
}