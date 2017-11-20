/**
 * TestController
 *
 * @description :: Server-side logic for managing tests
 * @help        :: See http://sailsjs.org/#!/documentation/concepts/Controllers
 */

var _server = 'http://localhost:8545';

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

var ADMIN_ADDRESS = '0x8EA3a92C3075991F72e0B5B19De476d0e13c7F48';
var ADMIN_PWD = '123';
var CONTRACT_ADDRESS  = '0x7d8BEee4E2AFa2504df055EC6eCd1014388cF87a';
var CONTRACT_WALLET = '0x20154D90491630A3d8EA09deD4e8D14269Ac22dF';

var NCASH_TOKEN = '0x82dbf5d714a4fcf9346b4752ab28e57214660d1a';
var NCORE_TOKEN = '0xa46eC82b4Ca6B576F72858E720279E6CACFb31C9';

var contract = null;
var eth1 = 1000000000000000000;



function setContract(wStartTime, pStartTime, eTime, ePrice, bPrice, minEth, minGas, maxGas, minGasPrice, maxGasPrice,
                     bonus, bonusBuyers, softCap, hardCap) {
    contract = lib.init(CONTRACT_ADDRESS);
    contract.setSaleSettings(wStartTime, pStartTime, eTime, ePrice, bPrice,
        minEth, minGas, maxGas, minGasPrice, maxGasPrice, bonus, bonusBuyers,
        softCap, hardCap, {from: _baseAcc, gas: 2000000});
    return contract;
}

module.exports = {
    testPass : function (req, res) {
        console.log("\[\033[1;31;43m\][>] TESTING PROCESS STARTED\[\033[m\]");

        console.log("\t 1) CREATING NEW USER");
        var _pwd = '1';
        personal.newAccount(_pwd).then(function (addr, error) {
            if (error) {
                console.log("Error: " + error);
                return;
            }
            console.log("\t\tNew user: " + addr);
            console.log("\t\t[V] Ok");
            console.log("\t UNLOCKING USER");
            personal.unlockAccount(addr, _pwd, 84000).then(function(data) {
                console.log("\t\t[V] Ok");
                console.log("\t GET USER ETH BALANCE");
                console.log("\t\t"+web3.eth.getBalance(addr));
                console.log("\t SENDING ETH TO USER");
                lib.sendBaseEtherToAccount(addr, "10000000000000000", function(err, transactionHash) {
                    console.log("send 1 Eth: " + transactionHash);
                    console.log("\t GET USER ETH BALANCE");
                    var inter = setInterval(function() {
                        var balance = web3.eth.getBalance(addr);

                        console.log("\t\t"+balance);

                        if(balance > 0) {
                            clearInterval(inter);

                            console.log("\t 2) SETTING CONTRACT PARAMS");
                            var wStartTime = Date.now() + 12*3600;
                            var pStartTime =  Date.now() + 36*3600;
                            var eTime = Date.now() + 72*3600;
                            var ePrice = eth1 / 25000;
                            var bPrice = 0;
                            var minEth = eth1 / 100;
                            var minGas = 100;
                            var maxGas = 5000000;
                            var minGasPrice = 1;
                            var maxGasPrice = 1000000000000;
                            var bonus = 10;
                            var bonusBuyers = 1000;
                            var softCap = eth1 / 100;
                            var hardCap = 10000 * eth1;
                            contract = setContract(wStartTime, pStartTime, eTime, ePrice, bPrice,
                                minEth, minGas, maxGas, minGasPrice, maxGasPrice, bonus, bonusBuyers,
                                softCap, hardCap);
                            console.log("\t\t DONE");

                            console.log("\t 2) GETTING BALANCES");

                            console.log(lib.getBalance("Addr balance: "+CONTRACT_ADDRESS));
                            console.log(lib.getBalance("Wallet balance: "+CONTRACT_WALLET));
                            console.log("\t\t DONE");

                            console.log("[V] TEST PASSED");
                            return;
                        }
                    }, 1000);
                });
            });



            return;

        });




    }
};

