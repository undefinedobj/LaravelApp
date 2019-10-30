<?php

namespace App\Http\Controllers\YaCold;

use App\Models\YaCold\Line;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lines = Line::all();

        return view('ya-cold.line', ['res' => $lines]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'  => 'required',
            'price' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            //return $validator->errors();
            return back()->with('errors', $validator->errors());
        }

        $line = new Line();
        $line->name  = $request->name;
        $line->price = $request->price;
        $line->save();

        return 1;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $line = Line::find($id);

        return view('ya-cold.line-edit', compact('line'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $line = Line::where('id', $request->id)
            ->update([
                'name'  => $request->name,
                'price' => $request->price,
            ]);

        if ($line) {
            return redirect()->route('cold.lines');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $line = Line::destroy($request->id);

        return $line;
    }
}
