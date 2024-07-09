<?php

/** @var \common\models\Category[] $all_sieci */
/** @var yii\web\View $this */

?>

<div class="portfolio-page">
    <h1 class="mt-0"><?= $this->title ?></h1>

    <div class="portfolio-box">
	    <?php foreach ($all_sieci as $siec_category): ?>
	        <?php $siec_name = ucwords(htmlspecialchars($siec_category->name, ENT_QUOTES, 'UTF-8')); ?>

            <div class="project-post main-box">
                <a href="<?= \Yii::$app->urlBuilder->getCanonicalUrl($siec_category, null, ['amp']) ?>">
                    <amp-img
                        alt="Gazetki promocyjne <?= $siec_name ?>"
                        src="/images/stores/<?= $siec_category->urlname ?>.webp"
                        height="250"
                        width="250"
                        layout="responsive"></amp-img>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>