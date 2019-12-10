var express = require("express");
var app = express();
var bodyParser = require("body-parser");
var mongoose = require("mongoose");
var url = require('url');
var path = require('path');
var multer  = require('multer');
var API_KEY = "ABCdEf445500#^sdsaWKlsdlds9870";

app.use(express.static(__dirname + '/public'));
app.use(bodyParser.json({limit:"100mb"}));
app.use(bodyParser.urlencoded({extended:false, limit:"100mb"}));

mongoose.Promise = global.Promise;

mongoose.connect('mongodb://localhost/nodecrud', {useNewUrlParser: true});
var db = mongoose.connection;
db.on('error', console.error.bind(console, 'connection error:'));
db.once('open', function() {
  
  console.log("we're connected!");
});


var storage = multer.diskStorage({
  destination: function (req, file, cb) {
    cb(null, './public/uploads/')
  },
  filename: function (req, file, cb) {
	//console.log(file);
    cb(null, file.originalname.substr(0, file.originalname.lastIndexOf(".")) + '-' + Date.now() + path.extname(file.originalname));
  }
});
var upload = multer({ storage: storage });
var User = require("./models/User");

app.all('*',function(req,res,next){
	//console.log(new Date());
    var key = req.headers['api-key'] || null;
	if(key == API_KEY){
		next();
	}
	else{
	 return res.sendStatus(401);
	}
});

app.get("/",function(req,res){
	res.end("Home Page");
});

app.get("/count_users",function(req,res){
	User.count({},function(error,count){
		
		if(error){
			console.log("Error in fetching users count");
			res.json({"success":false, "data":null});
		}
		if(count){
			res.json({"success":true, "data":count});
		}
		else{
			res.json({"success":false, "data":null});
		}
	});
	
});

app.get("/users",function(req,res){
	var url_parts = url.parse(req.url, true);
	var query = url_parts.query;
	
	User.find()
	.skip(Number(query.start))
	.limit(Number(query.limit))
	.sort({created:'desc'})
	.exec(function(error,users){
		if(error){
			console.log("Error in fetching users");
		}
		if(users){
			res.json({"success":true, "data":users});
		}
		else{
			res.json({"success":false, "data":null});
		}
		
		
	});
});

app.post("/users/add",upload.single('file_to_import'),function(req,res){
	
	//var filePath = path.join(__dirname, '../../public/uploads/') + req.file.filename;
	fileName = (typeof req.file!=='undefined' && typeof req.file.filename!=='undefined') ? req.file.filename : null;
	var dataJson = {
		name : req.body.name,
		gender : req.body.gender,
		address : req.body.address,
		photo : fileName,
		created : new Date()
	};
	
	console.log("dataJson",dataJson);
	var userEntry = new User(dataJson);
	userEntry.save(function(err){
		if(err){
			console.log("Error in saving");
		}
		else{
			console.log("Data saved");
		}
	})
	//console.log(req.body);
	res.json({success:true,"data":dataJson});
});


app.get("/get_user/:id",function(req,res){
	var id = req.params.id;
	//console.log("id",id);
	User.findOne({"_id":mongoose.Types.ObjectId(id)})
	.exec(function(error,user){
		if(error){
			console.log("Error in fetching user");
		}
		if(user){
			res.json({"success":true, "data":user});
		}
		else{
			res.json({"success":false, "data":null});
		}
	});
});


app.post("/users/edit/:id",upload.single('file_to_import'),function(req,res){
	
	var id = req.params.id;
	if(id){
		fileName = (typeof req.file!=='undefined' && typeof req.file.filename!=='undefined') ? req.file.filename : null;
		var dataJson = {
			name : req.body.name,
			gender : req.body.gender,
			address : req.body.address,
			modified : new Date()
		};
		
		if(fileName){
			dataJson["photo"] = fileName;
		}
		
		console.log("dataJson",dataJson);
		User.update({ _id: mongoose.Types.ObjectId(id) }, { $set: dataJson}, function (err, user) {
			if(err){
				//console.log(err);
				res.json({"success":false,"message":"Error in updating"});
			}
			else{
				if(user){
					res.json({"success":true,"message":"User updated","data":user});
				}
			}
			
		});

	}
	else{
		res.json({success:false,"message":"Please provide user id"});
	}
});


app.get("/delete_user/:id",function(req,res){
	var id = req.params.id;
	//console.log("id",id);
	if(id){
		User.deleteOne({"_id":mongoose.Types.ObjectId(id)}, function (err) {
			if(err){
				//console.log(err);
				res.json({"success":false,"message":"Error in deleting"});
			}
			else{
				res.json({"success":true,"message":"User delete"});
			}
		});

	}
	else{
		res.json({success:false,"message":"Please provide user id"});
	}
});

var port = process.env.port || 3000;
app.listen(port,function(err,success){
	console.log('app listening on http://localhost:'+port);
});
