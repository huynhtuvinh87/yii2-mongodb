<?php

namespace common\widgets;

use Yii;

class DateTime extends \yii\bootstrap\Widget
{

    public $label;
    public $model;
    public $day;
    public $month;
    public $year;

    public function run()
    {
        return $this->render('datetime', [
                    'model' => $this->model[$this->name],
                    'day'   => $this->day,
                    'month' => $this->month,
                    'year'  => $this->year,
                    'label' => $this->label,
        ]);
    }

    public function year()
    {
        
    }

}
