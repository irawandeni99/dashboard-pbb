<?php
/**
 *
 * Dynmic_menu.php
 *
 */
class Dynamic_menu {
    private $ci;                // for CodeIgniter Super Global Reference.
    private $id_menu        = 'id="menu"';
    private $class_menu     = 'class="menu"';
    private $class_notif     = 'class="notification-item"';
    private $class_parent   = 'class="parent"';
    private $class_last     = 'class="last"';
    // --------------------------------------------------------------------
    /**
     * PHP5        Constructor
     *
     */
    function __construct()
    {
        $this->ci =& get_instance();    // get a reference to CodeIgniter.
    }
    // --------------------------------------------------------------------
    /**
     * build_menu($table, $type)
     *
     * Description:
     *
     * builds the Dynaminc dropdown menu
     * $table allows for passing in a MySQL table name for different menu tables.
     * $type is for the type of menu to display ie; topmenu, mainmenu, sidebar menu
     * or a footer menu.
     *
     * @param    string    the MySQL database table name.
     * @param    string    the type of menu to display.
     * @return    string    $html_out using CodeIgniter achor tags.
     */
	 
	function buildmenu ($parentId=0)
	{      
		$data 	= $this->ci->encrypt->decode($this->ci->session->userdata('mn'));	

		$dtMenu = array();				
		// if ($data != ''){
		$this->ci->load->model('Template_model', 'temp_model');
		$menuData = $this->ci->temp_model->getMenuItems($data);
		
		return $this->getMenu ($parentId, $menuData);
	}


    function EncryptLink ($link)
    {
        $res = str_replace('=','',base64_encode($link));
        return $res;
    }

    function DecryptLink ($link)
    {
        $res = base64_decode($link);
        return $res;
    }

