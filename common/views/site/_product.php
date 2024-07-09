<?php

/** @var \common\models\Product $model */

isset($wrap) or $wrap = null;
?>

<?php if ($wrap): ?>
	<div class="blog-post image-post">
<?php endif;?>
		<a href="<?= \Yii::$app->urlBuilder->getCanonicalUrl($model->brochure->category, $model->brochure) ?>" onclick="ga_send_event('click', 'custom_events', 'search_item_open', '<?= $model->name ?>')">
			<div class="inner-post">
				<div class="brochure-image-block">
					<picture>
						<source srcset="<?= $model->image ?>" type="image/jpeg">
						<img src="<?= $model->image ?>" alt="<?= $model->name ?>" title="<?= $model->name ?>"  width="400" height="auto">
					</picture>
				</div>

				<div class="post-content">
					<h2><?= $model->name ?></h2>
				</div>

				<ul class="post-tags">
					<li>
						<a href="#">
							<i class="fa fa-calendar"></i><?= date('M d, Y', strtotime($model->brochure->start_date)) ?> - <?= date('M d, Y', strtotime($model->brochure->end_date)) ?>
						</a>
					</li>
				</ul>
			</div>
		</a>
<?php if ($wrap): ?>
	</div>
<?php endif;?>