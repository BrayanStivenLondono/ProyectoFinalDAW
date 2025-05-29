<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LikeController extends Controller
{
    public function toggleLike($obraId)
    {
        $user = Auth::user();
        $obra = Obra::findOrFail($obraId);

        if ($user->likes()->where('obra_id', $obraId)->exists()) {
            $user->likes()->detach($obraId);
        } else {
            $user->likes()->attach($obraId);
        }

        $user->load('likes');

        return back();
    }

}
