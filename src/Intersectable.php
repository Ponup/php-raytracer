<?php

declare(strict_types=1);

interface Intersectable
{

	public function intersect(Ray $ray): ?float;
}
