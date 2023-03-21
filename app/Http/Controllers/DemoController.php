<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpMqtt\Client\MqttClient;
use Exception;
use Illuminate\Support\Facades\Log;
use PhpMqtt\Client\ConnectionSettings;

class DemoController extends Controller
{
    public function create() 
    {
       // dd("in create");
        return view('create');
    }

    public function store(Request $request)
    {
        //dd("in store");
        //dd($request->message);

        try {
            $message = $request->message;
            //MQTT::publish('some/topic', trim($request->message));
           // MQTT::publish('some/topic', trim($request->message), false , 'public');
            $server   = 'broker.emqx.io';
            $port     = 1883;
            $clientId = rand(5, 15);
           // $username = 'emqx_user';
           // $password = 'public';
           // $clean_session = false;
           // $mqtt_version = MqttClient::MQTT_3_1_1;

            // $connectionSettings = (new ConnectionSettings)
            //     ->setUsername($username)
            //     ->setPassword($password)
            //     ->setKeepAliveInterval(60)
            //     ->setLastWillTopic('emqx/test/last-will')
            //     ->setLastWillMessage('client disconnect')
            //     ->setLastWillQualityOfService(1);

            // Create a new instance of an MQTT client and configure it to use the shared broker host and port.
            //$mqtt = new MqttClient('host', 'port=1883', 'clientid=null', 'protocol=self::MQTT_3_1', 'repository=null', 'logger=null');
            //$mqtt = new MqttClient($server, $port, $clientId,$mqtt_version);
            $mqtt = new MqttClient($server, $port, $clientId);


            // Connect to the broker without specific connection settings but with a clean session.
           //$mqtt->connect(null, true);
            $mqtt->connect();
            //$mqtt->connect($connectionSettings, $clean_session);
           // $mqtt->publish('php-mqtt/client/test', trim($request->message), 0);
            //$mqtt->publish('php-mqtt/client/test', trim($request->message), 1);
            $mqtt->publish('php-mqtt/client/test', trim($request->message), 0);
           // $mqtt->loop(true, true);
           // $mqtt->disconnect();

            return redirect('create');
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
            Log::error($e);
            Log::info("Publishing a message using QoS 0 failed. An exception occurred");
        }
    }

    public function show()
    {
       // dd("in show");
        return view('show');
    }

    public function subscribe(){

        //dd("in subscribe");
        //$server   = '127.0.0.1';
        //$server = '192.168.1.146';
        $server = 'broker.emqx.io';
        $port     = 1883;
        $clientId = 'test-subscribe-demo';

        $mqtt = new MqttClient($server, $port, $clientId);

        // pcntl_async_signals(true);
        // pcntl_signal(SIGINT, function () use ($mqtt) {
        //     Log::info('Received SIGINT signal, interrupting the client for a graceful shutdown...');
    
        //     $mqtt->interrupt();
        // });
        $mqtt->connect();
        $mqtt->subscribe('php-mqtt/client/test', function ($topic, $message, $retained, $matchedWildcards) use ($mqtt){
            dd($topic);
            echo sprintf("Received message on topic [%s]: %s\n", $topic, $message);
           // After receiving the first message on the subscribed topic, we want the client to stop listening for messages.
          // $mqtt->interrupt();
        }, 0);

        // $client->subscribe('foo/bar/baz', function (string $topic, string $message, bool $retained) use ($logger, $client) {
        //     $logger->info('We received a {typeOfMessage} on topic [{topic}]: {message}', [
        //         'topic' => $topic,
        //         'message' => $message,
        //         'typeOfMessage' => $retained ? 'retained message' : 'message',
        //     ]);
    
        //     // After receiving the first message on the subscribed topic, we want the client to stop listening for messages.
        //     $client->interrupt();
        // }, MqttClient::QOS_AT_MOST_ONCE);
        //$mqtt->loop(true);
        $mqtt->disconnect();
        // $mqtt->loop(true,true);
        //     pcntl_signal(SIGINT, function () use ($mqtt) {
        //         $mqtt->interrupt();
        //     });

        
    }
}
