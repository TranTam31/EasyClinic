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
  	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css"></script>
  	<style>
     	.main{
     		padding-top: 60px;
     	}
     	.autocomplete-results {
            max-height: 200px;
            overflow-y: auto;
        }

		/*hơ hơ chỗ này là mình ghi đè cái thuộc tính của bảng popup nè, đỉnh vl:)))*/
        .swal2-popup {
		    display: none;
		    position: relative;
		    box-sizing: border-box;
		    grid-template-columns: minmax(0, 100%);
		    width: 43em;
		    max-width: 100%;
		    padding: 0 0 1.25em;
		    border: none;
		    border-radius: 5px;
		    background: #fff;
		    color: #545454;
		    font-family: inherit;
		    font-size: 1rem;
		}
    </style>
</head>
<body>
	<?php require('menuchung.php') ?>
	<div class="container main">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
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
								<button class="form-control btn btn-success nutshowdata">Tìm kiếm</button>
							</div>
						</div>

						<br>

						<div class="row" id="load_ndcanhan">
							
						</div>

						<div class="row" id="load_noidung">
					    	
					    </div>
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

		$(document).on('click', '.nutshowdata', function(event) {
			var identity = $('.identity').val();
			if(identity) {
				$.ajax({
					url: 'getDataPeople',
					type: 'POST',
					dataType: 'json',
					data: {identity: identity},
				})
				.done(function(data) {
					console.log(data);
					var str= '';
					if(data.length != 0) {
						str += '<hr>'
						str += '<h4><b>Thông tin cá nhân</b></h4>'
						str += '<table class="table table-bordered">'
					    str += '<tbody>'
				        str += '<tr>'
				        str += '<td class="col-3"><b>Họ tên</b></td>'
				        str += '<td>' + data.dulieupeople[0].people_name + '</td>'
				        str += '</tr>'
				        str += '<tr>'
				        str += '<td class="col-3"><b>Giới tính</b></td>'
				        str += '<td>' + data.dulieupeople[0].sex + '</td>'
				        str += '</tr>'
				        str += '<tr>'
				        str += '<td class="col-3"><b>Ngày sinh</b></td>'
				        str += '<td>' + data.dulieupeople[0].dob + '</td>'
				        str += '</tr>'
				        str += '<tr>'
				        str += '<td class="col-3"><b>Số điện thoại</b></td>'
				        str += '<td>' + data.dulieupeople[0].people_phone + '</td>'
				        str += '</tr>'
				        str += '<tr>'
				        str += '<td class="col-3"><b>Địa chỉ</b></td>'
				        str += '<td>' + data.dulieupeople[0].address + '</td>'
				        str += '</tr>'
					    str += '</tbody>'
					    str += '</table>'
					}
					$('#load_ndcanhan').html(str);
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				

				$.ajax({
					url: 'getDataCheckUp',
					type: 'POST',
					dataType: 'json',
					data: {identity: identity},
				})
				.done(function(data) {
					console.log(data);
					var str= '';
					if(data.length != 0) {
						str += '<br>'
						str += '<h4><b>Thông tin các lượt khám</b></h4>'
						str += '<table class="table table-bordered">'
	                    str += '<thead>'
	                    str += '<tr>'
	                    str += '<th>Khoa</th>'
	                    str += '<th>Bác sĩ khám</th>'
	                    str += '<th>Kết quả khám</th>'
	                    str += '<th>Ngày tái khám</th>'
	                    str += '<th>Đơn thuốc</th>'
	                    str += '<th>Thanh toán</th>'
	                    str += '</tr>'
	                    str += '</thead>'
	                    str += '<tbody>'
	                    $.each(data,function(i, item) {
	                        str+="<tr><th><h6><i>Ngày khám: " + item.ngaykham + "</i></h6></tr></th>";
	                        $.each(item.thongtin,function(index, el) {
		                        str+= "<tr>"
		                        str+= "<th>"+el.tenkhoa+"</th>"
		                        str+= "<th>"+el.tenbacsi+"</th>"
		                        str+= "<th><button data-val='"+ el.id_luotkham +"'class='form-control btn btn-outline-warning nutxemketqua'>Xem</button></th>"
		                        str+= "<th>"+el.ngaykhamlai+"</th>"
		                        str+= "<th><button data-val='"+ el.id_luotkham +"'class='form-control btn btn-outline-warning nutxemthuoc'>Xem</button></th>"
		                        str+= "<th>"+el.thanhtoan+"</th>"
		                        str+= "</tr>" 
	                        });
	                    });	
                } else {
                    str+="<h6 class='text-danger text-center mt-3'>Người này chưa có lần khám nào</h6>";
                }
	    		$('#load_noidung').html(str);
				})
				.fail(function() {
					console.log("error");
				})
				.always(function(data) {
					console.log(data);
				});
				
			}
		});

		$(document).on('click', '.nutxemketqua', function(event) {
			var id_luotKham = $(this).data('val');
			if(id_luotKham) {
				$.ajax({
					url: 'getResult',
					type: 'POST',
					dataType: 'json',
					data: {id_luotKham: id_luotKham},
				})
				.done(function(data) {
					console.log(data);
					(async () => {
			          const { value: formValues } = await Swal.fire({
			            title: 'Kết quả khám',
			            html:
			              '<table class="table table-bordered">'
			               + '<tr><th>'+ data[0].result +'</th></tr>' + 
			               '</table>'
			          })
			        })()
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			}
	    });

		$(document).on('click', '.nutxemthuoc', function(event) {
			var id_luotKham = $(this).data('val');
			if(id_luotKham) {
				$.ajax({
					url: 'getDonThuoc',
					type: 'POST',
					dataType: 'json',
					data: {id_luotKham: id_luotKham},
				})
				.done(function(data) {
					console.log(data);
	                (async () => {
		                let htmlContent = '<table class="table table-bordered">' +
		                                '<thead>' +
		                                '<tr>' +
		                                '<th>STT</th>' +
		                                '<th>Thuốc</th>' +
		                                '<th>Liều dùng</th>' +
		                                '</tr>' +
		                                '</thead>' +
		                                '<tbody>';

		                $.each(data, function (index, val) {
		                    htmlContent +=
		                        '<tr>' +
		                        '<td>' + (index + 1) + '</td>' +
		                        '<td>' + val.med_name + '</td>' +
		                        '<td>' + val.dose + '</td>' +
		                        '</tr>';
		                });

		                htmlContent += '</tbody></table>';

		                const formValues = await Swal.fire({
		                    title: 'Đơn thuốc',
		                    html: htmlContent
		                });
		            })();
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			}
	    });
	</script>
</body>
</html>