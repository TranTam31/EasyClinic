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
						<h3><b>Tra cứu thông tin, thêm sửa xóa thuốc</b></h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-2">
								<b>Tìm kiếm thuốc:</b>
							</div>
							<div class="col-md-4 load_inputName">
								<input type="text" class="form-control med_name" placeholder="Nhập tên thuốc vào đây">
							</div>
							<div class="col-md-3 load_nuttimthuoc">
								<button class="form-control btn btn-success nuttimthuoc">Tìm kiếm</button>
							</div>
							<div class="col-md-3 load_nutthemthuoc">
								<button class="form-control btn btn-primary nutthemthuoc">Thêm thuốc</button>
							</div>
						</div>

						<br>
						<table class="table load_thuoc">
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
					    </table>
					    <div class="row">
					    	<div class="col-2">
					    		
					    	</div>
					    	<div class="col-3 load_nutok">
					    		<button class="form-control btn btn-warning nutsuathuoc">Sửa thông tin thuốc</button>
					    	</div>
					    	<div class="col-3 load_nutxoa">
					    		<button class="form-control btn btn-danger nutxoathuoc">Xóa thuốc</button>
					    	</div>
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
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

		                    var results = $.ui.autocomplete.filter(aDataMed, request.term);
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

		$(document).on('click', '.nuttimthuoc', function(event) {
			var idThuoc = $('.med_name').attr('data-id');
			if(idThuoc && $('.med_name').val()!= '') {
				$.ajax({
					url: 'getDataThuoc_trangthuoc',
					type: 'POST',
					dataType: 'json',
					data: {idThuoc: idThuoc},
				})
				.done(function(data) {
					console.log(data);
					var str = "";
					str+= '<tbody>'
					str+= '<tr>'
					str+= '<th class="col-2">ID</th>'
					str+= '<td>'+data.dulieuthuoc[0]['med_id']+'</td>'
					str+= '</tr>'
					str+= '<tr>'
					str+= '<th class="col-2">Nhà cung cấp</th>'
					str+= '<td>'+data.dulieuthuoc[0]['nhacungcap']+'</td>'
					str+= '</tr>'
					str+= '<tr>'
					str+= '<th class="col-2">Thành phần</th>'
					str+= '<td>'+data.dulieuthuoc[0]['thanhphan']+'</td>'
					str+= '</tr>'
					str+= '<tr>'
					str+= '<th class="col-2">Chỉ định</th>'
					str+= '<td>'+data.dulieuthuoc[0]['chidinh']+'</td>'
					str+= '</tr>'
					str+= '</tbody>'

					$('.load_thuoc').html(str);
				})
				.fail(function() {
					console.log("error")
				})
				.always(function() {
					console.log("complete");
				});
			} else {
				alert("Vui lòng chọn một tên thuốc!");
			}
		});

		// $(document).keyup('.nuttimthuoc', function(event) {
		// 	if(event.key === 'Enter') {
		// 		var idThuoc = $('.med_name').attr('data-id');
		// 		if(idThuoc) {
		// 			$.ajax({
		// 				url: 'getDataThuoc_trangthuoc',
		// 				type: 'POST',
		// 				dataType: 'json',
		// 				data: {idThuoc: idThuoc},
		// 			})
		// 			.done(function(data) {
		// 				console.log(data);
		// 				var str = "";
		// 				str+= '<tbody>'
		// 				str+= '<tr>'
		// 				str+= '<th class="col-2">ID</th>'
		// 				str+= '<td>'+data.dulieuthuoc[0]['med_id']+'</td>'
		// 				str+= '</tr>'
		// 				str+= '<tr>'
		// 				str+= '<th class="col-2">Nhà cung cấp</th>'
		// 				str+= '<td>'+data.dulieuthuoc[0]['nhacungcap']+'</td>'
		// 				str+= '</tr>'
		// 				str+= '<tr>'
		// 				str+= '<th class="col-2">Thành phần</th>'
		// 				str+= '<td>'+data.dulieuthuoc[0]['thanhphan']+'</td>'
		// 				str+= '</tr>'
		// 				str+= '<tr>'
		// 				str+= '<th class="col-2">Chỉ định</th>'
		// 				str+= '<td>'+data.dulieuthuoc[0]['chidinh']+'</td>'
		// 				str+= '</tr>'
		// 				str+= '</tbody>'

		// 				$('.load_thuoc').html(str);
		// 			})
		// 			.fail(function() {
		// 				console.log("error")
		// 			})
		// 			.always(function() {
		// 				console.log("complete");
		// 			});
		// 		} else {
		// 			alert("Vui lòng chọn một tên thuốc!");
		// 		}
		// 	}
		// });

		$(document).on('click', '.nutsuathuoc', function(event) {
			var idThuoc = $('.med_name').attr('data-id');
			if(idThuoc) {
				$.ajax({
					url: 'getDataThuoc_trangthuoc',
					type: 'POST',
					dataType: 'json',
					data: {idThuoc: idThuoc},
				})
				.done(function(data) {
					console.log(data);
					var str = "";
					str+= '<tbody>'
					str+= '<tr>'
					str+= '<th class="col-2">ID</th>'
					str+= '<td>'+data.dulieuthuoc[0]['med_id'] + ' <b>(Bạn không thay đổi được ID thuốc)</b>'+'</td>'
					str+= '</tr>'
					str+= '<tr>'
					str+= '<th class="col-2">Nhà cung cấp</th>'
					str+= '<th><input type="text" class="form-control med_ncc_sua" value="'+data.dulieuthuoc[0]['nhacungcap']+'"></th>'
					str+= '</tr>'
					str+= '<tr>'
					str+= '<th class="col-2">Thành phần</th>'
					str+= '<th><textarea row="2" type="text" class="form-control med_tp_sua">'+data.dulieuthuoc[0]['thanhphan']+'</textarea></th>'
					str+= '</tr>'
					str+= '<tr>'
					str+= '<th class="col-2">Chỉ định</th>'
					str+= '<th><textarea row="2" type="text" class="form-control med_cd_sua">'+data.dulieuthuoc[0]['chidinh']+'</textarea></th>'
					str+= '</tr>'
					str+= '</tbody>'

					$('.load_thuoc').html(str);
					$('.load_nutok').html('<button class="form-control btn btn-warning nutok">Lưu</button>');
					$('.nutsuathuoc').remove();
					$('.nutxoathuoc').remove();
					$('.nuttimthuoc').remove();
					$('.load_nutthemthuoc').html('');
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			} else {
				alert("Hãy nhập để chọn một tên thuốc!");
			}
		});

		$(document).on('click', '.nutok', function(event) {
			var idThuoc = $('.med_name').attr('data-id');
			var ten_thuoc = $('.med_name').val();
			var ncc_thuoc = $('.med_ncc_sua').val();
			var tp_thuoc = $('.med_tp_sua').val();
			var cd_thuoc = $('.med_cd_sua').val();
			$.ajax({
				url: 'updateThuoc',
				type: 'POST',
				dataType: 'json',
				data: {
					idThuoc: idThuoc,
					ten_thuoc: ten_thuoc,
					ncc_thuoc: ncc_thuoc,
					tp_thuoc: tp_thuoc,
					cd_thuoc: cd_thuoc
				},
			})
			.done(function(data) {
				console.log(data);
				alert("Bạn đã thay đổi thông tin thuốc thành công!")
				$('.load_nuttimthuoc').append('<button class="form-control btn btn-success nuttimthuoc">Tìm kiếm</button>');
				$('.load_nutthemthuoc').html('<button class="form-control btn btn-primary nuttthemthuoc">Thêm thuốc</button>');
				var str = "";
				str+= '<tbody>'
				str+= '<tr>'
				str+= '<th class="col-2">ID</th>'
				str+= '<td>'+idThuoc+'</td>'
				str+= '</tr>'
				str+= '<tr>'
				str+= '<th class="col-2">Nhà cung cấp</th>'
				str+= '<td>'+ncc_thuoc+'</td>'
				str+= '</tr>'
				str+= '<tr>'
				str+= '<th class="col-2">Thành phần</th>'
				str+= '<td>'+tp_thuoc+'</td>'
				str+= '</tr>'
				str+= '<tr>'
				str+= '<th class="col-2">Chỉ định</th>'
				str+= '<td>'+cd_thuoc+'</td>'
				str+= '</tr>'
				str+= '</tbody>'

				$('.load_thuoc').html(str);
				$('.nutok').remove();
				$('.load_nutok').append('<button class="form-control btn btn-warning nutsuathuoc">Sửa thông tin thuốc</button>');
				$('.load_nutxoa').append('<button class="form-control btn btn-danger nutxoathuoc">Xóa thuốc</button>');
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		});

		$(document).on('click', '.nutxoathuoc', function(event) {
			var idThuoc = $('.med_name').attr('data-id');
			var ten_thuoc = $('.med_name').val();
			if(idThuoc) {
				$.ajax({
					url: 'xoaThuoc',
					type: 'POST',
					dataType: 'json',
					data: {idThuoc: idThuoc},
				})
				.done(function(data) {
					console.log(data);
					alert("Bạn đã xóa thành công thuốc có ID: "+idThuoc+" ("+ten_thuoc+")");
					$('.med_name').val('');
					var str = '';
					str+= '<tbody>'
					str+= '<tr>'
					str+= '<th class="col-2">ID</th>'
					str+= '<td><i>... (Vui lòng nhập tìm một loại thuốc)</i></td>'
					str+= '</tr>'
					str+= '<tr>'
					str+= '<th class="col-2">Nhà cung cấp</th>'
					str+= '<td><i>... (Vui lòng nhập tìm một loại thuốc)</i></td>'
					str+= '</tr>'
					str+= '<tr>'
					str+= '<th class="col-2">Thành phần</th>'
					str+= '<td><i>... (Vui lòng nhập tìm một loại thuốc)</i></td>'
					str+= '</tr>'
					str+= '<tr>'
					str+= '<th class="col-2">Chỉ định</th>'
					str+= '<td><i>... (Vui lòng nhập tìm một loại thuốc)</i></td>'
					str+= '</tr>'
					str+= '</tbody>'

					$('.load_thuoc').html(str);
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			} else {
				alert("Bạn chưa nhập thuốc!");
			}
		});

		$(document).on('click', '.nutthemthuoc', function(event) {
			$('.med_name').val('');
			$.ajax({
			})
			.done(function() {
				$('.nuttimthuoc').remove();
				$('.nutthemthuoc').remove();
				$('.med_name').remove();
				$('.load_nuttimthuoc').append('<button class="form-control btn btn-primary nutthemvaodb">Thêm</button>');
				$('.load_inputName').html('<input type="text" class="form-control med_name_them" placeholder="Nhập tên thuốc cần thêm vào đây">');
				var str = "";
				str+= '<tbody>'
				str+= '<tr>'
				str+= '<th class="col-2">ID</th>'
				str+= '<th><input type="text" class="form-control med_id_them" placeholder="Nhập ID thuốc chính xác để không bị trùng" ></th>'
				str+= '</tr>'
				str+= '<tr>'
				str+= '<th class="col-2">Nhà cung cấp</th>'
				str+= '<th><input type="text" class="form-control med_ncc_them" value="'+'Chưa nhập nhà cung cấp'+'"></th>'
				str+= '</tr>'
				str+= '<tr>'
				str+= '<th class="col-2">Thành phần</th>'
				str+= '<th><textarea row="2" type="text" class="form-control med_tp_them">'+'Chưa nhập thành phần'+'</textarea></th>'
				str+= '</tr>'
				str+= '<tr>'
				str+= '<th class="col-2">Chỉ định</th>'
				str+= '<th><textarea row="2" type="text" class="form-control med_cd_them">'+'Chưa nhập chỉ định'+'</textarea></th>'
				str+= '</tr>'
				str+= '</tbody>'

				$('.load_thuoc').html(str);
				$('.nutsuathuoc').remove();
				$('.nutxoathuoc').remove();
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		});

		$(document).on('click', '.nutthemvaodb', function(event) {
			var tenThuoc = $('.med_name_them').val();
			var idThuoc = $('.med_id_them').val();
			var nccThuoc = $('.med_ncc_them').val();
			var tpThuoc = $('.med_tp_them').val();
			var cdThuoc = $('.med_cd_them').val();
			if(!tenThuoc || !idThuoc || !nccThuoc || !tpThuoc || !cdThuoc) {
				alert("Vui lòng nhập đủ thông tin của bác sĩ cần thêm");
			} else {
				$.ajax({
					url: 'themThuocVaoData',
					type: 'POST',
					dataType: 'json',
					data: {
						tenThuoc: tenThuoc,
						idThuoc: idThuoc,
						nccThuoc: nccThuoc,
						tpThuoc: tpThuoc,
						cdThuoc: cdThuoc
					},
				})
				.done(function(data) {
					console.log(data);
					if(data == "Thêm thành công") {
						$('.load_nutthemthuoc').html('<button class="form-control btn btn-primary nutthemthuoc">Thêm thuốc</button>');
						$('.load_nuttimthuoc').html('<button class="form-control btn btn-success nuttimthuoc">Tìm kiếm</button>');
						$('.load_inputName').html('<input type="text" value="'+tenThuoc+'" class="form-control med_name" data-id="'+idThuoc+'" placeholder="Nhập tên thuốc vào đây">');
						var str = "";
						str+= ''
						str+= '<tbody>'
						str+= '<tr>'
						str+= '<th class="col-2">ID</th>'
						str+= '<td>'+idThuoc+'</td>'
						str+= '</tr>'
						str+= '<tr>'
						str+= '<th class="col-2">Nhà cung cấp</th>'
						str+= '<td>'+nccThuoc+'</td>'
						str+= '</tr>'
						str+= '<tr>'
						str+= '<th class="col-2">Thành phần</th>'
						str+= '<td>'+tpThuoc+'</td>'
						str+= '</tr>'
						str+= '<tr>'
						str+= '<th class="col-2">Chỉ định</th>'
						str+= '<td>'+cdThuoc+'</td>'
						str+= '</tr>'
						str+= '</tbody>'

						$('.load_thuoc').html(str);
						$('.load_nutok').html('<button class="form-control btn btn-warning nutsuathuoc">Sửa thông tin thuốc</button>');
						$('.load_nutxoa').html('<button class="form-control btn btn-danger nutxoathuoc">Xóa thuốc</button>');
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
		});
	</script>
</body>
</html>