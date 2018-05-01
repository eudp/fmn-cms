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

        $this->load->helper('domain_museum');
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
    	$this->load->library('form_validation');
    	$this->form_validation->set_rules('titulo', 'titulo', 'required');
    	if ($this->form_validation->run() == FALSE)
        {
            $this->index();
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

    public function upload_file ($u_path, $featured_image = true)
    {
        // Select input field
        $file = 'userfile';
        $config['allowed_types'] = 'jpg|gif|jpeg|png';
        if (!$featured_image) {
            $file = 'multimediafile';
            $config['allowed_types'] = 'mp3|pdf';
        }

        $upload_path = [
            "museo"                  => "./assets/images/museos/",
            "instituto"              => "./assets/images/institutos/",
            "noticia"                => "./assets/images/noticias/",
            "exposicion"             => "./assets/images/exposiciones/",
            "coleccion"              => "./assets/images/colecciones/",
            "obra"                   => "./assets/images/obras/",
            "agenda"                 => "./assets/images/agenda/",
            "multimedia"             => "./assets/images/multimedias/",
            "multimedia_file"        => "./assets/files/multimedias/",
            "agenda_museos"          => "./assets/images/agenda_museos/",
            "exposicion_museos"      => "./assets/images/exposicion_museos/",
            "multimedia_museos"      => "./assets/images/multimedias_museos/",
            "multimedia_file_museos" => "./assets/files/multimedias_museos/",
            "noticia_museos"         => "./assets/images/noticias_museos/"
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
                'user_id'       => 66,
                'creation_date' => time(),
                'modified_date' => time(),
                'filemime'      => $data['upload_data']['file_type'],
                'path'          => $path,
                'file_size'     => $_FILES[$file]['size'],
                'file_name'     => $data['upload_data']['file_name']
            );

            return $this->archivos_model->set($array);
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
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'titulo', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->index();
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
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'titulo', 'required');
        $this->form_validation->set_rules('id_establecimiento', 'id_establecimiento', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->index();
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


        

        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'titulo', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->index();
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
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'titulo', 'required');
        $this->form_validation->set_rules('id_coleccion', 'id_coleccion', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->index();
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
            $data['diary']['description'] = strip_tags($data['diary']['description'],'<a><em><strong><p><br>');

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
            $this->index();
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
            $data['multimedia']['description'] = strip_tags($data['multimedia']['description'],'<a><em><strong><p><br>');

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
            $this->index();
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
            $data['diary']['description'] = strip_tags($data['diary']['description'],'<a><em><strong><p><br>');

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
            $this->index();
        }
        else
        {

            /* Upload image*/
            $image_id = $this->upload_file('agenda_museos');

            /*Update diary*/

            $status = $this->input->post('status');
            $status = (!isset($status)? 0 : 1);

            $array = array(
                'title'            => $this->input->post('titulo'),
                'description'      => $this->input->post('descripcion'),
                //'establishment_id' => $this->input->post('id_establecimiento'),
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

                $this->agenda_model->set($array, null, '_museos');
                redirect(site_url('admin/agenda_museos/'), 'refresh');

            } else {
                $this->agenda_model->set($array, $this->input->post('id'), '_museos');

                redirect(site_url('admin/agenda_museos/'. $this->input->post('id')), 'refresh');
            }
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
            $data['exposition']['description'] = strip_tags($data['exposition']['description'],'<a><em><strong><p><br>');

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
            $this->index();
        }
        else
        {

            /* Upload image*/
            $image_id = $this->upload_file('exposicion_museos');

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

            $exposition_id = $this->input->post('id');

            if ($exposition_id == null) {

                $array += ['creation_date' => time()];
                $array += ['user_id' => 66];

                $this->exposiciones_->set($array, null, '_museos');
                redirect(site_url('admin/exposiciones_museos/'), 'refresh');

            } else {
                $this->exposiciones_model->set($array, $this->input->post('id'), '_museos');

                redirect(site_url('admin/exposiciones_museos/'. $this->input->post('id')), 'refresh');
            }
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
            $data['multimedia']['description'] = strip_tags($data['multimedia']['description'],'<a><em><strong><p><br>');

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
            $this->index();
        }
        else
        {
            /* Upload image*/
            $image_id = $this->upload_file('multimedia_museos');

            /* Upload multimedia_museos file*/
            $multimedia_file_id = $this->upload_file('multimedia_file_museos', false);

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

            $multimedia_id = $this->input->post('id');

            if ($multimedia_id == null) {

                $array += ['creation_date' => time()];
                $array += ['user_id' => 66];

                $this->multimedia_model->set($array, null, '_museos');
                redirect(site_url('admin/multimedia_museos/'), 'refresh');

            } else {
                $this->multimedia_model->set($array, $this->input->post('id'), '_museos');

                redirect(site_url('admin/multimedia_museos/'. $this->input->post('id')), 'refresh');
            }
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
            $data['news']['description'] = strip_tags($data['news']['description'],'<a><em><strong><p><br>');

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
            $this->index();
        }
        else
        {

            /* Upload image*/
            $image_id = $this->upload_file('noticia_museos');

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

                $this->noticias_model->set($array, null, '_museos');
                redirect(site_url('admin/noticias_museos/'), 'refresh');

            } else {
                $this->noticias_model->set($array, $this->input->post('id'), '_museos');

                redirect(site_url('admin/noticias_museos/'. $this->input->post('id')), 'refresh');
            }
        }
    }
}
