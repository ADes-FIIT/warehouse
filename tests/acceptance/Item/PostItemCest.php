<?php

namespace App\Tests\acceptance\Item;

use App\Tests\_support\DataProvider\ItemDataProvider;
use App\Tests\_support\Step\ItemStep;
use App\Tests\AcceptanceTester;
use Symfony\Component\HttpFoundation\Response;

class PostItemCest
{
    /**
     * @param AcceptanceTester $I
     * @param ItemStep $S
     * @param ItemDataProvider $provider
     */
    public function testPostItem(AcceptanceTester $I, ItemStep $S, ItemDataProvider $provider) {
        $I->wantTo("Test Post Item");
        $data['url'] = $I->getUrl("server");

        $data['item'] = $provider->getPostData();
        $response = $S->postItem($data);
        $I->seeResponseCodeIs(Response::HTTP_CREATED);

        $I->assertArrayHasKey('data', $response);
        $I->assertNotEmpty($response['data']);
        $I->comment("New item created with ID: " . $response['data']['id']);

        //cleanup
        $data['id'] = $response['data']['id'];
        $response = $S->deleteItem($data);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->assertEmpty($response['data']);
        $I->comment("Cleanup successful");
    }

    /**
     * @param AcceptanceTester $I
     * @param ItemStep $S
     */
    public function testPostItemError(AcceptanceTester $I, ItemStep $S) {
        $I->wantTo("Test Post Item Error");
        $data['url'] = $I->getUrl("server");

        $data['item'] = [];
        $response = $S->postItem($data);
        $I->seeResponseCodeIs(Response::HTTP_BAD_REQUEST);
        $I->assertArrayHasKey('error', $response);
        $I->assertArrayHasKey('code', $response['error']);
        $I->assertArrayHasKey('message', $response['error']);
        $I->comment("Error successfully tested, message: " . $response['error']['message']);
    }
}
