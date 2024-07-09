<?php

namespace gazetki\controllers;

use common\classes\AutoBind\BindActionParamsTrait;
use common\models\Brochure;
use common\models\Category;
use common\models\Product;
use common\controllers\SiteController as Controller;
use app\db\Firestore; 

class SiteController extends Controller
{
	use BindActionParamsTrait;

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
	 * @param Category $category
	 *
	 * @return string
	 */
    public function actionCategory($category)
    {
		$firestore = new Firestore();
		$categoryItem = $firestore->getDocumentByFieldValue('gazetki_category', 'urlname', $category);

	    \Yii::$app->meta->registerMetaData(\Yii::$app->meta::PAGE_CATEGORY, $category);

	    $this->view::setCanonical(\Yii::$app->urlBuilder->getCanonicalUrl($categoryItem));

        return $this->render('company', [
            'brochures' => $this->brochureService->getActualBrochures($categoryItem),
			'archive' => $this->brochureService->getArchiveBrochures($categoryItem),
            'category' => $categoryItem,
            'title' => ucfirst($categoryItem['name'])
        ]);
    }

	/**
	 * @param Brochure $brochure
	 *
	 * @return mixed
	 */
    public function actionBrochure($brochure)
    {
		$brochureItem = $this->brochureService->getBrochure($brochure);

		\Yii::$app->meta->registerMetaData(\Yii::$app->meta::PAGE_BROCHURE, $brochureItem['category'], $brochure);

		$this->view::setCanonical(\Yii::$app->urlBuilder->getCanonicalUrl($brochureItem['category'], $brochureItem));

	    return \Yii::$app->cache->getOrSet(\Yii::$app->cache->buildKey([__CLASS__, 'brochure', $brochureItem['id']]), function () use ($brochureItem) {
		    return $this->render('brochure', [
			    'brochure' => $brochureItem,
			    'category' => $brochureItem['category'],
			    'pages' => $brochureItem['pages'],
			    'title' => ucfirst($brochureItem['name'])
		    ]);
	    }, 300);
    }

	/**
	 * @return string
	 */
    public function actionSitemap(Category $category = null)
    {
        $this->layout = 'xml';

	    \Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
	    \Yii::$app->response->headers->add('Content-Type', 'text/xml');

		if (!$category) {
			return $this->render('sitemap-index', [
				'items' => $this->categoryService->getAllForSidebar()
			]);
		}

        return $this->render('sitemap', [
	        'category' => $category,
            'items' => $category->brochures
        ]);
    }

	/**
	 * @return string|\yii\web\Response
	 */
    public function actionSearch()
    {
	    \Yii::$app->meta->registerMetaData(\Yii::$app->meta::PAGE_HOME);

	    $this->view::setCanonical(\Yii::$app->urlBuilder->getCanonicalUrl(null, null, ['search']));

        $searchString = \Yii::$app->request->get('string');

        if (!$searchString OR $searchString === '') {
            return $this->redirect(\Yii::$app->urlBuilder->getCanonicalUrl())->send();
        }

        return $this->render('search', [
            'title' => 'Search '. $searchString,
            'products' => Product::searchProducts($searchString),
	        'brochures' => $this->brochureService->search($searchString),
	        'searchString' => $searchString
        ]);
    }
}