    function get_count_notif()
    {
        $tahun   = $this->ci->session->userdata('year_selected');
        $akses   = $this->ci->session->userdata('is_admin');
        $user_id      = $this->ci->session->userdata('admin_id');
        $id      = $this->ci->session->userdata('id_kab');  
        $apps    = $this->ci->session->userdata('apps_modul');  
        
        $id_prov        = $this->ci->session->userdata('id_prov'); 
        $id_instansi    = $this->ci->session->userdata('id_instansi'); 
        $id_ins         = $this->ci->session->userdata('id_ins'); 
		
	
		if ($akses == 1) {
			$q      = "SELECT z.id,z.aksi,z.tahun,z.kd_apip,IFNULL(z.kd_elemen,'')kd_elemen,IFNULL(z.kd_topik,'')kd_topik,IFNULL(z.kd_level,'')kd_level,
						IFNULL(z.kd_penilaian,'')kd_penilaian,z.uraian,
						z.user_id,z.user_type,z.user_date,z.status,z.kd_file,z.routes,z.jenis,z.tampil,z.nilai,IFNULL(z.keterangan,'')keterangan,
						CASE WHEN z.jenis=2 || z.jenis=3  THEN (SELECT nm_elemen FROM ms_elemen WHERE kd_elemen=z.kd_elemen)
						ELSE
						''
						END AS nm_elemen,
						CASE WHEN z.jenis=2 || z.jenis=3  THEN (SELECT nm_topik FROM ttopik WHERE tahun=z.tahun AND kd_apip=z.kd_apip AND kd_elemen=z.kd_elemen AND kd_topik=z.kd_topik)
						ELSE
						''
						END AS nm_topik,
						CASE WHEN  z.jenis=3  THEN (SELECT uraian FROM tpenilaian WHERE tahun=z.tahun AND kd_apip=z.kd_apip AND kd_elemen=z.kd_elemen AND kd_topik=z.kd_topik and kd_penilaian=z.kd_penilaian)
							ELSE
							''
							END AS nm_penilaian
						FROM(
							SELECT a.* FROM thistory a inner join ms_user b on a.user_id=b.id_user WHERE (a.user_type <> 1 and b.is_admin<>1) AND a.status <>1   
						    and a.tampil=1 and a.kd_apip='".$id_instansi."' and a.tahun='".$tahun."')z ORDER BY user_date desc";
			$query  = $this->ci->db->query($q);
		}else{

				$csql  = "SELECT z.id,z.aksi,z.tahun,z.kd_apip,IFNULL(z.kd_elemen,'')kd_elemen,IFNULL(z.kd_topik,'')kd_topik,IFNULL(z.kd_level,'')kd_level,
							IFNULL(z.kd_penilaian,'')kd_penilaian,z.uraian,
							z.user_id,z.user_type,z.user_date,z.status,z.kd_file,z.routes,z.jenis,z.tampil,z.nilai,IFNULL(z.keterangan,'')keterangan,
							CASE WHEN z.jenis=2 || z.jenis=3  THEN (SELECT nm_elemen FROM ms_elemen WHERE kd_elemen=z.kd_elemen)
							ELSE
							''
							END AS nm_elemen,
							CASE WHEN z.jenis=2 || z.jenis=3  THEN (SELECT nm_topik FROM ttopik WHERE tahun=z.tahun AND kd_apip=z.kd_apip AND kd_elemen=z.kd_elemen AND kd_topik=z.kd_topik)
							ELSE
							''
							END AS nm_topik,							
							CASE WHEN  z.jenis=3  THEN (SELECT uraian FROM tpenilaian WHERE tahun=z.tahun AND kd_apip=z.kd_apip AND kd_elemen=z.kd_elemen AND kd_topik=z.kd_topik and kd_penilaian=z.kd_penilaian and kd_level=z.kd_level)
							ELSE
							''
							END AS nm_penilaian
							FROM(
							   SELECT a.*FROM thistory a
								INNER JOIN ms_group_menu_elemen b ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip AND a.kd_elemen=b.kd_elemen AND a.kd_topik=b.kd_topik and a.id_penerima=b.id_group
								WHERE b.id_group='".$akses."' and a.kd_apip='".$id_instansi."' and a.tahun='".$tahun."' and a.jenis=2 AND status <>1 and a.user_id<>'".$user_id."' 
								
							 union
								 SELECT a.*FROM thistory a
								 INNER JOIN ms_group_menu_elemen b ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip AND a.kd_elemen=b.kd_elemen AND a.kd_topik=b.kd_topik and a.id_penerima=b.id_group
								 WHERE b.id_group='".$akses."'  and a.kd_apip='".$id_instansi."' and a.tahun='".$tahun."' and a.jenis=3 AND a.status <>1 and a.user_id<>'".$user_id."' 
							union
								SELECT * FROM thistory WHERE thistory.user_type = 1 
								and tampil=1 and kd_apip='".$id_instansi."' and tahun='".$tahun."' and jenis=4 AND status <>1 and id_penerima='".$akses."'
							union
								 SELECT a.*FROM thistory a
								 INNER JOIN ms_group_menu_elemen b ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip and a.id_penerima=b.id_group
								 WHERE b.id_group='".$akses."'  and a.kd_apip='".$id_instansi."' and a.tahun='".$tahun."' and a.jenis=5	and a.user_id<>'".$user_id."' AND a.status <>1  								
							
							)z  ORDER BY user_date desc";					   
			
					   
			$query  = $this->ci->db->query($csql);	
		}	
		

        $errCode = $this->ci->db->error();
        if ($errCode['code'] == 0) {
            $jml = $query->num_rows();
            if ($jml > 100) {
                $jml = '+99';
            }
        }else{
            $jml = 0;
        } 
        

        return $jml;
    }


    function get_notif ()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data   = $this->ci->encrypt->decode($this->ci->session->userdata('mn'));
        
        
        $dtMenu = array();
        $menu   = array();
        $akses          = $this->ci->session->userdata('is_admin');
        $tahun       = $this->ci->session->userdata('year_selected');
        
        $id             = $this->ci->session->userdata('id_kab'); 
        $id_prov        = $this->ci->session->userdata('id_prov'); 
        $id_instansi    = $this->ci->session->userdata('id_instansi'); 
      //  $id_ins         = $this->ci->session->userdata('id_ins'); 
        $user_id      = $this->ci->session->userdata('user_id');  
        // $user_id      = $this->ci->session->userdata('admin_id');  
      //  $apps    = $this->ci->session->userdata('apps_modul'); 

