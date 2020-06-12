<?php

namespace App\Tests\acceptance\Item;

use App\Tests\_support\Step\ItemStep;
use App\Tests\AcceptanceTester;
use Symfony\Component\HttpFoundation\Response;

class GetItemDetailCest
{
    /**
     * @param AcceptanceTester $I
     * @param ItemStep $S
     */
    public function testGetItemDetail(AcceptanceTester $I, ItemStep $S): void
	{
        $I->wantTo("Test Get Item Detail");
        $data['url'] = $I->getUrl("server");

        $list = $S->getItemList($data);
        $I->seeResponseCodeIs(Response::HTTP_OK);

        if (empty($list['data'])) {
            $I->comment("Database is empty.");
            return;
        }

        $I->assertArrayHasKey('id', $list['data'][0]);
        $data['id'] = $list['data'][0]['id'];
        $item = $S->getItemDetail($data);
        $I->seeResponseCodeIs(Response::HTTP_OK);

        $I->assertArrayHasKey('id', $item['data']);
        $I->assertArrayHasKey('name', $item['data']);
        $I->assertArrayHasKey('price', $item['data']);
        $I->assertArrayHasKey('quantity', $item['data']);
        $I->assertArrayHasKey('created', $item['data']);
    }

    public function testGetItemDetailError(AcceptanceTester $I, ItemStep $S): void
    {
        $I->wantTo("Test Get Item Detail Error");
        $data['url'] = $I->getUrl("server");

        $data['id'] = 999999;
        $item = $S->getItemDetail($data);
        $I->seeResponseCodeIs(Response::HTTP_BAD_REQUEST);
        $I->assertArrayHasKey('error', $item);
        $I->assertArrayHasKey('code', $item['error']);
        $I->assertArrayHasKey('message', $item['error']);
        $I->comment("Error successfully tested, message: " . $item['error']['message']);
    }
}
