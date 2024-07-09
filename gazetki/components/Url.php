<?php

namespace gazetki\components;

use common\models\Brochure;
use common\models\Category;

class Url extends \yii\base\Component
{
	/**
	 * @param array|Category|null $category
	 * @param array|Brochure|null $brochure
	 * @param array|null $path
	 *
	 * @return string
	 */
	public function getCanonicalUrl(array $category = null, array $brochure = null, array $path = null): string
	{
		$url = [(\Yii::$app->request->isSecureConnection ? 'https:/' : 'http:/')];
	
		foreach (self::buildCanonicalUrl($category, $brochure, $path) as $segment)
		{
			$url[] = $segment;
		}		
		return implode('/', $url);
	}

	/**
	 * @param array|null $category
	 * @param array|null $brochure
	 * @param array|null $path
	 *
	 * @return \Generator
	 */
	protected function buildCanonicalUrl(array $category = null, array $brochure = null, array $path = null): \Generator
	{
		yield \Yii::$app->params['serverName'];

		$hostInfo = \Yii::$app->request->getHostInfo();
    	$scheme = \Yii::$app->request->isSecureConnection ? 'https' : 'http';
    	$host = parse_url($hostInfo, PHP_URL_HOST);
    	$port = parse_url($hostInfo, PHP_URL_PORT);

    	// For http and a non-default port, append the port to the host
    	if ($scheme === 'http' && $port !== null && $port !== 80) {
        $hostWithPort = $host . ':' . $port;
    	} 
    	// For https and a non-default port, append the port to the host
    	else if ($scheme === 'https' && $port !== null && $port !== 443) {
        $hostWithPort = $host . ':' . $port;
    	} 
    	else {
        $hostWithPort = $host;
    	}

		yield $hostWithPort;

		if ($path) {
			foreach ($path as $segment) {
				yield $segment;
			}
		}

		if ($brochure) {
			yield 'gazetka';
			yield $category['urlname'] ?? '';
			yield 'ulotka_' . $brochure['urlname'] . '_od_' . $brochure['start_date'] . '_do_' . $brochure['end_date'];
		} elseif ($category) {
			yield 'promocje';
			yield $category['urlname'];
		}
	}
}