<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WholesaleUserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::whereNotNull('customer_type_id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $deleteGate = 'wholesale_user_delete';
                $crudRoutePart = 'wholesale_user';

                return view('partials.datatablesActions', compact(
                    'deleteGate',
                    'crudRoutePart',
                    'row',
                ));
            });

            $table->editColumn('id', function ($row) {
                $id =  $row->id ? $row->id : '';
                return '<div class="text-center"><span class="text-dark">'.$id.'</span></div>';
            });
            $table->editColumn('name', function ($row) {
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$row->name.'</span></div>';
            });

            $table->editColumn('email', function ($row) {
                return '<div class="text-center"><span class="text-primary font-weight-bold">'.$row->email.'</span></div>';
            });

            $table->addColumn('customer_type_name', function ($row) {
                $customer_type_name = $row->customer_type ? $row->customer_type->name : "";
                return '<div class="text-center"><span class="text-primary font-weight-bold">'.$customer_type_name.'</span></div>';
            });

            $table->editColumn('mobile', function ($row) {
                return '<div class="text-center"><span class="text-primary font-weight-bold">'.$row->mobile.'</span></div>';
            });

            $table->editColumn('status', function ($row) {
                $Reject = $row->status == 0 ? "selected" : "";
                $Approve = $row->status == 1 ? "selected" : "";
                return '<select class="form-control select2 status" data-id="'.$row->id.'">
                            <option value="0" '. $Reject .' >Reject</option>
                            <option value="1" '. $Approve .' >Approve</option>
                        </select>';
            });

            $table->rawColumns(['actions','placeholder','id','name','email','mobile','status','customer_type_name']);

            return $table->make(true);
        }

        return view('admin.wholesale_user.index');
    }

    public function destroy ($id){
        User::where("id", $id)->delete();

        return back();
    }

    public function update_status(Request $request){
        $id = $request->id;
        $status = $request->status;

        $User = User::find($id);
        $User->status = $status;
        $User->save();

        if($User->id){
            $User = $User->toArray();
            \Mail::to($User['email'])->send(new \App\Mail\WholesaleAccountMail($User));
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status updated successfully.']);
        } else{
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Status updation failed.']);
        }
    }
}
