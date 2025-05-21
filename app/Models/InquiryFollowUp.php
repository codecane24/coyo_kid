<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InquiryFollowUp extends Model {

    protected $fillable = [
        'inquiry_id',
        'follow_up_date',
        'notes',
        'status',
    ];

    public function inquiry() {
        return $this->belongsTo( Inquiry::class );
    }

}
