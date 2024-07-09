<?php  
/** @var \common\models\Category[] $all_sieci */
/** @var yii\web\View $this */
?>
<div class="portfolio-page">
    <h1 class="mt-0"><?= $this->title ?></h1>
    <div class="portfolio-box">
        <?php foreach ($all_sieci as $siec_category): ?>
            <?php $siec_name = ucwords(htmlspecialchars($siec_category['name'], ENT_QUOTES, 'UTF-8')); ?>
            <div class="project-post main-box" itemscope itemtype="https://schema.org/Brand">
                <a href="<?= \Yii::$app->urlBuilder->getCanonicalUrl($siec_category) ?>" onclick="ga_send_event('click', 'custom_events', 'open_company_from_list', '<?= $siec_name ?>')">
                    <picture>
                        <source srcset="/images/stores/<?= $siec_category['urlname'] ?>.webp" type="image/webp">
                        <source srcset="/images/stores/<?= $siec_category['urlname'] ?>.jpg" type="image/jpeg">
                        <img itemprop="logo"
                             alt="Gazetki promocyjne <?= $siec_name ?>"
                             title="Gazetki promocyjne <?= $siec_name ?>"
                             src="/images/stores/<?= str_replace('-', '_', $siec_category['urlname']) ?>.webp"
                             width="100%"
                             height="100%" loading="eager">
                    </picture>

                    <div class="hover-box">
                        <div class="project-title ">
                            <p itemprop="name" class="name"><?= $siec_name ?></p>

                            <div class="icon-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FFFFFF" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach;?>
    </div>
</div>