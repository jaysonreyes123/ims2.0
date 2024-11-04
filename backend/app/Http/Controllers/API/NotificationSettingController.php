<?php

namespace App\Http\Controllers\API;

use App\Constants\ResponseConstants;
use App\Http\Controllers\Controller;
use App\Http\Requests\NotificationSettingRequest;
use App\Http\Resources\NotificationSettingResource;
use App\Http\Traits\HttpResponses;
use App\Models\NotificationSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationSettingController extends Controller
{
    //
    use HttpResponses;
    public function index(): JsonResponse
    {
        return $this->success(NotificationSettingResource::collection(NotificationSetting::get()));
    }
    public function store(NotificationSettingRequest $request): JsonResponse
    {
        $notification = NotificationSetting::create([
            "sensor_id" => $request->sensor_id,
            "name"  => $request->name,
            "body" => $request->body,
            "recipient" => $request->recipient
        ]);
        return $this->success(new NotificationSettingResource($notification), class_basename($notification) . ResponseConstants::STORE);
    }

    /**
     * @param NotificationSetting $notificationsetting
     * @return JsonResponse
     */
    public function show(NotificationSetting $notification): JsonResponse
    {
        return $this->success(new NotificationSettingResource($notification));
    }

    public function update(NotificationSettingRequest $request, NotificationSetting $notification): JsonResponse
    {
        $notification->update($request->all());
        return $this->success(new NotificationSettingResource($notification), class_basename($notification) . ResponseConstants::UPDATE);
    }

    public function destroy(string $id)
    {
        $model = NotificationSetting::find($id);
        $model->delete();
        return $this->success($model, ResponseConstants::DESTROY);
    }
}
