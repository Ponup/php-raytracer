<?php

class RgbColor {

	public $r, $g, $b;

	public function __construct(int $r, int $g, int $b) {
		$this->r = $r;
		$this->g = $g;
		$this->b = $b;
	}

	public function allocate($im) {
		return imagecolorallocate($im, $this->r * 255, $this->g * 255, $this->b * 255);
	}
}

