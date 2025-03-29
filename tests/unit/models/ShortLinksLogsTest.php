<?php

namespace tests\unit\models;

use app\models\ShortLinks;
use app\models\ShortLinksLogs;
use yii\base\Exception;
use \yii\db\ActiveRecord;

class ShortLinksLogsTest extends \Codeception\Test\Unit
{

    private ActiveRecord $model;

    private array $fixtures = [
        'url' => 'http://google.com'
    ];


    public function _before(): void
    {
        $this->model = new ShortLinksLogs();
    }


    /**
     * @throws Exception
     */
    public function testUpdateLogs()
    {
        $shortLinkModel = new ShortLinks();
        $shortLinkModel->load(['url' => $this->fixtures['url']],'');
        $shortLinkModel->generateHash();
        $shortLinkModel->save();

        verify($this->model->updateLogs($shortLinkModel->id, '127.0.0.1'))->true();
        verify($this->model->visit_count)->equals(1);

    }


}
