var mongoose = require("mongoose");
var Schema = mongoose.Schema;
var UserSchema = new Schema({
	name: {
        type: String,
        required: [true, 'Please enter name']
    },
	gender: {
        type: String,
        required: [true, 'Please enter gender']
    },
	address: {
        type: String,
        required: [true, 'Please enter address']
    },
	photo: {
        type: String,
		required:false,
    },
	created:  {
        type: Date,
        required: [true, 'Please enter create date']
    },
	modified:  {
		type: Date,
		default:null
	}
},{strict:false});

module.exports = mongoose.model("User",UserSchema,"users");