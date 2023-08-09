<?php

namespace App\Http\Controllers;

use App\Models\Mobile;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function add_customer(){
        $mobile =new Mobile();
        $mobile->model='LG102';

        $customer = new Customer();
        $customer->name='rahul sharma';
        $customer->email='rahullss@gmail.com';
        $customer->save();
        $customer->mobile()->save($mobile);
}
        public function show_mobile($id)
        {
            $mobile=Customer::find($id)->mobile;
            return $mobile;
        }
        public function show_customer($id)
        {
            $mobile=Customer::find($id)->mobile;
            // return $mobile;
            return view('mobile',['mobile'=>$mobile]);
        }


    }

