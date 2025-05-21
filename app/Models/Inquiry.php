<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model {
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'first_name',
        'middle_name',
        'surname',
        'date_of_birth',
        'gender',
        'admission_type',
        'batch',
        'father_name',
        'father_phone',
        'father_occupation',
        'mother_name',
        'mother_phone',
        'mother_occupation',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'pin_code',
        'referral_source',
    ];

    /**
    * The attributes that should be cast.
    *
    * @var array
    */
    protected $casts = [
        'date_of_birth' => 'date',
        'batch' => 'array',
        'referral_source' => 'array',
    ];

    public function followUps() {
        return $this->hasMany( InquiryFollowUp::class );
    }
}
