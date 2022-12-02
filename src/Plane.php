<?php

declare(strict_types=1);

use Mammoth\Graphic\Color;
use Mammoth\Math\Vector;

class Plane implements Intersectable
{

	/** @var Point */
	public $origin;

	/** @var \Mammoth\Math\Vector */
	public $normal;

	/**
	 * @var \Mammoth\Graphic\Color
	 */
	public $color;

	/**
	 * @var float
	 */
	public $albedo;

	public function __construct(Vector $origin, Vector $normal, Color $color, float $albedo)
	{
		$this->origin = $origin;
		$this->normal = $normal;
		$this->color = $color;
		$this->albedo = $albedo;
	}

	public function intersect(Ray $ray): ?float
	{
		$normal = $this->normal;
		$denom = $normal->dot($ray->direction);
		if ($denom > 0.000001) {
			$v = $this->origin->substract($ray->origin);
			$distance = $v->dot($normal) / $denom;
			if ($distance >= 0.0) {
				return $distance;
			}
		}
		return null;
	}

	public function surfaceNormal(): Vector
	{
		return $this->normal->negate();
	}
}
