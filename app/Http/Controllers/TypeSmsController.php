<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeSmsRequest;
use App\Models\TypeSMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeSmsController extends Controller
{
    public function index()
    {
        $typeSms = TypeSMS::latest()->get();
        $title = 'Type de SMS';

        $param = [
            'typeSms' => $typeSms,
            'title' => $title
        ];
        return view('typeSms.index', $param);
    }

    public function showSaveForm()
    {
        return view('typeSms.save');
    }

    public function save(TypeSmsRequest $request)
    {
        $data = $request->validated();

        $typeSms = TypeSMS::create($data);

        $typeSms->save();

        $request->session()->flash('ess-msg', "Le actualité à été ajoutée");

        return redirect()->route('typesms.all');
    }

    public function showUpdateForm(int $id)
    {
        $typeSms = TypeSMS::where('id', $id)->first();

        $param = [
            'typeSms' => $typeSms
        ];

        return view('typeSms.update', $param);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dataID' => 'required|numeric',
            'libelle' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $typeSms = TypeSMS::where('id', $request->dataID)->first();

        if($typeSms==null) return redirect()->back();

        $typeSms->libelle = $request->libelle;
        $typeSms->save();

        return redirect()->back();
    }

    public function delete(int $id)
    {
        $typeSms = TypeSMS::where('id', $id)->first();
        if($typeSms==null) return redirect()->back();

        $typeSms->delete();
        return redirect()->back();
    }
}
