<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{
    public function result(Request $request)
    {
        $acreage = isset($request['acreage']) ? $request['acreage'] : '';
        $price = isset($request['price']) ? $request['price'] : '';
        $address = isset($request['address']) ? $request['address'] : '';
        $utilities = isset($request['utilities']) ? $request['utilities'] : '';

        // Truy van voi dien tich va dia chi
        if($acreage == 1) {
            $query = DB::table('apartment')->where([
                ['area', '=', $address],
                ['acreage', '<', 15],
            ]);
        } 
        elseif($acreage == 2)
        {
            $query = DB::table('apartment')->where('area', $address)->whereBetween('acreage', [15, 20]);
        }
        elseif($acreage == 3)
        {
            $query = DB::table('apartment')->where('area', $address)->whereBetween('acreage', [20, 25]);
        }
        elseif($acreage == 4)
        {
            $query = DB::table('apartment')->where('area', $address)->whereBetween('acreage', [25, 30]);
        }
        elseif($acreage == 5)
        {
            $query = DB::table('apartment')->where('area', $address)->where('acreage', '>', 30);
        }

        // Truy van voi gia
        if($price == 1) {
            $query->where('price', '>', 5);
        }
        elseif($price == 2)
        {
            $query->whereBetween('price', [3, 5]);
        }
        elseif($price == 3)
        {
            $query->whereBetween('price', [2, 3]);
        }
        elseif($price == 4)
        {
            $query->whereBetween('price', [1, 2]);
        }
        elseif($price == 5)
        {
            $query->where('price', '<', 1);
        }

        if(!empty($utilities)){
            if (in_array('wifi', $utilities)) {
                $wifi = 1;
            } else{
                $wifi = 0;
            }
            if (in_array('heater', $utilities)) {
                $heater = 1;
            } else {
                $heater = 0;
            }
            if (in_array('air_conditioner', $utilities)) {
                $air_conditioner = 1;
            } else {
                $air_conditioner = 0;
            }
            if (in_array('ko_chung_chu', $utilities)) {
                $chung_chu = 0;
            } else {
                $chung_chu = 1;
            }

            $result = $query->when($wifi, function ($query, $wifi) {
                        return $query->where('wifi', $wifi);
                    })->when($heater, function ($query, $heater) {
                        return $query->where('heater', $heater);
                    })->when($air_conditioner, function ($query, $air_conditioner) {
                        return $query->where('air_conditioner', $air_conditioner);
                    })->when($chung_chu, function ($query, $chung_chu) {
                        return $query->where('chung_chu', $chung_chu);
                    })->get();
        } else {
            $result = $query->get();
        }

        
        $temp =array();
        $topsis = array();

        foreach($result as $key => $r) {
            $temp[$key]['acreage'] = $r->acreage;
            $temp[$key]['price'] = $r->price;
            $temp[$key]['area'] = $r->area;
            // $temp[$key]['utilities'] = ($r->wifi*3 + $r->heater*3 + $r->air_conditioner*3 + $r->chung_chu*1);
            
            $temp[$key]['id'] = $r->apartID;
            $temp[$key]['title'] = $r->title;
            $temp[$key]['description'] = $r->description;
            $temp[$key]['wifi'] = $r->wifi;
            $temp[$key]['heater'] = $r->heater;
            $temp[$key]['air_conditioner'] = $r->air_conditioner;
            $temp[$key]['chung_chu'] = $r->chung_chu;
        }

        foreach($result as $key => $r) {
            $topsis[$key]['acreage'] = $r->acreage;
            $topsis[$key]['price'] = $r->price;
            // trong tieu chi trong so cua wifi, nong lanh, dieu hoa la 3, chung chu la 1
            $topsis[$key]['utilities'] = ($r->wifi*3 + $r->heater*3 + $r->air_conditioner*3 + $r->chung_chu*1);
        }

        // Chuan hoa vector
        $num_result = count($topsis);

        // for($i = 0; $i < $num_result; $i++) {
        //     $topsis[$i]['acreage'] = 
        // }

         // tinh toan mau so cho chuan hoa vector
        $ms = array();
        $ms['acreage'] = 0;
        $ms['price'] = 0;
        $ms['utilities'] = 0;
        for ($j = 0; $j < $num_result; $j++){
            $ms['acreage'] += pow($topsis[$j]['acreage'],2);
            $ms['price'] += pow($topsis[$j]['price'],2);
            $ms['utilities'] += pow($topsis[$j]['utilities'],2);
        }
        $ms['acreage'] = sqrt($ms['acreage']);
        $ms['price'] = sqrt($ms['price']);
        $ms['utilities'] = sqrt($ms['utilities']);

        for ($j = 0; $j < $num_result; $j++){
            $topsis[$j]['acreage'] = number_format($topsis[$j]['acreage']*0.4/$ms['acreage'],4);
            $topsis[$j]['price'] = number_format($topsis[$j]['price']*0.4/$ms['price'],4);
            $topsis[$j]['utilities'] = number_format($topsis[$j]['utilities']*0.2/$ms['utilities'],4);
        }

        $max = array();
        $min = array();
        $max['acreage'] = $max['price'] = $max['utilities'] = $max['C'] = 0;
        $min['acreage'] = $min['price'] = $min['utilities'] = 1;
        for ($j = 0; $j < $num_result; $j++){
            if($topsis[$j]['acreage'] > $max['acreage']) {
                $max['acreage'] = $topsis[$j]['acreage'];
            }
            if($topsis[$j]['price'] > $max['price']){
                $max['price'] = $topsis[$j]['price'];
            }
            if($topsis[$j]['utilities'] > $max['utilities']){
                $max['utilities'] = $topsis[$j]['utilities'];
            }
            if($topsis[$j]['acreage'] < $min['acreage']){
                $min['acreage'] = $topsis[$j]['acreage'];
            }
            if($topsis[$j]['price'] < $min['price']){
                $min['price'] = $topsis[$j]['price'];
            }
            if($topsis[$j]['utilities'] < $min['utilities']){
                $min['utilities'] = $topsis[$j]['utilities'];
            }
        }

        $distance = array();
        for ($j = 0; $j < $num_result; $j++){
            $distance[$j]['good'] = number_format(sqrt(pow($topsis[$j]['acreage'] - $max['acreage'], 2)
                                    +pow($topsis[$j]['price'] - $max['price'], 2)
                                    +pow($topsis[$j]['utilities'] - $max['utilities'], 2)), 4);
            $distance[$j]['bad'] = number_format(sqrt(pow($topsis[$j]['acreage'] - $min['acreage'], 2)
                                    +pow($topsis[$j]['price'] - $min['price'], 2)
                                    +pow($topsis[$j]['utilities'] - $min['utilities'], 2)), 4);
            $distance[$j]['C'] = $distance[$j]['bad']/($distance[$j]['bad'] + $distance[$j]['good']);
        }

        $final = array();
        for($i =0; $i < $num_result; $i++) {
            $final[$i]['C'] = $distance[$i]['C'];
            $final[$i]['id'] = $temp[$i]['id'];
            $final[$i]['title'] = $temp[$i]['title'];
            $final[$i]['description'] = $temp[$i]['description'];
            $final[$i]['wifi'] = $temp[$i]['wifi'];
            $final[$i]['heater'] = $temp[$i]['heater'];
            $final[$i]['air_conditioner'] = $temp[$i]['air_conditioner'];
            $final[$i]['price'] = $temp[$i]['price'];
            $final[$i]['acreage'] = $temp[$i]['acreage'];
            $final[$i]['area'] = $temp[$i]['area'];
        }

        rsort($final);

        echo json_encode($final);
    }
}
