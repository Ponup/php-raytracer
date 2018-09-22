<?php

use glm\vec3;

class Plane implements Intersectable {

	/** @var Point */
	public $origin;

	/** @var Vector 3*/
	public $normal;

	/**
 	 * @var RgbColor
 	 */
	public $color;

	/**
 	 * @var float
 	 */
	public $albedo;

	public function __construct(vec3 $origin, vec3 $normal, RgbColor $color, float $albedo) {
		$this->origin = $origin;
		$this->normal = $normal;
		$this->color = $color;
		$this->albedo = $albedo;
	}

	public function intersect(Ray $ray) {
		$normal = $this->normal;
		$denom = $normal->dot($ray->direction);
		if($denom > 0.000001){
			$v = $this->origin->substract($ray->origin);
			$distance = $v->dot($normal) / $denom;
			if($distance >= 0.0) {
				return $distance;
			}
		}
		return null;
	}

	public function surfaceNormal() {
		return $this->normal->negate();
	}
}

