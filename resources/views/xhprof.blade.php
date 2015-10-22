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
				<th>time</th>
				<th>host</th>
				<th>path</th>
			</tr>
			@foreach ($xhprofData as $key => $info) 
			<tr>
				<td><input type="checkbox" class="checkbox" /></td>
				<td><h3><a href="{{ $info['xhprof_detail_url']}}" target="_blank">{{ $key }}</a></h3></td>
				<td>{{ $info['time'] }}</td>
				<td>{{ $info['host'] }}</td>
				<td>{{ $info['path'] }}</td>
			</tr>
			@endforeach
		</table>
		
		
		<!-- Pagging -->
		<div class="pagging">
		</div>
		<!-- End Pagging -->
	</div>
	<!-- Table -->
</div>
<!-- End Box -->
@endsection
