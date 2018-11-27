var mysql = require('./node_modules/mysql');
var config = require('./config.json');
var validator = require('./validation.js');

//errors
function formatErrorResponse(code, errs) {
	return JSON.stringify({
		error  : code,
		errors : errs
	});
}

exports.handler = (event, context, callback) => {
	//instruct the function to return as soon as the callback is invoked
	context.callbackWaitsForEmptyEventLoop = false;
	var errors = new Array();
	
	validator.validateUserID(event.userid, errors);
	
	if(errors.length > 0) {
		// This should be a "Bad Request" error
		callback(formatErrorResponse('BAD_REQUEST', errors));
	}else{
		var conn = mysql.createConnection({
			host 	: config.dbhost,
			user 	: config.dbuser,
			password : config.dbpassword,
			database : config.dbname
		});

		//prevent timeout from waiting event loop
		context.callbackWaitsForEmptyEventLoop = false;

		//attempts to connect to the database
		conn.connect(function(err) {
			if (err)  {
				// This should be a "Internal Server Error" error
				callback(formatErrorResponse('INTERNAL_SERVER_ERROR', [err]));
			}else{
				console.log("Connected!");
				var sql = "SELECT isadmin FROM users WHERE userid = ?";
				conn.query(sql, [event.userid], function (err, result) {
					if (err) {
						callback(formatErrorResponse('INTERNAL_SERVER_ERROR', [err]));
					} else {
						// Pull out just the admin from the "result" array (index '1')
				  		var admin = [];
				  		for(var i=0; i<result.length; i++) {
							admin.push(result[i]['isadmin']);
						}
						// Build an object for the JSON response with the userid and reg codes
						var json = { 
							userid : event.userid,
							isadmin : admin
						};
						console.log("user is the admin");
						callback(null,json);
					}
				});
			}
		});//end of connection function
	}
}// end of exports.handler