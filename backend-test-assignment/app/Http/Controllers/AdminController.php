<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\File;
use App\Models\Snippet;
use App\Models\Resource;
use Symfony\Component\HttpFoundation\Response;
use Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resorces=Resource::orderBy('id', 'DESC')->with('link')->with('file')->with('snippet')->paginate(5);
        return response()->json(['message'=>'successfully return all resources','resource' => $resorces], Response::HTTP_CREATED);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'type' => 'required',
        ]);

        //insert link resource
        if($request->type == 'link'){
            $this->validate($request,[
                'newtabcheck' => 'required',
                'link' => 'required',
                'title' => 'required',
            ]);
            $newResource = new Resource();
            $newResource->type = $request->type;
            $newResource->save();

            $newLink = new Link();
            $newLink->newtabcheck = $request->newtabcheck;
            $newLink->title = $request->title;
            $newLink->link = $request->link;
            $newLink->resource_id = $newResource->id;
            $newLink->save();
            return response()->json(['result'=>true,'link' => $newLink], Response::HTTP_CREATED);
        }

        //insert file resource
        if($request->type == 'file'){
            $this->validate($request,[
                'path' => 'required',
                'title' => 'required',
            ]);
            
            if($request->path->getClientOriginalExtension() == 'pdf'){
                $newResource = new Resource();
                $newResource->type = $request->type;
                $newResource->save();
                $fileName = time().'_'.$newResource->id.'_'.$request->path->getClientOriginalName();
                $filePath = $request->file('path')->storeAs('uploads', $fileName, 'public');
                $newFile = new File();
                $newFile->title = $request->title;
                $newFile->path = $filePath;
                $newFile->resource_id = $newResource->id;
                $newFile->save();
                return response()->json(['result'=>true,'file' => $newFile], Response::HTTP_CREATED);
            }else{
                return response()->json(['typeerror'=>true,'message' => 'Please just upload pdf file']);

            }

        }

        //insert snippet resource
        if($request->type == 'snippet'){
            $this->validate($request,[
                'title' => 'required',
                'description' => 'required',
                'snippet' => 'required',
            ]);

            $newResource = new Resource();
            $newResource->type = $request->type;
            $newResource->save();

            $newSnippet = new Snippet();
            $newSnippet->snippet = $request->snippet;
            $newSnippet->title = $request->title;
            $newSnippet->description = $request->description;
            $newSnippet->resource_id = $newResource->id;
            $newSnippet->save();
            return response()->json(['result'=>true,'snippet' => $newSnippet], Response::HTTP_CREATED);
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


    public function edit()
    {
        return view('editadmin');
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePDF(Request $request, $id)
    {
        $this->validate($request,[
            'type' => 'required',
        ]);
        //update file pdf resource
        if($request->type == 'file'){
            $this->validate($request,[
                'path' => 'required',
            ]);
            $Resource =Resource::where('id',$id)->with('file')->get();
            $updatedfile =File::where('id',$Resource[0]->file->id)->get();
            if($request->path->getClientOriginalExtension() == 'pdf'){
                if(file_exists(public_path('storage').'/'.$Resource[0]->file->path)){
                    unlink(public_path('storage').'/'.$Resource[0]->file->path);
                }
                $fileName = time().'_'.$Resource[0]->id.'_'.$request->path->getClientOriginalName();
                $filePath = $request->file('path')->storeAs('uploads', $fileName, 'public');
                $updatedfile[0]->path=$filePath;
                $updatedfile[0]->save();
                return response()->json(['result'=>true,'message' => 'uploaded']);  

            }else{
                return response()->json(['typeerror'=>true,'message' => 'Please just upload pdf file']);  
            }   
            

        }
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
        $this->validate($request,[
            'type' => 'required',
        ]);

        //update file resource
        if($request->type == 'file'){
            $this->validate($request,[
                'title' => 'required',
            ]);
            $Resource =Resource::where('id',$id)->with('file')->get();
            $Resource[0]->file->title=$request->title;
            $Resource[0]->file->save();
            return response()->json(['result'=>true,'file' => $Resource[0]], Response::HTTP_CREATED);
        }

        //update link resource
        if($request->type == 'link'){
            $this->validate($request,[
                'newtabcheck' => 'required',
                'link' => 'required',
                'title' => 'required',
            ]);
            $Resource =Resource::where('id',$id)->with('link')->get();
            $updatedlink =Link::where('id',$Resource[0]->link->id)->get();
            $updatedlink[0]->newtabcheck = $request->newtabcheck;
            $updatedlink[0]->title = $request->title;
            $updatedlink[0]->link = $request->link;
            $updatedlink[0]->save();
            return response()->json(['result'=>true,'link' => $updatedlink[0]], Response::HTTP_CREATED);
        }

        //update link resource
        if($request->type == 'snippet'){
            $this->validate($request,[
                'title' => 'required',
                'description' => 'required',
                'snippet' => 'required',
            ]);

            $Resource =Resource::where('id',$id)->with('snippet')->get();
            $updatedSnippet =Snippet::where('id',$Resource[0]->snippet->id)->get();
            $updatedSnippet[0]->snippet = $request->snippet;
            $updatedSnippet[0]->title = $request->title;
            $updatedSnippet[0]->description = $request->description;
            $updatedSnippet[0]->save();
            return response()->json(['result'=>true,'snippet' => $updatedSnippet[0]], Response::HTTP_CREATED);
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
        $resource=Resource::where('id',$id)->with('file')->get();
        if($resource[0]->type == 'file'){
            if(file_exists(public_path('storage').'/'.$resource[0]->file->path)){
                unlink(public_path('storage').'/'.$resource[0]->file->path);
            }
        }
        $resource[0]->delete();
        if($resource[0]){
            return response()->json(['result'=>true,'message' => 'successfully delete  resource '.$id]);
        }else{
            return response()->json(['result'=>true,'message' => 'you have an error']);
        }

    }
}
