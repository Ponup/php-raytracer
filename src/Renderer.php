<?php

class Renderer {

	/**
 	 * The basic idea of how a raytracer like this works is that we iterate over every pixel in the finished image, then trace a ray from the camera out through that pixel to see what it hits. This is the exact opposite of how real light works, but it amounts to pretty much the same thing in the end. Rays traced from the camera are known as prime rays or camera rays.
 	 */
	public function render(Scene $scene, string $path) {
		$im = imagecreatetruecolor($scene->dimension->w, $scene->dimension->h);

		$blackColor = imagecolorallocate($im, 0, 0, 0);

		for($x = 0; $x < $scene->dimension->w; $x++) {
			for($y = 0; $y < $scene->dimension->h; $y++) {
				$ray = Ray::createPrime($x, $y, $scene);
				$distance = null;
				$element = $scene->trace($ray, $distance);
				if(null !== $element && $element->intersect($ray)) {
					$color = $this->getColor($scene, $ray, $element, $distance);
					imagesetpixel($im, $x, $y, $color->allocate($im));
				} else {
					imagesetpixel($im, $x, $y, $blackColor);
				}
			}
		}

		imagepng($im, $path);
	}

	private function getColor($scene, $ray, $element, $distance) : RgbColor {
		$hitPoint = $ray->origin->add($ray->direction->scale($distance));
		$surfaceNormal = $element->surfaceNormal($hitPoint);
		$directionToLight = $scene->light->direction->normalize()->negate();
		$lightPower = ($surfaceNormal->dot($directionToLight) * $scene->light->intensity);
		$lightReflected = $element->albedo / M_PI;
		$color = $element->color->times($scene->light->color)->timesNum($lightPower)->timesNum($lightReflected);
		$clampedColor = $color->clamp();
		return $clampedColor;
	}
}

