@extends('admin.master')
@section('header-title')
    <title>Home</title>
@endsection
@section('header-css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/docstyle.css')}}">
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <link href="{{ asset('css/datepicker.css')}}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .input-panel{
            /*margin-top: 40px;*/
            box-shadow: 0px 0px 15px #a8a8a8;
            padding: 5px 20px;
        }
        .results-panel{
            padding: 20px 20px;
            margin-top: 10px;
            box-shadow: 0px 0px 15px #a8a8a8;
        }
        .list-bar{
            padding: 10px 10px;
            background-color: #003d99;
            color: white;
            font-size: 17px;
        }
        table{
            margin-top: 20px;
            border:1px solid #abb2b9;
        }
        th,td{
            padding: 5px 5px;
            width:9%;
        }
        td:hover{
            cursor: pointer;
        }
        .btn{
            font-size: 15px;
        }
        span{
            font-size: 17px;
            color: #000;
        }
        .rmv{
           color: #fff;
           font-size: 13px;
        }
        .btn-close{
            width: 25px;
            height: 25px;
            padding: 3px 1px;
            background-color: #ff0000;
        }
        .btn-close:hover{
            background-color: #ff0000;
            opacity: 0.8;
        }
        .heading{
            margin-top: 60px;
            font-size: 25px;
            color: #003d99;
        }

        .add-on .input-group-btn > .btn {
            left:-2px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        }
        .add-on .form-control:focus {
            box-shadow:none;
           -webkit-box-shadow:none;
            border-color:#cccccc;
        }
    </style>
