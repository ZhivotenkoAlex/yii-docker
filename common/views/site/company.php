<?php

use yii\widgets\ListView;

/** @var string $title */
/** @var \common\models\Category $category */
/** @var \yii\data\DataProviderInterface $brochures */
/** @var \yii\data\DataProviderInterface $archive */
/** @var \yii\web\View $this */

$description = 'Aktualne promicję w sieci ' . mb_convert_case($category['name'], MB_CASE_TITLE) . '. Znajdź coś dla siebie na stronie iulotka.com';
$this->title = str_replace('{category_name}', $category['name'], Yii::$app->params['meta']['category']['title']);
?>

<div class="single-project">
    <?php if (count($brochures)): ?>
        <h1 style="text-transform: capitalize;"><?= $this->title ?></h1>

	    <?= ListView::widget([
            'id' => 'actual_list_view',
		    'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $brochures]),
		    'itemView' => '_leaflet',
		    'summary' => false,
		    'layout' => '<div class="blog-box">{items}</div>{pager}',
            'emptyText' => 'Brak wyników',
		    'itemOptions' => [
			    'class' => ['blog-post', 'image-post']
		    ],
		    'pager' => [
			    'maxButtonCount' => 7
		    ]
	    ]) ?>
    <?php endif;?>

    <?php if (count($archive)): ?>
        <h2>Archiwum gazetek <span style="text-transform: capitalize;"><?= $category['name'] ?></span></h2>

        <?= ListView::widget([
            'id' => 'archive_list_view',
            'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $archive]),
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function blocksHeight() {
            var blocks = $('.brochure-image-block'),
                maxHeight = 0,
                titles = $('.post-content'),
                titlesMaxHeight = 0;

            blocks.each(function (index, el) {
                var eqipmentHeight = parseInt($(this).height());
                eqipmentHeight > maxHeight ? maxHeight = eqipmentHeight : false;
            });

            titles.each(function (index, el) {
                var titleHeight = parseInt($(this).height());
                titleHeight > titlesMaxHeight ? titlesMaxHeight = titleHeight : false;
            });

            blocks.height(maxHeight);
            titles.height(titlesMaxHeight);
            blocks.find('img').css({'height': '100%', 'width': 'auto'})
        }

        var $container = $('.portfolio-box, .blog-box');

        $container.imagesLoaded(function () {
            blocksHeight();
        });
    });
</script>