<?php

/** @var \common\models\Category $category */
/** @var \common\models\Brochure[] $items */

use common\helpers\Url;

$baseUrl = Url::base(true) . '/';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <url>
        <loc><?= \Yii::$app->urlBuilder->getCanonicalUrl($category) ?></loc>
        <lastmod><?= (new \DateTime())->format(\DateTime::W3C) ?></lastmod>
        <priority>0.90</priority>
    </url>
    <?php foreach ($items as $item): ?>
        <url>
            <loc><?= \Yii::$app->urlBuilder->getCanonicalUrl($category, $item) ?></loc>
            <lastmod><?= (new \DateTime())->format(\DateTime::W3C) ?></lastmod>
            <priority>0.80</priority>
        </url>
    <?php endforeach;?>
</urlset>