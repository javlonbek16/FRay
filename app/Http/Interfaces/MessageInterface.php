<?php

namespace App\Http\Interfaces;


interface MessageInterface
{
    public function getMessage();
    public function acceptShow($messageId);
    public function  rejectShow($messageId);
    public function  acceptedShows();
}
