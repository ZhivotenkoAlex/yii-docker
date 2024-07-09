<?php

/** @var \common\models\Category[] $models */

use common\helpers\Url;
?>

<amp-script layout="container" script="toggle" class="amp-my-custom-script-menu">
    <div class="mobile-menu-bar">
        <amp-img
                src="<?= Url::base(true) ?>/images/logo.png"
                alt="Blovly"
                title="Blovly"
                width="98"
                height="57"
                layout="responsive"
        ></amp-img>

        <a id="menu-toggle" class="elemadded responsive-link" href="#">Menu</a>
    </div>

    <div id="menu-box" class="menu-box">
        <ul class="menu">
            <li>
                <form method="get" action="<?= \Yii::$app->urlBuilder->getCanonicalUrl(null, null, ['amp', 'search']) ?>" target="_top">
                    <input type="search" class="main-sidebar-search" name='string' placeholder="Search...">
                </form>
            </li>
            <?php foreach ($models as $model):
                $is_active = (strpos(\Yii::$app->request->getAbsoluteUrl(), "//{$model->urlname}.") !== false);
            ?>
                <li>
                    <a href="<?= \Yii::$app->urlBuilder->getCanonicalUrl($model, null, ['amp']) ?>"
                       class="<?= ($is_active ? 'active' : '') ?>">
                        <span><?= $model->name ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script id="toggle" type="text/plain" target="amp-script">
        const menuToggle = document.getElementById('menu-toggle');
        menuToggle.addEventListener('click', () => {
          var nav = document.getElementById('menu-box');
          nav.classList.toggle('nav-menu-active');
        });
    </script>
</amp-script>