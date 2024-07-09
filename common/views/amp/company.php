<?php

use yii\widgets\ListView;

/** @var string $title */
/** @var \common\models\Category $category */
/** @var \yii\data\DataProviderInterface $brochures */
/** @var \yii\data\DataProviderInterface $archive */
/** @var \yii\web\View $this */

$description = 'Aktualne promicję w sieci ' . mb_convert_case($category['name'], MB_CASE_TITLE) . '. Znajdź coś dla siebie na stronie iulotka.com';
?>

<div class="single-project">
	<?php if ($brochures->getCount()): ?>
        <h1 style="text-transform: capitalize;"><?= $this->title ?></h1>

		<?= ListView::widget([
			'dataProvider' => $brochures,
			'itemView' => '_leaflet',
			'summary' => false,
			'layout' => '<div class="blog-box">{items}</div>{pager}',
			'itemOptions' => [
				'class' => ['blog-post', 'image-post']
			],
			'pager' => [
				'maxButtonCount' => 7
			]
		]) ?>
    <?php endif;?>

	<?php if ($archive->getCount()): ?>
        <h2>Archiwum gazetek <span style="text-transform: capitalize;"><?= $category['name'] ?></span></h2>

		<?= ListView::widget([
			'dataProvider' => $archive,
			'itemView' => '_leaflet',
			'summary' => false,
			'layout' => '<div class="blog-box">{items}</div>{pager}',
			'itemOptions' => [
				'class' => ['blog-post', 'image-post']
			],
			'pager' => [
				'maxButtonCount' => 7
			]
		]) ?>
    <?php endif;?>

    <div class="single-box" style="margin: 12px;">
        <div class="single-box-content" style="width: 100%">
            <div class="project-post-content">
                <div class="project-text">
                    <p><?= $description ?></p>
                </div>
            </div>
        </div>
    </div>
</div>