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

        $param = [
            'typeSms' => $typeSms
        ];
        return view('typeSms.index', $param);
    }

    public function showSaveForm()
    {
        return view('typeSms.save');
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $typeSms = TypeSMS::create([
            'libelle' => $request->libelle,
        ]);

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
            'libelle' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $typeSms = TypeSMS::where('id', $id)->first();

        if($typeSms==null) return redirect()->back();

        $typeSms->libelle = $request->libelle;
        $typeSms->save();

        return redirect()->back();
    }
}
