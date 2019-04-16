<?php

namespace App\Tests\acceptance\Movement;

use App\Tests\_support\Step\MovementStep;
use App\Tests\AcceptanceTester;
use Symfony\Component\HttpFoundation\Response;

class GetMovementDetailCest
{
    /**
     * @param AcceptanceTester $I
     * @param MovementStep $S
     */
    public function testGetMovementDetail(AcceptanceTester $I, MovementStep $S) {
        $I->wantTo("Test Get Movement Detail");
        $data['url'] = $I->getUrl("server");

        $list = $S->getMovementsList($data);
        $I->seeResponseCodeIs(Response::HTTP_OK);

        if (empty($list['data'])) {
            $I->comment("Database is empty.");
            return;
        }

        $I->assertArrayHasKey('id', $list['data'][0]);
        $data['id'] = $list['data'][0]['id'];
        $item = $S->getMovementDetail($data);
        $I->seeResponseCodeIs(Response::HTTP_OK);

        $I->assertArrayHasKey('id', $item['data']);
        $I->assertArrayHasKey('direction', $item['data']);
        $I->assertArrayHasKey('id', $item['data']['item']);
        $I->assertArrayHasKey('name', $item['data']['item']);
        $I->assertArrayHasKey('price', $item['data']['item']);
        $I->assertArrayHasKey('quantity', $item['data']['item']);
        $I->assertArrayHasKey('id', $item['data']['supplier']);
        $I->assertArrayHasKey('name', $item['data']['supplier']);
        $I->assertArrayHasKey('supply_date', $item['data']['supplier']);
    }

    public function testGetMovementDetailError(AcceptanceTester $I, MovementStep $S)
    {
        $I->wantTo("Test Get Movement Detail Error");
        $data['url'] = $I->getUrl("server");

        $data['id'] = 999999;
        $item = $S->getMovementDetail($data);
        $I->seeResponseCodeIs(Response::HTTP_BAD_REQUEST);
        $I->assertArrayHasKey('error', $item);
        $I->assertArrayHasKey('code', $item['error']);
        $I->assertArrayHasKey('message', $item['error']);
        $I->comment("Error successfully tested, message: " . $item['error']['message']);
    }
}
