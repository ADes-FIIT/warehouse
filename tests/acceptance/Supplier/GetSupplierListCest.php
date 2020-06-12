<?php

namespace App\Tests\acceptance\Supplier;

use App\Tests\_support\Step\SupplierStep;
use App\Tests\AcceptanceTester;
use Symfony\Component\HttpFoundation\Response;

class GetSupplierListCest
{
    /**
     * @param AcceptanceTester $I
     * @param SupplierStep $S
     */
    public function testGetItemList(AcceptanceTester $I, SupplierStep $S): void
	{
        $I->wantTo("Test Get Supplier List");
        $data['url'] = $I->getUrl("server");

        $items = $S->getSupplierList($data);
        $I->seeResponseCodeIs(Response::HTTP_OK);

        if (empty($list['data'])) {
            $I->comment("Database is empty.");
            return;
        }

        $I->assertArrayHasKey('id', $items['data'][0]);
        $I->assertArrayHasKey('name', $items['data'][0]);
        $I->assertArrayHasKey('supply_date', $items['data'][0]);
        $I->assertArrayHasKey('registration_date', $items['data'][0]);
    }
}
