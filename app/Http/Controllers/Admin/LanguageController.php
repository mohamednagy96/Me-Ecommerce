<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LanguageRequest;
use App\Models\Language;
use Exception;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages=Language::paginate(PAGINATION_COUNT);
        return view('admin.pages.languages.index',compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.languages.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LanguageRequest $request)
    {
        // Language::create($request->except(['_token']));
        try{
            $requests=$request->all();
            if(! isset($requests['active'])){
                $requests['active'] = 0 ;
            };
            Language::create($requests);
            return redirect()->route('admin.languages.index')->with(['success'=>'تم الادخال بنجاح']);
        }catch(Exception $e){
            return redirect()->route('admin.languages.index')->with(['error'=>'حدث خطا ما ... الرجاء اعاده المحاوله لاحقا  ']);

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
        $language=Language::findOrfail($id);
        if(! $language){
            return redirect()->route('admin.languages.index')->with(['error'=>'  هذه اللغه غير موجوده      ']);

        }
        return view('admin.pages.languages.edit',compact('language'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LanguageRequest $request, $id)
    {
            // $request=$request->all();

        try{
            if(! $request->has('active')){
                $request->request->add(['active' => 0]);
            }
            // $requests=$request->all();
            // if(! isset($requests['active'])){
            //     $requests['active'] = 0 ;
            // };
            $landuage=Language::findOrfail($id);
            $landuage->update($request->all());
            return redirect()->route('admin.languages.index')->with(['success'=>'تم الادخال بنجاح']);
          }catch(Exception $e){
             return redirect()->route('admin.languages.index')->with(['error'=>'حدث خطا ما ... الرجاء اعاده المحاوله لاحقا  ']);
    }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $language=Language::findOrfail($id);
        
        if(! $language){
            return redirect()->route('admin.languages.index')->with(['error'=>'  هذه اللغه غير موجوده      ']);

        }
        $language->delete();
        return redirect()->route('admin.languages.index')->with(['success'=>'تم الحذف بنجاح']);
        
    }
}
