<?php


namespace app\models;


use app\base\BaseModel;
use app\models\rules\BlackListRule;

class Activity extends ActivityBase
{
    // public $title;
    public $author;
    // public $description;
    public $date;
    public $time;
    // public $isBlocked;
    public $isRepeat;
    public $repeatType;

    const DAY = 0;
    const WEEK = 1;
    const MONTH = 2;
    const REPEAT_TYPE = [self::DAY => 'Каждый день', self::WEEK => 'Каждую неделю',
        self::MONTH => 'Каждый месяц'];

    public $email;
    public $repeatEmail;
    public $file;

    public $useNotification;

    public function beforeValidate()
    {
        if (!empty($this->date)) {
            $date = \DateTime::createFromFormat('d.m.Y', $this->date);
            if ($date) {
                $this->date = $date->format('Y-m-d');
            }
        }
        return parent::beforeValidate();
    }


    public function rules()
    {
        return array_merge([
            ['title', 'trim'],
//            ['description','defaultValue'=>''],
            [['title', 'date', 'description', 'author'], 'required'],
            [['title', 'date', 'time', 'author'], 'string'],
            ['date', 'date', 'format' => 'php:Y-m-d'],
            ['description', 'string', 'max' => 300, 'min' => 5],
            [['isBlocked', 'isRepeat', 'useNotification'], 'boolean'],
            ['email', 'email'],
            ['email', 'required', 'when' => function ($model) {
                return $model->useNotification;
            }],
//            ['title','validBlackList',],
            ['title', BlackListRule::class, 'list' => ['Шаурма']],
            ['repeatType', 'in', 'range' => array_keys(self::REPEAT_TYPE)],
            ['repeatEmail', 'compare', 'compareAttribute' => 'email'],
//            ['title','match','pattern' => '/[a-z]{1,0}/iu'],
            ['file', 'file', 'extensions' => ['jpg', 'png', 'gif']] ,
        ],parent::rules());
    }

//    public function validBlackList($attribute){
//        $list=['Шаурма','Бордюр'];
//        if(in_array($this->title,$list)){
//            $this->addError('title','Недопостимое значение заголовока');
//        }
//    }

    public function attributeLabels()
    {
        return [
            'title' => 'Название события',
            'author' => 'Автор события',
            'description' => 'Описание',
            'date' => 'Дата',
            'time' => 'Время',
            'isBlocked' => 'Блокировка события',
            'isRepeat' => 'Повторение события',
            'file' => 'Прикрепите файл',
        ];
    }
}