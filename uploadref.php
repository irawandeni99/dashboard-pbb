<?php

			$ctahun       		= $_POST['ctahun'];
			$cinstansi      	= $_POST['cinstansi'];
		
			
			$search = array("/", " ", ":", "*", "?", "&#34;", "<", ">",".");
			$searchdok = array("/", " ", ":", "*", "?", "&#34;", "<", ">", "|");
			$replace = array("_", "_", "_", "_", "_", "_", "_", "_", "_");
			
			
			//$filelTemp 			= str_replace($searchdok, $replace, $dokumentasi);
			$ctahunTemp 		= str_replace($search, $replace, $ctahun);
			$cinstansiTemp 		= str_replace($search, $replace, $cinstansi);

			

			$folder			= 'assets/file_upload/ekapip_dokumen/'.$ctahunTemp.'/';
			$folder1		= 'assets/file_upload/ekapip_dokumen/'.$ctahunTemp.'/'.'Instansi'.$cinstansiTemp.'/';
			$folder2		= 'assets/file_upload/ekapip_dokumen/'.$ctahunTemp.'/'.'Instansi'.$cinstansiTemp.'/'.'Referensi/';
			
			if (!file_exists($folder))
			{
				mkdir($folder, 0777, true); 
			}
			
			if (!file_exists($folder1))
			{
				mkdir($folder1, 0777, true); 
			}
			if (!file_exists($folder2))
			{
				mkdir($folder2, 0777, true); 
			}
				



  $temp = $folder2;
  

 // $nama_file       = $_POST['nama_file'];
  $fileupload      = $_FILES['fileupload']['tmp_name'];
  $ImageName       = $_FILES['fileupload']['name'];
  $ImageType       = $_FILES['fileupload']['type'];
  $ImageSize       = $_FILES['fileupload']['size'];
  
 // echo($ImageSize);die();
 // $max_size   	  = 512000;
  
  
		if (!empty($fileupload)){
			$ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
			$ImageExt       = str_replace('.','',$ImageExt); // Extension
			$ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
			$NewImageName   = str_replace(' ', '', $ImageName.'.'.$ImageExt);
		  
			$target_file = $temp.$NewImageName;
		  
				  if (file_exists($target_file)) {
					  echo "2";
					  
					}
					
				//	else if($ImageSize > $max_size){
				//		echo "3";
				//	}
				
				else {
						
							$terupload = move_uploaded_file($_FILES["fileupload"]["tmp_name"], $temp.$NewImageName);

							if ($terupload) {
								
								//$urll = 'base_url()';
								$urll = $temp.$NewImageName;
								
								echo $urll;
								
								/* echo "Upload berhasil!<br/>";
								echo "Link: <a href='".base_url().$urll."'>".$NewImageName."</a>"; */
		
								
							} else {
								echo "Upload Gagal!";
							}
						  
						   
					}
  
   
		} 
  
 
?>

