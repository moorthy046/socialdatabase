<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Categories;

use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = Categories::where('active', '1')->orderBy('created_at','desc')->get();
		return  response()->json($categories);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		// if user can post i.e. user is admin or author
		if($request->user()->can_post())
		{
			$categories = Categories::where('active', '1')->orderBy('category_name','asc')->get();
			return view('categories.create')->with('categories', $categories);
		}    
		else 
		{
			return redirect('/')->withErrors('You have not sufficient permissions for writing post');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CategoryFormRequest $request)
	{
		$category = new Categories();
		$category->category_name = $request->get('categoryName');
		$category->slug = str_slug($category->category_name);
		$category->author_id = $request->user()->id;
		if($request->has('save'))
		{
			$category->active = 0;
			$message = 'Category saved successfully';            
		}            
		else 
		{
			$category->active = 1;
			$message = 'Category published successfully';
		}
		$category->save();
		return redirect('new-category/')->withMessage($message);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$category = Categories::where('slug',$slug)->first();
		if(!$category)
		{
			return redirect('/')->withErrors('requested page not found');
		}
		return view('categories.show')->withPost($category);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
