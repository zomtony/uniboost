var mysql = require('mysql');

var connection = mysql.createConnection({
  host: "45.78.25.200",
  user: "zhimadeveloper",
  password: "zhimadeveloper12",
  database: "zhimadeveloper"
});

connection.connect(function(err) {
  if (err) throw err;
  console.log("Connected!");
  connection.end();
});