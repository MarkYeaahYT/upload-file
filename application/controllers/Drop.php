<?php
class Drop extends CI_Controller{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('drop_model');
        $this->load->database();
        $this->load->helper("cookie");
    }

    public function index()
    {
        # code...
        $this->load->view("dashboard");
    }

    public function save()
    {
        # code...
        $data = $this->drop_model->save();
        echo json_encode($data);
    }

    public function show()
    {
        # code...
        $data = $this->drop_model->show();
        echo json_encode($data);
    }

    public function upload()
    {
        # code...
        $data = $this->drop_model->upload();
        echo json_encode($data);
    }

    public function debug()
    {
        $config = $this->config->item('allowed_types');

        dd($config);

    }

}

?>