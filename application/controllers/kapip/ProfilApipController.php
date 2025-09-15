<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	 * 
	 */
	class ProfilApipController extends CI_Controller
	{
		
		public function __construct(){
			parent::__construct();
			date_default_timezone_set('Asia/Jakarta');
			$this->load->model('kapip/ProfilApipModel', 'ApipModel');
			$this->load->model('PublicModel');
		}

		public function data_profil_apip()
		{
			$data['view'] = 'kapip/profil/KapipProfil';
			$this->load->view('template/layout', $data);
		}


		public function get() {
			
			$is_admin = $this->session->userdata('is_admin');


			$list = $this->ApipModel->get_all_apip($daerah);

	        $data = array();
	        $no = $_POST['start'];

	        foreach ($list as $field) {
	        	
				$ckode=$field->kd_apip;
				$ctahun=$field->tahun; 
				$link=base_url('kapip-dataumum-profil-apip/triw/'.$ctahun.'/'.$ckode);
			   
	            $no++;
	            $row = array();
	            if($ins != $field->kd_apip){
	            	$row[] = $no;
	            }else{
	            	$no--;
	            	$row[] = "";
	            }
				
				$ins = $field->kd_apip;

	            if($instansi != $field->nm_apip){
					
				
	            	$row[] = $field->nm_apip;
	            }else{
	            	$row[] = "";
	            }
				
				
				
				if($tahun != $field->tahun){
	            	$row[] = $field->tahun;
	            }else{
	            	$row[] = "";
	            }	
			
	            $row[] = '
					<a href="'.$link.'" class="btn btn-info btn-flat btn-xs edit" data-thn="'.$field->tahun.'" data-nama="'.$field->nama.'"><i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" title="Detail"></i></a>
	            	</td>    	
		 	    	<script>$(document).ready(function() {$("[data-toggle=\'tooltip\']").tooltip(); });</script>
		 	    	';

	            $data[] = $row;
								
	        }
	 
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->ApipModel->count_all_apip($daerah),
	            "recordsFiltered" => $this->ApipModel->count_filtered_apip($daerah),
	            "data" => $data,
	        );
			
			
			
	        echo json_encode($output);
		}
		

		public function add(){
			$data['apip'] 			= $this->ApipModel->getApip();
			$data['instansi'] 		= $this->ApipModel->getInstansi();
			//$data['audit'] 			= $this->db->get('ms_jenis_audit')->result_array();
			$data['view'] 			= 'kapip/profil/addApipView';
			$this->load->view('template/layout', $data);
		}


		public function map1($cthn='',$ckode='',$ctriw=''){
			
			$data['apip'] 			= $this->ApipModel->getApip();
			$data['instansi'] 		= $this->ApipModel->getInstansi();
			
			//$data['view'] 			= 'kapip/profil/addMaView';
			$data = $this->ApipModel->viewMap1($cthn,$ckode,$ctriw);
			echo $data;
		}


		public function triw(){
			$cthn = $this->session->userdata('year_selected');
			$ckode = $this->session->userdata('id_instansi');
			
			$nmapip	 				= $this->PublicModel->get_nama($ckode,'nm_apip','ms_apip','kd_apip');		
			$data['kode'] 			= $ckode;
			$data['instansi'] 		= $nmapip;
			$data['tahun'] 			= $cthn;
			$data['profil'] 		= $this->ApipModel->FilterProfil($cthn,$ckode);			
			$data['view'] 			= 'kapip/profil/addProfilView';
			$this->load->view('template/layout', $data);
		}




		public function get_profil1($cthn='',$ckode='',$ctriw=''){

			$data = $this->ApipModel->viewProfil1($cthn,$ckode,$ctriw);
			echo $data;
			
			
		}


		public function edit_profil1($cthn='',$ckode='',$ctriw='',$cid=''){

			$data = $this->ApipModel->viewEProfil1($cthn,$ckode,$ctriw,$cid);
			echo $data;
			
			
		}



		public function edit_profil2($cthn='',$ckode='',$ctriw='',$cid=''){

			$data = $this->ApipModel->viewEProfil2($cthn,$ckode,$ctriw,$cid);
			echo $data;
			
			
		}



		public function edit_profil5($cthn='',$ckode='',$ctriw='',$cid=''){

			$data = $this->ApipModel->viewEProfil5($cthn,$ckode,$ctriw,$cid);
			echo $data;
			
			
		}



		public function edit_profil6($cthn='',$ckode='',$ctriw='',$cid=''){
			$data = $this->ApipModel->viewEProfil6($cthn,$ckode,$ctriw,$cid);
			echo $data;			
		}		
		
		
		public function edit_profil7($cthn='',$ckode='',$ctriw='',$ckd1='',$ckd2='',$cjns=''){
			$data = $this->ApipModel->viewEProfil7($cthn,$ckode,$ctriw,$ckd1,$ckd2,$cjns);
			echo $data;			
		}


		public function proses_headerP4(){
			$cthn 	= $_GET['ctahun'];			
			$ckode = $_GET['cinstansi'];
			$caksi = $_GET['caksi'];
			
			$data = $this->ApipModel->viewHProfil4($cthn,$ckode,$caksi);
			echo $data;			
		}

		public function proses_headerP7(){
			$cthn 	= $_GET['ctahun'];
			$ctriw = $_GET['ctriw'];
			$ckode = $_GET['cinstansi'];
			$ckd1 = $_GET['ckd1'];
			$caksi = $_GET['caksi'];
			
			$data = $this->ApipModel->viewHProfil7($cthn,$ckode,$ctriw,$ckd1,$caksi);
			echo $data;			
		}


		public function proses_detailP7(){
			$cthn 	= $_GET['ctahun'];
			$ctriw = $_GET['ctriw'];
			$ckode = $_GET['cinstansi'];
			$ckd1 = $_GET['ckd1'];
			$caksi = $_GET['caksi'];
			
			$data = $this->ApipModel->viewDProfil7($cthn,$ckode,$ctriw,$ckd1,$caksi);
			echo $data;			
		}
		

		public function get_profil2($cthn='',$ckode='',$ctriw=''){

			$data = $this->ApipModel->viewProfil2($cthn,$ckode,$ctriw);
			echo $data;
			
			
		}


		public function get_profil5($cthn='',$ckode='',$ctriw=''){

			$data = $this->ApipModel->viewProfil5($cthn,$ckode,$ctriw);
			echo $data;
			
			
		}

		public function get_profil6($cthn='',$ckode='',$ctriw=''){

			$data = $this->ApipModel->viewProfil6($cthn,$ckode,$ctriw);
			echo $data;			
		}


		public function get_profil7($cthn='',$ckode='',$ctriw=''){

			$data = $this->ApipModel->viewProfil7($cthn,$ckode,$ctriw);
			echo $data;			
		}


		public function edit_hprofil4($ckd1='',$cinstansi='',$cjns=''){

			$data = $this->ApipModel->viewEHProfil4($ckd1,$cinstansi,$cjns);
			echo $data;			
		}		
		
		

		public function list_profil7($cthn='',$ckode='',$ctriw='',$ckd1='',$ckd2='',$cjns=''){
			$data = $this->ApipModel->listProfil7($cthn,$ckode,$ctriw,$ckd1,$ckd2,$cjns);
			echo $data;			
		}



		public function get_profil4($cthn='',$ckode=''){

			$data = $this->ApipModel->viewProfil4($cthn,$ckode);
			echo $data;			
		}
		
		
		public function get_profil4_cek($cthn='',$ckode=''){
			$data 	= $this->ApipModel->viewProfil4_cek($cthn,$ckode);

			echo json_encode($data);
						
		}



		public function hapus_rincip7(){
			
			$cthn 	= $_GET['ctahun'];
			$ctriw = $_GET['ctriw'];
			$cinstansi = $_GET['cinstansi'];
			$ckd1 = $_GET['ckd1'];
			$ckd2 = $_GET['ckd2'];
			$ckd3 = $_GET['ckd3'];

			
			$sql = "delete from tprofil_it3 where tahun='".$cthn."' and triw='".$ctriw."' and kd_apip='".$cinstansi."' and kd_profil_it1='".$ckd1."'
					and kd_profil_it2='".$ckd2."' and kd_profil_it3='".$ckd3."'" ;				
			$result = $this->db->query($sql);

			if($result){					
				$message = "1";
			}else{
				$message = "0";
			}


		    echo json_encode($message);

		}



		public function hapus_hprofil7(){
			
			$cthn 	= $_GET['ctahun'];
			$ctriw = $_GET['ctriw'];
			$cinstansi = $_GET['cinstansi'];
			$ckd1 = $_GET['ckd1'];
			$ckd2 = $_GET['ckd2'];
			

			
			$sql = "delete from tprofil_it1 where tahun='".$cthn."' and triw='".$ctriw."' and kd_apip='".$cinstansi."' and kd_profil_it1='".$ckd1."'" ;				
			$result = $this->db->query($sql);

			if($result){

				$sql2 = "delete from tprofil_it2 where tahun='".$cthn."' and triw='".$ctriw."' and kd_apip='".$cinstansi."' and kd_profil_it1='".$ckd1."'" ;				
				$result2 = $this->db->query($sq2);

				if($result2){

					$sql3 = "delete from tprofil_it3 where tahun='".$cthn."' and triw='".$ctriw."' and kd_apip='".$cinstansi."' and kd_profil_it1='".$ckd1."'" ;				
					$result3 = $this->db->query($sq3);
				}
			
				$message = "1";
			}else{
				$message = "0";
			}


		    echo json_encode($message);

		}



		public function hapus_hprofil4(){
			
			$cthn 	= $_GET['ctahun'];

			$tahun_awal=$cthn-4;
			$tahun_akhir=$cthn+2;

			
			$ctriw = $_GET['ctriw'];
			$cinstansi = $_GET['cinstansi'];
			$ckd1 = $_GET['ckd1'];
			$ckd2 = $_GET['ckd2'];
			

			
			$sql = "delete from tprofil_gov1 where kd_apip='".$cinstansi."' and kd_profil_gov1='".$ckd1."'" ;				
			$result = $this->db->query($sql);


			$sql2 = "delete from tprofil_gov2 where kd_apip='".$cinstansi."' and kd_profil_gov1='".$ckd1."' and tahun between '".$tahun_awal."' and '".$tahun_akhir."'" ;				
			$result2 = $this->db->query($sql2);

			if($result){
				$message = "1";
				
			}else{
				$message = "0";
			}


		    echo json_encode($message);

		}



		public function hapus_dprofil7(){
			
			$cthn 	= $_GET['ctahun'];
			$ctriw = $_GET['ctriw'];
			$cinstansi = $_GET['cinstansi'];
			$ckd1 = $_GET['ckd1'];
			$ckd2 = $_GET['ckd2'];
			

			
			$sql = "delete from tprofil_it2 where tahun='".$cthn."' and triw='".$ctriw."' and kd_apip='".$cinstansi."' and kd_profil_it1='".$ckd1."'  and kd_profil_it2='".$ckd2."'" ;				
			$result = $this->db->query($sql);

			if($result){
				$sql3 = "delete from tprofil_it3 where tahun='".$cthn."' and triw='".$ctriw."' and kd_apip='".$cinstansi."' and kd_profil_it1='".$ckd1."'  and kd_profil_it2='".$ckd2."'" ;				
				$result2 = $this->db->query($sq3);
				
				if($result2){				
					$message = "1";
				
				}else{
					$message = "0";
				}
			}else{
				$message = "0";
			}


		    echo json_encode($message);

		}




		public function update_Hprofil7(){  
				
			$ctahun = $this->input->post('ctahun');	
			$cinstansi = $this->input->post('cinstansi');			
			$ckd1 = $this->input->post('ckd1');
			$ctriw = $this->input->post('ctriw');
			$curaian = $this->input->post('curaian');
			$curut = $this->input->post('curut');
			$cpoin = $this->input->post('cpoin');
			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');

			$cmsg='';
	
				
					$csql = "update tprofil_it1 set nilai='".$cnilai."', poin='".$cpoin."', uraian='".$curaian."' ,urut='".$curut."'
					 where tahun='".$ctahun."' and kd_apip='".$cinstansi."' and triw='".$ctriw."' and kd_profil_it1='".$ckd1."'" ;				
					$cquery1 = $this->db->query($csql);
					
				if($cquery1){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 



		public function update_Hprofil4(){  
				



			$cinstansi = $this->input->post('cinstansi');			
			$ckd1 = $this->input->post('ckd1');
			$curaian = $this->input->post('curaian');
			$curut = $this->input->post('curut');
			$cpoin = $this->input->post('cpoin');
			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');

			$cmsg='';
	
				
					$csql = "update tprofil_gov1 set poin='".$cpoin."', uraian='".$curaian."' ,urut='".$curut."'
							where  kd_apip='".$cinstansi."'  and kd_profil_gov1='".$ckd1."'" ;				
					$cquery1 = $this->db->query($csql);
					
				if($cquery1){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 




		public function simpan_Hprofil4(){  
				



			$cinstansi = $this->input->post('cinstansi');			
			$ckd1 = $this->input->post('ckd1');
			$curaian = $this->input->post('curaian');
			$curut = $this->input->post('curut');
			$cpoin = $this->input->post('cpoin');
			$cjns = $this->input->post('cjns');
			
			
			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');

			$cmsg='';
	
				
					$csql = "insert into  tprofil_gov1(kd_apip,kd_profil_gov1,poin,uraian,jns_info,urut,visible)values('".$cinstansi."','".$ckd1."','".$cpoin."','".$curaian."','".$cjns."','".$curut."',1)" ;				
					$cquery1 = $this->db->query($csql);
					
				if($cquery1){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 




		public function simpan_profil1(){
				
			$ctahun = $this->input->post('ctahun');	
			$cinstansi = $this->input->post('cinstansi');			
			$cid = $this->input->post('cid');
			$ctriw = $this->input->post('ctriw');
			$cnilai = $this->input->post('cnilai');
			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');
			

			$cid = explode('#', $cid);
			$cnilai = explode('#', $cnilai);
			$ccount = count($cid);

			$cmsg='';
			for ($i = 1; $i < $ccount; $i++) {
				
					$csql = "update tprofil_angreal set nilai='".$cnilai[$i]."', id_user='".$user_id."',update_at='".$ctgl."' where tahun='".$ctahun."' and kd_apip='".$cinstansi."' and triw='".$ctriw."' and id_angreal='".$cid[$i]."'" ;				
					$cquery1 = $this->db->query($csql);
			}
		
				$csql2 = "UPDATE tprofil_angreal a INNER JOIN
							(SELECT (SELECT id_angreal FROM tmap_angreal WHERE kd_angreal1=bb.kd_angreal1 AND clevel='1')id_angreal,aa.kd_apip,aa.tahun,aa.triw, bb.kd_angreal1,SUM(nilai)nilai FROM tprofil_angreal aa
							INNER JOIN tmap_angreal bb ON aa.id_angreal=bb.id_angreal 
							WHERE aa.tahun='".$ctahun."' AND aa.kd_apip='".$cinstansi."' AND aa.triw='".$ctriw."' AND bb.clevel<>'1' 
							GROUP BY aa.kd_apip,aa.tahun,aa.triw, bb.kd_angreal1 
							)b  ON  a.id_angreal=b.id_angreal
							SET a.nilai=b.nilai 
							WHERE a.tahun='".$ctahun."' AND a.kd_apip='".$cinstansi."' AND a.triw='".$ctriw."'";
				$cquery2 = $this->db->query($csql2);
				
				
				$csql3 = "UPDATE tprofil_angreal a INNER JOIN 
					(SELECT id_angreal,((nilai1/nilai2)*100) AS persen FROM(
					SELECT aa.id_angreal,
					(SELECT nilai FROM tprofil_angreal WHERE id_angreal=aa.fid1 and tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND triw='".$ctriw."')nilai1,(SELECT nilai FROM tprofil_angreal WHERE id_angreal=aa.fid2 and tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND triw='".$ctriw."')nilai2
					FROM tmap_angreal aa WHERE tipe='Persentase'
					)z)b ON a.id_angreal=b.id_angreal SET a.nilai=b.persen WHERE a.tahun='".$ctahun."' AND a.kd_apip='".$cinstansi."' AND a.triw='".$ctriw."'";
				$cquery3 = $this->db->query($csql3);
				


				if($cquery3){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 


		public function simpan_profil2(){
				
			$ctahun = $this->input->post('ctahun');	
			$cinstansi = $this->input->post('cinstansi');
			$ctriw = $this->input->post('ctriw');			
			$cid = $this->input->post('cid');
			$cnilai = $this->input->post('cnilai');
			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');
		

			$cid = explode('#', $cid);
			$cnilai = explode('#', $cnilai);
			$ccount = count($cid);

			$cmsg='';
			for ($i = 1; $i < $ccount; $i++) {
				
				
			$sql = "select count(*)jml from tprofil_pengawasan  where tahun='".$ctahun."' and kd_apip='".$cinstansi."' and triw='".$ctriw."' and id_pengawasan='".$cid[$i]."'" ;				
			$query1 = $this->db->query($sql);
			$data = $query1->row();
			$cek=$data->cuser;
			
				if($cek==0){
					$user = "user_insert";
					$create = "insert_at";
					
				}else{
					
					$user = "user_update";
					$create = "update_at";
				}				
				
				
				$csql = "update tprofil_pengawasan set nilai='".$cnilai[$i]."', ".$user."='".$user_id."',".$create."='".$ctgl."' where tahun='".$ctahun."' and kd_apip='".$cinstansi."' and triw='".$ctriw."' and id_pengawasan='".$cid[$i]."'" ;				
				
				$cquery1 = $this->db->query($csql);

			}
			
		
				 $csql2 = "update tprofil_pengawasan aa inner join (
							select*from(
							select a.id_pengawasan,(select nilai from tprofil_pengawasan where id_pengawasan= b.penjumlah and
							 tahun='".$ctahun."' AND kd_apip='".$cinstansi."' AND triw='".$ctriw."' AND tampil='1'
							)nilai from tprofil_pengawasan a
							inner join tmap_pengawasan b on a.id_pengawasan=b.id_pengawasan where clevel='3')xx where nilai is not null
							)z
							SET aa.nilai=z.nilai WHERE aa.tahun='".$ctahun."' AND aa.kd_apip='".$cinstansi."' AND aa.triw='".$ctriw."'  and aa.id_pengawasan=z.id_pengawasan"; 

							
					$cquery2 = $this->db->query($csql2);
				
				 

				if($cquery2){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 


		public function simpan_profil4(){
			
			$ctahun = $this->input->post('ctahun');	
			$cinstansi = $this->input->post('cinstansi');			
			$cjenis = $this->input->post('cjenis');
			$cnilai = $this->input->post('cnilai');
			$ckd1 = $this->input->post('ckd1');
			$ckd2 = $this->input->post('ckd2');
			$clevel = $this->input->post('clevel');
			$curaian = $this->input->post('curaian');
			$cpoin = $this->input->post('cpoin');
			$ctahun_trx = $this->input->post('ctahun_trx');
			
			
			
			
			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');
		

			$cjenis = explode('#', $cjenis);
			$cnilai = explode('#', $cnilai);
			$ckd1 = explode('#', $ckd1);
			$ckd2 = explode('#', $ckd2);
			$cpoin = explode('#', $cpoin);
			$clevel = explode('#', $clevel);
			$ctahun_trx = explode('#', $ctahun_trx);
			$curaian = explode('#', $curaian);
			$ccount = count($ckd1);


			$cmsg='';  $xx=0; $xtahun='';
			 for ($i = 1; $i < $ccount; $i++) {
				 
				 
				if($clevel[$i]==2){
					
					$xx=$xx+1;
					
				//	$ctahun_trx=$ctahun_trx[$i];
					
					
					
					$sql = "select count(*)jml from tprofil_gov2 where tahun='".$ctahun_trx[$i]."' and kd_apip='".$cinstansi."' and kd_profil_gov1='".$ckd1[$i]."' and kd_profil_gov2='".$ckd2[$i]."'" ;				
		
					$query1 = $this->db->query($sql);
					$data = $query1->row();
					$cek=$data->jml;
					
						if($cek==0){
					
					
							if($cjenis[$i]==1 || $cjenis[$i]==4){
							
								$csql = "insert into tprofil_gov2(tahun,kd_apip,kd_profil_gov1,kd_profil_gov2,urut,nilai_pilihan)values($ctahun_trx[$i],$cinstansi,$ckd1[$i],$ckd2[$i],$ckd2[$i],'".$cnilai[$i]."')";

								$cquery1 = $this->db->query($csql);
								
							}else if($cjenis[$i]==2){
								
								$csql = "insert into tprofil_gov2(tahun,kd_apip,kd_profil_gov1,kd_profil_gov2,urut,nilai)values($ctahun_trx[$i],$cinstansi,$ckd1[$i],$ckd2[$i],$ckd2[$i],'".$cnilai[$i]."')";
								$cquery1 = $this->db->query($csql);
							}else if($cjenis[$i]==3){
								
								
								$csql = "insert into tprofil_gov2(tahun,kd_apip,kd_profil_gov1,kd_profil_gov2,urut,uraian)values($ctahun_trx[$i],$cinstansi,$ckd1[$i],$ckd2[$i],$ckd2[$i],'".$cnilai[$i]."')";
								$cquery1 = $this->db->query($csql);
								
							}
	
							
						}else{  //---------------- update data
						
							
							if($cjenis[$i]==1 || $cjenis[$i]==4){
							
								$csql = "update tprofil_gov2 set nilai_pilihan='".$cnilai[$i]."' where tahun='".$ctahun_trx[$i]."' and kd_apip='".$cinstansi."' and kd_profil_gov1='".$ckd1[$i]."' 
										and kd_profil_gov2='".$ckd2[$i]."'" ;				
								
								
								
								$cquery1 = $this->db->query($csql);
								
							}else if($cjenis[$i]==2){
								
								$csql = "update tprofil_gov2 set nilai='".$cnilai[$i]."' where tahun='".$ctahun_trx[$i]."' and kd_apip='".$cinstansi."' and kd_profil_gov1='".$ckd1[$i]."' 
										and kd_profil_gov2='".$ckd2[$i]."'" ;
								
								$cquery1 = $this->db->query($csql);
							}else if($cjenis[$i]==3){
								
								$csql = "update tprofil_gov2 set uraian='".$cnilai[$i]."' where tahun='".$ctahun_trx[$i]."' and kd_apip='".$cinstansi."' and kd_profil_gov1='".$ckd1[$i]."' 
										and kd_profil_gov2='".$ckd2[$i]."'" ;
								
								$cquery1 = $this->db->query($csql);
							}
							

						}	
					
				}	 
				
				

		} 
			
			

				if($cquery1){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data); 
					

		} 




		public function simpan_profil5(){
				
			$ctahun = $this->input->post('ctahun');	
			$cinstansi = $this->input->post('cinstansi');			
			$cid = $this->input->post('cid');
			$ctriw = $this->input->post('ctriw');
			$cnilai = $this->input->post('cnilai');
			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');
		

			$cid = explode('#', $cid);
			$cnilai = explode('#', $cnilai);
			$ccount = count($cid);

			$cmsg='';
			for ($i = 1; $i < $ccount; $i++) {
				
				
			$sql = "select ifnull(user_insert,0)cuser from tprofil_struktur_sdm  where tahun='".$ctahun."' and kd_apip='".$cinstansi."' and triw='".$ctriw."' and id_struktur_sdm='".$cid[$i]."'" ;				
			$query1 = $this->db->query($sql);
			$data = $query1->row();
			$cek=$data->cuser;
			
				if($cek==0){
					$user = "user_insert";
					$create = "insert_at";
					
				}else{
					
					$user = "user_update";
					$create = "update_at";
				}				
				
				
				$csql = "update tprofil_struktur_sdm set nilai='".$cnilai[$i]."', ".$user."='".$user_id."',".$create."='".$ctgl."' where tahun='".$ctahun."' and kd_apip='".$cinstansi."' and triw='".$ctriw."' and id_struktur_sdm='".$cid[$i]."'" ;				
				$cquery1 = $this->db->query($csql);

			}
			
				$csql2 = "UPDATE tprofil_struktur_sdm a INNER JOIN
							(SELECT (SELECT id_struktur_sdm FROM tmap_struktur_sdm WHERE kd_struktur_sdm1=zz.kd_struktur_sdm1 AND 
							kd_struktur_sdm2=zz.kd_struktur_sdm2 AND kd_struktur_sdm3 =zz.kd_struktur_sdm3)id_struktur_sdm,kd_struktur_sdm1,kd_struktur_sdm2,kd_struktur_sdm3,nilai FROM(
							SELECT kd_struktur_sdm1,IFNULL(kd_struktur_sdm2,0)kd_struktur_sdm2,IFNULL(kd_struktur_sdm3,0)kd_struktur_sdm3,nilai FROM (
							SELECT bb.kd_struktur_sdm1,bb.kd_struktur_sdm2,bb.kd_struktur_sdm3,SUM(aa.nilai)nilai FROM tprofil_struktur_sdm aa
							INNER JOIN tmap_struktur_sdm bb ON aa.id_struktur_sdm=bb.id_struktur_sdm WHERE bb.clevel=3 AND  aa.tahun='".$ctahun."' AND aa.kd_apip='".$cinstansi."' AND aa.triw='".$ctriw."'
							GROUP BY bb.kd_struktur_sdm1,bb.kd_struktur_sdm2,bb.kd_struktur_sdm3 WITH ROLLUP
							)z WHERE kd_struktur_sdm3 IS NULL
							)zz
							)b  ON  a.id_struktur_sdm=b.id_struktur_sdm
							SET a.nilai=b.nilai 
							WHERE a.tahun='".$ctahun."' AND a.kd_apip='".$cinstansi."' AND a.triw='".$ctriw."'";
							
					$cquery2 = $this->db->query($csql2);
				
				 

				if($cquery2){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 


		public function simpan_profil6(){
				
			$ctahun = $this->input->post('ctahun');	
			$cinstansi = $this->input->post('cinstansi');			
			$cid = $this->input->post('cid');
			$ctriw = $this->input->post('ctriw');
			$cnilai = $this->input->post('cnilai');
			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');
		

			$cid = explode('#', $cid);
			$cnilai = explode('#', $cnilai);
			$ccount = count($cid);

			$cmsg='';
			for ($i = 1; $i < $ccount; $i++) {
				
				
			$sql = "select ifnull(user_insert,0)cuser from tprofil_sertifikasi_sdm  where tahun='".$ctahun."' and kd_apip='".$cinstansi."' and triw='".$ctriw."' and id_sertifikasi_sdm='".$cid[$i]."'" ;				
			$query1 = $this->db->query($sql);
			$data = $query1->row();
			$cek=$data->cuser;
			
				if($cek==0){
					$user = "user_insert";
					$create = "insert_at";
					
				}else{
					
					$user = "user_update";
					$create = "update_at";
				}				
				
				
				$csql = "update tprofil_sertifikasi_sdm set nilai='".$cnilai[$i]."', ".$user."='".$user_id."',".$create."='".$ctgl."' where tahun='".$ctahun."' and kd_apip='".$cinstansi."' and triw='".$ctriw."' and id_sertifikasi_sdm='".$cid[$i]."'" ;				
				$cquery1 = $this->db->query($csql);

			}
			
				$csql2 = "UPDATE tprofil_sertifikasi_sdm a INNER JOIN
							(SELECT (SELECT id_sertifikasi_sdm FROM tmap_sertifikasi_sdm WHERE kd_sertifikasi_sdm1=zz.kd_sertifikasi_sdm1 AND 
							kd_sertifikasi_sdm2=zz.kd_sertifikasi_sdm2 AND kd_sertifikasi_sdm3 =zz.kd_sertifikasi_sdm3)id_sertifikasi_sdm,kd_sertifikasi_sdm1,kd_sertifikasi_sdm2,kd_sertifikasi_sdm3,nilai FROM(
							SELECT kd_sertifikasi_sdm1,IFNULL(kd_sertifikasi_sdm2,0)kd_sertifikasi_sdm2,IFNULL(kd_sertifikasi_sdm3,0)kd_sertifikasi_sdm3,nilai FROM (
							SELECT bb.kd_sertifikasi_sdm1,bb.kd_sertifikasi_sdm2,bb.kd_sertifikasi_sdm3,SUM(aa.nilai)nilai FROM tprofil_sertifikasi_sdm aa
							INNER JOIN tmap_sertifikasi_sdm bb ON aa.id_sertifikasi_sdm=bb.id_sertifikasi_sdm WHERE bb.clevel=3 AND  aa.tahun='".$ctahun."' AND aa.kd_apip='".$cinstansi."' AND aa.triw='".$ctriw."'
							GROUP BY bb.kd_sertifikasi_sdm1,bb.kd_sertifikasi_sdm2,bb.kd_sertifikasi_sdm3 WITH ROLLUP
							)z WHERE kd_sertifikasi_sdm3 IS NULL
							)zz
							)b  ON  a.id_sertifikasi_sdm=b.id_sertifikasi_sdm
							SET a.nilai=b.nilai 
							WHERE a.tahun='".$ctahun."' AND a.kd_apip='".$cinstansi."' AND a.triw='".$ctriw."'";
							
					$cquery2 = $this->db->query($csql2);
				
				 

				if($cquery2){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 




	public function simpan_Eprofil7(){  
				
			$ctahun = $this->input->post('ctahun');	
			$cinstansi = $this->input->post('cinstansi');	
			$ctriw = $this->input->post('ctriw');

			$cnilai = $this->input->post('cnilai');
			$ckd1 = $this->input->post('ckd1');
			$ckd2 = $this->input->post('ckd2');
		
			
			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');

			
			
				$csql = "update  tprofil_it1 set nilai='".$cnilai."' where  tahun='".$ctahun."' and triw='".$ctriw."' and kd_apip='".$cinstansi."' and kd_profil_it1='".$ckd1."'";			
				$cquery1 = $this->db->query($csql);

				if($cquery1){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 
	


	public function simpan_profil7(){
				
			$ctahun = $this->input->post('ctahun');	
			$cinstansi = $this->input->post('cinstansi');	
			$ctriw = $this->input->post('ctriw');
			$cpoin = $this->input->post('cpoin');
			$curaian = $this->input->post('curaian');
			$cjns = $this->input->post('cjns');
			$cnilai = $this->input->post('cnilai');
			$ckd1 = $this->input->post('ckd1');
			$ckd2 = $this->input->post('ckd2');
		
			
			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');

			
			
				$csql = "insert into tprofil_it1(tahun,triw,kd_apip,kd_profil_it1,poin,uraian,jns_info,urut)values('".$ctahun."','".$ctriw."','".$cinstansi."','".$cpoin."') where tahun='".$ctahun."' and kd_apip='".$cinstansi."' and triw='".$ctriw."' and kd_profil_it1='".$ckd1."'" ;				
				$cquery1 = $this->db->query($csql);

				if($cquery1){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 



		public function simpan_hprofil7(){
				
			$ctahun = $this->input->post('ctahun');	
			$cinstansi = $this->input->post('cinstansi');	
			$ctriw = $this->input->post('ctriw');
			$cpoin = $this->input->post('cpoin');
			$curaian = $this->input->post('curaian');
			$cjns = $this->input->post('cjns');
			$urut = $this->input->post('urut');
			$ckd1 = $this->input->post('ckd1');
		
			
			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');
			
				$csql = "insert into tprofil_it1(tahun,triw,kd_apip,kd_profil_it1,poin,uraian,jns_info,urut,nilai)values('".$ctahun."','".$ctriw."','".$cinstansi."','".$ckd1."','".$cpoin."','".$curaian."','".$cjns."','".$urut."',0)" ;				
				$cquery1 = $this->db->query($csql);

				if($cquery1){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 


		public function simpan_dprofil7(){
				
			$ctahun = $this->input->post('ctahun');	
			$cinstansi = $this->input->post('cinstansi');	
			$ctriw = $this->input->post('ctriw');
			$curaian = $this->input->post('curaian');
			$urut = $this->input->post('urut');
			$ckd1 = $this->input->post('ckd1');
			
			
			$query="Select ifnull(max(kd_profil_it2),0)+1 as cnext from tprofil_it2 WHERE tahun='".$ctahun."' 
				AND kd_apip='".$cinstansi."' AND triw='".$ctriw."' AND kd_profil_it1='".$ckd1."'";
				$csq = $this->db->query($query);
				$data = $csq->row();
				$cnext = $data->cnext;
			
			
			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');
			
				$csql = "insert into tprofil_it2(tahun,triw,kd_apip,kd_profil_it1,kd_profil_it2,uraian,urut)values('".$ctahun."','".$ctriw."','".$cinstansi."','".$ckd1."','".$cnext."','".$curaian."','".$urut."')" ;				
				$cquery1 = $this->db->query($csql);

				if($cquery1){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 




	public function simpan_rinci_profil7(){
				
			$cthn = $this->input->post('ctahun');	
			$ckode = $this->input->post('cinstansi');	
			$ctriw = $this->input->post('ctriw');
			$ckd1 = $this->input->post('ckd1');
			$ckd2 = $this->input->post('ckd2');
			$ckd3 = $this->input->post('ckd3');
			$curaian = $this->input->post('curaian');
			
			$user_id = $this->session->userdata('user_id');
			$ctgl = date('Y-m-d H:i:s');
			
			
			if($ckd3==''){
				
				$query="Select ifnull(max(kd_profil_it3),0)+1 as cnext from tprofil_it3 WHERE tahun='".$cthn."' 
						AND kd_apip='".$ckode."' AND triw='".$ctriw."' AND kd_profil_it1='".$ckd1."' AND kd_profil_it2='".$ckd2."'";
						$csq = $this->db->query($query);
						$data = $csq->row();
						$cnext = $data->cnext;
						 
				$csql = "insert into tprofil_it3(tahun,triw,kd_apip,kd_profil_it1,kd_profil_it2,kd_profil_it3,uraian,urut)
						values('".$cthn."','".$ctriw."','".$ckode."','".$ckd1."','".$ckd2."','".$cnext."','".$curaian."','".$cnext."')";				
				$cquery1 = $this->db->query($csql);
						
			
				
			}else{
				
				
				$csql = "update tprofil_it3 set uraian='".$curaian."' where tahun='".$cthn."' 
						AND kd_apip='".$ckode."' AND triw='".$ctriw."' AND kd_profil_it1='".$ckd1."' AND kd_profil_it2='".$ckd2."'  AND kd_profil_it3='".$ckd3."'";				
				$cquery1 = $this->db->query($csql);
				
			}
				 

				if($cquery1){
					$data=1;
				}else{
					$data=0;
				}
					
				echo json_encode($data);
					

		} 





		public function insert(){
			$tahun= $this->input->post('tahun');
			$inst = $this->input->post('instansi');

			$dataInsert = array(
				'kd_apip' => $inst,
				'tahun' => $tahun,
				'tgl_input' => date('Y-m-d H:i:s'),
				'user_input' => $this->session->userdata('nama'),
				
			);
			
			
			$whereApip = array(
				'kd_apip' 	=> $inst,
				'tahun' 	=> $tahun
			);
			

	
			

			

			$cekParameter = $this->db->get_where('tapip', $whereApip)->result();
			// echo count($id_rekom);exit;
			// print_r(count($cekParameter));die();
			
			
			if(count($cekParameter) >= 1){
				$pesan=2;//"Data Sudah Ada";
			}else{
				$data_head = $this->security->xss_clean($dataInsert);
				$result = $this->ApipModel->insertApip($data_head);
				
				
				if($result){
					$pesan=1;//"Data Berhasil Ditambahkan!";
				}else{
					$pesan=0;//"Data Gagal Simpan!";					
				}
				
			}

			
				
				$dataRet['pesan'] = $pesan;
				echo json_encode($dataRet);
			
		}


	}
