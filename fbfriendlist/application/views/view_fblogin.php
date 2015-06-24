<script>
function facebook_connect()
{
	window.location.href = 'login/oauth_provider/facebook/type/'+$('input[name=role]:checked').val();
}
</script>
<div class="main-container">
<a href="<?php echo site_url(); ?>/fblogin/facebook_auth"><img width="90" src="<?php echo base_url() ?>application/images/fb_login.png" alt="" border="0"></a>
</div>
