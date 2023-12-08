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
  		.anh{
		    background-image: url('https://lh3.googleusercontent.com/pw/ADCreHclkBhWWkmRJ2HagQINeTRZH9NkN--7-fs-xWMFLLRPs0fZohrVpU0UKJOWNNGXNrVk0BMvse8Ai-ZTnjvkb7EO6Q6u1vhJPgpA751W45Y5khXgCT4Ysc9wUB5MT8uNeg0pnQNq50ZBrFN7eo_tYv422Q6lmFQ50K90CeFD2sx2XwrPfFmqWcDsLnVAK5RHxPDwcTx4-0X2VThIgK21tRYv4oqDsp5-_RCAwn5yPhmt-tZAPCuxs-4Hu88XDXL0OgGTdvZRzgo4I9Dw6puT5e7EpcC2DRKcgPVzFls3c-nk6dlw3wARkPFfbHxRbLQfLowmsm3hIt3RP0HQPmf5z_tzX87sU0p4txRguMYOc8TEPnfIpd-UpM6qDq0dxgnfEbC95fgaEypI688l_zjs4bl7-SXAPdvsQYmhBMtU3_V-k__XsGZyXLgYhw0QoX0KgE311jsrvNUBTDCIozFjJkstAB3l6dnq5Fm8zPOj_YQfQW08piClB-BJSxz0R-KyJuWaDZulvWkWm2FYGFjMJvonfcJi1tyMUI1kgaogimJdo7Gj_PsmPPEPRpX5ZxchFJCwdQmVcBEwx4-SAwOyfKpqfL97nyRcX5hIhbHu91gXsLejDG3daXDQY41I5CBPnlqNByx66Lz1LMqM2-DIwA4bKQjMZFYsFQC1cOwqIbKyCcBIZeQwupTHEVsEyq_5ZTPVjFx7UAtmmPsZhw2AVOn8oQlUQw9ovJxKqwKT6lzwPetBze_Ynufyg8zOgnXCVzXY4aOCuKr-D6pnvp6qbi56NIwNao7ZStuD2cAOI8MsGYNjKyXaj67rgExnnlDFMTCR-LnX8LW52Vw5ZBNmbLj0LzAuYKlW17zJntI68BohOa074ftdSBbal5T-5_cXJQ=w1644-h924-s-no-gm?authuser=0'); /* Đường dẫn đến ảnh */
		    background-size: cover; /* Hiển thị ảnh theo kích thước cover */
		    background-repeat: no-repeat; /* Không lặp lại ảnh */
		    
		}
  	</style>
</head>
<body class="anh">
	<?php require('menuchungKhach.php') ?>
	<?php $identity = $this->session->userdata('identity'); ?>
</body>
</html>