<?php

namespace frontend\models;

use common\models\Resume;
use common\models\Apply;
use common\models\Job;

/**
 * MemberApply
 */
class MemberApply extends Apply
{

    public $job_id;
    public $_job;

    public function init()
    {
        parent::init();
    }

    public function rules()
    {
        return [
            [['job_id', 'price', 'why_choose_us'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'why_choose_us' => 'Vì sao chọn chúng tôi',
            'price'         => 'Mức lương mong muốn'
        ];
    }

    public static function find()
    {
        return parent::find()->where(['type' => 'member']);
    }

    public function check()
    {
        if ($model = Apply::find()->where(['author_id' => \Yii::$app->user->id, 'type' => 'member'])->where(['job._id' => $this->_job->_id])->one())
        {
            return TRUE;
        } else
        {
            return FALSE;
        }
    }

    public function savedata()
    {
        if ($this->validate())
        {
            $resume = Resume::findOne(['user_id' => \Yii::$app->user->id]);
            \Yii::$app->mongodb->createCommand()
                    ->addInsert([
                        'author_id'     => \Yii::$app->user->id,
                        'why_choose_us' => $this->why_choose_us,
                        'price'         => $this->price,
                        'resume'        => Resume::findArray($resume->id),
                        'job'           => Job::findArray($this->job_id),
                        'type'          => 'member',
                        'created_at'    => time(),
                        'updated_at'    => time(),
                    ])
                    ->executeBatch('apply');
            return TRUE;
        }
        return FALSE;
    }

}
