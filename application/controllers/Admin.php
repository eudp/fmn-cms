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

    /*List of establishments and edit individual establishments*/

    public function establecimientos($establishment_id = null)
    {
    	if ($establishment_id == null) {
    		$data['establishments'] = $this->establecimientos_model->get(null, null, null);
	    	$h_data['title'] = 'Admin | Fundación Museos Nacionales';
	        $h_data['active'] = 'admin';

	        $this->load->view('includes/header_admin',$h_data);
	        $this->load->view('admin/establecimientos/list', $data);
	        $this->load->view('includes/footer_admin');
    	} else {

    		/* Edit establishment*/

    		$data['establishment'] = $this->establecimientos_model->get(null, $establishment_id, null);
    		$data['establishment']['description'] = strip_tags($data['establishment']['description'],'<a><em><strong><p><br>');

	    	$h_data['title'] = 'Admin | Fundación Museos Nacionales';
	        $h_data['active'] = 'admin';

	        $this->load->view('includes/header_admin',$h_data);
	        $this->load->view('admin/establecimientos/edit_establecimiento', $data);
	        $this->load->view('includes/footer_admin');
    	}
    }

    public function nuevo_establecimiento ($type) 
    {
        $data['type'] = $type;
    	$h_data['title'] = 'Admin | Fundación Museos Nacionales';
        $h_data['active'] = 'admin';

        $this->load->view('includes/header_admin',$h_data);
        $this->load->view('admin/establecimientos/new_establecimiento', $data);
        $this->load->view('includes/footer_admin');
    }

    public function set_establecimiento($u_path)
    {
    	/* Upload image*/
        $image_id = $this->upload_image($u_path);

    	/*Update establishment*/

    	$this->load->library('form_validation');
    	$this->form_validation->set_rules('titulo', 'titulo', 'required');
    	if ($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
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
			    'schedule' 		=> $this->input->post('horario'),
			    'modified_date' => time(),
                'type'          => $u_path,
			    'status'        => $status,
			    'image_id'		=> $image_id
			);

			$establishment_id = $this->input->post('id');

			if ($establishment_id == null) {

				$array += ['creation_date' => time()];
				$array += ['user_id' => 66];

				$this->establecimientos_model->set($array);
				redirect(site_url('admin/establecimientos/'), 'refresh');

			} else {
				$this->establecimientos_model->set($array, $this->input->post('id'));

	    		redirect(site_url('admin/establecimientos/'. $this->input->post('id')), 'refresh');
			}
        }
    }

    public function eliminar_museo ($establishment_id) 
    {
		$this->establecimientos_model->delete($establishment_id);

		redirect(site_url('admin/establecimientos/'), 'refresh');
    }

    public function upload_image ($u_path)
    {

        $upload_path = [
            "museo"     => "./assets/images/museos/",
            "instituto" => "./assets/images/institutos/"
        ];

        $config['upload_path']   = $upload_path[$u_path];
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);
        $_FILES['userfile']['name'] = time() . '-' .  convert_accented_characters($_FILES['userfile']['name']) ;

        if ( ! $this->upload->do_upload('userfile'))
        {
            return null;            
            /* Handling this error*/
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $array = array(
                'user_id'       => 66,
                'creation_date' => time(),
                'modified_date' => time(),
                'filemime'      => $data['upload_data']['file_type'],
                'path'          => str_replace('./assets/images', "", $upload_path[$u_path]) . convert_accented_characters($data['upload_data']['file_name']),
                'file_size'     => $_FILES['userfile']['size'],
                'file_name'     => $data['upload_data']['file_name']
            );

            return $this->archivos_model->set($array);
        }
    }
}
