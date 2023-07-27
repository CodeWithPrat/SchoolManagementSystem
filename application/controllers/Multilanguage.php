<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/*
 *	@author 	: Optimum Linkup Universal Concepts
 *	date		: 27 June, 2016
 *	Optimum Linkup Universal Concepts
 *	http://optimumlinkup.com.ng/school/Optimum Linkup Universal Concepts
 *	optimumproblemsolver@gmail.com
 */


class Multilanguage extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		/*cash control*/
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}
	
	function index()
	{
	}
	
	function select_language($language = 'english')
	{
		$this->session->set_userdata('current_language', $language);
        $sql = "update settings set description='" . $language . "' where type='language'";
        $this->db->query($sql);
		redirect(base_url(), 'refresh');
	}
	
	
	
}
