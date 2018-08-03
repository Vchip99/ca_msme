@extends('admin.master')
@section('header-title')
    <title>Sub Admins</title>
@endsection
@section('header-css')
  <link rel="stylesheet" type="text/css" href="{{asset('css/formstyle.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/profile.css')}}">
  <style type="text/css">
    .container{
      padding-top: 50px;
    }
  </style>
@stop
@section('content')
  @include('admin.header')
  &nbsp;
  <div style="padding-top: 50px;">
    <div class="container div-style">
    @if(Session::has('message'))
      <div class="alert alert-success" id="message">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ Session::get('message') }}
      </div>
    @endif
      <div class="form-group row">
        <div id="addUserDiv">
          <a id="addUser" href="{{url('admin/createSubAdmin')}}" type="button" class="btn btn-primary" style="float: right;" title="Add New Sub Admin">Add New Sub Admin</a>&nbsp;&nbsp;
        </div>
      </div>
    <div>
      <table class="table admin_table">
        <thead class="thead-inverse">
          <tr>
            <th>#</th>
            <th>Sub Admin Name</th>
            <th>Edit Sub Admin</th>
            <th>Delete Sub Admin</th>
          </tr>
        </thead>
        <tbody>
          @if(count($subadmins) > 0)
          @foreach($subadmins as $index => $subadmin)
          <tr>
            <th scope="row">{{$index +1}}</th>
            <td>{{$subadmin->name}}</td>
            <td>
              <a href="{{url('admin/sub-admin')}}/{{$subadmin->id}}/edit"><img src="{{asset('images/edit1.png')}}" width='30' height='30' title="Edit {{$subadmin->name}}" />
                </a>
            </td>
            <td>
            <a id="{{$subadmin->id}}" onclick="confirmDelete(this);"><img src="{{asset('images/delete2.png')}}" width='30' height='30'/>
                </a>
                <form id="deleteSubadmin_{{$subadmin->id}}" action="{{url('admin/deleteSubadmin')}}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="subadmin_id" value="{{$subadmin->id}}">
                </form>

            </td>
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
  </div>
<script type="text/javascript">

    function confirmDelete(ele){
      if(confirm('You want to delete this subadmin?')){
        var id = $(ele).attr('id');
        formId = 'deleteSubadmin_'+id;
        document.getElementById(formId).submit();
      }
      return false;
    }

</script>
@stop