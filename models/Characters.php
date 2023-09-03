<?php

namespace app\models;
use yii\db\ActiveRecord;

class Characters extends ActiveRecord
{
    public static function tableName()
    {
        return 'characters';
    }
}