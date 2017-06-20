<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CarReservation extends Model implements  \MaddHatter\LaravelFullcalendar\Event
{
    protected $table = 'rental_car_reservations';

    protected $dates = [
        'created_at',
        'updated_at',
        'date_from',
        'date_to',
        'pickup_date',
        'return_date',
        'processed_on',
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
    public function getUrl(){
        return 'http://gmail.com';
    }
    /**
     * Get the event's title
     *
     * @return string
     */
    public function getDescription()
    {
        return '5as3d1as3d1as23d13asd';
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

    public function details(){
        return $this->hasMany('App\CarReservationDetail', 'reservation_id', 'id');
    }

    public function payments(){
        return $this->hasMany('App\CarReservationPayment', 'reservation_id', 'id');
    }

    public function extras(){
        return $this->hasMany('App\RentalCarReservationExtra', 'reservation_id', 'id');
    }
   
    public function getProcessedOnAttribute($value)
    {
        return Carbon::parse($value)->format('F jS, Y');
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
        return $this->hasOne('\App\User', 'id', 'user_id');
    }

}
