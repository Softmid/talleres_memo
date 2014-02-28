<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migrate extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('migration');
	}

	public function index()
	{		
		if ( ! $this->migration->current()) {
			show_error($this->migration->error_string());
		} else {
			echo "Migracion realizada";
		}
	}

	public function latest()
	{		
		if ( ! $this->migration->latest()) {
			show_error($this->migration->error_string());
		} else {
			echo "Actualizado a la ultima version";
		}
	}

	public function version($version = '')
	{
		if (! empty($version)) {
			if(! $this->migration->version($version)) {
				show_error($this->migration->error_string());
			} else {
				echo "Migracion realizada a la version $version";
			}
		} else {
			echo "No se ha proporcionado una version";
		}
	}

}

/* End of file migration.php */
/* Location: ./application/controllers/migration.php */