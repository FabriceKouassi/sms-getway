<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModeleAbsenceRequest;
use App\Models\ModeleAbsence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModeleAbsenceController extends Controller
{
    public function index()
    {
        $modele = ModeleAbsence::latest()->get();
        $title = 'Modèle d\'absence';

        $param = [
            'modele' => $modele,
            'title' => $title
        ];
        return view('modele.index', $param);
    }

    public function showSaveForm()
    {
        $title = 'Modèle d\'absence';
        $param = [
            'title' => $title
        ];

        return view('modele.save', $param);
    }

    public function save(ModeleAbsenceRequest $request)
    {
        $data = $request->validated();

        $modele = ModeleAbsence::create($data);

        $modele->save();

        $request->session()->flash('ess-msg', "Le actualité à été ajoutée");

        return redirect()->route('modele.all');
    }

    public function showUpdateForm(int $id)
    {
        $modele = ModeleAbsence::where('id', $id)->first();
        $title = 'Type de l\'annonce';

        $param = [
            'modele' => $modele,
            'title' => $title
        ];

        return view('modele.update', $param);
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

        $modele = ModeleAbsence::where('id', $request->dataID)->first();

        if($modele==null) return redirect()->back();

        $modele->libelle = $request->libelle;
        $modele->save();

        return redirect()->back();
    }

    public function delete(int $id)
    {
        $modele = ModeleAbsence::where('id', $id)->first();
        if($modele==null) return redirect()->back();

        $modele->delete();
        return redirect()->back();
    }
}
