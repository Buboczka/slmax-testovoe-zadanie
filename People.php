<?php

class People
{
	protected $id;
	public $first_name_property = null;
	public $last_name_property = null;
	public $date_of_birth_property = null;
	public $sex_property = null;
	public $city_property = null;
	private $connect;
	const MALE = 0;
	const FEMALE = 1;
	private $table = 'people';

	protected function __construct()
	{
		if ($this->connect === null) {
			try {
				$this->connect = new \PDO("mysql:host=localhost;dbname=slmax_test_task", "root", "uyensq_ryen", [
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				]);
			} catch (PDOException $e) {
				throw new Exception ($e->getMessage());
			}
		}

		return $this->connect;
	}

	protected static function formateDate($date)
	{
		$date = new DateTimeImmutable($date);

		return (int)date('Y') - (int)$date->format('Y');
	}

	protected static function formateSex($sex)
	{
		return $sex == self::MALE ? 'male' : 'female';
	}

	protected function formatePerson($value, $formateSex = true, $formateDate = true)
	{
		$new = new StdClass();
		foreach ($value as $k => $val) {
			if ($k == 'sex' && $formateSex) {
				$val = self::formateSex($val);
			}
			if ($k == 'date_of_birth' && $formateDate) {
				$val = self::formateDate($val);
			}
			$new->$k = $val;
		}

		return $new;
	}

	protected function select()
	{
		$values = func_get_args();
		$result = [];
		if ($values) {
			$sqlArray = [];
			$valueArray = [];
			foreach ($values as $value) {
				$sqlArray[] = "$value[0] $value[1] :$value[0]";
				$valueArray[":$value[0]"] = $value[2];
			}
			$sqlString = implode(' AND ', $sqlArray);
			$sql = "SELECT * FROM {$this->table} WHERE $sqlString";
			$stmt = $this->connect->prepare($sql);
			$stmt->execute($valueArray);

			if ($stmt->rowCount() > 0) {
				foreach ($stmt as $key => $row) {
					$result[$key] = $row;
				}
			}
		}

		return $result;
	}

	protected function delete($id)
	{
		$sql = "DELETE FROM {$this->table} WHERE id = :id";
		$stmt = $this->connect->prepare($sql);
		$stmt->execute([':id' => $id]);
	}

	protected function save()
	{
		$vars = get_object_vars($this);
		$sqlArray = [];
		$valueArray = [];
		foreach ($vars as $k => $var) {
			if (preg_match("/_property$/", $k)) {
				$k = substr($k, 0, strpos($k, '_property'));
				$sqlArray[] = $k;
				$valueArray[":$k"] = $var;
			}
		}
		$sqlArray = implode(',', $sqlArray);
		$sql = "INSERT INTO {$this->table} ($sqlArray) VALUES (".implode(',', array_keys($valueArray)).")";
		$stmt = $this->connect->prepare($sql);
		$stmt->execute($valueArray);
	}
}