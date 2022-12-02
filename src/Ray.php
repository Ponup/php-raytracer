<?php

declare(strict_types=1);

use Mammoth\Math\Vector;
use Mammoth\Math\Angle;

class Ray
{

	/**
	 * @var \Mammoth\Math\Vector
	 */
	public $origin;

	/**
	 * @var \Mammoth\Math\Vector
	 */
	public $direction;

	public function __construct(Vector $origin, Vector $direction)
	{
		$this->origin = $origin;
		$this->direction = $direction;
	}

	/**
	 *  We’ll start by pretending there’s a two-unit by two-unit square one unit in front of the camera. This square represents the image sensor or film of our camera. Then we’ll divide that sensor square into pixels, and use the directions to each pixel as our rays. We need to translate the (0…800, 0…600) coordinates of our pixels to the (-1.0…1.0, -1.0…1.0) coordinates of the sensor.
	 */
	public static function createPrime(int $x, int $y, Scene $scene): Ray
	{
		/**
		 * First, we cast to float and add 0.5 (one half-pixel) because we want our ray to pass through the center (rather than the corner) of the pixel on our imaginary sensor. Then we divide by the image width to convert from our original coordinates (0…800) to (0.0…1.0). That’s almost, but not quite, the (-1.0…1.0) coordinates we want, so we multiply by two and subtract one.
		 */
		$sensorX = (($x + 0.5) / $scene->dimension->w) * 2.0 - 1.0;
		/**
		 * The y calculation follows the same basic process except the last step. This is simply because the image coordinates have positive y meaning down, where we want positive y to be up. To correct for this, we simply take the negative of the last step of the calculation.
		 */
		$sensorY = 1.0 - (($y + 0.5) / $scene->dimension->h) * 2.0;

		/**
		 * To adjust for different aspect ratios, we calculate the aspect ratio and multiply it by the x coordinate. We’re assuming that the image will be wider than it is tall, but most images are so that’s good enough for now. If we didn’t do this, the rays would be closer together in the x direction than in the y, which would cause a distortion in the image (where every pixel is the same size in both directions)*
		 */
		$aspectRatio = $scene->dimension->w / $scene->dimension->h;
		$sensorX *= $aspectRatio;

		/**
		 * Then we can add another adjustment for field of view. Field of view is the angle between the left-most ray and the right-most ray (or top- and bottom-most). We can use simple trigonometry to calculate how much we need to adjust the coordinates b*
		 */
		$fovAdjustment = tan(Angle::toRadians($scene->fov) / 2.0);
		$sensorX *= $fovAdjustment;
		$sensorY *= $fovAdjustment;

		/**
		 * Then we pack the x and y components into a vector (z is -1.0 because all of our prime rays should go forward from the camera) and normalize it to get a nice direction vector
		 */
		$ray = new Ray(
			$origin = new Vector(0, 0, 0),
			($direction = new Vector($sensorX, $sensorY, -1.0))->normalize()
		);
		return $ray;
	}
}
