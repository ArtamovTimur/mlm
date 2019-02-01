<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BinaryTree extends Model
{
    /*
     * user_id - id текущего пользователя
     * sponsor_id - id пользователя который пригласил
     * */
    public static function addSponsor($user_id, $sponsor_id)
    {
        $lever = self::getLever($sponsor_id);
        $last_child = self::getLastChild($sponsor_id);
        if(self::getLever($last_child) != $lever){

            $parent = DB::table('binary_trees')
                ->where('leg', '=', $lever)
                ->where('sponsor_id', '=', $sponsor_id)
                ->get()->first()->user_id;
            if(empty($parent)){
                $parent = $sponsor_id;
            }

            return DB::table('binary_trees')
                ->insert([
                    'hash' => str_random(6),
                    'parent_id' => $parent,
                    'user_id' => $user_id,
                    'sponsor_id' => $sponsor_id,
                    'leg' => self::getLever($sponsor_id)
                ]);
        }else {

            return DB::table('binary_trees')
                ->insert([
                    'hash' => str_random(6),
                    'parent_id' => self::getLastChild($sponsor_id),
                    'user_id' => $user_id,
                    'sponsor_id' => $sponsor_id,
                    'leg' => self::getLever($sponsor_id)
                ]);
        }

    }

    public static function getLeverCount($user_id)
    {
        $levers['left'] = DB::table('binary_trees')
            ->where('sponsor_id', '=', $user_id)
            ->where('leg', '=', 'left')
            ->get()->count();
        $levers['right'] = DB::table('binary_trees')
            ->where('leg', '=', 'right')
            ->where('sponsor_id', '=', $user_id)
            ->get()->count();
        return $levers;
    }

    public static function getLever($user_id)
    {
        try{
//            return DB::table('users')
//                ->where('id', '=', $user_id)
//                ->get()->first()->lever;
            return 'right';

        }catch (\Exception $e){

        }

    }
    public static function getTreeBySponsor($user_id)
    {
    	return DB::table('binary_trees')
    		->where('sponsor_id', '=', $user_id)->limit(8)->get();
    	
    }
    public static function getLastChild($sponsor_id)
    {
        try{
            $last = DB::table('binary_trees')
                ->where('sponsor_id', '=', $sponsor_id)
                ->orderBy('id', 'desc')->get()->first()->user_id;
            return $last;
        }catch (\Exception $e){

        }
        //var_export($last);

        return $sponsor_id;
    }
    public static function getChilds($parent_id, $lever = '')
    {
        if(!empty($lever)){
            return DB::table('binary_trees')
                ->where('parent_id', '=', $parent_id)
                ->where('leg', '=', $lever)
                ->get()->first();
        }
        return DB::table('binary_trees')
            ->where('parent_id', '=', $parent_id)
            ->get();
    }
    public static function getTree($user_id)
    {
        $res = [];
        if(!empty($c1 = DB::table('binary_trees')
            ->where('sponsor_id', '=', $user_id)
            ->where('leg', '=', 'left')->get()->first())){
            $res[] = $c1;
        }
        if(!empty($c2 = DB::table('binary_trees')
            ->where('sponsor_id', '=', $user_id)
            ->where('leg', '=', 'right')->get()->first())){
            $res[] = $c2;
        }
        if(!empty($c1)){
            $res[] = $c3 = DB::table('binary_trees')
                ->where('parent_id', '=', $c1->user_id)
                ->where('leg', '=', 'right')->get()->first();

            $res[] = $c4 = DB::table('binary_trees')
                ->where('parent_id', '=', $c1->user_id)
                ->where('leg', '=', 'right')->get()->first();
        }
        if(!empty($c2)){
            $res[] = $c5 = DB::table('binary_trees')
                ->where('parent_id', '=', $c2->user_id)
                ->where('leg', '=', 'left')->get()->first();
            $res[] = $c6 = DB::table('binary_trees')
                ->where('parent_id', '=', $c2->user_id)
                ->where('leg', '=', 'right')->get()->first();
        }
        if(!empty($c3)){
            $res[] = $c7 = DB::table('binary_trees')
                ->where('parent_id', '=', $c3->user_id)
                ->where('leg', '=', 'left')->get()->first();
            $res[] = $c8 = DB::table('binary_trees')
                ->where('parent_id', '=', $c3->user_id)
                ->where('leg', '=', 'right')->get()->first();
        }
        if(!empty($c4)){
            $res[] = $c9 = DB::table('binary_trees')
                ->where('parent_id', '=', $c4->user_id)
                ->where('leg', '=', 'left')->get()->first();
            $res[] = $c10 = DB::table('binary_trees')
                ->where('parent_id', '=', $c4->user_id)
                ->where('leg', '=', 'right')->get()->first();
        }
        if(!empty($c5)){
            $res[] = $c11 = DB::table('binary_trees')
                ->where('parent_id', '=', $c5->user_id)
                ->where('leg', '=', 'left')->get()->first();
            $res[] = $c12 = DB::table('binary_trees')
                ->where('parent_id', '=', $c5->user_id)
                ->where('leg', '=', 'right')->get()->first();
        }
        if(!empty($c6)){
            $res[] = $c13 = DB::table('binary_trees')
                ->where('parent_id', '=', $c6->user_id)
                ->where('leg', '=', 'left')->get()->first();
            $res[] = $c14 = DB::table('binary_trees')
                ->where('parent_id', '=', $c6->user_id)
                ->where('leg', '=', 'right')->get()->first();
        }
        return $res;

    }

}
