<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use App\Models\Professeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfesseurController extends Controller
{
    public function index()
    {
        $professeur = Professeur::with('matiere')->latest()->get();
        $title = 'Professeur';

        $param = [
            'professeur' => $professeur,
            'title' => $title
        ];

        return view('professeur.index', $param);
    }

    public function showSaveForm()
    {
        $title = 'Professeur';
        $matieres = Matiere::oldest('nom')->get();

        $param = [
            'title' => $title,
            'matieres' => $matieres,
        ];

        return view('professeur.save', $param);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'matiere' => 'required|numeric',
            'nom' => 'required',
            'prenoms' => 'required',
            'contact' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $professeur = Professeur::create([
            'matiere_id' => $request->matiere,
            'nom' => $request->nom,
            'prenoms' => $request->prenoms,
            'contact' => $request->contact,
        ]);

        $professeur->save();

        $request->session()->flash('ess-msg', "Le actualité à été ajoutée");

        return redirect()->route('professeur.all');
    }

    public function showUpdateForm(int $id)
    {
        $professeur = Professeur::where('id', $id)->first();
        $matieres = Matiere::oldest('nom')->get();
        $title = 'Professeur';

        $param = [
            'professeur' => $professeur,
            'title' => $title,
            'matieres' => $matieres
        ];

        return view('professeur.update', $param);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dataID' => 'required|numeric',
            'matiere' => 'required|numeric',
            'nom' => 'required',
            'prenoms' => 'required',
            'contact' => 'required',
        ]);

        if ($validator->fails()) {
            dd($request->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $professeur = Professeur::where('id', $request->dataID)->first();

        if($professeur==null) return redirect()->back();

        $professeur->nom = $request->nom;
        $professeur->prenoms = $request->prenoms;
        $professeur->contact = $request->contact;
        $professeur->matiere_id = $request->matiere;

        $professeur->save();

        return redirect()->back();
    }

    public function delete(int $id)
    {
        $professeur = Professeur::where('id', $id)->first();
        if($professeur==null) return redirect()->back();

        $professeur->delete();
        return redirect()->back();
    }
}
