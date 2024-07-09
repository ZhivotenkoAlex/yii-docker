<?php

use common\helpers\Url;

/** @var \common\models\Product $model */

isset($wrap) or $wrap = null;
?>

<?php if ($wrap): ?>
	<div class="blog-post image-post">
<?php endif;?>
		<a href="<?= \Yii::$app->urlBuilder->getCanonicalUrl($model->brochure->category, $model->brochure, ['amp']) ?>">
			<div class="inner-post">
				<div class="brochure-image-block">
                    <amp-img
                            alt="<?= $model->brochure->name ?>"
                            title="<?= $model->brochure->name ?>"
                            src="<?= $model->image ?>"
                            height="300"
                            layout="fixed-height">
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