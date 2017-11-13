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
                                        Xin chào, <?= $data->name ?>.
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        Vui lòng xác nhận địa chỉ email của bạn bằng cách nhấp vào liên kết bên dưới để kích hoạt tài khoản.
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block" itemprop="handler" itemscope itemtype="http://schema.org/HttpActionHandler">
                                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(["site/active?email=" . $data->email . '&auth=' . $data->auth_key]) ?>" class="btn-primary" itemprop="url">Xác nhận tài khoản</a>
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
