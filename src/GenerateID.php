<?php

namespace Iamfirmansyah\Formater;

use Illuminate\Support\Facades\DB;

class GenerateID
{
    public static function uniqueDefault($table, $col, $initial, $length = 12)
    {
        $id = $initial;
        
        while (strlen($id) <= $length) {
            if (strlen($id) == 2 || strlen($id) == 3 || strlen($id) == 6 || strlen($id) == 7) {
                $id .= chr(mt_rand(65, 90));
            } // Generate String Random
            else {
                $id .= mt_rand(0, 9);
            }

            if (strlen($id) == 8) {
                $isExist = DB::table($table)->where($col, $id)->exists();

                if ($isExist) {
                    $id = $initial;
                    continue;
                }

                return $id;
            }
        }
    }
}