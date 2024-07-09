<?php

use yii\widgets\ListView;

/** @var string $title */
/** @var string $searchString */
/** @var \yii\data\DataProviderInterface $products */
/** @var \yii\data\DataProviderInterface $brochures */
/** @var \common\components\View $this */

$this->title = $title;
?>

<div class="single-project">
    <h1 class="text-center mb-5"><?= $searchString ?> - wyniki wyszukiwania</h1>

    <?php if (!$brochures->getTotalCount() && !$products->getTotalCount()): ?>
        <p class="text-center text-muted">Brak wyników</p>
    <?php else: ?>
        <?php if ($brochures->getCount()): ?>
            <h2>Gazetki (<?= $brochures->getTotalCount() ?>)</h2>

		    <?= ListView::widget([
			    'id' => 'leaflet_list_view',
			    'dataProvider' => $brochures,
			    'itemView' => '_leaflet',
			    'summary' => false,
			    'layout' => '<div class="search-box">{items}</div>{pager}',
			    'emptyText' => 'Brak wyników',
			    'itemOptions' => [
				    'class' => ['blog-post', 'image-post']
			    ],
			    'pager' => [
				    'maxButtonCount' => 7
			    ]
		    ]) ?>
        <?php endif;?>

	    <?php if ($products->getCount()): ?>
            <h2>Produkty (<?= $products->getTotalCount() ?>)</h2>

		    <?= ListView::widget([
			    'id' => 'product_list_view',
			    'dataProvider' => $products,
			    'itemView' => '_product',
			    'summary' => false,
			    'layout' => '<div class="search-box">{items}</div>{pager}',
			    'emptyText' => 'Brak wyników',
			    'itemOptions' => [
				    'class' => ['blog-post', 'image-post']
			    ],
			    'pager' => [
				    'maxButtonCount' => 7
			    ]
		    ]) ?>
	    <?php endif;?>
    <?php endif;?>
</div>

<script>
    window.addEventListener('load', function () {
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
            titles.height(titlesMaxHeight + 30);
            blocks.find('img').css({'height': '100%', 'width': 'auto'})
        }

        var $container = $('.portfolio-box, .blog-box');

        $container.imagesLoaded(function () {
            blocksHeight();
        });
    });
</script>