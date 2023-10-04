<?php

namespace App\Http\Controllers;

use App\Models\_Parent;
use App\Models\Classe;
use App\Models\Eleve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EleveController extends Controller
{
    public function index()
    {
        $eleve = Eleve::with(['classe', '_parent'])->latest()->get();
        $title = 'Eleve';

        $param = [
            'eleve' => $eleve,
            'title' => $title
        ];

        return view('eleve.index', $param);
    }

    public function showSaveForm()
    {
        $title = 'Eleve';
        $parent = _Parent::oldest('nom')->get();
        $classe = Classe::oldest('nom')->get();

        $param = [
            'title' => $title,
            'parent' => $parent,
            'classe' => $classe,
        ];

        return view('eleve.save', $param);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'matricule' => 'required',
            'nom' => 'required',
            'prenoms' => 'required',
            'contact' => 'required',
            'parent' => 'required|numeric',
            'classe' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $eleve = Eleve::create([
            'parent_id' => $request->parent,
            'classe_id' => $request->classe,
            'nom' => $request->nom,
            'prenoms' => $request->prenoms,
            'contact' => $request->contact,
            'matricule' => $request->matricule,
        ]);

        $eleve->save();

        $request->session()->flash('ess-msg', "Le actualité à été ajoutée");

        return redirect()->route('eleve.all');
    }

    public function showUpdateForm(int $id)
    {
        $eleve = Eleve::where('id', $id)->first();
        $parent = _Parent::oldest('nom')->get();
        $classe = Classe::oldest('nom')->get();
        $title = 'Eleve';

        $param = [
            'eleve' => $eleve,
            'title' => $title,
            'parent' => $parent,
            'classe' => $classe
        ];

        return view('eleve.update', $param);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'matricule' => 'required',
            'nom' => 'required',
            'prenoms' => 'required',
            'contact' => 'required',
            'parent' => 'required|numeric',
            'classe' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $eleve = Eleve::where('id', $request->dataID)->first();

        if($eleve==null) return redirect()->back();

        $eleve->parent_id = $request->parent;
        $eleve->classe_id = $request->classe;
        $eleve->nom = $request->nom;
        $eleve->prenoms = $request->prenoms;
        $eleve->contact = $request->contact;
        $eleve->matricule = $request->matricule;

        $eleve->save();

        return redirect()->back();
    }

    public function delete(int $id)
    {
        $eleve = Eleve::where('id', $id)->first();
        if($eleve==null) return redirect()->back();

        $eleve->delete();
        return redirect()->back();
    }
}
