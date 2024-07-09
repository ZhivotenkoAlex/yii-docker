<?php

/** @var string $title */
/** @var \common\models\Brochure $brochure */
/** @var \common\models\Category $category */
/** @var \common\models\Page[] $pages */
/** @var \yii\web\View $this */

$category_name = mb_convert_case($category['name'], MB_CASE_TITLE);

$this->title = str_replace(
    ['{category_name}','{brochure_date_from}','{brochure_date_to}'],
    [$category_name, $brochure['start_date'],$brochure['end_date']],
    Yii::$app->params['meta']['brochure']['title']);
?>

<div class="single-project">
    <h1><?= $this->title ?></h1>

    <div id="brochure_gallery">
        <?php foreach ($pages as $page): ?>
	        <?php $image_jpg = str_replace('https://images.blovly.com', '/images', $page['image']) ?>
	        <?php $image_webp = preg_replace('/\.jpg$/', '.webp', $image_jpg) ?>

            <a href="<?= $image_webp ?>" style="display: block; margin-bottom: 10px">
                <img id='page<?= $page['number'] ?>'
                    src="<?= $image_webp ?>"
                    class="brochure-page img-responsive"
                    alt="<?= $title . ' page ' . $page['number'] ?>"
                    title="<?= $title . ' page ' . $page['number'] ?>"
                    data-slide-name='page<?= $page['number'] ?>'
                    loading='lazy'
                    onerror="this.src='<?= $image_jpg ?>';this.onerror=null;">
            </a>
        <?php endforeach;?>
    </div>
</div>
