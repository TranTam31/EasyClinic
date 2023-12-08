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
			<div class="col">
				<div class="card mt-4">
					<div class="card-header">
						<h3><b>Thêm lượt khám mới</b></h3>
						<hr>
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<label class="col-sm-4 col-form-label d-block">
										<b class="d-block">CCCD</b>
									</label>
									<div class="col-sm-8">
										<input class="form-control" type="text" id="identity" placeholder="Vui lòng nhập số CCCD">
									</div>
								</div>
							</div>

							<div class="col-md-6">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<label class="col-sm-12 col-form-label d-block">
										<b class="d-block">Họ và tên: <b id="name"></b></b>
									</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="row">
									<label class="col-sm-12 col-form-label d-block">
										<b class="d-block">Năm sinh: <b id="dob"></b></b>
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="card-body load_select">
							<div class="row">
								<div class="col-md-6">
									<div class="row">
										<label class="col-sm-4 col-form-label d-block">
											<b>Chọn ngày khám</b>
										</label>
										<div class="col-sm-8">
											<input type="date" class="form-control ngaykham" id="datepicker">
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<!-- rỗng, nó chỉ để cho đẹp thôi -->
								</div>
							</div>
							<!-- 1 card lượt khám + trong đó là card thuốc -->
							<!-- <div class="card select_group" id="select_group_1"> -->
							<br>
							<div class="card select_group">
								<div class="card-header">
									<b>Lượt khám</b>
									<hr>
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<label class="col-sm-4 col-form-label d-block">
													<b>Khoa</b>
												</label>
												<div class="col-sm-8">
													<select class="form-control faculty">
														<option value="">Chọn một khoa</option>
														<?php foreach ($mangkhoa as $value): ?>
															<option value="<?= $value['fac_id'] ?>"> <?= $value['fac_name'] ?> </option>
														<?php endforeach ?>
													</select>
												</div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="row">
												<label class="col-sm-4 col-form-label d-block">
													<b>Bác sĩ</b>
												</label>
												<div class="col-sm-8">
													<select class="form-control doctor">
														<option value="">Select 2</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<label class="col-sm-2 col-form-label d-block">
											<b>Kết quả khám</b>
										</label>
										<div class="col-sm-10">
											<textarea class="form-control" id="ketquakham" rows="2"></textarea>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<label class="col-sm-4 col-form-label d-block">
													<b>Ngày tái khám</b>
												</label>
												<div class="col-sm-8">
													<input type="date" class="form-control ngaytaikham" id="datepicker">
												</div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="row">
												<label class="col-sm-4 col-form-label d-block">
													<b>Thanh toán</b>
												</label>
												<div class="col-sm-8">
													<input class="form-control payment" placeholder="Số tiền thanh toán">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="card">
										<div class="card-header">
											<b>Thuốc</b>
										</div>
										<div class="themthuoc_group">
											<div class="card-body load_themthuoc">
												<div class="motcuc">
													<div class="row">
														<div class="col-sm-2">
															<b>Phần chọn thuốc</b>
														</div>
														<div class="col-sm-10">
															<input class="form-control med_name" type="text" placeholder="Vui lòng nhập tên thuốc" data-id="">
														</div>
													</div>
													<br>
													<div class="row">
														<label class="col-sm-2 col-form-label d-block">
															<b>Liều dùng</b>
														</label>
														<div class="col-sm-10">
															<textarea class="form-control med_dose" id="textArea" rows="2"></textarea>
														</div>
													</div>
												</div>
											</div>
											<div class="card-body">
												<div class="row">
													<label class="col-sm-2 col-form-label d-block">
														<!-- để trống -->
													</label>
													<div class="col-sm-10">
														<button type="submit" class="btn btn-primary nutthemthuoc">Thêm thuốc</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<br>
						</div>
						<div class="row">
							<div class="col-sm-10">
								<button type="submit" class="btn btn-primary themluotkham">Thêm lượt khám</button>
								<button type="submit" class="btn btn-success laydulieu">Submit</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		aData = {}
		$('#identity').autocomplete({
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
		aDataMed = {}
		$(document).on('focus', '.med_name', function () {
		    $(this).autocomplete({
		        source: function (request, response) {
		            $.ajax({
		                url: 'getDataMedicine',
		                type: 'GET',
		                dataType: 'json',
		                success: function (data) {
		                    var aDataMed = $.map(data.dulieuthuoc, function (value, key) {
		                        return {
		                            id: value.med_id,
		                            label: value.med_name
		                        };
		                    });

		                    // var results = $.ui.autocomplete.filter(aDataMed, request.term);
		                    var results = [];

		                    // Lọc các từ bắt đầu bằng chuỗi nhập vào
		                    var term = request.term.toLowerCase();
		                    aDataMed.forEach(function (item) {
		                        if (item.label.toLowerCase().startsWith(term)) {
		                            results.push(item);
		                        }
		                    });

		                    response(results);
		                }
		            });
		        },
		        select: function (event, ui) {
		        	$(this).attr('data-id', ui.item.id);
		        },
		        open: function (event, ui) {
		            $('.ui-autocomplete').addClass('autocomplete-results');
		        }
		    });
		});

		$('.load_select').on('change', '.select_group .faculty', function() {
            var $selectGroup = $(this).closest('.select_group');
            var fac_id = $selectGroup.find('.faculty').val();
            var doctor = $selectGroup.find('.doctor');

            // Thực hiện AJAX request và xử lý dữ liệu với city_id
            if (fac_id) {
                $.ajax({
                    url: 'getDataDocSelect',
                    type: 'POST',
                    data: { fac_id: fac_id },
                    dataType: 'json',
                })
                .done(function(data) {
                    console.log("success");
                    console.log(data);
                    doctor.empty();
                    doctor.append($('<option>', {
                        value: null,
                        text: 'Chọn một bác sĩ'
                    }));
                    $.each(data.dulieubacsi, function(index, value_doc) {
                        doctor.append($('<option>', {
                            value: value_doc.doctor_id,
                            text: value_doc.doctor_name
                        }));
                    });
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
            }
        });

        $('.themluotkham').click(function(event) {
        	$.ajax({
	            url: 'getDataFacSelect_ajax',
	            type: 'POST',
	            dataType: 'json',
	        })
		    .done(function(data) {
	            var str = "<br>";
	            str += "<div class='card select_group'>";
	            str += "<div class='card-header'>";
	            str += "<b>Lượt khám</b>";
	            str += "<hr>";
	            str += "<div class='row'>";
	            str += "<div class='col-md-6'>";
	            str += "<div class='row'>";
	            str += "<label class='col-sm-4 col-form-label d-block'>";
	            str += "<b>Khoa</b>";
	            str += "</label>";
	            str += "<div class='col-sm-8'>";
	            str += "<select class='form-control faculty'>";
	            str += "<option value=''>Chọn một khoa</option>";
	            $.each(data.dulieukhoa, function(index, item) {
	                str += '<option value="' + item.fac_id + '">' + item.fac_name + '</option>';
	            });
	            str += "</select>";
	            str += "</div>";
	            str += "</div>";
	            str += "</div>";
	            str += "<div class='col-md-6'>";
	            str += "<div class='row'>";
	            str += "<label class='col-sm-4 col-form-label d-block'>";
	            str += "<b>Bác sĩ</b>";
	            str += "</label>";
	            str += "<div class='col-sm-8'>";
	            str += "<select class='form-control doctor'>";
	            str += "<option>Select 2</option>";
	            str += "</select>";
	            str += "</div>";
	            str += "</div>";
	            str += "</div>";
	            str += "</div>";
	            str += "<br>";
	            str += "<div class='row'>";
	            str += "<label class='col-sm-2 col-form-label d-block'>";
	            str += "<b>Kết quả khám</b>";
	            str += "</label>";
	            str += "<div class='col-sm-10'>";
	            str += "<textarea class='form-control' id='ketquakham' rows='2'></textarea>";
	            str += "</div>";
	            str += "</div>";
	            str += "<br>";
	            str += "<div class='row'>";
	            str += "<div class='col-md-6'>";
	            str += "<div class='row'>";
	            str += "<label class='col-sm-4 col-form-label d-block'>";
	            str += "<b>Ngày tái khám</b>";
	            str += "</label>";
	            str += "<div class='col-sm-8'>";
	            str += "<input type='date' class='form-control ngaytaikham' id='datepicker'>";
	            str += "</div>";
	            str += "</div>";
	            str += "</div>";
	            str += "<div class='col-md-6'>";
	            str += "<div class='row'>";
	            str += "<label class='col-sm-4 col-form-label d-block'>";
	            str += "<b>Thanh toán</b>";
	            str += "</label>";
	            str += "<div class='col-sm-8'>";
	            str += "<input class='form-control payment' placeholder='Số tiền thanh toán'>";
	            str += "</div>";
	            str += "</div>";
	            str += "</div>";
	            str += "</div>";
	            str += "</div>";
	            str += "<div class='card-body'>";
	            str += "<div class='card'>";
	            str += "<div class='card-header'>";
	            str += "<b>Thuốc</b>";
	            str += "</div>";
	            str += "<div class='themthuoc_group'>";
	            str += "<div class='card-body load_themthuoc'>";
	            str += "<div class='motcuc'>";
	            str += "<div class='row'>";
	            str += "<div class='col-sm-2'>";
	            str += "<b>Phần chọn thuốc</b>";
	            str += "</div>";
	            str += "<div class='col-sm-10'>";
	            str += "<input class='form-control med_name' type='text' placeholder='Vui lòng nhập tên thuốc' data-id=''>";
	            str += "</div>";
	            str += "</div>";
	            str += "<br>";
	            str += "<div class='row'>";
	            str += "<label class='col-sm-2 col-form-label d-block'>";
	            str += "<b>Liều dùng</b>";
	            str += "</label>";
	            str += "<div class='col-sm-10'>";
	            str += "<textarea class='form-control med_dose' id='textArea' rows='2'></textarea>";
	            str += "</div>";
	            str += "</div>";
	            str += "</div>";
	            str += "</div>";
	            str += "<div class='card-body'>";
	            str += "<div class='row'>";
	            str += "<label class='col-sm-2 col-form-label d-block'>";
	            str += "</label>";
	            str += "<div class='col-sm-10'>";
	            str += "<button type='submit' class='btn btn-primary nutthemthuoc'>Thêm thuốc</button>";
	            str += "</div>";
	            str += "</div>";
	            str += "</div>";
	            str += "</div>";
	            str += "</div>";
	            str += "</div>";
	            str += "</div>";

	            $('.load_select').append(str);
	        })
	        .fail(function() {
	            console.log("error");
	        })
	        .always(function(data) {
	            console.log("complete");
	        });
        });
		
		$('.load_select').on('click', '.nutthemthuoc', function(event) {
		    var $themthuocGroup = $(this).closest('.themthuoc_group');
		    var $selectGroup = $themthuocGroup.closest('.select_group');
		    $.ajax({
	        })
		    .done(function(data) {
	            var str = "";
	            str += "<hr>";
	            str += "<div class='motcuc'>";
	            str += "<div class='row'>";
	            str += "<div class='col-sm-2'>";
	            str += "<b>Phần chọn thuốc</b>";
	            str += "</div>";
	            str += "<div class='col-sm-10'>";
	            str += "<input class='form-control med_name' type='text' placeholder='Vui lòng nhập tên thuốc' data-id=''>";
	            str += "</div>";
	            str += "</div>";
	            str += "<br>";
	            str += "<div class='row'>";
	            str += "<label class='col-sm-2 col-form-label d-block'>";
	            str += "<b>Liều dùng</b>";
	            str += "</label>";
	            str += "<div class='col-sm-10'>";
	            str += "<textarea class='form-control med_dose' id='textArea' rows='2'></textarea>";
	            str += "</div>";
	            str += "</div>";
	            str += "</div>";
	            
	            $themthuocGroup.find('.load_themthuoc').append(str);

	            // donThuocCount++;
	        })
	        .fail(function() {
	            console.log("error");
	        })
	        .always(function(data) {
	            console.log("complete");
	        });
		});

		$('.laydulieu').click(function(event) {
		    // Tạo một đối tượng chứa toàn bộ dữ liệu
		    var dataToSend = {
		        identity: $('#identity').val(),
		        ngaykham: $('.ngaykham').val(),
		        appointments: []
		    };

		    // Duyệt qua tất cả các lượt khám
		    $('.select_group').each(function() {
		        var $selectGroup = $(this);
		        var appointmentData = {
		            doctor: $selectGroup.find('.doctor').val(),
		            results: $selectGroup.find('#ketquakham').val(),
		            revisit_date: $selectGroup.find('.ngaytaikham').val(),
		            payment: $selectGroup.find('.payment').val(),
		            medicines: []
		        };

		        // Duyệt qua tất cả các đơn thuốc trong lượt khám
		        // chỗ này mình debug chuẩn luôn nha(mình thêm cái motcuc vào), vì là mỗi lần duyệt cái nhóm loại thuốc thì nó phải lấy từng cái div đấy trong vòng lặp. Là thế đó. Nên là mới hay hehehehe.
		        $selectGroup.find('.themthuoc_group').find('.motcuc').each(function() {
		            var $themthuocGroup = $(this);
		            var medicineData = {
		                med_id: $themthuocGroup.find('.med_name').attr('data-id'),
		                med_dose: $themthuocGroup.find('.med_dose').val()
		            };

		            // Thêm dữ liệu đơn thuốc vào danh sách thuốc
		            appointmentData.medicines.push(medicineData);
		        });

		        // Thêm dữ liệu lượt khám vào danh sách lượt khám
		        dataToSend.appointments.push(appointmentData);
		    });

		    // Gửi dữ liệu dưới dạng JSON bằng AJAX
		    var confirmation = confirm("Bạn có muốn thêm lượt khám này không?");
    		if (confirmation) {
			    $.ajax({
			        url: 'pushDataToModel',
			        type: 'POST',
			        data: { dataToSend : dataToSend},
			        dataType: 'json',
			    })
			    .done(function(response) {
			        // Xử lý kết quả trả về từ máy chủ (nếu cần)
			        console.log(response);
			        window.location.reload();
			    })
			    .fail(function() {
			        console.log("error");
			        window.location.reload();
			    })
			    .always(function(data) {
			        console.log("complete");
			        window.location.reload();
			    });
			}
		});

	</script>
</body>
</html>