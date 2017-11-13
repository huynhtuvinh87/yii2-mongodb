<?= $this->render('/layouts/menu_main') ?>

<!-- mainmenu-area-end -->
<!-- slider-area-start -->
<?= $this->render('/layouts/slide') ?>
<!-- slider-area-end -->
<!-- .slider-product-area-3-start -->
<div class="slider-product-area-3 mt-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="slider-product dotted-style-1 pt-20 res3">
                    <div class="slider-product-active-3">
                        <?php
                        $nb = Yii::$app->setting->widget('wd-nb')['product'];
                        if (!empty($nb)) {
                            foreach ($nb as $value) {
                                ?>
                                <div class="single-product single-product-sidebar white-bg">
                                    <div class="product-img product-img-left">
                                        <a href="<?= $value->url ?>"><img src="<?= $value->picture ?>" alt="<?= $value->title ?>" /></a>
                                    </div>
                                    <div class="product-content product-content-right">
                                        <div class="pro-title">
                                            <h4><a href="<?= $value->url ?>"><?= $value->excerpt($value->title, 20) ?></a></h4>
                                        </div>
                                        <div class="pro-rating ">
                                            <?php
                                            for ($i = 1; $i < 6; $i++) {
                                                if ($i <= $value->rating) {
                                                    echo '<a href="#"><i class="fa fa-star"></i></a>';
                                                } else {
                                                    echo ' <a href="#"><i class="fa fa-star-o"></i></a>';
                                                }
                                            }
                                            echo ' ('.$value->countReview.')';
                                            ?>
                                        </div>
                                        <div class="price-box">
                                            <span class="price product-price"><?= $value->price ? number_format($value->price, 0, '', '.') : 0 ?>₫</span>
                                        </div>
                                    </div>					
                                </div>	
                                <?php
                            }
                        }
                        ?>

                    </div>
                </div>					
            </div>
        </div>
    </div>
</div>
<!-- .slider-product-area-3-end -->
<!-- product-tab-area-2-start -->
<!-- product-tab-area-2-end -->
<!-- all-product-area-start -->
<div class="all-product-area pb-60 pt-20">
    <div class="container">
        <?php
        if (!empty($category)) {
            foreach ($category as $value) {
                if (!empty($value->products())) {
                    ?>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <!-- new-product-area -->
                            <div class="new-product-area dotted-style-2 mb-40">
                                <div class="section-title">
                                    <h3><?= $value->title ?></h3>
                                </div>

                                <div class="new-product-active border-1">
                                    <?php
                                    foreach ($value->products() as $k => $p) {
                                        ?>
                                        <div class="new-product-items <?= ($k == 0) ? 'single-product-border-left' : "" ?>">
                                            <div class="single-product  white-bg">
                                                <div class="product-img"  style="padding:15px">
                                                    <a href="<?= $p->url ?>"><img src="<?= $p->picture ?>" alt="" /></a>
                                                </div>
                                                <div class="product-content product-i">
                                                    <div class="pro-title">
                                                        <h4><a href="<?= $p->url ?>"><?= $p->excerpt($p->title, 50) ?></a></h4>
                                                    </div>
                                                    <div class="pro-rating ">
                                                        <?php
                                                        for ($i = 1; $i < 6; $i++) {
                                                            if ($i <= $p->rating) {
                                                                echo '<a href="#"><i class="fa fa-star"></i></a>';
                                                            } else {
                                                                echo ' <a href="#"><i class="fa fa-star-o"></i></a>';
                                                            }
                                                        }
                                                        echo ' ('.$p->countReview.')';
                                                        ?>
                                                    </div>
                                                    <div class="price-box">
                                                        <span class="price product-price"><?= $p->price ? number_format($p->price, 0, '', '.') : 0 ?>₫</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>


                    <?php
                }
            }
        }
        ?>
    </div>
</div>
<!-- all-product-area-end -->

<!-- blog-area-start -->
<div class="blog-area dotted-style-2  pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h3>Blog</h3>
                </div>					
            </div>
        </div>
        <div class="row">
            <div class="blog-active">
                <?php
                $blog = Yii::$app->setting->blog(12);
                if (!empty($blog)) {
                    foreach ($blog as $value) {
                        ?>
                        <div class="col-lg-12">
                            <div class="single-blog">
                                <div class="blog-img">
                                    <img width="110" height="110" src="<?= $value->picture ?>" alt="<?= $value->title ?>" />
                                </div>
                                <div class="blog-content-inner">
                                    <div class="blog-content white-bg">
                                        <a href="<?= $value->url ?>"><h4><?= $value->title ?></h4></a>
                                        <p class="mb-0"><?= $value->excerpt($value->description, 100) ?></p>
                                        <a href="<?= $value->url ?>" class="read-more text-capitalize">Chi tiết <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>							
                                </div>
                            </div>
                        </div>	
                        <?php
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>
<!-- blog-area-end -->
