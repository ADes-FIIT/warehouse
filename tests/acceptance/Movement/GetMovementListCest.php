<?php

namespace App\Tests\acceptance\Movement;

use App\Tests\_support\Step\MovementStep;
use App\Tests\AcceptanceTester;
use Symfony\Component\HttpFoundation\Response;

class GetMovementListCest
{
    /**
     * @param AcceptanceTester $I
     * @param MovementStep $S
     */
    public function testGetMovementList(AcceptanceTester $I, MovementStep $S)
    {
        $I->wantTo("Test Get Movement List");
        $data['url'] = $I->getUrl("server");

        $list = $S->getMovementsList($data);
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
