<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class IndexController extends Controller
{
    protected $hl;
	protected $td;

	public function _construct(){
		$this->hl ="Hello, Tudor!";
		$this->td ="This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.";
	}
	public function index(){
    	
    	$articles=Article::select(['id','title','description'])->get();
    	
    	return view('index')->with(['hl'=>$this->hl,
    		                        'td'=>$this->td,
    		                        'articles'=>$articles]);
    }
	

	public function show($id){
	$article=Article::select(['id','title','text'])->where('id',$id)->first();
	return view('article-content')->with(['hl'=>$this->hl,'td'=>$this->td,'article'=>$article]);

    
	}
	public function add(){
		return view('add-content')->with(['hl'=> $this->hl,'td'=>$this->td]);
	}
	public function store(Request $request){
		$this->validate($request,['title'=>'required | max:50',
	                              'description'=>'required | max:200',
	                              'text'=>'required']);
		$data = $request->all();
		$article = new Article;
		$article ->fill($data);
		$article ->save();

		return redirect('/');
	}
}