<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function addService()
    {
        return view("admin.service.add_service");
    }
    public function saveService(Request $request)
    {
        $requestData = $request->all();
        $request->validate([
            'name' => 'required|max:60|',
        ], [
            'name.required' => 'Vui lòng nhập họ và tên Không quá 60 ký tự '

        ]);
        Service::create([
            "name" => $requestData["name"]
        ]);
        return redirect(route("service.view"));
    }
    public function getAllService(Request $request)
    {
        $data = array(
            'list' => DB::table('services')->get()
        );
        return view("admin.service.all_service", $data);
    }

    public function getEditService(Request $request, $id)
    {
        $data = array(
            'service' => DB::table('services')->where('id', $id)->first()
        );
        //return $data;
        $id1 = Service::findOrFail($id);
        //return $id1;
        return view("admin.service.edit_service", $id1, $data);
    }

    public function UpdateService(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:60|',
        ], [
            'name.required' => 'Vui lòng nhập họ và tên Không quá 60 ký tự '

        ]);
        $edit_service = DB::table('services')->where('id', $id)->update([
            "name" => $request->name
        ]);
        $data = array(
            'list' => DB::table('services')->get()
        );
        return redirect(route("service.view", $data));
    }
    public function DeleteService($id)
    {
        DB::table('services')->where('id', $id)->delete();
        $data = array(
            'list' => DB::table('services')->get()
        );
        return redirect(route("service.view", $data));
    }
}