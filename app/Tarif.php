<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tarif extends Model
{
  public static function userPay($user_id, $tarif_id)
  {
      DB::table('users')->where('id', '=', $user_id)->update([
          'tarif_id' => $tarif_id
      ]); // или твой elequent
      return self::countPV(1, $tarif_id); // начисляем бабки за покупку тарифа здесь укажи id счета

  }

  public static function getAll()
  {
      return DB::table('tarifs')->get();
  }
  public static function get($id)
  {
      return DB::table('tarifs')->where('id', '=', $id)->get();
  }
  public static function countPV($invoice_id, $tarif_id)
  {
      $pv_count = DB::table('tarifs')->where('id', '=', $tarif_id)
      ->get()[0]->pv;
      return Invoice::replenish($invoice_id, $pv_count);
  }


}
