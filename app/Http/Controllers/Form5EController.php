<?php

namespace App\Http\Controllers;

use App\Models\Form5E;
use Illuminate\Http\Request;

class Form5EController extends Controller
{
    public function index(Request $request)
    {
    $form5e = Form5E::all();

    if ($request->wantsJson()) {
        return response()->json([
            'status' => 'success',
            'count' => $form5e->count(),
            'data' => $form5e
        ]);
    }

    return view('student.download-forms', compact('form5e'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'protocol_title' => 'required|string|max:255',
            'pi_name' => 'required|string|max:255',
            'coiname' => 'nullable|string|max:255',

            'pi_contact' => 'required|regex:/^09\d{9}$/',
            'pi_email' => 'required|email',

            'institution' => 'required|string|max:255',
            'institute_address' => 'required|string|max:255',
            'erb_contact' => 'required|string|max:255',
        ]);

        $form5e = new Form5E();
        $form5e->form5EID = $this->generateCustomID();
        $form5e->protocol_title = $validate['protocol_title'];
        $form5e->pi_name = $validate['pi_name'];
        $form5e->coiname = $validate['coiname'];

        $form5e->pi_contact = $validate['pi_contact'];
        $form5e->pi_email = $validate['pi_email'];
        
        $form5e->institution = $validate['institution'];
        $form5e->institute_address = $validate['institute_address'];
        $form5e->erb_contact = $validate['erb_contact'];

        //Initial Documents
        $form5e->cover_letter = $request->has('cover_letter');
        $form5e->enrollment_proof = $request->has('enrollment_proof');
        $form5e->letter = $request->has('letter');
        $form5e->complete_form2b = $request->has('complete_form2b');
        $form5e->complete_form2a = $request->has('complete_form2a');
        $form5e->complete_form2d = $request->has('complete_form2d');

        //Protocol Package
        $form5e->study_protocol = $request->has('study_protocol');
        $form5e->form2c_eng = $request->has('form2c_eng');
        $form5e->form2c_fil = $request->has('form2c_fil');
        $form5e->data_collection = $request->has('data_collection');
        $form5e->cert_validator = $request->has('cert_validator');
        $form5e->eng_7_12_yrs = $request->has('eng_7_12_yrs');
        $form5e->fil_7_12_yrs = $request->has('fil_7_12_yrs');
        $form5e->eng_13_17_yrs = $request->has('eng_13_17_yrs');
        $form5e->fil_13_17_yrs = $request->has('fil_13_17_yrs');
        $form5e->advertisement = $request->has('advertisement');
        $form5e->vitae = $request->has('vitae');
        $form5e->gcp = $request->has('gcp');

        $form5e->save();
        return redirect()->route('download-forms');
    }


    private function generateCustomID(): string
    {
    $prefix = 'f5e';

    $latest = Form5E::where('form5EID', 'like', $prefix . '%')
        ->orderByDesc('form5EID')
        ->first();

    if (!$latest) {
        return $prefix . '000001';
    }

    // Remove "f5e" prefix (length = 3)
    $number = (int) substr($latest->form5EID, strlen($prefix));
    $next = $number + 1;

    return $prefix . str_pad($next, 6, '0', STR_PAD_LEFT);
    }
}
