@extends('admin.master')

@section('content')
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Patients</h3>
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
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Doctor</th>
                  <th>Id</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                	@foreach($hospital->patients() as $patient)
                	<tr>
                		<td>{{$patient->fullName()}}</td>
                		<td>{{$patient->email}}</td>
                		<td>{{$patient->doctors[0]->fullName()}}</td>
                    <td>{{$patient->patient_id}}</td>
                		<td><a href="{{route('admin.delete_patient',['domain' => $hospital->slug])}}" class="btn btn-sm btn-primary" onclick="event.preventDefault();document.getElementById('delete-{{$patient->id}}').submit();">Delete</a>
                		<form id="delete-{{$patient->id}}" action="{{ route('admin.delete_patient',['domain' => $hospital->slug]) }}" method="POST" style="display: none;">
                			<input type="hidden" name="doctor" value="{{$patient->id}}">
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