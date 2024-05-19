<?php 
		if(!$this->session->has_userdata('userType')) {
			redirect('quanlybv/dangnhap','refresh');
		} else {
	 ?>
<div class="menu-bar">
		<!-- <a class="logo" href="<?php echo base_url(); ?>index.php/quanlybv/menu">HospitalProject</a> -->
		<h1 class="logo">Happy Hospital</h1>
        <ul>
			<li><a href="">Bệnh viện <i class="fas fa-caret-down"></i></a>
	            <div class="dropdown-menu">
	                <ul>
	                	<li><a href="<?php echo base_url(); ?>index.php/quanlybv/bacsi">Bác sĩ</a></li>
	                	<li><a href="<?php echo base_url(); ?>index.php/quanlybv/thuoc">Thuốc</a></li>
	                </ul>
	            </div>
        	</li>

			<li><a href="">Người tới khám <i class="fas fa-caret-down"></i></a>
	            <div class="dropdown-menu">
	                <ul>
	                	<li><a href="<?php echo base_url(); ?>index.php/quanlybv/themnguoitoikham">Thêm người tới khám</a></li>
	                    <li><a href="<?php echo base_url(); ?>index.php/quanlybv/tracuu">Tra cứu</a></li>
	                </ul>
	            </div>
        	</li>
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