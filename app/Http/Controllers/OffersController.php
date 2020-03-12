<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Offer;

class OffersController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'offer_content'  => 'required|max:2000',
        ]);

        $request->user()->offers()->create([
            'offer_content' => $request->offer_content,
            'user_id' => \Auth::User()->id,
            'user_of_handled' => 1,
        ]);

        return redirect('/resources');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $offer = Offer::find($id);

            $offer->delete();

            return back();
    }
}
