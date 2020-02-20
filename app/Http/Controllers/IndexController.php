<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class IndexController extends Controller
{
	public function show($id){
	$article=Article::select(['id','title','text'])->where('id',$id)->first();
	return view('article-content')->with(['td'=>$this->td,'hl'=>$this->hl,'article'=>$article]);

    protected $hl;
	protected $td;

	public function _construct(){
		$this->hl ="Hello, Tudor!";
		$this->td ="This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.";
	}


	   
    public function index(){
    	
    	$articles=Article::select(['id','title','desc'])->get();
    	//dump($articles);
    	return view('index')->with(['hl'=>$hl,
    		                        'td'=>$td,
    		                        'articles'=>$articles]);
    }
}
