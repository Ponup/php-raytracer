<?php

require 'vendor/autoload.php';

$scene = new Scene(
	$position = new Dimension(800, 600),
	$fov = 90.0,
	$sphere = new Sphere(
		$center = new \glm\vec3(0.0, 0.0, -5.0),
		$radius = 1.0,
		$color = new RgbColor(0.4, 1.0, 0.4)
	)
);

$renderer = new Renderer;
$renderer->render($scene, 'scene.png');
