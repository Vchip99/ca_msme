@extends('layouts.master')
@section('header-title')
    <title>Online Msme Registration</title>
@stop
@section('header-css')
    <title>MSME</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/docstyle.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/formstyle.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/footer.css')}}">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<style type="text/css">
  .instr{
  font-family: sans-serif;
  font-size: 15px !important;
  padding: 10px 5px;
  color: #2f4f4f;
  }
  .div-style{
    padding: 50px;
  }
  .instr span{
    font-size: 17px;
    color: #2f4f4f;
    font-weight: bold;
  }
    #submitBtn{
        width: 325px;
    }
    @media only screen and (max-width: 339px) {
        #submitBtn{
            margin-left: -27% !important;
        }
    }
</style>
@stop
@section('content')
  @include('header.header')
	<div  class=" row"  style="">
	    <h3 style="text-align: center; padding: 0 15px;">MSME ONLINE SELF REGISTRATION FORM</h3>
	    @if(Session::has('message'))
	      <div class="alert alert-success" id="message">
	        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	          {{ Session::get('message') }}
	      </div>
	    @endif
	    @if(count($errors) > 0)
          	<div class="alert alert-danger">
              	<ul>
                  	@foreach ($errors->all() as $error)
                    	<li>{{ $error }}</li>
                  	@endforeach
              	</ul>
          	</div>
        @endif
	    <div class="col-9  div-style">
			<!-- <h5><b>Registration Fee: Rs. {{$msmePrice}}</b></h5> -->
            <form  class="form-horizontal" role="form" method="POST" action="{{ url('registration') }}"  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-m-6 col-6" for="applicant">1. Adhaar Card Number <sup>*</sup></label>
                        <div class="col-m-6 col-6" >
                            <input type="number" class="form-control" name="adhaar_number" placeholder="Adhaar Card number" value="{{(old('adhaar_number'))?:NULL}}" maxlength="12"  pattern="[0-9]{12}"  required>
                        </div>
                   </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-m-6 col-6">2. Name as per Adhaar Card <sup>*</sup></label>
                        <div class="col-m-6 col-6">
                            <input type="text" class="form-control" name="adhaar_name" placeholder="Name of applicant" value="{{(old('adhaar_name'))?:NULL}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-m-6 col-6" for="pan_no">3. Applicant's Category <sup>*</sup></label>
                        <div class="col-m-6 col-6">
                            <select class="form-control" name="application_category" required>
                                <option value="">Select Category</option>
                                <option value="General">General</option>
                                <option value="OBC">OBC</option>
                                <option value="SC">SC</option>
                                <option value="ST">ST</option>>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-m-6 col-6">4. Gender <sup>*</sup></label>
                        <div class="radio col-m-3 col-3">
                            <label><input type="radio" name="gender" value="Male" checked="true" required>Male</label>
                        </div>
                        <div class="radio col-m-3 col-3">
                            <label><input type="radio" name="gender" value="Female" required>Female</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-m-6 col-6">5. Physically Handicapped <sup>*</sup></label>
                        <div class="radio col-m-3 col-3">
                            <label><input type="radio" name="disability" value="Yes" required>Yes</label>
                        </div>
                        <div class="radio col-m-3 col-3">
                            <label><input type="radio" name="disability" value="No" checked="false" required>No</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-m-6 col-6">6. Name of Enterprise/ Business <sup>*</sup></label>
                        <div class="col-m-6 col-6">
                            <input type="text" class="form-control" name="enterprise_name" placeholder="Name of Enterprise/ Business" value="{{(old('enterprise_name'))?:NULL}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-m-6 col-6">7. Type of Organisation<sup>*</sup></label>
                        <div class="col-m-6 col-6">
                            <select class="form-control" name="organisation_type" required>
                                <option value="">Select Type of Organisation</option>
                                <option value="Proprietorship Firm">Proprietorship Firm</option>
                                <option value="Hindu Undivided Family">Hindu Undivided Family</option>
                                <option value="Partnership firm">Partnership firm</option>
                                <option value="Limited Liability Partnership">Limited Liability Partnership</option>
                                <option value="Co-operative Society">Co-operative Society</option>
                                <option value="Private Limited">Private Limited</option>
                                <option value="Public Limited">Public Limited</option>
                                <option value="Self Help Group">Self Help Group</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-m-6 col-6">8. PAN <sup>*</sup></label>
                        <div class="col-m-6 col-6">
                            <input type="text" class="form-control" name="pan_no" maxlength="10" pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}" placeholder="Please enter valid PAN number. E.g. AAAAA9999A" value="{{(old('pan_no'))?:NULL}}" required>
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
                            <input type="text" class="form-control" name="building_no" placeholder="Building No./Flat No." value="{{(old('building_no'))?:NULL}}" required>
                        </div>
                        <div class="col-m-6 col-6">
                            <input type="text" class="form-control" name="floor_no" placeholder="Floor no." value="{{(old('floor_no'))?:NULL}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-m-6 col-6">
                            <input type="text" class="form-control" name="building_name" placeholder="Name of Building/Premise" value="{{(old('building_name'))?:NULL}}" required>
                        </div>
                        <div class="col-m-6 col-6">
                            <input type="text" class="form-control" name="street" placeholder="Street/Road" value="{{(old('street'))?:NULL}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-m-6 col-6">
                                <input type="text" class="form-control" name="city" placeholder="City/Town/Village/Locality" value="{{(old('city'))?:NULL}}" required>
                        </div>
                        <div class="col-m-6 col-6">
                            <input type="number" class="form-control" name="pin" placeholder="Pin Code" value="{{(old('pin'))?:NULL}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-m-6 col-6">
                            <input type="text" class="form-control" name="district" placeholder="District" value="{{(old('district'))?:NULL}}" required>
                        </div>
                        <div class="col-m-6 col-6">
                            <select class="form-control" name="state" required>
                                <option value="">Select State</option>
                                <option value="ANDAMAN AND NICOBAR ISLANDS">ANDAMAN AND NICOBAR ISLANDS</option>
                                <option value="ANDHRA PRADESH">ANDHRA PRADESH</option>
                                <option value="ARUNACHAL PRADESH">ARUNACHAL PRADESH</option>
                                <option value="ASSAM">ASSAM</option>
                                <option value="BIHAR">BIHAR</option>
                                <option value="CHANDIGARH">CHANDIGARH</option>
                                <option value="CHHATISGARH">CHHATISGARH</option>
                                <option value="DADRA AND NAGAR HAVELI">DADRA AND NAGAR HAVELI</option>
                                <option value="DAMAN AND DIU">DAMAN AND DIU</option>
                                <option value="DELHI">DELHI</option>
                                <option value="GOA">GOA</option>
                                <option value="GUJARAT">GUJARAT</option>
                                <option value="HARYANA">HARYANA</option>
                                <option value="HIMACHAL PRADESH">HIMACHAL PRADESH</option>
                                <option value="JAMMU AND KASHMIR">JAMMU AND KASHMIR</option>
                                <option value="JHARKHAND">JHARKHAND</option>
                                <option value="KARNATAKA">KARNATAKA</option>
                                <option value="KERALA">KERALA</option>
                                <option value="LAKSHADWEEP">LAKSHADWEEP</option>
                                <option value="MADHYA PRADESH">MADHYA PRADESH</option>
                                <option value="MAHARASHTRA">MAHARASHTRA</option>
                                <option value="MANIPUR">MANIPUR</option>
                                <option value="MEGHALAYA">MEGHALAYA</option>
                                <option value="MIZORAM">MIZORAM</option>
                                <option value="NAGALAND">NAGALAND</option>
                                <option value="ODISHA">ODISHA</option>
                                <option value="PONDICHERRY">PONDICHERRY</option>
                                <option value="PUNJAB">PUNJAB</option>
                                <option value="RAJASTHAN">RAJASTHAN</option>
                                <option value="SIKKIM">SIKKIM</option>
                                <option value="TAMIL NADU">TAMIL NADU</option>
                                <option value="TELANGANA">TELANGANA</option>
                                <option value="TRIPURA">TRIPURA</option>
                                <option value="UTTAR PRADESH">UTTAR PRADESH</option>
                                <option value="UTTARAKHAND">UTTARAKHAND</option>
                                <option value="WEST BENGAL">WEST BENGAL</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-m-6 col-6" for="Building_no">10. Office Address (Same as 1st Plant Address) <sup>*</sup></label>
                        <div class="radio col-m-3 col-3">
                            <label><input type="radio" name="is_same_address" checked="true" value="No" required onclick="showhideAddress(this);">No</label>
                        </div>
                        <div class="radio col-m-3 col-3">
                            <label><input type="radio" name="is_same_address" value="Yes" required onclick="showhideAddress(this);">Yes</label>
                        </div>
                    </div>
                </div>
                <div id="office_addr" class="">
               		<div class="row">
                        <div class="form-group">
                            <div class="col-m-6 col-6">
                                <input type="text" class="form-control" name="office_building_no" placeholder="Building No./Flat No." value="{{(old('office_building_no'))?:NULL}}">
                            </div>
                            <div class="col-m-6 col-6">
                                <input type="text" class="form-control" name="office_floor_no" placeholder="Floor no." value="{{(old('office_floor_no'))?:NULL}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-m-6 col-6">
                                <input type="text" class="form-control" name="office_building_name" placeholder="Name of Building/Premise" value="{{(old('office_building_name'))?:NULL}}">
                            </div>
                            <div class="col-m-6 col-6">
                                <input type="text" class="form-control" name="office_street" placeholder="Street/Road" value="{{(old('office_street'))?:NULL}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-m-6 col-6">
                                    <input type="text" class="form-control" name="office_city" placeholder="City/Town/Village/Locality" value="{{(old('office_city'))?:NULL}}">
                            </div>
                            <div class="col-m-6 col-6">
                                <input type="number" class="form-control" name="office_pin"  placeholder="Pin Code" value="{{(old('pin'))?:NULL}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-m-6 col-6">
                                <input type="text" class="form-control" name="office_district" placeholder="District" value="{{(old('office_district'))?:NULL}}">
                            </div>
                            <div class="col-m-6 col-6">
                                <select class="form-control" name="office_state">
                                    <option value="">Select State</option>
                                    <option value="ANDAMAN AND NICOBAR ISLANDS">ANDAMAN AND NICOBAR ISLANDS</option>
                                    <option value="ANDHRA PRADESH">ANDHRA PRADESH</option>
                                    <option value="ARUNACHAL PRADESH">ARUNACHAL PRADESH</option>
                                    <option value="ASSAM">ASSAM</option>
                                    <option value="BIHAR">BIHAR</option>
                                    <option value="CHANDIGARH">CHANDIGARH</option>
                                    <option value="CHHATISGARH">CHHATISGARH</option>
                                    <option value="DADRA AND NAGAR HAVELI">DADRA AND NAGAR HAVELI</option>
                                    <option value="DAMAN AND DIU">DAMAN AND DIU</option>
                                    <option value="DELHI">DELHI</option>
                                    <option value="GOA">GOA</option>
                                    <option value="GUJARAT">GUJARAT</option>
                                    <option value="HARYANA">HARYANA</option>
                                    <option value="HIMACHAL PRADESH">HIMACHAL PRADESH</option>
                                    <option value="JAMMU AND KASHMIR">JAMMU AND KASHMIR</option>
                                    <option value="JHARKHAND">JHARKHAND</option>
                                    <option value="KARNATAKA">KARNATAKA</option>
                                    <option value="KERALA">KERALA</option>
                                    <option value="LAKSHADWEEP">LAKSHADWEEP</option>
                                    <option value="MADHYA PRADESH">MADHYA PRADESH</option>
                                    <option value="MAHARASHTRA">MAHARASHTRA</option>
                                    <option value="MANIPUR">MANIPUR</option>
                                    <option value="MEGHALAYA">MEGHALAYA</option>
                                    <option value="MIZORAM">MIZORAM</option>
                                    <option value="NAGALAND">NAGALAND</option>
                                    <option value="ODISHA">ODISHA</option>
                                    <option value="PONDICHERRY">PONDICHERRY</option>
                                    <option value="PUNJAB">PUNJAB</option>
                                    <option value="RAJASTHAN">RAJASTHAN</option>
                                    <option value="SIKKIM">SIKKIM</option>
                                    <option value="TAMIL NADU">TAMIL NADU</option>
                                    <option value="TELANGANA">TELANGANA</option>
                                    <option value="TRIPURA">TRIPURA</option>
                                    <option value="UTTAR PRADESH">UTTAR PRADESH</option>
                                    <option value="UTTARAKHAND">UTTARAKHAND</option>
                                    <option value="WEST BENGAL">WEST BENGAL</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-m-6 col-6" for="mob_no">11. Mobile Number <sup>*</sup></label>
                        <div class="col-m-6 col-6">
                            <input type="number" class="form-control" name="mob_no" maxlength="10"  pattern="[0-9]{10}" placeholder="Enter your mobile number" value="{{(old('mob_no'))?:NULL}}" required>
                        </div>
                      </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-m-6 col-6" for="emailid">12. Email ID <sup>*</sup></label>
                        <div class="col-m-6 col-6">
                            <input type="email" class="form-control" name="email" placeholder="Email ID" value="{{(old('email'))?:NULL}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-m-6 col-6" for="Commencement">13. Date of Commencement of Business <sup>*</sup></label>
                        <div class="col-m-6 col-6">
                            <input type='text' class="form-control" name="business_start_date" id='datepicker1' placeholder="DD-MM-YYYY" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-m-6 col-6" for="account_no">14. Account Number <sup>*</sup></label>
                        <div class="col-m-6 col-6">
                            <input type="number" class="form-control" name="account_no" placeholder="Account Number" value="{{(old('account_no'))?:NULL}}" required>
                        </div>
                      </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-m-6 col-6" for="IFSC">15. IFSC Code <sup>*</sup></label>
                        <div class="col-m-6 col-6">
                            <input type="text" class="form-control" name="ifsc" placeholder="IFSC Code" value="{{(old('ifsc'))?:NULL}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-m-6 col-6">16. Main Business Activity of Enterprise <sup>*</sup></label>
                        <div class="col-m-6 col-6">
                            <select class="form-control" name="business_activity" onChange="selectActivity(this.value);" required>
                                <option value="">Select Activity of Enterprise</option>
                                <option value="Manufacturer" >Manufacturer</option>
                                <option value="Service Provider" >Service Provider</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-m-6 col-6">17. NIC 2 Digit Code- Choose Primary Business Activity<sup>*</sup></label>
                        <div class="col-m-6 col-6" >
                            <select class="form-control" name="nic2_digit_code" id="nic2_digit_code">
                                <option value="">Select NIC 2 Activity</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-m-6 col-6">18. Brief Description About Activity</label>
                        <div class="col-m-6 col-6">
                            <textarea type="text" class="form-control" name="actvity_description">{{(old('actvity_description'))?:NULL}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-m-6 col-6">19. Number of Employees<sup>*</sup></label>
                        <div class="col-m-6 col-6">
                            <input type="number" class="form-control" name="employees" placeholder="Number of Employees" value="{{(old('employees'))?:NULL}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-m-6 col-6">20. Investment in Plant and Machinery (Amount in Lacs) <sup>*</sup></label>
                        <div class="col-m-6 col-6">
                            <input type="number" class="form-control" name="investment_amount" placeholder="Investment in Plant and Machinery" value="{{(old('investment_amount'))?:NULL}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-m-6 col-6">21. Attachment of Adhaar Card <br><i class="fa fa-whatsapp" style="font-size:20px"></i>: You Can send Documents on 8530440444 Whatsapp Number</label>
                        <div class="col-m-6 col-6">
                            <input class="form-control" type="file" name="adhar_card">

                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-m-6 col-6">&nbsp; </label>
                        <div class="col-m-6 col-6">
                            <input type="radio" checked><a href="{{url('terms-and-conditions')}}" target="_blank"> I Accept the Terms and Conditions</a>
                        </div>
                    </div>
                </div>

                <div class="text-center" style="padding:25px;">
                	<input type="hidden" name="application_status" value="1">
                    <button type="submit" class="btn btn-default btn-lg btn-primary" id="submitBtn">Validate and Pay Fee of Rs. {{$msmePrice}}<span class="fa fa-chevron-right"></span></button>
                </div>
            </form>
		</div>
		<div class="col-3">
			<div class="div-instr">Instructions</div>
      		<div class="instr"><span class="bold-title">1. Adhaar Number-</span>  Fill 12 digit Aadhaar number issued to the applicant in the appropriate field.</div>
      		<div class="instr"><span class="bold-title">2. Name of Applicant-</span> Fill name of Applicant as mentioned on the Aadhaar Card. </div>
      		<div class="instr"><span class="bold-title">3. Social Category-</span> Select the Social Category of applicant from the given options.</div>
      		<div class="instr"><span class="bold-title">4. Gender-</span> Select the gender from provided option </div>
      		<div class="instr"><span class="bold-title">5. Physically Handicapped-</span> Select the status from provided options. </div>
      		<div class="instr"><span class="bold-title">6. Name of Enterprise/ Business-</span> Fill the name of Business / Enterprise which will get printed on MSME Certificate. </div>
      		<div class="instr"><span class="bold-title">7. Type of Organisation-</span> Select the type of organization from the given options which will get printed on MSME Certificate.</div>
	      	<div class="instr"><span class="bold-title">8. PAN-</span> Fill 10 Digit PAN Number in case of Limited Liability Partnership / Co-operative Society / Private Limited / Public Limited. PAN Number is optional in case of Proprietorship Firm / Hindu Undivided Family / Partnership Firm / Self Help Group. </div>
	      	<div class="instr"><span class="bold-title">9. Location of Plant-</span> Please fill the location address properly</div>
	      	<div class="instr"><span class="bold-title">10. Office Address-</span>  Please provide office address, if address other than plant location.</div>
	      	<div class="instr"><span class="bold-title">11. Mobile No -</span> Fill the correct Mobile Number of Applicant</div>
	       	<div class="instr"><span class="bold-title">12. Mail ID-</span> Fill the correct Mail ID of Applicant</div>
	      	<div class="instr"><span class="bold-title">13. Date of Commencement of Business-</span> Fill the date of Commencement of Business which will get printed on MSME Certificate.</div>
	      	<div class="instr"><span class="bold-title">14. Bank Account Number-</span> Fill the Applicant’s bank account number.</div>
	      	<div class="instr"><span class="bold-title">15. Bank IFSC Code-</span> Fill the Applicant Bank IFSC Code. The IFSC code is printed on the Cheque Books.</div>
	      	<div class="instr"><span class="bold-title">16. Main Business Activity of Enterprise -</span> Select the Main Business activity from the given options.</div>
	      	<div class="instr"><span class="bold-title">17. NIC 2 Digit Code-</span> Select the 2 Digit NIC Code from the given options considering your business activity.</div>
	      	<div class="instr"><span class="bold-title">19. Number of employees-</span> Fill total number of people been employed.</div>
	      	<div class="instr"><span class="bold-title">20. Investment in Plant & Machinery / Equipment-</span> Fill the total investment made in Plant, Machinery, and Equipment etc. to start your business.</div>
	      	<div class="instr"><span class="bold-title">21. Attachment-</span> Attach scan copy of Aadhaar card (jpg,png file < 200KB)</div>
  		</div>
	</div>
    @include('footer.footer')
<script type="text/javascript">
   $(document).ready(function(){
        setTimeout(function() {
          $('.alert-success').fadeOut('fast');
        }, 10000); // <-- time in milliseconds
    });

   $(function () {
          $("#datepicker1").datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true
          });
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