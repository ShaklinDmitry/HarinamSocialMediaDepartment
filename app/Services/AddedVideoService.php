<?php

namespace App\Services;


use App\Domain\AddedVideo\AddedVideoRepositoryInterface;

class AddedVideoService implements AddedVideoServiceInterface
{

    /**
     * @param AddedVideoRepositoryInterface $addedVideoRepository
     */
    public function __construct(private AddedVideoRepositoryInterface $addedVideoRepository)
    {
    }

    /**
     * @param string $id
     * @param string $videoName
     * @param \DateTime $recordDate
     * @return mixed|void
     */
    public function addAddedVideo(string $id, string $videoName, \DateTime $recordDate)
    {
        $this->addedVideoRepository->addAddedVideo($id, $videoName, $recordDate);
    }
}