		if ($akses == 1) {
			$q      = "SELECT z.id,z.aksi,z.tahun,z.kd_apip,IFNULL(z.kd_elemen,'')kd_elemen,IFNULL(z.kd_topik,'')kd_topik,IFNULL(z.kd_level,'')kd_level,
						IFNULL(z.kd_penilaian,'')kd_penilaian,z.uraian,
						z.user_id,z.user_type,z.user_date,z.status,z.kd_file,z.routes,z.jenis,z.tampil,z.nilai,IFNULL(z.keterangan,'')keterangan,
						CASE WHEN z.jenis=2 || z.jenis=3  THEN (SELECT nm_elemen FROM ms_elemen WHERE kd_elemen=z.kd_elemen)
						ELSE
						''
						END AS nm_elemen,
						CASE WHEN z.jenis=2 || z.jenis=3  THEN (SELECT nm_topik FROM ttopik WHERE tahun=z.tahun AND kd_apip=z.kd_apip AND kd_elemen=z.kd_elemen AND kd_topik=z.kd_topik)
						ELSE
						''
						END AS nm_topik,
						CASE WHEN  z.jenis=3  THEN (SELECT uraian FROM tpenilaian WHERE tahun=z.tahun AND kd_apip=z.kd_apip AND kd_elemen=z.kd_elemen AND kd_topik=z.kd_topik and kd_penilaian=z.kd_penilaian)
							ELSE
							''
							END AS nm_penilaian
						FROM(
							SELECT a.* FROM thistory a inner join ms_user b on a.user_id=b.id_user WHERE (a.user_type <> 1 and b.is_admin<>1) AND a.status = 'BELUM DIBACA'  
						    and a.tampil=1 and a.kd_apip='".$id_instansi."' and a.tahun='".$tahun."' and a.status<>1)z ORDER BY user_date desc LIMIT 4";
			$query  = $this->ci->db->query($q);
		}else{

				$csql  = "SELECT z.id,z.aksi,z.tahun,z.kd_apip,IFNULL(z.kd_elemen,'')kd_elemen,IFNULL(z.kd_topik,'')kd_topik,IFNULL(z.kd_level,'')kd_level,
							IFNULL(z.kd_penilaian,'')kd_penilaian,z.uraian,
							z.user_id,z.user_type,z.user_date,z.status,z.kd_file,z.routes,z.jenis,z.tampil,z.nilai,IFNULL(z.keterangan,'')keterangan,
							CASE WHEN z.jenis=2 || z.jenis=3  THEN (SELECT nm_elemen FROM ms_elemen WHERE kd_elemen=z.kd_elemen)
							ELSE
							''
							END AS nm_elemen,
							CASE WHEN z.jenis=2 || z.jenis=3  THEN (SELECT nm_topik FROM ttopik WHERE tahun=z.tahun AND kd_apip=z.kd_apip AND kd_elemen=z.kd_elemen AND kd_topik=z.kd_topik)
							ELSE
							''
							END AS nm_topik,							
							CASE WHEN  z.jenis=3  THEN (SELECT uraian FROM tpenilaian WHERE tahun=z.tahun AND kd_apip=z.kd_apip AND kd_elemen=z.kd_elemen AND kd_topik=z.kd_topik and kd_penilaian=z.kd_penilaian and kd_level=z.kd_level)
							ELSE
							''
							END AS nm_penilaian
							FROM(
							   SELECT a.*FROM thistory a
								INNER JOIN ms_group_menu_elemen b ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip AND a.kd_elemen=b.kd_elemen AND a.kd_topik=b.kd_topik and a.id_penerima=b.id_group
								WHERE b.id_group='".$akses."' and a.kd_apip='".$id_instansi."' and a.tahun='".$tahun."' and a.jenis=2 and a.status<>1 and a.user_id<>'".$user_id."'  
									
								 union
									 SELECT a.*FROM thistory a
									 INNER JOIN ms_group_menu_elemen b ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip AND a.kd_elemen=b.kd_elemen AND a.kd_topik=b.kd_topik and a.id_penerima=b.id_group
									 WHERE b.id_group='".$akses."'  and a.kd_apip='".$id_instansi."' and a.tahun='".$tahun."' and a.jenis=3 and a.status<>1 and a.user_id<>'".$user_id."' 
								union
									SELECT * FROM thistory WHERE thistory.user_type = 1 
									and tampil=1 and kd_apip='".$id_instansi."' and tahun='".$tahun."' and jenis=4 and status<>1 and id_penerima='".$akses."'
								union
									 SELECT a.*FROM thistory a
									 INNER JOIN ms_group_menu_elemen b ON a.tahun=b.tahun AND a.kd_apip=b.kd_apip and a.id_penerima=b.id_group
									 WHERE b.id_group='".$akses."'  and a.kd_apip='".$id_instansi."' and a.tahun='".$tahun."' and a.jenis=5	and a.user_id<>'".$user_id."' and a.status<>1								
								
							)z  ORDER BY user_date desc LIMIT 4";					   
			
					   
			$query  = $this->ci->db->query($csql);	
		}	
		
   
        $html_out = "";
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $id         = $row->id;
                $_id        = $this->EncryptLink($id);
				
