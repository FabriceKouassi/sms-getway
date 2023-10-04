<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeAnnonceRequest;
use App\Models\TypeAnnonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeAnnonceController extends Controller
{
    public function index()
    {
        $typeAnnonce = TypeAnnonce::latest()->get();
        $title = 'Type de l\'annonce';

        $param = [
            'typeAnnonce' => $typeAnnonce,
            'title' => $title
        ];
        return view('typeAnnonce.index', $param);
    }

    public function showSaveForm()
    {
        $title = 'Type de l\'annonce';
        $param = [
            'title' => $title
        ];

        return view('typeAnnonce.save', $param);
    }

    public function save(TypeAnnonceRequest $request)
    {
        $data = $request->validated();

        $typeAnnonce = TypeAnnonce::create($data);

        $typeAnnonce->save();

        $request->session()->flash('ess-msg', "Le actualité à été ajoutée");

        return redirect()->route('typeAnnonce.all');
    }

    public function showUpdateForm(int $id)
    {
        $typeAnnonce = TypeAnnonce::where('id', $id)->first();
        $title = 'Type de l\'annonce';

        $param = [
            'typeAnnonce' => $typeAnnonce,
            'title' => $title
        ];

        return view('typeAnnonce.update', $param);
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

        $typeAnnonce = TypeAnnonce::where('id', $request->dataID)->first();

        if($typeAnnonce==null) return redirect()->back();

        $typeAnnonce->libelle = $request->libelle;
        $typeAnnonce->save();

        return redirect()->back();
    }

    public function delete(int $id)
    {
        $typeAnnonce = TypeAnnonce::where('id', $id)->first();
        if($typeAnnonce==null) return redirect()->back();

        $typeAnnonce->delete();
        return redirect()->back();
    }
}
