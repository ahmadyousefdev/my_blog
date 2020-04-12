<?php

namespace App\Http\Controllers;

use App\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
class ArticleController extends Controller
{

    protected function validator (array $data) {
        return Validator:: make($data,[
            'title' => 'required',
            'body' => 'required'
        ]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::paginate(20);
        return view('welcome')->with('articles',$articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. validation Title, Body
        $this->validator($request->all())->validate();
        // 2. add to database.

        // 1. get file from form
        $file = $request->file('thumbnail');
        // 2. name the file
        $time = Carbon::now();
        $directory = date_format($time,'Y').'/'.date_format($time,'m');
        $fileName = date_format($time,'h').date_format($time,'s').rand(1,9).'.'.$file->extension();
        // 3. upload 
        Storage::disk('public')->putFileAs($directory,$file,$fileName);
        $article = Article::create([
            'body' => $request->body,
            'title' => $request->title,
            'thumbnail' => $directory.'/'.$fileName,
        ]);
        // 3. return to another page.
        $request->session()->flash('message','تم إضافة المقالة بنجاح');
        return redirect()->route('admin_index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article=Article::where('id',$id)->firstOrFail();
        return view('article')->with('article',$article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article=Article::where('id',$id)->firstOrFail();
        return view('admin.edit')->with('article',$article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article=Article::where('id',$id)->firstOrFail();

        $article->update([
            'body' => $request->body,
            'title' => $request->title,
        ]);

        if($request->file('thumbnail'))
        {
            // 1. get file from form
            $file = $request->file('thumbnail');
            // 2. name the file
            $time = Carbon::now();
            $directory = date_format($time,'Y').'/'.date_format($time,'m');
            $fileName = date_format($time,'h').date_format($time,'s').rand(1,9).'.'.$file->extension();
            // 3. upload 
            Storage::disk('public')->putFileAs($directory,$file,$fileName);
            $article->thumbnail = $directory.'/'.$fileName;
            $article->save();
        }
        

        
        $request->session()->flash('message','تم تعديل المقالة بنجاح');
        return redirect()->route('admin_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
