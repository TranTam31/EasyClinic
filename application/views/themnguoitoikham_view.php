<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
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
  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  	<style>
     	.main{
     		padding-top: 60px;
     	}
     	.autocomplete-results {
            max-height: 200px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
	<?php require('menuchung.php') ?>
	<div class="container main">
		<div class="row">
			<div class="col-md-12">
				<div class="card mt-4">
					<div class="card-header">
						
						<div class="row">
					    	<div class="col-4">
					    		<h3><b>Thêm người tới khám</b></h3>
					    	</div>
					    </div>	
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-1 text-right d-flex align-items-center justify-content-end">
								<b>Họ tên:</b>
							</div>
							<div class="col-md-3">
								<input type="text" class="form-control p_name" placeholder="Nhập tên người tới khám">
							</div>
							<div class="col-md-2 text-right d-flex align-items-center justify-content-end">
								<b>Giới tính: </b>
							</div>
							<div class="col-md-2">
								<select class="form-control p_sex">
									<option value="">Chọn</option>
									<option value="Male">Nam</option>
									<option value="Female">Nữ</option>
								</select>
							</div>
							<div class="col-md-2 text-right d-flex align-items-center justify-content-end">
								<b>Ngày sinh: </b>
							</div>
							<div class="col-md-2">
								<input type="date" class="form-control p_date" id="datepicker">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-1 text-right d-flex align-items-center justify-content-end">
								<b>Địa chỉ:</b>
							</div>
							<div class="col-md-3">
								<input type="text" class="form-control p_address" placeholder="Nhập địa chỉ">
							</div>
							<div class="col-md-2 text-right d-flex align-items-center justify-content-end">
								<b>CCCD: </b>
							</div>
							<div class="col-md-2">
								<input type="text" class="form-control p_iden" placeholder="Nhập CCCD">
							</div>
							<div class="col-md-2 text-right d-flex align-items-center justify-content-end">
								<b>SĐT: </b>
							</div>
							<div class="col-md-2">
								<input type="text" class="form-control p_phone" placeholder="Nhập SĐT">
							</div>
						</div>
						<br>

					    <div class="row">
					    	<div class="col-1">
					    		
					    	</div>
					    	<div class="col-3">
					    		<button class="form-control btn btn-warning nutthem">Thêm</button>
					    	</div>
					    </div>
					    
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).on('click', '.nutthem', function(event) {
			var p_iden = $('.p_iden').val();
			var p_name = $('.p_name').val();
			var p_sex = $('.p_sex').val();
			var p_date = $('.p_date').val();
			var p_address = $('.p_address').val();
			var p_phone = $('.p_phone').val();
			var p_pass = "tranductam31";
			if(!p_iden || !p_name || !p_sex || !p_date || !p_address || !p_phone) {
				alert("Vui lòng điền đủ thông tin!");
			} else {
				var confirmation = confirm("Bạn có muốn thêm không người này không?");
				if(confirmation) {
					$.ajax({
						url: 'themnguoikhamvaodb',
						type: 'POST',
						dataType: 'json',
						data: {
							p_iden: p_iden,
							p_name: p_name,
							p_sex: p_sex,
							p_date: p_date,
							p_address: p_address,
							p_phone: p_phone,
							p_pass: p_pass
						},
					})
					.done(function(data) {
						if(data == "Thêm thành công") {
							window.location.reload();
						} else {
							alert("Người có số CCCD này đã tồn tại!");
						}
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});
				}
			}
			
		});
	</script>
</body>
</html>