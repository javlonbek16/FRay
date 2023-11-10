<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getMessage()
    {
        $messages = Messages::with('veneues', 'artists')->orderBy("created_at", "desc")->paginate(10);
        return $messages;
    }

}
