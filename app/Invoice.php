<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    // создать счет
    public static function create($uid, $invoice_type = 1, $balance = 0){
        if(DB::table('invoices')->where('user_id', '=', $uid)->get()->count() == 0){
            DB::table('invoices')->insert([
                'user_id' => $uid,
                'type_id' => $invoice_type,
                'balance' => $balance
            ]);
        }


    }
    // получить счет по id
    public static function get($id)
    {
        return DB::table('invoices')->where('id', '=', $id)->get();

    }
    // получить счет по id пользователя
    public static function getByUid($uid){
        return DB::table('invoices')->where('user_id', '=', $uid)->get();
    }
    //удалить счет по id
    public static function deleteById($id)
    {
        return DB::table('invoices')->where('id', '=', $id)->delete();
    }
    //удалить счет по id пользователя
    public static function deleteByUid($uid)
    {
        return DB::table('invoices')->where('user_id', '=', $uid)->delete();
    }
    // операция поплнения баланса
    public static function replenish($invoice_id, $sum)
    {
        return DB::table('invoices')->where('id', '=', $invoice_id)->increment('balance', $sum);
    }
    // операция оплаты(вычет из баланса)
    public static function pay($invoice_id, $sum)
    {
       if(DB::table('invoices')->where('id', '=', $invoice_id)->get()[0]->balance >= $sum){
           return DB::table('invoices')->where('id', '=', $invoice_id)->decrement('balance', $sum);
       }
        return false;
    }

    //начисление бонуса
    public static function bonusBilling($user_id, $bonus_type)
    {

    }
}
