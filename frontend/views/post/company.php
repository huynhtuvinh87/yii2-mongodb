<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>
<div id="columns" class="columns-container">
    <div class="bg-top"></div>
    <div class="warpper">
        <!-- container -->
        <div class="container">
            <div class="post-a-project">
                <h1 class="title_block">Đăng tin công ty</h1>
                <div class="box clearfix">
                    <div class="box-content">
                        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'form-horizontal']]) ?>
                        <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label() ?>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <?= $form->field($model, 'tax_code')->textInput(['maxlength' => true])->label() ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <?= $form->field($model, 'establishment_date')->textInput(['maxlength' => true])->label() ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-step">
                                <label>What type of work do you require?</label>
                                <select id="selectCategories" class="form-control">
                                    <option>Select a category of work</option>
                                    <option>Websites IT & Software</option>
                                    <option>Mobile</option>
                                    <option>Writing</option>
                                    <option>Design</option>
                                    <option>Data Entry</option>
                                    <option>Product Sourcing & Manufacturing</option>
                                    <option>Sales & Marketing</option>
                                    <option>Business, Accounting & Legal</option>
                                    <option>Local Jobs & Services</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>What is your project about?</label>
                                <input class="form-control" type="text" id="textProject" name="textProject" placeholder="Eg: Design a website">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?= $form->field($model, 'content')->textarea() ?></div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Skill Required</label>
                                <input class="form-control" type="text" id="textSkill" name="textSkill" placeholder="Eg: UI/UX Design...">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-step">
                                <label>Budget</label>
                                <input class="form-control" type="text" id="textBudget" name="textBudget" placeholder="Eg: $229.00">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Exp Date</label>
                                <input class="form-control" type="text" id="textDate" name="textDate" placeholder="Eg: June 15th 2016">
                            </div>
                        </div>
                        <div class="choose-plan">
                            <h4 class="title_block">Choose the pricing plan that fits your needs</h4>
                            <fieldset>
                                <div class="checkbox">
                                    <input type="checkbox" name="chkbxFeatured" value="">
                                    <p class="plan-headding"><span>Featured</span>   -   $50.00<p>
                                    <p>Your job will be displayed as normal for 30 days and always in 1st page</p>
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" name="chkbxStandard" value="">
                                    <p class="plan-headding"><span>Standard</span>   -   30.00<p>
                                    <p>Your job will be displayed as normal for 20 days and always in 1st page</p>
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" name="chkbxFree" value="">
                                    <p class="plan-headding"><span>Free</span>   -   0.00<p>
                                    <p>Your job will be displayed as normal for 5 days</p>
                                </div>
                            </fieldset>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left">
                                <p>By clicking 'Post Project', you are indicating that you have read and agree to the <a href="#" title="Terms & Conditions">Terms & Conditions</a> and <a href="#" title="Privacy Policy">Privacy Policy</a></p>
                            </div> 
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
                                <button type="submit" class="btn button btn-primary btn-shadown">Submit your message</button>
                            </div> 
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div><!-- end post-a-project -->
        </div><!-- end container -->
    </div><!-- end warpper -->
    <div class="bg-bottom"></div>
</div><!--end warp-->
