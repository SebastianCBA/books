<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;

use Image;
use File;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchorinsert(request $request)
    {
     
     $book =  Book::Where('isbn', $request->isbn)->get();
     
     if(count($book) == 0)
     {
        $this->store($request);
     }
   
    }

    public function crop($url)
    {
        $file = $url;
       
        $file = Image::make($file)->fit(400)->crop(200,400)->encode('jpg');
        $image = 'cover_' . time() . '.jpg';
        $name = 'storage/'.date('Y').'/'.date('m').'/'.date('d').'/'.$image;
        $path = public_path('storage/'.date('Y').'/'.date('m').'/'.date('d').'/');
        if(!File::isDirectory($path))
            {
            File::makeDirectory($path, 0755, true);
            }        
        $file->save($path.$image);
        return $name;
    }

    public function index()
    {
    return view('books');
    }

    public function books()
    {
        $book = new Book();
        $books =  $book->paginate(100);
        return response()->json($books);
    }   
     
    public function getbooks($key)
    {
        $books = new Book();
        $books =  $books
                    ->whereRaw('title like "%'.$key.'%"')
                    ->orwhereRaw('isbn like "%'.$key.'%"')
                    ->paginate(100);
        return response()->json($books);        
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
    public function store(Request $request)
    {
        $book = new Book;
        $book->isbn = $request->isbn;
        $book->title = $request->title;
        $book->image = '';
        if(strlen($request->image))
            {
            $img = $this->crop($request->image);
            $book->image = $img;
            }
        $book->description = $request->description;
        $book->save();
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
