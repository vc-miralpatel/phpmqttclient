<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <div>
            <h3>Messages:</h3>
        </div>
        <div>
            <p id="mqttMessage"></p>
        </div>
       
    </div>
</body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script type="module">
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({url: "demo_test.txt", success: function(result){
    //         $("#div1").html(result);
    //     }})

    //     $.ajax({
    //      type:'POST',
    //      url:'/ajax',
    //      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    //      success:function(data){
    //         $("#msg").html(data.msg);
    //      }
    //   });
</script> --}}
  <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>

  {{-- <script type="text/javascript" src="{{ asset('js/mqtt.js') }}"></script> --}}
 {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/mqtt/4.0.0/mqtt.js" integrity="sha512-icFoRswWQbg3WS2Kz0G97YWFeLmugap6CCrEPf1DpZ7c+hecv8us79bLa8tSQdNBjLU1dpT2DeLS0gkPHCFsRw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/mqtt/4.3.7/mqtt.js" integrity="sha512-yX4jaiU9Ai9dzaimFoTq+tQYOrAMNP+EWiiUVsru3ypsAi76c0zCPBfxKagLkKjC4ZeLMEQTa7aE7CtjTmlgDA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
 {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/mqtt/4.3.7/mqtt.min.js" integrity="sha512-tc5xpAPaQDl/Uxd7ZVbV66v94Lys0IefMJSdlABPuzyCv0IXmr9TkqEQvZiWKRoXMSlP5YPRwpq2a+v5q2uzMg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
<script>
    console.log("start");
   
//     // Initialize a mqtt variable globally
//     //console.log(mqtt);
//     // console.log(mqtt.);
//     // console.log(mqtt.mqtt);
//     // console.log(mqtt.client);
   
//     //const mqtt = require('mqtt');
//     const client = mqtt.connect('ws://test.mosquitto.org:8081');
//     //const client = mqtt.connect('mqtt://broker.hivemq.com:8000');
//    //const client = mqtt.connect('wss://test.mosquitto.org:8081');

// //     const topic = 'some/topic';
// //const topic = 'some/topic';
// const topic ='php-mqtt/client/test';
// //const message = 'gggggg'; 

// client.on('connect', () => {
//     console.log(`Is client connected: ${client.connected}`);    
//     if (client.connected === true) {
//         console.log("client connected");
//        // console.log(`message: ${message}, topic: ${topic}`); 
//         // publish message
//        // client.publish(topic, message);
//     }

//     // subscribe to a topic
//     client.subscribe(topic);
//     //The hash (#) wildcard can match more than one topic level, but it must be used as the last level.
//     //client.subscribe('vc/laravel/#');
//     //client.subscribe('vc/bde/#');
//     // client.subscribe('vc/qa/#');
//     // client.subscribe('vc/#');
//     // client.subscribe('vc/laravel/sahil/#');
//     //The plus sign (+) wildcard is a single-level wildcard that matches any MQTT topic name within a specified topic level
//     //client.subscribe('vc/laravel/+/miral');
//   //  client.subscribe('vc/laravel/shailesh/+');
// });

// // receive a message from the subscribed topic
// client.on('message',(topic, message) => {
//     console.log("hyyyyyyyyy");
//     console.log(`message: ${message}, topic: ${topic}`);
//     //mqttMessage
//     $("#mqttMessage").append(message+"<br/>");
// });

// // error handling- register event listeners for the “error” event
// client.on('error',(error) => {
//     console.error(error);
//     process.exit(1); //terminates the application:
// });



//not working 
const host = 'broker.emqx.io';
const port = '1883';
const clientId = `mqtt_${Math.random().toString(16).slice(3)}`;
const connectUrl = `mqtt://${host}:${port}`;
const client = mqtt.connect(connectUrl, {
    clientId,
    clean: false,
    connectTimeout: 4000,
    username: 'emqx_user',
    password: 'public',
    reconnectPeriod: 1000,
  })

  const topic = 'php-mqtt/client/test'
  client.on('connect', () => {
    console.log('Connected')
    client.subscribe([topic], () => {
      console.log(`Subscribe to topic '${topic}'`)
    })
    client.publish(topic, 'nodejs mqtt test', { qos: 0, retain: false }, (error) => {
        if (error) {
          console.error(error)
        }
      })
  });
  client.on('message', (topic, payload) => {
    console.log('Received Message:', topic, payload.toString())
  });


</script>
</html>
