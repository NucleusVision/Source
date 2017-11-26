/**
 * UserController
 *
 * @description :: Server-side logic for managing users
 * @help        :: See http://sailsjs.org/#!/documentation/concepts/Controllers
 */


var consoleRoot = 'geth --datadir ~/mlg-ethchain2/ --testnet ';

// var _server = 'https://ropsten.infura.io/Z3D0BerCYEHjVCzRUINe';
var _server = 'http://localhost:8545';

// var wsProvider = 'ws://127.0.0.1:8546';
// var wsProvider = 'http://127.0.0.1:8545';
var wsProvider = _server;
var Personal = require('web3-eth-personal');
var personal = new Personal(wsProvider);

var Passwords = require('machinepack-passwords');
var fs = require('fs');
var solc = require('solc');
var Web3 = require('web3');
var this_http_provider = new Web3.providers.HttpProvider(_server);
var web3 = new Web3();
web3.setProvider(this_http_provider);
if (true === web3.isConnected()) {
    console.log('Web3 is connected!');
}

var Web3EthAccounts = require('web3-eth-accounts');
var account = new Web3EthAccounts(wsProvider);

var libFile = require('../../Interface.js');
var lib = new libFile.Interface();
var merchantAccount = web3.eth.accounts[0];
console.log(web3.eth.accounts);

//console.log('Unlocking merchant: ');
//personal.unlockAccount(merchantAccount, '111', 8200).then(console.log);

// curl -X POST --data "password=1q2w3e4r5t6y" http://54.215.211.34:1337/user/createOwnerWithContract

