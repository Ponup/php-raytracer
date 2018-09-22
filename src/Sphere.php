<?php

use glm\vec3;

class Sphere implements Intersectable {

	/**
 	 * @var \glm\vec3
 	 */
	public $center;

	/**
 	 * @var float
 	 */
	public $radius;

	/**
 	 * @var RgbColor
 	 */
	public $color;

	/**
 	 * @var float
 	 */
	public $albedo;

	public function __construct(\glm\vec3 $center, float $radius, RgbColor $color, float $albedo) {
		$this->center = $center;
		$this->radius = $radius;
		$this->color = $color;
		$this->albedo = $albedo;
	}
	
	/**
 	 * The basic idea behind this test is that we construct a right-triangle using the prime ray as the adjacent side and the line between the origin and the center of the sphere as the hypotenuse. Then we calculate the length of the opposite side using the Pythagorean Theorem - if that side is smaller than the radius of the sphere, the ray must intersect the sphere. In practice, we actually do the check on length-squared values because square roots are expensive to calculate, but it’s the same idea.
 	 *
 	 * @return boolean
 	 */
	public function intersect(Ray $ray) {
		// Create a line segment between the ray origin and the center of the sphere
		$hypo = $this->center->substract($ray->origin);
		// Use it as a hypotenuse and find the length of the adjacent side
		$adj = $hypo->dot($ray->direction);
		// Find the length-squared of the opposite side
		// This is equivalent to (but faster than) (l.length() * l.length()) - (adj2 * adj2)
		$opp = $hypo->dot($hypo) - ($adj * $adj);
		$radiusSquared = ($this->radius * $this->radius);
		// If that length-squared is less than radius squared, the ray intersects the sphere
		if($opp > $radiusSquared) {
			return null;
		}
		$thickness = sqrt($radiusSquared - $opp);
		$t0 = $adj - $thickness;
		$t1 = $adj + $thickness;

		if($t0 < 0.0 && $t1 < 0.0) {
			return null;
		}

		$distance = $t0 < $t1 ? $t0 : $t1;
		return $distance;
	}

	public function surfaceNormal(vec3 $hitPoint) {
		return $hitPoint->substract($this->center)->normalize();
	}
}

