<?php

namespace App\Tests\acceptance\Supplier;

use App\Tests\_support\DataProvider\SupplierDataProvider;
use App\Tests\_support\Step\SupplierStep;
use App\Tests\AcceptanceTester;
use Symfony\Component\HttpFoundation\Response;

class PostSupplierCest
{
    /**
     * @param AcceptanceTester $I
     * @param SupplierStep $S
     * @param SupplierDataProvider $provider
     */
    public function testPostSupplier(
        AcceptanceTester $I,
        SupplierStep $S,
        SupplierDataProvider $provider
    ): void
	{
        $I->wantTo("Test Post Supplier");
        $data['url'] = $I->getUrl("server");

        $data['supplier'] = $provider->getPostData();
        $response = $S->postSupplier($data);
        $I->seeResponseCodeIs(Response::HTTP_CREATED);

        $I->assertArrayHasKey('data', $response);
        $I->assertNotEmpty($response['data']);
        $I->comment("New supplier created with ID: " . $response['data']['id']);

        //cleanup
        $data['id'] = $response['data']['id'];
        $response = $S->deleteSupplier($data);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->assertEmpty($response['data']);
        $I->comment("Cleanup successful");
    }

    /**
     * @param AcceptanceTester $I
     * @param SupplierStep $S
     */
    public function testPostSupplierError(AcceptanceTester $I, SupplierStep $S): void
	{
        $I->wantTo("Test Post Supplier Error");
        $data['url'] = $I->getUrl("server");

        $data['supplier'] = [];
        $response = $S->postSupplier($data);
        $I->seeResponseCodeIs(Response::HTTP_BAD_REQUEST);
        $I->assertArrayHasKey('error', $response);
        $I->assertArrayHasKey('code', $response['error']);
        $I->assertArrayHasKey('message', $response['error']);
        $I->comment("Error successfully tested, message: " . $response['error']['message']);
    }
}
