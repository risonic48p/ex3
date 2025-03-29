<?php

namespace app\controllers;

use Yii;
use yii\db\Exception;
use yii\helpers\Url;
use yii\web\Controller;
use app\models\ShortLinks;
use app\models\ShortLinksLogs;

class ShortController extends Controller
{
    /**
     * Short link page
     * @param string $hash
     * @return string
     * @throws Exception
     */
    public function actionIndex(string $hash): string
    {
        $linkModel = ShortLinks::findOne(['hash' => $hash]);

        if(empty($linkModel)) {
            Yii::$app->response->statusCode = 404;
            $redirectUrl = Url::to(['site/index'], true);
            Yii::$app->session->setFlash('error', 'Ошибка. Такой ссылки не существует.');
        } else {
            $logsModel = new ShortLinksLogs();
            $logsModel->updateLogs($linkModel->id, Yii::$app->request->getUserIP());
            $redirectUrl = $linkModel->url;
            Yii::$app->session->setFlash('success', 'Подождите 5 секунд, сейчас произойдёт переадресация.');
        }

        return $this->render('index', ['url' => $redirectUrl]);
    }

}
