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
  	<script type="text/javascript" src="<?php echo base_url() ?>lib/jquery-3.7.1.min.js"></script>
  	<script type="text/javascript" src="<?php echo base_url() ?>lib/json2.js"></script>
  	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  	<style>
     	.main{
     		padding-top: 60px;
     	}
    </style>
</head>
<body>
	<div class="container main">
		<div class="row justify-content-center">
			<div class="card-header">
				<br>
		    	<label><b>Đăng nhập hệ thống</b></label>
		    	<hr>
		    	<div class=" row text-left align-items-center">
		    		<div class="col-md-5">
		    			<label class=""><b>Bạn là?</b></label>
		    		</div>
		    		<div class="col-md-7">
		    			<select class="form-control userType">
				    		<option value="0">Chọn một option</option>
				    		<option value="1">Nhân viên</option>
				    		<option value="2">Người tới khám</option>
				    	</select>
		    		</div>
		    	</div>
		    	<br>
		    	<div class="row">
		    		<div class="col-md-5">
		    			<label><b>Tên đăng nhập</b></label>
		    		</div>
		    		<div class="col-md-7">
		    			<input class="form-control username" type="text" placeholder="Nhập tên đăng nhập">
		    		</div>
		    	</div>
		    	<br>
		    	<div class="row">
		    		<div class="col-md-5">
		    			<label><b>Mật khẩu</b></label>
		    		</div>
		    		<div class="col-md-7">
		    			<input class="form-control password" type="password" placeholder="Nhập mật khẩu">
		    		</div>
		    	</div>
		    	<br>
		    	<div class="row">
		    		<div class="col-md-5">
		    		</div>
		    		<div class="col-md-7">
		    			<button class="form-control btn btn-success loginBtn">Đăng nhập</button>
		    		</div>
		    	</div>
		    </div>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			$('.loginBtn').click(function(event) {
				var userType = $(".userType").val();
				var identity = $(".username").val();
      			var password = $(".password").val();
      			
      			if(userType == 0) {
      				alert("Bạn chưa chọn option");
      			}

      			if(userType == 1) {
      				if(identity == 'hospitalProject' && password == 'tranductam31') {
      					$.ajax({
      						
      					})
      					.done(function() {
      						console.log("success");
      						//alert("Đã đăng nhập vào bằng nhân viên");
      						window.location.href = 'http://localhost/hosPro/index.php/quanlybv/menu';
      					})
      					.fail(function() {
      						console.log("error");
      					})
      					.always(function() {
      						console.log("complete");
      					});
      					
      				} else {
      					alert("Bạn nhập sai tên tài khoản hoặc password");
      				}
      			} else if(userType == 2){
      				if(identity) {
	      				$.ajax({
	      					url: 'quanlybv/getPassword',
	      					type: 'POST',
	      					dataType: 'json',
	      					data: {identity: identity},
	      				})
	      				.done(function(data) {
	      					console.log("success");
	      					console.log(data);
	      					if(password == data.matkhau[0]['passdangnhap']) {
	      						//alert("Bạn đã đăng nhập vào người dùng thành công");
	      						//window.location.href = 'url_of_employee_dashboard.html';
	      					}
	      					else if(password == ""){
	      						alert("Bạn nhập sai tên đăng nhập");
	      					} else {
	      						alert("Bạn nhập sai mật khẩu");
	      					}
	      				})
	      				.fail(function() {
	      					console.log("error");
	      				})
	      				.always(function() {
	      					console.log("complete");
	      				});
      				} else {
      					alert("Hãy nhập tên tài khoản");
      				}
      			}
			});
		})
	</script>
</body>
</html>