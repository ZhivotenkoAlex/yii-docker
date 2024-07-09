<?php

/** @var \common\models\Category[] $items */

$baseUrl = (\Yii::$app->request->isSecureConnection ? 'https://' : 'http://') . \Yii::$app->params['serverName'];
?>
<sitemapindex
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd">
    <sitemap>
        <urlset>
            <url>
                <loc><?= $baseUrl ?></loc>
                <lastmod><?= (new \DateTime())->format(\DateTime::W3C) ?></lastmod>
                <priority>1.0</priority>
            </url>
        </urlset>
    </sitemap>
    <?php foreach ($items as $item): ?>
        <sitemap>
            <loc><?= $baseUrl ?>/sitemap-<?= $item->urlname ?>.xml</loc>
            <lastmod><?= (new \DateTime())->format(\DateTime::W3C) ?></lastmod>
        </sitemap>
    <?php endforeach;?>
</sitemapindex>