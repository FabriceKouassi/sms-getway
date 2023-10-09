<?php

namespace App\Http\Controllers;

use App\Mail\AnnonceMail;
use App\Models\_Parent;
use App\Models\AnnonceSend;
use App\Models\TypeSMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AnnonceSendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $annonce_en_attente = AnnonceSend::with(['parent', 'sms'])->latest()->where('status', 0)->get();
        $annonce_envoyee = AnnonceSend::with(['parent', 'sms'])->latest()->where('status', 1)->get();
        $title = 'Annonce';

        $param = [
            'annonce_en_attente' => $annonce_en_attente,
            'annonce_envoyee' => $annonce_envoyee,
            'title' => $title
        ];

        return view('annonce_send.index', $param);
    }

    public function sendAnnonceByMail(Request $request)
    {
        $query = AnnonceSend::query()->with(['parent', 'sms'])->where('status', 0)->get();

        foreach ($query as $q) {
            Mail::to($q->parent->email)->send(new AnnonceMail([
                $q->sms->message,
            ]));

            $status = AnnonceSend::where('id', $q->id)->first();
            $status->status = 1;
            $status->save();
        }

        return redirect()->back();
    }

    public function showSaveForm()
    {
        $title = 'Annonce';
        $typeSMS = TypeSMS::query()->with('sms')->get()->filter(fn ($typeSMS) => $typeSMS->sms()->count() > 0);
        $parents = _Parent::oldest('nom')->get();

        $param = [
            'title' => $title,
            'typeSMS' => $typeSMS,
            'parents' => $parents,
        ];

        return view('annonce_send.save', $param);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'typeSMS' => 'required|numeric',
            'titre' => 'required',
            'parents' => 'required',
        ]);


        $typeSMS = $request->typeSMS;
        $titre = $request->titre;
        $details = $request->details;
        $parents = $request->parents;


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        foreach ($parents as $parent) {
            $annonce_send = AnnonceSend::create([
                'titre' => $titre,
                'details' => $details,
                'sms_id' => $typeSMS,
                'parent_id' => $parent,
            ]);
        }



        $annonce_send->save();

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
