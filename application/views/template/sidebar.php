

<div class="sidebar-scroll" >
	<div class="userinfo" hidden>

		<div class="avatar"><img src="<?= base_url() ?>assets/img/favicon.png" alt="" style="width:30px;height:30px;" />
		
		</div>

		<div class="user"><?=$this->session->userdata('alias') == '' ? $this->session->userdata('nama'):$this->session->userdata('alias');?></div>
		<div class="position"><small>(<?=strtoupper($this->session->userdata('siteDec'))?>)</small></div>
	</div>	

	<nav>
		
		<?php
			$menu 	= $this->dynamic_menu->build_menu2();
			$i 		= 1;
			echo $menu;
		?>
	</nav>
</div> 

<script>
	$(document).ready(function() {
		$('nav ul li ul li ul li').find('.selected').parent().css("display", "block");
		$('nav ul li ul li.has-sub').children("ul").css("display", "none");
		$('nav ul li ul li').find('.selected').parent().css("display", "block");
})

</script>
