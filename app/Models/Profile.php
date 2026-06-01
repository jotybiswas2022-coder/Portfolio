<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Carbon\Carbon;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'blood',
        'division',
        'number',
        'last_donated',
    ];

    protected $casts = [
        'last_donated' => 'date',
    ];

    // Relation: Profile belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // -------------------------
    // 90-Day Blood Donation Logic
    // -------------------------

    /**
     * Get the next eligible donation date (last donated + 90 days)
     *
     * @return \Carbon\Carbon|null
     */
    public function nextDonationDate()
    {
        if ($this->last_donated) {
            return Carbon::parse($this->last_donated)->addDays(90);
        }
        return null;
    }

    /**
     * Get number of days until next eligible donation
     *
     * @return int
     */
    public function daysUntilNextDonation()
    {
        $next = $this->nextDonationDate();

        if ($next) {
            $diff = Carbon::now()->diffInDays($next, false);
            return $diff > 0 ? $diff : 0; 
        }

        return 0; 
    }

    /**
     * Check if donor is currently eligible to donate
     *
     * @return bool
     */
    public function canDonateNow()
    {
        return $this->daysUntilNextDonation() === 0;
    }
}