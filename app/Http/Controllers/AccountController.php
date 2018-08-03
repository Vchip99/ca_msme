<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Libraries\InputSanitise;
use App\Models\MsmeRegistration;
use App\Models\Payment;
use Auth,Hash,Session,Redirect,Validator,DB;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function home(){
        $total = 0;
        $allRegistrations = MsmeRegistration::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
    	return view('dashboard.home',compact('allRegistrations', 'total'));
    }

    protected static function enquiry($orderId){
        $registeredRecord = MsmeRegistration::where('order_id', json_decode($orderId))->where('user_id', Auth::user()->id)->first();
        if(!is_object($registeredRecord)){
            return back()->withErrors('something went wrong.');
        }
        if('Manufacturer' == $registeredRecord->business_activity){
            $activities = ['01- Crop and animal production, hunting and related service activities','05-Mining and quarring','06-Extraction of crude petroleum and natural gas','07-Mining of metal ores','08-Other mining and quarring','09-Mining support service activities','10-Manufacture of food products','11-Manufacture of beverages','12-Manufacture of tobacco products','13-Manufacture of textiles','14-Manufacture of wearing apparel','15-Manufacture of leather and related products','16-Manufacture of wood and products of wood and cork, except furniture; manufacture of articles of straw and plaiting materials','17-Manufacture of paper and paper products','18-Printing and reproduction of recorded media','19-Manufacture of coke and refined petroleum products','20-Manufacture of chemicals and chemical products','21-Manufacture of pharmaceuticals, medicinal chemical and botanical products','22-Manufacture of rubber and plastics products','23-Manufacture of other non-metallic mineral products','24-Manufacture of basic metals','25-Manufacture of fabricated metal products, except machinery and equipment','26-Manufacture of computer, electronic and optical products','27-Manufacture of electrical equipment','28-Manufacture of machinery and equipment n.e.c.','29-Manufacture of motor vehicles, trailers and semi-trailers','30-Manufacture of other transport equipment','31-Manufacture of furniture','32-Other manufacturing','33-Repair and installation of machinery and equipment','35-Electricity, gas, steam and air conditioning supply','36-Water collection, treatment and supply','37-Sewerage','38-Waste collection, treatment and disposal activities; materials recovery','39-Remediation activities and other waste management services','41-Construction of building','42-Civil Engineering','43-Specialized construction activities'];
        } else {
            $activities = ['49-Land transport and transport via pipelines','50-Water transport','51-Air Transport','52-Warehousing and support activities for transportation','53-Postal and courier activities','55-Accommodation','56-Food and beverage service activities','58-Publishing activities','59-Motion picture, video and television programme production, sound recording  and music publishing activities','60-Broadcasting and programming activities','61-Telecommunications','62-Computer programming, consultancy and related activities','63-Information service activities','64-Financial service activities, except insurance and pension funding','65-Insurance, reinsurance and pension funding, except compulsory social security','66-Other financial activities','68-Real estate activities','69-Legal and accounting activities','70-Activities of head offices; management consultancy activities','71-Architecture and engineering activities; technical testing and analysis','72-Scientific research and development','73-Advertising and market research','74-Other professional, scientific and technical activities','75-Veterinary activities','77-Rental and leasing ctivities','78-Employment activities','79-Travel agency, tour operator and other reservation service activities','80-Security and investigation activities','81-Services to buildings and landscape activities','82-Office administrative, office support and other business support activities','84-Public administration and defence; compulsory social security','85-Education','86-Human health activities','87-Residential care activities','88-Social work activities without accommodation','90-Creative, arts and entertainment activities','91-Libraries, archives, museums and other cultural activities','92-Gambling and betting activities','93-Sports activities and amusement and recreation activities','94-Activities of membership organizations','95-Repair of computers and personal and household goods','96-Other personal service activities'];
        }
        return view('admin.enquiry.msme_enquiry', compact('registeredRecord','activities'));
    }
}