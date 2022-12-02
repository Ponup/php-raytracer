<?php

declare(strict_types=1);

use Mammoth\Graphic\Color;
use Mammoth\Math\Vector;

class Light
{

	/**
	 * @var \Mammoth\Math\Vector
	 */
	public $direction;

	/**
	 * @var \Mammoth\Graphic\Color
	 */
	public $color;

	/**
	 * @var float
	 */
	public $intensity;

	public function __construct(Vector $direction, Color $color, float $intensity)
	{
		$this->direction = $direction;
		$this->color = $color;
		$this->intensity = $intensity;
	}
}
