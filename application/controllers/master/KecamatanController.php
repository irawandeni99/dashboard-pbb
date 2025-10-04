<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KecamatanController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('dashboard/KecamatanModel', 'KecamatanModel');
        $this->load->model('PublicModel');
    }

    public function index()
    {
        $data['view'] = 'master/kecamatan/index';
        $this->load->view('template/layout', $data);
    }


    public function add(){
        $data['cdata'] 			= $this->KecamatanModel->getData();
        // $data['cnext'] 			= $this->KecamatanModel->nextid();
        $data['view'] 			= 'master/kecamatan/addView';
        $this->load->view('template/layout', $data);
    }



    public function get()
    {

        $list = $this->KecamatanModel->get_all_data();
        $data = [];
        $no   = $this->input->post('start'); 

        foreach ($list as $field) {
            $ckode=$field->kd_kecamatan;
			$link=base_url('kecamatan-edit/'.$ckode);
			$dellink=base_url('kecamatan-delete');
            $no++;
            $row = [];
            $row[] = $no;

            if (!empty($field->foto)) {
                $row[] = '<img src="data:image/jpeg;base64,' . $field->foto . '" 
                            style="width:100px; height:100px; object-fit:cover;" />';
            } else {
                $row[] = '<img src="' . base_url('assets/img/no-image.png') . '" 
                            style="width:100px; height:100px; object-fit:cover;" />';
            }
            $row[] = $field->kd_kecamatan;
            $row[] = $field->nm_kecamatan;
            $row[] = ucwords(strtolower($field->alamat));
            $row[] = $field->telp;
            

			$button = '<button style=" background-color: #33b5e5; color: #F6F6F6; " data-toggle="dropdown"  id="btnGroupDrop1" class="btn btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-dedent" style="font-size:14px;"></i></i>';

            $btnedit = '<a href="'.$link.'" 
                    style="background-color: #948979; color: #F6F6F6;" 
                    class="list-group-item list-group-item-action edit-data"  
                    data-kode="'.$field->kd_kecamatan.'" 
                    data-nama="'.$field->nm_kecamatan.'">
                    <i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:18px;color:#A1E3F9"></i> Edit Kecamatan
                </a>';

            
            $btndel = '<button type="button" 
                class="list-group-item list-group-item-action delete-data" 
                style="background-color: #948979; color: #F6F6F6;"
                data-kode="'.$field->kd_kecamatan.'" 
                data-nama="'.$field->nm_kecamatan.'">
                <i class="fa fa-trash" aria-hidden="true" style="font-size:20px;color:#E78895"></i> Hapus Kecamatan
            </button>';

            $subbutton=$btnedit.$btndel;


				$aksi='<center>
						<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
							'.$button.'
							</button><ul class="dropdown-menu" >
							<div style="margin-left: -90px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
								  
								  '.$subbutton.'
								
							</div> 
						  </div>
						
					</center>';


           $row[] = '
					'.$aksi.'
	            	</td>    	
		 	    	<script>$(document).ready(function() {$("[data-toggle=\'tooltip\']").tooltip(); });</script>
		 	    	';


            $data[] = $row;
        }



        $output = [
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => $this->KecamatanModel->count_all_data(),
            "recordsFiltered" => $this->KecamatanModel->count_filtered_data(),
            "data"            => $data,
        ];

        echo json_encode($output);
    }


		public function edit($ckode=''){
			$data['ckode'] 			= $ckode;

            $data['cdata'] 			= $this->KecamatanModel->getDataRow($ckode);
			$data['cnama']	 		= $this->PublicModel->get_nama($ckode,'nm_kecamatan','ms_kecamatan','kd_kecamatan');	

			$data['view'] 			= 'master/kecamatan/editView';

			$this->load->view('template/layout', $data);
		}


        public function insert(){  		
			$data = array(
						'kd_kecamatan' 		=> $this->input->post('kd_kecamatan'),
						'nm_kecamatan' 		=> $this->input->post('nm_kecamatan'),
						'telp' 				=> $this->input->post('telp'),
						'alamat' 			=> $this->input->post('alamat'),
                        'foto'              => $this->input->post('foto'),
                        'created_at'        => date('Y-m-d H:i:s'),
                        'created_by'       => $this->session->userdata('name')
						
					);

					$result = $this->KecamatanModel->add_data($data);
					
				if($result){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 
				

	    public function update(){

			$where = array('kd_kecamatan' => $this->input->post('kd_kecamatan'));
            $data = array(
                'nm_kecamatan' => $this->input->post('nm_kecamatan'),
                'telp' => $this->input->post('telp'),
                'alamat' => $this->input->post('alamat'),
                'foto' => $this->input->post('foto'),
                'modify_at' => date('Y-m-d H:i:s'),
                'modify_by' => $this->session->userdata('name')
                
            );
					
            $data = $this->security->xss_clean($data);
            $result = $this->KecamatanModel->update_data($data,$where);
            if($result){
                $dataRet['pesan'] = "Data Berhasil DiUpdate!";
            }
            echo json_encode($dataRet);
			
			
		}

        
       public function delete()
            {
                
                // print('hapus');
                $kode = $this->input->post('kode', true);

                if (empty($kode)) {
                    echo json_encode($msg=0);
                    return;
                }

                $where  = ['kd_kecamatan' => $kode];
                $result = $this->KecamatanModel->delete_data($where);

                echo json_encode($msg = $result > 0 ? 1 : 0);
            }

				
}
