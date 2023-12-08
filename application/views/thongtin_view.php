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
	
	<?php require('menuchungKhach.php') ?>
	<?php $identity = $this->session->userdata('identity'); ?>

	<div class="container main">
		<div class="row">
			<div class="col-md-12">
				<div class="card mt-4">
					<div class="card-header">
						
						<div class="row">
					    	<div class="col-4">
					    		<h3><b>Thông tin của bạn</b></h3>
					    	</div>
					    </div>	
					</div>
					<div class="card-body">
						<table class="table table-bordered">
					        <tbody>
				                <tr>
				                    <td class="col-3"><b>Số CCCD</b></td>
				                    <td><?php echo $dulieu[0]['identity']; ?></td>
				                </tr>
				                <tr>
				                    <td class="col-3"><b>Họ tên</b></td>
				                    <td><?php echo $dulieu[0]['people_name']; ?></td>
				                </tr>
				                <tr>
				                    <td class="col-3"><b>Giới tính</b></td>
				                    <td><?php echo $dulieu[0]['sex']; ?></td>
				                </tr>
				                <tr>
				                    <td class="col-3"><b>Ngày sinh</b></td>
				                    <td><?php echo $dulieu[0]['dob']; ?></td>
				                </tr>
				                <tr>
				                    <td class="col-3"><b>Số điện thoại</b></td>
				                    <td><?php echo $dulieu[0]['people_phone']; ?></td>
				                </tr>
				                <tr>
				                    <td class="col-3"><b>Địa chỉ</b></td>
				                    <td><?php echo $dulieu[0]['address']; ?></td>
				                </tr>
					        </tbody>
					    </table>
					    <hr>
					    <div class="row">
					    	<div class="col-md-4">
					    		<b>Thông tin các lượt khám của bạn</b>
					    	</div>
					    	<div class="col-md-2 nutanhien">
					    		<button class="form-control btn btn-success nutshowdata">Xem chi tiết</button>
					    	</div>
					    </div>
					    <br>
					    <div class="row" id="load_noidung">
					    	
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).on('click', '.nutshowdata', function(event) {
			$.ajax({
				url: 'getDataCheckUp_Session',
				type: 'GET',
			})
			.done(function(data) {
				data = JSON.parse(data)
				console.log(data);
				var str= '';
				if(data.length != 0) {
					str += '<br>'
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
	                    str+="<tr><th><h6><i>Ngày khám: " + item.ngaykham + "</i></h6></th></tr>";
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
                    str += '</tbody>'
                    str += '</table>'
	            } else {
	            	str += '<div class="col">'
	                str +="<h6 class='text-danger mt-3'>Bạn chưa có lần khám nào tại bệnh viện</h6>";
	                str +="</div>";
	            }
	    		$('#load_noidung').html(str);
	    		$('.nutanhien').html('<button class="form-control btn btn-success nuthidedata">Ẩn chi tiết</button>');
			})
			.fail(function() {
				console.log("error");
			})
			.always(function(data) {
				console.log(data);
			});
		});

		$(document).on('click', '.nutxemketqua', function(event) {
			var id_luotKham = $(this).data('val');
			//alert(id_luotKham);
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
		                    title: 'Thông tin đơn thuốc',
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

	    $(document).on('click', '.nuthidedata', function(event) {
			$.ajax({
			})
			.done(function() {
	    		$('#load_noidung').html('');
	    		$('.nutanhien').html('<button class="form-control btn btn-success nutshowdata">Xem chi tiết</button>');
			})
			.fail(function() {
				console.log("error");
			})
			.always(function(data) {
				console.log(data);
			});
		});
	</script>
</body>
</html>