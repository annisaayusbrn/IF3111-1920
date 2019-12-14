<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Control extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("control_model");
        $this->load->helper(array('form', 'url'));
    }

    // menampilkan semua data ================================================
    public function index()
    {
        $data['laporan'] = $this->control_model->read();
        $this->load->view("pages/tampilan_utama", $data);
    }

    // menampilkan data yang dipilih =========================================
    public function lihat($id)
    {
        $data['laporan'] = $this->control_model->view_by($id);
        $this->load->view('pages/tampilan_detail', $data);
    }

    // menambahkan data ======================================================
    public function tambah()
    {
        $upload = $this->control_model->upload();
        $this->control_model->create($upload);

        redirect('control');
    }

    // mengubah data ========================================================
    public function ubah($id)
    {
        $data['laporan'] = $this->control_model->view_by($id);
        $this->load->view('pages/tampilan_ubah', $data);

        if ($this->input->post('submit')) {
            $upload = $this->control_model->upload();
            $this->control_model->update($upload, $id);
            redirect('control');
        }
    }

    // menghapus data yang dipilih ==========================================
    public function hapus($id)
    {
        $this->control_model->delete($id);
        redirect('control');
    }

    // load halaman tampilan_lapor ==========================================
    public function tampilan_lapor()
    {
        $this->load->view("pages/tampilan_lapor");
    }

    // load halaman tampilan_detail =========================================
    public function tampilan_detail()
    {
        $this->load->view("pages/tampilan_detail");
    }

    // load halaman tampilan_ubah =========================================
    public function tampilan_ubah()
    {
        $this->load->view("pages/tampilan_ubah");
    }
}