				$jenis         = $row->jenis;
				$nilai         = $row->nilai;
				$ctahun 	   = $row->tahun;
				$cinstansi	   = $row->kd_apip;
				$celemen	   = $row->kd_elemen;
				$ctopik	       = $row->kd_topik;
				$clevel		   = $row->kd_level;
				$cpenilaian	   = $row->kd_penilaian;
				$uraianaksi    = $row->uraian;
				$cketerangan   = $row->keterangan;
				$cnmelemen     = $row->nm_elemen;
				$cnmtopik	   = $row->nm_topik;
				$cnmpenilaian  = $row->nm_penilaian;

		if($jenis==2){
			
			if($nilai==0){
				$cicon = '<i class="fa fa-times fa-2x" style="color: #fc544b;"></i>';
				$uraianaksi=$uraianaksi.'&nbsp;&nbsp;&nbsp;&nbsp;'.$cicon.'<br>
				Elemen &nbsp;&nbsp;&nbsp;&nbsp;: '.$celemen.'&nbsp;&nbsp;'.$cnmelemen.'<br>
				Topik &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$ctopik.' &nbsp;'.$cnmtopik;

				
			}else{
				$cicon = '<i class="fa fa-check-square-o fa-2x" style="color: #3CCF4E;"></i>';
				$uraianaksi=$uraianaksi.'&nbsp;&nbsp;&nbsp;&nbsp;'.$cicon.'<br>
				Elemen &nbsp;&nbsp;&nbsp;&nbsp;: '.$celemen.'&nbsp;&nbsp; '.$cnmelemen.'<br>
				Topik &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$ctopik.' &nbsp;'.$cnmtopik;
			}
			
		}elseif($jenis==3){
			
			if($nilai==0){
				$cicon = '<i class="fa fa-times fa-2x" style="color: #fc544b;"></i>';
				$uraianaksi=$uraianaksi.'&nbsp;&nbsp;&nbsp;&nbsp;'.$cicon.'<br>
				Elemen &nbsp;&nbsp;&nbsp;&nbsp;: '.$celemen.'&nbsp'.$cnmelemen.'<br>
				Topik &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$ctopik.' &nbsp;'.$cnmtopik.'<br>
				Penilaian &nbsp;&nbsp;: '.$cpenilaian.' &nbsp;'.$cnmpenilaian.'<br>
				Level &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$clevel;

				
			}else{
				$cicon = '<i class="fa fa-check-square-o fa-2x" style="color: #3CCF4E;"></i>';
				$uraianaksi=$uraianaksi.'&nbsp;&nbsp;&nbsp;&nbsp;'.$cicon.'<br>
				Elemen &nbsp;&nbsp;&nbsp;&nbsp;: '.$celemen.'&nbsp; '.$cnmelemen.'<br>
				Topik &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$ctopik.' &nbsp;'.$cnmtopik.'<br>
				Penilaian &nbsp;&nbsp;: '.$cpenilaian.' &nbsp;'.$cnmpenilaian.'<br>
				Level &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$clevel;

			}
			
		}elseif($jenis==4){
					$cicon = '<i class="fa fa-file-pdf-o fa-2x" style="color: #EB1D36" aria-hidden="true"></i>';
					$uraianaksi=$uraianaksi.'&nbsp;&nbsp;&nbsp;&nbsp;'.$cicon.'<br>File &nbsp;&nbsp;&nbsp;&nbsp;: '.$cketerangan;
		}elseif($jenis==5){
			
			if($nilai==0){
				$cicon = '<i class="fa fa-unlock fa-2x" style="color: #069A8E;"></i>';
				$uraianaksi=$uraianaksi.'&nbsp;&nbsp;&nbsp;&nbsp;'.$cicon;

				
			}else{
				$cicon = '<i class="fa fa-lock fa-2x" style="color: #D61C4E;"></i>';
				$uraianaksi=$uraianaksi.'&nbsp;&nbsp;&nbsp;&nbsp;'.$cicon;

			}
			
			
		} 


