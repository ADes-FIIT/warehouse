<?php

namespace App\Tests\acceptance\Supplier;

use App\Tests\_support\Step\SupplierStep;
use App\Tests\AcceptanceTester;
use Symfony\Component\HttpFoundation\Response;

class GetSupplierDetailCest
{
    /**
     * @param AcceptanceTester $I
     * @param SupplierStep $S
     */
    public function testGetSupplierDetail(AcceptanceTester $I, SupplierStep $S): void
	{
        $I->wantTo("Test Get Supplier Detail");
        $data['url'] = $I->getUrl("server");

        $list = $S->getSupplierList($data);
        $I->seeResponseCodeIs(Response::HTTP_OK);

        if (empty($list['data'])) {
            $I->comment("Database is empty.");
            return;
        }

        $I->assertArrayHasKey('id', $list['data'][0]);
        $data['id'] = $list['data'][0]['id'];
        $item = $S->getSupplierDetail($data);
        $I->seeResponseCodeIs(Response::HTTP_OK);

        $I->assertArrayHasKey('id', $item['data']);
        $I->assertArrayHasKey('name', $item['data']);
        $I->assertArrayHasKey('supply_date', $item['data']);
        $I->assertArrayHasKey('registration_date', $item['data']);
    }

    /**
     * @param AcceptanceTester $I
     * @param SupplierStep $S
     */
    public function testGetSupplierDetailError(AcceptanceTester $I, SupplierStep $S): void
    {
        $I->wantTo("Test Get Supplier Detail Error");
        $data['url'] = $I->getUrl("server");

        $data['id'] = 999999;
        $item = $S->getSupplierDetail($data);
        $I->seeResponseCodeIs(Response::HTTP_BAD_REQUEST);
        $I->assertArrayHasKey('error', $item);
        $I->assertArrayHasKey('code', $item['error']);
        $I->assertArrayHasKey('message', $item['error']);
        $I->comment("Error successfully tested, message: " . $item['error']['message']);
    }
}
