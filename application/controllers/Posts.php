<?php
/*
* Posts controller
*/
	class Posts extends CI_Controller
	{
		//Handles the display of the posts page.
		public function index()
		{
			$data['title'] = "Latest Posts";

			//Retrieves posts from the database using the get_posts() method.
			$data['posts'] = $this->Post_model->get_posts();

			//Loads the header, index and footer views.
			$this->load->view('templates/header');
			$this->load->view('posts/index', $data);
			$this->load->view('templates/footer');
		}

		//This function is called when the "Read More" link is clicked.
		//In short, this function displays a singular post.
		//$Slug: A url to the spceific post.
		public function view($slug = null)
		{
			//Retreives the slug relating to the specified post from the database.
			$data['post'] = $this->Post_model->get_posts($slug);

			//If the post is empty, IE does not exist...
			if(empty($data['post']))
			{
				//Show a 404 error.
				show_404();
			}

			$data['title'] = $data['post']['title'];

			//Loads the header, view and footer views.
			$this->load->view('templates/header');
			$this->load->view('posts/view', $data);
			$this->load->view('templates/footer');
		}

		//Handles the creation of new posts.
		public function create()
		{
			$data['title'] = "Create Post";

			//Retreives the categoires fro the database using the get_categories method.
			$data['categories'] = $this->Post_model->get_categories();

			//Enforces validation rules on the title and body, making them required fields.
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('post-body', 'Body', 'required');

			//If the form validations have not run IE a post has not been submitted yet...
			if($this->form_validation->run()=== false)
			{
				//Loads the header, create and footer views.
				$this->load->view('templates/header');
				$this->load->view('posts/create', $data);
				$this->load->view('templates/footer');
			}
			else
			{
				//config settings needed to upload images.
				$config['upload_path'] = './assets/images/posts';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2048';
				$config['max_width'] = '500';
				$config['max_height'] = '500';

				//Loads the specified config settings.
				$this->load->library('upload', $config);

				//If the image was not uploaded...
				if (!$this->upload->do_upload())
				{
					//Capture the error message in the $errors array.
					$errors = array('error' => $this->upload->display_errors());

					//Set the post image to noimage.png
					//noimage.png is a placeholder image for posts without an image.
					$post_image = 'noimage.png';
				}
				else
				{
					$data = array('upload_data' => $this->upload->data());

					//In order for image uploading to work in CodeIgniter the name attribute must be "userfile"
					$post_image = $_FILES['userfile']['name'];
				}

				//Creates the new post using the create_post method.
				$this->Post_model->create_post($post_image);

				//Redirects the user to the posts page.
				redirect('posts');
			}
		}

		//Handles the deletion of posts.
		//$id: The id of the post being deleted.
		public function delete($id)
		{
			//Deletes the specified post using the delete_post method.
			$this->Post_model->delete_post($id);

			//Redirects the user to the posts page.
			redirect('posts');
		}

		//Handles the editing of posts
		//$slug: A url to the post being edited.
		public function edit($slug)
		{
			//Loads the specified post.
			$data['post'] = $this->Post_model->get_posts($slug);

			//Loads the categories.
			$data['categories'] = $this->Post_model->get_categories();

			//If the specified post does not exist...
			if(empty($data['post']))
			{
				//Show a 404 error.
				show_404();
			}

			$data['title'] = "Edit Post";

			//Loads the header, edit and footer views.
			$this->load->view('templates/header');
			$this->load->view('posts/edit', $data);
			$this->load->view('templates/footer');
		}

		//Handles the submission of an edited post.
		public function update()
		{
			//Updates the post using the update_post method.
			$this->Post_model->update_post();

			//Redirects the user to the posts page.
			redirect('posts');
		}
	}
?>