                $aksi       = $row->aksi;
                
                $routes 	= $row->routes;
                $_routes 	= $this->EncryptLink($routes);

                $tgl_aksi = $row->user_date;
                $user_id = $row->user_id;
                $cekNamaUser = $this->ci->db->get_where('ms_user',array('id_user'=>$user_id))->row();
                $tgl_act = strtotime($tgl_aksi);
                $tgl_now = strtotime("now");
        
				$cont = $_routes;
				$link = base_url($cont);//.'?tahun='.$ctahun.'&instansi='.$cinstansi;
				
				// .'?noreg='.$_reg.'&no_lhp='.$_lhp.'&id='.$_id;
                  

                $diff = $tgl_now-$tgl_act;
                $d = floor($diff / (60 * 60 * 24));
                if ($d == 0) {
                    // jam saja
                    $ret= date('H:i', strtotime($tgl_aksi));
                }elseif ($d== 1) {
                    // kemarin dan jam
                    $retJam= date('H:i', strtotime($tgl_aksi));
                    $ret = 'Kemarin';
                }elseif ($d>1 && $d<7) {
                    // n hari lalu
                    $ret = $d.' Hari lalu';
                }elseif ($d==7) {
                    // 1 minggu lalu
                    $ret = 'Seminggu Lalu';
                }else{
                    // tanggal jam
                    $ret = date('d-m-Y', strtotime($tgl_aksi));
                }

                $sts = $row->status;
                if ($sts =='DILIHAT') {
                    $dot = " ";
                }else{
                    $dot = " bg-unread ";
                }
                // $d = $tgl_now->diff($tgl_act)->days + 1;
                if ($aksi == 'DELETEFILE' || $aksi == 'UPLOAD') {
                    $aktor = '';
                }else{
                    $aktor = '['.$cekNamaUser->name.']';
                }
               /*  if ($apps == 'PEMDA') {
                    $html_out.='<li class="'.$dot.'"><a href="'.$link.'" class="notification-item"><span class=""></span>
                    '.$aktor.' '.$uraianaksi.
                    ' <p class="pull-right" style="font-color:#ccc;padding-top:15px;"><i>'.$ret.'</i></p></a></li>';
                }else{ */
				
                    $html_out.='<li class="'.$dot.'"><a href="'.$link.'" class="notification-item" onclick="update_view('.$id.')"><span class=""></span>
                    '.$uraianaksi.
                    '<p class="pull-right" style="font-color:#ccc;padding-top:15px;"><i>'.$ret.'</i></p></a></li>';
					
					
            
