<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Exception;
use function Symfony\Component\String\s;

/**
 * This is the model class for table "short_links_logs".
 *
 * @property int $id
 * @property int $url_id
 * @property string $user_ip
 * @property int|null $visit_count
 *
 * @property ShortLinks $url
 */
class ShortLinksLogs extends ActiveRecord
{


    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'short_links_logs';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['visit_count'], 'default', 'value' => 0],
            [['url_id', 'user_ip'], 'required'],
            [['url_id', 'visit_count'], 'integer'],
            [['user_ip'], 'string', 'max' => 255],
            [['url_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShortLinks::class, 'targetAttribute' => ['url_id' => 'id']],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'url_id' => 'Url ID',
            'user_ip' => 'User Ip',
            'visit_count' => 'Visit Count',
        ];
    }

    /**
     * Gets query for [[Url]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUrl(): ActiveQuery
    {
        return $this->hasOne(ShortLinks::class, ['id' => 'url_id']);
    }


    /**
     * @param int $urlId
     * @param string $userIp
     * @return bool
     * @throws Exception
     */
    public function updateLogs(int $urlId, string $userIp): bool
    {
        $counter = self::find()->where(['url_id' => $urlId, 'user_ip' => $userIp])->count();
        $counter++;
        self::load(['url_id' => $urlId, 'user_ip' => $userIp, 'visit_count' => $counter], '');
        return self::save();
    }

}
