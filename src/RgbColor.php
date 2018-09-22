<?php

class RgbColor {

	public $r, $g, $b;

	public function __construct(float $r, float $g, float $b) {
		$this->r = $r;
		$this->g = $g;
		$this->b = $b;
	}

	public function allocate($im) {
		$allocatedColor = imagecolorallocate($im, $this->r * 255, $this->g * 255, $this->b * 255);
		if(false === $allocatedColor) throw new Exception("Colour could not be allocated: $this->r, $this->g, $this->b");
		return $allocatedColor;
	}

	public function times($num) {
		return new RgbColor(
			$this->r * $num->r,
			$this->g * $num->g,
			$this->b * $num->b
		);
	}

	public function timesNum($num) {
		return new RgbColor(
			$this->r * $num,
			$this->g * $num,
			$this->b * $num
		);
	}

	public function clamp() {
		return new RgbColor(
			max(min($this->r, 1), 0),
			max(min($this->g, 1), 0),
			max(min($this->b, 1), 0)
		);
	}
}

