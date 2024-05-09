<?php

namespace App\Domain\AddedVideo;

interface AddedVideoRepositoryInterface
{
    /**
     * @param string $id
     * @param string $videoName
     * @param \DateTime $recordDate
     * @return mixed
     */
    public function addAddedVideo(string $id, string $videoName, \DateTime $recordDate);
}
