<?php

namespace App\Http\Controllers;

use App\Models\_Parent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParentController extends Controller
{
    public function index()
    {
        $parent = _Parent::latest()->get();
        $title = 'Parent';

        $param = [
            'parent' => $parent,
            'title' => $title
        ];
        return view('parent.index', $param);
    }

    public function showSaveForm()
    {
        $title = 'Parent';

        $param = [
            'title' => $title
        ];
        return view('parent.save', $param);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'prenoms' => 'required',
            'contact' => 'required',
            'adresse' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $parent = _Parent::create([
            'nom' => $request->nom,
            'prenoms' => $request->prenoms,
            'contact' => $request->contact,
            'adresse' => $request->adresse,
            'email' => $request->email,
        ]);

        $parent->save();

        $request->session()->flash('ess-msg', "Le actualité à été ajoutée");

        return redirect()->route('parent.all');
    }

    public function showUpdateForm(int $id)
    {
        $parent = _Parent::where('id', $id)->first();

        $param = [
            'parent' => $parent
        ];

        return view('parent.update', $param);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dataID' => 'required|numeric',
            'nom' => 'required',
            'prenoms' => 'required',
            'contact' => 'required',
            'adresse' => 'required',
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $parent = _Parent::where('id', $request->dataID)->first();

        if($parent==null) return redirect()->back();

        $parent->nom = $request->nom;
        $parent->prenoms = $request->prenoms;
        $parent->contact = $request->contact;
        $parent->adresse = $request->adresse;
        $parent->email = $request->email;

        $parent->save();

        return redirect()->back();
    }

    public function delete(int $id)
    {
        $parent = _Parent::where('id', $id)->first();
        if($parent==null) return redirect()->back();

        $parent->delete();

        return redirect()->back();
    }
}
