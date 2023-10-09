<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsenceSendController extends Controller
{
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
}
