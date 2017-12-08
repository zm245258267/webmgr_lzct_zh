<?php
class Db{
	
	private $connection=null;
	private $error='';
	
	const DSN = 'mysql:host=localhost;port=3306;dbname=lzct_yunyingend';
	const DB_USER='root';
	const DB_PASS='511c0fcabff6bbdb';
	
	public function __construct($config=null){
		$options = array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		);
		
		$dsn=self::DSN;
		$user=self::DB_USER;
		$pass=self::DB_PASS;
		if ($config){
			$dsn=$config['DSN'];
			$user=$config['USER'];
			$pass=$config['PWD'];
		}
		
		$this->connection = new PDO($dsn, $user, $pass, $options);
	}
	
	public function getRow($sql){
		$q=$this->connection->query($sql);
		if ($q===false){
			$this->error=implode(" ", $this->connection->errorInfo());
			return null;
		}
		return $q->fetch(PDO::FETCH_ASSOC);
	}
	
	public function getAll($sql){
		$q=$this->connection->query($sql);
		if ($q===false){
			$this->error=implode(" ", $this->connection->errorInfo());
			return null;
		}
		return $q->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function insertAll($sql){
		$q=$this->connection->exec($sql);
		if ($q===false){
			$this->error=implode(" ", $this->connection->errorInfo());
			return false;
		}
		return $q;
	}
	
	public function getError(){
		return $this->error;
	}
	
	public function execute($sql){
		$q=$this->connection->exec($sql);
		if ($q===false){
			$this->error=implode(" ", $this->connection->errorInfo());
			return false;
		}
		return $q;
	}
	
}

// include 'db.php';
// $Db=new Db();

// $rs=$Db->insertAll("insert into employees values (1,'a','b',curdate(),curdate(),1,1),(1,'a','b',curdate(),curdate(),1,1),(1,'a','b',curdate(),curdate(),1,1)");

// var_dump($rs);