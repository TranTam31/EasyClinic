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
  		/*.ui-autocomplete {
		    z-index: 1001;
		}*/
		.modall {
			position: fixed;
			display: none;
			justify-content: center;
            align-items: center;
		    top: 0;
		    right: 0;
		    left: 0;
		    bottom: 0;
		    background-color: rgba(0, 0, 0, 0.4);
		    overflow: auto;
		}

		.modall.open {
			display: flex;
		}

		.modall-container {
			position: relative;
			display: flex;
			top: 20px;
			justify-content: center;
            align-items: center;
            height: 950px;
		}

		.con-controller {
			width: 1020px;
		}

		.tatmodel {
			float: right;
		}

		.noidungheader {
			margin-left: 15px;
			margin-top: 6px;
		}

  	</style>
</head>
<body class="anh">
	<?php require('menuchungBacsi.php') ?>
	<?php $identity = $this->session->userdata('identity'); ?>
	<div class="container main">
		<div class="row">
			<div class="col-md-12">
				<div class="card mt-4">
					<div class="card-header">
						
						<div class="row">
					    	<div class="col-4">
					    		<h3><b>Lượt chờ khám</b></h3>
					    		<h6>Ngày: <?php echo date("d-m-Y") ?></h6>
					    	</div>
					    </div>	
					</div>
					<div class="card-body">
						<table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Số CCCD</th>
                                    <th>Tên bệnh nhân</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php foreach ($mang_luotKhamDangCho as $value): ?>
									<tr>
	                                    <th><?= $value['stt'] ?></th>
	                                    <th><?= $value['identity'] ?></th>
	                                    <th><?= $value['people_name'] ?></th>
	                                    <th><button class="form-control btn btn-success nutkham" value="<?= $value['identity'] ?>">Khám</button></th>
	                                </tr>
								<?php endforeach ?>
                            </tbody>
                        </table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modall">
		<div class="row modall-container">
			<div class="con-controller">
				<div class="card">
					<div class="card-header">
						
						<div class="row">
					    	<div class="noidungheader">
					    		<h3><b class="tenbenhnhan"></b></h3>
					    		<h6 class="socccd"></h6>
					    		<h6 class="ngaysinh"></h6>
					    	</div>
					    </div>	
					</div>
					<div class="card-body">
						<div class="card-header">
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
						<div class="row">
							<div class="col-sm-12">
								<button type="submit" class="btn btn-success laydulieu">Submit</button>
								<button type="submit" class="btn btn-danger tatmodel">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
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

		$('.nutthemthuoc').on('click', function(event) {
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
	            
	            $('.load_themthuoc').append(str);

	            // donThuocCount++;
	        })
	        .fail(function() {
	            console.log("error");
	        })
	        .always(function(data) {
	            console.log("complete");
	        });
		});

		$('.nutkham').on('click', function(event) {
			// $('.modall').classList.add('open') -> đây là phương thức của cái khác, không phải của jQuery nha
			$('.modall').addClass('open');
			var identity = $(this).val();
			$.ajax({
				url: 'getPeopleName',
				type: 'POST',
				dataType: 'json',
				data: {identity: identity},
			})
			.done(function(data) {
				console.log();
				var ten = "";
				var socccd = "";
				var ngaysinh = "";
				ten += "Bệnh nhân: " + data.peopleName[0].people_name;
				$('.tenbenhnhan').html(ten);
				socccd += "Số CCCD: " + data.peopleName[0].identity;
				$('.socccd').html(socccd);
				ngaysinh += "Ngày sinh: " + data.peopleName[0].dob;
				$('.ngaysinh').html(ngaysinh);

			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		});

		$('.tatmodel').on('click', function(event) {
			$('.modall').removeClass('open');
			window.location.reload();
		});
		
		$('.laydulieu').on('click', function(event) {
		    // Tạo một đối tượng chứa toàn bộ dữ liệu
			var today = new Date();
			var day = today.getDate();
			var month = today.getMonth() + 1; // Tháng bắt đầu từ 0, nên cần cộng thêm 1
			var year = today.getFullYear();

			// Định dạng ngày thành chuỗi "dd-mm-yyyy"
			var formattedDate = year + '-' + month + '-' + day;

		    var dataToSend = {
		        identity: $('.nutkham').val(),
		        ngaykham: formattedDate,
	            results: $('#ketquakham').val(),
	            revisit_date: $('.ngaytaikham').val(),
	            payment: $('.payment').val(),
	            medicines: []
		    };
		        // Duyệt qua tất cả các đơn thuốc trong lượt khám
		        // chỗ này mình debug chuẩn luôn nha(mình thêm cái motcuc vào), vì là mỗi lần duyệt cái nhóm loại thuốc thì nó phải lấy từng cái div đấy trong vòng lặp. Là thế đó. Nên là mới hay hehehehe.
		        $('.themthuoc_group').find('.motcuc').each(function() {
		        	var themthuocGroup = $(this);
		            var medicineData = {
		                med_id: themthuocGroup.find('.med_name').attr('data-id'),
		                med_dose: themthuocGroup.find('.med_dose').val()
		            };

		            // Thêm dữ liệu đơn thuốc vào danh sách thuốc
		            dataToSend.medicines.push(medicineData);
		        });

		    // Gửi dữ liệu dưới dạng JSON bằng AJAX
		    var confirmation = confirm("Bạn có muốn thêm lượt khám này không?");
    		if (confirmation) {
    			console.log(dataToSend);
			    $.ajax({
			        url: 'pushDataLuotKham',
			        type: 'POST',
			        data: { dataToSend : dataToSend},
			        dataType: 'json',
			    })
			    .done(function(data) {
			    	if(data == "OK") {
		    			var identity = $('.nutkham').val();
		    			$.ajax({
		    				url: 'xoaLuotVuaKham',
		    				type: 'POST',
		    				dataType: 'json',
		    				data: {
		    					identity: identity,
		    					ngaykham: formattedDate
		    				},
		    			})
		    			.done(function() {
		    				console.log("success");
		    			})
		    			.fail(function() {
		    				console.log("error");
		    			})
		    			.always(function() {
		    				console.log("complete");
		    			});
		    			
						window.location.reload();
					} else {
						alert("Not ok");
					}
			    })
			    .fail(function() {
			        console.log("error");
			        window.location.reload();
			    })
			    .always(function(data) {
			        console.log("complete");
			        // window.location.reload();
			    });
			}
		});
	</script>
</body>
</html>