<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogs;
use App\Helpers\Module;
use App\Http\Resources\CommentResource;
use App\Http\Traits\HttpResponses;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    use HttpResponses;
    public function index($module,$id){
        $module = Module::module_id($module);
        $comment_model = Comment::with('users')->where('module',$module)
        ->where("module_id",$id)
        ->where("comment_id",0)
        ->orderByDesc('created_at')
        ->paginate(10);
        return CommentResource::collection($comment_model);
    }
    public function comment_reply_index($commentid){
        $comment_model = Comment::where('comment_id',$commentid)->orderByDesc('created_at')->paginate(10);
        return CommentResource::collection($comment_model);
    }
    public function save(Request $request){
       $module = Module::module_id($request->module);
       $comment_module = Module::module_id('comments');
       $module_id = $request->module_id;
       $comment = $request->comment;
       $comment_model = new Comment();
       $comment_model->module = $module;
       $comment_model->module_id = $module_id;
       $comment_model->comment = $comment;
       $comment_model->comment_id = $request->comment_id;
       $comment_model->comment_by = Auth::id();
       if($comment_model->save()){
        ActivityLogs::log($module_id,$module,status:4,related_module:$comment_module,related_item_id:$comment_model->id);
       }
       return $this->success(new CommentResource($comment_model));
    }
}