module.exports = {
    createOwnerWithContract : function (req, res) {
        console.log(req.body);
        var _this = this;
        var _pwd = req.param('password');
        personal.newAccount(_pwd).then(function (addr, error) {
            if (error) {
                console.log("Error: " + error);
                return;
            }
            console.log("OWNER: " + addr);
            lib.sendBaseEtherToAccount(addr, "1000000000000000000", function(err, transactionHash) {
                    console.log("send 1 Eth: " + transactionHash);
                    // deploy contract
                    lib.changeBaseAccount(addr, _pwd);
                    /*lib.deployContract("10000000000", function(err, data) {
                        return res.json({
                                status : 'ok',
                                error: err,
                                data : { ownerAddr: addr }
                            });

                    });*/

                });
        });
    },
    createContract : function (req, res) {
        console.log(req.body);
        lib.deployContract("10000000000", function(err, data) {
            return res.json({
                    status : 'ok',
                    error: err,
                    data : { }
                });
        });
    },
    deployNCashToken : function (req, res) {
        console.log(req.body);
        lib.deployNCashToken(function(err, data) {
            return res.json({
                    status : 'ok',
                    error: err,
                    data : { }
                });
        });
    },
    initContract : function (req, res) {
        console.log(req.body);
        var _this = this;       
        var cc = lib.init(req.param('addr'));
        return res.json({
                status : 'ok',
                data : { contract: cc }
            });
    },
    transferOwnership : function (req, res) {
        console.log(req.body);
        var _this = this;       
        var cc = lib.transferOwnership(req.param('addr'), function(err, transactionHash) {
            console.log("transferOwnership: " + transactionHash);
            return res.json({ status: 'ok', data: {
                    newOwner: addr,
                    err: err,
                    tx: transactionHash
                } });
        });
    },
    sendBaseTokens : function(req, res) {
        console.log("sendBaseTokens...");
        var to = req.param('to');
        var amount = req.param('amount');

        lib.sendBaseTokensToAccount(to, amount, function(transactionHash) {
            console.log("sendBaseTokens: " + transactionHash);
            return res.json({ status: 'ok', data: {
                    to: to,
                    amount: amount,
                    tx: transactionHash
                } });
        });
    },

    mintTokens : function(req, res) {
        console.log("mintTokens...");
        var to = req.param('to');
        var amount = req.param('amount');

        lib.mintTokensToAccount(to, amount, function(transactionHash) {
            console.log("mintTokens: " + transactionHash);
            return res.json({ status: 'ok', data: {
                    to: to,
                    amount: amount,
                    tx: transactionHash
                } });
        });
    },
    distributeTokens : function (req, res) {
        console.log(req.body);
        var _this = this;
        lib.distributeTokens(function(err, transactionHash) {
                console.log("distributeTokens: " + transactionHash);
                return res.json({
                        status : 'ok',
                        error: err,
                        data : { tx: transactionHash }
                    });
            });
    },
    whitelistAccount : function (req, res) {
        console.log(req.body);
        var _this = this;
        var _addr = req.param('addr');
        var _flag = (req.param('flag') == "1");
        lib.whitelistAccount(_addr, _flag, function(err, transactionHash) {
                console.log("whitelistAccount: " + transactionHash);
                return res.json({
                        status : 'ok',
                        error: err,
                        data : { tx: transactionHash }
                    });
            });
    },
    approveAccount : function (req, res) {
        console.log(req.body);
        var _this = this;
        var _addr = req.param('addr');
        var _flag = (req.param('flag') == "1");
        lib.approveAccount(_addr, _flag, function(err, transactionHash) {
                console.log("approveAccount: " + transactionHash);
                return res.json({
                        status : 'ok',
                        error: err,
                        data : { tx: transactionHash }
                    });
            });
    },
    addPreSaleAccount : function (req, res) {
        console.log(req.body);
        var _this = this;
        var _addr = req.param('addr');
        var _flag = (req.param('flag') == "1");
        var _lockTimeout = req.param('lockTimeout');
        var _bonus = req.param('bonus');
        lib.addPreSaleAccount(_addr, _flag, _lockTimeout, _bonus, function(err, transactionHash) {
                console.log("addPreSaleAccount: " + transactionHash);
                return res.json({
                        status : 'ok',
                        error: err,
                        data : { tx: transactionHash }
                    });
            });
    },
    changeAdmin : function (req, res) {
        console.log(req.body);
        var _this = this;
        var _addr = req.param('addr');
        lib.changeAdmin(_addr, function(err, data) {
                console.log("changeAdmin: " + data);
                return res.json({
                        status : 'ok',
                        error: err,
                        data : data
                    });
            });
    },
    changeWallet : function (req, res) {
        console.log(req.body);
        var _this = this;
        var _addr = req.param('addr');
        lib.changeWallet(_addr, function(err, data) {
                console.log("changeWallet: " + data);
                return res.json({
                        status : 'ok',
                        error: err,
                        data : data
                    });
            });
    },
    checkAccount : function (req, res) {
        console.log(req.body);
        var _this = this;
        var _addr = req.param('addr');
        var _amount = req.param('amount');
        console.log("checkAccount("+_addr+", "+web3.fromWei(_amount, 'ether')+" ETH)");
        lib.checkCanBuy(_addr, _amount, function(err, transactionHash) {
                console.log("checkCanBuy: " + transactionHash);
                return res.json({
                        status : 'ok',
                        error: err,
                        data : transactionHash
                    });
            });
    },
    buyTokens : function (req, res) {
        console.log(req.body);
        var _this = this;
        var _addr = req.param('addr');
        var _pwd = req.param('pwd');
        var _amount = req.param('amount');
        console.log("buyTokens("+_addr+", "+web3.fromWei(_amount, 'ether')+" ETH)");
        lib.buyTokens(_addr, _pwd, _amount, function(err, transactionHash) {
                console.log("buyTokens: " + transactionHash);
                return res.json({
                        status : 'ok',
                        error: err,
                        data : transactionHash
                    });
            });
    },
    getStats : function (req, res) {
        console.log(req.body);
        lib.getStats(function(err, stats) {
                console.log("getStats: " + stats);
                return res.json({
                        status : 'ok',
                        error: err,
                        data : stats,
                        currentTime: Math.floor(Date.now() / 1000)
                    });
            });
    },
    getStartTimes : function (req, res) {
        console.log(req.body);
        lib.getSaleStartTimes(function(err, startTimes) {
                console.log("getStartTimes: " + startTimes);
                return res.json({
                        status : 'ok',
                        error: err,
                        data : startTimes,
                        currentTime: Math.floor(Date.now() / 1000)
                    });
            });
    },
    setStartTimes : function (req, res) {
        console.log(req.body);
        var _whiteTime = req.param('whiteTime') || 0;
        var _publicTime = req.param('publicTime') || 0;
        var _endTime = req.param('endTime') || 0;
        var _lockTime = req.param('lockTime') || 0;

        lib.setSaleStartTimes(_whiteTime, _publicTime, _endTime, _lockTime, function(err, tx) {
                console.log("setStartTimes: " + tx);
                return res.json({
                        status : 'ok',
                        error: err,
                        data : tx
                    });
            });
    },
    getSettings : function (req, res) {
        console.log(req.body);
        lib.getSaleSettings(function(err, settings) {
                console.log("getSettings: " + settings);
                return res.json({
                        status : 'ok',
                        error: err,
                        data : settings,
                        currentTime: Math.floor(Date.now() / 1000)
                    });
            });
    },
    setSettings : function (req, res) {
        console.log(req.body);
        var _whiteTime = req.param('whiteTime') || 0;
        var _publicTime = req.param('publicTime') || 0;
        var _endTime = req.param('endTime') || 0;
        var _lockTime = req.param('lockTime') || 0;
        var ePrice = req.param('ePrice') || 0;
        var bPrice = req.param('bPrice') || 0;
        var minEth = req.param('minEth') || 0;
        var minGas = req.param('minGas') || 0;
        var maxGas = req.param('maxGas') || 0;
        var minGasPrice = req.param('minGasPrice') || 0;
        var maxGasPrice = req.param('maxGasPrice') || 0;
        var bonus = req.param('bonus') || 0;
        var bonusBuyers = req.param('bonusBuyers') || 0;
        var softCap = req.param('softCap') || 0;
        var hardCap = req.param('hardCap') || 0;

        lib.setSaleSettings(_whiteTime, _publicTime, _endTime, _lockTime, ePrice, bPrice, minEth, minGas, maxGas, 
            minGasPrice, maxGasPrice, bonus, bonusBuyers, softCap, hardCap, function(err, tx) {
                console.log("setSaleSettings: " + tx);
                return res.json({
                        status : 'ok',
                        error: err,
                        data : tx
                    });
            });
    },
    isPreSale : function (req, res) {
        console.log(req.body);
        var _addr = req.param('addr');
        lib.isPreSale(_addr, function(err, settings) {
                console.log("isPreSale: " + settings);
                return res.json({
                        status : 'ok',
                        error: err,
                        data : settings,
                        currentTime: Math.floor(Date.now() / 1000)
                    });
            });
    },
    isWhitelisted : function (req, res) {
        console.log(req.body);
        var _addr = req.param('addr');
        lib.isWhitelisted(_addr, function(err, settings) {
                console.log("isWhitelisted: " + settings);
                return res.json({
                        status : 'ok',
                        error: err,
                        data : settings,
                        currentTime: Math.floor(Date.now() / 1000)
                    });
            });
    },
    isApproved : function (req, res) {
        console.log(req.body);
        var _addr = req.param('addr');
        lib.isApproved(_addr, function(err, settings) {
                console.log("isApproved: " + settings);
                return res.json({
                        status : 'ok',
                        error: err,
                        data : settings,
                        currentTime: Math.floor(Date.now() / 1000)
                    });
            });
    }

};

