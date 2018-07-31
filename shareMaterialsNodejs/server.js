var mysql = require('mysql');

var connection = mysql.createPool({
  host: "178.128.12.124",
  user: "zhimacollege",
  password: "Uniboost12",
  database: "zhimacollege"
});

connection.getConnection(function(err) {
  if (err) throw err;
  console.log("Connected!");
  //connection.end();
});
var fs = require('fs');
var https = require('https');
const ejs = require('ejs');
const express = require('express');
server = express();
server.set("view engine", "ejs");

var bodyParser = require('body-parser');
server.use(bodyParser.urlencoded({ extended: true })); // support encoded bodies

server.use('/shareMaterialsNodejs/apply', function (req, res){
    var groupNickNameb = req.body.groupNickNamef.trim();
    var gmailb = req.body.gmailf.trim();
    var schoolb = req.body.schoolf;
    var applyCourseNumberb = req.body.applyCourseNumberf.trim();

    connection.query("SELECT * FROM RecordShareMateria WHERE userGmail = " + mysql.escape(gmailb), function (err, resultSelect, fields) {
        if (err) throw err;
        if(resultSelect == '' ){

            var sql = "INSERT INTO RecordShareMateria (userGmail, groupNickName, applyTimes, shareTimies) VALUES ?";
            // 0 - did not send the materia yet, 1 - already sent the materia
            var valuesRecord = [
              [gmailb, groupNickNameb, 1, 0],
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
                       // console.log("resultInsertDetail s");
                        res.redirect('https://www.woshihlj.com/shareMaterialsNodejs/apply/resultS.html');
                    }else{
                       // console.log("resultInsertDetail f");
                        res.redirect('https://www.woshihlj.com/shareMaterialsNodejs/apply/resultF.html');

                    }
                });

              }else{
                console.log("f");
              }
            });


        }else{
            var applyTimes = resultSelect[0].applyTimes + 1;

            var sql = "UPDATE RecordShareMateria SET applyTimes =" +  mysql.escape(applyTimes) + " WHERE userGmail = " + mysql.escape(gmailb);
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
                       // console.log("resultInsertDetail s");
                        res.redirect('https://www.woshihlj.com/shareMaterialsNodejs/apply/resultS.html');
                    }else{
                      //  console.log("resultInsertDetail f");
                        res.redirect('https://www.woshihlj.com/shareMaterialsNodejs/apply/resultF.html');
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

        connection.query("SELECT re.userGmail, re.groupNickName, re.applyTimes, re.shareTimies, ap.MateriaDetailID, ap.school, ap.applyCourseNumber, ap.applyStatus FROM RecordShareMateria re LEFT JOIN ApplyMateriaDetail ap ON re.userGmail = ap.userGmail WHERE ap.applyStatus = 0", function (err, resultSelect, fields) {
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
    var MateriaDetailIDb = req.body.MateriaDetailIDf;

    var shareTimeSubb = req.body.shareTimeSubf;
    var userGmailShareSubb = req.body.userGmailShareSubf;

    if(req.body.keyWordsEmailf == '' || req.body.keyWordsEmailf == null){
        if(shareTimeSubb == '' || shareTimeSubb == null){
            var sql = "UPDATE ApplyMateriaDetail SET applyStatus = 1 WHERE MateriaDetailID = " + mysql.escape(MateriaDetailIDb);
            connection.query(sql, function (err, result) {
                if (err) throw err;
                console.log(result.affectedRows + " record(s) updated");
            });
        }else{
            var sql = "UPDATE RecordShareMateria SET shareTimies =" + mysql.escape(shareTimeSubb) + " WHERE userGmail = " + mysql.escape(userGmailShareSubb);
            connection.query(sql, function (err, result) {
                if (err) throw err;
                console.log(result.affectedRows + " record(s) updated");
            });
        }
    }else{
        var keyWordsEmailb = req.body.keyWordsEmailf.trim();
        connection.query("SELECT * FROM RecordShareMateria WHERE userGmail = " + mysql.escape(keyWordsEmailb), function (err, resultSelect, fields) {
            ejs.renderFile('./view/updateShareTImes.ejs', {resultSelect:resultSelect}, function(err, data){
                //data = resultSelect;
                res.end(data);
            });
        });
    }
});

//server.listen(8080);


https.createServer({
    key: fs.readFileSync('/etc/letsencrypt/live/woshihlj.com/privkey.pem'),
    cert: fs.readFileSync('/etc/letsencrypt/live/woshihlj.com/cert.pem'),
    ca: fs.readFileSync('/etc/letsencrypt/live/woshihlj.com/chain.pem') 
  }, server)
  .listen(8080, function () {
    console.log('')
  });