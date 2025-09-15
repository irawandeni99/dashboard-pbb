<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends CI_Controller  {
		public function __construct(){
			parent::__construct();			
			$this->load->library('mybreadcrumb');
			$this->load->model('bappeda/Dashboardrenja_model', 'bappeda_model');
			$this->load->model('kapip/DashboradModel', 'MDashboard');
			$this->load->model('input/InputWasUmumModel', 'umum_model');
			$this->load->model('input/InputWasTeknisModel', 'teknis_model');
			$this->load->model('input/InputBinwasModel', 'binwas_model');
		}

		public function index(){			
			ini_set('max_execution_time', 300);					
			$data['view'] = 'kapip/dashboard/index';
			$this->load->view('template/layout', $data);
		}

		public function get_tree() {
			$daerah = $this->input->post('kab');
			$tahun = $this->input->post('thn');
			$tipe = $this->input->post('tipe');
			// print($daerah);die();
			

			
			$noreg = $tahun.'-'.$daerah;
			
			$data['umum'] = $this->umum_model->get_dashboard_umum($daerah,$tahun); 
			$data['teknis'] = $this->teknis_model->get_dashboard_teknis($daerah,$tahun); 
			$data['binwas'] = $this->binwas_model->get_dashboard_binwas($daerah,$tahun); 

			if ($tipe=='prov' || $tipe=='kab') {
				$resDaerah = $this->PublicModel->getNamaDaerah($daerah);
				$namaDaerah = strtoupper($resDaerah[0]->jenis).' : '.$resDaerah[0]->nama;

				$sql = 'SELECT 1 as no,"SESUAI" as sts, COUNT(sts_tlanjut) as jml from trd_tlhp_pemda_rekomendasi r
						where noreg = "'.$noreg.'" and sts_tlanjut = "SESUAI" 
						UNION ALL
						SELECT 2 as no,"BELUM SESUAI" as sts, COUNT(sts_tlanjut) as jml from trd_tlhp_pemda_rekomendasi r
						where noreg = "'.$noreg.'" and sts_tlanjut = "BELUM SESUAI"
						UNION ALL
						SELECT 3 as no,"BELUM DITINDAKLANJUTI" as sts, COUNT(sts_tlanjut) as jml from trd_tlhp_pemda_rekomendasi r
						where noreg = "'.$noreg.'" and sts_tlanjut = "BELUM DITINDAKLANJUTI"
						UNION ALL
						SELECT 4 as no,"TIDAK DAPAT DITINDAKLANJUTI" as sts, COUNT(sts_tlanjut) as jml from trd_tlhp_pemda_rekomendasi r
						where noreg = "'.$noreg.'" and sts_tlanjut = "TIDAK DAPAT DITINDAKLANJUTI"';
				
			}else if ($tipe=='kemendagri') {
				$resDaerah = $this->PublicModel->getNamaInstansi($daerah);
				$namaDaerah = strtoupper($resDaerah[0]->jenis).' : '.$resDaerah[0]->nama;

				$sql = 'SELECT 1 as no,"SESUAI" as sts, COUNT(sts_tlanjut) as jml from trd_tlhp_kemendagri_rekomendasi r
						where noreg = "'.$noreg.'" and sts_tlanjut = "SESUAI" 
						UNION ALL
						SELECT 2 as no,"BELUM SESUAI" as sts, COUNT(sts_tlanjut) as jml from trd_tlhp_kemendagri_rekomendasi r
						where noreg = "'.$noreg.'" and sts_tlanjut = "BELUM SESUAI"
						UNION ALL
						SELECT 3 as no,"BELUM DITINDAKLANJUTI" as sts, COUNT(sts_tlanjut) as jml from trd_tlhp_kemendagri_rekomendasi r
						where noreg = "'.$noreg.'" and sts_tlanjut = "BELUM DITINDAKLANJUTI"
						UNION ALL
						SELECT 4 as no,"TIDAK DAPAT DITINDAKLANJUTI" as sts, COUNT(sts_tlanjut) as jml from trd_tlhp_kemendagri_rekomendasi r
						where noreg = "'.$noreg.'" and sts_tlanjut = "TIDAK DAPAT DITINDAKLANJUTI"';
				
			}else{
				
				$namaDaerah = 'NASIONAL';
				$sql = 'SELECT 1 as no,"SESUAI" as sts, COUNT(sts_tlanjut) as jml from trd_tlhp_pemda_rekomendasi r
						where  tahun = "'.$tahun.'" and sts_tlanjut = "SESUAI" 
						UNION ALL
						SELECT 2 as no,"BELUM SESUAI" as sts, COUNT(sts_tlanjut) as jml from trd_tlhp_pemda_rekomendasi r
						where tahun = "'.$tahun.'" and sts_tlanjut = "BELUM SESUAI"
						UNION ALL
						SELECT 3 as no,"BELUM DITINDAKLANJUTI" as sts, COUNT(sts_tlanjut) as jml from trd_tlhp_pemda_rekomendasi r
						where tahun = "'.$tahun.'" and sts_tlanjut = "BELUM DITINDAKLANJUTI"
						UNION ALL
						SELECT 4 as no,"TIDAK DAPAT DITINDAKLANJUTI" as sts, COUNT(sts_tlanjut) as jml from trd_tlhp_pemda_rekomendasi r
						where tahun = "'.$tahun.'" and sts_tlanjut = "TIDAK DAPAT DITINDAKLANJUTI"';
			}


			$rekom = $this->db->query($sql)->result();
			
			$chart_rek = array();
			$jml_rek = 0;
			foreach ($rekom as $value) {
				$chart_rek[] = [$value->sts.' ('.$value->jml.') ',(int)$value->jml];
				$jml_rek = $jml_rek+(int)$value->jml;
			}


			if ($tipe=='prov' || $tipe=='kab') {

				$sql2 = "SELECT selesai,tot FROM(SELECT *,
							(SELECT COUNT(kd_rekom) FROM trd_tlhp_pemda_rekomendasi rt where rt.noreg = t.noreg and rt.kd_temuan = t.kd_temuan and rt.sts_tlanjut = 'SESUAI') as selesai,
						(SELECT COUNT(kd_rekom) FROM trd_tlhp_pemda_rekomendasi rt where rt.noreg = t.noreg and rt.kd_temuan = t.kd_temuan and rt.sts_tlanjut != 'SESUAI') as belum,
							(SELECT COUNT(kd_rekom) FROM trd_tlhp_pemda_rekomendasi rt where rt.noreg = t.noreg and rt.kd_temuan = t.kd_temuan) as tot
							FROM trd_tlhp_pemda_temuan t where noreg = '".$noreg."') a;";
			}else if ($tipe=='kemendagri') {

				$sql2 = "SELECT selesai,tot FROM(SELECT *,
							(SELECT COUNT(kd_rekom) FROM trd_tlhp_kemendagri_rekomendasi rt where rt.noreg = t.noreg and rt.kd_temuan = t.kd_temuan and rt.sts_tlanjut = 'SESUAI') as selesai,
						(SELECT COUNT(kd_rekom) FROM trd_tlhp_kemendagri_rekomendasi rt where rt.noreg = t.noreg and rt.kd_temuan = t.kd_temuan and rt.sts_tlanjut != 'SESUAI') as belum,
							(SELECT COUNT(kd_rekom) FROM trd_tlhp_kemendagri_rekomendasi rt where rt.noreg = t.noreg and rt.kd_temuan = t.kd_temuan) as tot
							FROM trd_tlhp_kemendagri_temuan t where noreg = '".$noreg."') a;";
			}else{
				$sql2 = "SELECT selesai,tot FROM(SELECT *,
							(SELECT COUNT(kd_rekom) FROM trd_tlhp_pemda_rekomendasi rt where rt.noreg = t.noreg and rt.kd_temuan = t.kd_temuan and rt.sts_tlanjut = 'SESUAI') as selesai,
						(SELECT COUNT(kd_rekom) FROM trd_tlhp_pemda_rekomendasi rt where rt.noreg = t.noreg and rt.kd_temuan = t.kd_temuan and rt.sts_tlanjut != 'SESUAI') as belum,
							(SELECT COUNT(kd_rekom) FROM trd_tlhp_pemda_rekomendasi rt where rt.noreg = t.noreg and rt.kd_temuan = t.kd_temuan) as tot
							FROM trd_tlhp_pemda_temuan t where tahun = ".$tahun.") a;";
			}
			
			$temuan = $this->db->query($sql2)->result();
			
			$chart_temuan = array();
			$jml_temuan = 0;
			$selesai = 0;
			$belum = 0;
			foreach ($temuan as $value2) {
				if ($value2->tot != 0 && $value2->selesai == $value2->tot) {
					$selesai = $selesai+1;	
				}else{
					$belum = $belum+1;
				}
				$jml_temuan++;
			}
			$chart_temuan[] = ['SELESAI'.' ('.$selesai.') ',(int)$selesai];
			$chart_temuan[] = ['BELUM SELESAI'.' ('.$belum.') ',(int)$belum];



			
			$data['jml_rekomendasi'] = 'TOTAL : '.$jml_rek;
			$data['jml_temuan'] = 'TOTAL : '.$jml_temuan;




			$data['chart_rekomendasi'] 	= $chart_rek;
			$data['chart_temuan'] 		= $chart_temuan;


			if ($tipe=='prov' || $tipe=='kab') {

				$sql3 = "SELECT t.kd_temuan,t.judul_temuan,t.nilai_temuan, 
				(SELECT IFNULL(SUM(nilai_setor),0) as nilai_setor FROM trd_tlhp_pemda_temuan_lamp 
				where noreg = t.noreg and kd_temuan = t.kd_temuan)  as setoran FROM trd_tlhp_pemda_temuan t
				WHERE t.noreg = '".$noreg."'
				GROUP BY t.kd_temuan";
			}else if ($tipe=='kemendagri') {
				$sql3 = "SELECT t.kd_temuan,t.judul_temuan,t.nilai_temuan, 
				(SELECT IFNULL(SUM(nilai_setor),0) as nilai_setor FROM trd_tlhp_kemendagri_temuan_lamp 
				where noreg = t.noreg and kd_temuan = t.kd_temuan)  as setoran FROM trd_tlhp_kemendagri_temuan t
				WHERE t.noreg = '".$noreg."'
				GROUP BY t.kd_temuan";
			}else{
				$sql3 = "SELECT t.kd_temuan,t.judul_temuan,t.nilai_temuan, 
				(SELECT IFNULL(SUM(nilai_setor),0) as nilai_setor FROM trd_tlhp_kemendagri_temuan_lamp 
				where noreg = t.noreg and kd_temuan = t.kd_temuan)  as setoran FROM trd_tlhp_kemendagri_temuan t
				WHERE left(t.noreg,4) = '".$tahun."'
				GROUP BY t.kd_temuan
				union all
				SELECT t.kd_temuan,t.judul_temuan,t.nilai_temuan, 
				(SELECT IFNULL(SUM(nilai_setor),0) as nilai_setor FROM trd_tlhp_pemda_temuan_lamp 
				where noreg = t.noreg and kd_temuan = t.kd_temuan)  as setoran FROM trd_tlhp_pemda_temuan t
				WHERE left(t.noreg,4) = '".$tahun."'
				GROUP BY t.kd_temuan
				";
			}
			

			$res_nilai = $this->db->query($sql3)->result();
			$arr_nilai = array();
			$arr_nama = array();
			$arr_setor = array();
			$tot_nilai =0;
			
			foreach ($res_nilai as $value3) {

				// $arr_nilai[] = ((int)$value3->nilai_temuan)/1000000;
				$arr_nilai[] = number_format(($value3->nilai_temuan/1000000),2,",",".");
				$arr_nama[] = $value3->judul_temuan;
				$arr_setor[] = ((int)$value3->setoran)/1000000;
				$tot_nilai = $tot_nilai + ($value3->nilai_temuan/1000000);
			}
			
			$data['nama'] 			= $arr_nama;
			$data['nilai_temuan'] 	= $arr_nilai;
			$data['nilai_setoran'] 	= $arr_setor;
			$data['jml_nilai_temuan'] = 'NILAI (Jt) : '.number_format($tot_nilai,2,",",".");;

			$data['judulPencarian'] 	= $namaDaerah;
	        echo json_encode($data);
		}
		public function mpdf()
		{
			$mpdf = new \Mpdf\Mpdf();
			$data['view'] = 'admin/dashboard/index';
			$html = $this->load->view('template/layout', $data,true);
			// $html = $this->load->view('mpdfView',[],true);
			$mpdf->WriteHTML($html);
			$mpdf->Output();
		}



	

		public function get_simpulan(){
			$ctahun = $this->input->post('ctahun');	
			$cinstansi = $this->input->post('cinstansi');	

			$data = $this->MDashboard->viewSimpulan($ctahun,$cinstansi);
			echo $data;
						
		}		





	}

?>	