
<div class="main-container">
<div>
<div class="fleft">
<h1>Download Friends List</h1>
</div>
<div class="fright" style="font-size:20px;color:red;"><a href="<?php echo site_url(); ?>/fblogin/logout">logout</a></div>
<hr class="hr">
<?php if(count($friends)) { ?>
	<table border="1" width="90%" align="center" class="m-20">
    <tr>
    <td><b>S.No</b></td>
    <td><b>Friend Name</b></td>
    <td><b>Facebook Id</b></td>
    </tr>
    <?php foreach($friends as $sno => $friend)
		  { ?>
          	<tr>
                <td><?php echo $sno+1; ?></td>
                <td><?php echo $friend->name;?></td>
                <td><?php echo $friend->oauth_fid;?></td>
    		</tr>
	<?php } ?>
    </table>
    <div class="form-div"><form method="post" name="exp_frm" action="">
    		<input type="submit" value="Export" name="export">
          </form>  
     </div>
<?php } else { ?>
	<div class="nolist">Currently there is no friend to display</div>
<?php } ?>
</div> </div>
