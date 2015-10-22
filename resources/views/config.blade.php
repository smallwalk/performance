@extends('welcome')

@section('content')

<div class="box">
	<div class="box-head">
		<h2>Snake & Virus配置列表</h2>
	</div>
	<form method="get" action="/config">
		<div class="form">
			@foreach ($name_list as $key => $checked) 
				<input type="radio" name="check_name" value="{{ $key }}" @if($checked) checked="checked" @endif /> {{ $key }}
			@endforeach	
			<input type="submit" class="button" value="查询" />
		</div>
		<!-- Table -->
	</form>			
	<div class="table" id="snake_config">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<th width="13"><input type="checkbox" class="checkbox" /></th>
				<th>Snake Module</th>
				<th>Snake Action</th>
				<th>Status</th>
				<th width="110" class="ac">Content Control</th>
			</tr>
			@foreach ($snake_config_list as $module => $actions) 
				@foreach ($actions as $actionInfo) 
				<tr>
					<td><input type="checkbox" class="checkbox" /></td>
					<td>{{ $module }}</td>
					<td>{{ $actionInfo['name'] }}</td>
					<td>{{ $actionInfo['switch'] }}</td>
					<td>
						<a href="#" class="close">关闭</a>&nbsp;&nbsp;<a href="#" class="delete">删除</a>
					</td>
				</tr>
				@endforeach
			@endforeach
		</table>
	</div>
	
	<br />

	<div class="table" id="virus_config">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<th width="13"><input type="checkbox" class="checkbox" /></th>
				<th>Virus Module</th>
				<th>Virus Action</th>
				<th>Status</th>
				<th width="110" class="ac">Content Control</th>
			</tr>
			@foreach ($virus_config_list as $module => $actions) 
				@foreach ($actions as $actionInfo) 
				<tr>
					<td><input type="checkbox" class="checkbox" /></td>
					<td>{{ $module }}</td>
					<td>{{ $actionInfo['name'] }}</td>
					<td>{{ $actionInfo['switch'] }}</td>
					<td><a href="#">关闭</a>&nbsp;&nbsp;<a href="#" class="delete">删除</a></td>
				</tr>
				@endforeach
			@endforeach
		</table>
	</div>
</div>

<!-- Box -->
<div class="box">
	<!-- Box Head -->
	<div class="box-head">
		<h2>添加配置</h2>
	</div>
	<!-- End Box Head -->
	<form action="/config/add" method="post">
		<!-- Form -->
		<div class="form">
				<p>
					<label>Module <span>(Required Field)</span></label>
					<input type="text" class="field size1" name="module" />
				</p>
				<p>
					<label>Action<span>(Required Field)</span></label>
					<input type="text" class="field size1" name="action" />
				</p>
				<p class="inline-field">
					<label>Framework</label>
					<select class="field size2" name="framework">
						<option value="virus">Virus</option>
						<option value="snake">Snake</option>
					</select>
				</p>
				<p class="inline-field">
					<label>Author</label>
					<select class="field size2" name="author">
						@foreach ($name_list as $key => $checked)
							<option value={{$key}} @if($checked) selected="selected" @endif>{{$key}}</option>
						@endforeach
					</select>
				</p>
				<p class="inline-field">
					<label>Switch</label>
					<select class="field size2" name="switch">
						<option value="on">On</option>
						<option value="off">Off</option>
					</select>
				</p>
		</div>
		<!-- End Form -->

		<!-- Form Buttons -->
		<div class="buttons">
			<input type="submit" class="button" value="submit" />
		</div>
		<!-- End Form Buttons -->
	</form>
</div>
<!-- End Box -->

@endsection
