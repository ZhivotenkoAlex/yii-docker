<?php

/** @var string $title */
/** @var \common\models\Page[] $pages */
/** @var \common\models\Brochure $brochure */
/** @var \common\models\Category $category */
/** @var \yii\web\View $this */
?>

<div class="single-project">
    <h1><?= $this->title ?></h1>

    <div id="brochure_gallery" class="blog-box">
        <?php foreach ($pages as $page): ?>
            <?php $image_jpg = str_replace('https://images.blovly.com', '/images', $page->image) ?>

            <amp-img id="page<?= $page->number ?>"
                src="<?= $image_jpg ?>"
                class="brochure-page"
                alt="<?= $title . ' page ' . $page->number ?>"
                title="<?= $title . ' page ' . $page->number ?>"
                data-slide-name="page<?= $page->number ?>"
                width="459"
                height="722"
                layout="responsive"></amp-img>

            <br>
        <?php endforeach;?>
    </div>
</div>
