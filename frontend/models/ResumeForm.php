<?php

namespace frontend\models;

use common\models\Resume;
use common\models\Account;
use common\models\Category;
use common\models\ProgrammingLanguage;
use common\models\Framework;
use common\models\Location;
use yii\web\UploadedFile;

/**
 * Signup form
 */
class ResumeForm extends Resume
{

    public $phone;
    public $email;
    public $day;
    public $month;
    public $year;
    public $work_company;
    public $work_designation;
    public $work_time_begin;
    public $work_time_end;
    public $work_description;
    public $education_institute_name;
    public $education_degree;
    public $education_time_begin;
    public $education_time_end;
    public $education_description;
    public $language_name;
    public $language_level;

    public function init()
    {
        $model = Resume::findOne(['author_id' => \Yii::$app->user->id]);

        $this->attributes = $model->attributes;
        if (!$model)
        {
            $user = Account::findProfile();
            $this->attributes = $user->attributes;
        }

        $this->author_id = \Yii::$app->user->id;
        if (!$model->birthday)
        {
            $birthday = explode('/', $user->birthday);
            $this->day = $birthday[0];
            $this->month = $birthday[1];
            $this->year = $birthday[2];
            $this->address = $user->address;
            $this->email = $user->email;
            $this->phone = $user->phone;
        }
        if ($model->category)
        {
            foreach ($model->category as $value)
            {
                $_category[] = (string) $value['_id'];
            }
            $this->category = $_category;
        }
        if ($model->program)
        {
            foreach ($model->program as $value)
            {
                $_program[] = (string) $value['_id'];
            }
            $this->program = $_program;
        }
        if ($model->framework)
        {
            foreach ($model->framework as $value)
            {
                $_framework[] = (string) $value['_id'];
            }
            $this->framework = $_framework;
        }
    }

    public function rules()
    {
        return [
            [['name', 'information', 'category', 'skill'], 'required'],
            [['career_objective', 'declaration', 'qualification', 'father_name', 'mother_name', 'birthday', 'birth_place', 'gender', 'nationality'], 'string'],
            [['works', 'education', 'language', 'address', 'phone', 'email', 'work_company', 'work_designation', 'work_time_begin', 'work_time_end', 'work_description', 'category', 'program', 'framework', 'location'], 'default'],
            [['education_institute_name', 'education_degree', 'education_time_begin', 'education_time_end', 'education_description', 'language_name', 'language_level'], 'string'],
            ['expected_salary', 'integer'],
            ['photo', 'file']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name'             => 'Họ và Tên',
            'information'      => 'Thông tin liên hệ',
            'photo'            => 'Ảnh hồ sơ của bạn',
            'career_objective' => 'Mục tiêu nghề nghiệp',
            'father_name'      => 'Họ và tên (Cha)',
            'mother_name'      => 'Họ và tên (Mẹ)',
            'birthday'         => 'Ngày sinh',
            'birth_place'      => 'Nơi sinh',
            'gender'           => 'Giới tính',
            'nationality'      => 'Quốc tịch',
            'address'          => 'Địa chỉ',
            'program'          => 'Ngôn ngữ lập trình',
            'category'         => 'Danh mục',
            'framework'        => 'Framework',
            'location'         => 'Địa điểm',
            'qualification' => 'Trình độ chuyên môn'
        ];
    }

    public function days()
    {
        $data[] = 'Ngày';
        for ($i = 1; $i <= 31; $i++)
        {
            if ($i < 10)
            {
                $i = '0' . $i;
            }
            $data[$i] = $i;
        }
        return $data;
    }

    public function months()
    {
        $data[] = 'Tháng';
        for ($i = 1; $i <= 12; $i++)
        {
            if ($i < 10)
            {
                $i = '0' . $i;
            }
            $data[$i] = $i;
        }
        return $data;
    }

    public function years()
    {
        $data[] = 'Năm';
        for ($i = 1950; $i <= 2017; $i++)
        {
            $data[$i] = $i;
        }
        return $data;
    }

    public function getSalaryLevel()
    {
        $data = [];
        for ($i = 5; $i <= 50; $i++)
        {
            if ($i <= 10 or ( $i > 10 && $i % 5 == 0))
            {
                $data[$i] = $i . '.000.000';
            }
        }
        return $data;
    }

