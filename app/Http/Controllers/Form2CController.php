<?php

namespace App\Http\Controllers;

use App\Models\Form2C;
use Illuminate\Http\Request;

class Form2CController extends Controller
{
    public function index(Request $request)
    {
    $form2c = Form2C::all();

    if ($request->wantsJson()) {
        return response()->json([
            'status' => 'success',
            'count' => $form2c->count(),
            'data' => $form2c
        ]);
    }

    return view('student.download-forms', compact('form2a'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            //to be filled up by pi
            'protocol_title' => 'required|string|max:255',
            'pi_name' => 'required|string|max:255',
            'coiname' => 'nullable|string|max:255',
            'pi_contact' => 'required|regex:/^09\d{9}$/',
            'pi_email' => 'required|email',
            'institution' => 'required|string|max:255',
            'institute_address' => 'required|string|max:255',
            'erb_contact' => 'required|string|max:255',

            //Part II Introduction

            //Part III Research Study
            'research_purpose' => 'nullable|string',
            'research_procedures' => 'nullable|string', // Max named from this line ---
            'participant_selection' => 'nullable|string',
            'participation_study' => 'nullable|string',
            'duration' => 'nullable|string',
            'potential_risks' => 'nullable|string',
            'potential_benefits' => 'nullable|string',
            'management_study_injuries' => 'nullable|string',
            'compensation' => 'nullable|string',
            'confidentiality' => 'nullable|string',
            'voluntary_participation' => 'nullable|string',// --- upto here
            'title_name' => 'required|string',
            'institution' => 'required|string',
            'pi_contact' => 'required|regex:/^09\d{9}$/', // already exists
            'pi_email' => 'required|email', // already exists
            'approval_mcuerb' => 'nullable|string', // Max named 
            'contact_mcuerb' => 'nullable|string',  // Max named

            //Part IV Certificate of Consent


        ]);
        
        // pi validation
        $form2c = new Form2C();
        $form2c->form2AID = $this->generateCustomID();
        $form2c->protocol_title = $validate['protocol_title'];
        $form2c->pi_name = $validate['pi_name'];
        $form2c->coiname = $validate['coiname'];
        $form2c->pi_contact = $validate['pi_contact'];
        $form2c->pi_email = $validate['pi_email'];
        $form2c->institution = $validate['institution'];
        $form2c->institute_address = $validate['institute_address'];
        $form2c->erb_contact = $validate['erb_contact'];

        //Part III Reasearch Study
        $form2c->research_purpose = $validate['research_purpose'];
        $form2c->research_procedures = $validate['research_procedures'];
        $form2c->participant_selection = $validate['participant_selection'];
        $form2c->participation_study = $validate['participation_study'];
        $form2c->duration = $validate['duration'];
        $form2c->potential_risks = $validate['potential_risks'];
        $form2c->potential_benefits = $validate['potential_benefits'];
        $form2c->management_study_injuries = $validate['management_study_injuries'];
        $form2c->compensation = $validate['compensation'];
        $form2c->confidentiality = $validate['confidentiality'];
        $form2c->voluntary_participation = $validate['voluntary_participation'];
        $form2c->title_name = $validate['title_name'];
        $form2c->institution = $validate['institution'];
        $form2c->pi_contact = $validate['pi_contact'];
        $form2c->pi_email = $validate['pi_email'];
        $form2c->approval_mcuerb = $validate['approval_mcuerb'];
        $form2c->contact_mcuerb = $validate['contact_mcuerb'];

        //Part IV Certificate of Consent
        $form2c->information_sheet = $request->has('information_sheet');
        $form2c->study_discuss = $request->has('study_discuss');
        $form2c->satisfactory_answers = $request->has('satisfactory_answers'); 
        $form2c->study_information = $request->has('study_information');   
        $form2c->study_nature = $request->has('study_nature');       //"No" in front-end still named as "study_sheet"
        $form2c->withdraw = $request->has('withdraw');
        $form2c->medical = $request->has('medical');
        $form2c->interview = $request->has('interview');
        $form2c->decision = $request->has('decision');
        $form2c->voluntary = $request->has('voluntary');
    }

    private function generateCustomID(): string
    {
    $prefix = 'f2c';

    $latest = Form2C::where('form2CID', 'like', $prefix . '%')
        ->orderByDesc('form2CID')
        ->first();

    if (!$latest) {
        return $prefix . '000001';
    }

    // Remove "f2c" prefix (length = 3)
    $number = (int) substr($latest->form2CID, strlen($prefix));
    $next = $number + 1;

    return $prefix . str_pad($next, 6, '0', STR_PAD_LEFT);
    }
}
