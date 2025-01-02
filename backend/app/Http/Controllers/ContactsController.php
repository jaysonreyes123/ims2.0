<?php

namespace App\Http\Controllers;

use App\Constants\ResponseConstants;
use App\Helpers\ActivityLogs;
use App\Helpers\Module;
use App\Http\Resources\ContactsResources;
use App\Http\Traits\HttpResponses;
use App\Models\Barangay;
use App\Models\CallerType;
use App\Models\Contact;
use App\Models\Municipality;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $model = Contact::query();
        $list = Module::list_view($model,[],$request->filter);
        return  ContactsResources::collection($list);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $model = new Contact();
        foreach($request->all() as $key => $value){
            if($key == 'assigned_team'){
                $model->$key = json_encode($value);
            }
            // else if($key == "time_of_incident"){
            //     if($value != null){
            //         $model->$key = $value['hours'].":".$value['minutes'].":".$value['seconds'];
            //     }
            // }
            else if($key == "date_of_incident"){
                $model->$key = $value == "" ? null : Carbon::parse($value)->format("Y-m-d");
            }
            else{
                $model->$key = $value;
            }
        }
        $model->save();
        ActivityLogs::log($model->id,'contacts','create');
        return $this->success(new ContactsResources($model),class_basename($model).ResponseConstants::STORE);

    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
        return $this->success(new ContactsResources($contact));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
        $original = $contact->replicate();
        foreach($request->all() as $key => $value){
            if($key == 'assigned_team'){
                $contact->$key = json_encode($value);
            }
            else{
                $contact->$key = $value;
            }
        }
        $contact->save();
        ActivityLogs::log($contact->id,'contacts','update',$original,$contact);
        return $this->success(new ContactsResources($contact),class_basename($contact).ResponseConstants::UPDATE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
        $contact->deleted = 1;
        $contact->save();
        return $this->success([],class_basename($contact).ResponseConstants::DESTROY);
    }

    public function get_caller_types() : JsonResponse {
        $model = CallerType::all();
        return $this->success($model);
    }
    public function get_municipalities() : JsonResponse {
        $model = Municipality::all();
        return $this->success($model);
    }
    public function get_barangay() : JsonResponse {
        $model = Barangay::all();
        return $this->success($model);
    }
}
