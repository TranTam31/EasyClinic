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
	<?php require('menuchungKhach.php') ?>
	<?php $identity = $this->session->userdata('identity'); ?>

	<div class="container main">
		<div class="row">
			<div class="col-md-12">
				<div class="card mt-4">
					<div class="card-header">
						
						<div class="row">
					    	<div class="col-4">
					    		<h3><b>Đặt lịch khám</b></h3>
					    	</div>
					    </div>	
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-3">
								<label for="chonkhoa"><b>Chọn khoa khám bệnh</b></label>
							</div>
							<div class="col-md-3">
								<select class="form-control faculty" name="chonkhoa" id="chonkhoa">
									<option value="">Chọn khoa</option>
									<?php foreach ($data['mangkhoa'] as $value): ?>
										<option value="<?= $value['fac_id'] ?>"> <?= $value['fac_name'] ?> </option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<br>

						<div class="row">
							<div class="col-md-3">
								<label for="dateInput"><b>Chọn ngày khám bệnh</b></label>
							</div>
							<div class="col-md-3">
								<input class="form-control ngaydatkham" type="date" id="dateInput" name="dateInput" min="" max="">
							</div>
						</div>
						<br>

						<div class="show_data" style="padding-left: 233px; font-size: 18px; display: flex; flex-direction: column; align-items: flex-start;">
							
						</div>

					    <div class="row">
					    	<div class="col-3">
					    		
					    	</div>
					    	<div class="col-3">
					    		<button class="form-control btn btn-warning nutdatlich" style="font-size: 18px;"><b>Đặt lịch</b></button>
					    	</div>
					    </div>
					    <br>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="card mt-4">
					<div class="card-header">
						
						<div class="row">
					    	<div class="col-12">
					    		<h3><b>Các lượt khám đang chờ của bạn</b></h3>
					    	</div>
					    </div>	
					</div>
					<div class="card-body">
						<table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Ngày</th>
                                    <th>Bác sĩ</th>
                                    <th>Số thứ tự</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php foreach ($data['mangLuotKham_Bn'] as $value): ?>
									<tr>
	                                    <th><?= $value['work_date'] ?></th>
	                                    <th><?= $value['doctor_id'] ?></th>
	                                    <th><?= $value['stt'] ?></th>
	                                </tr>
								<?php endforeach ?>
                            </tbody>
                        </table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		var today = new Date();

		// Tạo một đối tượng Date cho 7 ngày sau
		var nextWeek = new Date();
		nextWeek.setDate(today.getDate() + 7);

		// Định dạng ngày cho input date
		var year = nextWeek.getFullYear();
		var month = nextWeek.getMonth() + 1; // Tháng bắt đầu từ 0, nên cần cộng thêm 1
		var day = nextWeek.getDate();
		if (month < 10) {
		    month = '0' + month;
		}
		if (day < 10) {
		    day = '0' + day;
		}
		var formattedDate = year + '-' + month + '-' + day;

		// Thiết lập giá trị tối đa và tối thiểu cho input date
		document.getElementById('dateInput').setAttribute('min', today.toISOString().slice(0, 10));
		document.getElementById('dateInput').setAttribute('max', formattedDate);



		$('.ngaydatkham').on('change', function() {

            var ngaydatkham = $(this).val();

			if(ngaydatkham) {
				$.ajax({
					url: 'getDataLuotKham',
					type: 'POST',
					dataType: 'json',
					data: { 
						fac_id: $('.faculty').val(),
						ngaydatkham: ngaydatkham },
				})
				.done(function(data) {
					console.log("success");
					console.log(data);
					var str = "";
					if (!data) {

					}
					$.each(data.dataLuotKham, function(i, item) {
						str += '<div style="padding-left: 61px">'
	    				str += '<input class="form-check-input" id="' + item.slot_id + '" type="radio" name="option" value=' + item.slot_id + '><b><label for="' + item.slot_id + '">Bác sĩ: ' + item.doctor_name + ', STT: ' + (11 - item.available_slot) + '</b><br></label>';
	    				str += '</div>';
					});
					$('.show_data').html(str);
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			}
		});


		$('.nutdatlich').on('click', function() {
			var selectedOption = document.querySelector('input[name="option"]:checked');
			  if (selectedOption) {
			    var slot_id = selectedOption.value;
			    $.ajax({
					url: 'postDataDatLich',
					type: 'POST',
					dataType: 'json',
					data: { 
						slot_id: slot_id },
				})
				.done(function(data) {
					if(data == "Thêm thành công") {
						alert("Bạn đã đặt lịch thành công!")
						window.location.reload();
					} else {
						alert("Bạn đã đặt lịch khám bác sĩ này trong ngày hôm nay! Vui lòng chọn ngày hoặc bác sĩ khác!");
						window.location.reload();
					}
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			  } else {
			    console.log("No option selected");
			  }
		});
	</script>
</body>
</html>