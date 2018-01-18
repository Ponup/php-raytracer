<?php

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

	public function __construct(\glm\vec3 $center, float $radius, RgbColor $color) {
		$this->center = $center;
		$this->radius = $radius;
		$this->color = $color;
	}
	
	/**
 	 * The basic idea behind this test is that we construct a right-triangle using the prime ray as the adjacent side and the line between the origin and the center of the sphere as the hypotenuse. Then we calculate the length of the opposite side using the Pythagorean Theorem - if that side is smaller than the radius of the sphere, the ray must intersect the sphere. In practice, we actually do the check on length-squared values because square roots are expensive to calculate, but it’s the same idea.
 	 *
 	 * @return boolean
 	 */
	public function intersect(Ray $ray) : bool {
		// Create a line segment between the ray origin and the center of the sphere
		$hypo = $this->center->substract($ray->origin);
		// Use it as a hypotenuse and find the length of the adjacent side
		$adj = $hypo->dot($ray->direction);
		// Find the length-squared of the opposite side
		// This is equivalent to (but faster than) (l.length() * l.length()) - (adj2 * adj2)
		$opp = $hypo->dot($hypo) - ($adj * $adj);
		// If that length-squared is less than radius squared, the ray intersects the sphere
		return $opp < ($this->radius * $this->radius);

	}
}

