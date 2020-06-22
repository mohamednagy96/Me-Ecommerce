<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MainCategoryRequest;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $default_lang = Config::get('app.locale');        
        $categories=MainCategory::where('translation_lang',$default_lang)->paginate(PAGINATION_COUNT);
        return view('admin.pages.maincategories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.maincategories.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MainCategoryRequest $request)
    {
    try{
        $filePath="";
        if($request->has('photo')){
                $filePath=uploadImage('maincategories',$request->photo);
        }
        // dd('ss');
        // return $request->all();
        $main_category=collect($request->category);
        $filter=$main_category->filter(function($item,$key){
        //to get first item to save it in database by default language in website
            return $item['abbr'] == get_defualt_lang();
        });
        // $default_category = array_values($filter->all()) [0];
         $default_category = $filter->first();
   

    DB::beginTransaction();
         //to get id after make store
         $defualt_cat_id=MainCategory::insertGetId([
            'translation_lang'=>$default_category['abbr'],
            'translation_of'=>0,
            'name'=>$default_category['name'],
            'slug'=>$default_category['name'],
            'photo'=>$filePath,
        ]);

            //to get all categories that equal the same product but it is deffernet in language (not arabic)
         $categories=$main_category->filter(function($item,$key){
            //to get first item to save it in database by default language in website
            // dd(get_defualt_lang()); 
            return $item['abbr'] != get_defualt_lang();
            });
            if(isset($categories) && $categories->count())
            $categories_arr=[];
              foreach($categories as $category){
                  $categories_arr[]=[
                      'translation_lang'=>$category['abbr'],
                      'translation_of'=>$defualt_cat_id,
                    'name'=>$category['name'],
                    'slug'=>$category['name'],
                    'photo'=>$filePath,
                  ];
                }
            MainCategory::insert($categories_arr);
    DB::commit();
    }catch(\Exception $ex){
        DB::rollBack();
    }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
