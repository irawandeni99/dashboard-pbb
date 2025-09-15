<?php
	class Auth_model extends CI_Model{

		public function login($data){
/* 			$query = 'SELECT name FROM ms_user';
	    	$sql = $this->db->query($query)->result();

	    	foreach ($sql as $value) {
	    		$arrayDaerah = $value->name;
	    	}
			print_r($arrayDaerah); */
			$query = $this->db->get_where('ms_user', array('username' => $data['username']));
			//print_r($query);die();
			if ($query->num_rows() == 0){
				return false;
			}
			else{
				//Compare the password attempt with the password we have stored.
				$result = $query->row_array();
			    $validPassword = password_verify($data['password'], $result['password']);
			    if($validPassword){
			        return $result = $query->row_array();
			    }
				
			}
		}

		public function change_pwd($data, $id){
			$this->db->where('id_user', $id);
			$this->db->update('ms_user', $data);
			$res = $this->db->affected_rows();
			if ($res > 0) {
				$ret = true;
			}else{
				$ret = false;
			}
			return $ret;
		}

		public function update($data){
			$ctgl = date("Y-m-d H:i:s");
			$sql = "UPDATE ms_user SET st_login=1, last_login='$ctgl' WHERE email='" .$data['email'] ."' ";
			$this->db->query($sql);
			return true;
		}

		public function update_out($id2){
			$ctgl = date("Y-m-d H:i:s");
			$sql = "UPDATE ms_user SET st_login=0, last_logout='$ctgl' WHERE id_user='$id2'";
			$this->db->query($sql);
			return true;
		}

	}

?>