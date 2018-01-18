<?php

interface Intersectable {

	public function intersect(Ray $ray) : bool;
}

