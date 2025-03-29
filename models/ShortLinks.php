<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use \yii\db\ActiveRecord;
use yii\httpclient\Client;
use Da\QrCode\QrCode;
use yii\helpers\Url;
/**
 * This is the model class for table "short_links".
 *
 * @property int $id
 * @property string $url
 * @property string|null $hash
 */
class ShortLinks extends ActiveRecord
{
    private string $shortLink;

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'short_links';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['hash'], 'default', 'value' => null],
            [['url'], 'required', 'message' => 'Поле {attribute} не может быть пустым'],
            [['url'], 'url', 'defaultScheme' => 'http', 'message' => 'Ссылка {value} имеет неправльный формат'],
            [['hash'], 'string', 'max' => 10],
            [['hash'], 'unique'],
        ];
    }

    /**
     * @return string[]
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'url' => 'Ссылка',
            'hash' => 'Hash',
        ];
    }

    /**
     * Gets query for [[Url]].
     *
     * @return ActiveQuery
     */
    public function getLogs(): ActiveQuery
    {
        return $this->hasMany(ShortLinksLogs::class, ['url_id' => 'id']);
    }

    /**
     * @return bool
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function checkUrl(): bool
    {
        $this->validate();
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('HEAD')
            ->setUrl($this->url)
            ->send();

        $resCode = (int)$response->getStatusCode();
        if($resCode >= 200 && $resCode < 300) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     * @throws \yii\base\Exception
     */
    public function generateHash(): bool
    {
       $this->hash = Yii::$app->security->generateRandomString(10);

       $notUniq = self::find()
            ->where(['hash' =>  $this->hash])
            ->count();
       if($notUniq) {
           return $this->generateHash();
       }
       return true;
    }

    /**
     * @param string $actonName
     * @return string
     */
    public function getShortLink(string $actonName = 'short/index'): string
    {
        if(empty($this->shortLink)) {
            $this->shortLink = Url::to([$actonName, 'hash' => $this->hash], true);
        }
        return $this->shortLink;
    }

    /**
     * @param string $actonName
     * @return QrCode
     */
    public function getQrCode(string $actonName = 'short/index'): QrCode
    {
        $qrCode = (new QrCode($this->getShortLink($actonName)))
            ->setSize(250)
            ->setMargin(5)
            ->setBackgroundColor(255, 255, 255);
        return $qrCode;
    }


}
