<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Performance Anaylysis</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<script src="http://cdn.bootcss.com/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
<!-- Header -->
<div id="header">
	<div class="shell">
		<!-- Logo + Top Nav -->
		<div id="top">
			<h1><a href="#">Performance Analysis</a></h1>
			<div id="top-navigation">
				Welcome <a href="#"><strong>Admin</strong></a>
				<span>|</span>
				<a href="#">Help</a>
			</div>
		</div>
		<!-- End Logo + Top Nav -->
		
		<!-- Main Nav -->
		<div id="navigation">
			<ul>
			    <li><a href="/" @if ($tab == 'virus') class="active" @endif ><span>Xhprof</span></a></li>
			    <li><a href="/config" @if ($tab == 'config') class="active" @endif ><span>Config</span></a></li>
			</ul>
		</div>
		<!-- End Main Nav -->
	</div>
</div>
<!-- End Header -->

<!-- Container -->
<div id="container">
	<div class="shell">
		
		<!-- Small Nav -->
		<div class="small-nav">
			<a href="#">性能分析</a>
			<span>&gt;</span>
			{{ $current }}	
		</div>
		<!-- End Small Nav -->
		
		<br />
		<!-- Main -->
		<div id="main">
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content">
				@yield('content')
			</div>
			<!-- End Content -->
			
			<div class="cl">&nbsp;</div>			
		</div>
		<!-- Main -->
	</div>
</div>
<!-- End Container -->

<!-- Footer -->
<div id="footer">
	<div class="shell">
		<span class="left">&copy; 2010 - CompanyName</span>
		<span class="right">
			Design by <a href="http://chocotemplates.com" target="_blank" title="The Sweetest CSS Templates WorldWide">Chocotemplates.com</a>
		</span>
	</div>
</div>
<!-- End Footer -->
	
</body>
</html>

<script type="text/javascript">
	$(function(){
		
		var name = $("div.box form div.form").find("input:checked").val();

		$("#virus_config > table  td a.delete").click(function(){
			var module = $(this).parent().parent().find("td").eq(1).text();
			var action = $(this).parent().parent().find("td").eq(2).text();
			var swi = $(this).parent().parent().find("td").eq(3).text();
			$.ajax({
				type:'post',
				url: '/config/delete',
				data: { module: module, action: action, name: name, swi: swi, framework: 'virus' },
				success: function($data) {
				},
				dataType: 'json',
			});
		});

		//删除配置
		$("#snake_config > table  td a.delete").click(function(){
			var module = $(this).parent().parent().find("td").eq(1).text();
			var action = $(this).parent().parent().find("td").eq(2).text();
			var swi = $(this).parent().parent().find("td").eq(3).text();
			$.ajax({
				type:'post',
				url: '/config/delete',
				data: { module: module, action: action, name: name, swi: swi, framework: 'snake' },
				success: function($data) {
				},
				dataType: 'json',
			});
		});
	});
</script>
