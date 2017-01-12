<?php
/*
* Post model.
*/
	class Post_model extends CI_Model
	{
		//Constructor
		public function __construct()
		{
			//Loads the database specified in config/database.php
			$this->load->database();
		}

		//Retrieves all posts from the databse.
		//$slug: A url for a post. If false all posts are retreived, otherwise
		//only the post relating to the slug is retreived.
		public function get_posts($slug = false)
		{
			//If the slug is false retreive all posts
			if($slug === false)
			{
				//Gets all posts from the database and their associated categories and order them by their id.
				$this->db->order_by('posts.id', 'desc');
				$this->db->join('categories', 'categories.id = posts.category_id');
				$query = $this->db->get('posts');

				//Returns the result of the query.
				return $query->result_array();
			}

			//If the slug is not false retreive the post related to the slug.
			$query = $this->db->get_where('posts', array('slug' => $slug));

			//Returns the row fetched by the query.
			return $query->row_array();
		}

		//Creates new posts.
		//$post_image: The image to be associated with the new post.
		public function create_post($post_image)
		{
			//Sets the slug for the new post.
			$slug = url_title($this->input->post('title'));

			//Sets the new post information to be inserted in the database.
			$data = array('title' => $this->input->post('title'),
						  'slug' => $slug,
						  'body' => $this->input->post('post-body'),
						  'category_id' => $this->input->post('category_id'),
						  'image' => $post_image);

			//Returns the newly inserted post.
			return $this->db->insert('posts', $data);
		}

		//Deletes the specified post.
		//$id: The id of the post to be deleted.
		public function delete_post($id)
		{
			//Deletes the post from the database.
			$this->db->where('id', $id);
			$this->db->delete('posts');

			return true;
		}

		//Responsible for updating posts that have been edited.
		public function update_post()
		{
			//Resets the slug
			$slug = url_title($this->input->post('title'));

			//Resets the post data.
			$data = array('title' => $this->input->post('title'),
						  'slug' => $slug,
						  'body' => $this->input->post('post-body'),
					    'category_id' => $this->input->post('category_id'));

			//Updates the post in the database.
			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('posts', $data);
		}

		//Retreives all categories from the database.
		public function get_categories()
		{
			//Orders the categories by name.
			$this->db->order_by('name');
		  	$query = $this->db->get('categories');

			//Returns the result of the query.
			return $query->result_array();
		}
	}

?>
