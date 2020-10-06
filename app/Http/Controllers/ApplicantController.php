<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Degree;
use App\Models\University;
use App\Models\Board;
use App\Models\Applicant;
use App\Models\Examination;
use App\Models\Training;
use Image;
use Intervention\Image\Exception\NotReadableException;


class ApplicantController extends Controller
{
    /**
     * Show applicant form
     */
    public function index()
    {
        $divisions = Division::get();
        $degrees = Degree::get();
        $universities = University::get();
        $boards = Board::get();
        return view('applicantForm', compact('divisions','degrees','universities', 'boards'));
    }

    /**
     * Save applicant form data by Ajax call
     * this method also perform backend validation of form data
     * and upload file selected by user
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'name'  => 'required',
            'email' => 'bail|required|email|unique:applicants|min:10',  
            'division_id' => 'required|numeric|not_in:0', //'regex:/(^[A-Za-z0-9 ]+$)+/'
            'district_id' => 'required|numeric|not_in:0',
            'upazila_id' => 'required|numeric|not_in:0',
            'address' => 'required|min:5',
            'language' => 'required',
            'cv' => 'file|mimes:doc,pdf,docx,zip|max:10048',
            'photo' => 'image|mimes:jpg,jpeg,bmp,png,gif,svg|max:2048'
        ]);


        if ($files = $request->file('photo')) {
            $imageName = time().'.'.$request->photo->extension();     
            $request->photo->move(public_path('images'), $imageName);
            $input['photo'] = $imageName;
        }
        $input['language'] = $request->input('language');


        $applicant = Applicant::create($input);

        /**
         * this block save applicant educational qualification
         * also check at least one educational qualification data row inputed     
         */
        if($request->degree[0] != 0){           
            for($count = 0; $count < count($request->degree); $count++){
                $examination = new Examination;
                $examination->applicant_id = $applicant->id;
                $examination->degree_id = $request->degree[$count];
                $examination->university_id = $request->university[$count];
                $examination->board_id = $request->board[$count];
                $examination->result = $request->result[$count];
                $examination->save();
            }
        }

        /**
         * this block save applicant training information
         * also check at least one training data row inputed     
         */
        if($request->optselector == 1){
            for($count2 = 0; $count2 < count($request->training); $count2++){
                $training = new Training;
                $training->applicant_id = $applicant->id;
                $training->training = $request->training[$count2];
                $training->details = $request->details[$count2];
                $training->save();
            }
        }        

        $arr = array('msg' => 'Successfully Form Submit', 'status' => true);
        
        return response()->json($arr);

    }

    /**
     * method use for district dropdown data propagate from database
     * on ajax call as chain reaction of applicant form division 
     * drop-down data select
     */
    public function getDistrict($division_id)
    {
        $data = District::where('division_id',$division_id)->get();
        \Log::info($data);
        return response()->json(['data' => $data]);
    }

    /**
     * method use for upazila dropdown data propagate from database
     * on ajax call as chain reaction of applicant form district 
     * drop-down data select
     */
    public function getUpazila($district_id)
    {
        $data = Upazila::where('district_id',$district_id)->get();
        \Log::info($data);
        return response()->json(['data' => $data]);
    }


}
