<?php

/** @var \common\models\Category[] $models */

// Temporary solution to disable the search form till it's not needed
// It is not developed with firebase yet
$conditionToDisplayForm = false;

?>
<div class="mobile-menu-bar">
    <a class="logo" href="<?= \Yii::$app->urlBuilder->getCanonicalUrl() ?>">
        <?= \PELock\ImgOpt\ImgOpt::widget([
            "src" => "/images/logo.png",
            "alt" => "Blovly",
            "loading" => "lazy",
            "width" => '100%',
            'height' => '100%'
        ]) ?>
    </a>
    <a id="menu-toggle" class="elemadded responsive-link" href="#">Menu</a>
</div>

<span class="hidden"><?= \Yii::$app->request->absoluteUrl ?></span>

<div id="menu-box" class="menu-box">
    <ul class="menu">
        <?php if ($conditionToDisplayForm): ?>
        <li >
            <form action="<?= \Yii::$app->urlBuilder->getCanonicalUrl(null, null, ['search']) ?>">
                <input type="search" class="main-sidebar-search" name='string' placeholder="Search">
            </form>
        </li>
        <?php endif; ?>
        <?php foreach ($models as $model):
            $gaOnClick = 'ga_send_event(\'click\', \'custom_events\', \'open_company_from_menu\', \'' . $model['name'] . '\')';
	        $is_active = (strpos(\Yii::$app->request->getAbsoluteUrl(), "//{$model['urlname']}.") !== false);
        ?>
            <li>
                <a href="<?= \Yii::$app->urlBuilder->getCanonicalUrl($model) ?>" class="<?= ($is_active ? 'active' : '') ?>" onclick="<?= $gaOnClick ?>">
                    <span><?= $model['name'] ?></span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>