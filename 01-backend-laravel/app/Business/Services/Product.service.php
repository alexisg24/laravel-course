<?php

namespace App\Business\Services;

use App\Business\Entities\Taxes;

class ProductService
{
    public function calculateTax($price)
    {
        return $price * (1 + Taxes::IVA);
    }
}
