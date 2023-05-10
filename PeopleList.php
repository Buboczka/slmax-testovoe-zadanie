<?php

require 'People.php';

class PeopleList extends People
{
	public $arrayPeopleId = [];

	public function __construct($arrayId = [])
	{
		parent::__construct();
		$this->arrayPeopleId = $arrayId;
	}

	public function getPeople()
	{
		$result = [];
		foreach ($this->arrayPeopleId as $item) {
			$result[] = $this->select($item);
		}

		return $result;
	}

	public function removePeople()
	{
		foreach ($this->arrayPeopleId as $item) {
			$this->delete($item[2]);
		}
	}
}