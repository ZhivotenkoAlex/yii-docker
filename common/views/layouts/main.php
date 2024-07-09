<?php

/** @var common\components\View $this */
/** @var string $content */

use common\assets\AppAsset;
use yii\bootstrap5\Html;
use common\helpers\Url;

AppAsset::register($this);

$baseUrl = Url::base(true);

$google_tag_id = Yii::$app->params['ga_id'];
$google_site_verification = Yii::$app->params['google_site_verification'];
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html amp lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta property="og:url" content="<?= \Yii::$app->request->absoluteUrl ?>"/>
        <meta property="og:image" content="<?= $baseUrl ?>/webassets/images/blovly-logo-be-lovely-black.png"/>
        <?= $google_site_verification ? '<meta name="google-site-verification" content="' . $google_site_verification .'" />' : ''?>
        <link rel="canonical" href="<?= $this::getCanonical() ?>">
        <link rel="amphtml" href="<?= $baseUrl ?>/amp<?= \Yii::$app->request->getUrl() ?>">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="preload" href="https://fonts.googleapis.com/css?family=Roboto" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        </noscript>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="/favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <?php if ($google_tag_id) { ?>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','<?= $google_tag_id ?>');</script>
        <!-- End Google Tag Manager -->
        <?php } ?>

        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <style type="text/css" media="screen">
            .preloader {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #FFFFFF;
                -webkit-backface-visibility: hidden;
                transition: all 0.17s ease-in-out;
                -moz-transition: all 0.17s ease-in-out;
                -webkit-transition: all 0.17s ease-in-out;
                -o-transition: all 0.17s ease-in-out;
                display: flex;
                align-items: center;
                justify-content: center;
                align-content: center;
                align-self: center;
                z-index: 9999;
            }
            .lds-dual-ring {
                display: inline-block;
                width: 80px;
                height: 80px;
            }
            .lds-dual-ring:after {
                content: " ";
                display: block;
                width: 64px;
                height: 64px;
                margin: 8px;
                border-radius: 50%;
                border: 6px solid #ed0000;
                border-color: #ed0000 transparent #ed0000 transparent;
                animation: lds-dual-ring 1.2s linear infinite;
            }
            @keyframes lds-dual-ring {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg);
                }
            }
        </style>
        <?php $this->head() ?>
    </head>
    <body>
        

        <div id="container">
            <header>
                <div class="logo-box">
                    <a class="logo" href="<?= \Yii::$app->urlBuilder->getCanonicalUrl() ?>">
                        <?= \PELock\ImgOpt\ImgOpt::widget([
                            "src" => "/images/logo.png",
                            "alt" => "Blovly",
                            "loading" => "lazy",
                            "width" => '100%',
                            'height' => '100%'
                        ]) ?>
                    </a>
                </div>

                <?= \common\widgets\sidebar\Sidebar::widget() ?>

                <div class="social-box">
                    <p class="copyright">
                        <a href="https://www.2take.it/" rel="nofollow" target="_blank">Powered by 2take.it</a>
                    </p>
                </div>
            </header>

            <div id="content">
                <div class="inner-content">
                    <?= $content ?>
                </div>
            </div>
        </div>
        <!-- End Container -->

        <div class="preloader">
            <img alt="Gazetki preloader" title="Gazetki preloader" src="/images/loading.gif" loading="eager">
<!--            <div class="lds-dual-ring"></div>-->
        </div>

        <?php if ($google_tag_id) { ?>
            <!-- Google Tag Manager (noscript) -->
            <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= $google_tag_id ?>"
                              height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
            <!-- End Google Tag Manager (noscript) -->
        <?php } ?>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
