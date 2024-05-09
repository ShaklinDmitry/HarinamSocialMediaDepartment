<?php

namespace App\Console\Commands;

use App\Consumers\AddedVideoConsumer;
use App\Consumers\AddedVideoConsumerInterface;
use Illuminate\Console\Command;

class StartAddedVideoConsumer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start-added-video-consumer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(AddedVideoConsumerInterface $addedVideoConsumer)
    {
        $addedVideoConsumer->getVideo();
    }
}
