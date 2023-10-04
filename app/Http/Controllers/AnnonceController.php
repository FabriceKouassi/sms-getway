<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\TypeAnnonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnnonceController extends Controller
{
    public function index()
    {
        $annonce = Annonce::with('typeAnnonce')->latest()->get();
        $title = 'Annonce';

        $param = [
            'annonce' => $annonce,
            'title' => $title
        ];

        return view('annonce.index', $param);
    }

    public function showSaveForm()
    {
        $title = 'Annonce';
        $typeAnnonce = TypeAnnonce::oldest('libelle')->get();

        $param = [
            'title' => $title,
            'typeAnnonce' => $typeAnnonce,
        ];

        return view('annonce.save', $param);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'annonce' => 'required|numeric',
            'description' => 'required',
            'titre' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $annonce = Annonce::create([
            'typeannonce_id' => $request->annonce,
            'description' => $request->description,
            'titre' => $request->titre,
        ]);

        $annonce->save();

        $request->session()->flash('ess-msg', "Le actualité à été ajoutée");

        return redirect()->route('annonce.all');
    }

    public function showUpdateForm(int $id)
    {
        $annonce = Annonce::where('id', $id)->first();
        $typeAnnonce = TypeAnnonce::oldest('libelle')->get();
        $title = 'Annonce';

        $param = [
            'annonce' => $annonce,
            'title' => $title,
            'typeAnnonce' => $typeAnnonce
        ];

        return view('annonce.update', $param);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'annonce' => 'required|numeric',
            'description' => 'required',
            'titre' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $annonce = Annonce::where('id', $request->dataID)->first();

        if($annonce==null) return redirect()->back();

        $annonce->typeannonce_id = $request->annonce;
        $annonce->description = $request->description;
        $annonce->titre = $request->titre;
        $annonce->save();

        return redirect()->back();
    }

    public function delete(int $id)
    {
        $annonce = Annonce::where('id', $id)->first();
        if($annonce==null) return redirect()->back();

        $annonce->delete();
        return redirect()->back();
    }
}
