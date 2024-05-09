<?php

namespace App\Services;

interface AddedVideoServiceInterface
{
    /**
     * @param string $id
     * @param string $videoName
     * @param \DateTime $recordDate
     * @return mixed
     */
    public function addAddedVideo(string $id, string $videoName, \DateTime $recordDate);
}
