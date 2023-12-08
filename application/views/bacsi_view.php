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
    </style>
</head>
<body>
	<?php require('menuchung.php') ?>
	<div class="container main">
		<div class="row">
			<div class="col-md-12">
				<div class="card mt-4">
					<div class="card-header">
						<h3><b>Tra cứu thông tin, thêm sửa xóa bác sĩ</b></h3>
					</div>
					<div class="card-body">
						<div class="row">
                            <div class="col-md-4">
								<select class="form-control faculty">
									<option value="">Chọn khoa</option>
									<?php foreach ($mangkhoa as $value): ?>
										<option value="<?= $value['fac_id'] ?>"> <?= $value['fac_name'] ?> </option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-md-3">
								<button class="form-control btn btn-success thembacsi">Thêm bác sĩ</button>
							</div>
						</div>
						<br>
						<div class="row form_thembacsi" id="myDiv">
							
						</div>

						<br>
						<table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Bác sĩ</th>
                                    <th>Số điện thoại </th>
                                    <th>Sửa/Xóa</th>
                                </tr>
                            </thead>
                            <tbody id="load_table_bacsi">
                            	
                            </tbody>
                        </table>
					</div>	
				</div>
			</div>
		</div>
	</div>
	<script>
		$('.faculty').on('change', function() {

            var fac_id = $(this).val();
			if(fac_id) {
				$.ajax({
					url: 'getDataDoctorBacsi',
					type: 'POST',
					dataType: 'json',
					data: { fac_id: fac_id },
				})
				.done(function(data) {
					console.log("success");
					console.log(data);
					var str = "";
					$.each(data.dulieubacsi, function(i, item) {
	    				str+= "<tr>";
                        str+= "<td>" + item.doctor_id + "</td>"
                        str+= "<td>" + item.doctor_name + "</td>"
                        str+= "<td>" + item.doctor_phone + "</td>"
                        str+= "<td>"
                        str+= '<div class="row">'
                        str+= '<div class="col-sm-6"><button class="form-control nutsua btn btn-success">Sửa</button>'
                        str+= '</div>'
                        str+= '<div class="col-sm-6"><button value='+item.doctor_id+' class="form-control nutxoa btn btn-danger">Xóa</button>'
                        str+='</div>'
                        str+='</div>'
                        str+= "</td>"
                        str+= "</tr>";
					});
					$('#load_table_bacsi').html(str);
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			}
		});

		$(document).on('click', '.nutxoa', function(event) {
			var id_canxoa = $(this).val();
			var rowToRemove = $(this).closest('tr');
			var confirmation = confirm("Bạn có muốn xóa bác sĩ này không?");
    		if (confirmation) {
				$.ajax({
					url: 'xoaBacsi',
					type: 'POST',
					dataType: 'json',
					data: {id_canxoa: id_canxoa},
				})
				.done(function(data) {
					console.log(data);
					rowToRemove.remove();

				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			}
		});

		$(document).on('click', '.thembacsi', function(event) {
			var fac_id = $(".faculty").val();
			if(fac_id) {
				$.ajax({
				})
				.done(function() {
					console.log("success");
					var str = "";
					str+= '<div class="col-md-2">'
					str+= '<input type="text" class="form-control" id="idBacsi" placeholder="Nhập ID bác sĩ">'
					str+= '</div>'
					str+= '<div class="col-md-4">'
					str+= '<input type="text" class="form-control" id="tenBacsi" placeholder="Nhập tên bác sĩ">'
					str+= '</div>'
					str+= '<div class="col-md-4">'
					str+= '<input type="text" class="form-control" id="sdtBacsi" placeholder="Nhập sđt bác sĩ">'
					str+= '</div>'
					str+= '<div class="col-md-2">'
					str+= '<button value="'+fac_id+'" class="form-control btn btn-success nutthembacsi">Thêm</button>'
					str+= '</div>';

					$('.form_thembacsi').append(str);		
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			} else {
				alert('Vui lòng chọn khoa trước khi thêm!');
			}
		});

		$(document).on('click', '.nutthembacsi', function(event) {
			var fac_id = $(this).val();
			var idBacsi = $('#idBacsi').val();
			var tenBacsi = $('#tenBacsi').val();
			var sdtBacsi = $('#sdtBacsi').val();
			if(!idBacsi || !tenBacsi || !sdtBacsi) {
				alert("Vui lòng nhập đủ thông tin của bác sĩ cần thêm");
			}
			else {
				var confirmation = confirm("Bạn có muốn thêm bác sĩ này không?");
    			if (confirmation) {
					$.ajax({
						url: 'themBacsiController',
						type: 'POST',
						dataType: 'json',
						data: {
							idBacsi: idBacsi,
							tenBacsi: tenBacsi,
							sdtBacsi: sdtBacsi,
							fac_id: fac_id
						},
					})
					.done(function(data) {
						console.log(data);
						if(data == "Thêm thành công") {
							var str = "";
							str+= "<tr>";
	                        str+= "<td>" + idBacsi + "</td>"
	                        str+= "<td>" + tenBacsi + "</td>"
	                        str+= "<td>" + sdtBacsi + "</td>"
	                        str+= "<td>"
	                        str+= '<div class="row">'
	                        str+= '<div class="col-sm-6"><button class="form-control nutsua btn btn-success">Sửa</button>'
	                        str+= '</div>'
	                        str+= '<div class="col-sm-6"><button value='+idBacsi+' class="form-control nutxoa btn btn-danger">Xóa</button>'
	                        str+='</div>'
	                        str+='</div>'
	                        str+= "</td>"
	                        str+= "</tr>";

	                        $('#load_table_bacsi').append(str);
	                        var myDiv = document.getElementById("myDiv");
	                        myDiv.innerHTML = "";
	                        $('#idBacsi').val('');
	                        $('#tenBacsi').val('');
	                        $('#sdtBacsi').val('');
						} else {
							alert("ID bạn đang nhập đã tồn tại! Vui lòng chọn lại ID!");
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