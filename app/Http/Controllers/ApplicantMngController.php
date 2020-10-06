<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Applicant;

use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;

use DataTables;
use DB;



class ApplicantMngController extends Controller
{
    /**
     * Check the user is authenticated or not
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    /**
     * method use for applicant datatable render.
     * method consist search/filter block use for search operations 
     * on user search criteria set from search panel.
     */
    public function index(Request $request)
    {
    	
    	if(!Auth::user())
		{
		return redirect('Logout');
		}

		if(request()->ajax()) {


			if( !empty($request->name)||!empty($request->email)||!empty($request->division_id)||!empty($request->district_id)||!empty($request->upazila_id) )
			{

				$data = DB::table('applicants as a')->select(
	                'a.id',
	                'a.name',
	                'a.email',
	                'a.division_id',
	                'a.district_id',
	                'a.upazila_id',
	                'a.language',
	                'a.address',
	                'a.created_at as create_date',
	                'div.name as div_name',
	                'dis.name as dis_name',
	                'upz.name as upz_name'
	            )	            
	            ->leftjoin('divisions as div', 'a.division_id', '=', 'div.id')
	            ->leftjoin('districts as dis', 'a.district_id', '=', 'dis.id')
	            ->leftjoin('upazilas as upz', 'a.upazila_id', '=', 'upz.id');
	            
	            if($request->name){
	            	$data->where('a.name', $request->name);	
	            }
	            if($request->email){
	            	$data->where('a.email', $request->email);
	        	}
	        	if($request->division_id){
	            	$data->where('a.division_id', $request->division_id);
	        	}
	        	if($request->district_id){
	            	$data->where('a.district_id', $request->district_id);
	            }
	            if($request->upazila_id){
	            	$data->where('a.upazila_id', $request->upazila_id);	
	            }  

	            $data->get();
	            
       		}
			else
			{				

				$data = DB::table('applicants as a')->select(
	                'a.id',
	                'a.name',
	                'a.email',
	                'a.division_id',
	                'a.district_id',
	                'a.upazila_id',
	                'a.language',
	                'a.address',
	                'a.created_at as create_date',
	                'div.name as div_name',
	                'dis.name as dis_name',
	                'upz.name as upz_name'
	            )
	            ->leftjoin('divisions as div', 'a.division_id', '=', 'div.id')
	            ->leftjoin('districts as dis', 'a.district_id', '=', 'dis.id')
	            ->leftjoin('upazilas as upz', 'a.upazila_id', '=', 'upz.id')
	            ->get();

			}

			return 	Datatables()::of($data)
					->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
    
                            return $btn;
                    })
					->make(true);



		}
	    
	    $divisions = Division::get();
    
	    return view('applicantList', compact('divisions'));

    }


    /**
     * method use for district dropdown data propagate from database
     * on ajax call as chain reaction of applicant search grid division 
     * drop down data select
     */
    public function getDistrict($division_id)
    {
        $data = District::where('division_id',$division_id)->get();
        \Log::info($data);
        return response()->json(['data' => $data]);
    }

    /**
     * method use for upazila dropdown data propagate from database
     * on ajax call as chain reaction of applicant search grid district 
     * drop down data select
     */
    public function getUpazila($district_id)
    {
        $data = Upazila::where('district_id',$district_id)->get();
        \Log::info($data);
        return response()->json(['data' => $data]);
    }



    


}
