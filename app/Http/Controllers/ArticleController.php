<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
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
        $articles = Article::paginate(10);
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
        // $article = Article::create($request->all());
        $article = Article::create([
            'body' => $request->body,
            'title' => $request->title,
            'thumbnail' => 'loading',
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
            'title' => $request->title
        ]);
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