@stop
@section('content')
  @include('admin.header')
    <div class="container-fluid" style="padding: 0px 40px;">
        <div class="heading">
            <span class="fa fa-inbox" style="font-size: 23px;"></span> Enquiries
            <span style="float: right; color: red;" >
                Uncompleted Count- {{$unCompletedCount}}
            </span>
        </div>
        @if(Session::has('message'))
            <div class="alert alert-success" id="message">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('message') }}
            </div>
        @endif
        <hr style="margin: 5px;">
        <div class="container-fluid input-panel">
            <div class="vertical-form topnav">
                <!-- <form> -->
                <div class="row">
                     @if(0 == $loginUser->is_subadmin)
                    <div class="form-group col-m-6 col-3" style="">
                        <label class="control-label">Start Date</label>
                        <div class="">
                            <input type='text' class="form-control" name="start_date" id='start_date' placeholder="YYYY-MM-DD" />
                        </div>
                    </div>
                    <div class="form-group col-m-6 col-3" style="">
                        <label class="control-label">End Date</label>
                        <div class="">
                            <input type='text' class="form-control" name="end_date" id='end_date' placeholder="YYYY-MM-DD" />
                        </div>
                    </div>
                    <div class="col-m-6 col-3">
                        <button class="btn btn-default btn-success" onClick="downloadExcelRecords();" style="margin-top: 25px;"><span class="fa fa-download" style="font-size:15px;"></span>  Download</button>
                        <form action="{{ url('admin/download-excel-records') }}" method="GET" id="export_result">
                          <input type="hidden" name="start_date" id="export_start_date" value="">
                          <input type="hidden" name="end_date" id="export_end_date" value="">
                        </form>
                    </div>
                    @endif

                </div>
                <!-- </form> -->
                <div class="row">
                    <div class="form-group col-m-6 col-3">
                        <label class="control-label">Order Status</label>
                        <div>
                            <select class="form-control" name="application_status" id="application_status">
                                <option value="">Select Order status</option>
                                <option value="All">All</option>
                                <option value="1">Application Filled</option>
                                <option value="2">Payment Done</option>
                                <option value="3">Documents Verified</option>
                                <option value="4">ID Generated</option>
                                @if(0 == $loginUser->is_subadmin)
                                <option value="5">Completed</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-m-6 col-3">
                        <label class="control-label">Payment Status</label>
                        <div>
                            <select class="form-control" name="payment_status" id="payment_status">
                                <option value="">Select Payment Status</option>
                                <option value="All">All</option>
                                <option value="Paid">Paid</option>
                                <option value="UnPaid">UnPaid</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-m-6 col-3">
                        <button class="btn btn-default btn-success" onclick="search();" style="margin-top: 25px;"><span class="fa fa-search" style="font-size:15px;"></span>  Search</button>
                    </div>
                    <div class="form-group col-m-6 col-3" style="float: right;">
                        <div class="input-group" style="margin-top: 25px;">
                            <input type="text" class="form-control" name="search_order_id" id="search_order_id" placeholder="Search by order id.." onkeyup="searchOrderId(this);" >
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid results-panel table-responsive">
            <div class="list-bar">Enquiries List</div>
            <table border="1">
                <thead>
                <tr>
                    <th>Sr no.</th>
                    <th>Date</th>
                    <th>Order ID</th>
                    <th>Name/ Email/ Mobile</th>
                    <th>City</th>
                    <th>Application Status</th>
                    <th>Payment Status</th>
                    @if(0 == $loginUser->is_subadmin)
                        <th>Assigned To</th>
                        <th>Action</th>
                    @endif
                </tr>
                </thead>
                <tbody id="all_records" class="">
                @if(count($allRegistrations) > 0)
                    @foreach($allRegistrations as $index => $registration)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$registration->created_at->format('Y-m-d')}}</td>
                            <td><a href="{{ url('admin/enquiry')}}/{{$registration->order_id}}">{{$registration->order_id}}</a></td>
                            <td>{{$registration->adhaar_name}}</td>
                            <td>{{$registration->city}}</td>
                            <td><a data-toggle="modal" data-target="#status_{{$registration->order_id}}">{{$registration->applicationStatus()}}<a>
                                <!-- Order Status Modal -->
                                <div class="modal fade" id="status_{{$registration->order_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered" role="document" style="padding-top: 50px;">
                                    <form  class="form-horizontal" role="form" method="POST" action="{{ url('admin/changeOrderStatus') }}">
                                    {{ csrf_field() }}
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Application Status</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                            <select class="form-control" name="application_status" required>
                                                <option value="">Select Order status</option>
                                                <option value="1" @if(1 == $registration->application_status) selected @endif>Application Filled</option>
                                                <option value="2" @if(2 == $registration->application_status) selected @endif>Payment Done</option>
                                                <option value="3" @if(3 == $registration->application_status) selected @endif>Documents Verified</option>
                                                <option value="4" @if(4 == $registration->application_status) selected @endif>ID Generated</option>
                                                <option value="5" @if(5 == $registration->application_status) selected @endif>Completed</option>
                                            </select>
                                            <input type="hidden" name="order_id" value="{{$registration->order_id}}">
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Change Status</button>
                                      </div>
                                    </div>
                                    </form>
                                  </div>
                                </div>
                            </td>
                            <td>
                                @if('Paid' == $registration->payment_status)
                                    Paid
                                @else
                                    <a data-toggle="modal" data-target="#payment_{{$registration->order_id}}">UnPaid<a>
                                    <!-- Payment Status Modal -->
                                    @if('Paid' != $registration->payment_status)
                                        <div class="modal fade" id="payment_{{$registration->order_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document" style="padding-top: 50px;">
                                            <form  class="form-horizontal" role="form" method="POST" action="{{ url('admin/changePaymentStatus') }}">
                                            {{ csrf_field() }}
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Payment Status</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                    <select class="form-control" name="payment_status" required>
                                                        <option value="">Select Payment Status</option>
                                                        <option value="Paid" @if('Paid' == $registration->payment_status) selected @endif>Paid</option>
                                                    </select>
                                                    <input type="hidden" name="order_id" value="{{$registration->order_id}}">
                                                    <input type="hidden" name="type" value="{{$registration->type}}">
                                                    <input type="hidden" name="sub_type" value="{{$registration->sub_type}}">
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Change Status</button>
                                              </div>
                                            </div>
                                            </form>
                                          </div>
                                        </div>
                                    @endif
                                @endif
                            </td>
                            @if(0 == $loginUser->is_subadmin)
                                <td>
                                    <form id="assign_{{$registration->order_id}}" action="{{url('admin/assign-subadmin')}}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="order_id" value="{{$registration->order_id}}">
                                        <select class="form-control" name="assigned_sub_admin" onChange="assignSubadmin({{$registration->order_id}});">
                                            <option value="">Select Sub Admin</option>
                                            @if(count($subadmins) > 0)
                                                @foreach($subadmins as $subadmin)
                                                    <option value="{{$subadmin->id}}" @if($subadmin->id == $registration->assigned_sub_admin) selected @endif>{{$subadmin->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </form>
                                </td>
                                <td><a id="{{$registration->order_id}}"  class="btn btn-default btn-close pull-left" onclick="confirmDelete(this);"><span class="fa fa-remove rmv"></span></a>
                                    <form id="deleteOrder_{{$registration->order_id}}" action="{{url('admin/deleteOrder')}}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="hidden" name="order_id" value="{{$registration->order_id}}">
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <input type="hidden" id="is_subadmin" value="{{$loginUser->is_subadmin}}">
<script type="text/javascript">
    function confirmDelete(ele){
        if(confirm('Are you sure, you want to delete this order?')){
            var id = $(ele).attr('id');
            formId = 'deleteOrder_'+id;
            document.getElementById(formId).submit();
        }
        return false;
    }

    function search(){
        var applicationStatus = document.getElementById('application_status').value;
        var paymentStatus = document.getElementById('payment_status').value;
        $.ajax({
            method:'POST',
            url: "{{url('admin/searchByArr')}}",
            data:{application_status:applicationStatus,payment_status:paymentStatus}
        }).done(function( msg ) {
            body = document.getElementById('all_records');
            body.innerHTML = '';
            renderResult(msg,body);
        });
    }

    function renderResult(searchResult,body){
        if(searchResult['allRecords']){
            $.each(searchResult['allRecords'], function(idx, obj) {
                var eleTr = document.createElement('tr');
                var eleIndex = document.createElement('td');
                eleIndex.innerHTML = idx;
                eleTr.appendChild(eleIndex);

                var eleDate = document.createElement('td');
                eleDate.innerHTML = obj['created_at'];
                eleTr.appendChild(eleDate);

                var urlEnquiry = "{{url('admin/enquiry')}}/"+obj['order_id'];
                var eleOrderId = document.createElement('td');
                eleOrderId.innerHTML = '<a href="'+urlEnquiry+'">'+obj['order_id']+'</a>';
                eleTr.appendChild(eleOrderId);

                var eleName = document.createElement('td');
                eleName.innerHTML = obj['name'];
                eleTr.appendChild(eleName);

                var eleCity = document.createElement('td');
                eleCity.innerHTML = obj['city'];
                eleTr.appendChild(eleCity);

                var applicationStatus = obj['application_status'];
                var csrfField = '{{ csrf_field() }}';
                var statusUrl = "{{ url('admin/changeOrderStatus') }}";
                var eleStatus = document.createElement('td');
                eleStatusInnerHTML = '';
                eleStatusInnerHTML = '<a data-toggle="modal" data-target="#status_'+obj['order_id']+'">'+obj['application_status']+'<a>';
                eleStatusInnerHTML += '<div class="modal fade" id="status_'+obj['order_id']+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">';
                eleStatusInnerHTML += '<div class="modal-dialog modal-dialog-centered" role="document" style="padding-top: 50px;">';
                eleStatusInnerHTML += '<form  class="form-horizontal" role="form" method="POST" action="'+statusUrl+'">'+csrfField;
                eleStatusInnerHTML += '<div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLongTitle">Application Status</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                eleStatusInnerHTML += '<div class="modal-body"><select class="form-control" name="application_status" required><option value="">Select Order status</option>';
                if('Application Filled' == applicationStatus){
                    eleStatusInnerHTML += '<option value="1" selected>Application Filled</option>';
                } else {
                    eleStatusInnerHTML += '<option value="1" >Application Filled</option>';
                }
                if('Payment Done' == applicationStatus){
                    eleStatusInnerHTML += '<option value="2" selected>Payment Done</option>';
                } else {
                    eleStatusInnerHTML += '<option value="2">Payment Done</option>';
                }
                if('Documents Verified' == applicationStatus){
                    eleStatusInnerHTML += '<option value="3" selected>Documents Verified</option>';
                } else {
                    eleStatusInnerHTML += '<option value="3">Documents Verified</option>';
                }
                if('ID Generated' == applicationStatus){
                    eleStatusInnerHTML += '<option value="4" selected>ID Generated</option>';
                } else {
                    eleStatusInnerHTML += '<option value="4">ID Generated</option>';
                }
                if('Completed' == applicationStatus){
                    eleStatusInnerHTML += '<option value="5" selected>Completed</option>';
                } else {
                    eleStatusInnerHTML += '<option value="5">Completed</option>';
                }
                eleStatusInnerHTML += '</select><input type="hidden" name="order_id" value="'+obj['order_id']+'"></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="submit" class="btn btn-primary">Change Status</button></div></div></form></div></div>';
                eleStatus.innerHTML = eleStatusInnerHTML;
                eleTr.appendChild(eleStatus);

                var elePayment = document.createElement('td');
                if('Paid' == obj['payment_status']){
                    elePayment.innerHTML = obj['payment_status'];
                } else {
                    var paymentStatus = obj['payment_status'];
                    var csrfField = '{{ csrf_field() }}';
                    var paymentUrl = "{{ url('admin/changePaymentStatus') }}";
                    elePaymentInnerHTML = '';
                    elePaymentInnerHTML += '<a data-toggle="modal" data-target="#payment_'+obj['order_id']+'">UnPaid<a>';
                    elePaymentInnerHTML += '<div class="modal fade" id="payment_'+obj['order_id']+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">';
                    elePaymentInnerHTML += '<div class="modal-dialog modal-dialog-centered" role="document" style="padding-top: 50px;">';
                    elePaymentInnerHTML += '<form  class="form-horizontal" role="form" method="POST" action="'+paymentUrl+'">'+csrfField;
                    elePaymentInnerHTML += '<div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLongTitle">Payment Status</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                    elePaymentInnerHTML += '<div class="modal-body"><select class="form-control" name="payment_status" required><option value="">Select Payment Status</option>';
                    if('Paid' == paymentStatus){
                        elePaymentInnerHTML += '<option value="Paid" selected>Paid</option>';
                    } else {
                        elePaymentInnerHTML += '<option value="Paid" >Paid</option>';
                    }
                    elePaymentInnerHTML += '</select><input type="hidden" name="order_id" value="'+obj['order_id']+'"><input type="hidden" name="type" value="'+obj['type']+'"><input type="hidden" name="sub_type" value="'+obj['sub_type']+'"></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="submit" class="btn btn-primary">Change Status</button></div></div></form></div></div>';
                    elePayment.innerHTML = elePaymentInnerHTML;
                }
                eleTr.appendChild(elePayment);
                if(0 == document.getElementById('is_subadmin').value){
                    var eleAssign = document.createElement('td');
                    var csrfField = '{{ csrf_field() }}';
                    var assignUrl = "{{ url('admin/assign-subadmin') }}";
                    eleAssignInnerHTML = '';
                    eleAssignInnerHTML = '<form id="assign_'+obj['order_id']+'" action="'+assignUrl+'" method="POST" >'+csrfField+'<input type="hidden" name="order_id" value="'+obj['order_id']+'"><select class="form-control" name="assigned_sub_admin" onChange="assignSubadmin('+obj['order_id']+');"><option value="">Select Sub Admin</option>';
                    if(searchResult['allSubadmins'].length > 0){
                        $.each(searchResult['allSubadmins'], function(idx, subadmin){
                            if(subadmin['id'] == obj['assigned_sub_admin']){
                                eleAssignInnerHTML += '<option value="'+subadmin['id']+'" selected>'+subadmin['name']+'</option>';
                            } else {
                                eleAssignInnerHTML += '<option value="'+subadmin['id']+'" >'+subadmin['name']+'</option>';
                            }
                        });
                    }
                    eleAssignInnerHTML += '</select></form>';
                    eleAssign.innerHTML = eleAssignInnerHTML;
                    eleTr.appendChild(eleAssign);


                    var eleDelete = document.createElement('td');
                    var methodField = '{{ method_field('DELETE') }}';
                    var csrfField = '{{ csrf_field() }}';
                    var deleteUrl = "{{ url('admin/deleteOrder') }}";
                    eleDelete.innerHTML = '<a id="'+obj['order_id']+'"  class="btn btn-default btn-close pull-left" onclick="confirmDelete(this);"><span class="fa fa-remove rmv"></span></a><form id="deleteOrder_'+obj['order_id']+'" action="'+deleteUrl+'" method="POST" style="display: none;">'+csrfField+''+methodField+'<input type="hidden" name="order_id" value="'+obj['order_id']+'"></form>';
                    eleTr.appendChild(eleDelete);
                }

                body.appendChild(eleTr);
            });
        } else {
            var eleTr = document.createElement('tr');
            var eleIndex = document.createElement('td');
            eleIndex.innerHTML = 'No result!';
            eleIndex.setAttribute('colspan', '11');
            eleTr.appendChild(eleIndex);
            body.appendChild(eleTr);
        }
    }

    function searchOrderId(ele){
        var orderId = $(ele).val();
        if(orderId.length > 4){
            $.ajax({
                method:'POST',
                url: "{{url('admin/searchByOrderId')}}",
                data:{order_id:orderId}
            }).done(function( msg ) {
                body = document.getElementById('all_records');
                body.innerHTML = '';
                renderResult(msg,body);
            });
        } else if(0 == orderId.length){
            window.location.reload();
        } else {
            body = document.getElementById('all_records');
            body.innerHTML = '';
            var eleTr = document.createElement('tr');
            var eleIndex = document.createElement('td');
            eleIndex.innerHTML = 'No result!';
            eleIndex.setAttribute('colspan', '11');
            eleTr.appendChild(eleIndex);
            body.appendChild(eleTr);
        }
    }

    function assignSubadmin(orderId){
        document.getElementById('assign_'+orderId).submit();
    }

    function downloadExcelRecords(){
        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;
        if(startDate > endDate){
            alert('start date is less than end date.');
            return false;
        }
        if(!startDate){
            alert('select start date.');
            return false;
        }

        if(!endDate){
            alert('select end date.');
            return false;
        }

        if(startDate && endDate){
          document.getElementById('export_start_date').value = startDate;
          document.getElementById('export_end_date').value = endDate;
          document.getElementById('export_result').submit();
        }
    }

    $(function () {
      $("#start_date").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
      });
      $("#end_date").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
      });
    });
</script>
@stop

