// Establish a connection to our push server
var connection = new autobahn.Connection({
    url: 'ws://127.0.0.1:7474',
    realm: 'default'
});

connection.onopen = function(session) {

    console.log('Connected');

    // Handle user interaction
    session.subscribe('users', function(payload) {

        if (payload[0]['event'] === 'signin')
        {
            console.log("User logged in:", payload[0]['firstname'] + ' ' + payload[0]['lastname']);
        }
        else if (payload[0]['event'] === 'signout')
        {
            console.log("User logged off:", payload[0]['firstname'] + ' ' + payload[0]['lastname']);
        }

    });

    // Handle messages
    session.subscribe('chat', function(payload) {

        var message = payload[0];

        var table = document.getElementById('messages');

        // Add a new row
        var row = table.insertRow(0);

        // Add two cells
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);

        // Fill in the cell content
        cell1.innerHTML = message['firstname'] + ' ' + message['lastname'];
        cell2.innerHTML = message['message'];
    })
};

connection.onclose = function() {

    console.log("Disconnected");

};

// Establish a connection
connection.open();