<?php

namespace App\Tests\_support\Step;

use App\Tests\AcceptanceTester;

class ItemStep extends AcceptanceTester
{
    public const ITEMS = '/items';
    public const ITEMS_SLASH = self::ITEMS . '/';

    /**
     * @param array $data
     * @return mixed
     */
    public function getItemList(array $data)
    {
        $url = $data['url'] . self::ITEMS;
        $this->haveHttpHeader('accept', 'application/json');
        $this->sendGet($url);

        return json_decode($this->grabResponse(), true);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function getItemDetail(array $data)
    {
        $url = $data['url'] . self::ITEMS_SLASH . $data['id'];
        $this->haveHttpHeader('accept', 'application/json');
        $this->sendGet($url);

        return json_decode($this->grabResponse(), true);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function postItem(array $data)
    {
        $url = $data['url'] . self::ITEMS;
        $this->haveHttpHeader('Content-Type', 'application/json');
        $this->sendPOST($url, $data['item']);

        return json_decode($this->grabResponse(), true);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function deleteItem(array $data)
    {
        $url = $data['url'] . self::ITEMS_SLASH . $data['id'];
        $this->haveHttpHeader('accept', 'application/json');
        $this->sendDELETE($url);

        return json_decode($this->grabResponse(), true);
    }
}