			//   }
            }
        }
        $query->free_result();
        
        return $html_out;
    }  
	
	function getMenu ($parentId, $menuData)
	{
		$menu 	= array();
		$html 	= '';
		
		if (isset($menuData['parents'][$parentId]))
		{
			$html = '<ul>';
			foreach ($menuData['parents'][$parentId] as $itemId)
			{
				$html .= '<li>' . $menuData['items'][$itemId]['title'];

				// find childitems recursively
				$html .= $this->getMenu($itemId, $menuData);

				$html .= '</li>';
			}
			$html .= '</ul>';
		}

		return $html;
		
/*
		foreach ($res as $row) {
			
			if (in_array($row['parent_id'], $dtMenu)) {
				$dtMenu[$row['parent_id']]['child'][] = $row;
			}
			else {
				$dtMenu[$row['parent_id']]['name'] = $row['parentName'];
				$dtMenu[$row['parent_id']]['child'][] = $row;
			
			}
		}
		} */
		// return $dtMenu;
	}
	
    function build_menu2 ($table = 'sys_menu', $type = '2')
    {
        $data   = $this->ci->encrypt->decode($this->ci->session->userdata('mn'));
        
        if ($data == '') {
            redirect(base_url()); 
        }else{
            $dtMenu = array();
            $menu   = array();
            
            $q      = "SELECT * FROM sys_menu WHERE id_menu IN  (".$data.") order by id_menu";
            
            $query  = $this->ci->db->query($q);

            
            if ($query->num_rows() > 0)
            {
                foreach ($query->result() as $row)
                {
                    $menu[$row->id_menu]['id']            = $row->id_menu;
                    $menu[$row->id_menu]['title']        = $row->title;
                    $menu[$row->id_menu]['link']            = $row->link_type;
                    $menu[$row->id_menu]['page']            = $row->page_id;
                    $menu[$row->id_menu]['module']        = $row->module_name;
                    $menu[$row->id_menu]['url']            = $row->url;
                    $menu[$row->id_menu]['uri']            = $row->uri;
                    // $menu[$row->id]['dyn_group']    = $row->dyn_group_id;
                    $menu[$row->id_menu]['position']        = $row->position;
                    $menu[$row->id_menu]['target']        = $row->target;
                    $menu[$row->id_menu]['parent']        = $row->parent_id;
                    $menu[$row->id_menu]['is_parent']    = $row->is_parent;
                    $menu[$row->id_menu]['show']            = $row->show_menu;
                    $menu[$row->id_menu]['icon']            = $row->icon;
                }
            }else{
                header("location: base_url()",TRUE,301);
            }
            $query->free_result();
            // ----------------------------------------------------------------------
            
            // $menu= array_values($menu);
            // print_r($menu);
            // now we will build the dynamic menus.
            $html_out  = ""; //"\t".'<div '.$this->id_menu.'>'."\n";
            /**
             * check $type for the type of menu to display.
             *
             * ( 0 = top menu ) ( 1 = horizontal ) ( 2 = vertical ) ( 3 = footer menu ).
             */
            switch ($type)
            {
                case 0:            // 0 = top menu
                    break;
                case 1:            // 1 = horizontal menu
                    $html_out .= "\t\t".'<ul '.$this->class_menu.'>'."\n";
                    break;
                case 2:            // 2 = sidebar menu
                    $html_out .= "<ul>";
                    break;
                case 3:            // 3 = footer menu
                    break;
                default:        // default = horizontal menu
                    $html_out .= "\t\t".'<ul '.$this->class_menu.'>'."\n";
                    break;
            }
            
            // loop through the $menu array() and build the parent menus.
            // for ($i = 1; $i < count($menu); $i++)
            foreach($menu as $i => $item)
            {
                if (is_array($menu[$i]))    // must be by construction but let's keep the errors home
                {
                    if ($menu[$i]['show'] && $menu[$i]['parent'] == 0)    // are we allowed to see this menu?
                    {
                        $seg1 = $this->DecryptLink($this->ci->uri->segment(1));
                        if ($menu[$i]['is_parent'] == TRUE)
                        {
                            $ql     = "SELECT *, CASE WHEN parent_id > 0 THEN (select parent_id from sys_menu a where a.id_menu = b.parent_id) 
                                      ELSE 0 END AS baseP FROM sys_menu b WHERE url = '".$seg1."' ";
                             
                            $qry    = $this->ci->db->query($ql)->row();
                            
                            $pClass     = ( ($qry->baseP > 0 && $qry->baseP == $menu[$i]['id']) || ($qry->baseP == 0 && $qry->parent_id == $menu[$i]['id'])) ? "selected" : ""; 
                            $collapseP  = ( ($qry->baseP > 0 && $qry->baseP == $menu[$i]['id']) || ($qry->baseP == 0 && $qry->parent_id == $menu[$i]['id'])) ? "open"   : ""; 
                            $collapse   = ( ($qry->baseP > 0 && $qry->baseP == $menu[$i]['id'])) ? "open"   : ""; 
                            // vdebug($collapse);
                            // $html_out .= '<li class="'.$pClass.'has-sub'.$collapse.'"><a href="'.base_url().$menu[$i]['url'].'"><span>'.$menu[$i]['title'].'</span></a>';
                            $html_out .= '<li class="'.$pClass.' has-sub '.$collapse.'"><a href="#"><span>'.$menu[$i]['icon'].$menu[$i]['title'].'</span></a>';
                        }
                        else {
                            // $html_out .= "\t\t\t\t".'<li>'.anchor($menu[$i]['url'], '<span>'.$menu[$i]['title'].'</span>');
                            $sel        = ($this->ci->uri->segment(1)==$this->EncryptLink($menu[$i]['url'])) ? "selected"   : "";
                            $html_out .= '<li class="'.$sel.'"><a href="'.base_url().$this->EncryptLink($menu[$i]['url']).'"><span>'.$menu[$i]['icon'].$menu[$i]['title'].'</span></a>';
                        }
                        // loop through and build all the child submenus.
                        
                        $html_out .= $this->get_childs($menu, $i, $collapseP, $collapse);
                        $html_out .= '</li>'."\n";
                    }
                }
                else
                {
                    exit (sprintf('menu nr %s must be an array', $i));
                }
            }
            $html_out .= "\t\t".'</ul>' . "\n";
            // $html_out .= "\t".'</div>' . "\n";
            return $html_out;
        }  
    }
		
	    /**
     * get_childs($menu, $parent_id) - SEE Above Method.
     *
     * Description:
     *
     * Builds all child submenus using a recurse method call.
     *
     * @param    mixed    $menu    array()
     * @param    string    $parent_id    id of parent calling this method.
     * @return    mixed    $html_out if has subcats else FALSE
     */
    function get_childs($menu, $parent_id, $collapseP='', $collapse='')
    {
        $has_subcats = FALSE;
        $html_out  = '';

        // $html_out .= "\n\t\t\t\t".'<div>'."\n";
        $html_out .= '<ul style="display:'.($collapseP=='open'?'block':'none').';">';
        // $html_out .= '<ul>';
        // for ($i = 1; $i <= count($menu); $i++)
		foreach($menu as $i => $item)
        {
            $seg1 = $this->DecryptLink($this->ci->uri->segment(1));
            if ($menu[$i]['show'] && $menu[$i]['parent'] == $parent_id)    // are we allowed to see this menu?
            {
				$pClass 	= ($seg1==$menu[$i]['url']) ? "active" 	: "";
				// $collapseP 	= ($this->ci->uri->segment(1)==$menu[$i]['url']) ? "open" 		: "";
				$sel 		= ($seg1==$menu[$i]['url']) ? "selected" 	: "";
				
                $has_subcats = TRUE;
                if ($menu[$i]['is_parent'] == TRUE)
                {
					// $html_out .= "\t\t\t\t\t\t".'<li>'.anchor($menu[$i]['url'].' '.$this->class_parent, '<span>'.$menu[$i]['title'].'</span>');
                    $html_out .= '<li class="'.$pClass.' has-sub '.$collapse.'"><a href="'.base_url().$menu[$i]['url'].'"><span>'.$menu[$i]['title'].'</span></a>';
                }
                else
                {
                    $html_out .= '<li class="'.$sel.'">'.anchor($this->EncryptLink($menu[$i]['url']), '<span>'.$menu[$i]['title'].'</span>');
                }
                // Recurse call to get more child submenus.
                $html_out .= $this->get_childs($menu, $i, $collapseP, $collapse);
                $html_out .= '</li>' . "\n";
            }
        }
        $html_out .= "\t\t\t\t\t".'</ul>' . "\n";
         // $html_out .= "\t\t\t\t".'</div>' . "\n";
        return ($has_subcats) ? $html_out : FALSE;
    }
	
	
	function update_view($cid){
		
			$ctahun = $this->session->userdata('year_selected');
			$cinstansi = $this->session->userdata('id_instansi');
	
			$hsql = "UPDATE thistory SET status=1 WHERE tahun='".$ctahun."' and kd_apip='".$cinstansi."' and id='".$cid."'";		
			$data = $this->db->query($hsql);
		
		
	}	
	
}
// ------------------------------------------------------------------------
// End of Dynamic_menu Library Class.
// ------------------------------------------------------------------------
/* End of file Dynamic_menu.php */
/* Location: ../application/libraries/Dynamic_menu.php */  