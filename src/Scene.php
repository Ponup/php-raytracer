<?php

class Scene {

	/**
 	 * @var Dimension
 	 */
	public $dimension;

	/**
 	 * @var float Field of view
 	 */
	public $fov;

	/**
 	 * @var Sphere
 	 */
	public $sphere;

	public function __construct(Dimension $dimension, float $fov, Sphere $sphere) {
		$this->dimension = $dimension;
		$this->fov = $fov;
		$this->sphere = $sphere;
	}
}

