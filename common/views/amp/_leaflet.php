<?php

/** @var \common\models\Brochure $model */

isset($wrap) or $wrap = null;

$image_jpg = str_replace('https://images.blovly.com', '/images', $model->image);
$image_webp = preg_replace('/\.jpg$/', '.webp', $image_jpg); ?>

<?php if ($wrap): ?>
	<div class="blog-post image-post">
<?php endif;?>
		<a href="<?= \Yii::$app->urlBuilder->getCanonicalUrl($model->category, $model, ['amp']) ?>" data-pjax="0">
			<div class="inner-post">
				<div class="brochure-image-block">
					<amp-img alt="<?= $model->name ?>"
					         src="<?= $image_jpg ?>"
					         height="400"
					         layout="fixed-height"></amp-img>
				</div>

				<div class="post-content">
					<h2><?= $model->name ?></h2>
				</div>

				<ul class="post-tags">
					<li>
						<a href="#">
							<i class="fa fa-calendar"></i>
							<?= \Yii::$app->formatter->asDate($model->start_date, 'medium') ?> - <?= \Yii::$app->formatter->asDate($model->end_date, 'medium') ?>
						</a>
					</li>
				</ul>
			</div>
		</a>
<?php if ($wrap): ?>
	</div>
<?php endif;?>