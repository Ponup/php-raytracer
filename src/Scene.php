<?php

use Mammoth\Graphic\Dimension;

class Scene
{

	/**
	 * @var Dimension
	 */
	public $dimension;

	/**
	 * @var float Field of view
	 */
	public $fov;

	/**
	 * @var array
	 */
	public $elements;

	/**
	 * @var Light
	 */
	public $light;

	public function __construct(Dimension $dimension, float $fov, array $elements)
	{
		$this->dimension = $dimension;
		$this->fov = $fov;
		$this->elements = $elements;
	}

	public function trace(Ray $ray, float &$distance): ?Intersectable
	{
		$closestElement = null;
		foreach ($this->elements as $element) {
			$intersection = $element->intersect($ray);
			if ($intersection !== null && $intersection < $distance) {
				$distance = $intersection;
				$closestElement = $element;
			}
		}
		return $closestElement;
	}
}
