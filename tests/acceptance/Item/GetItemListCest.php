<?php

namespace App\Tests\acceptance\Item;

use App\Tests\_support\Step\ItemStep;
use App\Tests\AcceptanceTester;
use Symfony\Component\HttpFoundation\Response;

class GetItemListCest
{
    /**
     * @param AcceptanceTester $I
     * @param ItemStep $S
     */
    public function testGetItemList(AcceptanceTester $I,ItemStep $S) {
        $I->wantTo("Test Get Item List");
        $data['url'] = $I->getUrl("server");
        $items = $S->getItemList($data);
        $I->seeResponseCodeIs(Response::HTTP_OK);

        if (empty($items['data'])) {
            $I->comment("Database is empty.");
            return;
        }

        $I->assertArrayHasKey('id', $items['data'][0]);
        $I->assertArrayHasKey('name', $items['data'][0]);
        $I->assertArrayHasKey('price', $items['data'][0]);
        $I->assertArrayHasKey('quantity', $items['data'][0]);
        $I->assertArrayHasKey('created', $items['data'][0]);
    }
}
