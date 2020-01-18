<?php

namespace app\models;

use yii\data\ActiveDataProvider;
use yii\db\Query;
use app\models\Activity;

class ActivitySearch extends Activity
{
    public function search($params = []): ActiveDataProvider
    {
        $query = Activity::find();

        $this->load($params);

        $provider = new ActiveDataProvider(
            [   'query' => $query,
                'sort' => [
                    'defaultOrder' => [
                        'dateStart'=>SORT_DESC
                    ]
                ],
                'pagination' => [
                    'pageSize' =>5
                ]

            ]
        );

        // $provider->getCount();
        // $query -> with('user');
        // $query -> innerJoinWith('user');
        $query -> andFilterWhere(['title'=>$this->title]);

        return $provider;
    }
}

