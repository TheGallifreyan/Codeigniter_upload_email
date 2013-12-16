<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		$this->load->view('upload_form', array('error' => ' ' ));
	}

	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'docx|rtf|pdf'; //Allowed file types
		$config['max_size']	= '1000'; // In kb
		// $config['max_width']  = '1024'; Used with image uploads, in px
		// $config['max_height']  = '768'; Used with image uploads, in px
		$config['remove_spaces'] = TRUE; //If set to TRUE, any spaces in the file name will be converted to underscores, recommended
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$this->load->view('upload_success', $data);
			$uploads_url = 'path/to/upload/folder/';
			$upload_data = $this->upload->data(); 
			
				// Converts the document name to a string, which is used to buid hyperlink to document for email
  			$file_name =   $upload_data['file_name'];
			if (!is_object($file_name) || method_exists($file_name, '__toString')) 
			{
				$file_string = (string)$file_name;
			} 
			else 
			{
				$string = 'Object';
			}	
				//End Object to string conversion
				
			 $this->load->library('form_validation');
			 
				// Validate the name and email input
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			if($this->form_validation->run() == FALSE)
			{
				echo 'The information you have submitted is incorrect. Please try again.';
			}
			else
			{
				$name = $this->input->post('name');
				$email = $this->input->post('email');
				$comments = $this->input->post('comments');
			}
			
				//Email data from input including document URL
			$this->load->library('email');
			$this->email->from($email, $name);
			$this->email->to('recipient@email.com'); 
			$this->email->subject('A new file has been uploaded');
			$this->email->message('path/to/upload/folder'.$file_string); // Use full URL for clarity
			$this->email->send();			
		}
	}
}
?>
