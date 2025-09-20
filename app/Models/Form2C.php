<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form2C extends Model
{
    protected $table = 'tbl_form2c';
    protected $primaryKey = 'form2CID';
    public $incrementing = false;
    protected $keyType = 'string';
    
    public $timestamps = false;

    protected $fillable = [
        'form2CID',
        'protocol_title',
        'pi_name',
        'coiname',
        'pi_contact',
        'pi_email',
        'institution',
        'institute_address',
        'erb_contact',

        //Part II

        //Part III Research Study
        'research_purpose',
        'research_procedures',
        'participant_selection',
        'participation_study',
        'duration',
        'potential_risks',
        'potential_benefits',
        'management_study_injuries',
        'compensation',
        'confidentiality',
        'voluntary_participation',
        'title_name',
        'institution',
        'pi_contact',
        'pi_email',
        'approval_mcuerb',
        'contact_mcuerb',

        //Part IV Certificate of Consent (Checkboxes)
        'information_sheet',
        'study_discuss',
        'satisfactory_answers',
        'study_information',
        'study_nature',
        'withdraw',
        'medical',
        'interview',
        'decision',
        'voluntary',
    ];

    protected $casts = [
        //Part III Research Study
        'research_purpose',
        'research_procedures',
        'participant_selection',
        'participation_study',
        'duration',
        'potential_risks',
        'potential_benefits',
        'management_study_injuries',
        'compensation',
        'confidentiality',
        'voluntary_participation',
        'title_name',
        'institution',
        'pi_contact',
        'pi_email',
        'approval_mcuerb',
        'contact_mcuerb',

        //Part IV Certificate of Consent (Checkboxes)
        'information_sheet' => 'boolean',
        'study_discuss' => 'boolean',
        'satisfactory_answers' => 'boolean',
        'study_information' => 'boolean',
        'study_nature' => 'boolean',
        'withdraw' => 'boolean',
        'medical' => 'boolean',
        'interview' => 'boolean',
        'decision' => 'boolean',
        'voluntary' => 'boolean',
    ];
}
