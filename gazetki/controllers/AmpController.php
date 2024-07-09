<?php

namespace gazetki\controllers;

use common\models\Brochure;
use common\models\Product;

class AmpController extends SiteController
{
	/**
	 * @return void
	 */
	public function init()
	{
		parent::init();
		$this->layout = 'amp';
	}

	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		\Yii::$app->meta->registerMetaData(\Yii::$app->meta::PAGE_HOME);

		$this->view::setCanonical(\Yii::$app->urlBuilder->getCanonicalUrl());

		return \Yii::$app->cache->getOrSet(\Yii::$app->cache->buildKey([__CLASS__, 'index']), function () {
			return $this->render('index', [
				'all_sieci' => $this->categoryService->getAllForSidebar()
			]);
		}, 300);
	}

	/**
	 * @param Brochure $brochure
	 *
	 * @return string
	 */
	public function actionBrochure(Brochure $brochure)
	{
		\Yii::$app->meta->registerMetaData(\Yii::$app->meta::PAGE_BROCHURE, $brochure->category, $brochure);

		$this->view::setCanonical(\Yii::$app->urlBuilder->getCanonicalUrl($brochure->category, $brochure));

		return \Yii::$app->cache->getOrSet(\Yii::$app->cache->buildKey([__CLASS__, 'brochure', $brochure->id]), function () use ($brochure) {
			return $this->render('brochure', [
				'brochure' => $brochure,
				'category' => $brochure->category,
				'pages' => $brochure->pages,
				'title' => ucfirst($brochure->name)
			]);
		}, 300);
	}

	/**
     * @return string|\yii\web\Response
     */
    public function actionSearch()
    {
	    \Yii::$app->meta->registerMetaData(\Yii::$app->meta::PAGE_HOME);

	    $this->view::setCanonical(\Yii::$app->urlBuilder->getCanonicalUrl(null, null, ['amp', 'search']));

	    $searchString = \Yii::$app->request->get('string');

	    if (!$searchString OR $searchString === '') {
		    return $this->redirect(\Yii::$app->urlBuilder->getCanonicalUrl(null, null, ['amp']))->send();
	    }

	    return $this->render('search', [
		    'title' => 'Search '. $searchString,
		    'products' => Product::searchProducts($searchString),
		    'brochures' => $this->brochureService->search($searchString),
		    'searchString' => $searchString
	    ]);
    }
}
