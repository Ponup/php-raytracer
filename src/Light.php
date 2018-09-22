<?php

use glm\vec3;

class Light {

	/**
 	 * @var vec3
 	 */
	public $direction;

	/**
 	 * @var RgbColor
 	 */
	public $color;

	/**
 	 * @var float
 	 */
	public $intensity;

	public function __construct(vec3 $direction, RgbColor $color, float $intensity) {
		$this->direction = $direction;
		$this->color = $color;
		$this->intensity = $intensity;
	}
}

