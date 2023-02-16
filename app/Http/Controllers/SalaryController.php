<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function calcSalary(Request $request){
        $ndfl = 0.2;
        $age = $request->age;
        $children = $request->children;
        $companyCar = $request->company_car == "yes" ? true : false;
        $salary = $request->salary;

        $salaryAfterNdfl = $salary * ($children > 2 ? (1 - 0.18) : (1-0.2));
        $forKids = $children > 2 ? round($salary*0.02,2) : 0;
        $forAge = $age > 50 ? round($salaryAfterNdfl * 0.07, 2) : 0;
        $forCar = $companyCar ? 25000 : 0;
        $salaryResult =  round($salaryAfterNdfl + $forAge - $forCar, 2);



        return response()->json([
            'success' => true,
            'ndfl' => round($salary*0.2,2),
            'for_kids' => $forKids,
            'for_car' => $forCar,
            'for_age' => $forAge,
            'salary' => round($salaryResult,2),
            'sum' => round($salaryResult + $forCar + $salary*0.2)
        ]);
    }
}
