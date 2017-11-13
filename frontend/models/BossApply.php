<?php

namespace frontend\models;

use common\models\Job;
use common\models\Resume;
use common\models\Apply;
use common\models\Account;

/**
 * Location model
 *
 * @property string $name
 * @property string $sectors
 */
class BossApply extends Apply {

    public $resume_id;
    public $job_id;

    public function rules() {
        return [
            ['job_id', 'required'],
            [['resume_id'], 'string'],
            [['resume', 'job_id'], 'default']
        ];
    }

    public static function find() {
        return parent::find()->where(['type' => 'boss']);
    }

    public function jobs() {
        $model = Job::find()->all();
        if (!empty($model)) {
            foreach ($model as $key => $value) {
                $data[] = ['id' => $value->id, 'title' => $value->title];
            }
            return $data;
        }
    }

    public function savedata() {
        if ($this->validate()) {
            $resume = Resume::findOne($this->resume_id);
            foreach ($this->job_id as $value) {
                \Yii::$app->mongodb->createCommand()
                        ->addInsert([
                            'boss' => Account::findArray(\Yii::$app->user->id),
                            'member' => Account::findArray($resume->author_id),
                            'resume' => Resume::findArray($this->resume_id),
                            'job' => Job::findArray($value),
                            'type' => 'boss',
                            'created_at' => time(),
                            'updated_at' => time(),
                        ])
                        ->executeBatch('apply');
            }

            return true;
        } else {
            return false;
        }
    }

}
