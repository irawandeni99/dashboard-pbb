<?php
	class TlhpBpkDashboardModel extends CI_Model{

		function getdata_dashboard($type="", $balikan="", $p1="", $p2="",$p3="",$p4=""){
			$array = array();
			$where  = " WHERE 1=1 ";
			$where2  = " WHERE 1=1 ";
			$where3 = "";

			if($this->input->post('key')){
				$key = $this->input->post('key');
				$kat = $this->input->post('kat');
				$where .= " AND LOWER(".$kat.") like '%".strtolower(trim($key))."%' ";
			}


			$is_admin = $this->session->userdata('is_admin');
			if ($is_admin == 1) {
				$daerah = $this->session->userdata('id_prov');
			}else if ($is_admin == 2) {
				$daerah = $this->session->userdata('id_kab');
			}else if ($is_admin == 3) {
				$daerah = $this->session->userdata('id_kab');
			}

			switch($type){
				
				case 'data_temuan_grouping':
				case 'data_temuan':
				case 'data_temuan_sts':
				case 'data_chart_sts_rekom':
					$thn = $this->input->post('tahun');
					$id_instansi = $this->input->post('id_instansi');
					$group = $this->input->post('group');

					if ($group) {
						$where .= "
						AND A.nm_group = '".$group."'
						";
					}
					// if ($thn) {
					// 	$where .= "
					// 	AND B.tahun = '".$thn."'
					// 	";
					// }
					if ($id_instansi) {
						$where .= "
						AND A.id_instansi = '".$id_instansi."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
					}


					if ($type == 'data_temuan') {
						$group = "GROUP BY A.id_instansi";
					}else if($type == 'data_temuan_grouping'){
						$group = "GROUP BY A.group";
					}else if($type == 'data_temuan_sts'){
						if ($is_admin == 1) {
							$where .= "
							AND A.flag NOT IN (2,3)
							";
						}
						$group = "GROUP BY A.id_instansi";
						// $group = "GROUP BY A.group";
					}else if($type == 'data_chart_sts_rekom'){
						$group = "GROUP BY A.id_instansi";
					}else{
						$group = "GROUP BY A.id_instansi";
					}


					// $sql ="
					// 	SELECT A.id_instansi, A.nm_instansi, A.flag, A.group, A.nm_group, B.noreg, B.id_instansi as instansi, B.tahun, B.no_lhp, B.tgl_lhp, 
					// 	COALESCE(SUM(B.jml_temuan), 0) as jml_temuan,
					// 	COALESCE(SUM(B.jml_rekomendasi), 0) as jml_rekomendasi
					// 	FROM ms_instansi_kemendagri A
					// 	LEFT JOIN(
					// 		SELECT * FROM viewlapform1
					// 		WHERE tahun = '".$thn."'
					// 	)B ON A.id_instansi=B.id_instansi
					// 	$where
					// 	$group 
					// 	ORDER BY jml_temuan DESC
					// ";

					$sql = "
						SELECT A.*, B.noreg,B.no_lhp,B.tahun, COALESCE(SUM(B.jml_temuan), 0) AS jml_temuan, 
						COALESCE(SUM(B.jml_rekomendasi), 0) AS jml_rekomendasi, 
						COALESCE(SUM(B.nilai_temuan), 0) AS nilai_temuan, 
						COALESCE(SUM(B.nilai_rekomendasi), 0) AS jml_nilai_rekomendasi, 
						COALESCE(SUM(B.jml_setor), 0) AS jml_setor,
						COALESCE(SUM(B.jml_setor_1), 0) AS jml_setor_s,
						COALESCE(SUM(B.jml_setor_2), 0) AS jml_setor_bs,
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_setor_bd,
						COALESCE(SUM(B.jml_setor_4), 0) AS jml_setor_tptd, 
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_nilai_sisa, 
						COALESCE(SUM(B.nilai_lebih), 0) AS jml_nilai_lebih, 
						ROUND((COALESCE (SUM(B.jml_setor), 0) / COALESCE (SUM(B.nilai_temuan), 0))*100,2) AS persentase 
						FROM 
							ms_instansi_kemendagri A 
						LEFT JOIN 
							(SELECT RIGHT (noreg, 4) AS id, noreg,no_lhp,tahun,sum(nilai_temuan_satker) as nilai_temuan, 
								sum(nilai_rek) as nilai_rekomendasi, sum(nilai_set) as jml_setor, 
								sum(nilai_set_1) as jml_setor_1,sum(nilai_set_2) as jml_setor_2,
								sum(nilai_set_3) as jml_setor_3,sum(nilai_set_4) as jml_setor_4, 
								sum(jmlsisa) as nilai_sisa, sum(jmllebih) as nilai_lebih, 
								count(tahun) AS jml_temuan, sum(jml_rekom) as jml_rekomendasi 
							FROM
								(SELECT t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan,t.nilai_temuan_satker,
									SUM(a.nilai_rekom) as nilai_rek, SUM(a.nilai_setor) as nilai_set,
									SUM(a.nilai_1) as nilai_set_1,SUM(a.nilai_2) as nilai_set_2,
									SUM(a.nilai_3) as nilai_set_3,SUM(a.nilai_4) as nilai_set_4,
									SUM(a.sisa) as jmlsisa,SUM(a.lebih) as jmllebih, count(nilai_rekom) as jml_rekom 
								FROM 
									trd_tlhp_bpklapkeu_temuan t 
								LEFT JOIN 
									(SELECT r.noreg,r.no_lhp,r.tahun,r.kd_temuan,r.kd_rekom,r.nilai_rekom,
										sum(nilai_1) as nilai_setor,
										CASE WHEN r.nilai_rekom < sum(nilai_1) THEN (r.nilai_rekom) 
										ELSE sum(nilai_1) END as nilai_1,sum(nilai_2) as nilai_2,
										sum(nilai_3) as nilai_3,sum(nilai_4) as nilai_4,
										CASE WHEN ISNULL(sum(nilai_1)) OR sum(nilai_1)=0 THEN r.nilai_rekom 
										WHEN r.nilai_rekom > sum(nilai_1) THEN (r.nilai_rekom - sum(nilai_1)) 
										ELSE 0 END as sisa,
										CASE WHEN sum(nilai_1) > r.nilai_rekom THEN (sum(nilai_1)-r.nilai_rekom) 
										ELSE 0 END as lebih
									FROM 
										trd_tlhp_bpklapkeu_rekomendasi r 
									LEFT JOIN 
										(SELECT noreg,no_lhp,kd_temuan,kd_rekomendasi,kd_tl,kd_lamp,status,nilai,
											CASE WHEN status = 1 THEN (nilai) 
											ELSE 0 END as nilai_1,
											CASE WHEN status = 2 THEN (nilai) 
											ELSE 0 END as nilai_2,
											CASE WHEN status = 3 THEN (nilai) 
											ELSE 0 END as nilai_3,
											CASE WHEN status = 4 THEN (nilai) 
											ELSE 0 END as nilai_4
										FROM trd_tlhp_bpklapkeu_tl_satker) s 
											on s.noreg = r.noreg AND r.no_lhp = s.no_lhp 
											AND r.kd_temuan = s.kd_temuan AND r.kd_rekom = s.kd_rekomendasi 
											GROUP BY r.noreg,r.no_lhp,r.kd_temuan,r.kd_rekom,r.nilai_rekom 
										) a 
										on a.noreg = t.noreg AND a.no_lhp = t.no_lhp AND t.tahun = a.tahun 
										AND t.kd_temuan = a.kd_temuan WHERE t.tahun = '".$thn."' 
										GROUP BY t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan
									) g 
							GROUP BY noreg 
							ORDER BY noreg
						)B ON A.id_instansi= B.id
						$where
						$group
						ORDER BY jml_temuan DESC
					";

					
				break;
				case 'data_temuan_tl':
					$thn = $this->input->post('tahun');
					$id_instansi = $this->input->post('id_instansi');

					if ($thn) {
						$where .= "
						AND (B.tahun = '".$thn."' OR B.tahun IS NULL)
						";
					}
					if ($id_instansi) {
						$where .= "
						AND A.id_instansi = '".$id_instansi."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
					}

					$sql ="
						SELECT A.id_instansi, A.nm_instansi, A.flag, A.`group`, B.noreg, A.nm_group, B.id_instansi as instansi, B.tahun, B.no_lhp, B.tgl_lhp,
						COALESCE(SUM(B.jml_temuan), 0) as jml_temuan,
						COALESCE(SUM(B.jml_rekomendasi), 0) as jml_rekomendasi,
						COALESCE(SUM(B.jml_tl), 0) as jml_tl
						FROM ms_instansi_kemendagri A
						LEFT JOIN(
							SELECT * FROM viewlapform3
							WHERE tahun = '".$thn."'
						)B ON A.id_instansi=B.id_instansi
						$where 
						GROUP BY A.`group`
						ORDER BY B.jml_temuan DESC
					";

					// echo $sql;exit;
				break;

				case 'nilai_temuan_pie':
					$thn = $this->input->post('tahun');
					$id_instansi = $this->input->post('id_instansi');

					if ($thn) {
						$where .= "
						AND A.tahun = '".$thn."'
						";
					}
					if ($id_instansi) {
						$where .= "
						AND A.id_instansi = '".$id_instansi."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
					}

					$sql ="
						SELECT
							A.id_instansi,
							A.nm_instansi,
							A.noreg,
							A.tahun,
							COALESCE (SUM(A.jml_nilai_all), 0) AS jml_nilai_kementerian,
							COALESCE (SUM(A.jml_nilai), 0) AS jml_nilai_satker,
							COALESCE (SUM(A.jml_setoran), 0) AS jml_setoran,

							(SELECT COALESCE(SUM(`trd_tlhp_bpklapkeu_tl_satker`.`nilai`), 0)
							FROM `trd_tlhp_bpklapkeu_tl_satker`
							LEFT JOIN trd_tlhp_bpklapkeu_tl_lamp ON `trd_tlhp_bpklapkeu_tl_satker`.`noreg` = trd_tlhp_bpklapkeu_tl_lamp.noreg
							AND `trd_tlhp_bpklapkeu_tl_satker`.`no_lhp` = trd_tlhp_bpklapkeu_tl_lamp.no_lhp
							AND `trd_tlhp_bpklapkeu_tl_satker`.`kd_tl` = trd_tlhp_bpklapkeu_tl_lamp.kd_tl
							WHERE ((`A`.`tahun` = LEFT(`trd_tlhp_bpklapkeu_tl_satker`.`noreg`,4))
							)) AS `nilai_setor_tl`

						FROM
						viewlapform2 A
						$where 
					";

					// echo $sql;exit;
				break;

				case 'nilai_temuan':
				case 'nilai_temuan_penyelesaian':
					$thn = $this->input->post('tahun');
					$id_instansi = $this->input->post('id_instansi');
					$flag = $this->input->post('flag');

					if ($thn) {
						$where .= "
						AND (B.tahun = '".$thn."' OR B.tahun IS NULL)
						";
					}
					if ($id_instansi) {
						$where .= "
						AND A.id_instansi = '".$id_instansi."'
						";
					}

					if ($flag) {
						$where .= "
						AND A.flag = '".$flag."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
					}

					if ($type == 'nilai_temuan') {
						$group = "GROUP BY A.id_instansi";
					}else if($type == 'nilai_temuan_penyelesaian'){
						$group = "GROUP BY A.group";
					}else{
						$group = "GROUP BY A.flag";
					}
					
					$sql ="
						SELECT A.id_instansi, A.nm_instansi, A.flag, A.group, A.nm_group, B.noreg, B.instansi, B.tahun, B.no_lhp, B.tgl_lhp, 
						COALESCE(SUM(B.jml_temuan), 0) as jml_temuan,
						COALESCE(SUM(B.jml_rekomendasi), 0) as jml_rekomendasi,
						COALESCE(SUM(B.jml_nilai), 0) as nilai_temuan,
						COALESCE(SUM(B.jml_setoran), 0) as nilai_tl,
						COALESCE(SUM(B.jml_nilai_rekomendasi), 0) as jml_nilai_rekomendasi,
						COALESCE(SUM(B.jml_s), 0) as jml_s,
						COALESCE(SUM(B.jml_bs), 0) as jml_bs,
						COALESCE(SUM(B.jml_bd), 0) as jml_bd,
						COALESCE(SUM(B.jml_tdtp), 0) as jml_tdtp,
						COALESCE(SUM(B.jml_nilai_s), 0) as jml_nilai_s,
						COALESCE(SUM(B.jml_nilai_bs), 0) as jml_nilai_bs,
						COALESCE(SUM(B.jml_nilai_bd), 0) as jml_nilai_bd,
						COALESCE(SUM(B.jml_nilai_tdtp), 0) as jml_nilai_tdtp,
						(COALESCE (SUM(B.jml_nilai), 0) - COALESCE (SUM(B.jml_setoran), 0)) AS jml_nilai_sisa,
						(COALESCE (SUM(B.jml_setoran), 0) / COALESCE (SUM(B.jml_nilai), 0))*100 AS persentase
						FROM ms_instansi_kemendagri A
						LEFT JOIN(
							SELECT 
								noreg,id_instansi AS instansi,tahun,no_lhp,kd_temuan,
								tgl_lhp,jml_temuan,jml_rekomendasi,
								COALESCE ((jml_nilai), 0) AS jml_nilai,
								COALESCE ((jml_setoran), 0) AS jml_setoran,
								COALESCE (SUM(jml_nilai_rekomendasi),0) AS jml_nilai_rekomendasi,
								jml_s,jml_bs,jml_bd,jml_tdtp,
								COALESCE (SUM(jml_nilai_s), 0) AS jml_nilai_s,
								COALESCE (SUM(jml_nilai_bs), 0) AS jml_nilai_bs,
								COALESCE (SUM(jml_nilai_bd), 0) AS jml_nilai_bd,
								COALESCE (SUM(jml_nilai_tdtp), 0) AS jml_nilai_tdtp 
							FROM view_dashboard
							GROUP BY id_instansi,noreg,no_lhp,kd_temuan
						)B ON A.id_instansi=B.instansi
						$where 
						$group
						ORDER BY jml_temuan DESC
					";



					// echo $sql;exit;
				break;
					// echo $sql;exit;
				break;
				case 'nilai_temuan_detail_sisa':
					$thn = $this->input->post('tahun');
					$id_instansi = $this->input->post('id_instansi');

					if ($thn) {
						$where .= "
						AND B.tahun = '".$thn."'
						";
					}
					if ($id_instansi) {
						$where .= "
						AND A.id_instansi = '".$id_instansi."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
					}

					$sql ="
						SELECT A.id_instansi, A.nm_instansi,
						B.noreg,
						B.tahun,
						COALESCE (SUM(B.jml_nilai_all), 0) AS jml_nilai_kementerian,
						COALESCE (SUM(B.jml_nilai), 0) AS jml_nilai_satker,
						COALESCE (SUM(B.jml_setoran), 0) AS jml_setoran,
						(COALESCE (SUM(B.jml_nilai_all), 0) - COALESCE (SUM(B.jml_setoran), 0)) AS jml_sisa,

						(SELECT COALESCE(SUM(`trd_tlhp_bpklapkeu_tl_satker`.`nilai`), 0)
						FROM `trd_tlhp_bpklapkeu_tl_satker`
						LEFT JOIN trd_tlhp_bpklapkeu_tl_lamp ON `trd_tlhp_bpklapkeu_tl_satker`.`noreg` = trd_tlhp_bpklapkeu_tl_lamp.noreg
						AND `trd_tlhp_bpklapkeu_tl_satker`.`no_lhp` = trd_tlhp_bpklapkeu_tl_lamp.no_lhp
						AND `trd_tlhp_bpklapkeu_tl_satker`.`kd_tl` = trd_tlhp_bpklapkeu_tl_lamp.kd_tl
						WHERE ((`B`.`noreg` = `trd_tlhp_bpklapkeu_tl_lamp`.`noreg`)
						AND (`B`.`no_lhp` = `trd_tlhp_bpklapkeu_tl_lamp`.`no_lhp`)
						AND (`B`.`kd_temuan` = `trd_tlhp_bpklapkeu_tl_lamp`.`kd_temuan`)
						)) AS `nilai_setor_tl`,

						(COALESCE (SUM(B.jml_nilai_all), 0) - COALESCE (((SELECT COALESCE(SUM(`trd_tlhp_bpklapkeu_tl_satker`.`nilai`), 0)
						FROM `trd_tlhp_bpklapkeu_tl_satker`
						LEFT JOIN trd_tlhp_bpklapkeu_tl_lamp ON `trd_tlhp_bpklapkeu_tl_satker`.`noreg` = trd_tlhp_bpklapkeu_tl_lamp.noreg
						AND `trd_tlhp_bpklapkeu_tl_satker`.`no_lhp` = trd_tlhp_bpklapkeu_tl_lamp.no_lhp
						AND `trd_tlhp_bpklapkeu_tl_satker`.`kd_tl` = trd_tlhp_bpklapkeu_tl_lamp.kd_tl
						WHERE ((`B`.`noreg` = `trd_tlhp_bpklapkeu_tl_lamp`.`noreg`)
						AND (`B`.`no_lhp` = `trd_tlhp_bpklapkeu_tl_lamp`.`no_lhp`)
						AND (`B`.`kd_temuan` = `trd_tlhp_bpklapkeu_tl_lamp`.`kd_temuan`)
						))), 0)) AS nilai_sisa_tl

						FROM ms_instansi_kemendagri A
						LEFT JOIN(
							SELECT * FROM viewlapform2
							WHERE tahun = '".$thn."'
						)B ON A.id_instansi=B.id_instansi
						$where 
						GROUP BY A.id_instansi
						ORDER BY jml_nilai_kementerian DESC
					";

					// echo $sql;exit;
				break;

				case 'data_temuan_lvl1':
					$thn = $this->input->post('tahun');
					$id_instansi = $this->input->post('id_instansi');
					$filter = $this->input->post('filter');

					if ($thn) {
						$where .= "
						AND (B.tahun = '".$thn."' OR B.tahun IS NULL)
						";
					}
					if ($id_instansi) {
						$where .= "
						AND A.id_instansi = '".$id_instansi."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
					}

					if ($filter) {
						if ($filter == "thn") {
							$group = "GROUP BY A.id_instansi"; 
						}else if ($filter == "thn_all") {
							$group = "GROUP BY B.tahun";
						}else if ($filter == "satker") {
							$group = "GROUP BY A.id_instansi";
						}else{
							$group = "";
						}
					}

					$sql ="
						SELECT A.id_instansi, A.nm_instansi, B.noreg, B.instansi, B.tahun, B.no_lhp, B.tgl_lhp, 
						COALESCE(SUM(B.jml_temuan), 0) as jml_temuan,
						COALESCE(SUM(B.jml_rekomendasi), 0) as jml_rekomendasi,
						COALESCE(SUM(B.jml_nilai), 0) as nilai_temuan,
						COALESCE(SUM(B.jml_setoran), 0) as nilai_tl,
						COALESCE(SUM(B.jml_nilai_rekomendasi), 0) as jml_nilai_rekomendasi,
						COALESCE(SUM(B.jml_s), 0) as jml_s,
						COALESCE(SUM(B.jml_bs), 0) as jml_bs,
						COALESCE(SUM(B.jml_bd), 0) as jml_bd,
						COALESCE(SUM(B.jml_tdtp), 0) as jml_tdtp,
						COALESCE(SUM(B.jml_nilai_s), 0) as jml_nilai_s,
						COALESCE(SUM(B.jml_nilai_bs), 0) as jml_nilai_bs,
						COALESCE(SUM(B.jml_nilai_bd), 0) as jml_nilai_bd,
						COALESCE(SUM(B.jml_nilai_tdtp), 0) as jml_nilai_tdtp
						FROM ms_instansi_kemendagri A
						LEFT JOIN(
							SELECT 
								noreg,id_instansi AS instansi,tahun,no_lhp,
								tgl_lhp,jml_temuan,jml_rekomendasi,
								COALESCE (SUM(jml_nilai), 0) AS jml_nilai,
								COALESCE (SUM(jml_setoran), 0) AS jml_setoran,
								COALESCE (SUM(jml_nilai_rekomendasi),0) AS jml_nilai_rekomendasi,
								jml_s,jml_bs,jml_bd,jml_tdtp,
								COALESCE (SUM(jml_nilai_s), 0) AS jml_nilai_s,
								COALESCE (SUM(jml_nilai_bs), 0) AS jml_nilai_bs,
								COALESCE (SUM(jml_nilai_bd), 0) AS jml_nilai_bd,
								COALESCE (SUM(jml_nilai_tdtp), 0) AS jml_nilai_tdtp 
							FROM view_dashboard
							GROUP BY id_instansi,noreg,no_lhp
						)B ON A.id_instansi=B.instansi
						$where 
						$group
						ORDER BY jml_temuan DESC
					";



					// echo $sql;exit;
				break;

				case 'data_temuan_lvl2':
					$thn = $this->input->post('tahun');
					$id_instansi = $this->input->post('id_instansi');
					$filter = $this->input->post('filter');

					if ($thn) {
						$where .= "
						AND A.tahun = '".$thn."'
						";
					}

					if ($id_instansi) {
						$where2 .= "
						AND A.id_instansi = '".$id_instansi."'
						";
					}

					if ($p1) {
						$where .= "
						AND A.id_instansi = '".$p1."'
						";

						$where2 .= "
						AND A.id_instansi = '".$p1."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";

						$where2 .= "
						AND A.id_instansi = '".$daerah."'
						";
					}

					if ($filter) {
						if ($filter == "thn") {
							$group = "GROUP BY A.no_lhp, A.id_aspek"; 
						}else if ($filter == "thn_all") {
							$group = "GROUP BY A.id_instansi";
						}else if ($filter == "satker") {
							if ($thn) {
								$where2 .= "
								AND B.tahun = '".$thn."'
								";
							}
							$group = "GROUP BY A.id_instansi,B.tahun";
						}else{
							$group = "";
						}
					}
					if ($filter == "thn_all" || $filter == "satker") {
						$sql ="
							SELECT A.id_instansi, A.nm_instansi, B.noreg, B.instansi, B.tahun, B.no_lhp, B.tgl_lhp, 
							COALESCE(SUM(B.jml_temuan), 0) as jml_temuan,
							COALESCE(SUM(B.jml_rekomendasi), 0) as jml_rekomendasi,
							COALESCE(SUM(B.jml_nilai), 0) as nilai_temuan,
							COALESCE(SUM(B.jml_setoran), 0) as nilai_tl,
							COALESCE(SUM(B.jml_nilai_rekomendasi), 0) as jml_nilai_rekomendasi,
							COALESCE(SUM(B.jml_s), 0) as jml_s,
							COALESCE(SUM(B.jml_bs), 0) as jml_bs,
							COALESCE(SUM(B.jml_bd), 0) as jml_bd,
							COALESCE(SUM(B.jml_tdtp), 0) as jml_tdtp,
							COALESCE(SUM(B.jml_nilai_s), 0) as jml_nilai_s,
							COALESCE(SUM(B.jml_nilai_bs), 0) as jml_nilai_bs,
							COALESCE(SUM(B.jml_nilai_bd), 0) as jml_nilai_bd,
							COALESCE(SUM(B.jml_nilai_tdtp), 0) as jml_nilai_tdtp
							FROM ms_instansi_kemendagri A
							LEFT JOIN(
							SELECT
								noreg,id_instansi AS instansi,tahun,no_lhp,
								tgl_lhp,jml_temuan,jml_rekomendasi,
								COALESCE (SUM(jml_nilai), 0) AS jml_nilai,
								COALESCE (SUM(jml_setoran), 0) AS jml_setoran,
								COALESCE (SUM(jml_nilai_rekomendasi),0) AS jml_nilai_rekomendasi,
								jml_s,jml_bs,jml_bd,jml_tdtp,
								COALESCE (SUM(jml_nilai_s), 0) AS jml_nilai_s,
								COALESCE (SUM(jml_nilai_bs), 0) AS jml_nilai_bs,
								COALESCE (SUM(jml_nilai_bd), 0) AS jml_nilai_bd,
								COALESCE (SUM(jml_nilai_tdtp), 0) AS jml_nilai_tdtp  
							FROM view_dashboard
							WHERE tahun = '".$thn."'
							GROUP BY id_instansi,noreg,no_lhp
							)B ON A.id_instansi=B.instansi
							$where2
							$group
							ORDER BY jml_temuan DESC
						";
					}else{
						$sql ="
							SELECT A.id_instansi, A.nm_instansi, A.noreg, A.tahun, A.no_lhp, A.tgl_lhp, 
							COALESCE((A.jml_temuan), 0) as jml_temuan,
							COALESCE((A.jml_rekomendasi), 0) as jml_rekomendasi,
							COALESCE(SUM(A.jml_nilai), 0) as nilai_temuan,
							COALESCE(SUM(A.jml_setoran), 0) as nilai_tl,
							COALESCE(SUM(A.jml_nilai_rekomendasi), 0) as jml_nilai_rekomendasi,
							COALESCE((A.jml_s), 0) as jml_s,
							COALESCE((A.jml_bs), 0) as jml_bs,
							COALESCE((A.jml_bd), 0) as jml_bd,
							COALESCE((A.jml_tdtp), 0) as jml_tdtp,
							COALESCE((A.jml_nilai_s), 0) as jml_nilai_s,
							COALESCE((A.jml_nilai_bs), 0) as jml_nilai_bs,
							COALESCE((A.jml_nilai_bd), 0) as jml_nilai_bd,
							COALESCE((A.jml_nilai_tdtp), 0) as jml_nilai_tdtp
							FROM view_dashboard A
							$where 
							$group
						
						";
					}

					// echo $sql;exit;
				break;

				case 'data_temuan_detail_lvl2':
					
					$sql="
						SELECT *,
							CASE
								WHEN jml_tl = 0 THEN 'BD'
								WHEN jml_tl = ms.s THEN 'S'
								WHEN tdtp 	> 0 THEN 'TDTP'
								WHEN jml_tl = ms.bd THEN 'BD'
							ELSE 'BS'
							END as sts_rekom
						FROM(
						SELECT kd_rekom,
						(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpklapkeu_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A') as jml_tl,
						(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpklapkeu_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND status = 'SESUAI') as s,
						(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpklapkeu_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND status = 'BELUM SESUAI') as bs,
						(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpklapkeu_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND status = 'BELUM DITINDAKLANJUTI') as bd,
						(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpklapkeu_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND status = 'TIDAK DAPAT DITINDAKLANJUTI') as tdtp
						FROM trd_tlhp_bpklapkeu_rekomendasi rk
						WHERE noreg = '".$p1."' and no_lhp = '".$p2."'
						) ms;
					";
					// echo $sql;exit;
				break;

				case 'data_nilai_penyelesaian':
					$thn = $this->input->post('tahun');
					$id_instansi = $this->input->post('id_instansi');

					if ($thn) {
						$where .= "
						AND (B.tahun = '".$thn."' OR B.tahun IS NULL)
						";

						$where2 .= "
						AND A.tahun = '".$thn."'
						";
					}
					if ($id_instansi) {
						$where .= "
						AND A.id_instansi = '".$id_instansi."'
						";

						$where2 .= "
						AND A.id_instansi = '".$id_instansi."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
						$where2 .= "
						AND A.id_instansi = '".$daerah."'
						";
					}


					$sql = "
						SELECT A.*,B.noreg, B.no_lhp, B.id_instansi AS instansi, B.pic_itjen, 
							B.tahun, B.tgl_lhp, B.uraian_lhp,
							B.kd_temuan, B.id_aspek, B.kd_rekom,
							B.jml_temuan, B.jml_rekomendasi,
							B.jml_tl, B.nilai_temuan_kementerian,
							B.nilai_temuan_satker, B.nilai_rekomendasi,
							B.nilai_setor_tl
						FROM ms_instansi_kemendagri A
						LEFT JOIN(					
							SELECT A.noreg, A.no_lhp, A.id_instansi,A.pic_itjen, A.tahun, A.tgl_lhp, A.uraian_lhp,
							B.kd_temuan, B.id_aspek, D.kd_rekom,
							(SELECT count(`trd_tlhp_bpklapkeu_temuan`.`noreg`)
							FROM `trd_tlhp_bpklapkeu_temuan`
							WHERE ((`A`.`noreg` = `trd_tlhp_bpklapkeu_temuan`.`noreg`)
							AND (`A`.`no_lhp` = `trd_tlhp_bpklapkeu_temuan`.`no_lhp`)
							)) AS `jml_temuan`,

							(SELECT count(`trd_tlhp_bpklapkeu_rekomendasi`.`noreg`)
							FROM `trd_tlhp_bpklapkeu_rekomendasi`
							WHERE ((`A`.`noreg` = `trd_tlhp_bpklapkeu_rekomendasi`.`noreg`)
							AND (`A`.`no_lhp` = `trd_tlhp_bpklapkeu_rekomendasi`.`no_lhp`)
							AND (`B`.`id_aspek` = `trd_tlhp_bpklapkeu_rekomendasi`.`id_aspek`)
							)) AS `jml_rekomendasi`,

							(SELECT count(`trd_tlhp_bpklapkeu_tl_lamp`.`noreg`)
							FROM `trd_tlhp_bpklapkeu_tl_lamp`
							WHERE ((`D`.`noreg` = `trd_tlhp_bpklapkeu_tl_lamp`.`noreg`)
							AND (`D`.`no_lhp` = `trd_tlhp_bpklapkeu_tl_lamp`.`no_lhp`)
							AND (`D`.`kd_temuan` = `trd_tlhp_bpklapkeu_tl_lamp`.`kd_temuan`)
							)) AS `jml_tl`,

							(SELECT COALESCE(SUM(`trd_tlhp_bpklapkeu_temuan`.`nilai_temuan`), 0)
							FROM `trd_tlhp_bpklapkeu_temuan`
							WHERE ((`A`.`noreg` = `trd_tlhp_bpklapkeu_temuan`.`noreg`)
							AND (`A`.`no_lhp` = `trd_tlhp_bpklapkeu_temuan`.`no_lhp`)
							AND (`B`.`kd_temuan` = `trd_tlhp_bpklapkeu_temuan`.`kd_temuan`)
							)) AS `nilai_temuan_kementerian`,

							(SELECT COALESCE(SUM(`trd_tlhp_bpklapkeu_temuan`.`nilai_temuan_satker`), 0)
							FROM `trd_tlhp_bpklapkeu_temuan`
							WHERE ((`A`.`noreg` = `trd_tlhp_bpklapkeu_temuan`.`noreg`)
							AND (`A`.`no_lhp` = `trd_tlhp_bpklapkeu_temuan`.`no_lhp`)
							AND (`B`.`kd_temuan` = `trd_tlhp_bpklapkeu_temuan`.`kd_temuan`)
							)) AS `nilai_temuan_satker`,

							(SELECT COALESCE(SUM(`trd_tlhp_bpklapkeu_rekomendasi`.`nilai_rekom`), 0)
							FROM `trd_tlhp_bpklapkeu_rekomendasi`
							WHERE ((`A`.`noreg` = `trd_tlhp_bpklapkeu_rekomendasi`.`noreg`)
							AND (`A`.`no_lhp` = `trd_tlhp_bpklapkeu_rekomendasi`.`no_lhp`)
							AND (`B`.`id_aspek` = `trd_tlhp_bpklapkeu_rekomendasi`.`id_aspek`)
							)) AS `nilai_rekomendasi`,

							(SELECT COALESCE(SUM(`trd_tlhp_bpklapkeu_tl_satker`.`nilai`), 0)
							FROM `trd_tlhp_bpklapkeu_tl_satker`
							LEFT JOIN trd_tlhp_bpklapkeu_tl_lamp ON `trd_tlhp_bpklapkeu_tl_satker`.`noreg` = trd_tlhp_bpklapkeu_tl_lamp.noreg
							AND `trd_tlhp_bpklapkeu_tl_satker`.`no_lhp` = trd_tlhp_bpklapkeu_tl_lamp.no_lhp
							AND `trd_tlhp_bpklapkeu_tl_satker`.`kd_tl` = trd_tlhp_bpklapkeu_tl_lamp.kd_tl
							WHERE ((`D`.`noreg` = `trd_tlhp_bpklapkeu_tl_lamp`.`noreg`)
							AND (`D`.`no_lhp` = `trd_tlhp_bpklapkeu_tl_lamp`.`no_lhp`)
							AND (`D`.`kd_temuan` = `trd_tlhp_bpklapkeu_tl_lamp`.`kd_temuan`)
							)) AS `nilai_setor_tl`

							FROM trh_tlhp_bpklapkeu A
							LEFT JOIN trd_tlhp_bpklapkeu_temuan B ON A.noreg = B.noreg AND A.no_lhp = B.no_lhp
							LEFT JOIN trd_tlhp_bpklapkeu_rekomendasi D ON B.noreg = D.noreg AND B.no_lhp = D.no_lhp AND B.id_aspek = D.id_aspek
							LEFT JOIN trd_tlhp_bpklapkeu_tl_lamp E ON E.noreg = D.noreg AND E.no_lhp = D.no_lhp AND E.kd_rekomendasi = D.kd_rekom
							GROUP BY A.noreg
						)B ON A.id_instansi = B.id_instansi	
						$where
						GROUP BY A.id_instansi
						ORDER BY B.nilai_setor_tl DESC
					";

					 // echo $sql;exit;

					
				break;
				case 'data_temuan_jumlah':
				case 'data_temuan_bygroup_chart':
				case 'data_temuan_bygroup_sisa':
				case 'data_temuan_bygroup_persen':
				case 'data_temuan_bygroup':
				case 'data_temuan_bygroup_struktur':
				case 'data_temuan_bygroup_kmdgri':
				case 'data_temuan_bygroup_bnpp':
				case 'data_temuan_bygroup_dkpp':
					$thn = $this->input->post('tahun');
					$id_instansi = $this->input->post('id_instansi');
					$flag = $this->input->post('flag');
					$group = $this->input->post('group');
					
					if ($id_instansi) {
						$where .= "
						AND A.id_instansi = '".$id_instansi."'
						";
					}

					if ($flag) {
						$where .= "
						AND A.flag = '".$flag."'
						";
					}
					if ($group) {
						$where .= "
						AND A.nm_group = '".$group."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
					}

					if ($type == 'data_temuan_jumlah') {
						$where .= "
						AND B.noreg IS NOT NULL
						";
						$group = "GROUP BY A.flag";
					}else if($type == 'data_temuan_bygroup_kmdgri'){
						if ($is_admin == 1) {
							$where .= "
							AND nilai_temuan != 0
							AND A.flag NOT IN(2,3) 
							";
						}else{
							$where .= "
							AND nilai_temuan != 0
							";
						}
						
						$group = "GROUP BY A.group";
						$order = "ORDER BY nilai_temuan DESC";

					}else if($type == 'data_temuan_bygroup_bnpp'){
						if ($is_admin == 1) {
							$where .= "
							AND nilai_temuan != 0
							AND A.flag = 2 
							";
						}else{
							$where .= "
							AND nilai_temuan != 0
							";
						}
						
						$group = "GROUP BY A.group";
						$order = "ORDER BY nilai_temuan DESC";

					}else if($type == 'data_temuan_bygroup_dkpp'){
						if ($is_admin == 1) {
							$where .= "
							AND nilai_temuan != 0
							AND A.flag = 3 
							";
						}else{
							$where .= "
							AND nilai_temuan != 0
							";
						}
						
						$group = "GROUP BY A.group";
						$order = "ORDER BY nilai_temuan DESC";

					}else if($type == 'data_temuan_bygroup'){
						$where .= "
						AND nilai_temuan != 0
						AND A.group NOT IN (13,14)
						";
						$group = "GROUP BY A.group";
						$order = "ORDER BY nilai_temuan DESC";

					}else if($type == 'data_temuan_bygroup_struktur'){
						$where .= "
						AND A.group NOT IN (13,14)
						";
						$group = "GROUP BY A.group";
						$order = "ORDER BY A.group ASC";

					}else if($type == 'data_temuan_bygroup_persen'){
						
						if ($is_admin == 1) {
							$where .= "
							AND nilai_temuan != 0
							AND A.group NOT IN (13,14)
							";
						}else{
							$where .= "
							AND nilai_temuan != 0
							";
						}

						$group = "GROUP BY A.group";
						$order = "ORDER BY persentase DESC,A.group ASC";

					}else if($type == 'data_temuan_bygroup_sisa'){
						$where .= "
						AND nilai_temuan != 0
						";
						$group = "GROUP BY A.group";

					}else if($type == 'data_temuan_bygroup_chart'){
						$order = "ORDER BY nilai_temuan DESC";
						$group = "GROUP BY A.id_instansi";
					}else{
						$where .= "
						AND B.noreg IS NOT NULL
						";
						$group = "GROUP BY A.flag";
					}


					$sql = "
						SELECT A.*, B.noreg,B.no_lhp,B.tahun, COALESCE(SUM(B.jml_temuan), 0) AS jml_temuan, 
						COALESCE(SUM(B.jml_rekomendasi), 0) AS jml_rekomendasi, 
						COALESCE(SUM(B.nilai_temuan), 0) AS nilai_temuan, 
						COALESCE(SUM(B.nilai_rekomendasi), 0) AS jml_nilai_rekomendasi, 
						COALESCE(SUM(B.jml_setor), 0) AS jml_setor,
						COALESCE(SUM(B.jml_setor_1), 0) AS jml_setor_s,
						COALESCE(SUM(B.jml_setor_2), 0) AS jml_setor_bs,
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_setor_bd,
						COALESCE(SUM(B.jml_setor_4), 0) AS jml_setor_tptd, 
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_nilai_sisa, 
						COALESCE(SUM(B.nilai_lebih), 0) AS jml_nilai_lebih, 
						CASE WHEN ROUND((COALESCE (SUM(B.jml_setor), 0) / COALESCE (SUM(B.nilai_temuan), 0))*100,2) > 100 THEN 100
						ELSE ROUND((COALESCE (SUM(B.jml_setor), 0) / COALESCE (SUM(B.nilai_temuan), 0))*100,2)
						END AS persentase 
						FROM 
							ms_instansi_kemendagri A 
						LEFT JOIN 
							(SELECT RIGHT (noreg, 4) AS id, noreg,no_lhp,tahun,sum(nilai_temuan_satker) as nilai_temuan, 
								sum(nilai_rek) as nilai_rekomendasi, sum(nilai_set) as jml_setor, 
								sum(nilai_set_1) as jml_setor_1,sum(nilai_set_2) as jml_setor_2,
								sum(nilai_set_3) as jml_setor_3,sum(nilai_set_4) as jml_setor_4, 
								sum(jmlsisa) as nilai_sisa, sum(jmllebih) as nilai_lebih, 
								count(tahun) AS jml_temuan, sum(jml_rekom) as jml_rekomendasi 
							FROM
								(SELECT t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan,t.nilai_temuan_satker,
									SUM(a.nilai_rekom) as nilai_rek, SUM(a.nilai_setor) as nilai_set,
									SUM(a.nilai_1) as nilai_set_1,SUM(a.nilai_2) as nilai_set_2,
									SUM(a.nilai_3) as nilai_set_3,SUM(a.nilai_4) as nilai_set_4,
									SUM(a.sisa) as jmlsisa,SUM(a.lebih) as jmllebih, count(nilai_rekom) as jml_rekom 
								FROM 
									trd_tlhp_bpklapkeu_temuan t 
								LEFT JOIN 
									(SELECT r.noreg,r.no_lhp,r.tahun,r.kd_temuan,r.kd_rekom,r.nilai_rekom,
										sum(nilai_1) as nilai_setor,
										CASE WHEN r.nilai_rekom < sum(nilai_1) THEN (r.nilai_rekom) 
										ELSE sum(nilai_1) END as nilai_1,sum(nilai_2) as nilai_2,
										sum(nilai_3) as nilai_3,sum(nilai_4) as nilai_4,
										CASE WHEN ISNULL(sum(nilai_1)) OR sum(nilai_1)=0 THEN r.nilai_rekom 
										WHEN r.nilai_rekom > sum(nilai_1) THEN (r.nilai_rekom - sum(nilai_1)) 
										ELSE 0 END as sisa,
										CASE WHEN sum(nilai_1) > r.nilai_rekom THEN (sum(nilai_1)-r.nilai_rekom) 
										ELSE 0 END as lebih
									FROM 
										trd_tlhp_bpklapkeu_rekomendasi r 
									LEFT JOIN 
										(SELECT noreg,no_lhp,kd_temuan,kd_rekomendasi,kd_tl,kd_lamp,status,nilai,
											CASE WHEN status = 1 THEN (nilai) 
											ELSE 0 END as nilai_1,
											CASE WHEN status = 2 THEN (nilai) 
											ELSE 0 END as nilai_2,
											CASE WHEN status = 3 THEN (nilai) 
											ELSE 0 END as nilai_3,
											CASE WHEN status = 4 THEN (nilai) 
											ELSE 0 END as nilai_4
										FROM trd_tlhp_bpklapkeu_tl_satker) s 
											on s.noreg = r.noreg AND r.no_lhp = s.no_lhp 
											AND r.kd_temuan = s.kd_temuan AND r.kd_rekom = s.kd_rekomendasi 
											GROUP BY r.noreg,r.no_lhp,r.kd_temuan,r.kd_rekom,r.nilai_rekom 
										) a 
										on a.noreg = t.noreg AND a.no_lhp = t.no_lhp AND t.tahun = a.tahun 
										AND t.kd_temuan = a.kd_temuan WHERE t.tahun = '".$thn."' 
										GROUP BY t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan
									) g 
							GROUP BY noreg 
							ORDER BY noreg
						)B ON A.id_instansi= B.id
						$where
						$group
						$order
					";

					// echo $sql;exit;
				break;

				case 'data_temuan_detail_sts_chart':
				case 'data_temuan_detail_sts_chart_lv2':
					$thn = $this->input->post('tahun');

					// $where .= "
					// AND noreg = '".$p1."' AND no_lhp = '".$p2."'
					// "; 
					if ($type == 'data_temuan_detail_sts_chart_lv2') {
						 // $where .= "
						 // AND noreg = '".$p1."' AND no_lhp = '".$p2."'
						 // ";

						$where .= "
						AND noreg IN (SELECT viewlapform1.noreg FROM viewlapform1
						WHERE viewlapform1.`noreg` =  '".$p1."' AND viewlapform1.tahun ='".$thn."'
						group by viewlapform1.noreg,viewlapform1.no_lhp
						)

						AND no_lhp IN (SELECT viewlapform1.no_lhp FROM viewlapform1
						WHERE viewlapform1.`noreg` =  '".$p1."'AND viewlapform1.tahun ='".$thn."'
						group by viewlapform1.noreg,viewlapform1.no_lhp
						)
						";

						 $where2 .= "
						 ";
					}else{

						 // $where .= "
						 // AND noreg = '".$p1."' AND no_lhp = '".$p2."'
						 // ";

						$where .= "
						AND noreg IN (SELECT viewlapform1.noreg FROM viewlapform1
						WHERE viewlapform1.`noreg` =  '".$p1."' AND viewlapform1.tahun ='".$thn."'
						group by viewlapform1.noreg,viewlapform1.no_lhp
						)

						AND no_lhp IN (SELECT viewlapform1.no_lhp FROM viewlapform1
						WHERE viewlapform1.`noreg` =  '".$p1."'AND viewlapform1.tahun ='".$thn."'
						group by viewlapform1.noreg,viewlapform1.no_lhp
						)
						";
						$where2 .= "
						";
					}
					

		
					
					$group = "GROUP BY kd_rekom"; 

					$sql="
						SELECT *,
							CASE
								WHEN jml_tl = 0 THEN 'BD'
								WHEN jml_tl = ms.s THEN 'S'
								WHEN tdtp 	> 0 THEN 'TDTP'
								WHEN jml_tl = ms.bd THEN 'BD'
							ELSE 'BS'
							END as sts_rekom
						FROM(SELECT RIGHT(noreg,4) AS id, kd_rekom, noreg, no_lhp, tahun,
							(SELECT `ms_instansi_kemendagri`.`group`
								FROM `ms_instansi_kemendagri`
								WHERE (RIGHT(noreg,4) = `ms_instansi_kemendagri`.`id_instansi`)) AS `group`,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpklapkeu_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A') as jml_tl,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpklapkeu_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'SESUAI') as s,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpklapkeu_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'BELUM SESUAI') as bs,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpklapkeu_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'BELUM DITINDAKLANJUTI') as bd,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpklapkeu_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'TIDAK DAPAT DITINDAKLANJUTI') as tdtp,

							(SELECT COALESCE (sum(b.nilai), 0)
								FROM trd_tlhp_bpklapkeu_tl_lamp a
								LEFT JOIN trd_tlhp_bpklapkeu_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND a.`status` = 'SESUAI'
							) AS nilai_s,
							(SELECT COALESCE (sum(b.nilai), 0)
								FROM trd_tlhp_bpklapkeu_tl_lamp a
								LEFT JOIN trd_tlhp_bpklapkeu_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND a.`status` = 'BELUM SESUAI'
							) AS nilai_bs,
							(SELECT COALESCE (sum(b.nilai), 0)
								FROM trd_tlhp_bpklapkeu_tl_lamp a
								LEFT JOIN trd_tlhp_bpklapkeu_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND a.`status` = 'BELUM DITINDAKLANJUTI'
							) AS nilai_bd,
							(SELECT COALESCE (sum(b.nilai), 0) 
								FROM trd_tlhp_bpklapkeu_tl_lamp a
								LEFT JOIN trd_tlhp_bpklapkeu_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND a.`status` = 'TIDAK DAPAT DITINDAKLANJUTI'
							) AS nilai_tdtp

							FROM trd_tlhp_bpklapkeu_rekomendasi rk
							$where
							$group
						) ms
						$where2
						;
					";
					// echo $sql;exit;
				break;

				case 'data_temuan_detail_head':
				case 'data_temuan_detail':
					$filter = $this->input->post('filter');
					$thn_end = $this->input->post('tahun_end');

					if ($type == "data_temuan_detail_head") {
						if ($filter) {
							if ($filter == "thn") {
								$where .= "
								AND noreg = '".$p1."'
								"; 
								$group = "GROUP BY kd_rekom";
							}else if ($filter == "thn_all") {
								if ($thn_end != "") {
									$where .= "
									AND LEFT(noreg,4) = '".$p3."'
									AND tahun BETWEEN '".$p3."' AND '".$thn_end."'
									";
								}else{
									$where .= "
									AND LEFT(noreg,4) = '".$p3."'
									AND tahun ='".$p3."'
									";
								}
								
								$group ="";
							}else if ($filter == "satker") {
								$where .= "
								AND noreg = '".$p1."'
								";

								$group = "GROUP BY kd_rekom";
							}else{
								$where .= "

								";
								$group ="";
							}
						}else{
							$where .= "
							AND noreg = '".$p1."' AND no_lhp = '".$p2."'
							";
							$group = "GROUP BY kd_rekom";
						}
					}else{
						if ($filter) {
							if ($filter == "thn") {
								$where .= "
								AND noreg = '".$p1."' AND no_lhp = '".$p2."'
								"; 
								$group = "GROUP BY kd_rekom";
							}else if ($filter == "thn_all") {
								$where .= "
								AND noreg = '".$p1."' 
								";
								$group = "GROUP BY kd_rekom";
							}else if ($filter == "satker") {
								$where .= "
								AND noreg = '".$p1."'
								";
								$group = "GROUP BY kd_rekom";
							}else{
								$where .= "";
								$group ="";
							}
						}else{
							$where .= "
							AND noreg = '".$p1."' AND no_lhp = '".$p2."'
							";

							$group = "GROUP BY kd_rekom"; 
						}
					}

					$sql="
						SELECT *,
							CASE
								WHEN jml_tl = 0 THEN 'BD'
								WHEN jml_tl = ms.s THEN 'S'
								WHEN tdtp 	> 0 THEN 'TDTP'
								WHEN jml_tl = ms.bd THEN 'BD'
							ELSE 'BS'
							END as sts_rekom
						FROM(SELECT RIGHT(noreg,4) AS id, kd_rekom, noreg, no_lhp, tahun,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpklapkeu_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A') as jml_tl,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpklapkeu_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'SESUAI') as s,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpklapkeu_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'BELUM SESUAI') as bs,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpklapkeu_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'BELUM DITINDAKLANJUTI') as bd,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpklapkeu_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'TIDAK DAPAT DITINDAKLANJUTI') as tdtp,

							(SELECT COALESCE (sum(b.nilai), 0)
								FROM trd_tlhp_bpklapkeu_tl_lamp a
								LEFT JOIN trd_tlhp_bpklapkeu_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND b.`status` = '1'
							) AS nilai_s,
							(SELECT COALESCE (sum(b.nilai), 0)
								FROM trd_tlhp_bpklapkeu_tl_lamp a
								LEFT JOIN trd_tlhp_bpklapkeu_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND b.`status` = '2'
							) AS nilai_bs,
							(SELECT COALESCE (sum(b.nilai), 0)
								FROM trd_tlhp_bpklapkeu_tl_lamp a
								LEFT JOIN trd_tlhp_bpklapkeu_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND b.`status` = '3'
							) AS nilai_bd,
							(SELECT COALESCE (sum(b.nilai), 0) 
								FROM trd_tlhp_bpklapkeu_tl_lamp a
								LEFT JOIN trd_tlhp_bpklapkeu_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND b.`status` = '4'
							) AS nilai_tdtp

							FROM trd_tlhp_bpklapkeu_rekomendasi rk
							$where
							$group
						) ms
						;
					";
					// echo '<pre>'.$sql;exit;
					
				break;

				case 'data_temuan_satker':
					$thn = $this->input->post('tahun');
					$thn_end = $this->input->post('tahun_end');
					$id_instansi = $this->input->post('id_instansi');
					$flag = $this->input->post('flag');
					$filter = $this->input->post('filter');

					if ($thn != "" && $thn_end == "") {
						$where2 .= "
						AND t.tahun = '".$thn."'
						";
					}

					if ($thn == "" && $thn_end == "") {
						$where2 .= "
						AND t.tahun = '".$thn."'
						";
					}

					if ($thn_end != "" && $thn != "") {
						$where2 .= "
						AND t.tahun BETWEEN '".$thn."' AND '".$thn_end."'
						";
					} 


					if ($id_instansi) {
						$where .= "
						AND A.id_instansi = '".$id_instansi."'
						";
					}

					if ($flag) {
						$where .= "
						AND A.flag = '".$flag."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
					}


					if ($filter) {
						if ($filter == "thn") {
							$group = "GROUP BY A.id_instansi"; 
							$order = ""; 
						}else if ($filter == "thn_all") {
							$group = "GROUP BY B.tahun";
							$order = "ORDER BY B.tahun ASC"; 
						}else if ($filter == "satker") {
							$group = "GROUP BY A.id_instansi";
							$order = ""; 
						}else{
							$group = "";
							$order = ""; 
						}
					}

					$sql = "
						SELECT A.*, B.noreg,B.no_lhp,B.tahun, COALESCE(SUM(B.jml_temuan), 0) AS jml_temuan, 
						COALESCE(SUM(B.jml_rekomendasi), 0) AS jml_rekomendasi, 
						COALESCE(SUM(B.nilai_temuan), 0) AS nilai_temuan, 
						COALESCE(SUM(B.nilai_rekomendasi), 0) AS jml_nilai_rekomendasi, 
						COALESCE(SUM(B.jml_setor), 0) AS jml_setor,
						COALESCE(SUM(B.jml_setor_1), 0) AS jml_setor_s,
						COALESCE(SUM(B.jml_setor_2), 0) AS jml_setor_bs,
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_setor_bd,
						COALESCE(SUM(B.jml_setor_4), 0) AS jml_setor_tptd, 
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_nilai_sisa, 
						COALESCE(SUM(B.nilai_lebih), 0) AS jml_nilai_lebih, 
						ROUND((COALESCE (SUM(B.jml_setor), 0) / COALESCE (SUM(B.nilai_temuan), 0))*100,2) AS persentase 
						FROM 
							ms_instansi_kemendagri A 
						LEFT JOIN 
							(SELECT RIGHT (noreg, 4) AS id, noreg,no_lhp,tahun,sum(nilai_temuan_satker) as nilai_temuan, 
								sum(nilai_rek) as nilai_rekomendasi, sum(nilai_set) as jml_setor, 
								sum(nilai_set_1) as jml_setor_1,sum(nilai_set_2) as jml_setor_2,
								sum(nilai_set_3) as jml_setor_3,sum(nilai_set_4) as jml_setor_4, 
								sum(jmlsisa) as nilai_sisa, sum(jmllebih) as nilai_lebih, 
								count(tahun) AS jml_temuan, sum(jml_rekom) as jml_rekomendasi 
							FROM
								(SELECT t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan,t.nilai_temuan_satker,
									SUM(a.nilai_rekom) as nilai_rek, SUM(a.nilai_setor) as nilai_set,
									SUM(a.nilai_1) as nilai_set_1,SUM(a.nilai_2) as nilai_set_2,
									SUM(a.nilai_3) as nilai_set_3,SUM(a.nilai_4) as nilai_set_4,
									SUM(a.sisa) as jmlsisa,SUM(a.lebih) as jmllebih, count(nilai_rekom) as jml_rekom 
								FROM 
									trd_tlhp_bpklapkeu_temuan t 
								LEFT JOIN 
									(SELECT r.noreg,r.no_lhp,r.tahun,r.kd_temuan,r.kd_rekom,r.nilai_rekom,
										sum(nilai_1) as nilai_setor,
										CASE WHEN r.nilai_rekom < sum(nilai_1) THEN (r.nilai_rekom) 
										ELSE sum(nilai_1) END as nilai_1,sum(nilai_2) as nilai_2,
										sum(nilai_3) as nilai_3,sum(nilai_4) as nilai_4,
										CASE WHEN ISNULL(sum(nilai_1)) OR sum(nilai_1)=0 THEN r.nilai_rekom 
										WHEN r.nilai_rekom > sum(nilai_1) THEN (r.nilai_rekom - sum(nilai_1)) 
										ELSE 0 END as sisa,
										CASE WHEN sum(nilai_1) > r.nilai_rekom THEN (sum(nilai_1)-r.nilai_rekom) 
										ELSE 0 END as lebih
									FROM 
										trd_tlhp_bpklapkeu_rekomendasi r 
									LEFT JOIN 
										(SELECT noreg,no_lhp,kd_temuan,kd_rekomendasi,kd_tl,kd_lamp,status,nilai,
											CASE WHEN status = 1 THEN (nilai) 
											ELSE 0 END as nilai_1,
											CASE WHEN status = 2 THEN (nilai) 
											ELSE 0 END as nilai_2,
											CASE WHEN status = 3 THEN (nilai) 
											ELSE 0 END as nilai_3,
											CASE WHEN status = 4 THEN (nilai) 
											ELSE 0 END as nilai_4
										FROM trd_tlhp_bpklapkeu_tl_satker) s 
											on s.noreg = r.noreg AND r.no_lhp = s.no_lhp 
											AND r.kd_temuan = s.kd_temuan AND r.kd_rekom = s.kd_rekomendasi 
											GROUP BY r.noreg,r.no_lhp,r.kd_temuan,r.kd_rekom,r.nilai_rekom 
										) a 
										on a.noreg = t.noreg AND a.no_lhp = t.no_lhp AND t.tahun = a.tahun 
										AND t.kd_temuan = a.kd_temuan $where2 
										GROUP BY t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan
									) g 
							GROUP BY noreg 
							ORDER BY noreg
						)B ON A.id_instansi= B.id
						$where
						AND B.noreg IS NOT NULL
						$group
					";

					

					// echo '<pre>'.$sql;exit;
				break;
				case 'data_temuan_satker_detail':
					$thn = $this->input->post('tahun');
					$thn_end = $this->input->post('tahun_end');
					$id_instansi = $this->input->post('id_instansi');
					$flag = $this->input->post('flag');
					$filter = $this->input->post('filter');

					if ($flag) {
						$where .= "
						AND A.flag = '".$flag."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
					}

			
					if ($filter) {
						if ($filter == "thn") {
							if ($p1) {
								$where .= "
								AND A.id_instansi = '".$p1."'
								";
							}
							if ($p2) {
								$where .= "
								AND B.tahun = '".$p2."'
								";
							}
							$group = "GROUP BY A.id_instansi,B.no_lhp";
							$group2 = "GROUP BY noreg, no_lhp";
						}else if ($filter == "thn_all") {
							if ($p2) {
								$where .= "
								AND B.tahun = '".$p2."'
								";
							}
							$group = "GROUP BY A.id_instansi";
							$group2 = "GROUP BY noreg, no_lhp";
						}else if ($filter == "satker") {
							if ($p1) {
								$where .= "
								AND A.id_instansi = '".$p1."'
								";
							}
							$group = "GROUP BY B.tahun";
							$group2 = "GROUP BY noreg, no_lhp";
						}else{
							if ($p1) {
								$where .= "
								AND A.id_instansi = '".$p1."'
								";
							}
							if ($p2) {
								$where .= "
								AND B.tahun = '".$p2."'
								";
							}
							$group = "";
							$group2 = "";
						}
					}

					$sql = "
						SELECT A.*, B.noreg,B.no_lhp,B.tahun, COALESCE(SUM(B.jml_temuan), 0) AS jml_temuan, 
						COALESCE(SUM(B.jml_rekomendasi), 0) AS jml_rekomendasi, 
						COALESCE(SUM(B.nilai_temuan), 0) AS nilai_temuan, 
						COALESCE(SUM(B.nilai_rekomendasi), 0) AS jml_nilai_rekomendasi, 
						COALESCE(SUM(B.jml_setor), 0) AS jml_setor,
						COALESCE(SUM(B.jml_setor_1), 0) AS jml_setor_s,
						COALESCE(SUM(B.jml_setor_2), 0) AS jml_setor_bs,
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_setor_bd,
						COALESCE(SUM(B.jml_setor_4), 0) AS jml_setor_tptd, 
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_nilai_sisa, 
						COALESCE(SUM(B.nilai_lebih), 0) AS jml_nilai_lebih, 
						ROUND((COALESCE (SUM(B.jml_setor), 0) / COALESCE (SUM(B.nilai_temuan), 0))*100,2) AS persentase 
						FROM 
							ms_instansi_kemendagri A 
						LEFT JOIN 
							(SELECT RIGHT (noreg, 4) AS id, noreg,no_lhp,tahun,sum(nilai_temuan_satker) as nilai_temuan, 
								sum(nilai_rek) as nilai_rekomendasi, sum(nilai_set) as jml_setor, 
								sum(nilai_set_1) as jml_setor_1,sum(nilai_set_2) as jml_setor_2,
								sum(nilai_set_3) as jml_setor_3,sum(nilai_set_4) as jml_setor_4, 
								sum(jmlsisa) as nilai_sisa, sum(jmllebih) as nilai_lebih, 
								count(tahun) AS jml_temuan, sum(jml_rekom) as jml_rekomendasi 
							FROM
								(SELECT t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan,t.nilai_temuan_satker,
									SUM(a.nilai_rekom) as nilai_rek, SUM(a.nilai_setor) as nilai_set,
									SUM(a.nilai_1) as nilai_set_1,SUM(a.nilai_2) as nilai_set_2,
									SUM(a.nilai_3) as nilai_set_3,SUM(a.nilai_4) as nilai_set_4,
									SUM(a.sisa) as jmlsisa,SUM(a.lebih) as jmllebih, count(nilai_rekom) as jml_rekom 
								FROM 
									trd_tlhp_bpklapkeu_temuan t 
								LEFT JOIN 
									(SELECT r.noreg,r.no_lhp,r.tahun,r.kd_temuan,r.kd_rekom,r.nilai_rekom,
										sum(nilai_1) as nilai_setor,
										CASE WHEN r.nilai_rekom < sum(nilai_1) THEN (r.nilai_rekom) 
										ELSE sum(nilai_1) END as nilai_1,sum(nilai_2) as nilai_2,
										sum(nilai_3) as nilai_3,sum(nilai_4) as nilai_4,
										CASE WHEN ISNULL(sum(nilai_1)) OR sum(nilai_1)=0 THEN r.nilai_rekom 
										WHEN r.nilai_rekom > sum(nilai_1) THEN (r.nilai_rekom - sum(nilai_1)) 
										ELSE 0 END as sisa,
										CASE WHEN sum(nilai_1) > r.nilai_rekom THEN (sum(nilai_1)-r.nilai_rekom) 
										ELSE 0 END as lebih
									FROM 
										trd_tlhp_bpklapkeu_rekomendasi r 
									LEFT JOIN 
										(SELECT noreg,no_lhp,kd_temuan,kd_rekomendasi,kd_tl,kd_lamp,status,nilai,
											CASE WHEN status = 1 THEN (nilai) 
											ELSE 0 END as nilai_1,
											CASE WHEN status = 2 THEN (nilai) 
											ELSE 0 END as nilai_2,
											CASE WHEN status = 3 THEN (nilai) 
											ELSE 0 END as nilai_3,
											CASE WHEN status = 4 THEN (nilai) 
											ELSE 0 END as nilai_4
										FROM trd_tlhp_bpklapkeu_tl_satker) s 
											on s.noreg = r.noreg AND r.no_lhp = s.no_lhp 
											AND r.kd_temuan = s.kd_temuan AND r.kd_rekom = s.kd_rekomendasi 
											GROUP BY r.noreg,r.no_lhp,r.kd_temuan,r.kd_rekom,r.nilai_rekom 
										) a 
										on a.noreg = t.noreg AND a.no_lhp = t.no_lhp AND t.tahun = a.tahun 
										AND t.kd_temuan = a.kd_temuan 
										GROUP BY t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan
									) g 
							$group2 
							ORDER BY noreg
						)B ON A.id_instansi= B.id
						$where
						$group
					";
					
					
					// echo $sql;exit;
				break;

				case 'data_temuan_satker_struktur':
				case 'data_temuan_satker_struktur_adm':
					
					$thn = $this->input->post('tahun');

					$thn_end = $this->input->post('tahun_end');
					$id_instansi = $this->input->post('id_instansi');
					$flag = $this->input->post('flag');
					$filter = $this->input->post('filter');



					if ($thn != "" && $thn_end == "") {
						$where2 .= "
						AND t.tahun = '".$thn."'
						";
					}

					if ($thn == "" && $thn_end == "") {
						$where2 .= "
						AND t.tahun = '".$thn."'
						";
					}

					if ($thn_end != "" && $thn != "") {
						$where2 .= "
						AND t.tahun BETWEEN '".$thn."' AND '".$thn_end."'
						";
					} 


					if ($id_instansi) {
						$where .= "
						AND A.id_instansi = '".$id_instansi."'
						";
					}

					if ($flag) {
						$where .= "
						AND A.flag = '".$flag."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
					}else{
						// if ($p1 == "default") {
						// 	$where .= "
						// 	AND A.group NOT IN (13,14)
						// 	AND B.noreg IS NOT NULL
						// 	";
						// }else if ($p1 == "all_struktur") {
						// 	$where .= "
						// 	AND A.group NOT IN (13,14)
						// 	AND B.noreg IS NOT NULL
						// 	";
							
						// }else{
						// 	$where .= "
						// 	AND B.noreg IS NOT NULL";
						// }

						if ($p2 == "bnpp") {
							$where .= "
							AND A.group = 13
							";
						}else if($p2 == "dkpp"){
							$where .= "
							AND A.group = 14
							";
						}else if ($p2 == "kemendagri") {
							$where .= "
							AND A.group NOT IN (13,14)
							";
						}else{
							$where .= "
							
							";
						}

						if ($p1 == "default") {
							$where .= "
							AND B.noreg IS NOT NULL
							";
						}else if ($p1 == "all_struktur") {
							$where .= "
							AND B.noreg IS NOT NULL
							";
							
						}else{
							$where .= "
							AND B.noreg IS NOT NULL";
						}
						
					}

					if ($type == 'data_temuan_satker_struktur_adm') {
						$order = 'ORDER BY jml_temuan DESC';
					}else{
						$order = '';
					}

					$sql = "
						SELECT A.*, B.noreg,B.no_lhp,B.tahun, COALESCE(SUM(B.jml_temuan), 0) AS jml_temuan, 
						COALESCE(SUM(B.jml_rekomendasi), 0) AS jml_rekomendasi, 
						COALESCE(SUM(B.nilai_temuan), 0) AS nilai_temuan, 
						COALESCE(SUM(B.nilai_rekomendasi), 0) AS jml_nilai_rekomendasi, 
						COALESCE(SUM(B.jml_setor), 0) AS jml_setor,
						COALESCE(SUM(B.jml_setor_1), 0) AS jml_setor_s,
						COALESCE(SUM(B.jml_setor_2), 0) AS jml_setor_bs,
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_setor_bd,
						COALESCE(SUM(B.jml_setor_4), 0) AS jml_setor_tptd, 
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_nilai_sisa, 
						COALESCE(SUM(B.nilai_lebih), 0) AS jml_nilai_lebih, 
						ROUND((COALESCE (SUM(B.jml_setor), 0) / COALESCE (SUM(B.nilai_temuan), 0))*100,2) AS persentase 
						FROM 
							ms_instansi_kemendagri A 
						LEFT JOIN 
							(SELECT RIGHT (noreg, 4) AS id, noreg,no_lhp,tahun,sum(nilai_temuan_satker) as nilai_temuan, 
								sum(nilai_rek) as nilai_rekomendasi, sum(nilai_set) as jml_setor, 
								sum(nilai_set_1) as jml_setor_1,sum(nilai_set_2) as jml_setor_2,
								sum(nilai_set_3) as jml_setor_3,sum(nilai_set_4) as jml_setor_4, 
								sum(jmlsisa) as nilai_sisa, sum(jmllebih) as nilai_lebih, 
								count(tahun) AS jml_temuan, sum(jml_rekom) as jml_rekomendasi 
							FROM
								(SELECT t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan,t.nilai_temuan_satker,
									SUM(a.nilai_rekom) as nilai_rek, SUM(a.nilai_setor) as nilai_set,
									SUM(a.nilai_1) as nilai_set_1,SUM(a.nilai_2) as nilai_set_2,
									SUM(a.nilai_3) as nilai_set_3,SUM(a.nilai_4) as nilai_set_4,
									SUM(a.sisa) as jmlsisa,SUM(a.lebih) as jmllebih, count(nilai_rekom) as jml_rekom 
								FROM 
									trd_tlhp_bpklapkeu_temuan t 
								LEFT JOIN 
									(SELECT r.noreg,r.no_lhp,r.tahun,r.kd_temuan,r.kd_rekom,r.nilai_rekom,
										sum(nilai_1) as nilai_setor,
										CASE WHEN r.nilai_rekom < sum(nilai_1) THEN (r.nilai_rekom) 
										ELSE sum(nilai_1) END as nilai_1,sum(nilai_2) as nilai_2,
										sum(nilai_3) as nilai_3,sum(nilai_4) as nilai_4,
										CASE WHEN ISNULL(sum(nilai_1)) OR sum(nilai_1)=0 THEN r.nilai_rekom 
										WHEN r.nilai_rekom > sum(nilai_1) THEN (r.nilai_rekom - sum(nilai_1)) 
										ELSE 0 END as sisa,
										CASE WHEN sum(nilai_1) > r.nilai_rekom THEN (sum(nilai_1)-r.nilai_rekom) 
										ELSE 0 END as lebih
									FROM 
										trd_tlhp_bpklapkeu_rekomendasi r 
									LEFT JOIN 
										(SELECT noreg,no_lhp,kd_temuan,kd_rekomendasi,kd_tl,kd_lamp,status,nilai,
											CASE WHEN status = 1 THEN (nilai) 
											ELSE 0 END as nilai_1,
											CASE WHEN status = 2 THEN (nilai) 
											ELSE 0 END as nilai_2,
											CASE WHEN status = 3 THEN (nilai) 
											ELSE 0 END as nilai_3,
											CASE WHEN status = 4 THEN (nilai) 
											ELSE 0 END as nilai_4
										FROM trd_tlhp_bpklapkeu_tl_satker) s 
											on s.noreg = r.noreg AND r.no_lhp = s.no_lhp 
											AND r.kd_temuan = s.kd_temuan AND r.kd_rekom = s.kd_rekomendasi 
											GROUP BY r.noreg,r.no_lhp,r.kd_temuan,r.kd_rekom,r.nilai_rekom 
										) a 
										on a.noreg = t.noreg AND a.no_lhp = t.no_lhp AND t.tahun = a.tahun 
										AND t.kd_temuan = a.kd_temuan $where2
										GROUP BY t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan
									) g 
							GROUP BY noreg, no_lhp 
							ORDER BY noreg
						)B ON A.id_instansi= B.id
						$where
						GROUP BY A.id_instansi, B.no_lhp
						$order
					";

					

					
				break;

			}



			if($balikan == 'json'){
				return $this->lib->json_grid($sql,$type);
			}elseif($balikan == 'row_array'){
				return $this->db->query($sql)->row_array();
			}elseif($balikan == 'result'){
				return $this->db->query($sql)->result();
			}elseif($balikan == 'result_array'){
				return $this->db->query($sql)->result_array();
			}elseif($balikan == 'json_variable'){
				return json_encode($array);
			}elseif($balikan == 'json_encode'){
				$data = $this->db->query($sql)->result_array(); 
				return json_encode($data);
			}elseif($balikan == 'variable'){
				return $array;
			}elseif($balikan == 'json_datatable'){
				return $this->lib->json_datatable($sql, $type);
			}

		}

		function getdata_dashboard_kinerja($type="", $balikan="", $p1="", $p2="",$p3="",$p4=""){
			$array = array();
			$where  = " WHERE 1=1 ";
			$where2  = " WHERE 1=1 ";
			$where3 = "";

			if($this->input->post('key')){
				$key = $this->input->post('key');
				$kat = $this->input->post('kat');
				$where .= " AND LOWER(".$kat.") like '%".strtolower(trim($key))."%' ";
			}


			$is_admin = $this->session->userdata('is_admin');
			if ($is_admin == 1) {
				$daerah = $this->session->userdata('id_prov');
			}else if ($is_admin == 2) {
				$daerah = $this->session->userdata('id_kab');
			}else if ($is_admin == 3) {
				$daerah = $this->session->userdata('id_kab');
			}

			switch($type){
				
				case 'data_temuan_grouping':
				case 'data_temuan':
				case 'data_temuan_sts':
				case 'data_chart_sts_rekom':
					$thn = $this->input->post('tahun');
					$id_instansi = $this->input->post('id_instansi');
					$group = $this->input->post('group');

					if ($group) {
						$where .= "
						AND A.nm_group = '".$group."'
						";
					}
					if ($id_instansi) {
						$where .= "
						AND A.id_instansi = '".$id_instansi."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
					}


					if ($type == 'data_temuan') {
						$group = "GROUP BY A.id_instansi";
					}else if($type == 'data_temuan_grouping'){
						$group = "GROUP BY A.group";
					}else if($type == 'data_temuan_sts'){
						$where .= "
						AND A.flag NOT IN (2,3)
						";
						$group = "GROUP BY A.id_instansi";
						// $group = "GROUP BY A.group";
					}else if($type == 'data_chart_sts_rekom'){
						$group = "GROUP BY A.id_instansi";
					}else{
						$group = "GROUP BY A.id_instansi";
					}


					// $sql ="
					// 	SELECT A.id_instansi, A.nm_instansi, A.flag, A.group, A.nm_group, B.noreg, B.id_instansi as instansi, B.tahun, B.no_lhp, B.tgl_lhp, 
					// 	COALESCE(SUM(B.jml_temuan), 0) as jml_temuan,
					// 	COALESCE(SUM(B.jml_rekomendasi), 0) as jml_rekomendasi
					// 	FROM ms_instansi_kemendagri A
					// 	LEFT JOIN(
					// 		SELECT * FROM viewlapformkinerja1
					// 		WHERE tahun = '".$thn."'
					// 	)B ON A.id_instansi=B.id_instansi
					// 	$where
					// 	$group 
					// 	ORDER BY jml_temuan DESC
					// ";

					$sql = "
						SELECT A.*, B.noreg,B.no_lhp,B.tahun, COALESCE(SUM(B.jml_temuan), 0) AS jml_temuan, 
						COALESCE(SUM(B.jml_rekomendasi), 0) AS jml_rekomendasi, 
						COALESCE(SUM(B.nilai_temuan), 0) AS nilai_temuan, 
						COALESCE(SUM(B.nilai_rekomendasi), 0) AS jml_nilai_rekomendasi, 
						COALESCE(SUM(B.jml_setor), 0) AS jml_setor,
						COALESCE(SUM(B.jml_setor_1), 0) AS jml_setor_s,
						COALESCE(SUM(B.jml_setor_2), 0) AS jml_setor_bs,
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_setor_bd,
						COALESCE(SUM(B.jml_setor_4), 0) AS jml_setor_tptd, 
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_nilai_sisa, 
						COALESCE(SUM(B.nilai_lebih), 0) AS jml_nilai_lebih, 
						ROUND((COALESCE (SUM(B.jml_setor), 0) / COALESCE (SUM(B.nilai_temuan), 0))*100,2) AS persentase 
						FROM 
							ms_instansi_kemendagri A 
						LEFT JOIN 
							(SELECT RIGHT (noreg, 4) AS id, noreg,no_lhp,tahun,sum(nilai_temuan_satker) as nilai_temuan, 
								sum(nilai_rek) as nilai_rekomendasi, sum(nilai_set) as jml_setor, 
								sum(nilai_set_1) as jml_setor_1,sum(nilai_set_2) as jml_setor_2,
								sum(nilai_set_3) as jml_setor_3,sum(nilai_set_4) as jml_setor_4, 
								sum(jmlsisa) as nilai_sisa, sum(jmllebih) as nilai_lebih, 
								count(tahun) AS jml_temuan, sum(jml_rekom) as jml_rekomendasi 
							FROM
								(SELECT t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan,t.nilai_temuan_satker,
									SUM(a.nilai_rekom) as nilai_rek, SUM(a.nilai_setor) as nilai_set,
									SUM(a.nilai_1) as nilai_set_1,SUM(a.nilai_2) as nilai_set_2,
									SUM(a.nilai_3) as nilai_set_3,SUM(a.nilai_4) as nilai_set_4,
									SUM(a.sisa) as jmlsisa,SUM(a.lebih) as jmllebih, count(nilai_rekom) as jml_rekom 
								FROM 
									trd_tlhp_bpkkinerja_temuan t 
								LEFT JOIN 
									(SELECT r.noreg,r.no_lhp,r.tahun,r.kd_temuan,r.kd_rekom,r.nilai_rekom,
										sum(nilai_1) as nilai_setor,
										CASE WHEN r.nilai_rekom < sum(nilai_1) THEN (r.nilai_rekom) 
										ELSE sum(nilai_1) END as nilai_1,sum(nilai_2) as nilai_2,
										sum(nilai_3) as nilai_3,sum(nilai_4) as nilai_4,
										CASE WHEN ISNULL(sum(nilai_1)) OR sum(nilai_1)=0 THEN r.nilai_rekom 
										WHEN r.nilai_rekom > sum(nilai_1) THEN (r.nilai_rekom - sum(nilai_1)) 
										ELSE 0 END as sisa,
										CASE WHEN sum(nilai_1) > r.nilai_rekom THEN (sum(nilai_1)-r.nilai_rekom) 
										ELSE 0 END as lebih
									FROM 
										trd_tlhp_bpkkinerja_rekomendasi r 
									LEFT JOIN 
										(SELECT noreg,no_lhp,kd_temuan,kd_rekomendasi,kd_tl,kd_lamp,status,nilai,
											CASE WHEN status = 1 THEN (nilai) 
											ELSE 0 END as nilai_1,
											CASE WHEN status = 2 THEN (nilai) 
											ELSE 0 END as nilai_2,
											CASE WHEN status = 3 THEN (nilai) 
											ELSE 0 END as nilai_3,
											CASE WHEN status = 4 THEN (nilai) 
											ELSE 0 END as nilai_4
										FROM trd_tlhp_bpklapkeu_tl_satker) s 
											on s.noreg = r.noreg AND r.no_lhp = s.no_lhp 
											AND r.kd_temuan = s.kd_temuan AND r.kd_rekom = s.kd_rekomendasi 
											GROUP BY r.noreg,r.no_lhp,r.kd_temuan,r.kd_rekom,r.nilai_rekom 
										) a 
										on a.noreg = t.noreg AND a.no_lhp = t.no_lhp AND t.tahun = a.tahun 
										AND t.kd_temuan = a.kd_temuan WHERE t.tahun = '".$thn."' 
										GROUP BY t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan
									) g 
							GROUP BY noreg 
							ORDER BY noreg
						)B ON A.id_instansi= B.id
						$where
						$group
						ORDER BY jml_temuan DESC
					";

					// echo $sql;exit;
				break;
				

				case 'data_nilai_penyelesaian':
					$thn = $this->input->post('tahun');
					$id_instansi = $this->input->post('id_instansi');

					if ($thn) {
						$where .= "
						AND (B.tahun = '".$thn."' OR B.tahun IS NULL)
						";

						$where2 .= "
						AND A.tahun = '".$thn."'
						";
					}
					if ($id_instansi) {
						$where .= "
						AND A.id_instansi = '".$id_instansi."'
						";

						$where2 .= "
						AND A.id_instansi = '".$id_instansi."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
						$where2 .= "
						AND A.id_instansi = '".$daerah."'
						";
					}


					$sql = "
						SELECT A.*,B.noreg, B.no_lhp, B.id_instansi AS instansi, B.pic_itjen, 
							B.tahun, B.tgl_lhp, B.uraian_lhp,
							B.kd_temuan, B.id_aspek, B.kd_rekom,
							B.jml_temuan, B.jml_rekomendasi,
							B.jml_tl, B.nilai_temuan_kementerian,
							B.nilai_temuan_satker, B.nilai_rekomendasi,
							B.nilai_setor_tl
						FROM ms_instansi_kemendagri A
						LEFT JOIN(					
							SELECT A.noreg, A.no_lhp, A.id_instansi,A.pic_itjen, A.tahun, A.tgl_lhp, A.uraian_lhp,
							B.kd_temuan, B.id_aspek, D.kd_rekom,
							(SELECT count(`trd_tlhp_bpkkinerja_temuan`.`noreg`)
							FROM `trd_tlhp_bpkkinerja_temuan`
							WHERE ((`A`.`noreg` = `trd_tlhp_bpkkinerja_temuan`.`noreg`)
							AND (`A`.`no_lhp` = `trd_tlhp_bpkkinerja_temuan`.`no_lhp`)
							)) AS `jml_temuan`,

							(SELECT count(`trd_tlhp_bpkkinerja_rekomendasi`.`noreg`)
							FROM `trd_tlhp_bpkkinerja_rekomendasi`
							WHERE ((`A`.`noreg` = `trd_tlhp_bpkkinerja_rekomendasi`.`noreg`)
							AND (`A`.`no_lhp` = `trd_tlhp_bpkkinerja_rekomendasi`.`no_lhp`)
							AND (`B`.`id_aspek` = `trd_tlhp_bpkkinerja_rekomendasi`.`id_aspek`)
							)) AS `jml_rekomendasi`,

							(SELECT count(`trd_tlhp_bpkkinerja_tl_lamp`.`noreg`)
							FROM `trd_tlhp_bpkkinerja_tl_lamp`
							WHERE ((`D`.`noreg` = `trd_tlhp_bpkkinerja_tl_lamp`.`noreg`)
							AND (`D`.`no_lhp` = `trd_tlhp_bpkkinerja_tl_lamp`.`no_lhp`)
							AND (`D`.`kd_temuan` = `trd_tlhp_bpkkinerja_tl_lamp`.`kd_temuan`)
							)) AS `jml_tl`,

							(SELECT COALESCE(SUM(`trd_tlhp_bpkkinerja_temuan`.`nilai_temuan`), 0)
							FROM `trd_tlhp_bpkkinerja_temuan`
							WHERE ((`A`.`noreg` = `trd_tlhp_bpkkinerja_temuan`.`noreg`)
							AND (`A`.`no_lhp` = `trd_tlhp_bpkkinerja_temuan`.`no_lhp`)
							AND (`B`.`kd_temuan` = `trd_tlhp_bpkkinerja_temuan`.`kd_temuan`)
							)) AS `nilai_temuan_kementerian`,

							(SELECT COALESCE(SUM(`trd_tlhp_bpkkinerja_temuan`.`nilai_temuan_satker`), 0)
							FROM `trd_tlhp_bpkkinerja_temuan`
							WHERE ((`A`.`noreg` = `trd_tlhp_bpkkinerja_temuan`.`noreg`)
							AND (`A`.`no_lhp` = `trd_tlhp_bpkkinerja_temuan`.`no_lhp`)
							AND (`B`.`kd_temuan` = `trd_tlhp_bpkkinerja_temuan`.`kd_temuan`)
							)) AS `nilai_temuan_satker`,

							(SELECT COALESCE(SUM(`trd_tlhp_bpkkinerja_rekomendasi`.`nilai_rekom`), 0)
							FROM `trd_tlhp_bpkkinerja_rekomendasi`
							WHERE ((`A`.`noreg` = `trd_tlhp_bpkkinerja_rekomendasi`.`noreg`)
							AND (`A`.`no_lhp` = `trd_tlhp_bpkkinerja_rekomendasi`.`no_lhp`)
							AND (`B`.`id_aspek` = `trd_tlhp_bpkkinerja_rekomendasi`.`id_aspek`)
							)) AS `nilai_rekomendasi`,

							(SELECT COALESCE(SUM(`trd_tlhp_bpkkinerja_tl_satker`.`nilai`), 0)
							FROM `trd_tlhp_bpkkinerja_tl_satker`
							LEFT JOIN trd_tlhp_bpkkinerja_tl_lamp ON `trd_tlhp_bpkkinerja_tl_satker`.`noreg` = trd_tlhp_bpkkinerja_tl_lamp.noreg
							AND `trd_tlhp_bpkkinerja_tl_satker`.`no_lhp` = trd_tlhp_bpkkinerja_tl_lamp.no_lhp
							AND `trd_tlhp_bpkkinerja_tl_satker`.`kd_tl` = trd_tlhp_bpkkinerja_tl_lamp.kd_tl
							WHERE ((`D`.`noreg` = `trd_tlhp_bpkkinerja_tl_lamp`.`noreg`)
							AND (`D`.`no_lhp` = `trd_tlhp_bpkkinerja_tl_lamp`.`no_lhp`)
							AND (`D`.`kd_temuan` = `trd_tlhp_bpkkinerja_tl_lamp`.`kd_temuan`)
							)) AS `nilai_setor_tl`

							FROM trh_tlhp_bpkkinerja A
							LEFT JOIN trd_tlhp_bpkkinerja_temuan B ON A.noreg = B.noreg AND A.no_lhp = B.no_lhp
							LEFT JOIN trd_tlhp_bpkkinerja_rekomendasi D ON B.noreg = D.noreg AND B.no_lhp = D.no_lhp AND B.id_aspek = D.id_aspek
							LEFT JOIN trd_tlhp_bpkkinerja_tl_lamp E ON E.noreg = D.noreg AND E.no_lhp = D.no_lhp AND E.kd_rekomendasi = D.kd_rekom
							GROUP BY A.noreg
						)B ON A.id_instansi = B.id_instansi	
						$where
						GROUP BY A.id_instansi
						ORDER BY B.nilai_setor_tl DESC
					";

					 // echo $sql;exit;

					
				break;
				case 'data_temuan_jumlah':
				case 'data_temuan_bygroup_chart':
				case 'data_temuan_bygroup_sisa':
				case 'data_temuan_bygroup_persen':
				case 'data_temuan_bygroup':
				case 'data_temuan_bygroup_struktur':
				case 'data_temuan_bygroup_kmdgri':
				case 'data_temuan_bygroup_bnpp':
				case 'data_temuan_bygroup_dkpp':
					$thn = $this->input->post('tahun');
					$id_instansi = $this->input->post('id_instansi');
					$flag = $this->input->post('flag');
					$group = $this->input->post('group');
					
					if ($id_instansi) {
						$where .= "
						AND A.id_instansi = '".$id_instansi."'
						";
					}

					if ($flag) {
						$where .= "
						AND A.flag = '".$flag."'
						";
					}
					if ($group) {
						$where .= "
						AND A.nm_group = '".$group."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
					}

					if ($type == 'data_temuan_jumlah') {
						$where .= "
						AND B.noreg IS NOT NULL
						";
						$group = "GROUP BY A.flag";
					}else if($type == 'data_temuan_bygroup_kmdgri'){
						// $where .= "
						// AND nilai_temuan != 0
						// AND A.flag NOT IN(2,3) 
						// ";
						if ($is_admin == 1) {
							$where .= "
							AND nilai_temuan != 0
							AND A.flag NOT IN(2,3) 
							";
						}else{
							$where .= "
							AND nilai_temuan != 0
							";
						}
						$group = "GROUP BY A.group";
						$order = "ORDER BY nilai_temuan DESC";
					}else if($type == 'data_temuan_bygroup_bnpp'){
						if ($is_admin == 1) {
							$where .= "
							AND nilai_temuan != 0
							AND A.flag = 2 
							";
						}else{
							$where .= "
							AND nilai_temuan != 0
							";
						}
						
						$group = "GROUP BY A.group";
						$order = "ORDER BY nilai_temuan DESC";

					}else if($type == 'data_temuan_bygroup_dkpp'){
						if ($is_admin == 1) {
							$where .= "
							AND nilai_temuan != 0
							AND A.flag = 3 
							";
						}else{
							$where .= "
							AND nilai_temuan != 0
							";
						}
						
						$group = "GROUP BY A.group";
						$order = "ORDER BY nilai_temuan DESC";

					}else if($type == 'data_temuan_bygroup'){
						$where .= "
						AND nilai_temuan != 0
						AND A.group NOT IN (13,14)
						";
						$group = "GROUP BY A.group";
						$order = "ORDER BY nilai_temuan DESC";

					}else if($type == 'data_temuan_bygroup_struktur'){
						$where .= "
						AND A.group NOT IN (13,14)
						";
						$group = "GROUP BY A.group";
						$order = "ORDER BY A.group ASC";

					}else if($type == 'data_temuan_bygroup_persen'){
						if ($is_admin == 1) {
							$where .= "
							AND nilai_temuan != 0
							AND A.group NOT IN (13,14)
							";
						}else{
							$where .= "
							AND nilai_temuan != 0
							";
						}

						$group = "GROUP BY A.group";
						$order = "ORDER BY persentase DESC,A.group ASC";

					}else if($type == 'data_temuan_bygroup_sisa'){
						$where .= "
						AND nilai_temuan != 0
						";
						$group = "GROUP BY A.group";

					}else if($type == 'data_temuan_bygroup_chart'){
						$order = "ORDER BY nilai_temuan DESC";
						$group = "GROUP BY A.id_instansi";
					}else{
						$where .= "
						AND B.noreg IS NOT NULL
						";
						$group = "GROUP BY A.flag";
					}


					$sql = "
						SELECT A.*,
						count(A.`group`) AS jml_group,
						B.noreg,B.no_lhp,B.tahun, COALESCE(SUM(B.jml_temuan), 0) AS jml_temuan,
						COALESCE(SUM(B.jml_rekomendasi), 0) AS jml_rekomendasi,
						COALESCE(SUM(B.nilai_temuan), 0) AS nilai_temuan,
						COALESCE(SUM(B.nilai_rekomendasi), 0) AS jml_nilai_rekomendasi,
						COALESCE(SUM(B.jml_setor), 0) AS jml_setor,
						COALESCE(SUM(B.jml_setor_1), 0) AS jml_setor_s,
						COALESCE(SUM(B.jml_setor_2), 0) AS jml_setor_bs,
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_setor_bd,
						COALESCE(SUM(B.jml_setor_4), 0) AS jml_setor_tptd, 
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_nilai_sisa, 
						COALESCE(SUM(B.nilai_lebih), 0) AS jml_nilai_lebih,
						CASE WHEN ROUND((COALESCE (SUM(B.jml_setor), 0) / COALESCE (SUM(B.nilai_temuan), 0))*100,2) > 100 THEN 100
						ELSE ROUND((COALESCE (SUM(B.jml_setor), 0) / COALESCE (SUM(B.nilai_temuan), 0))*100,2)
						END AS persentase 
						FROM 
							ms_instansi_kemendagri A
						LEFT JOIN 
							(SELECT RIGHT (noreg, 4) AS id, noreg,no_lhp,tahun,sum(nilai_temuan_satker) as nilai_temuan, 
								sum(nilai_rek) as nilai_rekomendasi, sum(nilai_set) as jml_setor, 
								sum(nilai_set_1) as jml_setor_1,sum(nilai_set_2) as jml_setor_2,
								sum(nilai_set_3) as jml_setor_3,sum(nilai_set_4) as jml_setor_4, 
								sum(jmlsisa) as nilai_sisa, sum(jmllebih) as nilai_lebih, 
								count(tahun) AS jml_temuan, sum(jml_rekom) as jml_rekomendasi 
							FROM
								(SELECT t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan,t.nilai_temuan_satker,
									SUM(a.nilai_rekom) as nilai_rek, SUM(a.nilai_setor) as nilai_set,
									SUM(a.nilai_1) as nilai_set_1,SUM(a.nilai_2) as nilai_set_2,
									SUM(a.nilai_3) as nilai_set_3,SUM(a.nilai_4) as nilai_set_4,
									SUM(a.sisa) as jmlsisa,SUM(a.lebih) as jmllebih, count(nilai_rekom) as jml_rekom 
								FROM 
									trd_tlhp_bpkkinerja_temuan t 
								LEFT JOIN 
									(SELECT r.noreg,r.no_lhp,r.tahun,r.kd_temuan,r.kd_rekom,r.nilai_rekom,
										sum(nilai_1) as nilai_setor,
										CASE WHEN r.nilai_rekom < sum(nilai_1) THEN (r.nilai_rekom) 
										ELSE sum(nilai_1) END as nilai_1,sum(nilai_2) as nilai_2,
										sum(nilai_3) as nilai_3,sum(nilai_4) as nilai_4,
										CASE WHEN ISNULL(sum(nilai_1)) OR sum(nilai_1)=0 THEN r.nilai_rekom 
										WHEN r.nilai_rekom > sum(nilai_1) THEN (r.nilai_rekom - sum(nilai_1)) 
										ELSE 0 END as sisa,
										CASE WHEN sum(nilai_1) > r.nilai_rekom THEN (sum(nilai_1)-r.nilai_rekom) 
										ELSE 0 END as lebih
									FROM 
										trd_tlhp_bpkkinerja_rekomendasi r 
									LEFT JOIN 
										(SELECT noreg,no_lhp,kd_temuan,kd_rekomendasi,kd_tl,kd_lamp,status,nilai,
											CASE WHEN status = 1 THEN (nilai) 
											ELSE 0 END as nilai_1,
											CASE WHEN status = 2 THEN (nilai) 
											ELSE 0 END as nilai_2,
											CASE WHEN status = 3 THEN (nilai) 
											ELSE 0 END as nilai_3,
											CASE WHEN status = 4 THEN (nilai) 
											ELSE 0 END as nilai_4
										FROM trd_tlhp_bpkkinerja_tl_satker) s 
											on s.noreg = r.noreg AND r.no_lhp = s.no_lhp 
											AND r.kd_temuan = s.kd_temuan AND r.kd_rekom = s.kd_rekomendasi 
											GROUP BY r.noreg,r.no_lhp,r.kd_temuan,r.kd_rekom,r.nilai_rekom 
										) a 
										on a.noreg = t.noreg AND a.no_lhp = t.no_lhp AND t.tahun = a.tahun 
										AND t.kd_temuan = a.kd_temuan WHERE t.tahun = '".$thn."' 
										GROUP BY t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan
									) g 
							GROUP BY noreg 
							ORDER BY noreg
						)B ON A.id_instansi= B.id
						$where
						$group
						$order
					";

				break;

				case 'data_temuan_detail_sts_chart':
				case 'data_temuan_detail_sts_chart_lv2':
					$thn = $this->input->post('tahun');

					// $where .= "
					// AND noreg = '".$p1."' AND no_lhp = '".$p2."'
					// "; 
					if ($type == 'data_temuan_detail_sts_chart_lv2') {
						 // $where .= "
						 // AND noreg = '".$p1."' AND no_lhp = '".$p2."'
						 // ";

						$where .= "
						AND noreg IN (SELECT viewlapformkinerja1.noreg FROM viewlapformkinerja1
						WHERE viewlapformkinerja1.`noreg` =  '".$p1."' AND viewlapformkinerja1.tahun ='".$thn."'
						group by viewlapformkinerja1.noreg,viewlapformkinerja1.no_lhp
						)

						AND no_lhp IN (SELECT viewlapformkinerja1.no_lhp FROM viewlapformkinerja1
						WHERE viewlapformkinerja1.`noreg` =  '".$p1."'AND viewlapformkinerja1.tahun ='".$thn."'
						group by viewlapformkinerja1.noreg,viewlapformkinerja1.no_lhp
						)
						";

						 $where2 .= "
						 ";
					}else{

						 // $where .= "
						 // AND noreg = '".$p1."' AND no_lhp = '".$p2."'
						 // ";

						$where .= "
						AND noreg IN (SELECT viewlapformkinerja1.noreg FROM viewlapformkinerja1
						WHERE viewlapformkinerja1.`noreg` =  '".$p1."' AND viewlapformkinerja1.tahun ='".$thn."'
						group by viewlapformkinerja1.noreg,viewlapformkinerja1.no_lhp
						)

						AND no_lhp IN (SELECT viewlapformkinerja1.no_lhp FROM viewlapformkinerja1
						WHERE viewlapformkinerja1.`noreg` =  '".$p1."'AND viewlapformkinerja1.tahun ='".$thn."'
						group by viewlapformkinerja1.noreg,viewlapformkinerja1.no_lhp
						)
						";
						$where2 .= "
						";
					}
					

		
					
					$group = "GROUP BY kd_rekom"; 

					$sql="
						SELECT *,
							CASE
								WHEN jml_tl = 0 THEN 'BD'
								WHEN jml_tl = ms.s THEN 'S'
								WHEN tdtp 	> 0 THEN 'TDTP'
								WHEN jml_tl = ms.bd THEN 'BD'
							ELSE 'BS'
							END as sts_rekom
						FROM(SELECT RIGHT(noreg,4) AS id, kd_rekom, noreg, no_lhp, tahun,
							(SELECT `ms_instansi_kemendagri`.`group`
								FROM `ms_instansi_kemendagri`
								WHERE (RIGHT(noreg,4) = `ms_instansi_kemendagri`.`id_instansi`)) AS `group`,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpkkinerja_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A') as jml_tl,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpkkinerja_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'SESUAI') as s,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpkkinerja_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'BELUM SESUAI') as bs,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpkkinerja_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'BELUM DITINDAKLANJUTI') as bd,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpkkinerja_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'TIDAK DAPAT DITINDAKLANJUTI') as tdtp,

							(SELECT COALESCE (sum(b.nilai), 0)
								FROM trd_tlhp_bpkkinerja_tl_lamp a
								LEFT JOIN trd_tlhp_bpkkinerja_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND a.`status` = 'SESUAI'
							) AS nilai_s,
							(SELECT COALESCE (sum(b.nilai), 0)
								FROM trd_tlhp_bpkkinerja_tl_lamp a
								LEFT JOIN trd_tlhp_bpkkinerja_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND a.`status` = 'BELUM SESUAI'
							) AS nilai_bs,
							(SELECT COALESCE (sum(b.nilai), 0)
								FROM trd_tlhp_bpkkinerja_tl_lamp a
								LEFT JOIN trd_tlhp_bpkkinerja_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND a.`status` = 'BELUM DITINDAKLANJUTI'
							) AS nilai_bd,
							(SELECT COALESCE (sum(b.nilai), 0) 
								FROM trd_tlhp_bpkkinerja_tl_lamp a
								LEFT JOIN trd_tlhp_bpkkinerja_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND a.`status` = 'TIDAK DAPAT DITINDAKLANJUTI'
							) AS nilai_tdtp

							FROM trd_tlhp_bpkkinerja_rekomendasi rk
							$where
							$group
						) ms
						$where2
						;
					";
					// echo $sql;exit;
				break;

				case 'data_temuan_detail_head':
				case 'data_temuan_detail':
					$filter = $this->input->post('filter');
					$thn_end = $this->input->post('tahun_end');

					if ($type == "data_temuan_detail_head") {
						if ($filter) {
							if ($filter == "thn") {
								$where .= "
								AND noreg = '".$p1."'
								"; 
								$group = "GROUP BY kd_rekom";
							}else if ($filter == "thn_all") {
								if ($thn_end != "") {
									$where .= "
									AND LEFT(noreg,4) = '".$p3."'
									AND tahun BETWEEN '".$p3."' AND '".$thn_end."'
									";
								}else{
									$where .= "
									AND LEFT(noreg,4) = '".$p3."'
									AND tahun ='".$p3."'
									";
								}
								
								$group ="";
							}else if ($filter == "satker") {
								$where .= "
								AND noreg = '".$p1."'
								";

								$group = "GROUP BY kd_rekom";
							}else{
								$where .= "

								";
								$group ="";
							}
						}else{
							$where .= "
							AND noreg = '".$p1."'  AND no_lhp = '".$p2."'
							"; 
							$group = "GROUP BY kd_rekom";
						}
					}else{
						if ($filter) {
							if ($filter == "thn") {
								$where .= "
								AND noreg = '".$p1."' AND no_lhp = '".$p2."'
								"; 
								$group = "GROUP BY kd_rekom";
							}else if ($filter == "thn_all") {
								$where .= "
								AND noreg = '".$p1."' 
								";
								$group = "GROUP BY kd_rekom";
							}else if ($filter == "satker") {
								$where .= "
								AND noreg = '".$p1."'
								";
								$group = "GROUP BY kd_rekom";
							}else{
								$where .= "";
								$group ="";
							}
						}else{
							$where .= "
							AND noreg = '".$p1."' AND no_lhp = '".$p2."'
							";

							$group = "GROUP BY kd_rekom"; 
						}
					}

					$sql="
						SELECT *,
							CASE
								WHEN jml_tl = 0 THEN 'BD'
								WHEN jml_tl = ms.s THEN 'S'
								WHEN tdtp 	> 0 THEN 'TDTP'
								WHEN jml_tl = ms.bd THEN 'BD'
							ELSE 'BS'
							END as sts_rekom
						FROM(SELECT RIGHT(noreg,4) AS id, kd_rekom, noreg, no_lhp, tahun,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpkkinerja_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A') as jml_tl,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpkkinerja_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'SESUAI') as s,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpkkinerja_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'BELUM SESUAI') as bs,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpkkinerja_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'BELUM DITINDAKLANJUTI') as bd,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpkkinerja_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'TIDAK DAPAT DITINDAKLANJUTI') as tdtp,

							(SELECT COALESCE (sum(b.nilai), 0)
								FROM trd_tlhp_bpkkinerja_tl_lamp a
								LEFT JOIN trd_tlhp_bpkkinerja_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND a.`status` = '1'
							) AS nilai_s,
							(SELECT COALESCE (sum(b.nilai), 0)
								FROM trd_tlhp_bpkkinerja_tl_lamp a
								LEFT JOIN trd_tlhp_bpkkinerja_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND a.`status` = '2'
							) AS nilai_bs,
							(SELECT COALESCE (sum(b.nilai), 0)
								FROM trd_tlhp_bpkkinerja_tl_lamp a
								LEFT JOIN trd_tlhp_bpkkinerja_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND a.`status` = '3'
							) AS nilai_bd,
							(SELECT COALESCE (sum(b.nilai), 0) 
								FROM trd_tlhp_bpkkinerja_tl_lamp a
								LEFT JOIN trd_tlhp_bpkkinerja_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND a.`status` = '4'
							) AS nilai_tdtp

							FROM trd_tlhp_bpkkinerja_rekomendasi rk
							$where
							$group
						) ms
						
						;
					";
					// echo $sql;exit;
					
				break;

				case 'data_temuan_satker':
					$thn = $this->input->post('tahun');
					$thn_end = $this->input->post('tahun_end');
					$id_instansi = $this->input->post('id_instansi');
					$flag = $this->input->post('flag');
					$filter = $this->input->post('filter');

					if ($thn != "" && $thn_end == "") {
						$where2 .= "
						AND t.tahun = '".$thn."'
						";
					}

					if ($thn == "" && $thn_end == "") {
						$where2 .= "
						AND t.tahun = '".$thn."'
						";
					}

					if ($thn_end != "" && $thn != "") {
						$where2 .= "
						AND t.tahun BETWEEN '".$thn."' AND '".$thn_end."'
						";
					} 


					if ($id_instansi) {
						$where .= "
						AND A.id_instansi = '".$id_instansi."'
						";
					}

					if ($flag) {
						$where .= "
						AND A.flag = '".$flag."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
					}


					if ($filter) {
						if ($filter == "thn") {
							$group = "GROUP BY A.id_instansi"; 
							$order = ""; 
						}else if ($filter == "thn_all") {
							$group = "GROUP BY B.tahun";
							$order = "ORDER BY B.tahun ASC"; 
						}else if ($filter == "satker") {
							$group = "GROUP BY A.id_instansi";
							$order = ""; 
						}else{
							$group = "";
							$order = ""; 
						}
					}

					$sql = "
						SELECT A.*, B.noreg,B.no_lhp,B.tahun,COALESCE(SUM(B.jml_temuan), 0) AS jml_temuan,
						COALESCE(SUM(B.jml_rekomendasi), 0) AS jml_rekomendasi,
						COALESCE(SUM(B.nilai_temuan), 0) AS nilai_temuan,
						COALESCE(SUM(B.nilai_rekomendasi), 0) AS jml_nilai_rekomendasi,
						COALESCE(SUM(B.jml_setor), 0) AS jml_setor,
						COALESCE(SUM(B.jml_setor_1), 0) AS jml_setor_s,
						COALESCE(SUM(B.jml_setor_2), 0) AS jml_setor_bs,
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_setor_bd,
						COALESCE(SUM(B.jml_setor_4), 0) AS jml_setor_tptd, 
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_nilai_sisa, 
						COALESCE(SUM(B.nilai_lebih), 0) AS jml_nilai_lebih, 
						ROUND((COALESCE (SUM(B.jml_setor), 0) / COALESCE (SUM(B.nilai_temuan), 0))*100,2) AS persentase
						FROM 
							ms_instansi_kemendagri A
						LEFT JOIN 
							(SELECT RIGHT (noreg, 4) AS id, noreg,no_lhp,tahun,sum(nilai_temuan_satker) as nilai_temuan, 
								sum(nilai_rek) as nilai_rekomendasi, sum(nilai_set) as jml_setor, 
								sum(nilai_set_1) as jml_setor_1,sum(nilai_set_2) as jml_setor_2,
								sum(nilai_set_3) as jml_setor_3,sum(nilai_set_4) as jml_setor_4, 
								sum(jmlsisa) as nilai_sisa, sum(jmllebih) as nilai_lebih, 
								count(tahun) AS jml_temuan, sum(jml_rekom) as jml_rekomendasi 
							FROM
								(SELECT t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan,t.nilai_temuan_satker,
									SUM(a.nilai_rekom) as nilai_rek, SUM(a.nilai_setor) as nilai_set,
									SUM(a.nilai_1) as nilai_set_1,SUM(a.nilai_2) as nilai_set_2,
									SUM(a.nilai_3) as nilai_set_3,SUM(a.nilai_4) as nilai_set_4,
									SUM(a.sisa) as jmlsisa,SUM(a.lebih) as jmllebih, count(nilai_rekom) as jml_rekom 
								FROM 
									trd_tlhp_bpkkinerja_temuan t 
								LEFT JOIN 
									(SELECT r.noreg,r.no_lhp,r.tahun,r.kd_temuan,r.kd_rekom,r.nilai_rekom,
										sum(nilai_1) as nilai_setor,
										CASE WHEN r.nilai_rekom < sum(nilai_1) THEN (r.nilai_rekom) 
										ELSE sum(nilai_1) END as nilai_1,sum(nilai_2) as nilai_2,
										sum(nilai_3) as nilai_3,sum(nilai_4) as nilai_4,
										CASE WHEN ISNULL(sum(nilai_1)) OR sum(nilai_1)=0 THEN r.nilai_rekom 
										WHEN r.nilai_rekom > sum(nilai_1) THEN (r.nilai_rekom - sum(nilai_1)) 
										ELSE 0 END as sisa,
										CASE WHEN sum(nilai_1) > r.nilai_rekom THEN (sum(nilai_1)-r.nilai_rekom) 
										ELSE 0 END as lebih
									FROM 
										trd_tlhp_bpkkinerja_rekomendasi r 
									LEFT JOIN 
										(SELECT noreg,no_lhp,kd_temuan,kd_rekomendasi,kd_tl,kd_lamp,status,nilai,
											CASE WHEN status = 1 THEN (nilai) 
											ELSE 0 END as nilai_1,
											CASE WHEN status = 2 THEN (nilai) 
											ELSE 0 END as nilai_2,
											CASE WHEN status = 3 THEN (nilai) 
											ELSE 0 END as nilai_3,
											CASE WHEN status = 4 THEN (nilai) 
											ELSE 0 END as nilai_4
										FROM trd_tlhp_bpkkinerja_tl_satker) s 
											on s.noreg = r.noreg AND r.no_lhp = s.no_lhp 
											AND r.kd_temuan = s.kd_temuan AND r.kd_rekom = s.kd_rekomendasi 
											GROUP BY r.noreg,r.no_lhp,r.kd_temuan,r.kd_rekom,r.nilai_rekom 
										) a 
										on a.noreg = t.noreg AND a.no_lhp = t.no_lhp AND t.tahun = a.tahun 
										AND t.kd_temuan = a.kd_temuan $where2 
										GROUP BY t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan
									) g 
							GROUP BY noreg 
							ORDER BY noreg
						)B ON A.id_instansi= B.id
						$where
						AND B.noreg IS NOT NULL
						$group
					";

					

					// echo $sql;exit;
				break;
				case 'data_temuan_satker_detail':
					$thn = $this->input->post('tahun');
					$thn_end = $this->input->post('tahun_end');
					$id_instansi = $this->input->post('id_instansi');
					$flag = $this->input->post('flag');
					$filter = $this->input->post('filter');

					if ($flag) {
						$where .= "
						AND A.flag = '".$flag."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
					}

			
					if ($filter) {
						if ($filter == "thn") {
							if ($p1) {
								$where .= "
								AND A.id_instansi = '".$p1."'
								";
							}
							if ($p2) {
								$where .= "
								AND B.tahun = '".$p2."'
								";
							}
							$group = "GROUP BY A.id_instansi,B.no_lhp";
							$group2 = "GROUP BY noreg, no_lhp";
						}else if ($filter == "thn_all") {
							if ($p2) {
								$where .= "
								AND B.tahun = '".$p2."'
								";
							}
							$group = "GROUP BY A.id_instansi";
							$group2 = "GROUP BY noreg, no_lhp";
						}else if ($filter == "satker") {
							if ($p1) {
								$where .= "
								AND A.id_instansi = '".$p1."'
								";
							}
							$group = "GROUP BY B.tahun";
							$group2 = "GROUP BY noreg, no_lhp";
						}else{
							if ($p1) {
								$where .= "
								AND A.id_instansi = '".$p1."'
								";
							}
							if ($p2) {
								$where .= "
								AND B.tahun = '".$p2."'
								";
							}
							$group = "";
							$group2 = "";
						}
					}

					$sql = "
						SELECT A.*,B.noreg,B.no_lhp,B.tahun,COALESCE(SUM(B.jml_temuan), 0) AS jml_temuan,
						COALESCE(SUM(B.jml_rekomendasi), 0) AS jml_rekomendasi,
						COALESCE(SUM(B.nilai_temuan), 0) AS nilai_temuan,
						COALESCE(SUM(B.nilai_rekomendasi), 0) AS jml_nilai_rekomendasi,
						COALESCE(SUM(B.jml_setor), 0) AS jml_setor,
						COALESCE(SUM(B.jml_setor_1), 0) AS jml_setor_s,
						COALESCE(SUM(B.jml_setor_2), 0) AS jml_setor_bs,
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_setor_bd,
						COALESCE(SUM(B.jml_setor_4), 0) AS jml_setor_tptd, 
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_nilai_sisa, 
						COALESCE(SUM(B.nilai_lebih), 0) AS jml_nilai_lebih, 
						ROUND((COALESCE (SUM(B.jml_setor), 0) / COALESCE (SUM(B.nilai_temuan), 0))*100,2) AS persentase
						FROM 
							ms_instansi_kemendagri A
						LEFT JOIN 
							(SELECT RIGHT (noreg, 4) AS id, noreg,no_lhp,tahun,sum(nilai_temuan_satker) as nilai_temuan, 
								sum(nilai_rek) as nilai_rekomendasi, sum(nilai_set) as jml_setor, 
								sum(nilai_set_1) as jml_setor_1,sum(nilai_set_2) as jml_setor_2,
								sum(nilai_set_3) as jml_setor_3,sum(nilai_set_4) as jml_setor_4, 
								sum(jmlsisa) as nilai_sisa, sum(jmllebih) as nilai_lebih, 
								count(tahun) AS jml_temuan, sum(jml_rekom) as jml_rekomendasi 
							FROM
								(SELECT t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan,t.nilai_temuan_satker,
									SUM(a.nilai_rekom) as nilai_rek, SUM(a.nilai_setor) as nilai_set,
									SUM(a.nilai_1) as nilai_set_1,SUM(a.nilai_2) as nilai_set_2,
									SUM(a.nilai_3) as nilai_set_3,SUM(a.nilai_4) as nilai_set_4,
									SUM(a.sisa) as jmlsisa,SUM(a.lebih) as jmllebih, count(nilai_rekom) as jml_rekom 
								FROM 
									trd_tlhp_bpkkinerja_temuan t 
								LEFT JOIN 
									(SELECT r.noreg,r.no_lhp,r.tahun,r.kd_temuan,r.kd_rekom,r.nilai_rekom,
										sum(nilai_1) as nilai_setor,
										CASE WHEN r.nilai_rekom < sum(nilai_1) THEN (r.nilai_rekom) 
										ELSE sum(nilai_1) END as nilai_1,sum(nilai_2) as nilai_2,
										sum(nilai_3) as nilai_3,sum(nilai_4) as nilai_4,
										CASE WHEN ISNULL(sum(nilai_1)) OR sum(nilai_1)=0 THEN r.nilai_rekom 
										WHEN r.nilai_rekom > sum(nilai_1) THEN (r.nilai_rekom - sum(nilai_1)) 
										ELSE 0 END as sisa,
										CASE WHEN sum(nilai_1) > r.nilai_rekom THEN (sum(nilai_1)-r.nilai_rekom) 
										ELSE 0 END as lebih
									FROM 
										trd_tlhp_bpkkinerja_rekomendasi r 
									LEFT JOIN 
										(SELECT noreg,no_lhp,kd_temuan,kd_rekomendasi,kd_tl,kd_lamp,status,nilai,
											CASE WHEN status = 1 THEN (nilai) 
											ELSE 0 END as nilai_1,
											CASE WHEN status = 2 THEN (nilai) 
											ELSE 0 END as nilai_2,
											CASE WHEN status = 3 THEN (nilai) 
											ELSE 0 END as nilai_3,
											CASE WHEN status = 4 THEN (nilai) 
											ELSE 0 END as nilai_4
										FROM trd_tlhp_bpkkinerja_tl_satker) s 
											on s.noreg = r.noreg AND r.no_lhp = s.no_lhp 
											AND r.kd_temuan = s.kd_temuan AND r.kd_rekom = s.kd_rekomendasi 
											GROUP BY r.noreg,r.no_lhp,r.kd_temuan,r.kd_rekom,r.nilai_rekom 
										) a 
										on a.noreg = t.noreg AND a.no_lhp = t.no_lhp AND t.tahun = a.tahun 
										AND t.kd_temuan = a.kd_temuan 
										GROUP BY t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan
									) g 
							$group2 
							ORDER BY noreg
						)B ON A.id_instansi= B.id
						$where
						$group
					";
					
					// echo $sql;exit;
				break;

				case 'data_temuan_satker_struktur':
				case 'data_temuan_satker_struktur_adm':
					$thn = $this->input->post('tahun');
					$thn_end = $this->input->post('tahun_end');
					$id_instansi = $this->input->post('id_instansi');
					$flag = $this->input->post('flag');
					$filter = $this->input->post('filter');



					if ($thn != "" && $thn_end == "") {
						$where2 .= "
						AND t.tahun = '".$thn."'
						";
					}

					if ($thn == "" && $thn_end == "") {
						$where2 .= "
						AND t.tahun = '".$thn."'
						";
					}

					if ($thn_end != "" && $thn != "") {
						$where2 .= "
						AND t.tahun BETWEEN '".$thn."' AND '".$thn_end."'
						";
					} 


					if ($id_instansi) {
						$where .= "
						AND A.id_instansi = '".$id_instansi."'
						";
					}

					if ($flag) {
						$where .= "
						AND A.flag = '".$flag."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
					}else{
						// if ($p1 == "default") {
						// 	$where .= "
						// 	AND A.group NOT IN (13,14)
						// 	AND B.noreg IS NOT NULL
						// 	";
						// }else if ($p1 == "all_struktur") {
						// 	$where .= "
						// 	AND A.group NOT IN (13,14)
						// 	AND B.noreg IS NOT NULL
						// 	";
						// }else{
						// 	$where .= "
						// 	AND B.noreg IS NOT NULL";
						// }

						if ($p2 == "bnpp") {
							$where .= "
							AND A.group = 13
							";
						}else if($p2 == "dkpp"){
							$where .= "
							AND A.group = 14
							";
						}else if ($p2 == "kemendagri") {
							$where .= "
							AND A.group NOT IN (13,14)
							";
						}else{
							$where .= "
							
							";
						}

						if ($p1 == "default") {
							$where .= "
							AND B.noreg IS NOT NULL
							";
						}else if ($p1 == "all_struktur") {
							$where .= "
							AND B.noreg IS NOT NULL
							";
							
						}else{
							$where .= "
							AND B.noreg IS NOT NULL";
						}
						
					}

					if ($type == 'data_temuan_satker_struktur_adm') {
						$order = 'ORDER BY jml_temuan DESC';
					}else{
						$order = '';
					}

					$sql = "
						SELECT A.*,B.noreg,B.no_lhp,B.tahun,COALESCE(SUM(B.jml_temuan), 0) AS jml_temuan,
						COALESCE(SUM(B.jml_rekomendasi), 0) AS jml_rekomendasi,
						COALESCE(SUM(B.nilai_temuan), 0) AS nilai_temuan,
						COALESCE(SUM(B.nilai_rekomendasi), 0) AS jml_nilai_rekomendasi,
						COALESCE(SUM(B.jml_setor), 0) AS jml_setor,
						COALESCE(SUM(B.jml_setor_1), 0) AS jml_setor_s,
						COALESCE(SUM(B.jml_setor_2), 0) AS jml_setor_bs,
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_setor_bd,
						COALESCE(SUM(B.jml_setor_4), 0) AS jml_setor_tptd, 
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_nilai_sisa, 
						COALESCE(SUM(B.nilai_lebih), 0) AS jml_nilai_lebih, 
						ROUND((COALESCE (SUM(B.jml_setor), 0) / COALESCE (SUM(B.nilai_temuan), 0))*100,2) AS persentase
						FROM 
							ms_instansi_kemendagri A
						LEFT JOIN 
							(SELECT RIGHT (noreg, 4) AS id, noreg,no_lhp,tahun,sum(nilai_temuan_satker) as nilai_temuan, 
								sum(nilai_rek) as nilai_rekomendasi, sum(nilai_set) as jml_setor, 
								sum(nilai_set_1) as jml_setor_1,sum(nilai_set_2) as jml_setor_2,
								sum(nilai_set_3) as jml_setor_3,sum(nilai_set_4) as jml_setor_4, 
								sum(jmlsisa) as nilai_sisa, sum(jmllebih) as nilai_lebih, 
								count(tahun) AS jml_temuan, sum(jml_rekom) as jml_rekomendasi 
							FROM
								(SELECT t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan,t.nilai_temuan_satker,
									SUM(a.nilai_rekom) as nilai_rek, SUM(a.nilai_setor) as nilai_set,
									SUM(a.nilai_1) as nilai_set_1,SUM(a.nilai_2) as nilai_set_2,
									SUM(a.nilai_3) as nilai_set_3,SUM(a.nilai_4) as nilai_set_4,
									SUM(a.sisa) as jmlsisa,SUM(a.lebih) as jmllebih, count(nilai_rekom) as jml_rekom 
								FROM 
									trd_tlhp_bpkkinerja_temuan t 
								LEFT JOIN 
									(SELECT r.noreg,r.no_lhp,r.tahun,r.kd_temuan,r.kd_rekom,r.nilai_rekom,
										sum(nilai_1) as nilai_setor,
										CASE WHEN r.nilai_rekom < sum(nilai_1) THEN (r.nilai_rekom) 
										ELSE sum(nilai_1) END as nilai_1,sum(nilai_2) as nilai_2,
										sum(nilai_3) as nilai_3,sum(nilai_4) as nilai_4,
										CASE WHEN ISNULL(sum(nilai_1)) OR sum(nilai_1)=0 THEN r.nilai_rekom 
										WHEN r.nilai_rekom > sum(nilai_1) THEN (r.nilai_rekom - sum(nilai_1)) 
										ELSE 0 END as sisa,
										CASE WHEN sum(nilai_1) > r.nilai_rekom THEN (sum(nilai_1)-r.nilai_rekom) 
										ELSE 0 END as lebih
									FROM 
										trd_tlhp_bpkkinerja_rekomendasi r 
									LEFT JOIN 
										(SELECT noreg,no_lhp,kd_temuan,kd_rekomendasi,kd_tl,kd_lamp,status,nilai,
											CASE WHEN status = 1 THEN (nilai) 
											ELSE 0 END as nilai_1,
											CASE WHEN status = 2 THEN (nilai) 
											ELSE 0 END as nilai_2,
											CASE WHEN status = 3 THEN (nilai) 
											ELSE 0 END as nilai_3,
											CASE WHEN status = 4 THEN (nilai) 
											ELSE 0 END as nilai_4
										FROM trd_tlhp_bpkkinerja_tl_satker) s 
											on s.noreg = r.noreg AND r.no_lhp = s.no_lhp 
											AND r.kd_temuan = s.kd_temuan AND r.kd_rekom = s.kd_rekomendasi 
											GROUP BY r.noreg,r.no_lhp,r.kd_temuan,r.kd_rekom,r.nilai_rekom 
										) a 
										on a.noreg = t.noreg AND a.no_lhp = t.no_lhp AND t.tahun = a.tahun 
										AND t.kd_temuan = a.kd_temuan $where2
										GROUP BY t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan
									) g 
							GROUP BY noreg, no_lhp 
							ORDER BY noreg
						)B ON A.id_instansi= B.id
						$where
						GROUP BY A.id_instansi, B.no_lhp
						$order
					";

					

					// echo $sql;exit;
				break;

			}



			if($balikan == 'json'){
				return $this->lib->json_grid($sql,$type);
			}elseif($balikan == 'row_array'){
				return $this->db->query($sql)->row_array();
			}elseif($balikan == 'result'){
				return $this->db->query($sql)->result();
			}elseif($balikan == 'result_array'){
				// $this->db->query($sql);
				// print_r($this->db->error());die();
				return $this->db->query($sql)->result_array();
			}elseif($balikan == 'json_variable'){
				return json_encode($array);
			}elseif($balikan == 'json_encode'){
				$data = $this->db->query($sql)->result_array(); 
				return json_encode($data);
			}elseif($balikan == 'variable'){
				return $array;
			}elseif($balikan == 'json_datatable'){
				return $this->lib->json_datatable($sql, $type);
			}

		}


		function getdata_dashboard_dtt($type="", $balikan="", $p1="", $p2="",$p3="",$p4=""){
			$array = array();
			$where  = " WHERE 1=1 ";
			$where2  = " WHERE 1=1 ";
			$where3 = "";

			if($this->input->post('key')){
				$key = $this->input->post('key');
				$kat = $this->input->post('kat');
				$where .= " AND LOWER(".$kat.") like '%".strtolower(trim($key))."%' ";
			}


			$is_admin = $this->session->userdata('is_admin');
			if ($is_admin == 1) {
				$daerah = $this->session->userdata('id_prov');
			}else if ($is_admin == 2) {
				$daerah = $this->session->userdata('id_kab');
			}else if ($is_admin == 3) {
				$daerah = $this->session->userdata('id_kab');
			}

			switch($type){
				
				case 'data_temuan_grouping':
				case 'data_temuan':
				case 'data_temuan_sts':
				case 'data_chart_sts_rekom':
					$thn = $this->input->post('tahun');
					$id_instansi = $this->input->post('id_instansi');
					$group = $this->input->post('group');

					if ($group) {
						$where .= "
						AND A.nm_group = '".$group."'
						";
					}
					if ($id_instansi) {
						$where .= "
						AND A.id_instansi = '".$id_instansi."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
					}


					if ($type == 'data_temuan') {
						$group = "GROUP BY A.id_instansi";
					}else if($type == 'data_temuan_grouping'){
						$group = "GROUP BY A.group";
					}else if($type == 'data_temuan_sts'){
						$where .= "
						AND A.flag NOT IN (2,3)
						";
						$group = "GROUP BY A.id_instansi";
						// $group = "GROUP BY A.group";
					}else if($type == 'data_chart_sts_rekom'){
						$group = "GROUP BY A.id_instansi";
					}else{
						$group = "GROUP BY A.id_instansi";
					}


					$sql ="
						SELECT A.id_instansi, A.nm_instansi, A.flag, A.group, A.nm_group, B.noreg, B.id_instansi as instansi, B.tahun, B.no_lhp, B.tgl_lhp, 
						COALESCE(SUM(B.jml_temuan), 0) as jml_temuan,
						COALESCE(SUM(B.jml_rekomendasi), 0) as jml_rekomendasi
						FROM ms_instansi_kemendagri A
						LEFT JOIN(
							SELECT * FROM viewlapformtujuan1
							WHERE tahun = '".$thn."'
						)B ON A.id_instansi=B.id_instansi
						$where
						$group 
						ORDER BY jml_temuan DESC
					";

					// echo $sql;exit;
				break;
				

				case 'data_nilai_penyelesaian':
					$thn = $this->input->post('tahun');
					$id_instansi = $this->input->post('id_instansi');

					if ($thn) {
						$where .= "
						AND (B.tahun = '".$thn."' OR B.tahun IS NULL)
						";

						$where2 .= "
						AND A.tahun = '".$thn."'
						";
					}
					if ($id_instansi) {
						$where .= "
						AND A.id_instansi = '".$id_instansi."'
						";

						$where2 .= "
						AND A.id_instansi = '".$id_instansi."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
						$where2 .= "
						AND A.id_instansi = '".$daerah."'
						";
					}


					$sql = "
						SELECT A.*,B.noreg, B.no_lhp, B.id_instansi AS instansi, B.pic_itjen, 
							B.tahun, B.tgl_lhp, B.uraian_lhp,
							B.kd_temuan, B.id_aspek, B.kd_rekom,
							B.jml_temuan, B.jml_rekomendasi,
							B.jml_tl, B.nilai_temuan_kementerian,
							B.nilai_temuan_satker, B.nilai_rekomendasi,
							B.nilai_setor_tl
						FROM ms_instansi_kemendagri A
						LEFT JOIN(					
							SELECT A.noreg, A.no_lhp, A.id_instansi,A.pic_itjen, A.tahun, A.tgl_lhp, A.uraian_lhp,
							B.kd_temuan, B.id_aspek, D.kd_rekom,
							(SELECT count(`trd_tlhp_bpktujuan_temuan`.`noreg`)
							FROM `trd_tlhp_bpktujuan_temuan`
							WHERE ((`A`.`noreg` = `trd_tlhp_bpktujuan_temuan`.`noreg`)
							AND (`A`.`no_lhp` = `trd_tlhp_bpktujuan_temuan`.`no_lhp`)
							)) AS `jml_temuan`,

							(SELECT count(`trd_tlhp_bpktujuan_rekomendasi`.`noreg`)
							FROM `trd_tlhp_bpktujuan_rekomendasi`
							WHERE ((`A`.`noreg` = `trd_tlhp_bpktujuan_rekomendasi`.`noreg`)
							AND (`A`.`no_lhp` = `trd_tlhp_bpktujuan_rekomendasi`.`no_lhp`)
							AND (`B`.`id_aspek` = `trd_tlhp_bpktujuan_rekomendasi`.`id_aspek`)
							)) AS `jml_rekomendasi`,

							(SELECT count(`trd_tlhp_bpktujuan_tl_lamp`.`noreg`)
							FROM `trd_tlhp_bpktujuan_tl_lamp`
							WHERE ((`D`.`noreg` = `trd_tlhp_bpktujuan_tl_lamp`.`noreg`)
							AND (`D`.`no_lhp` = `trd_tlhp_bpktujuan_tl_lamp`.`no_lhp`)
							AND (`D`.`kd_temuan` = `trd_tlhp_bpktujuan_tl_lamp`.`kd_temuan`)
							)) AS `jml_tl`,

							(SELECT COALESCE(SUM(`trd_tlhp_bpktujuan_temuan`.`nilai_temuan`), 0)
							FROM `trd_tlhp_bpktujuan_temuan`
							WHERE ((`A`.`noreg` = `trd_tlhp_bpktujuan_temuan`.`noreg`)
							AND (`A`.`no_lhp` = `trd_tlhp_bpktujuan_temuan`.`no_lhp`)
							AND (`B`.`kd_temuan` = `trd_tlhp_bpktujuan_temuan`.`kd_temuan`)
							)) AS `nilai_temuan_kementerian`,

							(SELECT COALESCE(SUM(`trd_tlhp_bpktujuan_temuan`.`nilai_temuan_satker`), 0)
							FROM `trd_tlhp_bpktujuan_temuan`
							WHERE ((`A`.`noreg` = `trd_tlhp_bpktujuan_temuan`.`noreg`)
							AND (`A`.`no_lhp` = `trd_tlhp_bpktujuan_temuan`.`no_lhp`)
							AND (`B`.`kd_temuan` = `trd_tlhp_bpktujuan_temuan`.`kd_temuan`)
							)) AS `nilai_temuan_satker`,

							(SELECT COALESCE(SUM(`trd_tlhp_bpktujuan_rekomendasi`.`nilai_rekom`), 0)
							FROM `trd_tlhp_bpktujuan_rekomendasi`
							WHERE ((`A`.`noreg` = `trd_tlhp_bpktujuan_rekomendasi`.`noreg`)
							AND (`A`.`no_lhp` = `trd_tlhp_bpktujuan_rekomendasi`.`no_lhp`)
							AND (`B`.`id_aspek` = `trd_tlhp_bpktujuan_rekomendasi`.`id_aspek`)
							)) AS `nilai_rekomendasi`,

							(SELECT COALESCE(SUM(`trd_tlhp_bpktujuan_tl_satker`.`nilai`), 0)
							FROM `trd_tlhp_bpktujuan_tl_satker`
							LEFT JOIN trd_tlhp_bpktujuan_tl_lamp ON `trd_tlhp_bpktujuan_tl_satker`.`noreg` = trd_tlhp_bpktujuan_tl_lamp.noreg
							AND `trd_tlhp_bpktujuan_tl_satker`.`no_lhp` = trd_tlhp_bpktujuan_tl_lamp.no_lhp
							AND `trd_tlhp_bpktujuan_tl_satker`.`kd_tl` = trd_tlhp_bpktujuan_tl_lamp.kd_tl
							WHERE ((`D`.`noreg` = `trd_tlhp_bpktujuan_tl_lamp`.`noreg`)
							AND (`D`.`no_lhp` = `trd_tlhp_bpktujuan_tl_lamp`.`no_lhp`)
							AND (`D`.`kd_temuan` = `trd_tlhp_bpktujuan_tl_lamp`.`kd_temuan`)
							)) AS `nilai_setor_tl`

							FROM trh_tlhp_bpktujuan A
							LEFT JOIN trd_tlhp_bpktujuan_temuan B ON A.noreg = B.noreg AND A.no_lhp = B.no_lhp
							LEFT JOIN trd_tlhp_bpktujuan_rekomendasi D ON B.noreg = D.noreg AND B.no_lhp = D.no_lhp AND B.id_aspek = D.id_aspek
							LEFT JOIN trd_tlhp_bpktujuan_tl_lamp E ON E.noreg = D.noreg AND E.no_lhp = D.no_lhp AND E.kd_rekomendasi = D.kd_rekom
							GROUP BY A.noreg
						)B ON A.id_instansi = B.id_instansi	
						$where
						GROUP BY A.id_instansi
						ORDER BY B.nilai_setor_tl DESC
					";

					 // echo $sql;exit;

					
				break;
				case 'data_temuan_jumlah':
				case 'data_temuan_bygroup_chart':
				case 'data_temuan_bygroup_sisa':
				case 'data_temuan_bygroup_persen':
				case 'data_temuan_bygroup':
				case 'data_temuan_bygroup_struktur':
				case 'data_temuan_bygroup_kmdgri':
				case 'data_temuan_bygroup_bnpp':
				case 'data_temuan_bygroup_dkpp':
					$thn = $this->input->post('tahun');
					$id_instansi = $this->input->post('id_instansi');
					$flag = $this->input->post('flag');
					$group = $this->input->post('group');
					
					if ($id_instansi) {
						$where .= "
						AND A.id_instansi = '".$id_instansi."'
						";
					}

					if ($flag) {
						$where .= "
						AND A.flag = '".$flag."'
						";
					}
					if ($group) {
						$where .= "
						AND A.nm_group = '".$group."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
					}

					if ($type == 'data_temuan_jumlah') {
						$where .= "
						AND B.noreg IS NOT NULL
						";
						$group = "GROUP BY A.flag";
					}else if($type == 'data_temuan_bygroup_kmdgri'){
						// $where .= "
						// AND nilai_temuan != 0
						// AND A.flag NOT IN(2,3) 
						// ";
						$where .= "
						AND A.flag NOT IN(2,3) 
						";
						$group = "GROUP BY A.group";
						$order = "ORDER BY nilai_temuan DESC";
					}else if($type == 'data_temuan_bygroup_bnpp'){
						if ($is_admin == 1) {
							$where .= "
							AND nilai_temuan != 0
							AND A.flag = 2 
							";
						}else{
							$where .= "
							AND nilai_temuan != 0
							";
						}
						
						$group = "GROUP BY A.group";
						$order = "ORDER BY nilai_temuan DESC";

					}else if($type == 'data_temuan_bygroup_dkpp'){
						if ($is_admin == 1) {
							$where .= "
							AND nilai_temuan != 0
							AND A.flag = 3 
							";
						}else{
							$where .= "
							AND nilai_temuan != 0
							";
						}
						
						$group = "GROUP BY A.group";
						$order = "ORDER BY nilai_temuan DESC";
					}else if($type == 'data_temuan_bygroup'){
						$where .= "
						AND nilai_temuan != 0
						";
						$group = "GROUP BY A.group";
						$order = "ORDER BY nilai_temuan DESC";

					}else if($type == 'data_temuan_bygroup_struktur'){
						$where .= "
						AND A.group NOT IN (13,14)
						";
						$group = "GROUP BY A.group";
						$order = "ORDER BY A.group ASC";

					}else if($type == 'data_temuan_bygroup_persen'){
						if ($is_admin == 1) {
							$where .= "
							AND nilai_temuan != 0
							AND A.group NOT IN (13,14)
							";
						}else{
							$where .= "
							AND nilai_temuan != 0
							";
						}


						$group = "GROUP BY A.group";
						$order = "ORDER BY persentase DESC,A.group ASC";

					}else if($type == 'data_temuan_bygroup_sisa'){
						$where .= "
						AND nilai_temuan != 0
						";
						$group = "GROUP BY A.group";

					}else if($type == 'data_temuan_bygroup_chart'){
						$order = "ORDER BY nilai_temuan DESC";
						$group = "GROUP BY A.id_instansi";
					}else{
						$where .= "
						AND B.noreg IS NOT NULL
						";
						$group = "GROUP BY A.flag";
					}


					$sql = "
						SELECT A.*, B.noreg,B.no_lhp,B.tahun, COALESCE(SUM(B.jml_temuan), 0) AS jml_temuan, 
						COALESCE(SUM(B.jml_rekomendasi), 0) AS jml_rekomendasi, 
						COALESCE(SUM(B.nilai_temuan), 0) AS nilai_temuan, 
						COALESCE(SUM(B.nilai_rekomendasi), 0) AS jml_nilai_rekomendasi, 
						COALESCE(SUM(B.jml_setor), 0) AS jml_setor,
						COALESCE(SUM(B.jml_setor_1), 0) AS jml_setor_s,
						COALESCE(SUM(B.jml_setor_2), 0) AS jml_setor_bs,
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_setor_bd,
						COALESCE(SUM(B.jml_setor_4), 0) AS jml_setor_tptd, 
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_nilai_sisa, 
						COALESCE(SUM(B.nilai_lebih), 0) AS jml_nilai_lebih, 
						CASE WHEN ROUND((COALESCE (SUM(B.jml_setor), 0) / COALESCE (SUM(B.nilai_temuan), 0))*100,2) > 100 THEN 100
						ELSE ROUND((COALESCE (SUM(B.jml_setor), 0) / COALESCE (SUM(B.nilai_temuan), 0))*100,2)
						END AS persentase 
						FROM 
							ms_instansi_kemendagri A 
						LEFT JOIN 
							(SELECT RIGHT (noreg, 4) AS id, noreg,no_lhp,tahun,sum(nilai_temuan_satker) as nilai_temuan, 
								sum(nilai_rek) as nilai_rekomendasi, sum(nilai_set) as jml_setor, 
								sum(nilai_set_1) as jml_setor_1,sum(nilai_set_2) as jml_setor_2,
								sum(nilai_set_3) as jml_setor_3,sum(nilai_set_4) as jml_setor_4, 
								sum(jmlsisa) as nilai_sisa, sum(jmllebih) as nilai_lebih, 
								count(tahun) AS jml_temuan, sum(jml_rekom) as jml_rekomendasi 
							FROM
								(SELECT t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan,t.nilai_temuan_satker,
									SUM(a.nilai_rekom) as nilai_rek, SUM(a.nilai_setor) as nilai_set,
									SUM(a.nilai_1) as nilai_set_1,SUM(a.nilai_2) as nilai_set_2,
									SUM(a.nilai_3) as nilai_set_3,SUM(a.nilai_4) as nilai_set_4,
									SUM(a.sisa) as jmlsisa,SUM(a.lebih) as jmllebih, count(nilai_rekom) as jml_rekom 
								FROM 
									trd_tlhp_bpktujuan_temuan t 
								LEFT JOIN 
									(SELECT r.noreg,r.no_lhp,r.tahun,r.kd_temuan,r.kd_rekom,r.nilai_rekom,
										sum(nilai_1) as nilai_setor,
										CASE WHEN r.nilai_rekom < sum(nilai_1) THEN (r.nilai_rekom) 
										ELSE sum(nilai_1) END as nilai_1,sum(nilai_2) as nilai_2,
										sum(nilai_3) as nilai_3,sum(nilai_4) as nilai_4,
										CASE WHEN ISNULL(sum(nilai_1)) OR sum(nilai_1)=0 THEN r.nilai_rekom 
										WHEN r.nilai_rekom > sum(nilai_1) THEN (r.nilai_rekom - sum(nilai_1)) 
										ELSE 0 END as sisa,

										CASE WHEN sum(nilai_1) > r.nilai_rekom THEN (sum(nilai_1)-r.nilai_rekom) 
										ELSE 0 END as lebih
									FROM 
										trd_tlhp_bpktujuan_rekomendasi r 
									LEFT JOIN 
										(SELECT noreg,no_lhp,kd_temuan,kd_rekomendasi,kd_tl,kd_lamp,status,nilai,
											CASE WHEN status = 1 THEN (nilai) 
											ELSE 0 END as nilai_1,
											CASE WHEN status = 2 THEN (nilai) 
											ELSE 0 END as nilai_2,
											CASE WHEN status = 3 THEN (nilai) 
											ELSE 0 END as nilai_3,
											CASE WHEN status = 4 THEN (nilai) 
											ELSE 0 END as nilai_4
										FROM trd_tlhp_bpktujuan_tl_satker) s 
											on s.noreg = r.noreg AND r.no_lhp = s.no_lhp 
											AND r.kd_temuan = s.kd_temuan AND r.kd_rekom = s.kd_rekomendasi 
											GROUP BY r.noreg,r.no_lhp,r.kd_temuan,r.kd_rekom,r.nilai_rekom 
										) a 
										on a.noreg = t.noreg AND a.no_lhp = t.no_lhp AND t.tahun = a.tahun 
										AND t.kd_temuan = a.kd_temuan WHERE t.tahun = '".$thn."' 
										GROUP BY t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan
									) g 
							GROUP BY noreg 
							ORDER BY noreg
						)B ON A.id_instansi= B.id
						$where
						$group
						$order
					";

					// echo '<pre>'.$sql;exit;
				break;

				case 'data_temuan_detail_sts_chart':
				case 'data_temuan_detail_sts_chart_lv2':
					$thn = $this->input->post('tahun');

					// $where .= "
					// AND noreg = '".$p1."' AND no_lhp = '".$p2."'
					// "; 
					if ($type == 'data_temuan_detail_sts_chart_lv2') {
						 // $where .= "
						 // AND noreg = '".$p1."' AND no_lhp = '".$p2."'
						 // ";

						$where .= "
						AND noreg IN (SELECT viewlapformtujuan1.noreg FROM viewlapformtujuan1
						WHERE viewlapformtujuan1.`noreg` =  '".$p1."' AND viewlapformtujuan1.tahun ='".$thn."'
						group by viewlapformtujuan1.noreg,viewlapformtujuan1.no_lhp
						)

						AND no_lhp IN (SELECT viewlapformtujuan1.no_lhp FROM viewlapformtujuan1
						WHERE viewlapformtujuan1.`noreg` =  '".$p1."'AND viewlapformtujuan1.tahun ='".$thn."'
						group by viewlapformtujuan1.noreg,viewlapformtujuan1.no_lhp
						)
						";

						 $where2 .= "
						 ";
					}else{

						 // $where .= "
						 // AND noreg = '".$p1."' AND no_lhp = '".$p2."'
						 // ";

						$where .= "
						AND noreg IN (SELECT viewlapformtujuan1.noreg FROM viewlapformtujuan1
						WHERE viewlapformtujuan1.`noreg` =  '".$p1."' AND viewlapformtujuan1.tahun ='".$thn."'
						group by viewlapformtujuan1.noreg,viewlapformtujuan1.no_lhp
						)

						AND no_lhp IN (SELECT viewlapformtujuan1.no_lhp FROM viewlapformtujuan1
						WHERE viewlapformtujuan1.`noreg` =  '".$p1."'AND viewlapformtujuan1.tahun ='".$thn."'
						group by viewlapformtujuan1.noreg,viewlapformtujuan1.no_lhp
						)
						";
						$where2 .= "
						";
					}
					

		
					
					$group = "GROUP BY kd_rekom"; 

					$sql="
						SELECT *,
							CASE
								WHEN jml_tl = 0 THEN 'BD'
								WHEN jml_tl = ms.s THEN 'S'
								WHEN tdtp 	> 0 THEN 'TDTP'
								WHEN jml_tl = ms.bd THEN 'BD'
							ELSE 'BS'
							END as sts_rekom
						FROM(SELECT RIGHT(noreg,4) AS id, kd_rekom, noreg, no_lhp, tahun,
							(SELECT `ms_instansi_kemendagri`.`group`
								FROM `ms_instansi_kemendagri`
								WHERE (RIGHT(noreg,4) = `ms_instansi_kemendagri`.`id_instansi`)) AS `group`,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpktujuan_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A') as jml_tl,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpktujuan_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'SESUAI') as s,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpktujuan_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'BELUM SESUAI') as bs,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpktujuan_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'BELUM DITINDAKLANJUTI') as bd,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpktujuan_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'TIDAK DAPAT DITINDAKLANJUTI') as tdtp,

							(SELECT COALESCE (sum(b.nilai), 0)
								FROM trd_tlhp_bpktujuan_tl_lamp a
								LEFT JOIN trd_tlhp_bpktujuan_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND b.`status` = '1'
							) AS nilai_s,
							(SELECT COALESCE (sum(b.nilai), 0)
								FROM trd_tlhp_bpktujuan_tl_lamp a
								LEFT JOIN trd_tlhp_bpktujuan_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND b.`status` = '2'
							) AS nilai_bs,
							(SELECT COALESCE (sum(b.nilai), 0)
								FROM trd_tlhp_bpktujuan_tl_lamp a
								LEFT JOIN trd_tlhp_bpktujuan_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND b.`status` = '3'
							) AS nilai_bd,
							(SELECT COALESCE (sum(b.nilai), 0) 
								FROM trd_tlhp_bpktujuan_tl_lamp a
								LEFT JOIN trd_tlhp_bpktujuan_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND b.`status` = '4'
							) AS nilai_tdtp

							FROM trd_tlhp_bpktujuan_rekomendasi rk
							$where
							$group
						) ms
						$where2
						;
					";
					
				break;

				case 'data_temuan_detail_head':
				case 'data_temuan_detail':
					$filter = $this->input->post('filter');
					$thn_end = $this->input->post('tahun_end');

					if ($type == "data_temuan_detail_head") {
						if ($filter) {
							if ($filter == "thn") {
								$where .= "
								AND noreg = '".$p1."'
								"; 
								$group = "GROUP BY kd_rekom";
							}else if ($filter == "thn_all") {
								if ($thn_end != "") {
									$where .= "
									AND tahun BETWEEN '".$p3."' AND '".$thn_end."'
									";
								}else{
									$where .= "
									AND tahun ='".$p3."'
									";
								}
								
								$group ="";
							}else if ($filter == "satker") {
								$where .= "
								AND noreg = '".$p1."'
								";
								$group = "GROUP BY kd_rekom";
							}else{
								$where .= "";
								$group ="";
							}
						}else{
							$where .= "
							AND noreg = '".$p1."'
							"; 
							$group = "GROUP BY kd_rekom";
						}
					}else{
						if ($filter) {
							if ($filter == "thn") {
								$where .= "
								AND noreg = '".$p1."' AND no_lhp = '".$p2."'
								"; 
								$group = "GROUP BY kd_rekom";
							}else if ($filter == "thn_all") {
								$where .= "
								AND noreg = '".$p1."' 
								";
								$group = "GROUP BY kd_rekom";
							}else if ($filter == "satker") {
								$where .= "
								AND noreg = '".$p1."'
								";
								$group = "GROUP BY kd_rekom";
							}else{
								$where .= "";
								$group ="";
							}
						}else{
							$where .= "
							AND noreg = '".$p1."' AND no_lhp = '".$p2."'
							";

							$group = "GROUP BY kd_rekom"; 
						}
					}

					$sql="
						SELECT *,
							CASE
								WHEN jml_tl = 0 THEN 'BD'
								WHEN jml_tl = ms.s THEN 'S'
								WHEN tdtp 	> 0 THEN 'TDTP'
								WHEN jml_tl = ms.bd THEN 'BD'
							ELSE 'BS'
							END as sts_rekom
						FROM(SELECT RIGHT(noreg,4) AS id, kd_rekom, noreg, no_lhp, tahun,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpktujuan_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A') as jml_tl,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpktujuan_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'SESUAI') as s,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpktujuan_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'BELUM SESUAI') as bs,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpktujuan_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'BELUM DITINDAKLANJUTI') as bd,
							(SELECT count(kd_rekomendasi) FROM trd_tlhp_bpktujuan_tl_lamp WHERE noreg = rk.noreg and no_lhp = rk.no_lhp AND kd_rekomendasi = rk.kd_rekom AND jns_tl='A' AND `status` = 'TIDAK DAPAT DITINDAKLANJUTI') as tdtp,

							(SELECT COALESCE (sum(b.nilai), 0)
								FROM trd_tlhp_bpktujuan_tl_lamp a
								LEFT JOIN trd_tlhp_bpktujuan_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND b.`status` = '1'
							) AS nilai_s,
							(SELECT COALESCE (sum(b.nilai), 0)
								FROM trd_tlhp_bpktujuan_tl_lamp a
								LEFT JOIN trd_tlhp_bpktujuan_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND b.`status` = '2'
							) AS nilai_bs,
							(SELECT COALESCE (sum(b.nilai), 0)
								FROM trd_tlhp_bpktujuan_tl_lamp a
								LEFT JOIN trd_tlhp_bpktujuan_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND b.`status` = '3'
							) AS nilai_bd,
							(SELECT COALESCE (sum(b.nilai), 0) 
								FROM trd_tlhp_bpktujuan_tl_lamp a
								LEFT JOIN trd_tlhp_bpktujuan_tl_satker b ON a.noreg = b.noreg
								AND a.no_lhp = b.no_lhp AND a.kd_temuan = b.kd_temuan AND a.kd_rekomendasi = b.kd_rekomendasi
								AND a.kd_tl=b.kd_tl
								WHERE a.noreg = rk.noreg
								AND a.no_lhp = rk.no_lhp
								AND a.kd_rekomendasi = rk.kd_rekom
								AND b.`status` = '4'
							) AS nilai_tdtp

							FROM trd_tlhp_bpktujuan_rekomendasi rk
							$where
							$group
						) ms
						;
					";
					// echo $sql;exit;
					
				break;

				case 'data_temuan_satker':
					$thn = $this->input->post('tahun');
					$thn_end = $this->input->post('tahun_end');
					$id_instansi = $this->input->post('id_instansi');
					$flag = $this->input->post('flag');
					$filter = $this->input->post('filter');

					if ($thn != "" && $thn_end == "") {
						$where2 .= "
						AND t.tahun = '".$thn."'
						";
					}

					if ($thn == "" && $thn_end == "") {
						$where2 .= "
						AND t.tahun = '".$thn."'
						";
					}

					if ($thn_end != "" && $thn != "") {
						$where2 .= "
						AND t.tahun BETWEEN '".$thn."' AND '".$thn_end."'
						";
					} 
					if ($id_instansi) {
						$where .= "
						AND A.id_instansi = '".$id_instansi."'
						";
					}

					if ($flag) {
						$where .= "
						AND A.flag = '".$flag."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
					}


					if ($filter) {
						if ($filter == "thn") {
							$group = "GROUP BY A.id_instansi"; 
						}else if ($filter == "thn_all") {
							$group = "GROUP BY B.tahun";
						}else if ($filter == "satker") {
							$group = "GROUP BY A.id_instansi";
						}else{
							$group = "";
						}
					}

					$sql = "
						SELECT A.*, B.noreg,B.no_lhp,B.tahun, COALESCE(SUM(B.jml_temuan), 0) AS jml_temuan, 
						COALESCE(SUM(B.jml_rekomendasi), 0) AS jml_rekomendasi, 
						COALESCE(SUM(B.nilai_temuan), 0) AS nilai_temuan, 
						COALESCE(SUM(B.nilai_rekomendasi), 0) AS jml_nilai_rekomendasi, 
						COALESCE(SUM(B.jml_setor), 0) AS jml_setor,
						COALESCE(SUM(B.jml_setor_1), 0) AS jml_setor_s,
						COALESCE(SUM(B.jml_setor_2), 0) AS jml_setor_bs,
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_setor_bd,
						COALESCE(SUM(B.jml_setor_4), 0) AS jml_setor_tptd, 
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_nilai_sisa, 
						COALESCE(SUM(B.nilai_lebih), 0) AS jml_nilai_lebih, 
						ROUND((COALESCE (SUM(B.jml_setor), 0) / COALESCE (SUM(B.nilai_temuan), 0))*100,2) AS persentase 
						FROM 
							ms_instansi_kemendagri A 
						LEFT JOIN 
							(SELECT RIGHT (noreg, 4) AS id, noreg,no_lhp,tahun,sum(nilai_temuan_satker) as nilai_temuan, 
								sum(nilai_rek) as nilai_rekomendasi, sum(nilai_set) as jml_setor, 
								sum(nilai_set_1) as jml_setor_1,sum(nilai_set_2) as jml_setor_2,
								sum(nilai_set_3) as jml_setor_3,sum(nilai_set_4) as jml_setor_4, 
								sum(jmlsisa) as nilai_sisa, sum(jmllebih) as nilai_lebih, 
								count(tahun) AS jml_temuan, sum(jml_rekom) as jml_rekomendasi 
							FROM
								(SELECT t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan,t.nilai_temuan_satker,
									SUM(a.nilai_rekom) as nilai_rek, SUM(a.nilai_setor) as nilai_set,
									SUM(a.nilai_1) as nilai_set_1,SUM(a.nilai_2) as nilai_set_2,
									SUM(a.nilai_3) as nilai_set_3,SUM(a.nilai_4) as nilai_set_4,
									SUM(a.sisa) as jmlsisa,SUM(a.lebih) as jmllebih, count(nilai_rekom) as jml_rekom 
								FROM 
									trd_tlhp_bpktujuan_temuan t 
								LEFT JOIN 
									(SELECT r.noreg,r.no_lhp,r.tahun,r.kd_temuan,r.kd_rekom,r.nilai_rekom,
										sum(nilai_1) as nilai_setor,
										CASE WHEN r.nilai_rekom < sum(nilai_1) THEN (r.nilai_rekom) 
										ELSE sum(nilai_1) END as nilai_1,sum(nilai_2) as nilai_2,
										sum(nilai_3) as nilai_3,sum(nilai_4) as nilai_4,
										CASE WHEN ISNULL(sum(nilai_1)) OR sum(nilai_1)=0 THEN r.nilai_rekom 
										WHEN r.nilai_rekom > sum(nilai_1) THEN (r.nilai_rekom - sum(nilai_1)) 
										ELSE 0 END as sisa,
										CASE WHEN sum(nilai_1) > r.nilai_rekom THEN (sum(nilai_1)-r.nilai_rekom) 
										ELSE 0 END as lebih
									FROM 
										trd_tlhp_bpktujuan_rekomendasi r 
									LEFT JOIN 
										(SELECT noreg,no_lhp,kd_temuan,kd_rekomendasi,kd_tl,kd_lamp,status,nilai,
											CASE WHEN status = 1 THEN (nilai) 
											ELSE 0 END as nilai_1,
											CASE WHEN status = 2 THEN (nilai) 
											ELSE 0 END as nilai_2,
											CASE WHEN status = 3 THEN (nilai) 
											ELSE 0 END as nilai_3,
											CASE WHEN status = 4 THEN (nilai) 
											ELSE 0 END as nilai_4
										FROM trd_tlhp_bpktujuan_tl_satker) s 
											on s.noreg = r.noreg AND r.no_lhp = s.no_lhp 
											AND r.kd_temuan = s.kd_temuan AND r.kd_rekom = s.kd_rekomendasi 
											GROUP BY r.noreg,r.no_lhp,r.kd_temuan,r.kd_rekom,r.nilai_rekom 
										) a 
										on a.noreg = t.noreg AND a.no_lhp = t.no_lhp AND t.tahun = a.tahun 
										AND t.kd_temuan = a.kd_temuan $where2 
										GROUP BY t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan
									) g 
									GROUP BY noreg ORDER BY noreg
								)B 
								ON A.id_instansi= B.id $where AND B.noreg IS NOT NULL $group";

					

					// echo $sql;exit;
				break;
				case 'data_temuan_satker_detail':
					$thn = $this->input->post('tahun');
					$thn_end = $this->input->post('tahun_end');
					$id_instansi = $this->input->post('id_instansi');
					$flag = $this->input->post('flag');
					$filter = $this->input->post('filter');

					if ($flag) {
						$where .= "
						AND A.flag = '".$flag."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
					}

			
					if ($filter) {
						if ($filter == "thn") {
							if ($p1) {
								$where .= "
								AND A.id_instansi = '".$p1."'
								";
							}
							if ($p2) {
								$where .= "
								AND B.tahun = '".$p2."'
								";
							}
							$group = "GROUP BY A.id_instansi,B.no_lhp";
							$group2 = "GROUP BY noreg, no_lhp";
						}else if ($filter == "thn_all") {
							if ($p2) {
								$where .= "
								AND B.tahun = '".$p2."'
								";
							}
							$group = "GROUP BY A.id_instansi";
							$group2 = "GROUP BY noreg, no_lhp";
						}else if ($filter == "satker") {
							if ($p1) {
								$where .= "
								AND A.id_instansi = '".$p1."'
								";
							}
							$group = "GROUP BY B.tahun";
							$group2 = "GROUP BY noreg, no_lhp";
						}else{
							if ($p1) {
								$where .= "
								AND A.id_instansi = '".$p1."'
								";
							}
							if ($p2) {
								$where .= "
								AND B.tahun = '".$p2."'
								";
							}
							$group = "";
							$group2 = "";
						}
					}
					$sql = "
						SELECT A.*, B.noreg,B.no_lhp,B.tahun, COALESCE(SUM(B.jml_temuan), 0) AS jml_temuan, 
						COALESCE(SUM(B.jml_rekomendasi), 0) AS jml_rekomendasi, 
						COALESCE(SUM(B.nilai_temuan), 0) AS nilai_temuan, 
						COALESCE(SUM(B.nilai_rekomendasi), 0) AS jml_nilai_rekomendasi, 
						COALESCE(SUM(B.jml_setor), 0) AS jml_setor,
						COALESCE(SUM(B.jml_setor_1), 0) AS jml_setor_s,
						COALESCE(SUM(B.jml_setor_2), 0) AS jml_setor_bs,
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_setor_bd,
						COALESCE(SUM(B.jml_setor_4), 0) AS jml_setor_tptd, 
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_nilai_sisa, 
						COALESCE(SUM(B.nilai_lebih), 0) AS jml_nilai_lebih, 
						ROUND((COALESCE (SUM(B.jml_setor), 0) / COALESCE (SUM(B.nilai_temuan), 0))*100,2) AS persentase 
						FROM 
							ms_instansi_kemendagri A 
						LEFT JOIN 
							(SELECT RIGHT (noreg, 4) AS id, noreg,no_lhp,tahun,sum(nilai_temuan_satker) as nilai_temuan, 
								sum(nilai_rek) as nilai_rekomendasi, sum(nilai_set) as jml_setor, 
								sum(nilai_set_1) as jml_setor_1,sum(nilai_set_2) as jml_setor_2,
								sum(nilai_set_3) as jml_setor_3,sum(nilai_set_4) as jml_setor_4, 
								sum(jmlsisa) as nilai_sisa, sum(jmllebih) as nilai_lebih, 
								count(tahun) AS jml_temuan, sum(jml_rekom) as jml_rekomendasi 
							FROM
								(SELECT t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan,t.nilai_temuan_satker,
									SUM(a.nilai_rekom) as nilai_rek, SUM(a.nilai_setor) as nilai_set,
									SUM(a.nilai_1) as nilai_set_1,SUM(a.nilai_2) as nilai_set_2,
									SUM(a.nilai_3) as nilai_set_3,SUM(a.nilai_4) as nilai_set_4,
									SUM(a.sisa) as jmlsisa,SUM(a.lebih) as jmllebih, count(nilai_rekom) as jml_rekom 
								FROM 
									trd_tlhp_bpktujuan_temuan t 
								LEFT JOIN 
									(SELECT r.noreg,r.no_lhp,r.tahun,r.kd_temuan,r.kd_rekom,r.nilai_rekom,
										sum(nilai_1) as nilai_setor,
										CASE WHEN r.nilai_rekom < sum(nilai_1) THEN (r.nilai_rekom) 
										ELSE sum(nilai_1) END as nilai_1,sum(nilai_2) as nilai_2,
										sum(nilai_3) as nilai_3,sum(nilai_4) as nilai_4,
										CASE WHEN ISNULL(sum(nilai_1)) OR sum(nilai_1)=0 THEN r.nilai_rekom 
										WHEN r.nilai_rekom > sum(nilai_1) THEN (r.nilai_rekom - sum(nilai_1)) 
										ELSE 0 END as sisa,
										CASE WHEN sum(nilai_1) > r.nilai_rekom THEN (sum(nilai_1)-r.nilai_rekom) 
										ELSE 0 END as lebih
									FROM 
										trd_tlhp_bpktujuan_rekomendasi r 
									LEFT JOIN 
										(SELECT noreg,no_lhp,kd_temuan,kd_rekomendasi,kd_tl,kd_lamp,status,nilai,
											CASE WHEN status = 1 THEN (nilai) 
											ELSE 0 END as nilai_1,
											CASE WHEN status = 2 THEN (nilai) 
											ELSE 0 END as nilai_2,
											CASE WHEN status = 3 THEN (nilai) 
											ELSE 0 END as nilai_3,
											CASE WHEN status = 4 THEN (nilai) 
											ELSE 0 END as nilai_4
										FROM trd_tlhp_bpktujuan_tl_satker) s 
											on s.noreg = r.noreg AND r.no_lhp = s.no_lhp 
											AND r.kd_temuan = s.kd_temuan AND r.kd_rekom = s.kd_rekomendasi 
											GROUP BY r.noreg,r.no_lhp,r.kd_temuan,r.kd_rekom,r.nilai_rekom 
										) a 
										on a.noreg = t.noreg AND a.no_lhp = t.no_lhp AND t.tahun = a.tahun 
										AND t.kd_temuan = a.kd_temuan
										GROUP BY t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan
									) g 
							$group2 
							ORDER BY noreg
						)B ON A.id_instansi= B.id
						$where
						$group
					";
					
					// echo $sql;exit;
				break;

				case 'data_temuan_satker_struktur':
				case 'data_temuan_satker_struktur_adm':
					$thn = $this->input->post('tahun');
					$thn_end = $this->input->post('tahun_end');
					$id_instansi = $this->input->post('id_instansi');
					$flag = $this->input->post('flag');
					$filter = $this->input->post('filter');



					if ($thn != "" && $thn_end == "") {
						$where2 .= "
						AND t.tahun = '".$thn."'
						";
					}

					if ($thn == "" && $thn_end == "") {
						$where2 .= "
						AND t.tahun = '".$thn."'
						";
					}

					if ($thn_end != "" && $thn != "") {
						$where2 .= "
						AND t.tahun BETWEEN '".$thn."' AND '".$thn_end."'
						";
					} 


					if ($id_instansi) {
						$where .= "
						AND A.id_instansi = '".$id_instansi."'
						";
					}

					if ($flag) {
						$where .= "
						AND A.flag = '".$flag."'
						";
					}

					if ($is_admin != 1) {
						$where .= "
						AND A.id_instansi = '".$daerah."'
						";
					}else{
						// if ($p1 == "default") {
						// 	$where .= "
						// 	AND A.group NOT IN (13,14)
						// 	AND B.noreg IS NOT NULL
						// 	";
						// }else if ($p1 == "all_struktur") {
						// 	$where .= "
						// 	AND A.group NOT IN (13,14)
						// 	AND B.noreg IS NOT NULL
						// 	";
						// }else{
						// 	$where .= "
						// 	AND B.noreg IS NOT NULL";
						// }
						if ($p2 == "bnpp") {
							$where .= "
							AND A.group = 13
							";
						}else if($p2 == "dkpp"){
							$where .= "
							AND A.group = 14
							";
						}else if ($p2 == "kemendagri") {
							$where .= "
							AND A.group NOT IN (13,14)
							";
						}else{
							$where .= "
							
							";
						}

						if ($p1 == "default") {
							$where .= "
							AND B.noreg IS NOT NULL
							";
						}else if ($p1 == "all_struktur") {
							$where .= "
							AND B.noreg IS NOT NULL
							";
							
						}else{
							$where .= "
							AND B.noreg IS NOT NULL";
						}
						
					}

					if ($type == 'data_temuan_satker_struktur_adm') {
						$order = 'ORDER BY jml_temuan DESC';
					}else{
						$order = '';
					}

					$sql = "
SELECT A.*, B.noreg,B.no_lhp,B.tahun, COALESCE(SUM(B.jml_temuan), 0) AS jml_temuan, 
						COALESCE(SUM(B.jml_rekomendasi), 0) AS jml_rekomendasi, 
						COALESCE(SUM(B.nilai_temuan), 0) AS nilai_temuan, 
						COALESCE(SUM(B.nilai_rekomendasi), 0) AS jml_nilai_rekomendasi, 
						COALESCE(SUM(B.jml_setor), 0) AS jml_setor,
						COALESCE(SUM(B.jml_setor_1), 0) AS jml_setor_s,
						COALESCE(SUM(B.jml_setor_2), 0) AS jml_setor_bs,
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_setor_bd,
						COALESCE(SUM(B.jml_setor_4), 0) AS jml_setor_tptd, 
						COALESCE(SUM(B.nilai_sisa), 0) AS jml_nilai_sisa, 
						COALESCE(SUM(B.nilai_lebih), 0) AS jml_nilai_lebih, 
						ROUND((COALESCE (SUM(B.jml_setor), 0) / COALESCE (SUM(B.nilai_temuan), 0))*100,2) AS persentase 
						FROM 
							ms_instansi_kemendagri A 
						LEFT JOIN 
							(SELECT RIGHT (noreg, 4) AS id, noreg,no_lhp,tahun,sum(nilai_temuan_satker) as nilai_temuan, 
								sum(nilai_rek) as nilai_rekomendasi, sum(nilai_set) as jml_setor, 
								sum(nilai_set_1) as jml_setor_1,sum(nilai_set_2) as jml_setor_2,
								sum(nilai_set_3) as jml_setor_3,sum(nilai_set_4) as jml_setor_4, 
								sum(jmlsisa) as nilai_sisa, sum(jmllebih) as nilai_lebih, 
								count(tahun) AS jml_temuan, sum(jml_rekom) as jml_rekomendasi 
							FROM
								(SELECT t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan,t.nilai_temuan_satker,
									SUM(a.nilai_rekom) as nilai_rek, SUM(a.nilai_setor) as nilai_set,
									SUM(a.nilai_1) as nilai_set_1,SUM(a.nilai_2) as nilai_set_2,
									SUM(a.nilai_3) as nilai_set_3,SUM(a.nilai_4) as nilai_set_4,
									SUM(a.sisa) as jmlsisa,SUM(a.lebih) as jmllebih, count(nilai_rekom) as jml_rekom 
								FROM 
									trd_tlhp_bpktujuan_temuan t 
								LEFT JOIN 
									(SELECT r.noreg,r.no_lhp,r.tahun,r.kd_temuan,r.kd_rekom,r.nilai_rekom,
										sum(nilai_1) as nilai_setor,
										CASE WHEN r.nilai_rekom < sum(nilai_1) THEN (r.nilai_rekom) 
										ELSE sum(nilai_1) END as nilai_1,sum(nilai_2) as nilai_2,
										sum(nilai_3) as nilai_3,sum(nilai_4) as nilai_4,
										CASE WHEN ISNULL(sum(nilai_1)) OR sum(nilai_1)=0 THEN r.nilai_rekom 
										WHEN r.nilai_rekom > sum(nilai_1) THEN (r.nilai_rekom - sum(nilai_1)) 
										ELSE 0 END as sisa,
										CASE WHEN sum(nilai_1) > r.nilai_rekom THEN (sum(nilai_1)-r.nilai_rekom) 
										ELSE 0 END as lebih
									FROM 
										trd_tlhp_bpktujuan_rekomendasi r 
									LEFT JOIN 
										(SELECT noreg,no_lhp,kd_temuan,kd_rekomendasi,kd_tl,kd_lamp,status,nilai,
											CASE WHEN status = 1 THEN (nilai) 
											ELSE 0 END as nilai_1,
											CASE WHEN status = 2 THEN (nilai) 
											ELSE 0 END as nilai_2,
											CASE WHEN status = 3 THEN (nilai) 
											ELSE 0 END as nilai_3,
											CASE WHEN status = 4 THEN (nilai) 
											ELSE 0 END as nilai_4
										FROM trd_tlhp_bpktujuan_tl_satker) s 
											on s.noreg = r.noreg AND r.no_lhp = s.no_lhp 
											AND r.kd_temuan = s.kd_temuan AND r.kd_rekom = s.kd_rekomendasi 
											GROUP BY r.noreg,r.no_lhp,r.kd_temuan,r.kd_rekom,r.nilai_rekom 
										) a 
										on a.noreg = t.noreg AND a.no_lhp = t.no_lhp AND t.tahun = a.tahun 
										AND t.kd_temuan = a.kd_temuan $where2 
										GROUP BY t.noreg,t.no_lhp,t.tahun,t.id_aspek,t.kd_temuan
									) g 
							GROUP BY noreg, no_lhp 
							ORDER BY noreg
						)B ON A.id_instansi= B.id
						$where
						GROUP BY A.id_instansi, B.no_lhp
						$order
					";

					

					// echo $sql;exit;
				break;

			}



			if($balikan == 'json'){
				return $this->lib->json_grid($sql,$type);
			}elseif($balikan == 'row_array'){
				return $this->db->query($sql)->row_array();
			}elseif($balikan == 'result'){
				return $this->db->query($sql)->result();
			}elseif($balikan == 'result_array'){
				return $this->db->query($sql)->result_array();
			}elseif($balikan == 'json_variable'){
				return json_encode($array);
			}elseif($balikan == 'json_encode'){
				$data = $this->db->query($sql)->result_array(); 
				return json_encode($data);
			}elseif($balikan == 'variable'){
				return $array;
			}elseif($balikan == 'json_datatable'){
				return $this->lib->json_datatable($sql, $type);
			}

		}
	}