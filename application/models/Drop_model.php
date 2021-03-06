<?php
class Drop_model extends CI_Model{

    public function save()
    {
        # code...
        $id = $this->input->post("id");
        $note = $this->input->post("note");
        $os = $this->input->post("os");

        $this->db->where("id", $id);
        $this->db->set("note", $note);
        $this->db->set("os", $os);
        $query = $this->db->update("userupload");
        return $query;
    }

    public function show()
    {
        # code...
        $this->db->order_by("id", "DESC");
        $query = $this->db->get('userupload');

        $no = 0;
        foreach($query->result() as $row){
            $no++;
            $row->no = $no;
        }

        return $query->result();
    }

    public function upload()
    {
        /**
         * Add hash code 
         * and save into db then save into cookie
         * for setting note
         */
        # code..
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = $this->config->item('allowed_types');
        $config['max_size'] = 0; // 0 is not set

        if(!is_dir($config['upload_path'])){
            mkdir($config['upload_path'], 0777, true);
        }

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('file')){
            $data = array('error' => $this->upload->display_errors());
            return $data;
        }else{
            $data = $this->upload->data();
            $this->db->set('date', 'NOW()' ,FALSE);
            $this->db->set('filename', $data['file_name']);
            $this->db->set("ip", $_SERVER['REMOTE_ADDR']);

            $this->db->insert('userupload');

            /**
             * Set id to cookie of current upload file 
             */
            $this->db->where("filename", $data['file_name']);
            $query = $this->db->get("userupload");
            $query = $query->result();
            $cookie = array(
                "name" => "MarkYeaahYT",
                "value" => $query[0]->id,
                "expire" => "9000",
                "path" => "/",
            );
            $this->input->set_cookie($cookie);
            return $data;
        }

    }

}
?>