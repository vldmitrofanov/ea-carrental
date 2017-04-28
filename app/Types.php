<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    protected $table = 'fleet_types';


    public function vehicleSize(){
        return $this->hasOne('\App\SIPPCode', 'id', 'sipp_code_one');
    }

    public function vehicleDoors(){
        return $this->hasOne('\App\SIPPCode', 'id', 'sipp_code_two');
    }

    public function vehicleTransmissionAndDrive(){
        return $this->hasOne('\App\SIPPCode', 'id', 'sipp_code_three');
    }

    public function vehicleFuelAndAC(){
        return $this->hasOne('\App\SIPPCode', 'id', 'sipp_code_four');
    }

    public function code(){
        $sippCode = '';
        $oVehicleSize = $this->vehicleSize();
        $oVehicleDoors = $this->vehicleDoors();
        $oVehicleTransmissionAndDrive = $this->vehicleTransmissionAndDrive();
        $oVehicleFuelAndAC = $this->vehicleFuelAndAC();
        if($oVehicleSize->first()){
            $sippCode = $oVehicleSize->first()->code_letter;
        }else{
            $sippCode = '-';
        }

        if($oVehicleDoors->first()){
            $sippCode .= $oVehicleDoors->first()->code_letter;
        }else{
            $sippCode .= '-';
        }

        if($oVehicleTransmissionAndDrive->first()){
            $sippCode .= $oVehicleTransmissionAndDrive->first()->code_letter;
        }else{
            $sippCode .= '-';
        }

        if($oVehicleFuelAndAC->first()){
            $sippCode .= $oVehicleFuelAndAC->first()->code_letter;
        }else{
            $sippCode .= '-';
        }

        return $sippCode;
    }
}
