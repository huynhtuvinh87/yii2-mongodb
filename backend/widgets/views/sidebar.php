<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\widgets\Menu;
?>
<div class="left_col scroll-view">

    <div class="navbar nav_title" style="border: 0;padding:15px 10px 15px 0;">
        <a href="http://<?= $_SERVER['HTTP_HOST'] ?>" class="site_title">
            ADMINSTRATOR
        </a>
        <a href="http://<?= $_SERVER['HTTP_HOST'] ?>" class="site_title site_title_sm">
            ADMINSTRATOR
        </a>
    </div>
    <div class="clearfix"></div>


    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

        <div class="menu_section ">
            <?php
            echo Menu::widget([
                'items'           => [
                    ['label' => '<i class="fa fa-tachometer"></i> Trang chủ', 'url' => ['site/index']],
                    ['label' => '<i class="fa fa-thumb-tack"></i> Việc làm' . '<span class="fa fa-chevron-down"></span>', 'url'   => 'javascript:void(0)', 'items' => [
                            ['label' => 'Danh mục', 'url' => ['category/index']],
                            ['label' => 'Ngôn ngữ lập trình', 'url' => ['programming/index']],
                            ['label' => 'Framework', 'url' => ['framework/index']],
                            ['label' => 'Việc làm', 'url' => ['job/index']],
                        ],
                    ],
//                    ['label' => '<i class="fa fa-thumb-tack"></i> Company' . '<span class="fa fa-chevron-down"></span>', 'url'   => 'javascript:void(0)', 'items' => [
//                            ['label' => 'Category', 'url' => ['categorycompany/index']],
//                            ['label' => 'All Company', 'url' => ['postcompany/index']],
//                            ['label' => 'Add New', 'url' => ['postcompany/create']],
//                        ],
//                    ],
                    ['label' => '<i class="fa fa-cog"></i> Địa điểm', 'url'   => ['location/index'],
                    ],
                    ['label' => '<i class="fa fa-user"></i> Người tìm việc<span class="fa fa-chevron-down"></span>', 'url'   => 'javascript:void(0)', 'items' => [
                            ['label' => 'Danh sách', 'url' => ['member/index']],
                            ['label' => 'Thêm mới', 'url' => ['member/create']],
                        ],
                    ],
                    ['label' => '<i class="fa fa-user"></i> Nhà tuyển dụng<span class="fa fa-chevron-down"></span>', 'url'   => 'javascript:void(0)', 'items' => [
                            ['label' => 'Danh sách', 'url' => ['boss/index']],
                            ['label' => 'Thêm mới', 'url' => ['boss/create']],
                        ],
                    ],
                    ['label' => '<i class="fa fa-user"></i> Quản trị <span class="fa fa-chevron-down"></span>', 'url'   => 'javascript:void(0)', 'items' => [
                            ['label' => \Yii::t('app', 'Lists'), 'url' => ['admin/index']],
                            ['label' => \Yii::t('app', 'Create'), 'url' => ['admin/create']],
                        ],
                    ],
                    ['label' => '<i class="fa fa-cog"></i> Cấu hình', 'url'   => ['setting/index'],
                    ],
                ],
                'encodeLabels'    => false,
                'submenuTemplate' => "\n<ul class='nav child_menu' style='display: none'>\n{items}\n</ul>\n",
                'options'         => array('class' => 'side-menu nav')
            ]);
            ?>

        </div>


    </div>

</div>