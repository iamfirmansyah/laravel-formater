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

    public static function random($size, $withSpecialCharacters = false)
    {
        $code = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $code .= "abcdefghijklmnopqrstuvwxyz";
        $code .= "0123456789";

        $token = self::generate($code, $size, $withSpecialCharacters);

        return $token;
    }

    private static function generate($characters, $size, $withSpecialCharacters = false)
    {
        if ($withSpecialCharacters) {
            $characters .= '!@#$%^&*()';
        }

        $token = '';
        $max = strlen($characters);
        for ($i = 0; $i < $size; $i++) {
            $token .= $characters[random_int(0, $max - 1)];
        }

        return $token;
    }

}