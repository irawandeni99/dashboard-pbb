<div class="sidebar-scroll">
	<div class="userinfo">
		<div class="avatar"><img src="<?php echo base_url(); ?>uploads/
			<?php 
				if ($this->session->userdata('pict')!=null) {
					echo $this->session->userdata('pict'); 
				} else { 
					echo 'user.jpg'; 
				} 
			?>">
		</div>
		<div class="user"><?=$this->session->userdata('name')?></div>
		<div class="position"><?=$this->session->userdata('siteDec')?></div>
	</div>	
	<nav>

		<ul class="nav">

			<?php

				$menu 	= $this->dynamic_menu->build_menu();

				$i 		= 1;

				foreach ($menu as $row) {

					

					if ($row['name'] == '0') {

						// echo '<li><a href="'.$rowChild['url'].'" class=""><i class="lnr lnr-code"></i> <span>Elements</span></a></li>';

						foreach ($row['child'] as $rowChild) {

							$cur_tab 	= $this->uri->segment(1)==$rowChild['url']?'active': "";

							echo '<li><a href="'.base_url($rowChild['url']).'" class="'.$cur_tab.'">'.$rowChild['title'].'</a></li>';

						}

					}

					else {

						$str = ''; $cur_tab=''; $cur_tabPc='collapse'; $cur_tabP="";

						foreach ($row['child'] as $rowChild1) {

							if ($this->uri->segment(1)==$rowChild1['url']){

								$cur_tab 	= 'active';

								$cur_tabP 	= 'active';

								$cur_tabPc	= 'collapse in';

							}

							else {$cur_tab 	= '';}



							$str .= '<li><a href="'.base_url($rowChild1['url']).'" class="'.$cur_tab.'">'.$rowChild1['title'].'</a></li>';

						}

								

						echo '

						<li>

							<a href="#subPages'.$i.'" data-toggle="collapse" class="'.$cur_tabP.'"><i class="lnr lnr-file-empty"></i> <span>'.$row['name'].'</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>

							

							<div id="subPages'.$i.'" class="'.$cur_tabPc.'">

								<ul class="nav">

								'.$str.'

								</ul>

							</div>

						</li>';

					}

					$i++;

				}

			?>

		</ul>

	</nav>

</div>