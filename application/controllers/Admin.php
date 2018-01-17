<?php
class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('text');
        $this->load->model('archivos_model');
        $this->load->model('establecimientos_model');
    }

    public function index()
    {
        $h_data['title'] = 'Admin | Fundación Museos Nacionales';
        $h_data['active'] = 'admin';

        $this->load->view('includes/header_admin',$h_data);
        $this->load->view('admin/index');
        $this->load->view('includes/footer_admin');
    }

    public function establecimientos($establishment_id = null)
    {
    	if ($establishment_id == null) {
    		$data['establishments'] = $this->establecimientos_model->get('all', false, 'all');
	    	$h_data['title'] = 'Admin | Fundación Museos Nacionales';
	        $h_data['active'] = 'admin';

	        $this->load->view('includes/header_admin',$h_data);
	        $this->load->view('admin/establishments', $data);
	        $this->load->view('includes/footer_admin');
    	} else {
    		$data['establishment'] = $this->establecimientos_model->get('all', $establishment_id, 'all');
    		$data['establishment']['description'] = strip_tags($data['establishment']['description'],'<a><em><strong><p><br>');

	    	$h_data['title'] = 'Admin | Fundación Museos Nacionales';
	        $h_data['active'] = 'admin';

	        $this->load->view('includes/header_admin',$h_data);
	        $this->load->view('admin/establishments_edit', $data);
	        $this->load->view('includes/footer_admin');
    	}

    }

    public function update_establecimiento($u_path){

    	/* Upload image*/

        $upload_path = [
			"museo" => "./assets/images/museos/",
		];

        $config['upload_path']   = $upload_path[$u_path];
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);

        print_r($this->upload->data());

        if ( ! $this->upload->do_upload('userfile'))
        {
            echo 'error';
        }
        else
        {
        	$data = array('upload_data' => $this->upload->data());
            $array = array(
            	'user_id'		=> 66,
			    'creation_date' => time(),
			    'modified_date' => time(),
			    'filemime' 		=> $data['upload_data']['file_type'],
			    'path' 			=> str_replace('./assets/images', "", $upload_path[$u_path]) . convert_accented_characters($data['upload_data']['file_name']),
			    'file_size' 	=> $data['upload_data']['file_size'],
			    'file_name' 	=> $data['upload_data']['file_name']
			);

			$image_id = $this->archivos_model->set($array);
        }

    	/*Update post*/

    	$status = $this->input->post('status');

		$status = (!isset($status)? 0 : 1);

    	$array = array(
		    'acronym'	    => $this->input->post('acronimo'),
		    'title'	        => $this->input->post('titulo'),
		    'description'   => $this->input->post('descripcion'),
		    'address'       => $this->input->post('direccion'),
		    'phone'         => $this->input->post('telefono'),
		    'email'         => $this->input->post('correo'),
		    'facebook_url'  => $this->input->post('facebook'),
		    'instagram_url' => $this->input->post('instagram'),
		    'twitter_url'   => $this->input->post('twitter'),
		    'site_url' 		=> $this->input->post('url'),
		    'modified_date' => time(),
		    'status'        => $status,
		    'image_id'		=> $image_id
		);

    	$this->establecimientos_model->update($array, $this->input->post('id'));

    	redirect(site_url('admin/establecimientos/'. $this->input->post('id')), 'refresh');

    }

    public function do_upload($u_path)
    {

    	$upload_path = [
			"museo" => "./assets/images/museos/",
		];

        $config['upload_path']   = $upload_path[$u_path];
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
            echo 'error';
        }
        else
        {
        	$data = array('upload_data' => $this->upload->data());
            $array = array(
            	'user_id'		=> 66,
			    'creation_date' => time(),
			    'modified_date' => time(),
			    'filemime' 		=> $data['upload_data']['file_type'],
			    'path' 			=> str_replace('./assets/images', "", $upload_path[$u_path]) . convert_accented_characters($data['upload_data']['file_name']),
			    'file_size' 	=> $data['upload_data']['file_size'],
			    'file_name' 	=> $data['upload_data']['file_name']
			);

			$insert_id = $this->archivos_model->set($array);
        }
    }

}
