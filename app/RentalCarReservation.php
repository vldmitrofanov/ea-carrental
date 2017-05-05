<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class RentalCarReservation extends Model implements \MaddHatter\LaravelFullcalendar\Event
{
    protected $table = 'rental_car_reservations';

    protected $dates = [
        'created_at',
        'updated_at',
        'date_from',
        'date_to',
        'pickup_date',
        'return_date'
    ];

    /**
     * Optional FullCalendar.io settings for this event
     *
     * @return array
     */
    public function getEventOptions()
    {
        return [
            'color' => $this->background_color,
			//etc
        ];
    }	
    
    public function getId() {
        return $this->id;
    }

    /**
     * Get the event's title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->reservation_number;
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay()
    {
        return true;
    }

    /**
     * Get the start time
     *
     * @return DateTime
     */
    public function getStart()
    {
        return $this->created_at;
    }

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd()
    {
        return $this->updated_at;
    }
    
    
    public function getDateFromAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y h:i A');
    }

    public function getDateToAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y h:i A');
    }

    public function getPickUpDateAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y h:i A');
    }

    public function getReturnDateAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y h:i A');
    }

    public function user(){
        return $this->hasOne('\App\User', 'user_id', 'id');
    }
}
