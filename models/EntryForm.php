<?php

namespace app\models;

use Yii;
use yii\base\Model;

class EntryForm extends Model
{
    public $search;
    public $select;

    public function rules()
    {
        return [
            [['search', 'select'], 'required','message' =>'must enter search  word'],
            
            ['search', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/', 'message' => 'Your username can only contain alphanumeric characters, underscores and dashes.'],
        ];
    }
}