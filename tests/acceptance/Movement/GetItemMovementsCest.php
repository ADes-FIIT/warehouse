<?php

namespace App\Tests\acceptance\Movement;

use App\Tests\_support\Step\ItemStep;
use App\Tests\_support\Step\MovementStep;
use App\Tests\AcceptanceTester;
use Symfony\Component\HttpFoundation\Response;

class GetItemMovementsCest
{
    /**
     * @param AcceptanceTester $I
     * @param MovementStep $S
     * @param ItemStep $T
     */
    public function testGetItemMovementList(AcceptanceTester $I, MovementStep $S, ItemStep $T): void
    {
        $I->wantTo("Test Get Item's Movement List");
        $data['url'] = $I->getUrl("server");

        $items = $T->getItemList($data);
        $I->seeResponseCodeIs(Response::HTTP_OK);

        if (empty($items['data'])) {
            $I->comment("Database is empty.");
            return;
        }

        $I->assertArrayHasKey('id', $items['data'][0]);
        $data['id'] = $items['data'][0]['id'];

        $list = $S->getItemMovementList($data);
        $I->seeResponseCodeIs(Response::HTTP_OK);

        if (empty($list['data'])) {
            $I->comment("Database is empty.");
            return;
        }

        $I->assertArrayHasKey('id', $list['data'][0]);
        $I->assertArrayHasKey('direction', $list['data'][0]);
        $I->assertArrayHasKey('id', $list['data'][0]['item']);
        $I->assertArrayHasKey('name', $list['data'][0]['item']);
        $I->assertArrayHasKey('price', $list['data'][0]['item']);
        $I->assertArrayHasKey('quantity', $list['data'][0]['item']);
        $I->assertArrayHasKey('id', $list['data'][0]['supplier']);
        $I->assertArrayHasKey('name', $list['data'][0]['supplier']);
        $I->assertArrayHasKey('supply_date', $list['data'][0]['supplier']);
    }
}
