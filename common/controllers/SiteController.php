<?php

namespace common\controllers;

use common\services\BrochureService;
use common\services\CategoryService;

class SiteController extends WebController
{
	/** @var CategoryService */
	public $categoryService;

	/** @var BrochureService */
	public $brochureService;

	/**
	 * @param $id
	 * @param $module
	 * @param CategoryService $categoryService
	 * @param BrochureService $brochureService
	 * @param $config
	 */
	public function __construct($id, $module, CategoryService $categoryService, BrochureService $brochureService, $config = [])
	{
		parent::__construct($id, $module, $config);
		$this->categoryService = $categoryService;
		$this->brochureService = $brochureService;
	}
}