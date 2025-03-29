<?php

namespace tests\unit\models;

use app\models\ShortLinks;
use yii\base\Exception;
use \yii\db\ActiveRecord;

class ShortLinksTest extends \Codeception\Test\Unit
{

    private ActiveRecord $model;

    private array $fixtures = [
        'validUrl' => 'http://google.com',
        'unValidUrl' => 'dasdasdasdas',
        'inaccessibleUrl' => 'http://google.com/dasdasdasdas'
    ];


    public function _before(): void
    {
        $this->model = new ShortLinks();
    }

    /**
     * @throws Exception
     */
    public function testModelValidate()
    {
        $this->model->load(['url' => $this->fixtures['unValidUrl']],'');
        verify($this->model->validate())->false();

        $this->model->load(['url' => $this->fixtures['inaccessibleUrl']],'');
        verify($this->model->validate())->true();

        $this->model->load(['url' => $this->fixtures['validUrl']],'');
        verify($this->model->validate())->true();

    }

    /**
     * @throws Exception
     */
    public function testModelCheckUrl()
    {
        $this->model->load(['url' => $this->fixtures['inaccessibleUrl']],'');
        verify($this->model->checkUrl())->false();

        $this->model->load(['url' => $this->fixtures['validUrl']],'');
        verify($this->model->checkUrl())->true();
    }

    /**
     * @throws Exception
     */
    public function testModelGenerateHash()
    {
        verify($this->model->generateHash())->true();
        verify($this->model->hash)->isString();
    }

    /**
     * @throws Exception
     */
    public function testCreateRecord()
    {
        $this->model->load(['url' => $this->fixtures['validUrl']],'');
        $this->model->generateHash();
        verify($this->model->save())->true();
        verify($this->model)->isObject();
        verify($this->model)->instanceOf('app\models\ShortLinks');
    }


    /**
     * @throws Exception
     */
    public function testGetShortLink()
    {
        $this->model->load(['url' => $this->fixtures['validUrl']],'');
        $this->model->generateHash();
        verify($this->model->getShortLink('/test/view'))->isString();
    }

    /**
     * @throws Exception
     */
    public function testGetQRCode()
    {
        $this->model->load(['url' => $this->fixtures['validUrl']],'');
        $this->model->generateHash();
        verify($this->model->getQrCode('/test/view'))->instanceOf('\Da\QrCode\QrCode');
    }
}
