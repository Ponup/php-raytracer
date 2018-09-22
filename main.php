<?php

require 'vendor/autoload.php';

$sphere1 = new Sphere(
	$center = new \glm\vec3(0.0, 0.0, -5.0),
	$radius = 1.0,
	$color = new RgbColor(0.2, 1, 0.2),
	$albedo = 0.18
);
$sphere2 = new Sphere(
	$center = new \glm\vec3(-3.0, 1.0, -6.0),
	$radius = 2.0,
	$color = new RgbColor(.2, .2, 1),
	$albedo = 0.58
);
$sphere3 = new Sphere(
	$center = new \glm\vec3(2.0, 2.0, -4.0),
	$radius = 2.25,
	$color = new RgbColor(1.0, 0.2, 0.2),
	$albedo = 0.18
);
$plane1 = new Plane(
	new \glm\vec3(0, -2, 0), new \glm\vec3(0, -1, 0), new RgbColor(0.2, 0.2, 0.2),
	$albedo = 0.18);
$plane2 = new Plane(
	new \glm\vec3(0, 0, -20), new \glm\vec3(0, 0, -1), new RgbColor(0.6, 0.8, 1.0),
	$albedo = 0.18);

$elements = [ $sphere1, $sphere2, $sphere3, $plane1, $plane2 ];

$scene = new Scene(
	$position = new Dimension(800, 600),
	$fov = 90.0,
	$elements
);
$scene->light = new Light(new \glm\vec3(-0.25, -1, -1), new RgbColor(1, 1, 1), 20);

$renderer = new Renderer;
$renderer->render($scene, 'scene.png');

