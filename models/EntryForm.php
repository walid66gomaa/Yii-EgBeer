<?php

namespace app\models;

use Yii;
use yii\base\Model;

class EntryForm extends Model
{
    public $search;
    public $select;
// '/^[a-zA-Z0-9_-\s]+$/'
    public function rules()
    {
        return [
            [['search'], 'required','message' =>'must enter search  word'],
            [['select'], 'required','message' =>'must select one checkbox'],
            
            ['search', 'match', 'pattern' => '/^[a-zA-Z0-9_]+(?:\s[a-zA-Z0-9_]+)*$/', 
            'message' => 'Your Search can only contain alphanumeric characters, underscores numbers and dashes. ',
            ],
        ];
    }
}