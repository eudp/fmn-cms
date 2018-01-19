<?php
class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('text');
        $this->load->model('archivos_model');
        $this->load->model('establecimientos_model');
        $this->load->model('noticias_model');
        $this->load->model('exposiciones_model');
        $this->load->model('colecciones_model');
        $this->load->model('obras_model');
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
			    'status'        => $status
			);

            if ($image_id != null) {

                $array += ['image_id' => $image_id];
            }

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
    /* Handle delete permisology*/
    public function eliminar_museo ($establishment_id) 
    {
		$this->establecimientos_model->delete($establishment_id);

		redirect(site_url('admin/establecimientos/'), 'refresh');
    }

    public function upload_image ($u_path)
    {

        $upload_path = [
            "museo"      => "./assets/images/museos/",
            "instituto"  => "./assets/images/institutos/",
            "noticia"    => "./assets/images/noticias/",
            "exposicion" => "./assets/images/exposiciones/",
            "coleccion"  => "./assets/images/colecciones/",
            "obra"       => "./assets/images/obras/"
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
    /*List of news and edit individual news*/

    public function noticias($news_id = null)
    {
        if ($news_id == null) {
            $data['news'] = $this->noticias_model->get(null, null);
            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/noticias/list', $data);
            $this->load->view('includes/footer_admin');
        } else {

            /* Edit news*/

            $data['news'] = $this->noticias_model->get($news_id, null);
            $data['news']['description'] = strip_tags($data['news']['description'],'<a><em><strong><p><br>');

            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/noticias/edit_noticia', $data);
            $this->load->view('includes/footer_admin');
        }
    }

    public function nueva_noticia () 
    {
        $h_data['title'] = 'Admin | Fundación Museos Nacionales';
        $h_data['active'] = 'admin';

        $this->load->view('includes/header_admin',$h_data);
        $this->load->view('admin/noticias/new_noticia');
        $this->load->view('includes/footer_admin');
    }

    public function set_noticia()
    {
        /* Upload image*/
        $image_id = $this->upload_image('noticia');

        /*Update news*/

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
                'title'            => $this->input->post('titulo'),
                'description'      => $this->input->post('descripcion'),
                'excerpt'          => $this->input->post('excerpt'),
                'publication_date' => strtotime($this->input->post('fecha-publicacion')),
                'modified_date'    => time(),
                'status'           => $status
            );

            if ($image_id != null) {

                $array += ['image_id' => $image_id];
            }

            $news_id = $this->input->post('id');

            if ($news_id == null) {

                $array += ['creation_date' => time()];
                $array += ['user_id' => 66];

                $this->noticias_model->set($array);
                redirect(site_url('admin/noticias/'), 'refresh');

            } else {
                $this->noticias_model->set($array, $this->input->post('id'));

                redirect(site_url('admin/noticias/'. $this->input->post('id')), 'refresh');
            }
        }
    }

    /* Handle delete permisology*/
    public function eliminar_noticia ($news_id) 
    {
        $this->noticias_model->delete($news_id);

        redirect(site_url('admin/noticias/'), 'refresh');
    }

    /*List of expositions and edit individual exposition*/

    public function exposiciones($exposition_id = null)
    {
        if ($exposition_id == null) {
            $data['exposition'] = $this->exposiciones_model->get(null, null, null);
            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/exposiciones/list', $data);
            $this->load->view('includes/footer_admin');
        } else {

            /* Edit exposition*/

            $data['exposition'] = $this->exposiciones_model->get(null, $exposition_id, null);
            $data['exposition']['description'] = strip_tags($data['exposition']['description'],'<a><em><strong><p><br>');

            $data['establishments'] = $this->establecimientos_model->get(null, null);

            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/exposiciones/edit_exposicion', $data);
            $this->load->view('includes/footer_admin');
        }
    }

    public function nueva_exposicion () 
    {
        $data['establishments'] = $this->establecimientos_model->get(null, null);
        $h_data['title'] = 'Admin | Fundación Museos Nacionales';
        $h_data['active'] = 'admin';

        $this->load->view('includes/header_admin',$h_data);
        $this->load->view('admin/exposiciones/new_exposicion', $data);
        $this->load->view('includes/footer_admin');
    }

    public function set_exposicion()
    {
        /* Upload image*/
        $image_id = $this->upload_image('exposicion');

        /*Update exposition*/

        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'titulo', 'required');
        $this->form_validation->set_rules('id_establecimiento', 'id_establecimiento', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
            $status = $this->input->post('status');
            $status = (!isset($status)? 0 : 1);

            $actual = $this->input->post('actual');
            $actual = (!isset($actual)? 0 : 1);

            $array = array(
                'title'            => $this->input->post('titulo'),
                'description'      => $this->input->post('descripcion'),
                'exhibition_place' => $this->input->post('lugar_exhibicion'),
                'schedule'         => $this->input->post('horario'),
                'establishment_id' => $this->input->post('id_establecimiento'),
                'modified_date'    => time(),
                'actual'           => $actual,
                'status'           => $status
            );

            if ($image_id != null) {

                $array += ['image_id' => $image_id];
            }

            $exposition_id = $this->input->post('id');

            if ($exposition_id == null) {

                $array += ['creation_date' => time()];
                $array += ['user_id' => 66];

                $this->exposiciones_model->set($array);
                redirect(site_url('admin/exposiciones/'), 'refresh');

            } else {
                $this->exposiciones_model->set($array, $this->input->post('id'));

                redirect(site_url('admin/exposiciones/'. $this->input->post('id')), 'refresh');
            }
        }
    }

    /* Handle delete permisology*/
    public function eliminar_exposicion ($exposition_id) 
    {
        $this->exposiciones_model->delete($exposition_id);

        redirect(site_url('admin/exposiciones/'), 'refresh');
    }

    /*List of collections and edit individual collection*/

    public function colecciones($collection_id = null)
    {
        if ($collection_id == null) {
            $data['collection'] = $this->colecciones_model->get(null, null);
            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/colecciones/list', $data);
            $this->load->view('includes/footer_admin');
        } else {

            /* Edit collection*/

            $data['collection'] = $this->colecciones_model->get($collection_id, null);
            $data['collection']['description'] = strip_tags($data['collection']['description'],'<a><em><strong><p><br>');

            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/colecciones/edit_coleccion', $data);
            $this->load->view('includes/footer_admin');
        }
    }

    public function nueva_coleccion () 
    {
        $h_data['title'] = 'Admin | Fundación Museos Nacionales';
        $h_data['active'] = 'admin';

        $this->load->view('includes/header_admin',$h_data);
        $this->load->view('admin/colecciones/new_coleccion');
        $this->load->view('includes/footer_admin');
    }

    public function set_coleccion()
    {
        /* Upload image*/
        $image_id = $this->upload_image('coleccion');

        /*Update collection*/

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
                'title'            => $this->input->post('titulo'),
                'description'      => $this->input->post('descripcion'),
                'modified_date'    => time(),
                'status'           => $status
            );

            if ($image_id != null) {

                $array += ['image_id' => $image_id];
            }

            $collection_id = $this->input->post('id');

            if ($collection_id == null) {

                $array += ['creation_date' => time()];
                $array += ['user_id' => 66];

                $this->colecciones_model->set($array);
                redirect(site_url('admin/colecciones/'), 'refresh');

            } else {
                $this->colecciones_model->set($array, $this->input->post('id'));

                redirect(site_url('admin/colecciones/'. $this->input->post('id')), 'refresh');
            }
        }
    }

    /* Handle delete permisology*/
    public function eliminar_coleccion ($collection_id) 
    {
        $this->colecciones_model->delete($collection_id);

        redirect(site_url('admin/colecciones/'), 'refresh');
    }

    /*List of obras and edit individual obra*/

    public function obras($obra_id = null)
    {
        if ($obra_id == null) {
            $data['obra'] = $this->obras_model->get(null, null);
            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/obras/list', $data);
            $this->load->view('includes/footer_admin');
        } else {

            /* Edit obra*/

            $data['obra'] = $this->obras_model->get($obra_id, null);
            $data['obra']['description'] = strip_tags($data['obra']['description'],'<a><em><strong><p><br>');

            $data['collections'] = $this->colecciones_model->get(null, null);

            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/obras/edit_obra', $data);
            $this->load->view('includes/footer_admin');
        }
    }

    public function nueva_obra () 
    {
        $data['collections'] = $this->colecciones_model->get(null, null);
        $h_data['title'] = 'Admin | Fundación Museos Nacionales';
        $h_data['active'] = 'admin';

        $this->load->view('includes/header_admin',$h_data);
        $this->load->view('admin/obras/new_obra', $data);
        $this->load->view('includes/footer_admin');
    }

    public function set_obra()
    {
        /* Upload image*/
        $image_id = $this->upload_image('obra');

        /*Update obra*/

        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'titulo', 'required');
        $this->form_validation->set_rules('id_coleccion', 'id_coleccion', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
            $status = $this->input->post('status');
            $status = (!isset($status)? 0 : 1);

            $array = array(
                'title'          => $this->input->post('titulo'),
                'description'    => $this->input->post('descripcion'),
                'collection_id'  => $this->input->post('id_coleccion'),
                'modified_date'  => time(),
                'status'         => $status
            );

            if ($image_id != null) {

                $array += ['image_id' => $image_id];
            }

            $obra_id = $this->input->post('id');

            if ($obra_id == null) {

                $array += ['creation_date' => time()];
                $array += ['user_id' => 66];

                $this->obras_model->set($array);
                redirect(site_url('admin/obras/'), 'refresh');

            } else {
                $this->obras_model->set($array, $this->input->post('id'));

                redirect(site_url('admin/obras/'. $this->input->post('id')), 'refresh');
            }
        }
    }

    /* Handle delete permisology*/
    public function eliminar_obra ($obra_id) 
    {
        $this->obras_model->delete($obra_id);

        redirect(site_url('admin/obras/'), 'refresh');
    }
}
