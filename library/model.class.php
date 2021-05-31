<?php
class Model{
	protected $_dbHandle;
	protected $_table;

//Connection to Database
	public function connect(){
		$this->_dbHandle = new PDO(DB_XX, DB_USER, DB_PASSWORD );
		try {
			new PDO(DB_XX, DB_USER, DB_PASSWORD );
		} catch (PDOException $e) {
			echo "Connection failed: " .$e->getMessage();
		}
	}

//Method for Data Query
	public function query($query){
	 	return $this->_dbHandle->query($query);
	}

	public function getResult($pdoQuery){
		$data = array();
		foreach($pdoQuery as $row) {
			array_push($data, $row);
		}
		return $data;
	}

	public function getRows($pdoQuery){
		$res = $this->_dbHandle->prepare($pdoQuery);
		$res->execute();
		$num_rows = $res->fetchColumn();
		return $num_rows;
	}

//Method for Data Fetching
	public function selectAll($orderBy='', $order='ASC', $limit=''){
		$query = "SELECT * FROM ".$this->_table;
		if($orderBy!='') $query .= " ORDER BY $orderBy $order";
		if($limit!='') $query .= " LIMIT $limit";
		return $this->query($query);
	}

	public function selectWhere($condition='', $orderBy='', $order='ASC', $limit=''){
		$query = "SELECT * FROM ".$this->_table;
		if(is_array($condition)){
			$query .= " WHERE";
			foreach($condition as $key=>$val){
				$query .= " $key='$val' AND";
			}
			$query = substr($query, 0, -3);
		}
		if($orderBy!='') $query .= " ORDER BY $orderBy $order";
		if($limit!='') $query .= " LIMIT $limit";
		return $this->query($query);
	}

	public function selectLike($condition='', $orderBy='', $order='ASC', $limit=''){
		$query = "SELECT * FROM ".$this->_table;
		if(is_array($condition)){
			$query .= " WHERE";
			foreach($condition as $key=>$val){
				$query .= " $key LIKE '$val' OR";
			}
			$query = substr($query, 0, -2);
		}

		if($orderBy!='') $query .= " ORDER BY $orderBy $order";
		if($limit!='') $query .= " LIMIT $limit";
		return $this->query($query);
	}

	public function selectJoin($table, $join="JOIN", $param, $condition='', $orderBy='', $order='ASC', $limit=''){
		$query = "SELECT * FROM ".$this->_table;
		if(is_array($table)){
			foreach($table as $tbl){
				$query .= " $join $tbl";
			}
		}else $query .= " $join $table";
		foreach($param as $key=>$val){
			$query .= " ON $key=$val";
		}
		if(is_array($condition)){
			$query .= " WHERE";
			foreach($condition as $key=>$val){
				$query .= " $key='$val' AND";
			}
			$query = substr($query, 0, -3);
		}
		if($orderBy!='') $query .= " ORDER BY $orderBy $order";
		if($limit!='') $query .= " LIMIT $limit";
		return $this->query($query);
	}

//Method for Data Deletion
	public function delete($condition=''){
		$query = "DELETE FROM ".$this->_table;
		if(is_array($condition)){
			$query .= " WHERE";
			foreach($condition as $key=>$val){
				$query .= " $key='$val' AND";
			}
			$query = substr($query, 0, -3);
		}
		return $this->query($query);
	}

//Method for Data Adding
	public function insert($data){
		$query = "INSERT INTO ".$this->_table." SET";
		foreach($data as $key=>$val){
			$query .= " $key='$val',";
		}
		$query = substr($query, 0, -1);
		return $this->query($query);
	}

//Method for Data Update
	public function update($data, $condition=''){
		$query = "UPDATE ".$this->_table." SET";
		foreach($data as $key=>$val){
			$query .= " $key='$val',";
		}
		$query = substr($query, 0, -1);
		if(is_array($condition)){
			$query .= " WHERE";
			foreach($condition as $key=>$val){
				$query .= " $key='$val' AND";
			}
			$query = substr($query, 0, -3);
		}
		return $this->query($query);
	}
}
