
//---------------------------not working mqtt://test.mosquitto.org
// const mqtt = require('mqtt');
// const client = mqtt.connect('mqtt://test.mosquitto.org'); 
// const topic = 'php-mqtt/client/test';
// //const topic = 'some/topic';
// //const message = 'test message hiii'; 

// client.on('connect', () => {
//     console.log(`Is client connected: ${client.connected}`);    
//     if (client.connected === true) {
//         console.log("client connected");
//        // console.log(`message: ${message}, topic: ${topic}`); 
//         // publish message
//         //client.publish(topic, message);
//     }

//     // subscribe to a topic
//     client.subscribe(topic);
// });

// // receive a message from the subscribed topic
// client.on('message',(topic, message) => {
//     console.log(`message: ${message}, topic: ${topic}`); 
// });

// // error handling- register event listeners for the “error” event
// client.on('error',(error) => {
//     console.error(error);
//     process.exit(1); //terminates the application:
// });



//--------with username and password-----------------------------------

// const mqtt = require('mqtt');
// const host = 'broker.emqx.io';
// const port = '1883';
// const clientId = `mqtt_${Math.random().toString(16).slice(3)}`;
// const connectUrl = `mqtt://${host}:${port}`;
// const client = mqtt.connect(connectUrl, {
//     clientId,
//     clean: false,
//     connectTimeout: 4000,
//     username: 'emqx_user',
//     password: 'public',
//     reconnectPeriod: 1000,
//   })

//   const topic = 'php-mqtt/client/test'
//   client.on('connect', () => {
//     console.log('Connected')
//     client.subscribe([topic], () => {
//       console.log(`Subscribe to topic '${topic}'`)
//     })
//     client.publish(topic, 'nodejs mqtt test', { qos: 0, retain: false }, (error) => {
//         if (error) {
//           console.error(error)
//         }
//       })
//   });
//   client.on('message', (topic, payload) => {
//     console.log('Received Message:', topic, payload.toString())
//   });

//-----------without username and password----
const mqtt = require('mqtt');
const host = 'broker.emqx.io';
const port = '1883';
const clientId = `mqtt_${Math.random().toString(16).slice(3)}`;
const connectUrl = `mqtt://${host}:${port}`;
const client = mqtt.connect(connectUrl)
console.log(connectUrl);
  const topic = 'php-mqtt/client/test'
  client.on('connect', () => {
    console.log('Connected')
    client.subscribe([topic], () => {
      console.log(`Subscribe to topic '${topic}'`)
    })
    // client.publish(topic, 'nodejs mqtt test', { qos: 0, retain: false }, (error) => {
    //     if (error) {
    //       console.error(error)
    //     }
    //   })
  });
  client.on('message', (topic, payload) => {
    console.log('Received Message:', topic, payload.toString())
  });

//----------------The MQTT CONNECT request consists of the three must-have values: clientID, cleanSession, and keepAlive;
// clientID 		“client-1”
// cleanSession		true
// keepAlive		120
// //or you can use bellow options - this is optional ,if you set addition configuration then use these
// // const options = {
// //    clientId: 'myclient',
// //    Username: 'cedalo',
// //    Password: '0dfTYEF90nAd9kNK8IEr'
         //lastWillTopic		“/tom/will”
         //lastWillQos		2
         //lastWillMessage		“connection disabled”
        // lastWillRetain		false
// // };
// // const client = mqtt.connect('mqtt://test.mosquitto.org', options);



//-----------------------------------------------------------------------------------
// const mqtt = require('mqtt')
// //mqtt://192.168.1.157
// //const client = mqtt.connect('mqtt://192.168.1.146')
// const client = mqtt.connect('mqtt://test.mosquitto.org')
// console.log("start subscriber js");
// //console.log(client);
// client.on('connect', () => {
//    console.log("Connection established successfully!");
//      client.subscribe('some/topic',{qos:1})
//      client.subscribe('some/other/topic',{qos:0})
//      //case sebsitive test
//      client.subscribe('jack/Topic',{qos:0})
//      console.log('subscribed');
// })
//----------------------------------------------------------------------------------
// client.on('connected',function(){
//    client.subscribe('some/topic');
//    console.log('subscribed');
//    console.log('Client publishing.. ');
//    //client.publish('presence', 'Client 1 is alive.. Test Ping! ' + Date());
//  });


