<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function show(Request $request, $interventionId)
    {
        if (! $request->hasValidSignature()) {
            abort(403, 'Invalid signature.');
        }

        $intervention = Intervention::findOrFail($interventionId);

        // Vérifier si un feedback a déjà été soumis
        if ($intervention->feedback) {
            return redirect()->route('feedback.thankyou');
        }

        return view('feedback', compact('intervention'));
    }

    public function submit(Request $request, $interventionId)
    {
   

        $intervention = Intervention::findOrFail($interventionId);

        // Vérifier si un feedback a déjà été soumis
        if ($intervention->feedback) {
            return redirect()->route('feedback.thankyou');
        }

        // Valider et enregistrer le feedback
        $request->validate([
            'feedback' => 'required|string|max:255',
        ]);

        $intervention->feedback = $request->input('feedback');
        $intervention->save();

        return redirect()->route('feedback.thankyou');
    }

    public function thankyou()
    {
        return view('thankyou');
    }
}
