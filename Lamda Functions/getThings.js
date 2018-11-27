var mysql = require('./node_modules/mysql');
var config = require('./config.json');
var validator = require('./validation.js');

function formatErrorResponse(code, errs) {
	return JSON.stringify({
		error  : code,
		errors : errs
	});
}

exports.handler = (event, context, callback) => {
  //instruct the function to return as soon as the callback is invoked
	context.callbackWaitsForEmptyEventLoop = false;

	//validate input
	var errors = new Array();

  if(errors.length > 0) {
		// This should be a "Bad Request" error
		callback(formatErrorResponse('BAD_REQUEST', errors));
	}else{
    //getConnection equivalent
    var conn = mysql.createConnection({
      host 	: config.dbhost,
      user 	: config.dbuser,
      password : config.dbpassword,
      database : config.dbname
    });

    //attempts to connect to the database
		conn.connect(function(err) {
      if (err)  {
				// This should be a "Internal Server Error" error
				callback(formatErrorResponse('INTERNAL_SERVER_ERROR', [err]));
			}else{
        console.log("Connected!");
				var sql = "SELECT thingid, thingname, convert_tz(things.thingcreated,@@session.time_zone,'America/New_York') as thingcreated, thinguserid, thingattachmentid, thingregistrationcode FROM things LEFT JOIN users ON things.thinguserid = users.userid WHERE thingregistrationcode = ? ORDER BY things.thingcreated ASC";

        conn.query(sql, [event.thingregistrationcode], function (err, result) {
          if (err) {
						// This should be a "Internal Server Error" error
						callback(formatErrorResponse('INTERNAL_SERVER_ERROR', [err]));
          } else{
           var jsons = [];
           for(var i=0; i<result.length; i++){
           	jsons[i] = {
           		thingid : result[i].thingid,
           		thingname : result[i].thingname,
           		thingcreated : result[i].thingcreated,
           		thinguserid : result[i].userid,
           		thingattachmentid : result[i].thingattachmentid,
           		thingregistrationcode : result[i].thingregistrationcode
           	}
           }
           
           var json = {
           	registrationcode : event.registrationcode,
           	things: jsons
           }
						// Return the json object
						callback(null, json);
						setTimeout(function(){ conn.end(); }, 3000);
          }//end of else
        });
      }//else

    });//end connect

  }//else


}//handler
