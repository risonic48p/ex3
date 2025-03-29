<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\ShortLinks;


class SiteController extends Controller
{


    /**
     * Generate short links page
     * @return string
     */
    public function actionIndex(): string
    {
        $model = new ShortLinks();

        if ($model->load(Yii::$app->request->post()) && ($model->generateHash())) {

            if(!$model->checkUrl()) {
                Yii::$app->session->setFlash('error', 'Ссылка не доступна');
            } else {
                if($model->save()) {
                    Yii::$app->session->setFlash('success', 'Короткая ссылка успешно создана.');
                    Yii::$app->session->setFlash('shortLinkHasCreated');
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка записи в базу.');
                }
            }

        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }


}
