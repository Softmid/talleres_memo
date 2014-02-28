<?php

class Procesos_Login extends CI_Model {

	public function ingresarSistema()
	{
		$this->db->where('username',$this->input->post('usuario'));
		$this->db->where('password',sha1($this->input->post('password')));
		$query = $this->db->get('usuarios');
		
		if($query->num_rows()==1)
		{
			return true;
		}
		else
		{
			return false;
		}
	} 


}

?>