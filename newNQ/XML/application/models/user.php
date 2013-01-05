<?php
class User extends Doctrine_Record {

	public function setTableDefinition() {
		$this->hasColumn('fname', 'varchar', 255);
		$this->hasColumn('lname', 'varchar', 255);
		$this->hasColumn('email', 'string', 255, array('unique' => 'true'));
		$this->hasColumn('username', 'string', 255, array('unique' => 'true'));
		$this->hasColumn('password', 'string', 255);
		$this->hasColumn('user_type', 'int', 11);
		$this->hasColumn('telephone', 'varchar', 255);
		$this->hasColumn('status', 'int', 11);
		$this->hasColumn('department_id','int', 11);
	}
	
	public function setUp() {
		$this->setTableName('user');
		$this->actAs('Timestampable');
		$this->hasMutator('password', '_encrypt_password');
		$this -> hasMany('Facilities as Codes', array('local' => 'facility', 'foreign' => 'facility_code'));
		$this -> hasMany('access_level as u_type', array('local' => 'usertype_id', 'foreign' => 'type'));
		$this -> hasMany('facilities as hosi', array('local' => 'facility', 'foreign' => 'facility_code'));
		
	}

	protected function _encrypt_password($value) {
		$salt = '#*seCrEt!@-*%';
		$this->_set('password', md5($salt . $value));
	}
	
	public function login($username, $password) {
		

		$query = Doctrine_Query::create() -> select("user_type") -> from("User") -> where("username = '" . $username . "'");

		$x = $query -> execute();
		return $x[0];
	}
	public static function getAll2($facility,$id) {
		$query = Doctrine_Query::create() -> select("*") -> from("user")->where("usertype_id=2 or usertype_id=5 ")->andWhere("id <> $id and facility='$facility'");
		$level = $query -> execute();
		return $level;
	}
	public static function getAll3($use_id) {
		$query = Doctrine_Query::create() -> select("*") -> from("user")->where("usertype_id=2 and id=$use_id");
		$level = $query -> execute();
		return $level;
		
	}
	public static function getAll4($use_id) {
		$myobj = Doctrine::getTable('user')->findOneById($use_id);
        $id=$myobj->id ;
		$my_array =array('0'=>$id);
		return $my_array;
	}
	public static function getAll(){
		$query = Doctrine_Query::create() -> select("*") -> from("user");
		$level = $query -> execute();
		return $level;
	}
	public static function getAll5($district, $id){
		$query = Doctrine_Query::create() -> select("*") -> from("user")->where("district=$district") ->andWhere("id <> $id");
		$level = $query -> execute();
		return $level;
	}
	public static function getUsers($facility_c){
		$query = Doctrine_Query::create() -> select("*") -> from("user")->where("facility=$facility_c");
		$level = $query -> execute();
		return $level;
	}
	
	public static function getAnalysts($reqid) {
		$query = Doctrine_Query::create()
		->select("u.*")
		->from("User u, Tests t, Request_details r")
		->where('u.department_id = ?',1)
		//->andWhere('u.user_type =?', 1)
		->andWhere('r.request_id = ?', $reqid)
		;
		$analyst_s =  $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $analyst_s;
	}
}
