<!-- <div class="tools" id="user_online">
    <a href="#" class="toggler" title="User Online"><i class="fa fa-users"></i> User Online<span id="badge" class="badge"><?=$this->session->userdata('thn_ang')?></span></a>
    <div class="popover" style="display: none;">
        <?php
			$uo 	= $this->useronline->generate_useronline();
			echo $uo;
		?>
    </div>
</div>

<script>
	$(document).ready(function() {
		
        var ul = document.getElementById("oluser");
        var child = document.getElementById('totalUser');
        var liNodes = [];
        var count = 0;

        for (var i = 0; i < ul.childNodes.length; i++) {
            count++;
        }
        $("#badge").replaceWith( "<span id='badge' class='badge'> "+count+"</span>" );
})
</script> -->