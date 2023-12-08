<?php 
		if(!$this->session->has_userdata('identity')) {
			redirect('quanlybv/dangnhap','refresh');
		} else {
	 ?>
<div class="menu-bar">
		<!-- <a class="logo" href="<?php echo base_url(); ?>index.php/quanlybv/menu_khach">HospitalProject</a> -->
        <h1 class="logo">Happy Hospital</h1>
        <ul>
			<li><a href="<?php echo base_url(); ?>index.php/quanlybv/thongtin">Tra cứu</a></li>
			<li><a href="<?php echo base_url(); ?>index.php/quanlybv/doimk">Đổi mật khẩu</a></li>
        	<li><a href="#" onclick="confirmLogout()">Đăng xuất</a></li>
        </ul>
    </div>
    <script>
		function confirmLogout() {
		    var result = confirm("Bạn có chắc muốn đăng xuất?");
		    if (result) {
		        window.location.href = '<?php echo base_url(); ?>index.php/quanlybv/dangxuat';
		    }
		}
	</script>
    	<?php } ?>