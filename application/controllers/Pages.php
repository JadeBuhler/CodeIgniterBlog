<?php
	class Pages extends CI_Controller
	{
		public function view($page = 'home')
		{
			//APPPATH is a CI constant that contains the path to the application folder.
			if(!file_exists(APPPATH.'views/pages/'.$page.'.php'))
			{
				//Built in CI function to display a 404 error.
				show_404();
			}

			//ucfirst capitalizes the first letter of a string
			$data['title'] = ucfirst($page);

			//Loads the header, pages and footer views.
			$this->load->view('templates/header');
			$this->load->view('pages/'.$page, $data);
			$this->load->view('templates/footer');
		}
	}
?>
