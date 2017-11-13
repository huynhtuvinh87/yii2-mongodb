<?php

namespace backend\models;

use common\models\Job;
use common\models\Category;
use common\models\ProgrammingLanguage;
use common\models\Framework;
use common\models\Location;
use common\models\Company;
use yii\web\UploadedFile;

/**
 * Job form
 */
class JobForm extends Job
{

    public $info_company;
    public $info_company_size;
    public $info_phone;
    public $info_email;
    public $info_address;
    public $info_fullname;
    public $info_tax_code;
    public $info_logo = '/uploads/logo/default.png';
    public $info_website;
    public $info_about;
    public $deadline_day;
    public $deadline_month;
    public $deadline_year;
    public $company_id;

    public function init()
    {
        if ($this->_id)
        {
            $job = Job::findOne($this->_id);
            $this->attributes = $job->attributes;
            $this->info_company = $job->company['name'];
            $this->info_fullname = $job->company['fullname'];
            $this->info_email = $job->company['email'];
            $this->info_phone = $job->company['phone'];
            $this->info_address = $job->company['address'];
            $this->info_website = $job->company['website'];
            $this->info_tax_code = $job->company['tax_code'];
            $this->info_logo = $job->company['logo'];
            $this->info_about = $job->company['about'];
            $this->info_company_size = $job->company['company_size'];
            $this->category = (string) $job->category['_id'];
            $this->location = (string) $job->location['_id'];
            $this->deadline_day = ($job->deadline['day'] < 10) ? (int) '0' . $job->deadline['day'] : $job->deadline['day'];
            $this->deadline_month = ($job->deadline['month'] < 10) ? (int) '0' . $job->deadline['month'] : $job->deadline['month'];
            $this->deadline_year = $job->deadline['year'];
            if ($job->programming)
            {
                foreach ($job->programming as $value)
                {
                    $_program[] = (string) $value['_id'];
                }
                $this->programming = $_program;
            }
            if ($job->framework)
            {
                foreach ($job->framework as $value)
                {
                    $_framework[] = (string) $value['_id'];
                }
                $this->framework = $_framework;
            }
            $this->company_id = (string) $job->company['_id'];
        }
    }

    public function rules()
    {
        return [
            [['title', 'description', 'category', 'programming', 'info_company', 'info_phone', 'info_fullname', 'info_about', 'deadline', 'responsibilities', 'request'], 'required'],
            [['category', 'programming', 'framework', 'location'], 'default'],
            [['info_company', 'info_phone', 'info_email', 'info_address', 'info_website', 'info_fullname', 'info_tax_code', 'info_company_size', 'sell_type', 'company_id', 'deadline_year', 'deadline_month', 'deadline_day'], 'string'],
            [['price_min', 'price_max', 'price_negotiable'], 'integer'],
            ['info_logo', 'file'],
            ['deadline', 'validateDay'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title'             => 'Tiêu đề công việc',
            'description'       => 'Mô tả công việc',
            'deadline'          => 'Hạn nộp hồ sơ',
            'info_company'      => 'Tên công ty',
            'info_phone'        => 'Số điện thoại',
            'info_email'        => 'Email',
            'info_address'      => 'Địa chỉ',
            'info_website'      => 'Website',
            'info_fullname'     => 'Người liên hệ',
            'info_about'        => 'Giới thiệu công ty',
            'info_tax_code'     => 'Mã số thuế',
            'info_company_size' => 'Quy mô công ty',
            'responsibilities'  => 'Trách nhiệm',
            'request'           => 'Yêu cầu',
            'location'          => 'Địa điểm',
            'programming'       => 'Ngôn ngữ lập trình',
            'category'          => 'Danh mục'
        ];
    }

    public function validateDay($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            if ($this->deadline_day && $this->deadline_month && $this->deadline_year)
            {
                $current_time = date('Y-m-d');
                $new_date = date($this->deadline_year . '-' . $this->deadline_month . '-' . $this->deadline_day);
                if ($new_date < $current_time)
                {
                    $this->addError($attribute, 'Thời gian nộp hộp sơ phải hơn thời gian hiện tại.');
                }
            } else
            {
                $this->addError($attribute, 'Ngày thàng năm không hợp lệ.');
            }
        }
    }

    public function categories($data = [])
    {
        $category = Category::find()->all();
        if (!empty($category))
        {
            foreach ($category as $key => $value)
            {
                $data[$value->id] = $value->title;
            }
            return $data;
        }
    }

    public function programs()
    {
        $model = ProgrammingLanguage::find()->all();
        if (!empty($model))
        {
            foreach ($model as $key => $value)
            {
                if (!empty($this->programming) && in_array($value->id, $this->programming))
                    $checked = 1;
                else
                    $checked = 0;
                $data[] = ['id' => $value->id, 'title' => $value->title, 'checked' => $checked];
            }
            return $data;
        }
    }

    public function frameworks()
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

    public function type()
    {
        return [
            'full_time' => 'Full time',
            'part_time' => 'Part time',
            'freelance' => 'Freelance',
            'contract'  => 'Contract'
        ];
    }

    public function locations()
    {
        $model = Location::find()->all();
        $data = [];
        foreach ($model as $value)
        {
            $data[$value->id] = $value->title;
        }
        return $data;
    }

    public function company()
    {
        $model = Company::find()->where(['author_id' => \Yii::$app->user->id])->all();
        $data[""] = 'Lấy thông tin công ty';
        foreach ($model as $value)
        {
            $data[$value->id] = $value->name;
        }
        return $data;
    }

    public function year()
    {
        for ($i = (int) date("Y"); $i <= (int) date("Y") + 1; $i++)
        {
            $data[$i] = $i;
        }
        return $data;
    }

    public function month()
    {
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

    public function savedata()
    {
        if ($this->validate())
        {

            if (!$model = Job::findOne($this->_id))
            {
                $model = new Job;
            }
            $model->attributes = $this->attributes;

            if ($this->category)
            {
                $model->category = Category::findArray($this->category);
            }

            if ($this->location)
            {
                $model->location = Location::findArray($this->location);
            }
            if ($this->programming)
            {
                foreach ($this->programming as $value)
                {
                    $arr_pro[] = ProgrammingLanguage::findArray($value);
                }
                $model->programming = $arr_pro;
            }
            if ($this->framework)
            {
                foreach ($this->framework as $value)
                {
                    $arr_fr[] = Framework::findArray($value);
                }
                $model->framework = $arr_fr;
            }
            $logo = UploadedFile::getInstance($this, 'info_logo');
            if (!empty($logo))
            {
                $name = 'logo_' . time() . '.' . $logo->extension;
                $logo->saveAs(\Yii::getAlias("@frontend/web/uploads/logo/") . $name);
                $this->info_logo = '/uploads/logo/' . $name;
            } else
            {
                $this->info_logo = '/uploads/logo/default.png';
            }
            $company = Company::savedata([
                        'company'      => $this->info_company,
                        'email'        => $this->info_email,
                        'phone'        => $this->info_phone,
                        'address'      => $this->info_address,
                        'tax_code'     => $this->info_tax_code,
                        'website'      => $this->info_website,
                        'fullname'     => $this->info_fullname,
                        'about'        => $this->info_about,
                        'company_size' => $this->info_company_size,
                        'logo'         => $this->info_logo
            ]);
            $model->deadline = [
                'year'  => (int) $this->deadline_year,
                'month' => (int) $this->deadline_month,
                'day'   => (int) $this->deadline_day
            ];

            $model->company = Company::findArray($company->id);
            $model->price_negotiable = (int) $this->price_negotiable;
            $model->save();
            return $model;
        }
    }

}
