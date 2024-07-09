<?php

namespace common\components;

class View extends \yii\web\View
{
	/** @var string */
	private static $canonical;

	/** @var bool */
	private static $amp = false;

	/**
	 * @return string
	 */
	public static function getCanonical(): ?string
	{
		return static::$canonical;
	}

	/**
	 * @param string $url
	 *
	 * @return void
	 */
	public static function setCanonical(string $url): void
	{
		static::$canonical = $url;
	}

	/**
	 * @return bool
	 */
	public static function isAmp(): bool
	{
		return static::$amp;
	}

	/**
	 * @param bool $amp
	 *
	 * @return void
	 */
	public static function setAmp(bool $amp): void
	{
		static::$amp = $amp;
	}
}