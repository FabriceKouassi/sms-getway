<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasseRequest;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClasseController extends Controller
{
    public function index()
    {
        $classe = Classe::latest()->get();
        $title = 'Classe';

        $param = [
            'classe' => $classe,
            'title' => $title
        ];
        return view('classe.index', $param);
    }

    public function showSaveForm()
    {
        $title = 'Classe';

        $param = [
            'title' => $title
        ];
        return view('classe.save', $param);
    }

    public function save(ClasseRequest $request)
    {
        $data = $request->validated();

        $classe = Classe::create($data);

        $classe->save();

        $request->session()->flash('ess-msg', "Le actualité à été ajoutée");

        return redirect()->route('classe.all');
    }

    public function showUpdateForm(int $id)
    {
        $classe = Classe::where('id', $id)->first();
        $title = 'Classe';

        $param = [
            'classe' => $classe,
            'title' => $title
        ];

        return view('classe.update', $param);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dataID' => 'required|numeric',
            'nom' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $classe = Classe::where('id', $request->dataID)->first();

        if($classe==null) return redirect()->back();

        $classe->nom = $request->nom;
        $classe->save();

        return redirect()->back();
    }

    public function delete(int $id)
    {
        $classe = Classe::where('id', $id)->first();
        if($classe==null) return redirect()->back();

        $classe->delete();
        return redirect()->back();
    }
}
