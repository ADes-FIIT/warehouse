<?php

namespace App\Tests\acceptance\Movement;

use App\Tests\_support\DataProvider\ItemDataProvider;
use App\Tests\_support\DataProvider\SupplierDataProvider;
use App\Tests\_support\Step\ItemStep;
use App\Tests\_support\Step\MovementStep;
use App\Tests\_support\Step\SupplierStep;
use App\Tests\AcceptanceTester;
use Symfony\Component\HttpFoundation\Response;

class PostMovementCest
{
    /**
     * @param AcceptanceTester $I
     * @param MovementStep $S
     * @param ItemStep $T
     * @param SupplierStep $U
     * @param ItemDataProvider $itemDataProvider
     * @param SupplierDataProvider $supplierDataProvider
     */
    public function testPostMovement(
        AcceptanceTester $I,
        MovementStep $S,
        ItemStep $T,
        SupplierStep $U,
        ItemDataProvider $itemDataProvider,
        SupplierDataProvider $supplierDataProvider
    ): void
	{
        $I->wantTo("Test Post Movement");
        $data['url'] = $I->getUrl("server");

        $data['item'] = $itemDataProvider->getPostData();
        $data['item']['quantity'] = 0;
        $item = $T->postItem($data);
        $data['movement']['item_id'] = $item['data']['id'];

        $data['supplier'] = $supplierDataProvider->getPostData();
        $supplier = $U->postSupplier($data);
        $data['movement']['supplier_id'] = $supplier['data']['id'];

        $data['movement']['direction'] = "in";
        $movementIn = $S->postMovement($data);
        $I->seeResponseCodeIs(Response::HTTP_CREATED);

        $I->assertArrayHasKey('data', $movementIn);
        $I->assertNotEmpty($movementIn['data']);
        $I->comment("New movement IN created with ID: " . $movementIn['data']['id']);

        $data['movement']['direction'] = "out";
        $movementOut = $S->postMovement($data);
        $I->seeResponseCodeIs(Response::HTTP_CREATED);

        $I->assertArrayHasKey('data', $movementOut);
        $I->assertNotEmpty($movementOut['data']);
        $I->comment("New movement IN created with ID: " . $movementOut['data']['id']);

        //cleanup
        $data['id'] = $movementIn['data']['id'];
        $response = $S->deleteMovement($data);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->assertEmpty($response['data']);

        $data['id'] = $movementOut['data']['id'];
        $response = $S->deleteMovement($data);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->assertEmpty($response['data']);

        $data['id'] = $item['data']['id'];
        $response = $T->deleteItem($data);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->assertEmpty($response['data']);

        $data['id'] = $supplier['data']['id'];
        $response = $U->deleteSupplier($data);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->assertEmpty($response['data']);

        $I->comment("Cleanup successful");
    }

    /**
     * @param AcceptanceTester $I
     * @param MovementStep $S
     */
    public function testPostItemError(AcceptanceTester $I, MovementStep $S): void
	{
        $I->wantTo("Test Post Movement Error");
        $data['url'] = $I->getUrl("server");

        $data['movement'] = [];
        $response = $S->postMovement($data);
        $I->seeResponseCodeIs(Response::HTTP_BAD_REQUEST);
        $I->assertArrayHasKey('error', $response);
        $I->assertArrayHasKey('code', $response['error']);
        $I->assertArrayHasKey('message', $response['error']);
        $I->comment("Error successfully tested, message: " . $response['error']['message']);
    }
}
