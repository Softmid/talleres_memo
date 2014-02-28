<?php 

class Validacion extends CI_Model {

	function check_username($data) {
		
		$username = $data['username'];
		
		$sql = "SELECT username FROM usuarios WHERE username = '$username' LIMIT 1";
		$result = $this->db->query($sql);
		$row = $result->num_rows();
			if ($row == 0)
			{
				echo "true";	
			}
			
			else 
			{
				echo "false";
			}
		
		
	}
	
	function check_vin($data) {
		
		$variable = $data['vin'];
		
		$sql = "SELECT num_VIN FROM vehiculo WHERE num_VIN = '$variable' LIMIT 1";
		$result = $this->db->query($sql);
		$row = $result->num_rows();
			if ($row == 0)
			{
				echo "true";	
			}
			
			else 
			{
				echo "false";
			}
		
		
	}
	function check_numSerie($data) {
		
		$variable = $data['num_serie'];
		
		$sql = "SELECT num_serie FROM vehiculo WHERE num_serie = '$variable' LIMIT 1";
		$result = $this->db->query($sql);
		$row = $result->num_rows();
			if ($row == 0)
			{
				echo "true";	
			}
			
			else 
			{
				echo "false";
			}
		
		
	}

	

}

?>
