<?php

namespace App\Utility;

use App\Http\Interfaces\ShowInterface;
use App\Models\Messages;

trait CheckIsComplate
{
    private $showRepository;

    public function __construct(ShowInterface $showRepository)
    {
        $this->showRepository = $showRepository;
    }

    public function checkIsComplate($value, array $showData)
    {
        $user = auth()->user();
        $roleType = $user->role_type;
        $stDate = $showData['start_date'];
        $venue_id = $user->venue->id ?? null;

        if ($value) {
            $shows = $value->shows;

            foreach ($shows as $show) {
                $isComplete = $show->is_complete;
                $end_date = $show->end_date;
                $start_date = $show->start_date;
            }

            if ($isComplete == 1) {
                return $this->showRepository->createShow($showData);
            } elseif ($isComplete != 1 && $end_date <= $showData['start_date'] && $showData['end_date'] >= $start_date) {
                if ($roleType === 'venue') {
                    $artist_id = $showData['artist_id'];
                    $showData['topic'] = "Dear Singer { $artist_id }";
                } elseif ($roleType === 'artist') {
                    $artist_id = $showData['artist_id'] = $user->artist->id;
                    $venue_id = $showData['venue_id'] ?? null;

                    $showData['topic'] = "Dear Club director { $venue_id }";
                }

                return Messages::create([
                    'venue_id' => $venue_id,
                    'artist_id' => $artist_id,
                    'topic' => $showData['topic'],
                ]);
            }
        }
    }
}