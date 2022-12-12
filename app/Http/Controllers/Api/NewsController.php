<?php

namespace App\Http\Controllers\Api;

use App\Events\News\CreatedEvent;
use App\Events\News\DeletedEvent;
use App\Events\News\GetEvent;
use App\Events\News\UpdatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\News\CreateRequest;
use App\Http\Requests\News\UpdateRequest;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:news.create')->only(['store']);

        //role or permission middleware
        // $this->middleware('role_or_permission:admin||author||create-news||update-news||delete-news||news');
        // $this->middleware(['role:admin|author', 'permission:create-news|update-news|delete-news|news']);

        // $this->middleware(['role:admin|author', 'permission:create-news|update-news|delete-news|news', 'only' => ['store', 'update', 'destroy', 'index']]);

        // $this->middleware('role:admin|author');

        // $this->middleware('permission:news', ['only' => ['index']]);
        // $this->middleware('permission:create-news', ['only' => ['store']]);
        // $this->middleware('permission:update-news', ['only' => ['update']]);
        // $this->middleware('permission:delete-news', ['only' => ['destroy']]);

        $this->middleware('role:admin|author', ['only' => ['store', 'update', 'destroy']]);
        $this->middleware('permission:news', ['only' => ['index']]);

        //role middleware
        // $this->middleware('role_or_permission:admin||author');
        // $this->middleware('role:user')->only(['index']);


        //permission middleware
        // $this->middleware('permission:news.create||news.update||news.delete||news');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all news with comments
        $news = News::with('comment')->get();

        if ($news) {
            //event listener
            event(new GetEvent($news));
        }

        return NewsResource::collection($news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        //validate request
        $validated = $request->validated();

        //create news
        $news = News::create($validated);

        //event listener
        if ($news) {
            event(new CreatedEvent($news));
        }

        //return news with resource
        return new NewsResource($news);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get news with comments
        $news = News::with('comment')->find($id);

        //return news with resource
        return new NewsResource($news);
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
        //validate request
        $validated = $request->validated();

        //get news
        $news = News::find($id);

        if (!$news) {
            return response()->json([
                'message' => 'News not found'
            ], 404);
        }

        //update news
        $update = $news->update($validated);

        if ($update) {
            //event listener
            event(new UpdatedEvent($news));
        }
        //return news with resource
        return new NewsResource($news);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get news
        $news = News::find($id);

        if (!$news) {
            return response()->json([
                'message' => 'News not found'
            ], 404);
        }

        //delete news
        $delete = $news->delete();

        if ($delete) {
            //event listener
            event(new DeletedEvent($news));
        }

        //return news with resource
        return new NewsResource($news);
    }
}
