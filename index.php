<?php

require 'PeopleList.php';

$arrayId = [
	['id', '=', 1], ['id', '=', 2], ['id', '=', 3], ['id', '=', 4],
];

$people = new PeopleList($arrayId);
$res = $people->getPeople();
var_dump($res);
//$people->removePeople();