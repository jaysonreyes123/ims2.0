<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            "id" => $this->id,
            "comment" => $this->comment,
            "comment_id" => $this->comment_id,
            "comment_by" => $this->users->name,
            "reply" => [],
            "reply_count" => Comment::where("comment_id",$this->id)->count(),
            "current_page" => 0,
            "timestamp" => $this->created_at->diffForHumans(),
            "created_at" => $this->created_at,
        ];
    }
}
