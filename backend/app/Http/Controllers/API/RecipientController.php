<?php

namespace App\Http\Controllers\api;

use App\Constants\ResponseConstants;
use App\Http\Controllers\Controller;
use App\Http\Requests\RecipientRequest;
use App\Http\Resources\RecipientResource;
use App\Http\Traits\HttpResponses;
use App\Models\Recipient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RecipientController extends Controller
{
    //
    use HttpResponses;
    public function index() : JsonResponse
    {
        return $this->success(RecipientResource::collection(Recipient::get()));
    }

    public function show(Recipient $recipient) : JsonResponse
    {
        return $this->success(new RecipientResource($recipient));
    }

    public function store(RecipientRequest $request) : JsonResponse
    {
        
        // $recipient = Recipient::create($request->all());
        $recipient = Recipient::create([
            "name" => $request->name,
            "emails" => json_encode($request->emails),
            "mobile_nos" => json_encode($request->mobile_nos),
            // "notify" => json_encode($request->notify)
        ]);
        return $this->success(new RecipientResource($recipient),class_basename($recipient). ResponseConstants::STORE);
    }

    public function update(RecipientRequest $request, Recipient $recipient) : JsonResponse
    {
        $recipient->update($request->all());
        return $this->success(new RecipientResource($recipient), class_basename($recipient) . ResponseConstants::UPDATE );
    }

    public function destroy(string $id){ 
        $recipient = Recipient::find($id);
        $recipient->delete();
        return $this->success($recipient, ResponseConstants::DESTROY);
    }
}
