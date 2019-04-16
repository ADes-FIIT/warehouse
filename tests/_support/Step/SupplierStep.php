<?php

namespace App\Tests\_support\Step;

use App\Tests\AcceptanceTester;

class SupplierStep extends AcceptanceTester
{
    const SUPPLIERS = '/suppliers';
    const SUPPLIERS_SLASH = self::SUPPLIERS . '/';

    /**
     * @param array $data
     * @return mixed
     */
    public function getSupplierList(array $data)
    {
        $url = $data['url'] . self::SUPPLIERS;
        $this->haveHttpHeader('accept', 'application/json');
        $this->sendGet($url);

        return json_decode($this->grabResponse(), true);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function getSupplierDetail(array $data)
    {
        $url = $data['url'] . self::SUPPLIERS_SLASH . $data['id'];
        $this->haveHttpHeader('accept', 'application/json');
        $this->sendGet($url);

        return json_decode($this->grabResponse(), true);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function postSupplier(array $data)
    {
        $url = $data['url'] . self::SUPPLIERS;
        $this->haveHttpHeader('Content-Type', 'application/json');
        $this->sendPOST($url, $data['supplier']);

        return json_decode($this->grabResponse(), true);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function deleteSupplier(array $data)
    {
        $url = $data['url'] . self::SUPPLIERS_SLASH . $data['id'];
        $this->haveHttpHeader('accept', 'application/json');
        $this->sendDELETE($url);

        return json_decode($this->grabResponse(), true);
    }
}
