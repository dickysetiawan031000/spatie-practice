<?php

namespace App\Http\Controllers\Api;

use App\Events\Comment\CreatedEvent;
use App\Events\Comment\DeletedEvent;
use App\Events\Comment\GetEvent;
use App\Events\Comment\UpdatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CreateRequest;
use App\Http\Requests\Comment\UpdateRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\EventListener;

class CommentController extends Controller
{
    public function __construct()
    {
        //middleware role admin and user
        // $this->middleware('role:admin||user');

        //middleware role permission create-comment
        // $this->middleware('permission:create-comment', ['only' => ['store']]);

        //middleware role permission index-comment
        // $this->middleware('role:author', ['only' => ['index']]);

        // $this->middleware('role_or_permission:admin||user||create-comment||update-comment||delete-comment||comment');
        $this->middleware('permission:comment', ['only' => ['index']]);

        $this->middleware('role:admin|user', ['only' => ['store', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //get all comments with resource
        $comments = Comment::with('news')->get();

        //condition if comments is empty
        if ($comments->isEmpty()) {
            return response()->json([
                'message' => 'Comments is empty',
            ], 404);
        }

        //condition if comments event listener
        if ($comments) {
            //event listener
            event(new GetEvent($comments));
        }

        return CommentResource::collection($comments);

        // return Comment::with('news')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {

        $data = $request->validated();

        //user_id
        $data['user_id'] = auth()->user()->id;

        //create comment
        $comment = Comment::create($data);

        //if event listener
        if ($comment) {
            //event listener
            event(new CreatedEvent($comment));
        }

        //return with resource
        return new CommentResource($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show comment by id
        $comment = Comment::findOrFail($id);

        //if comment not found
        if (!$comment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Comment not found'
            ], 404);
        }

        //return with resource
        return new CommentResource($comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        //update comment
        $comment = Comment::findOrFail($id);

        //if comment not found
        if (!$comment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Comment not found'
            ], 404);
        }

        $data = $request->validated();

        //update comment
        $update = $comment->update([
            'news_id' => $comment->news_id,
            'comment' => $data['comment'],
        ]);

        if ($update) {
            //event listener
            event(new UpdatedEvent($comment));
        }

        //return with resource
        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete comment
        $comment = Comment::findOrFail($id);

        //if comment not found
        if (!$comment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Comment not found'
            ], 404);
        }

        // //delete comment
        $delete = $comment->delete();

        if ($delete) {
            //event listener
            event(new DeletedEvent($comment));
        }

        // //return with resource
        return new CommentResource($comment);
    }
}
