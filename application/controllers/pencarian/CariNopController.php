<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CariNopController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('dashboard/CariNopModel', 'CariModel');
        $this->load->model('PublicModel');
    }

    public function index()
    {
        $data['view'] = 'pencarian/cariNop';
        $this->load->view('template/layout', $data);
    }

    public function get()
    {
        // pastikan request berasal dari DataTables
        if (!$this->input->is_ajax_request()) {
            show_error('No direct script access allowed', 403);
        }

        $list = $this->CariModel->get_all_data();
        $data = [];
        $no   = $this->input->post('start'); // lebih aman pakai input->post()

        foreach ($list as $field) {
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $field->nop;
            $row[] = $field->subjek_pajak_id;
            $row[] = $field->nm_wp;
            $row[] = ucwords(strtolower($field->alamat_wp));

            // Tombol detail untuk modal
            $row[] = '
                <a href="#"
                   class="btn btn-sm btn-info btn-detail"
                   data-toggle="modal"
                   data-target="#detailModal"
                   data-nop="' . $field->nop . '"
                   data-nama="' . htmlspecialchars($field->nm_wp, ENT_QUOTES, "UTF-8") . '"
                   data-alamat="' . htmlspecialchars(ucwords(strtolower($field->alamat_wp)), ENT_QUOTES, "UTF-8") . '"
                   data-luas_tanah="' . $field->total_luas_bumi . '"
                   data-luas_bangunan="' . $field->total_luas_bng . '">
                   <i class="fa fa-dedent" style="font-size:14px;"></i>
                </a>
            ';

            $data[] = $row;
        }

        $output = [
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => $this->CariModel->count_all_data(),
            "recordsFiltered" => $this->CariModel->count_filtered_data(),
            "data"            => $data,
        ];

        echo json_encode($output);
    }
}
