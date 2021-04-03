<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use App\Models\CustomerRoom;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function saveCustomer(Request $request)
    {
        $requestData = $request->all();
        // dd($requestData);
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
        $customerID = Customer::insertGetId([
            "name" => $requestData["name"], "id_card" => $requestData["id_card"], "date_of_birth" => $requestData["date_of_birth"], "job" => $requestData["job"], "address" => $requestData["address"],"created_at" => Carbon::now('+7:00')
        ]);
        if(isset($requestData['room_id'])){
            $customer_room = CustomerRoom::insert(array(
                'customer_id'=>$customerID,
                'room_id' => $requestData['room_id']
            ));

        }
       
        Session::flash('success', 'Thêm mới thành công');
        return response()->json(['success' => true]);
    }
    public function getAllCustomer(Request $request)
    {
        $data = array(
            'list' => DB::table('customers')->get(),
            'rooms' => DB::table('rooms')->get(),
            // 'customer_rooms' => DB::table('customer_rooms')->get(),
        );

        return view('admin.customer.all_customer', $data);
    }

    //lấy id của khách hàng
    public function getIDCustomer(Request $request)
    {
        $data = DB::table('customers')->where('id', $request["id"])->first();
        $data_room =  DB::table('customers')->join('customer_rooms','customer_rooms.customer_id','=','customers.id')->where('customers.id', $request["id"])->select('customer_rooms.room_id')->get();

        $respon['status'] = true;
        $respon['data'] = $data;
        $respon['data_room'] = $data_room;
        $respon['id'] = $request["id"];
        return response()->json($respon);
    }

    //lấy tất cả các phòng đổ vào select2
    public function getRoom(Request $request)
    {
        $data = DB::table('rooms')->get();
        $respon['data'] = $data;   
        // $respon['data_cusRoom'] = $data_room_customer;   
        return response()->json($respon);
    }

    public function UpdateCustomer(Request $request)
    {
        $requestData = $request->all();
        $id = $request->id_edit;
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
         $customerID = Customer::where('id',$id)->update([
            "name" => $requestData["name"], "id_card" => $requestData["id_card"], "date_of_birth" => $requestData["date_of_birth"], "job" => $requestData["job"], "address" => $requestData["address"],"created_at" => Carbon::now('+7:00')
        ]);
        
        if(isset($requestData['room_id'])){
            $dele = CustomerRoom::where('customer_id',$id)->delete();
            $customer_room = CustomerRoom::where('customer_id',$id)->insert(array(
                'room_id' => $requestData['room_id'],
                'customer_id'=>$id,

            ));

        }
       
        Session::flash('success','Cập nhật thành công');
        return response()->json(['success' => true]);
    }
    public function DeleteCustomer($id)
    {
        DB::table('customers')->where('id', $id)->delete();
        $data = array(
            'list' => DB::table('customers')->get()
        );
        return redirect(route("customer.view", $data));
    }
}   