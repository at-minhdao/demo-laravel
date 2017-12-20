<!-- resources/views/tasks/index.blade.php -->

@extends('layouts.app') @section('content')

<!-- Bootstrap Boilerplate... -->

<div class="panel-body">

	@if (Session::has('msg'))
	<div class="row">
		<div class="col-sm-offset-3 col-sm-6">
				<p class="alert alert-success">{{ Session::get('msg') }}</p>
		</div>
	</div>
	@endif
	<!-- Display Validation Errors -->
	<div class="row">
		<div class="col-sm-offset-3 col-sm-6">
			@include('common.errors')
		</div>
	</div>
	<!-- New Task Form -->
	<form action="{{ url('tasks') }}" method="POST" class="form-horizontal">
		{{ csrf_field() }}

		<!-- Task Name -->
		<div class="form-group">
			<label for="task-name" class="col-sm-3 control-label">Task</label>

			<div class="col-sm-6">
				<input type="text" name="name" id="task-name" class="form-control">
			</div>
		</div>

		<!-- Add Task Button -->
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-6">
				<button type="submit" class="btn btn-default">
					<i class="fa fa-plus"></i> Add Task
				</button>
			</div>
		</div>
	</form>
</div>

<!-- TODO: Current Tasks -->
<div class="col-sm-offset-3 col-sm-6">
	@if (count($tasks) > 0)
	<div class="panel panel-default">
		<div class="panel-heading">
			Current Tasks
		</div>

		<div class="panel-body">
			<table class="table table-striped task-table">

				<!-- Table Headings -->
				<thead>
					<th>Task</th>
					<th>&nbsp;</th>
				</thead>
				<!-- Table Body -->
				<tbody>
					@foreach ($tasks as $task)
					<tr>
						<!-- Task Name -->
						<td class="table-text">
							<div>{{ $task->name }}</div>
						</td>
						<!-- Delete Button -->
						<td>
							<form action="{{ route('tasks.edit', [$task->id]) }}" method="GET" style="display: inline-block">
								<button type="submit" class="btn btn-success">
									<i class="fa fa-btn fa-trash"></i>Edit
								</button>
							</form>
							<form action="{{ route('tasks.destroy', [$task->id]) }}" method="POST" style="display: inline-block">
								{{ csrf_field() }} {{ method_field('DELETE') }}
								<button type="submit" class="btn btn-danger" onclick="return confirm('Do you want delete!')">
									<i class="fa fa-btn fa-trash"></i>Delete
								</button>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@endif
</div>
@endsection