<?php

namespace App\Consumers;

use Enqueue\RdKafka\RdKafkaConnectionFactory;
use Illuminate\Support\Facades\Log;
use function Psy\debug;

class KafkaConsumer
{
//    public function getVideo(){
//
//        $connectionFactory = new RdKafkaConnectionFactory([
//            'global' => [
//                'group.id' => 'qqq',
//                'metadata.broker.list' => '89.108.99.73:9092',
//                'enable.auto.commit' => 'false',
//            ],
//            'topic' => [
//                'auto.offset.reset' => 'beginning',
//            ],
//        ]);
//
//     //   dd(json_encode($connectionFactory));
//
//        $context = $connectionFactory->createContext();
//
//    //    dd(json_encode($context));
//
//        $fooQueue = $context->createQueue('foo');
//
//        $consumer = $context->createConsumer($fooQueue);
//
//        $message = $consumer->receive();
//
//        Log::debug(json_encode($message));
//
//        $consumer->acknowledge($message);
//    }

    public function getVideo(){
        $conf = new \RdKafka\Conf();

// Set the group id. This is required when storing offsets on the broker
        $conf->set('group.id', 'myConsumerGroup');

// Emit EOF event when reaching the end of a partition
        $conf->set('enable.partition.eof', 'true');

        $rk = new \RdKafka\Consumer($conf);
        $rk->addBrokers("89.108.99.73:9092");

        $topicConf = new \RdKafka\TopicConf();
        $topicConf->set('auto.commit.interval.ms', 100);

// Set the offset store method to 'file'
        $topicConf->set('offset.store.method', 'broker');

// Alternatively, set the offset store method to 'none'
// $topicConf->set('offset.store.method', 'none');

// Set where to start consuming messages when there is no initial offset in
// offset store or the desired offset is out of range.
// 'earliest': start from the beginning
        $topicConf->set('auto.offset.reset', 'earliest');

        $topic = $rk->newTopic("test", $topicConf);

// Start consuming partition 0
        $topic->consumeStart(0, RD_KAFKA_OFFSET_STORED);

        while (true) {
            $message = $topic->consume(0, 120*10000);
            switch ($message->err) {
                case RD_KAFKA_RESP_ERR_NO_ERROR:
                    Log::debug(json_encode($message));
                    var_dump($message);
                    break;
                case RD_KAFKA_RESP_ERR__PARTITION_EOF:
                    echo "No more messages; will wait for more\n";
                    break;
                case RD_KAFKA_RESP_ERR__TIMED_OUT:
                    echo "Timed out\n";
                    break;
                default:
                    throw new \Exception($message->errstr(), $message->err);
                    break;
            }
        }
    }

}
