<?php
require(dirname(dirname(__FILE__)).'/test.conf.php');
require_once(ROOT_PATH."/winphp/db/PDOTemplate.class.php");

class PDOTemplateTest extends PHPUnit_Extensions_Database_TestCase
{
	private $dsn;
	public function __construct(){
		$this->dsn='sqlite:'.dirname(__FILE__).'/test.db';
	}

	protected function getConnection()
	{
		$this->pdo = new PDO($this->dsn);
		return $this->createDefaultDBConnection($this->pdo, 'testdb');
	}

	protected function getDataSet()
	{
		$dataSet = new PHPUnit_Extensions_Database_DataSet_CsvDataSet();
		$dataSet->addTable('post', ROOT_PATH.'/test/winphp/fixture/post.csv');
		return $dataSet;
	}

	public function testQueryList(){
		$tmpl=new PDOTemplate($this->dsn);
		$list=$tmpl->queryForList('select * from post');
		$this->assertEquals(3,count($list));
		foreach($list as $i=>$obj){
			$this->assertEquals($i+1,$obj['post_id']);
		}
	}

	public function testQueryObject(){
		$tmpl=new PDOTemplate($this->dsn);
		$obj=$tmpl->queryForObject('select * from post where post_id=? ',1);

		$this->assertEquals("My First Post",$obj['title']);
		$this->assertEquals(5,$obj['rating']);
	}

	public function testQueryObject2(){
		$tmpl=new PDOTemplate($this->dsn);
		$obj=$tmpl->queryForObject('select * from post where post_id=? and rating=?',1,4);
		$this->assertNull($obj);
	}
	//绑定两个参数的情况，找出了bindParam和bindValue的区别
	public function testQueryObject3(){
		$tmpl=new PDOTemplate($this->dsn);
		$obj=$tmpl->queryForObject('select * from post where post_id = ? and rating = ?',1,5);
		$this->assertEquals("My First Post",$obj['title']);
	}
	
	public function testQueryList2(){
		$tmpl=new PDOTemplate($this->dsn);
		$list=$tmpl->queryForList('select * from post where  rating in ?',array(3,5));
		$this->assertEquals(2,count($list));
	}
	
	public function testQueryList3(){
		$tmpl=new PDOTemplate($this->dsn);
		$list=$tmpl->queryForList('select * from post where  rating in ?',array('3','5'));
		$this->assertEquals(2,count($list));
	}
	
	public function testQueryInt(){
		$tmpl=new PDOTemplate($this->dsn);
		$int=$tmpl->queryForInt('select count(*) from post');
		$this->assertEquals(3,$int);
	}

	public function testInsert(){
		$tmpl=new PDOTemplate($this->dsn);
		$res=$tmpl->insert('insert into post(title,date_created,contents,rating) values (?,?,?,?)','ttt','2010-01-01','contents',4);
		$this->assertTrue($res);
		$this->assertEquals(4, $tmpl->lastInsertId());
	}

	public function test111(){

		//var_dump("bindIdx: $bindIdx");
		//var_dump("bindArg: $arg");
		$pdo=new PDO($this->dsn,'','',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
		$stmt=$pdo->prepare('select * from post where post_id = ? and rating = ?');
		$p1=1;
		$p2=5;
		$stmt->bindParam(1,$p1,PDO::PARAM_INT);
		$stmt->bindParam(2,$p2,PDO::PARAM_INT);
		$stmt->execute();
		$obj=$stmt->fetchAll();
	}
}
