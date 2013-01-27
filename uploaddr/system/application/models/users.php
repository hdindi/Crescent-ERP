<?php

class Users extends Model {
	
    function Users()
    {
        // Call the Model constructor
        parent::Model();
    }

	function register($username, $password)
	{
	    $new_user = array (
	    	'username'=>$username,
	    	'password'=>$password
	    );

	    $this->db->insert('users', $new_user);

		return true;
	}
	
	function login($username, $password)
	{

		$query = $this->db->get_where('users', array('username'=>$username, 'password'=>$password));

		if ($query->num_rows()==0) return false;
		else{
			$result = $query->result();
			$userid = $result[0]->id;

			return $userid;
		}

	}

}