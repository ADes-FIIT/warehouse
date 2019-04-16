<?php

namespace App\Tests\_support\DataProvider;

class SupplierDataProvider
{
    public function getPostData()
    {
        return [
            "name" => "testSupplier" . (new \DateTime('now'))->format('YmdHis'),
            "date_supply" => (new \DateTime('now'))->format(DATE_RFC3339)
        ];
    }
}
