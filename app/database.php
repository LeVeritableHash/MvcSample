<?php

namespace App;

class Database{

	private $db_user;
	private $db_pass;
	private $db_name;
	private $db_host;
	
	public function __construct($host='localhost',$user='root',$pass='',$bd='test')
	{
		$this->db_user = $user;
		$this->db_pass = $pass;
		$this->db_name = $bd;
		$this->db_host = $host;

	}

	
	private function getPDO(){
		try{
			$pdo = new \PDO ("mysql:dbname=".$this->db_name.";host=".$this->db_host, $this->db_user, $this->db_pass,array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			$this->pdo = $pdo;
			return $pdo;
		}
		catch(PDOException $e)
		{
			return false;
		}

	}

	public function query($statement,$return=0){
		try{
			$req = $this->getPDO()->query($statement);
			$data = $req->fetchALL(\PDO::FETCH_OBJ);
			return $data;
		}
		catch(PDOException $e)
		{
			if($return == 0):

			return false;
			
			else:
			
			return $e;
			
			endif;
		}
	}
	
	public function query_class($statement,$class_name){
		$req = $this->getPDO()->query($statement);
		$datas = $req->fetchAll(\PDO::FETCH_CLASS,$class_name);
		return $datas;
	}
	
	public function execute($statement,$return=0){
		try{
			$this->getPDO()->exec($statement);
			return true;
		}
		catch(PDOException $e)
		{
			if($return == 0):

			return false;
			
			else:
			
			return $e;
			
			endif;
			
		}
	}


}