<table class="body-wrap">
    <tr>
        <td></td>
        <td class="container" width="600">
            <div class="content">
                <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="http://schema.org/ConfirmAction">
                    <tr>
                        <td class="content-wrap">
                            <meta itemprop="name" content="Confirm Email"/>
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="content-block">
                                        Xin chào, <?= $data->user->name ?>.
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        <?= $data->title ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        <?= $data->description ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block" itemprop="handler" itemscope itemtype="http://schema.org/HttpActionHandler">
                                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(["/job/" . $data->slug]) ?>" class="btn-primary" itemprop="url">Xem chi tiết</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        &mdash;  Support Vndeed,
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
        <td></td>
    </tr>
</table>
