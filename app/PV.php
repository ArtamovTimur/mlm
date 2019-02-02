<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PV extends Model
{
    public static function createPVInvoice($user_id)
    {
        if(self::PVInvoiceNotExist($user_id)){
            return DB::table('p_vs')->insert([
                'user_id' => $user_id,
                'personal_pv' => 0,
                'group_pv' => 0,
                'not_activated_pv' => 0
            ]);
        }
    }
    public static function getPV($user_id)
    {
        return DB::table('p_vs')
            ->where('user_id', '=', $user_id)->get()->first();
    }
    public static function replenishPV($user_id, $pv)
    {
        try{
            self::calcPV($user_id, $pv, '+');
            if($res = DB::table('p_vs')->where
            ('user_id', '=', $user_id)
                ->increment('not_activated_pv', $pv)){
                //self::spendPVForTarif();
                return true;
            }else {
                return false;
            }
        }catch (\Exception $e){

        }
    }
    public static function spendPV($user_id, $pv)
    {
        try{
            $nact_pv = self::getPV($user_id)->not_activated_pv;
            if($nact_pv >= $pv){
                //self::calcPV($user_id, $pv, '-');
                return DB::table('p_vs')->where('user_id', '=', $user_id)
                    ->decrement('not_activated_pv', $pv);
            }else {
                return false;
            }
        }catch (\Exception $e){

        }

    }
    public static function spendTarif($user_id, $tarif_id)
    {

        try{

            $user_pv = self::getPV($user_id)->not_activated_pv;
            $tarif_pv = Tarif::get($tarif_id)[0]->pv;
            if($user_pv >= $tarif_pv){

                if(Tarif::userPay($user_id, $tarif_id)){
                    return self::spendPV($user_id, $tarif_pv);
                }
            }
        }catch (\Exception $e){

        }
    }
    public static function spendPVForTarif($user_id)
    {
        try{
            $user_pv = self::getPV($user_id)->not_activated_pv;
            $tarifs = Tarif::getAll();
            for($i = count($tarifs)-1; $i >= 0; $i--){
                if($user_pv >= $tarifs[$i]->pv){
                    if(Tarif::userPay($user_id, $tarifs[$i]->id)){
                        return self::spendPV($user_id, $tarifs[$i]->pv);
                    }
                }
            }
        }catch (\Exception $e){

        }

    }

    public static function PVInvoiceNotExist($user_id)
    {
        try{
            $c = DB::table('p_vs')->where('user_id', '=', $user_id)->get()->count();
            if($c == 0){
                return true;
            }else return false;
        }catch (\Exception $e){

        }

    }
    public static function calcPV($user_id, $pv, $op)
    {
        if($op == '+'){
            return DB::table('p_vs')
                ->where('user_id', '=', $user_id)
                ->increment('personal_pv', $pv);
        }else if($op == '-'){
            return DB::table('p_vs')
                ->where('user_id', '=', $user_id)
                ->decrement('personal_pv', $pv);
        }

    }

}
