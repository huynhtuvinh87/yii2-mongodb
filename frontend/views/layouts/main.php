<?php
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<html lang="en">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="shortcut icon" href="<?= Yii::$app->urlManager->createAbsoluteUrl('/images/icon/favicon.ico') ?>">
        <?php $this->head() ?>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Template Developed By ThemeRegion -->

    </head>
    <body>
        <?php $this->beginBody() ?>
        <!-- header -->
        <header id="header" class="clearfix">
            <!-- navbar -->
            <nav class="navbar navbar-default">
                <div class="container">
                    <!-- navbar-header -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?= Yii::$app->urlManager->createAbsoluteUrl('/') ?>"><img class="img-responsive" src="/theme/images/logo.png" alt="Logo"></a>
                    </div>
                    <!-- /navbar-header -->

                    <div class="navbar-left">
                        <div class="collapse navbar-collapse" id="navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="/">Trang chủ</a></li>
                                <li><a href="/job">Người tìm việc</a></li>
                                <li><a href="/member">Nhà tuyển dụng</a></li>

                            </ul>
                        </div>
                    </div><!-- navbar-left -->

                    <!-- nav-right -->
                    <div class="nav-right">				

                        <?php
                        if (\Yii::$app->user->isGuest)
                        {
                            ?>
                            <ul class="sign-in sign-guest">
                                <li><i class="fa fa-user"></i></li>
                                <li><a href = "/site/login">Đăng nhập</a></li>
                                <li><a href = "/site/signup">Đăng ký</a></li>
                            </ul>
                            <?php
                        } else
                        {
                            ?>
                            <ul class="sign-in">

                                <li class="dropdown topuser">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                        <img style="width: 40px; float: left" src="<?= Yii::$app->user->identity->avatar ?>" alt="User Images" class="img-responsive">
                                        <span><?= Yii::$app->user->identity->name ?> <i class="caret"></i></span>

                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><?= Html::a('Thông tin cá nhân', ['manager/profile']) ?></li>
                                        <li><?= Html::a('Thay đổi mật khẩu', ['manager/profile/password']) ?></li>
                                        <li><?= Html::a('Hồ sơ của bạn', ['manager/resume']) ?></li>
                                        <li><?= Html::a('Công việc đã apply', ['manager/job/apply']) ?></li>
                                        <li><?= Html::a('Thoát', ['site/logout']) ?></li>
                                        <li></li>
                                    </ul>
                                </li>
                            </ul><!-- sign-in -->	
                            <?php
                        }
                        ?>



                    </div>
                    <!-- nav-right -->
                </div><!-- container -->
            </nav><!-- navbar -->
        </header><!-- header -->

        <?= $content ?>
        <!-- footer -->
        <footer id="footer" class="clearfix">
            <!-- footer-top -->
            <section class="footer-top clearfix">
                <div class="container">
                    <div class="row">
                        <!-- footer-widget -->
                        <div class="col-sm-3">
                            <div class="footer-widget">
                                <h3>Về chúng tôi</h3>
                                <ul>
                                    <li><a href="#">Giới thiệu</a></li>
                                    <li><a href="#">Liên hệ</a></li>
                                    <li><a href="#">Tuyển dụng</a></li>
                                    <li><a href="#">Trợ giúp và hỗ trợ</a></li>
                                    <li><a href="#">Quảng cáo với chúng tôi</a></li>
                                </ul>
                            </div>
                        </div><!-- footer-widget -->

                        <!-- footer-widget -->
                        <div class="col-sm-3">
                            <div class="footer-widget">
                                <h3>Làm thế nào để tuyển nhanh</h3>
                                <ul>
                                    <li><a href="#">Làm thế nào để tuyển nhanh</a></li>
                                    <li><a href="#">Câu hỏi thường gặp</a></li>
                                </ul>
                            </div>
                        </div><!-- footer-widget -->

                        <!-- footer-widget -->
                        <div class="col-sm-3">
                            <div class="footer-widget social-widget">
                                <h3>Theo dõi chúng tôi tại</h3>
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook-official"></i>Facebook</a></li>
                                    <li><a href="#"><i class="fa fa-twitter-square"></i>Twitter</a></li>
                                    <li><a href="#"><i class="fa fa-google-plus-square"></i>Google+</a></li>
                                    <li><a href="#"><i class="fa fa-youtube-play"></i>youtube</a></li>
                                </ul>
                            </div>
                        </div><!-- footer-widget -->

                        <!-- footer-widget -->
                        <div class="col-sm-3">
                            <div class="footer-widget news-letter">
                                <h3>Newsletter</h3>
                                <p>Jobs is Worldest leading Portal platform that brings!</p>
                                <!-- form -->
                                <form action="#">
                                    <input type="email" class="form-control" placeholder="Your email id">
                                    <button type="submit" class="btn btn-primary">Sign Up</button>
                                </form><!-- form -->			
                            </div>
                        </div><!-- footer-widget -->
                    </div><!-- row -->
                </div><!-- container -->
            </section><!-- footer-top -->

            <div class="footer-bottom clearfix text-center">
                <div class="container">
                    <p>Copyright &copy; <a href="#">Jobs</a> 2017. Developed by huynhtuvinh87@gmail.com</p>
                </div>
            </div><!-- footer-bottom -->
        </footer><!-- footer -->

        <?php $this->endBody() ?>
    </body>

</html>
<?php $this->endPage() ?>
