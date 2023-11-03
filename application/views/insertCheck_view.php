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
        .autocomplete-results {
            max-height: 200px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="card mt-4">
					<div class="card-header">
						<h3><i>Phần tìm kiếm người tới khám nè</i></h3>
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
								<!-- <label>Tên: <span id="name"></span></label> -->
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
											<input type="date" class="form-control" id="datepicker">
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
											<textarea class="form-control" id="textArea" rows="2"></textarea>
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
													<input type="date" class="form-control" id="datepicker">
												</div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="row">
												<label class="col-sm-4 col-form-label d-block">
													<b>Thanh toán</b>
												</label>
												<div class="col-sm-8">
													<input class="form-control" placeholder="Số tiền thanh toán">
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
												<div>
													<div class="row">
														<div class="col-sm-2">
															<b>Phần chọn thuốc</b>
														</div>
														<div class="col-sm-10">
															<input class="form-control med_name" type="text" placeholder="Vui lòng nhập tên thuốc">
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
								<button type="submit" class="btn btn-success">Submit</button>
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
					url: 'quanlybv/getDataIdentity',
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
		                url: 'quanlybv/getDataMedicine',
		                type: 'GET',
		                dataType: 'json',
		                success: function (data) {
		                    var aDataMed = $.map(data.dulieuthuoc, function (value, key) {
		                        return {
		                            id: value.med_id,
		                            label: value.med_name
		                        };
		                    });

		                    var results = $.ui.autocomplete.filter(aDataMed, request.term);
		                    response(results);
		                }
		            });
		        },
		        open: function (event, ui) {
		            $('.ui-autocomplete').addClass('autocomplete-results');
		        }
		    });
		});

		// $('.med_name').autocomplete({
		// 	// aDataMed = {}
		// 	source: function(request, response) {
		// 		$.ajax({
		// 			url: 'quanlybv/getDataMedicine',
		// 			type: 'GET',
		// 			dataType: 'json',
		// 			success: function(data) {
		// 				//console.log(data)
		// 				aDataMed = $.map(data.dulieuthuoc, function(value, key) {
		// 					return {
		// 						id: value.med_id,
		// 						label :value.med_name,
		// 					};
		// 				});
		// 				//console.log(aData)
		// 				var results = $.ui.autocomplete.filter(aDataMed, request.term);
		// 				response(results);
		// 			}
		// 		})
		// 	},
		// 	open: function(event, ui) {
		//         $('.ui-autocomplete').addClass('autocomplete-results');
		//     }
		// });

		$('.load_select').on('change', '.select_group .faculty', function() {
            var $selectGroup = $(this).closest('.select_group');
            var fac_id = $selectGroup.find('.faculty').val();
            var doctor = $selectGroup.find('.doctor');

            // Thực hiện AJAX request và xử lý dữ liệu với city_id
            if (fac_id) {
                $.ajax({
                    url: 'quanlybv/getDataDocSelect',
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
	            url: 'quanlybv/getDataFacSelect_ajax',
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
	            str += "<textarea class='form-control' id='textArea' rows='2'></textarea>";
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
	            str += "<input type='date' class='form-control' id='datepicker'>";
	            str += "</div>";
	            str += "</div>";
	            str += "</div>";
	            str += "<div class='col-md-6'>";
	            str += "<div class='row'>";
	            str += "<label class='col-sm-4 col-form-label d-block'>";
	            str += "<b>Thanh toán</b>";
	            str += "</label>";
	            str += "<div class='col-sm-8'>";
	            str += "<input class='form-control' placeholder='Số tiền thanh toán'>";
	            str += "</div>";
	            str += "</div>";
	            str += "</div>";
	            str += "</div>";
	            str += "</div>";
	            str += "<div class=card-body'>";
	            str += "<div class='card'>";
	            str += "<div class=card-header>";
	            str += "<b>Thuốc</b>";
	            str += "</div>";
	            str += "<div class='card-body load_themthuoc'>";
	            str += "<div>";
	            str += "<div class='row'>";
	            str += "<div class='col-sm-2'>";
	            str += "<b>Phần chọn thuốc</b>";
	            str += "</div>";
	            str += "<div class='col-sm-10'>";
	            str += "<input class='form-control med_name' type='text' placeholder='Vui lòng nhập tên thuốc'>";
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
		    var $selectGroup = $(this).closest('.select_group'); // Xác định lượt khám cụ thể
		    var $medNameInput = $selectGroup.find('.med_name');
		    $.ajax({
	        })
		    .done(function(data) {
	            var str = "";
	            str += "<hr>";
	            str += "<div>";
	            str += "<div class='row'>";
	            str += "<div class='col-sm-2'>";
	            str += "<b>Phần chọn thuốc</b>";
	            str += "</div>";
	            str += "<div class='col-sm-10'>";
	            str += "<input class='form-control med_name' type='text' placeholder='Vui lòng nhập tên thuốc'>";
	            str += "</div>";
	            str += "</div>";
	            str += "<br>";
	            str += "<div class='row'>";
	            str += "<label class='col-sm-2 col-form-label d-block'>";
	            str += "<b>Liều dùng</b>";
	            str += "</label>";
	            str += "<div class='col-sm-10'>";
	            str += "<textarea class='form-control' id='textArea' rows='2'></textarea>";
	            str += "</div>";
	            str += "</div>";
	            str += "</div>";
	            
	            $(this).closest('.select_group').find('.load_themthuoc').append(str);
	        })
	        .fail(function() {
	            console.log("error");
	        })
	        .always(function(data) {
	            console.log("complete");
	        });
		});
		
		
		// $('.load_select').on('click', '.nutthemthuoc', function(event) {
		//     var $selectGroup = $(this).closest('.select_group'); // Xác định lượt khám cụ thể
		//     var $medNameInput = $selectGroup.find('.med_name');
		//     var $medDoseTextarea = $selectGroup.find('.med_dose');
		    
		//     // Lấy giá trị của tên thuốc và liều dùng từ các trường nhập liệu
		//     var medName = $medNameInput.val();
		//     var medDose = $medDoseTextarea.val();

		//     // Kiểm tra xem tên thuốc và liều dùng có giá trị không trống
		//     if (medName.trim() !== '' && medDose.trim() !== '') {
		//         // Tạo một mẩu HTML mới cho loại thuốc và liệt kê thông tin trong lượt khám
		//         var newMedHtml = '<hr><div><div class="row"><div class="col-sm-2"><b>Phần chọn thuốc</b></div><div class="col-sm-10"><input class="form-control" type="text" value="' + medName + '" readonly></div></div><br><div class="row"><label class="col-sm-2 col-form-label d-block"><b>Liều dùng</b></label><div class="col-sm-10"><textarea class="form-control" rows="2" readonly>' + medDose + '</textarea></div></div></div>';

		//         // Chèn mẩu HTML mới vào lượt khám cụ thể
		//         $selectGroup.find('.load_themthuoc').append(newMedHtml);

		//         // Xóa giá trị của tên thuốc và liều dùng sau khi đã thêm
		//         $medNameInput.val('');
		//         $medDoseTextarea.val('');
		//     }
		// });


        // $('.nutthemthuoc').click(function(event) {
        // 	$.ajax({
	    //     })
		//     .done(function(data) {
	    //         var str = "";
	    //         str += "<hr>";
	    //         str += "<div>";
	    //         str += "<div class='row'>";
	    //         str += "<div class='col-sm-2'>";
	    //         str += "<b>Phần chọn thuốc</b>";
	    //         str += "</div>";
	    //         str += "<div class='col-sm-10'>";
	    //         str += "<input class='form-control med_name' type='text' placeholder='Vui lòng nhập tên thuốc'>";
	    //         str += "</div>";
	    //         str += "</div>";
	    //         str += "<br>";
	    //         str += "<div class='row'>";
	    //         str += "<label class='col-sm-2 col-form-label d-block'>";
	    //         str += "<b>Liều dùng</b>";
	    //         str += "</label>";
	    //         str += "<div class='col-sm-10'>";
	    //         str += "<textarea class='form-control' id='textArea' rows='2'></textarea>";
	    //         str += "</div>";
	    //         str += "</div>";
	    //         str += "</div>";
	            
	    //         $('.load_themthuoc').append(str);
	    //     })
	    //     .fail(function() {
	    //         console.log("error");
	    //     })
	    //     .always(function(data) {
	    //         console.log("complete");
	    //     });
        // });
	</script>
</body>
</html>