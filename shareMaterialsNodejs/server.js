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
  // connection.end();
});

const ejs = require('ejs');
const express = require('express');
server = express();
server.set("view engine", "ejs");

var bodyParser = require('body-parser');
server.use(bodyParser.urlencoded({ extended: true })); // support encoded bodies

server.use('/shareMaterialsNodejs/apply', function (req, res){
    var groupNickNameb = req.body.groupNickNamef;
    var gmailb = req.body.gmailf;
    var schoolb = req.body.schoolf;
    var applyCourseNumberb = req.body.applyCourseNumberf;
    var addToGroupb = req.body.addToGroupf;

    connection.query("SELECT * FROM RecordShareMateria WHERE userGmail = " + mysql.escape(gmailb), function (err, resultSelect, fields) {
        if (err) throw err;
        if(resultSelect == '' ){

            var sql = "INSERT INTO RecordShareMateria (userGmail, groupNickName, addToGroup, applyTimes, shareTimies) VALUES ?";
            // 0 - did not send the materia yet, 1 - already sent the materia
            var valuesRecord = [
              [gmailb, groupNickNameb, addToGroupb, 1, 0],
            ];
            connection.query(sql, [valuesRecord], function (err, resultInsertRecord) {

              if (err) throw err;
              if(resultInsertRecord.affectedRows > 0){
                
                var sql = "INSERT INTO ApplyMateriaDetail (userGmail, school, applyCourseNumber, applyStatus) VALUES ?";
                var valuesApplyDetail = [
                    [gmailb, schoolb, applyCourseNumberb, 0],
                ];
                connection.query(sql, [valuesApplyDetail], function (err, resultInsertDetail) {
                    if (err) throw err;
                    if(resultInsertRecord.affectedRows > 0){
                        console.log("resultInsertDetail s");
                        res.send('s');
                    }else{
                        console.log("resultInsertDetail f");
                    }
                });

              }else{
                console.log("f");
              }
            });


        }else{
            var applyTimes = resultSelect[0].applyTimes + 1;

            var sql = "UPDATE RecordShareMateria SET addToGroup = " + mysql.escape(addToGroupb) + " , applyTimes =" +  mysql.escape(applyTimes) + " WHERE userGmail = " + mysql.escape(gmailb);
            connection.query(sql, function (err, resultUpdateRecord) {
              if (err) throw err;
              if(resultUpdateRecord.affectedRows > 0){

                var sql = "INSERT INTO ApplyMateriaDetail (userGmail, school, applyCourseNumber, applyStatus) VALUES ?";
                var valuesApplyDetail = [
                    [gmailb, schoolb, applyCourseNumberb, 0],
                ];
                connection.query(sql, [valuesApplyDetail], function (err, resultInsertDetail) {
                    if (err) throw err;
                    if(resultInsertDetail.affectedRows > 0){
                        console.log("resultInsertDetail s");
                        res.send('s');
                    }else{
                        console.log("resultInsertDetail f");
                    }
                });
              }
            });

        }
    });

});


server.use('/shareMaterialsNodejs/admin', function (req, res){
    var HLJAccountb = req.body.HLJAccountf;
    var HLJpwdb = req.body.HLJpwdf;

    if(HLJAccountb == 'hlj' && HLJpwdb == 'hlj12'){

        connection.query("SELECT re.userGmail, re.groupNickName, re.addToGroup, re.applyTimes, re.shareTimies, ap.school, ap.applyCourseNumber, ap.applyStatus FROM RecordShareMateria re LEFT JOIN ApplyMateriaDetail ap ON re.userGmail = ap.userGmail WHERE ap.applyStatus = 0", function (err, resultSelect, fields) {
            ejs.renderFile('./view/userInfo.ejs', {resultSelect:resultSelect}, function(err, data){
                //data = resultSelect;
                res.end(data);
            });
        });

    }else{
        console.log('log f');
    }
});

server.use('/shareMaterialsNodejs/view', function (req, res){
    console.log("test");
});


server.listen(8080);


