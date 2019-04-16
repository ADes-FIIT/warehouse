<?php

namespace App\Tests\_support\DataProvider;

use DateTime;

class ItemDataProvider
{
    public function getPostData()
    {
        return [
            "name" => "testItem" . (new DateTime('now'))->format('YmdHis'),
            "price" => floatval(rand(0, 100000)),
            "quantity" => rand(0, 500)
        ];
    }
}
