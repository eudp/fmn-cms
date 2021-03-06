<?php
class Multimedia_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    /**
     * Recupera registros de este modelo.
     *
     * @param boolean $audio, indica si se quiere un audio o no.
     * @param string|int $entry, id o slug del elemento.
     * @param int $status, estatus del elemento.
     * @param int $limit, cantidad de elementos que se quiren recuerar.
     * @param string $search, cadena de caracteres para hacer las busqueda en la bd.
     * @param string $museos, su valor puede ser '_museos' o '', dependiendo cual tabla se quiere mostrar.
     * @param boolean $slug, indica si $entry es id o un slug.
    */


    public function get($audio = false, $entry = null, $status = 1, $limit = null, $search = null, $museos = '', $slug = false)
    {
        if ($entry == null)
        {

            $museums =  ($museos != '' ? ', m.museums': '');
            $w_user_id = ($museos != '' ? 'u.user_id = m.user_id': 'u.id = m.user_id');

            $this->db->select('u.first_name, m.slug, m.title, a.path, m.multimedia_id, m.creation_date, m.modified_date, m.status' . $museums);
            $this->db->from('multimedia' . $museos . ' as m');
            $this->db->join('archivos' . $museos . ' as a', 'a.file_id = m.image_id', 'left');
            $this->db->join('usuarios' . $museos . ' as u', $w_user_id);

            if ($audio) {
                if ($museos == ''){
                    $this->db->where('type', '52');
                }
                else {
                    //Aún sin type para audios para la base de datos de museos
                }
            }
            if ($status != null) {
                $this->db->where('status' , $status);
            }
            if ($search != null){
                $this->db->group_start();
                $this->db->like('LOWER(description)', strtolower($search));
                $this->db->or_like('LOWER(title)', strtolower($search));
                $this->db->group_end();
            }
            if ($limit != null){
                $this->db->limit($limit);
            }

            $this->db->order_by('m.creation_date', 'DESC');
            $query = $this->db->get();

            return $query->result_array();
        }

        $this->db->select('m.title, m.description, a.path, a.file_name, f.path as multimedia_path, f.file_name as multimedia_name, m.status, m.multimedia_id, m.type, m.slug');
        $this->db->from('multimedia' . $museos . ' as m');
        $this->db->join('archivos' . $museos . ' as a', 'a.file_id = m.image_id', 'left');
        $this->db->join('archivos' . $museos . ' as f', 'f.file_id = m.multimedia_file_id', 'left');

        if (!$slug){
            $this->db->where('multimedia_id', $entry);
        } else {
            $this->db->where('slug', $entry);
        }
        
        $query = $this->db->get();

        return $query->row_array();
    }

    public function set($array, $multimedia_id = null, $museos = '')
    {
        if ($multimedia_id != null) {
            $this->db->set($array);
            $this->db->where('multimedia_id', $multimedia_id);
            $this->db->update('multimedia' . $museos);
        }
        else {
            $this->db->insert('multimedia' . $museos, $array);

            return $this->db->insert_id();
        }  
    }

    public function delete($multimedia_id)
    {
        $this->db->delete('multimedia', array('multimedia_id' => $multimedia_id));   
    }

    public function set_slug($multimedia_id, $slug, $museos = '')
    {
        $this->db->set('slug', $slug);
        $this->db->where('multimedia_id', $multimedia_id);
        return $this->db->update('multimedia' . $museos);
    }

    public function check_slug($slug, $museos = '')
    {
        $this->db->select('multimedia_id');
        $this->db->from('multimedia' . $museos);
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        return $query->row_array();
    }

}