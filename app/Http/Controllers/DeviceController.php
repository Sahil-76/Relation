<?php

namespace App\Http\Controllers;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DeviceController extends Controller
{
    /* this is use for using id*/
    //     function list($id)
//     {

// //return Device::all();
// $list=Device::find($id);

// if (!$list) {
//     return response()->json(['error' => 'Device not found'], 404);
// }
// return response()->json($list);
//     }

/* post method   shift+alt+a for multiple comment*/


    public function add(Request $request)
    {
        $device = new Device;
        $device->name = $request->name;
        $device->member_id = $request->member_id;
       $result= $device->save();
       if($result)
       {
        return ["Result" => "Data has been saved"];
       }
       else{
       return ["Result" => "Operation failed"];
         }
  
    }

     function update(Request $request )
     {
        $device=Device::find($request->id);
        $device->name=$request->name;
        $device->member_id=$request->member_id;
        $result=$device->save();
        return["result" => "Data has been updated"];
     }
     function search($name)
     {
        return Device::where("name",$name)->get();
     }


     function delete($id)
     {
        $device=Device::find($id);
        $result=$device->delete();
        if($result)
        {
            return ["result"=>"Data has been deleted"];
        }

        return ["result"=>"Delete operation is not working "];
     }



     function testData(Request $request)
     {
         $rules = array(
             "member_id" => "required|min:2|max:4"
         );
         
         $validator = Validator::make($request->all(), $rules);
     
         if ($validator->fails()) {
             return $validator->errors();
        //  } else {
        //      $device = new Device;
        //      $device->name = $request->member_id;
        //      $result = $device->save();
             
        //      if ($result) {
        //          return ["Result" => "Data has been saved successfully"];
        //      } else {
        //          return ["Result" => "Operation failed"];
        //      }
         }
        }

    }
