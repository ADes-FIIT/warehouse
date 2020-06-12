<?php

namespace App\Tests\acceptance\Item;

use App\Tests\_support\DataProvider\ItemDataProvider;
use App\Tests\_support\Step\ItemStep;
use App\Tests\AcceptanceTester;
use Symfony\Component\HttpFoundation\Response;

class DeleteItemCest
{
    /**
     * @param AcceptanceTester $I
     * @param ItemStep $S
     * @param ItemDataProvider $provider
     */
    public function testDeleteItem(AcceptanceTester $I, ItemStep $S, ItemDataProvider $provider): void
	{
        $I->wantTo("Test Delete Item");
        $data['url'] = $I->getUrl("server");

        $data['item'] = $provider->getPostData();
        $response = $S->postItem($data);
        $I->seeResponseCodeIs(Response::HTTP_CREATED);

        $I->assertArrayHasKey('data', $response);
        $I->assertNotEmpty($response['data']);
        $I->comment("New item to be deleted with ID: " . $response['data']['id']);

        $data['id'] = $response['data']['id'];
        $response = $S->deleteItem($data);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->assertEmpty($response['data']);
        $I->comment("Item successfully deleted");
    }

    /**
     * @param AcceptanceTester $I
     * @param ItemStep $S
     * @param ItemDataProvider $provider
     */
    public function testDeleteItemError(AcceptanceTester $I, ItemStep $S, ItemDataProvider $provider): void
	{
        $I->wantTo("Test Delete Item Error");
        $data['url'] = $I->getUrl("server");

        $data['id'] = 9999999;
        $response = $S->deleteItem($data);
        $I->seeResponseCodeIs(Response::HTTP_BAD_REQUEST);
        $I->assertArrayHasKey('error', $response);
        $I->assertArrayHasKey('code', $response['error']);
        $I->assertArrayHasKey('message', $response['error']);
        $I->comment("Error successfully tested, message: " . $response['error']['message']);
    }
}
