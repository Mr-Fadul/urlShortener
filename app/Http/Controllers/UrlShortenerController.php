<?php

namespace App\Http\Controllers;

use App\Models\UrlShortener;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UrlShortenerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, UrlShortener $urlShort)
    {
        $urls =  $urlShort->paginate(10);       
        return view('urls.urlList', compact('urls'));
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
    public function store(Request $request, UrlShortener $urlShort)
    {       
        $urlShort->url = $request->url;
        $urlShort->shortUrl = $request->urlName?? $urlShort->encurtarUrl();
        $urlShort->lifeTime = ($request->lifeTime)? now()->addDays($request->lifeTime) : now()->addDays(7);
        try {
           $urlShort->save();
        }catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
       
        $response = [
          'id' => $urlShort->id,
          'url' => $urlShort->url,
          'shortUrl' => url('/'.$urlShort->shortUrl),
          'lifetime' => $urlShort->lifeTime->diffInDays(now())
        ];

        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UrlShortener  $urlShortener
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, UrlShortener $urlShortener)
    {       
        $url = $urlShortener->where(['shortUrl' => $request->short])->first();
        if($url && (now()->diffInDays($url->lifeTime, false) > 0)){            
            return redirect($url->url);
        }else{
            return abort(404);
        }
        // $data = date('2021-01-31'); 
        // $data = date('Y-m-d 00:00:00', strtotime(date($data) . ' +1 month'));
        // return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UrlShortener  $urlShortener
     * @return \Illuminate\Http\Response
     */
    public function edit(UrlShortener $urlShortener)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UrlShortener  $urlShortener
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UrlShortener $urlShortener)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UrlShortener  $urlShortener
     * @return \Illuminate\Http\Response
     */
    public function destroy(UrlShortener $urlShortener)
    {
        //
    }
}
