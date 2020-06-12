<?php

namespace App\Tests\_support\DataProvider;

use DateTime;

class ItemDataProvider
{
    public function getPostData()
    {
        return [
			"name" => "testItem" . (new DateTime('now'))->format('YmdHis'),
			"price" => (float)random_int(0, 100000),
			"quantity" => random_int(0, 500)
        ];
    }
}
