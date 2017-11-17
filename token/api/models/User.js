/**
 * User.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/documentation/concepts/models-and-orm/models
 */
var Passwords = require('machinepack-passwords');

module.exports = {
  attributes: {
    email : {
      type: 'string',
      required : true,
      unique : true
    },
    password : {
      type: 'string',
      required : true
    },
    address : {
      type: 'string',
      required : false
    },
    balance: {
        type: 'float',
        required: false,
        defaultsTo: 0
    }

  },
  checkUser : function (sessionId, password, amount, res) {
      console.log(sessionId);
      console.log(password);
      this.find({}).exec(function(err, records) {
          records.forEach(function(record, index){
              // console.log(record);

              Passwords.checkPassword({
                  passwordAttempt: record.address,
                  encryptedPassword: sessionId
              }).exec({
                  error: function (err) {
                      // console.log(err);
                  },
                  success: function () {

                      Passwords.checkPassword({
                          passwordAttempt: password,
                          encryptedPassword: record.password
                      }).exec({
                          error: function (err) {
                              // console.log(err);
                          },
                          success: function () {
                              console.log(record);
                              return sails.controllers.merchant.paySuccess(record, res, amount);
                          }
                      });
                  }
              });
          });
      });

  }
};

