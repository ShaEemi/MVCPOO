<?php
/**
* 
*/
class Controller extends AppController
{
	function index(){
		$this->load->view('sample', 'index');
	}

	function sample(){
		$this->load->view('sample', 'sample');
	}
}