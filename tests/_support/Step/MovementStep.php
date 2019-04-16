<?php

namespace App\Tests\_support\Step;

use App\Tests\AcceptanceTester;

class MovementStep extends AcceptanceTester
{
    const MOVEMENTS = '/movements';
    const MOVEMENTS_SLASH = self::MOVEMENTS . '/';
    const ITEM = self::MOVEMENTS_SLASH . 'item/';

    /**
     * @param array $data
     * @return mixed
     */
    public function getMovementsList(array $data)
    {
        $url = $data['url'] . self::MOVEMENTS;
        $this->haveHttpHeader('accept', 'application/json');
        $this->sendGet($url);

        return json_decode($this->grabResponse(), true);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function getMovementDetail(array $data)
    {
        $url = $data['url'] . self::MOVEMENTS_SLASH . $data['id'];
        $this->haveHttpHeader('accept', 'application/json');
        $this->sendGet($url);

        return json_decode($this->grabResponse(), true);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function postMovement(array $data)
    {
        $url = $data['url'] . self::MOVEMENTS;
        $this->haveHttpHeader('Content-Type', 'application/json');
        $this->sendPOST($url, $data['movement']);

        return json_decode($this->grabResponse(), true);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function deleteMovement(array $data)
    {
        $url = $data['url'] . self::MOVEMENTS_SLASH . $data['id'];
        $this->haveHttpHeader('accept', 'application/json');
        $this->sendDELETE($url);

        return json_decode($this->grabResponse(), true);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function getItemMovementList(array $data)
    {
        $url = $data['url'] . self::ITEM . $data['id'];
        $this->haveHttpHeader('accept', 'application/json');
        $this->sendGet($url);

        return json_decode($this->grabResponse(), true);
    }
}
