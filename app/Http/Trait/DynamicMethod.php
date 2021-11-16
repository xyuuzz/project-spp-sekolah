<?php

namespace App\Http\Trait;

trait DynamicMethod
{
    public function __call($name, $arguments) {
        // echo 'Method Name:' . $name . ' Arguments:' . implode(',', $arguments);
        //do a get
        if (preg_match('/^updating(.+)/', $name, $matches)) {
            // $var_name = $matches[1];
            if($arguments[1] !== $arguments[0])
            {
                throw new \Exception("Hayo mau Nge-hack ya!");
            }
        }
        //do a set
        // if (preg_match('/^set_(.+)/', $name, $matches)) {
        //     $var_name = $matches[1];
        //     $this->$var_name = $arguments[0];
        // }
        // dd($name, $arguments, 0);
    }
}
