<?php

namespace common\components\meta\drivers;

interface DriverInterface
{
	/**
	 * @return void
	 */
	public function registerTitle(): void;

	/**
	 * @return void
	 */
	public function registerDescription(): void;

	/**
	 * @return void
	 */
	public function registerKeywords(): void;
}