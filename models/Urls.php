<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "urls".
 *
 * @property string $id
 * @property string $original_url
 * @property resource $short_url
 * @property string $date_created
 * @property string $counter
 */
class Urls extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'urls';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['original_url', 'short_url'], 'required'],
            [['date_created', 'counter'], 'integer'],
            [['original_url'], 'string', 'max' => 255],
            [['short_url'], 'string', 'max' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'original_url' => 'Original Url',
            'short_url' => 'Short Url',
            'date_created' => 'Date Created',
            'counter' => 'Counter',
        ];
    }
}
