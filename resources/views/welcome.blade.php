<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('bac0930255808f1d2c52', {
      cluster: 'ap2'
    });

    var channel = pusher.subscribe('orders');
    channel.bind('order-placed', function(data) {
      alert(JSON.stringify(data));
      console.log("testtttttt");
    });



  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
</body>
