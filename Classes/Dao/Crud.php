<?php
require_once 'Database.php';

	class Crud{

		public function insert($data){			
		$inputsTemp = array();
		$campos = implode(' , ', array_keys($data));		

		foreach ($data as $key => $value) {
			$input = ':'.$key;
			array_push($inputsTemp, $input);
		}

		$inputs = implode(' , ', array_values($inputsTemp));

		$sql = "INSERT INTO ". $this->db_table ."(".$campos.") VALUES(".$inputs.")";	
		$pdo = Database::conexao();
		$stmt = $pdo->prepare($sql);

		foreach ($data as $key => $value) {
			$stmt->bindValue(':'.$key, $value);
		}
		
		$rs = $stmt->execute();
		
		return $rs;
	}
	
	public function readById($id , $class){
		
			$sql = "SELECT * FROM ". $this->db_table . " WHERE id = :id ";
		
		
		$pdo = Database::conexao();
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		$result = $stmt->fetchObject($class);
       
		return $result;
	}

	public function readByAtributes($collum , $value , $class){

		if(is_int($value)){
			$sql = "SELECT * FROM ". $this->db_table . " WHERE {$collum} = {$value} ";
		} else {
			$sql = "SELECT * FROM ". $this->db_table . " WHERE {$collum} = '{$value}' ";
		}
		
		$pdo = Database::conexao();
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':value', $value);
		$stmt->execute();
		$result = $stmt->fetchObject($class);
       
		return $result;
	}

	public function readAllWhere($collum , $value , $class){
		if(is_int($value)){
			$sql = "SELECT * FROM ". $this->db_table . " WHERE {$collum} = {$value} ";
		} else {
			$sql = "SELECT * FROM ". $this->db_table . " WHERE {$collum} = '{$value}' ";
		}
		
		$pdo = Database::conexao();
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':value', $value);
		$stmt->execute();
		$results = array();
        while ($result = $stmt->fetchObject($class)) {
            $results[] = $result;
        }
        
		return $results;
	}

	public function readAll($class){
		$sql = "SELECT * FROM ". $this->db_table;
		$pdo = Database::conexao();
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$results = array();
        while ($result = $stmt->fetchObject($class)) {
            $results[] = $result;
        }
        
		return $results;
	}
	public function readAllRestrict($class){
		$userId = (int) $_SESSION['AuthUser']->getId();		
		$sql = "SELECT * FROM ". $this->db_table . " WHERE user_id = {$userId}";
		$pdo = Database::conexao();
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$results = array();
        while ($result = $stmt->fetchObject($class)) {
            $results[] = $result;
        }
        
		return $results;
	}
	public function readLast(){
		$sql = "SELECT MAX(id) FROM ". $this->db_table;
		$pdo = Database::conexao();
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch();

		return $result;
	}

	public function update($id, $data){

		$keys = array_keys($data);
		$campos = array();

		foreach ($keys as $value) {
			array_push($campos, $value.' = :'.$value);
		}

		$campos = implode(', ', $campos);
	
		$sql = "UPDATE ". $this->db_table . " SET {$campos} WHERE id = :id ";
		$pdo = Database::conexao();
		$stmt = $pdo->prepare($sql);
		foreach ($data as $key => $value) {
			$stmt->bindValue(':'.$key, $value);
		}
		$stmt->bindValue(':id', $id);
		$result = $stmt->execute();
		
		return $result;
	}

	public function delete($id){
		$sql = "DELETE FROM ". $this->db_table . " WHERE id = :id";
		$pdo = Database::conexao();
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$result = $stmt->execute();

		return $result;
	}
	
	
	}
?>