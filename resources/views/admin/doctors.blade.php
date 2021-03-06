@extends('admin.master')

@section('content')
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Doctors</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	@if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                {{ session('success')}}
              </div>
            @endif
              <table id="datatable" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Patients</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                	@foreach($hospital->doctors() as $doctor)
                	<tr>
                		<td>{{$doctor->fullName()}}</td>
                		<td>{{$doctor->email}}</td>
                		<td>{{count($doctor->patients)}}</td>
                		<td><a href="{{route('admin.delete_doctor',['domain' => $hospital->slug])}}" class="btn btn-sm btn-primary" onclick="event.preventDefault();document.getElementById('delete-{{$doctor->id}}').submit();">Delete</a>
                		<form id="delete-{{$doctor->id}}" action="{{ route('admin.delete_doctor',['domain' => $hospital->slug]) }}" method="POST" style="display: none;">
                			<input type="hidden" name="doctor" value="{{$doctor->id}}">
                    	{{ csrf_field() }}
                  		</form></td>
                	</tr>
                	@endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
@endsection

@section('scripts')
<script>
	$('#datatable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });
</script>
@endsection