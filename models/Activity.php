<?php


namespace app\models;


use app\base\BaseModel;
use app\behaviors\DateCreatedBehavior;
use app\behaviors\LogBehavior;
use app\models\rules\BlackListRule;
use phpDocumentor\Reflection\DocBlock\Description;

class Activity extends ActivityBase
{
    // public $title;
    public $author;
    // public $description;
    // public $dateStart;
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

    public function behaviors()
    {
        return [
            ['class'=>DateCreatedBehavior::class, 'attributeName' => 'createAt'],
            ['class'=>DateCreatedBehavior::class, 'attributeName' => 'createAt'],
            LogBehavior::class
        ];       
    }


    public function beforeValidate()
    {
        if (!empty($this->dateStart)) {
            $dateStart = \DateTime::createFromFormat('d.m.Y', $this->dateStart);
            if ($dateStart) {
                $this->dateStart = $dateStart->format('Y-m-d');
            }
        }
        return parent::beforeValidate();
    }


    public function rules()
    {
        return array_merge([
            ['title', 'trim'],
//            ['description','defaultValue'=>''],
            [['title', 'dateStart', 'description', 'author'], 'required'],
            [['title', 'dateStart', 'createAt', 'time', 'author'], 'string'],
            ['dateStart', 'createAt', 'date', 'format' => 'php:Y-m-d'],
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
            'dateStart' => 'Дата',
            'time' => 'Время',
            'isBlocked' => 'Блокировка события',
            'isRepeat' => 'Повторение события',
            'file' => 'Прикрепите файл',
        ];
    }
    // выводим через API только те поля, которые хотим:
    public function fields()
    {
        return [
            'id',
            'title',
            'description',
            'dateStart'=>function($model){
                return \Yii::$app->formatter->asDate($model->dateStart,'d.m.Y');
            },
            // создаем свое поле:
            'duration' => function() {
                return 0;
            },
            'user'=>function($model){
                return $model->user->email;
            }    
        ];
    }
    // Добавляем поля, которые вводятся по запросам API:
    public function extraFields()
    {
        return [
            'user'=>function($model){
                return $model->user->email;
            }    
        ];
    }
}