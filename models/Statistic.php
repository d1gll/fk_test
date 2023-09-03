<?php

namespace app\models;

use yii\db\ActiveRecord;

class Statistic extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%statistic}}';
    }
}