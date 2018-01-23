<?php

$projects = new projects();
$toReturn = $projects->returnAllProjectsByStage((isset($data["stages"])) ? $data["stages"] : null);

$client = new clients();
foreach ($toReturn as $i => $project) {
	if (!isset($list)) {
		$list = "";
		$item = bo3::mdl_load("templates-e/home/item.tpl");
	}

	$client->setId($project->client_id);
	$project->client = $client->returnOneClient();

	$list .= bo3::c2r([
		"id" => $project->id,
		"title" => $project->title,
		"date" => date("Y-m-d", strtotime($project->date))
	], $item);
}

$mdl = bo3::c2r([
	"list" => isset($list) ? $list : ""
], bo3::mdl_load("templates/home.tpl"));

// bo3::importPlg("example");

include "pages/module-core.php";
