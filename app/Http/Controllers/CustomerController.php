<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function addCustomer(){
        return view("admin.customer.add_customer");
    }
    public function saveCustomer(Request $request){
        $requestData = $request->all();
        $request->validate([
            'name' => 'required|max:60|',
            'id_card' => 'required|max:15|',
            'date_of_birth' => 'required|date',
            'job' => 'required|max:20|',
            'address' => 'required|max:60|',
        ], [
            'name.required' => 'Vui lòng nhập họ và tên Không quá 60 ký tự ',
            'id_card.required' => 'Vui lòng nhập Chứng minh thư Không quá 15 ký tự',
            'date_of_birth.required' => 'Vui lòng nhập ngày tháng năm sinh',
            'job.required' => 'Vui lòng nhập công việc hiện tại Không quá 20 ký tự',
            'address.required' => 'Vui lòng nhập địa chỉ Không quá 60 Ký tự'

        ]);
        Customer::create([
            "name"=>$requestData["name"],"id_card"=>$requestData["id_card"],"date_of_birth"=>$requestData["date_of_birth"],"job"=>$requestData["job"],"address"=>$requestData["address"]
        ]);
        return redirect(route("customer.add.customer"));
    }
}
