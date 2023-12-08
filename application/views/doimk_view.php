<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  	<!-- đây là phần thêm font -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  	<script type="text/javascript" src="<?php echo base_url() ?>lib/jquery-3.7.1.min.js"></script>
  	<script type="text/javascript" src="<?php echo base_url() ?>lib/json2.js"></script>
  	<link rel="stylesheet" href="<?php echo base_url() ?>lib/menu_design.css">
  	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  	<style>
     	.main{
     		padding-top: 60px;
     	}
    </style>
</head>
<body>
	<?php require('menuchungKhach.php') ?>
	<?php $identity = $this->session->userdata('identity'); ?>

	<div class="container main">
		<div class="row justify-content-center">
    		<div class="col-6">
				<div class="card">
					<div class="card-header">
						<br>
				    	<label><b><h3>Đổi mật khẩu</h3></b></label>
				    </div>
				    <div class="card-body">
				    	<div class="row">
				    		<div class="col-md-5">
				    			<label><b>Mật khẩu cũ</b></label>
				    		</div>
				    		<div class="col-md-7">
				    			<input class="form-control old_pass" type="password" placeholder="Nhập mật khẩu cũ">
				    		</div>
				    	</div>
				    	<br>
				    	<div class="row">
				    		<div class="col-md-5">
				    			<label><b>Mật khẩu mới</b></label>
				    		</div>
				    		<div class="col-md-7">
				    			<input class="form-control new_pass" type="password" placeholder="Nhập mật khẩu mới">
				    		</div>
				    	</div>
				    	<br>
				    	<div class="row">
				    		<div class="col-md-5">
				    			<label><b>Xác nhận mật khẩu mới</b></label>
				    		</div>
				    		<div class="col-md-7">
				    			<input class="form-control new_pass_confirm" type="password" placeholder="Nhập lại mật khẩu">
				    		</div>
				    	</div>
				    	<br>
				    	<div class="row">
				    		<div class="col-md-5">
				    		</div>
				    		<div class="col-md-7">
				    			<button class="form-control btn btn-success doimkBtn">Đổi mật khẩu</button>
				    		</div>
				    	</div>
				    </div>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).on('click', '.doimkBtn', function(event) {
			//var identity = $(identity);     // hehe đoạn này nó không nhận đâu nha. Nhưng mà trong 1 số 
			// trường hợp mà không dùng session thì nó lấy identity như nào nhẻ
			var old_pass = $(".old_pass").val();
			var new_pass = $(".new_pass").val();
  			var new_pass_confirm = $(".new_pass_confirm").val();
      		if(!old_pass || !new_pass || !new_pass_confirm) {
  				alert("Vui lòng nhập đầy đủ thông tin!");
  			} else {
  				$.ajax({
  					url: 'getPass',
  					type: 'GET',
  				})
  				.done(function(data) {
  					data = JSON.parse(data)
  					console.log(data.matkhau[0]['passdangnhap']);
  					if(data.matkhau[0]['passdangnhap'] != old_pass) {
  						alert("Bạn nhập sai mật khẩu cũ!");
  					} else {
  						if(new_pass != new_pass_confirm) {
  							alert("Bạn vui lòng nhập lại phần xác nhận mật khẩu!");
  						} else {
  							var confirmation = confirm("Bạn có muốn thay đổi không?");
    						if (confirmation) {
	  							$.ajax({
	  								url: 'updatePassword',
	  								type: 'POST',
	  								dataType: 'json',
	  								data: {
	  									// identity: identity,
	  									new_pass: new_pass
	  								},
	  							})
	  							.done(function(data) {
	  								console.log(data);
	  								window.location.reload();
	  							})
	  							.fail(function() {
	  								console.log("error");
	  							})
	  							.always(function() {
	  								console.log("complete");
	  							});
							}
  						}
  					}
  				})
  				.fail(function() {
  					console.log("error");
  				})
  				.always(function() {
  					console.log("complete");
				});
  			}
		})
	</script>
</body>
</html>