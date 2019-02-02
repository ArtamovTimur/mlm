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
        try {
            $lever = self::getLever($sponsor_id);
            $last_child = self::getLastChildByLever($sponsor_id, $lever);
     
            return DB::table('binary_trees')
            ->insert([
                'hash' => str_random(6),
                'parent_id' => $last_child->user_id,
                'user_id' => $user_id,
                'sponsor_id' => $sponsor_id,
                'leg' => $lever
            ]);
        } catch (\Exception $e) {}
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
        try {
           return DB::table('users')
               ->where('id', '=', $user_id)
               ->get()->first()->lever;
            // return 'right';

        } catch (\Exception $e){

        }

    }
    public static function getTreeBySponsor($user_id)
    {
    	return DB::table('binary_trees')
    		->where('sponsor_id', '=', $user_id)->limit(8)->get();
    	
    }

    public static function getLastChildByLever($id, $lever, $lastChild = null) {
        try {
            if (!$lastChild) {
                $lastChild = DB::table('binary_trees')
                ->where('user_id', '=', $id)->get()->first();
            }

            $currentLastChild = DB::table('binary_trees')
                ->where('parent_id', '=', $id)
                ->where('leg', '=', $lever)->get()->first();
            if (empty($currentLastChild)) return $lastChild;

            return self::getLastChildByLever($currentLastChild->user_id, $lever, $currentLastChild);
        }catch (\Exception $e){

        }
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

        function getUser($res, $id, $level = 0) {
            if ($level > 3) return $res;
            $level++;
            if(!empty($c1 = DB::table('binary_trees')
                ->where('parent_id', '=', $id)
                ->where('leg', '=', 'left')->get()->first())) {
                $res[] = $c1;
                $res = getUser($res, $c1->user_id, $level);
            }
            if(!empty($c2 = DB::table('binary_trees')
                ->where('parent_id', '=', $id)
                ->where('leg', '=', 'right')->get()->first())) {
                $res[] = $c2;
                $res = getUser($res, $c2->user_id, $level);
            }
            return $res;
        }

        $res = getUser($res, $user_id);

        return $res;
    }

}