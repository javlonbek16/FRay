<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\MessageInterface;

class MessageController extends Controller
{

    public function __construct(public MessageInterface $messageRepository)
    {
    }
    public function getMessage()
    {
        return $this->messageRepository->getMessage();
    }

    public function acceptShow($messageId)
    {
        return $this->messageRepository->acceptShow($messageId);
    }

    public function  rejectShow($messageId)
    {
        return $this->messageRepository->rejectShow($messageId);
    }
    public function  acceptedShows()
    {
        return $this->messageRepository->acceptedShows();
    }
}