    public function category(&$data = [])
    {
        $category = Category::find()->all();
        if (!empty($category))
        {
            foreach ($category as $key => $value)
            {
                if (!empty($this->category) && in_array($value->id, $this->category))
                    $checked = 1;
                else
                    $checked = 0;
                $data[] = ['id' => $value->id, 'title' => $value->title, 'checked' => $checked];
            }
            return $data;
        }
    }

    public function program()
    {
        $model = ProgrammingLanguage::find()->all();
        if (!empty($model))
        {
            foreach ($model as $key => $value)
            {
                if (!empty($this->program) && in_array($value->id, $this->program))
                    $checked = 1;
                else
                    $checked = 0;
                $data[] = ['id' => $value->id, 'title' => $value->title, 'checked' => $checked];
            }
            return $data;
        }
    }

    public function framework()
    {
        $model = Framework::find()->all();
        if (!empty($model))
        {
            foreach ($model as $key => $value)
            {
                if (!empty($this->framework) && in_array($value->id, $this->framework))
                    $checked = 1;
                else
                    $checked = 0;
                $data[] = ['id' => $value->id, 'title' => $value->title, 'checked' => $checked];
            }
            return $data;
        }
    }

    public function location()
    {
        $model = Location::find()->all();
        $data = [];
        foreach ($model as $value)
        {
            $data[$value->id] = $value->title;
        }
        return $data;
    }

    public function savedata()
    {
        $model = Resume::findOne(['author_id' => \Yii::$app->user->id]);
        if (!$model)
        {
            $model = new Resume();
            $model->author_id = \Yii::$app->user->id;
        }
        $model->attributes = $this->attributes;

        $photo = UploadedFile::getInstance($this, 'photo');
        if (!empty($photo))
        {
            $user = Account::findProfile();
            $name = $user->username . '.' . $photo->extension;
            $photo->saveAs(\Yii::getAlias("@frontend/web/uploads/cv/") . $name);
            $model->photo = $name;
        }
        if ($this->work_company)
        {
            $works = [];
            foreach ($this->work_company as $key => $value)
            {
                if (!empty($value))
                {
                    $works[] = [
                        'work_company'     => $value,
                        'work_designation' => $this->work_designation[$key],
                        'work_time_begin'  => $this->work_time_begin[$key],
                        'work_time_end'    => $this->work_time_end[$key],
                        'work_description' => $this->work_description[$key]
                    ];
                }
            }
            $model->works = $works;
        }

        if ($this->education_institute_name)
        {
            $education = [];
            foreach ($this->education_institute_name as $key => $value)
            {
                if (!empty($value))
                {
                    $education[] = [
                        'education_institute_name' => $value,
                        'education_degree'         => $this->education_degree[$key],
                        'education_time_begin'     => $this->education_time_begin[$key],
                        'education_time_end'       => $this->education_time_end[$key],
                        'education_description'    => $this->education_description[$key]
                    ];
                }
            }
            $model->education = $education;
        }
        if ($this->language_name)
        {
            $language = [];
            foreach ($this->language_name as $key => $value)
            {
                if (!empty($value))
                {
                    $language[] = [
                        'language_name'  => $value,
                        'language_level' => $this->language_level[$key],
                    ];
                }
            }
            $model->language = $language;
        }
        if (!empty($this->day && $this->month && $this->year))
        {
            $model->birthday = $this->day . '/' . $this->month . '/' . $this->year;
        }

        if ($this->category)
        {
            foreach ($this->category as $value)
            {
                $arr_cate[] = Category::findArray($value);
            }
            $model->category = $arr_cate;
        }

        if ($this->location)
        {
            $model->location = Location::findArray($this->location);
        }

        if ($this->program)
        {
            foreach ($this->program as $value)
            {
                $arr_pro[] = ProgrammingLanguage::findArray($value);
            }
            $model->program = $arr_pro;
        }
        if ($this->framework)
        {
            foreach ($this->framework as $value)
            {
                $arr_fr[] = Framework::findArray($value);
            }
            $model->framework = $arr_fr;
        }
        $model->save();
        return $model;
    }

}
