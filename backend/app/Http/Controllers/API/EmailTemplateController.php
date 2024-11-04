<?php

namespace App\Http\Controllers\API;

use App\Constants\ResponseConstants;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmailTemplateRequest;
use App\Http\Resources\EmailTemplateResource;
use App\Http\Traits\HttpResponses;
use App\Models\EmailTemplate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return $this->success(EmailTemplateResource::collection(EmailTemplate::get()));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmailTemplateRequest $request)
    {
        //
        $model = EmailTemplate::create([
            "name" => $request->name,
            "content" => $request->content,
        ]);

       return $this->success(new EmailTemplateResource($model),class_basename($model).ResponseConstants::STORE);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmailTemplateRequest $request, EmailTemplate $email_template)
    {
        //
        $email_template->update($request->all());
        return $this->success(new EmailTemplateResource($email_template),class_basename($email_template). ResponseConstants::UPDATE );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
