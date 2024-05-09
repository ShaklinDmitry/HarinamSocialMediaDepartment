<?php

namespace App\Repositories;

use App\Domain\AddedVideo\AddedVideoRepositoryInterface;
use App\Models\AddedVideoEloquent;

class AddedVideoRepository implements AddedVideoRepositoryInterface
{

    /**
     * @param string $id
     * @param string $videoName
     * @param \DateTime $recordDate
     * @return mixed|void
     */
    public function addAddedVideo(string $id, string $videoName, \DateTime $recordDate)
    {
        AddedVideoEloquent::create([
            'id' => $id,
            'video_name' => $videoName,
            'record_date' => $recordDate
        ]);
    }
}
