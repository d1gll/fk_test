<?php

namespace app\models;

use yii\db\ActiveRecord;

class Players extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%players}}';
    }
}