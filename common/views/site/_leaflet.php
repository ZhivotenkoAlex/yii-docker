<?php

/** @var \common\models\Brochure $model */

isset($wrap) or $wrap = null;
$image_jpg = str_replace('https://images.blovly.com', '/images', $model['image']);

$image_webp = preg_replace('/\.jpg$/', '.webp', $image_jpg); ?>

<?php if ($wrap): ?>
	<div class="blog-post image-post">
<?php endif;?>
		<a href="<?= \Yii::$app->urlBuilder->getCanonicalUrl($model, $model) ?>" onclick="ga_send_event('click', 'custom_events', 'brochure_open', '<?= $model['name'] ?>')" data-pjax="0">
			<div class="inner-post">
				<div class="brochure-image-block">
                    <img alt="<?= $model['name'] ?>" title="<?= $model['name'] ?>" src="<?= $image_webp ?>" width="400" height="auto" onerror="this.src='<?= $image_jpg ?>';this.onerror=null;">
				</div>

				<div class="post-content">
					<h2><?= $model['name'] ?></h2>
				</div>

				<ul class="post-tags">
					<li>
						<a href="#" data-pjax="0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                                <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
                                <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                            </svg>

							<?= \Yii::$app->formatter->asDate($model['start_date'], 'medium') ?> - <?= \Yii::$app->formatter->asDate($model['end_date'], 'medium') ?>
						</a>
					</li>
				</ul>
			</div>
		</a>
<?php if ($wrap): ?>
	</div>
<?php endif;?>