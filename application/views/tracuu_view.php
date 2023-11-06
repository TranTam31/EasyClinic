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
						<h3><b>Tra cứu thông tin người tới khám</b></h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-2">
								<b>Nhập CCCD: </b>
							</div>
							<div class="col-md-4">
								<input type="text" class="form-control identity" placeholder="Nhập CCCD vào đây">
							</div>
							<div class="col-md-3">
								<button class="form-control btn btn-success nuttimthuoc">Tìm kiếm</button>
							</div>
						</div>

						<br>
						<!-- <table class="table load_thuoc">
					      <tbody>
					        <tr>
					          <th class="col-2">ID</th>
					          <td><i>... (Vui lòng nhập tìm một loại thuốc)</i></td>
					        </tr>
					        <tr>
					          <th class="col-2">Nhà cung cấp</th>
					          <td><i>... (Vui lòng nhập tìm một loại thuốc)</i></td>
					        </tr>
					        <tr>
					          <th class="col-2">Thành phần</th>
					          <td><i>... (Vui lòng nhập tìm một loại thuốc)</i></td>
					        </tr>
					        <tr>
					          <th class="col-2">Chỉ định</th>
					          <td><i>... (Vui lòng nhập tìm một loại thuốc)</i></td>
					        </tr>
					      </tbody>
					    </table> -->
					    <!-- <div class="row">
					    	<div class="col-2">
					    		
					    	</div>
					    	<div class="col-3 load_nutok">
					    		<button class="form-control btn btn-warning nutsuathuoc">Sửa thông tin thuốc</button>
					    	</div>
					    	<div class="col-3 load_nutxoa">
					    		<button class="form-control btn btn-danger nutxoathuoc">Xóa thuốc</button>
					    	</div>
					    </div> -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).on('focus', '.identity', function() {
			$(this).autocomplete({
				source: function(request, response) {
					$.ajax({
						url: 'getDataIdentity',
						type: 'GET',
						dataType: 'json',
						success: function(data) {
							//console.log(data)
							aData = $.map(data.dulieucccd, function(value, key) {
								return {
									id: value.identity,
									label :value.identity,
									name: value.people_name,
									dob: value.dob,
								};
							});
							//console.log(aData)
							var results = $.ui.autocomplete.filter(aData, request.term);
							response(results);
						}
					})
				},
				select:function(event,ui) {
					//console.log(ui.item.name);
					$('#name').text(ui.item.name);
					$('#dob').text(ui.item.dob);
				},
				open: function(event, ui) {
			        $('.ui-autocomplete').addClass('autocomplete-results');
			    }
			});
		});
	</script>
</body>
</html>