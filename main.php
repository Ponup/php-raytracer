<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Mammoth\Graphic\Color;
use Mammoth\Graphic\Dimension;
use Mammoth\Math\Vector;

$sphere1 = new Sphere(
	$center = new Vector(0.0, 0.0, -5.0),
	$radius = 1.0,
	$color = new Color(0.2, 1, 0.2),
	$albedo = 0.18
);
$sphere2 = new Sphere(
	$center = new Vector(-3.0, 1.0, -6.0),
	$radius = 2.0,
	$color = new Color(.2, .2, 1),
	$albedo = 0.58
);
$sphere3 = new Sphere(
	$center = new Vector(2.0, 2.0, -4.0),
	$radius = 2.25,
	$color = new Color(1.0, 0.2, 0.2),
	$albedo = 0.18
);
$plane1 = new Plane(
	new Vector(0, -2, 0),
	new Vector(0, -1, 0),
	new Color(0.2, 0.2, 0.2),
	$albedo = 0.18
);
$plane2 = new Plane(
	new Vector(0, 0, -20),
	new Vector(0, 0, -1),
	new Color(0.6, 0.8, 1.0),
	$albedo = 0.18
);

$elements = [$sphere1, $sphere2, $sphere3, $plane1, $plane2];

$scene = new Scene(
	$position = new Dimension(800, 600),
	$fov = 90.0,
	$elements
);
$scene->light = new Light(new Vector(-0.25, -1, -1), new Color(1, 1, 1), 20);

$renderer = new Renderer;
$renderer->render($scene, 'scene.png');
