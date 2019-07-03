<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use Illuminate\Http\Request;

class FactorController extends Controller
{
    public function approve($id,Request $r)
    {
        $sent = $r->sent;
        $factor = Factor::find($id);
        $update = $factor->update([
            'sent' => $sent
        ]);
        return $factor->sent;
   }
}
