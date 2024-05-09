<?php

namespace App\Consumers;

use App\Services\AddedVideoServiceInterface;
use DateTime;
use Illuminate\Support\Facades\Log;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

class AddedVideoConsumer implements AddedVideoConsumerInterface
{

    public function __construct(private AddedVideoServiceInterface $addedVideoService)
    {
    }

    public function getVideo()
    {
        $connection = new AMQPStreamConnection(env('RABBITMQ_HOST'), env('RABBITMQ_POST'), env('RABBITMQ_USER'), env('RABBITMQ_PASSWORD'), env('RABBITMQ_VHOST'));
        $channel = $connection->channel();

        $channel->exchange_declare('video', 'direct', false, true, false);

        list($queue1, ,) = $channel->queue_declare("queue1", false, true, false, false);

        $channel->queue_bind($queue1, 'video', 'videoAddedToSocialMediaDepartment');

        echo " [*] Waiting for logs. To exit press CTRL+C\n";

        $callback1 = function ($msg) use ($channel) {

        try
        {
            Log::debug('video consumed');
            Log::debug($msg->getBody());
            $message = json_decode($msg->getBody());

            $recordDate = DateTime::createFromFormat('Y-m-d H:i:s', $message->recordDate);

            Log::debug($message->id);
            Log::debug($message->videoName);
            Log::debug(json_encode($recordDate));

            $this->addedVideoService->addAddedVideo($message->id, $message->videoName, $recordDate);

            $msg->ack();

        } catch (\Throwable $e)
        {
            if ($msg->get('application_headers')->getNativeData()['count-of-retries'] < 5)
            {
                $data = $msg->getBody();
                $resendMsg = new AMQPMessage($data);

                Log::debug($e);
                Log::debug($msg->get('application_headers')->getNativeData());

                $headers = new AMQPTable();
                $headers->set('count-of-retries', $msg->get('application_headers')->getNativeData()['count-of-retries'] + 1);
                $resendMsg->set('application_headers', $headers);

                Log::debug('msg republished');
                $channel->basic_publish($resendMsg, 'video', 'videoAddedToSocialMediaDepartment');

            }
        }
        };

        $channel->basic_consume($queue1, '', false, false, false, false, $callback1);


        register_shutdown_function(function ($channel, $connection) {
            $channel->close();
            $connection->close();
        }, $channel, $connection
        );

        try
        {
            $channel->consume();
        } catch (\Throwable $exception)
        {
            echo $exception->getMessage();
        }

    }
}
