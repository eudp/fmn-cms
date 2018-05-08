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
        $this->load->model('contacto_model');
        $this->load->model('agenda_model');
        $this->load->model('multimedia_model');
        $this->load->model('carrusel_model');

        $this->load->helper('domain_museum');
        $this->load->helper('servicios');
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

            if (empty($data['establishment'])) {
                show_404();
            }

    		$data['establishment']['description'] = strip_tags($data['establishment']['description'],'<a><em><strong><p><br><ul><li><table><tbody><tr><td><u><strike><h1><h2><h3><h4><h5><h6>');

            $data['services'] = ($data['establishment']['type'] == 'museo' ? servicios_translate_edit($data['establishment']['services']) : $data['establishment']['services']);

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
    	$this->load->library('form_validation');
    	$this->form_validation->set_rules('titulo', 'titulo', 'required');
    	if ($this->form_validation->run() == FALSE)
        {

            $this->session->set_flashdata('errors', validation_errors('<li>', '</li>'));

            ($this->input->post('id') != null ? redirect(site_url('admin/establecimientos/'. $this->input->post('id')), 'refresh') :redirect(site_url('admin/' . $u_path . '/new'), 'refresh'));
        }
        else
        {
            /* Upload image*/
            $image_id = $this->upload_file($u_path);

            /*Update establishment*/
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
                'services'      => ($u_path == 'museo' ? servicios_form_post($this->input->post()) : $this->input->post('servicio')),
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

    public function upload_file ($u_path, $featured_image = true, $museos = '')
    {
        // Select input field
        $file = 'userfile';
        $config['allowed_types'] = 'jpg|gif|jpeg|png';
        if (!$featured_image) {
            $file = 'multimediafile';
            $config['allowed_types'] = 'mp3|pdf';
        }

        $upload_path = [
            "museo"                      => "./assets/images/museos/",
            "instituto"                  => "./assets/images/institutos/",
            "noticia"                    => "./assets/images/noticias/",
            "exposicion"                 => "./assets/images/exposiciones/",
            "coleccion"                  => "./assets/images/colecciones/",
            "obra"                       => "./assets/images/obras/",
            "agenda"                     => "./assets/images/agenda/",
            "multimedia"                 => "./assets/images/multimedias/",
            "multimedia_file"            => "./assets/files/multimedias/",
            "galeria"                    => "./assets/images/galeria/",
            "agenda_museos"              => "./assets/images/agenda_museos/",
            "coleccion_museos"           => "./assets/images/colecciones_museos/",
            "exposicion_museos"          => "./assets/images/exposicion_museos/",
            "multimedia_museos"          => "./assets/images/multimedias_museos/",
            "multimedia_file_museos"     => "./assets/files/multimedias_museos/",
            "noticia_museos"             => "./assets/images/noticias_museos/",
            "galeria_museos"             => "./assets/images/galeria_museos/",
            "carrusel_museo"             => "./assets/images/museos/carrusel/",
            "carrusel_instituto"         => "./assets/images/institutos/carrusel/",
            "carrusel_coleccion"         => "./assets/images/colecciones/carrusel/",
            "carrusel_exposicion"        => "./assets/images/exposiciones/carrusel/",
            "carrusel_coleccion_museos"  => "./assets/images/colecciones/carrusel/",
            "carrusel_exposicion_museos" => "./assets/images/exposiciones/carrusel/"
        ];

        $config['upload_path']   = $upload_path[$u_path];

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $_FILES[$file]['name'] = time() . '-' .  convert_accented_characters($_FILES[$file]['name']) ;

        if ( ! $this->upload->do_upload($file))
        {
            return null;            
            /* Handling this error*/
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());

            if ($data['upload_data']['file_type'] == 'image/jpeg' || $data['upload_data']['file_type'] == 'image/png' || $data['upload_data']['file_type'] == 'image/gif') {
                $path = str_replace('./assets/images', '', $upload_path[$u_path]) . convert_accented_characters($data['upload_data']['file_name']);
            } else {
                $path = str_replace('./assets/files', '', $upload_path[$u_path]) . convert_accented_characters($data['upload_data']['file_name']);
            }
            $array = array(
                'user_id'       => ($museos == '' ? 66 : 83),
                'creation_date' => time(),
                'modified_date' => time(),
                'filemime'      => $data['upload_data']['file_type'],
                'path'          => $path,
                'file_size'     => $_FILES[$file]['size'],
                'file_name'     => $data['upload_data']['file_name']
            );

            if ($data['upload_data']['is_image'] == 1) {
                $array += ['height' => $data['upload_data']['image_height']];
                $array += ['width'  => $data['upload_data']['image_width']];
            }

            return $this->archivos_model->set($array, $museos);
        }
    }
    /*List of news and edit individual news*/

    public function noticias($news_id = null)
    {
        if ($news_id == null) {
            $data['news'] = $this->noticias_model->get(null, null, null, null, '', false);
            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/noticias/list', $data);
            $this->load->view('includes/footer_admin');
        } else {

            /* Edit news*/

            $data['news'] = $this->noticias_model->get($news_id);

            if (empty($data['news'])) {
                show_404();
            }

            $data['news']['description'] = strip_tags($data['news']['description'],'<a><em><strong><p><br><ul><li><table><tbody><tr><td><u><strike><h1><h2><h3><h4><h5><h6>');

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
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'titulo', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('errors', validation_errors('<li>', '</li>'));

            ($this->input->post('id') != null ? redirect(site_url('admin/noticias/'. $this->input->post('id')), 'refresh') :redirect(site_url('admin/noticias/new'), 'refresh'));
        }
        else
        {
            /* Upload image*/
            $image_id = $this->upload_file('noticia');

            /*Update news*/
            
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

            if (empty($data['exposition'])) {
                show_404();
            }

            $data['exposition']['description'] = strip_tags($data['exposition']['description'],'<a><em><strong><p><br><ul><li><table><tbody><tr><td><u><strike><h1><h2><h3><h4><h5><h6>');

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
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'titulo', 'required');
        $this->form_validation->set_rules('id_establecimiento', 'id_establecimiento', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('errors', validation_errors('<li>', '</li>'));

            ($this->input->post('id') != null ? redirect(site_url('admin/exposiciones/'. $this->input->post('id')), 'refresh') :redirect(site_url('admin/exposiciones/new'), 'refresh'));
        }
        else
        {
            /* Upload image*/
            $image_id = $this->upload_file('exposicion');

            /*Update exposition*/
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

            if (empty($data['collection'])) {
                show_404();
            }

            $data['collection']['description'] = strip_tags($data['collection']['description'],'<a><em><strong><p><br><ul><li><table><tbody><tr><td><u><strike><h1><h2><h3><h4><h5><h6>');

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
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'titulo', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('errors', validation_errors('<li>', '</li>'));

            ($this->input->post('id') != null ? redirect(site_url('admin/colecciones/'. $this->input->post('id')), 'refresh') :redirect(site_url('admin/colecciones/new'), 'refresh'));
        }
        else
        {
            /* Upload image*/
            $image_id = $this->upload_file('coleccion');

            /*Update collection*/

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

            if (empty($data['obra'])) {
                show_404();
            }

            $data['obra']['description'] = strip_tags($data['obra']['description'],'<a><em><strong><p><br><ul><li><table><tbody><tr><td><u><strike><h1><h2><h3><h4><h5><h6>');

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
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'titulo', 'required');
        $this->form_validation->set_rules('id_coleccion', 'id_coleccion', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('errors', validation_errors('<li>', '</li>'));

            ($this->input->post('id') != null ? redirect(site_url('admin/obras/'. $this->input->post('id')), 'refresh') :redirect(site_url('admin/obras/new'), 'refresh'));
        }
        else
        {

            /* Upload image*/
            $image_id = $this->upload_file('obra');

            /*Update obra*/

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

    /*List of contact and individual contact*/

    public function contactenos($id = null)
    {
        if ($id == null){

            $data['messages'] = $this->contacto_model->get();
            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/contactenos/list', $data);
            $this->load->view('includes/footer_admin');
        } else {
            $data['messages'] = $this->contacto_model->get($id);

            if (empty($data['messages'])) {
                show_404();
            }

            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/contactenos/view', $data);
            $this->load->view('includes/footer_admin');
        } 
    }

    /*List of diarys and edit individual diary*/

    public function agenda($diary_id = null)
    {
        if ($diary_id == null) {
            $data['diary'] = $this->agenda_model->get(null, null);
            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/agenda/list', $data);
            $this->load->view('includes/footer_admin');
        } else {

            /* Edit diary*/

            $data['diary'] = $this->agenda_model->get($diary_id);

            if (empty($data['diary'])) {
                show_404();
            }

            $data['diary']['description'] = strip_tags($data['diary']['description'],'<a><em><strong><p><br><ul><li><table><tbody><tr><td><u><strike><h1><h2><h3><h4><h5><h6>');

            $data['establishments'] = $this->establecimientos_model->get(null, null);

            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/agenda/edit_agenda', $data);
            $this->load->view('includes/footer_admin');
        }
    }

    public function nueva_agenda () 
    {
        $data['establishments'] = $this->establecimientos_model->get(null, null);
        $h_data['title'] = 'Admin | Fundación Museos Nacionales';
        $h_data['active'] = 'admin';

        $this->load->view('includes/header_admin',$h_data);
        $this->load->view('admin/agenda/new_agenda', $data);
        $this->load->view('includes/footer_admin');
    }

    public function set_agenda()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'titulo', 'required');
        $this->form_validation->set_rules('id_establecimiento', 'id_establecimiento', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('errors', validation_errors('<li>', '</li>'));

            ($this->input->post('id') != null ? redirect(site_url('admin/agenda/'. $this->input->post('id')), 'refresh') :redirect(site_url('admin/agenda/new'), 'refresh'));
        }
        else
        {

            /* Upload image*/
            $image_id = $this->upload_file('agenda');

            /*Update diary*/

            $status = $this->input->post('status');
            $status = (!isset($status)? 0 : 1);

            $array = array(
                'title'            => $this->input->post('titulo'),
                'description'      => $this->input->post('descripcion'),
                'establishment_id' => $this->input->post('id_establecimiento'),
                'modified_date'    => time(),
                'publication_date' => time(),
                'status'           => $status
            );

            if ($image_id != null) {

                $array += ['image_id' => $image_id];
            }

            $diary_id = $this->input->post('id');

            if ($diary_id == null) {

                $array += ['creation_date' => time()];
                $array += ['user_id' => 66];

                $this->agenda_model->set($array);
                redirect(site_url('admin/agenda/'), 'refresh');

            } else {
                $this->agenda_model->set($array, $this->input->post('id'));

                redirect(site_url('admin/agenda/'. $this->input->post('id')), 'refresh');
            }
        }
    }
    /* Handle delete permisology*/
    public function eliminar_agenda ($diary_id) 
    {
        $this->agenda_model->delete($diary_id);

        redirect(site_url('admin/agenda/'), 'refresh');
    }

    /*List of multimedias and edit individual multimedia*/

    public function multimedia($multimedia_id = null)
    {
        if ($multimedia_id == null) {
            $data['multimedia'] = $this->multimedia_model->get(null, null, null);
            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/multimedia/list', $data);
            $this->load->view('includes/footer_admin');
        } else {

            /* Edit multimedia*/

            $data['multimedia'] = $this->multimedia_model->get(null, $multimedia_id);

            if (empty($data['multimedia'])) {
                show_404();
            }

            $data['multimedia']['description'] = strip_tags($data['multimedia']['description'],'<a><em><strong><p><br><ul><li><table><tbody><tr><td><u><strike><h1><h2><h3><h4><h5><h6>');

            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/multimedia/edit_multimedia', $data);
            $this->load->view('includes/footer_admin');
        }
    }

    public function nueva_multimedia () 
    {
        $data['establishments'] = $this->establecimientos_model->get(null, null);
        $h_data['title'] = 'Admin | Fundación Museos Nacionales';
        $h_data['active'] = 'admin';

        $this->load->view('includes/header_admin',$h_data);
        $this->load->view('admin/multimedia/new_multimedia', $data);
        $this->load->view('includes/footer_admin');
    }

    public function set_multimedia()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'titulo', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('errors', validation_errors('<li>', '</li>'));

            ($this->input->post('id') != null ? redirect(site_url('admin/multimedia/'. $this->input->post('id')), 'refresh') :redirect(site_url('admin/multimedia/new'), 'refresh'));
        }
        else
        {

            /* Upload image*/
            $image_id = $this->upload_file('multimedia');

            /* Upload multimedia file*/
            $multimedia_file_id = $this->upload_file('multimedia_file', false);

            /*Update multimedia*/

            $status = $this->input->post('status');
            $status = (!isset($status)? 0 : 1);

            $array = array(
                'title'         => $this->input->post('titulo'),
                'description'   => $this->input->post('descripcion'),
                'modified_date' => time(),
                'type'          => ($this->input->post('tipo') == '0'? 52 : 54),
                'status'        => $status
            );

            if ($image_id != null) {

                $array += ['image_id' => $image_id];
            }
            if ($multimedia_file_id != null) {

                $array += ['multimedia_file_id' => $multimedia_file_id];
            }

            $multimedia_id = $this->input->post('id');

            if ($multimedia_id == null) {

                $array += ['creation_date' => time()];
                $array += ['user_id' => 66];

                $this->multimedia_model->set($array);
                redirect(site_url('admin/multimedia/'), 'refresh');

            } else {
                $this->multimedia_model->set($array, $this->input->post('id'));

                redirect(site_url('admin/multimedia/'. $this->input->post('id')), 'refresh');
            }
        }
    }
    /* Handle delete permisology*/
    public function eliminar_multimedia ($multimedia_id) 
    {
        $this->multimedia_model->delete($multimedia_id);

        redirect(site_url('admin/multimedia/'), 'refresh');
    }

    /*List of diarys and edit individual diary*/

    public function agenda_museos($diary_id = null)
    {
        if ($diary_id == null) {
            $data['diary'] = $this->agenda_model->get(null, null, null, null, '_museos');
            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/agenda_museos/list', $data);
            $this->load->view('includes/footer_admin');
        } else {

            /* Edit diary*/

            $data['diary'] = $this->agenda_model->get($diary_id, null, null, null, '_museos');

            if (empty($data['diary'])) {
                show_404();
            }

            $data['diary']['description'] = strip_tags($data['diary']['description'],'<a><em><strong><p><br><ul><li><table><tbody><tr><td><u><strike><h1><h2><h3><h4><h5><h6>');

            //$data['establishments'] = $this->establecimientos_model->get(null, null);

            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/agenda_museos/edit_agenda_museos', $data);
            $this->load->view('includes/footer_admin');
        }
    }

    public function set_agenda_museos()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'titulo', 'required');
        //$this->form_validation->set_rules('id_establecimiento', 'id_establecimiento', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('errors', validation_errors('<li>', '</li>'));

            redirect(site_url('admin/agenda-museos/'. $this->input->post('id')), 'refresh');
        }
        else
        {

            /* Upload image*/
            $image_id = $this->upload_file('agenda_museos', true, '_museos');

            /*Update diary*/

            $status = $this->input->post('status');
            $status = (!isset($status)? 0 : 1);

            $array = array(
                'title'            => $this->input->post('titulo'),
                'description'      => $this->input->post('descripcion'),
                'modified_date'    => time(),
                'publication_date' => time(),
                'status'           => $status
            );

            if ($image_id != null) {

                $array += ['image_id' => $image_id];
            }


            $this->agenda_model->set($array, $this->input->post('id'), '_museos');

            redirect(site_url('admin/agenda-museos/'. $this->input->post('id')), 'refresh');
            
        }
    }

    /*List of expositions and edit individual exposition*/

    public function exposiciones_museos($exposition_id = null)
    {
        if ($exposition_id == null) {
            $data['exposition'] = $this->exposiciones_model->get(null, null, null, null, null, '_museos');
            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/exposiciones_museos/list', $data);
            $this->load->view('includes/footer_admin');
        } else {

            /* Edit exposition*/

            $data['exposition'] = $this->exposiciones_model->get(null, $exposition_id, null, null, null, '_museos');

            if (empty($data['exposition'])) {
                show_404();
            }

            $data['exposition']['description'] = strip_tags($data['exposition']['description'],'<a><em><strong><p><br><ul><li><table><tbody><tr><td><u><strike><h1><h2><h3><h4><h5><h6>');

            //$data['establishments'] = $this->establecimientos_model->get(null, null);

            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/exposiciones_museos/edit_exposicion_museos', $data);
            $this->load->view('includes/footer_admin');
        }
    }


    public function set_exposicion_museos()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'titulo', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('errors', validation_errors('<li>', '</li>'));

            redirect(site_url('admin/exposiciones-museos/'. $this->input->post('id')), 'refresh');
        }
        else
        {

            /* Upload image*/
            $image_id = $this->upload_file('exposicion_museos', true, '_museos');

            /*Update exposition*/

            $status = $this->input->post('status');
            $status = (!isset($status)? 0 : 1);

            $actual = $this->input->post('actual');
            $actual = (!isset($actual)? 0 : 1);

            $array = array(
                'title'            => $this->input->post('titulo'),
                'description'      => $this->input->post('descripcion'),
                'exhibition_place' => $this->input->post('lugar_exhibicion'),
                'schedule'         => $this->input->post('horario'),
                'modified_date'    => time(),
                'actual'           => $actual,
                'status'           => $status
            );

            if ($image_id != null) {

                $array += ['image_id' => $image_id];
            }

            $this->exposiciones_model->set($array, $this->input->post('id'), '_museos');

            redirect(site_url('admin/exposiciones-museos/'. $this->input->post('id')), 'refresh');
            
        }
    }

    /*List of multimedia_museoss and edit individual multimedia_museos*/

    public function multimedia_museos($multimedia_id = null)
    {
        if ($multimedia_id == null) {
            $data['multimedia'] = $this->multimedia_model->get(null, null, null, null, null, '_museos');
            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/multimedia_museos/list', $data);
            $this->load->view('includes/footer_admin');
        } else {

            /* Edit multimedia_museos*/

            $data['multimedia'] = $this->multimedia_model->get(null, $multimedia_id, null, null, null, '_museos');

            if (empty($data['multimedia'])) {
                show_404();
            }

            $data['multimedia']['description'] = strip_tags($data['multimedia']['description'],'<a><em><strong><p><br><ul><li><table><tbody><tr><td><u><strike><h1><h2><h3><h4><h5><h6>');

            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/multimedia_museos/edit_multimedia_museos', $data);
            $this->load->view('includes/footer_admin');
        }
    }

    public function set_multimedia_museos()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'titulo', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('errors', validation_errors('<li>', '</li>'));

            redirect(site_url('admin/multimedia-museos/'. $this->input->post('id')), 'refresh');
        }
        else
        {
            /* Upload image*/
            $image_id = $this->upload_file('multimedia_museos', true, '_museos');

            /* Upload multimedia_museos file*/
            $multimedia_file_id = $this->upload_file('multimedia_file_museos', false, '_museos');

            /*Update multimedia_museos*/

            $status = $this->input->post('status');
            $status = (!isset($status)? 0 : 1);

            $array = array(
                'title'         => $this->input->post('titulo'),
                'description'   => $this->input->post('descripcion'),
                'modified_date' => time(),
                'type'          => ($this->input->post('tipo') == '0'? 52 : 54),
                'status'        => $status
            );

            if ($image_id != null) {

                $array += ['image_id' => $image_id];
            }
            if ($multimedia_file_id != null) {

                $array += ['multimedia_file_id' => $multimedia_file_id];
            }

            
            $this->multimedia_model->set($array, $this->input->post('id'), '_museos');

            redirect(site_url('admin/multimedia-museos/'. $this->input->post('id')), 'refresh');
            
        }
    }

    /*List of news and edit individual news*/

    public function noticias_museos($news_id = null)
    {
        if ($news_id == null) {
            $data['news'] = $this->noticias_model->get(null, null, null, null, '_museos', false);
            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/noticias_museos/list', $data);
            $this->load->view('includes/footer_admin');
        } else {

            /* Edit news*/

            $data['news'] = $this->noticias_model->get($news_id, null, null, null, '_museos');
 
            if (empty($data['news'])) {
                show_404();
            }

            $data['news']['description'] = strip_tags($data['news']['description'],'<a><em><strong><p><br><ul><li><table><tbody><tr><td><u><strike><h1><h2><h3><h4><h5><h6>');

            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/noticias_museos/edit_noticia_museos', $data);
            $this->load->view('includes/footer_admin');
        }
    }
    public function set_noticia_museos()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'titulo', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('errors', validation_errors('<li>', '</li>'));

            redirect(site_url('admin/noticias-museos/'. $this->input->post('id')), 'refresh');
        }
        else
        {

            /* Upload image*/
            $image_id = $this->upload_file('noticia_museos', true, '_museos');

            /*Update news*/

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

            $this->noticias_model->set($array, $this->input->post('id'), '_museos');

            redirect(site_url('admin/noticias-museos/'. $this->input->post('id')), 'refresh');
            
        }
    }

    /*List of news and add individual fechas agenda*/

    public function fechas_agenda($diary_id)
    {

        $data['diary_dates'] = $this->agenda_model->get_fechas_agenda($diary_id);
        $data['diary_id'] = $diary_id;

        $h_data['title'] = 'Admin | Fundación Museos Nacionales';
        $h_data['active'] = 'admin';

        $this->load->view('includes/header_admin',$h_data);
        $this->load->view('admin/agenda/fechas_agenda', $data);
        $this->load->view('includes/footer_admin');
        
    }

    public function set_fechas_agenda()
    {        

        $this->load->library('form_validation');
        $this->form_validation->set_rules('diary_date', 'fecha de agenda', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('errors', validation_errors('<li>', '</li>'));

            redirect(site_url('admin/fechas-agenda/'. $this->input->post('id')), 'refresh');
        }
        else
        {
            /*Update diary date*/
            $date = str_replace("T"," ",$this->input->post('diary_date')) . ':00';

            $array = array(
                'date'     => $date,
                'diary_id' => $this->input->post('id')
            );

            $this->agenda_model->set_fechas_agenda($array);
            redirect(site_url('admin/fechas-agenda/' . $this->input->post('id')), 'refresh');
        }
    }

    /* Handle delete permisology */
    public function eliminar_fechas_agenda ($diary_date_id) 
    {
        $diary_id = $this->input->post('id');

        $this->agenda_model->delete_fechas_agenda($diary_date_id);

        redirect(site_url('admin/fechas-agenda/' . $diary_id), 'refresh');
    }


    public function fechas_agenda_museos($diary_id)
    {

        $data['diary_dates'] = $this->agenda_model->get_fechas_agenda($diary_id, '_museos');
        $data['diary_id'] = $diary_id;

        $h_data['title'] = 'Admin | Fundación Museos Nacionales';
        $h_data['active'] = 'admin';

        $this->load->view('includes/header_admin',$h_data);
        $this->load->view('admin/agenda_museos/fechas_agenda_museos', $data);
        $this->load->view('includes/footer_admin');
    }

    public function listar_carrusel ($type, $element_id)
    {

        $data['carousel'] = $this->carrusel_model->get($element_id, $type);
        $data['element_id'] = $element_id;
        $data['type'] = $type;

        $h_data['title'] = 'Admin | Fundación Museos Nacionales';
        $h_data['active'] = 'admin';

        $this->load->view('includes/header_admin',$h_data);
        $this->load->view('admin/carrusel/list', $data);
        $this->load->view('includes/footer_admin');
    }

    public function carrusel ($carousel_id)
    {
        $data['carousel'] = $this->carrusel_model->get(null, null, $carousel_id);

        $h_data['title'] = 'Admin | Fundación Museos Nacionales';
        $h_data['active'] = 'admin';

        $this->load->view('includes/header_admin',$h_data);
        $this->load->view('admin/carrusel/edit_carrusel', $data);
        $this->load->view('includes/footer_admin');
        
    }

    public function nuevo_carrusel ($type, $element_id) 
    {
        $h_data['title'] = 'Admin | Fundación Museos Nacionales';
        $h_data['active'] = 'admin';
        $data['element_id'] = $element_id;
        $data['type'] = $type;

        $this->load->view('includes/header_admin',$h_data);
        $this->load->view('admin/carrusel/new_carrusel', $data);
        $this->load->view('includes/footer_admin');
    }

    public function set_carrusel()
    {        
        //$this->load->library('form_validation');

        //if ($this->form_validation->run() == FALSE)
        if (empty($_FILES['userfile']['name']))
        {
            //$this->session->set_flashdata('errors', validation_errors('<li>', '</li>'));

            ($this->input->post('id') != null ? redirect(site_url('admin/carrusel/'. $this->input->post('id')), 'refresh') :redirect(site_url('admin/carrusel/' . $this->input->post('tipo') . '/' . $this->input->post('elemento_id') .'/new'), 'refresh'));
        }
        else
        {
            /* Upload image*/
            $image_id = $this->upload_file('carrusel_' . $this->input->post('tipo'));

            $array = array(
                'title'        => $this->input->post('titulo'),
                'description'  => $this->input->post('descripcion'),
                'url'          => $this->input->post('link'),
                'element_id'   => $this->input->post('elemento_id'),
                'type'         => $this->input->post('tipo')
            );

            if ($image_id != null) {

                $array += ['image_id' => $image_id];
            }

            $carousel_id = $this->input->post('id');

            if ($carousel_id == null) {

                $this->carrusel_model->set($array);
                redirect(site_url('admin/carrusel/' . $this->input->post('tipo') . '/' . $this->input->post('elemento_id')), 'refresh');

            } else {
                $this->carrusel_model->set($array, $this->input->post('id'));

                redirect(site_url('admin/carrusel/'. $this->input->post('id')), 'refresh');
            }
        }
    }

    /* Handle delete permisology */
    public function eliminar_carrusel ($carousel_id) 
    {

        $this->carrusel_model->delete($carousel_id);

        redirect(site_url('admin/carrusel/' . $this->input->post('tipo') . '/' . $this->input->post('elemento_id')), 'refresh');
    }

    public function listar_carrusel_museos ($type, $element_id)
    {

        $data['carousel'] = $this->carrusel_model->get($element_id, $type, null, '_museos');
        $data['element_id'] = $element_id;
        $data['type'] = $type;

        $h_data['title'] = 'Admin | Fundación Museos Nacionales';
        $h_data['active'] = 'admin';

        $this->load->view('includes/header_admin',$h_data);
        $this->load->view('admin/carrusel_museos/list', $data);
        $this->load->view('includes/footer_admin');
    }

    public function carrusel_museos ($carousel_id)
    {
        $data['carousel'] = $this->carrusel_model->get(null, null, $carousel_id, '_museos');

        $h_data['title'] = 'Admin | Fundación Museos Nacionales';
        $h_data['active'] = 'admin';

        $this->load->view('includes/header_admin',$h_data);
        $this->load->view('admin/carrusel_museos/edit_carrusel_museos', $data);
        $this->load->view('includes/footer_admin');
        
    }

    public function set_carrusel_museos()
    {        
        //$this->load->library('form_validation');

        //if ($this->form_validation->run() == FALSE)
        if (empty($_FILES['userfile']['name']))
        {
            //$this->session->set_flashdata('errors', validation_errors('<li>', '</li>'));

            ($this->input->post('id') != null ? redirect(site_url('admin/carrusel-museos/'. $this->input->post('id')), 'refresh') :redirect(site_url('admin/carrusel-museos/' . $this->input->post('tipo') . '/' . $this->input->post('elemento_id') .'/new'), 'refresh'));
        }
        else
        {
            /* Upload image*/
            $image_id = $this->upload_file('carrusel_' . $this->input->post('tipo') . '_museos', true, '_museos');

            $array = array(
                'title'        => $this->input->post('titulo'),
                'description'  => $this->input->post('descripcion'),
                'url'          => $this->input->post('link'),
                'element_id'   => $this->input->post('elemento_id'),
                'type'         => $this->input->post('tipo')
            );

            if ($image_id != null) {

                $array += ['image_id' => $image_id];
            }
            
            $this->carrusel_model->set($array, $this->input->post('id'));

            redirect(site_url('admin/carrusel-museos/'. $this->input->post('id')), 'refresh');
            
        }
    }

    /*List of collections and edit individual collection*/

    public function colecciones_museos($collection_id = null)
    {
        if ($collection_id == null) {
            $data['collection'] = $this->colecciones_model->get(null, null, '_museos');
            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/colecciones_museos/list', $data);
            $this->load->view('includes/footer_admin');
        } else {

            /* Edit collection*/

            $data['collection'] = $this->colecciones_model->get($collection_id, null, '_museos');

            if (empty($data['collection'])) {
                show_404();
            }

            $data['collection']['description'] = strip_tags($data['collection']['description'],'<a><em><strong><p><br><ul><li><table><tbody><tr><td><u><strike><h1><h2><h3><h4><h5><h6>');

            $h_data['title'] = 'Admin | Fundación Museos Nacionales';
            $h_data['active'] = 'admin';

            $this->load->view('includes/header_admin',$h_data);
            $this->load->view('admin/colecciones_museos/edit_coleccion', $data);
            $this->load->view('includes/footer_admin');
        }
    }

    public function set_coleccion_museos()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'titulo', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('errors', validation_errors('<li>', '</li>'));

            ($this->input->post('id') != null ? redirect(site_url('admin/colecciones-museos/'. $this->input->post('id')), 'refresh') :redirect(site_url('admin/colecciones-museos/new'), 'refresh'));
        }
        else
        {
            /* Upload image*/
            $image_id = $this->upload_file('coleccion_museos', true, '_museos');

            /*Update collection*/

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

            
            $this->colecciones_model->set($array, $this->input->post('id'));

            redirect(site_url('admin/colecciones-museos/'. $this->input->post('id')), 'refresh');
            
        }
    }

    /*List of news and add individual fechas agenda*/

    public function galeria_fotos($news_id)
    {
        $data['photo_gallery'] = $this->noticias_model->get_galeria_fotos($news_id);
        $data['news_id'] = $news_id;

        $h_data['title'] = 'Admin | Fundación Museos Nacionales';
        $h_data['active'] = 'admin';

        $this->load->view('includes/header_admin',$h_data);
        $this->load->view('admin/noticias/galeria_fotos', $data);
        $this->load->view('includes/footer_admin');
        
    }

     public function set_galeria_fotos()
    {        
        //$this->load->library('form_validation');

        //if ($this->form_validation->run() == FALSE)
        if (empty($_FILES['userfile']['name']))
        {
            //$this->session->set_flashdata('errors', validation_errors('<li>', '</li>'));

            redirect(site_url('admin/galeria-fotos/'. $this->input->post('noticia_id')), 'refresh');
        }
        else
        {
            /* Upload image*/
            $image_id = $this->upload_file('galeria');

            $array = array(
                'news_id'  => $this->input->post('noticia_id'),
                'image_id' => $image_id
            );
            
            $this->noticias_model->set_galeria_fotos($array);

            redirect(site_url('admin/galeria-fotos/'. $this->input->post('noticia_id')), 'refresh');
            
        }
    }

    /* Handle delete permisology */
    public function eliminar_galeria_fotos ($photo_gallery_id) 
    {
        $news_id = $this->input->post('noticia_id');

        $this->noticias_model->delete_galeria_fotos($photo_gallery_id);

        redirect(site_url('admin/galeria-fotos/' . $news_id), 'refresh');
    }

    /*List of news and add individual fechas agenda*/

    public function galeria_fotos_museos($news_id)
    {
        $data['photo_gallery'] = $this->noticias_model->get_galeria_fotos($news_id, '_museos');
        $data['news_id'] = $news_id;

        $h_data['title'] = 'Admin | Fundación Museos Nacionales';
        $h_data['active'] = 'admin';

        $this->load->view('includes/header_admin',$h_data);
        $this->load->view('admin/noticias/galeria_fotos', $data);
        $this->load->view('includes/footer_admin');
        
    }
}
