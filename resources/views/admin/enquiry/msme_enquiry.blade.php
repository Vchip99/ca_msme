@extends('admin.master')
@section('header-css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/formstyle.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/profile.css')}}">
@stop
@section('content')
    @php
        $adminUser = Auth::guard('admin')->user();
    @endphp
    @if(is_object($adminUser))
        @include('admin.header')
    @endif
  	<div style="padding:40px;">
	    <center><h1 class="page-heading">MSME REGISTRATION</h1></center>
        @if(!is_object($adminUser))
            <a class="btn btn-primary" href="{{ url('dashboard')}}" style="margin-left: 10%"><b>Back</b></a>
        @endif
        <div class="container div-style">
            @if(is_object($adminUser))
                <button class="btn btn-default btn-lg btn-primary pull-right" id="modify">Modify</button>
            <br>
            <div style="padding: 20px 20px">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/msme-update') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
            @endif
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-m-6 col-6" for="applicant">1. Adhaar Card Number <sup>*</sup></label>
                            <div class="col-m-6 col-6" >
                                <input type="text" class="form-control" name="adhaar_number" value="{{$registeredRecord->adhaar_number}}" placeholder="Adhaar Card number" required readonly="true">
                            </div>
                       </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-m-6 col-6">2. Name as per Adhaar Card <sup>*</sup></label>
                            <div class="col-m-6 col-6">
                                <input type="text" class="form-control" name="adhaar_name" value="{{$registeredRecord->adhaar_name}}" placeholder="Name of applicant" required readonly="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-m-6 col-6" for="pan_no">3. Applicant's Category <sup>*</sup></label>
                            <div class="col-m-6 col-6">
                                <select class="form-control" name="application_category" required disabled>
                                    <option value="">Select Category</option>
                                    <option value="General" @if('General' == $registeredRecord->application_category) selected @endif>General</option>
                                    <option value="OBC" @if('OBC' == $registeredRecord->application_category) selected @endif>OBC</option>
                                    <option value="SC" @if('SC' == $registeredRecord->application_category) selected @endif>SC</option>
                                    <option value="ST" @if('ST' == $registeredRecord->application_category) selected @endif>ST</option>>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-m-6 col-6">4. Gender <sup>*</sup></label>
                            <div class="radio col-m-3 col-3">
                                <label><input type="radio" name="gender" value="Male" @if('Male' == $registeredRecord->gender) checked="true" @endif required disabled>Male</label>
                            </div>
                            <div class="radio col-m-3 col-3">
                                <label><input type="radio" name="gender" value="Female" @if('Female' == $registeredRecord->gender) checked="true" @endif required disabled>Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-m-6 col-6">5. Physically Handicapped <sup>*</sup></label>
                            <div class="radio col-m-3 col-3">
                                <label><input type="radio" name="disability" value="Yes" @if('Yes' == $registeredRecord->disability) checked="true" @endif required disabled>Yes</label>
                            </div>
                            <div class="radio col-m-3 col-3">
                                <label><input type="radio" name="disability" value="No" @if('No' == $registeredRecord->disability) checked="true" @endif required disabled>No</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-m-6 col-6">6. Name of Enterprise/ Business <sup>*</sup></label>
                            <div class="col-m-6 col-6">
                                <input type="text" class="form-control" name="enterprise_name" value="{{$registeredRecord->enterprise_name}}" placeholder="Name of Enterprise/ Business" required readonly="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-m-6 col-6">7. Type of Organisation<sup>*</sup></label>
                            <div class="col-m-6 col-6">
                                <select class="form-control" name="organisation_type" disabled>
                                    <option value="">Select Type of Organisation</option>
                                    <option value="Proprietorship Firm"  @if('Proprietorship Firm' == $registeredRecord->organisation_type) selected @endif>Proprietorship Firm</option>
                                    <option value="Hindu Undivided Family"  @if('Hindu Undivided Family' == $registeredRecord->organisation_type) selected @endif>Hindu Undivided Family</option>
                                    <option value="Partnership firm"  @if('Partnership firm' == $registeredRecord->organisation_type) selected @endif>Partnership firm</option>
                                    <option value="Limited Liability Partnership"  @if('Limited Liability Partnership' == $registeredRecord->organisation_type) selected @endif>Limited Liability Partnership</option>
                                    <option value="Co-operative Society"  @if('Co-operative Society' == $registeredRecord->organisation_type) selected @endif>Co-operative Society</option>
                                    <option value="Private Limited"  @if('Private Limited' == $registeredRecord->organisation_type) selected @endif>Private Limited</option>
                                    <option value="Public Limited"  @if('Public Limited' == $registeredRecord->organisation_type) selected @endif>Public Limited</option>
                                    <option value="Self Help Group"  @if('Self Help Group' == $registeredRecord->organisation_type) selected @endif>Self Help Group</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-m-6 col-6">8. PAN <sup>*</sup></label>
                            <div class="col-m-6 col-6">
                                <input type="text" class="form-control" name="pan_no" value="{{$registeredRecord->pan_no}}" placeholder="PAN" required readonly="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-m-6 col-6" for="Building_no">9. Location of Plant (Address) <sup>*</sup></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-m-6 col-6">
                                <input type="text" class="form-control" name="building_no" value="{{$registeredRecord->building_no}}" placeholder="Building No./Flat No." required readonly="true">
                            </div>
                            <div class="col-m-6 col-6">
                                <input type="text" class="form-control" name="floor_no" value="{{$registeredRecord->floor_no}}" placeholder="Floor no." required readonly="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-m-6 col-6">
                                <input type="text" class="form-control" name="building_name" value="{{$registeredRecord->building_name}}" placeholder="Name of Building/Premise" required readonly="true">
                            </div>
                            <div class="col-m-6 col-6">
                                <input type="text" class="form-control" name="street" value="{{$registeredRecord->street}}" placeholder="Street/Road" required readonly="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-m-6 col-6">
                                    <input type="text" class="form-control" name="city" value="{{$registeredRecord->city}}" placeholder="City/Town/Village/Locality" required readonly="true">
                            </div>
                            <div class="col-m-6 col-6">
                                <input type="text" class="form-control" name="state" placeholder="State" value="{{$registeredRecord->state}}" required readonly="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-m-6 col-6">
                                <input type="text" class="form-control" name="district" value="{{$registeredRecord->district}}" placeholder="District" required readonly="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-m-6 col-6" for="Building_no">10. Office Address (Same as 1st Plant Address) <sup>*</sup></label>
                            <div class="radio col-m-3 col-3">
                                <label><input type="radio" name="is_same_address" @if('No' == $registeredRecord->is_same_address) checked="true" @endif value="No" required onclick="showhideAddress(this);" disabled>No</label>
                            </div>
                            <div class="radio col-m-3 col-3">
                                <label><input type="radio" name="is_same_address" @if('Yes' == $registeredRecord->is_same_address) checked="true" @endif value="Yes" required onclick="showhideAddress(this);" disabled>Yes</label>
                            </div>
                        </div>
                    </div>
                    @if('Yes' == $registeredRecord->is_same_address)
                        <div id="office_addr" class="hide">
                    @else
                        <div id="office_addr" class="">
                    @endif
                        <div class="row">
                            <div class="form-group">
                                <div class="col-m-6 col-6">
                                    <input type="text" class="form-control" name="office_building_no" value="{{$registeredRecord->office_building_no}}" placeholder="Building No./Flat No." readonly="true">
                                </div>
                                <div class="col-m-6 col-6">
                                    <input type="text" class="form-control" name="office_floor_no" value="{{$registeredRecord->office_floor_no}}" placeholder="Floor no." readonly="true">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-m-6 col-6">
                                    <input type="text" class="form-control" name="office_building_name" value="{{$registeredRecord->office_building_name}}" placeholder="Name of Building/Premise" readonly="true">
                                </div>
                                <div class="col-m-6 col-6">
                                    <input type="text" class="form-control" name="office_street" value="{{$registeredRecord->office_street}}" placeholder="Street/Road" readonly="true">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-m-6 col-6">
                                        <input type="text" class="form-control" name="office_city" value="{{$registeredRecord->office_city}}" placeholder="City/Town/Village/Locality" readonly="true">
                                </div>
                                <div class="col-m-6 col-6">
                                    <select class="form-control" name="office_state" disabled>
                                        <option value="">Select State</option>
                                        <option value="Maharashtra" @if('Maharashtra' == $registeredRecord->office_state) selected @endif>Maharashtra</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-m-6 col-6">
                                    <input type="text" class="form-control" name="office_district" value="{{$registeredRecord->office_district}}" placeholder="District" readonly="true">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-m-6 col-6" for="mob_no">11. Mobile Number <sup>*</sup></label>
                            <div class="col-m-6 col-6">
                                <input type="text" class="form-control" name="mob_no" value="{{$registeredRecord->mob_no}}" placeholder="Mobile Number" required readonly="true">
                            </div>
                          </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-m-6 col-6" for="emailid">12. Email ID <sup>*</sup></label>
                            <div class="col-m-6 col-6">
                                <input type="email" class="form-control" name="email" value="{{$registeredRecord->email}}" placeholder="Email ID" required readonly="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-m-6 col-6" for="Commencement">13. Date of Commencement of Business <sup>*</sup></label>
                            <div class="col-m-6 col-6">
                                <input type='text' class="form-control" name="business_start_date" id='datepicker1' value="{{$registeredRecord->business_start_date}}" placeholder="DD-MM-YYYY"  readonly="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-m-6 col-6" for="account_no">14. Account Number <sup>*</sup></label>
                            <div class="col-m-6 col-6">
                                <input type="text" class="form-control" name="account_no" value="{{$registeredRecord->account_no}}" placeholder="Account Number" required readonly="true">
                            </div>
                          </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-m-6 col-6" for="IFSC">15. IFSC Code <sup>*</sup></label>
                            <div class="col-m-6 col-6">
                                <input type="text" class="form-control" name="ifsc" value="{{$registeredRecord->ifsc}}" placeholder="IFSC Code" required readonly="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-m-6 col-6">16. Main Business Activity of Enterprise <sup>*</sup></label>
                            <div class="col-m-6 col-6">
                                <select class="form-control" name="business_activity" required disabled onClick="selectActivity(this.value);" >
                                    <option value="">Select Activity of Enterprise</option>
                                    <option value="Manufacturer" @if('Manufacturer' == $registeredRecord->business_activity) selected @endif>Manufacturer</option>
                                    <option value="Service Provider" @if('Service Provider' == $registeredRecord->business_activity) selected @endif>Service Provider</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-m-6 col-6">17. NIC 2 Digit Code- Choose Primary Business Activity<sup>*</sup></label>
                            <div class="col-m-6 col-6">
                                <select class="form-control" name="nic2_digit_code" id="nic2_digit_code" required disabled>
                                    <option value="">Select NIC 2 Activity</option>
                                    @foreach($activities as $index => $activity)
                                        @if($registeredRecord->nic2_digit_code == $activity)
                                            <option value="{{$activity}}" selected>{{$activity}}</option>
                                        @else
                                            <option value="{{$activity}}">{{$activity}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-m-6 col-6">18. Brief Description About Activity</label>
                            <div class="col-m-6 col-6">
                                <textarea type="text" class="form-control" name="actvity_description" readonly>{{$registeredRecord->actvity_description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-m-6 col-6">19. Number of Employees<sup>*</sup></label>
                            <div class="col-m-6 col-6">
                                <input type="text" class="form-control" name="employees" value="{{$registeredRecord->employees}}" placeholder="Number of Employees" required readonly="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-m-6 col-6">20. Investment in Plant and Machinery (Amount in Lacs) <sup>*</sup></label>
                            <div class="col-m-6 col-6">
                                <input type="text" class="form-control" name="investment_amount" value="{{$registeredRecord->investment_amount}}" placeholder="Investment in Plant and Machinery" required readonly="true">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="readonlyDocs">
                        <div class="form-group">
                            <label class="control-label col-m-6 col-6">21. Attachment of Adhaar Card</label>
                            <div class="col-m-6 col-3">
                                @if(!empty($registeredRecord->adhar_card))
                                <a href="{{asset($registeredRecord->adhar_card)}}" download="" class="btn btn-dn download" id="myBtn"><span class="fa fa-download download"></span></a><br>
                                <b>Existing Image: {!! basename($registeredRecord->adhar_card) !!}</b>
                                @else
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No Doc
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row hide" id="modifyDocs">
                        <div class="form-group">
                            <label class="control-label col-m-6 col-6">21. Attachment of Adhaar Card</label>
                            <div class="col-m-6 col-6">
                                <input class="form-control" type="file" name="adhar_card">
                                @if(!empty($registeredRecord->adhar_card))
                                    <b>Existing Image: {!! basename($registeredRecord->adhar_card) !!}</b>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if(is_object($adminUser))
                    <input type="hidden" name="order_id" value="{{$registeredRecord->order_id}}">
                    <input type="hidden" name="application_status" value="{{$registeredRecord->application_status}}">
                    <button class="btn btn-default btn-lg btn-primary pull-right hide" id="update">Update</button>
                </form>
                    @endif
                <button class="btn btn-default btn-lg pull-right hide" id="cancel">Cancel Modify</button>
            </div>
	    </div>
    </div>
    <script type="text/javascript">
        $('#modify').click(function(){
            $.each($('input') , function(idx, obj) {
                if('radio' == $(obj).attr('type')){
                    $(obj).attr('disabled', false);
                } else if('text' == $(obj).attr('type') || 'phone' == $(obj).attr('type') || 'email' == $(obj).attr('type')){
                    $(obj).attr('readonly', false);
                }
            });
            $.each($('Select') , function(idx, obj) {
                $(obj).attr('disabled', false);
            });
            $.each($('textarea') , function(idx, obj) {
                $(obj).attr('readonly', false);
            });
            $('#readonlyDocs').addClass('hide');
            $('#modifyDocs').removeClass('hide');
            $('#modify').addClass('hide');
            $('#update').removeClass('hide');
            $('#cancel').removeClass('hide');
        });
        $('#cancel').click(function(){
            window.location.reload(true);
        });
        function showhideAddress(ele){
            if('Yes' == $(ele).val()){
                $('#office_addr').addClass('hide');
            } else {
                $('#office_addr').removeClass('hide');
            }
       }
       function selectActivity(activity){
            var nicDiv = document.getElementById('nic2_digit_code');
            nicDiv.innerHTML = '';
            if('Manufacturer' == activity){
                var activities = ['01- Crop and animal production, hunting and related service activities','05-Mining and quarring','06-Extraction of crude petroleum and natural gas','07-Mining of metal ores','08-Other mining and quarring','09-Mining support service activities','10-Manufacture of food products','11-Manufacture of beverages','12-Manufacture of tobacco products','13-Manufacture of textiles','14-Manufacture of wearing apparel','15-Manufacture of leather and related products','16-Manufacture of wood and products of wood and cork, except furniture; manufacture of articles of straw and plaiting materials','17-Manufacture of paper and paper products','18-Printing and reproduction of recorded media','19-Manufacture of coke and refined petroleum products','20-Manufacture of chemicals and chemical products','21-Manufacture of pharmaceuticals, medicinal chemical and botanical products','22-Manufacture of rubber and plastics products','23-Manufacture of other non-metallic mineral products','24-Manufacture of basic metals','25-Manufacture of fabricated metal products, except machinery and equipment','26-Manufacture of computer, electronic and optical products','27-Manufacture of electrical equipment','28-Manufacture of machinery and equipment n.e.c.','29-Manufacture of motor vehicles, trailers and semi-trailers','30-Manufacture of other transport equipment','31-Manufacture of furniture','32-Other manufacturing','33-Repair and installation of machinery and equipment','35-Electricity, gas, steam and air conditioning supply','36-Water collection, treatment and supply','37-Sewerage','38-Waste collection, treatment and disposal activities; materials recovery','39-Remediation activities and other waste management services','41-Construction of building','42-Civil Engineering','43-Specialized construction activities'];
            } else {
                var activities = ['49-Land transport and transport via pipelines','50-Water transport','51-Air Transport','52-Warehousing and support activities for transportation','53-Postal and courier activities','55-Accommodation','56-Food and beverage service activities','58-Publishing activities','59-Motion picture, video and television programme production, sound recording  and music publishing activities','60-Broadcasting and programming activities','61-Telecommunications','62-Computer programming, consultancy and related activities','63-Information service activities','64-Financial service activities, except insurance and pension funding','65-Insurance, reinsurance and pension funding, except compulsory social security','66-Other financial activities','68-Real estate activities','69-Legal and accounting activities','70-Activities of head offices; management consultancy activities','71-Architecture and engineering activities; technical testing and analysis','72-Scientific research and development','73-Advertising and market research','74-Other professional, scientific and technical activities','75-Veterinary activities','77-Rental and leasing ctivities','78-Employment activities','79-Travel agency, tour operator and other reservation service activities','80-Security and investigation activities','81-Services to buildings and landscape activities','82-Office administrative, office support and other business support activities','84-Public administration and defence; compulsory social security','85-Education','86-Human health activities','87-Residential care activities','88-Social work activities without accommodation','90-Creative, arts and entertainment activities','91-Libraries, archives, museums and other cultural activities','92-Gambling and betting activities','93-Sports activities and amusement and recreation activities','94-Activities of membership organizations','95-Repair of computers and personal and household goods','96-Other personal service activities'];
            }
            selectSub = document.getElementById('nic2_digit_code');
              selectSub.innerHTML = '';
              var opt = document.createElement('option');
              opt.value = '';
              opt.innerHTML = 'NIC 2 Activity';
              selectSub.appendChild(opt);
            $.each(activities,function(idx, activity){
                var opt = document.createElement('option');
                opt.value = activity;
                opt.innerHTML = activity;
                selectSub.appendChild(opt);
            });
       }
    </script>
@stop