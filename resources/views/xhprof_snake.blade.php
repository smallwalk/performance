@extends('welcome')

@section('content')
<!-- Box -->
<div class="box">
	<!-- Box Head -->
	<div class="box-head">
		<h2 class="left">Current Articles</h2>
		<div class="right">
		</div>
	</div>
	<!-- Table -->
	<div class="table">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<th width="13"><input type="checkbox" class="checkbox" /></th>
				<th>Key</th>
				<th>Module</th>
				<th>Action</th>
				<th>Spend Time</th>
				<th>cTime</th>
				<th width="110" class="ac">Content Control</th>
			</tr>
			@foreach ($xhprofData as $key => $info) 
			<tr>
				<td><input type="checkbox" class="checkbox" /></td>
				<td><h3><a href="http://xhprof.com/?run={{ $key }}" target="_blank">{{ $key }}</a></h3></td>
				<td>{{ $info->module}}</td>
				<td>{{ $info->action}}</td>
				<td>{{ $info->time_spend}}</td>
				<td>{{ $info->ctime }}</td>
				<td><a href="http://xhprof.com/?run={{ $key }}" target="_blank">详情</a>&nbsp;&nbsp;<a href="#">删除</a></td>
			</tr>
			@endforeach
		</table>
		
		
		<!-- Pagging -->
		<div class="pagging">
			<div class="left">Showing 1-12 of 44</div>
			<div class="right">
				<a href="#">Previous</a>
				<a href="#">1</a>
				<a href="#">2</a>
				<a href="#">3</a>
				<a href="#">4</a>
				<a href="#">245</a>
				<span>...</span>
				<a href="#">Next</a>
				<a href="#">View all</a>
			</div>
		</div>
		<!-- End Pagging -->
		
	</div>
	<!-- Table -->
</div>
<!-- End Box -->
@endsection
