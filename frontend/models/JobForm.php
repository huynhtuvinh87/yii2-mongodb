<?php

namespace frontend\models;

use Yii;
use common\models\Job;
use common\models\Category;
use common\models\ProgrammingLanguage;
use common\models\Framework;
use common\models\Location;
use common\models\Company;
use common\components\Constant;
use yii\web\UploadedFile;
use Carbon\Carbon;

/**
 * Job form
 */
class JobForm extends Job
{

    public $company_name;
    public $company_size;
    public $company_phone;
    public $company_email;
    public $company_address;
    public $company_fullname;
    public $company_tax_code;
    public $company_logo = '/uploads/logo/default.png';
    public $company_website;
    public $company_about;
    public $company_id;
    public $sell_type = Constant::JOB_TYPE_FULLTIME;
    public $_company;

    public function init()
    {
        if ($this->_id)
        {
            $job = Job::findOne($this->_id);
            $this->attributes = $job->attributes;
            $this->company_name = $job->company['name'];
            $this->company_email = $job->company['email'];
            $this->company_phone = $job->company['phone'];
            $this->company_address = $job->company['address'];
            $this->company_website = $job->company['website'];
            $this->company_tax_code = $job->company['tax_code'];
            $this->company_logo = $job->company['logo'];
            $this->company_about = $job->company['about'];
            $this->company_size = $job->company['company_size'];
            $this->category = (string) $job->category['_id'];
            $this->location = (string) $job->location['_id'];
            $this->deadline = date('d/m/Y', $job->deadline);
            if ($job->program)
            {
                foreach ($job->program as $value)
                {
                    $_program[] = (string) $value['_id'];
                }
                $this->program = $_program;
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
        $this->_company = Yii::$app->mongodb->getCollection('company');
    }

    public function rules()
    {
        return [
            [['title', 'description', 'category', 'program', 'company_name', 'company_phone', 'company_about', 'deadline', 'responsibilities', 'request'], 'required'],
            [['framework', 'location'], 'default'],
            [['company_name', 'company_phone', 'company_email', 'company_address', 'company_website', 'company_tax_code', 'company_size', 'company_id'], 'string'],
            [['price_min', 'price_max', 'price_negotiable', 'sell_type'], 'integer'],
            ['company_logo', 'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title'            => 'Tiêu đề công việc',
            'description'      => 'Mô tả công việc',
            'deadline'         => 'Hạn nộp hồ sơ',
            'company_name'     => 'Tên công ty',
            'company_phone'    => 'Số điện thoại',
            'company_email'    => 'Email',
            'company_address'  => 'Địa chỉ',
            'company_website'  => 'Website',
            'company_about'    => 'Giới thiệu công ty',
            'company_tax_code' => 'Mã số thuế',
            'company_size'     => 'Quy mô công ty',
            'responsibilities' => 'Trách nhiệm',
            'request'          => 'Yêu cầu',
            'location'         => 'Địa điểm',
            'program'          => 'Ngôn ngữ lập trình',
            'category'         => 'Danh mục'
        ];
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
            $model->author_id = \Yii::$app->user->id;
            $model->deadline = Carbon::parse($this->deadline)->timestamp;
            if ($this->category)
            {
                $model->category = Category::findArray($this->category);
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
            $logo = UploadedFile::getInstance($this, 'company_logo');
            if (!empty($logo))
            {
                $name = 'logo_' . time() . '.' . $logo->extension;
                $logo->saveAs(\Yii::getAlias("@frontend/web/uploads/logo/") . $name);
                $this->company_logo = '/uploads/logo/' . $name;
            } else
            {
                $this->company_logo = '/uploads/logo/default.png';
            }
            $company = Company::findOne($this->company_id);
            $company_array = [
                'author_id'    => Yii::$app->user->id,
                'company'      => $this->company_name,
                'email'        => $this->company_email,
                'phone'        => $this->company_phone,
                'address'      => $this->company_address,
                'tax_code'     => $this->company_tax_code,
                'website'      => $this->company_website,
                'about'        => $this->company_about,
                'company_size' => $this->company_size,
                'logo'         => $this->company_logo
            ];
            if ($company)
            {
                $this->_company->update(['_id' => $this->company_id], $company_array);
            } else
            {
                $this->company_id = (string) $this->_company->insert($company_array);
            }
            $model->company = Company::findArray($this->company_id);
            $model->price_negotiable = (int) $this->price_negotiable;
            $model->save();
            return $model;
        }
    }

}
