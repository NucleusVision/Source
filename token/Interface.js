
var fs = require('fs');
var solc = require('solc');
var Web3 = require('web3');
// var _server = 'https://ropsten.infura.io/Z3D0BerCYEHjVCzRUINe';
var _server = 'http://localhost:8545';
var this_http_provider = new Web3.providers.HttpProvider(_server);
var web3 = new Web3(this_http_provider);

var wsProvider = _server;
var Personal = require('web3-eth-personal');
var personal = new Personal(wsProvider);

var _ownerAcc = "0x36112c7cd9cd6fc00ae1bd747411cd856be48bae"; //"0x156c3fc2b7688583ef089e416d1c1ebc584934ee"; //"0x20154D90491630A3d8EA09deD4e8D14269Ac22dF"; //"0x15a99D10a6b9f6b3F8962133482508295190B7DC";
var _ownerAccPwd = "1q2w3e4r5t6y";

var _baseAcc = "0x238a3addf093abbdc6ac5ff2daef7ac312d857eb"; //"0x8fdc87eb775221facbf2c37387b974dca48b82f6"; //"0x8EA3a92C3075991F72e0B5B19De476d0e13c7F48"; //"0x15a99D10a6b9f6b3F8962133482508295190B7DC";
var _baseAccPwd = "123";

var _ownerWallet = _ownerAcc; //"0x20154D90491630A3d8EA09deD4e8D14269Ac22dF"; //"0x15a99D10a6b9f6b3F8962133482508295190B7DC";

const _contractFileName = "contracts/nucleus_token3.sol";
var _contractAddress = "0x46692F445ECB1A1A65bE9F718F46c3AaBa7C683b"; //"0x070F441594d72F572Da49110F5FCC18EAdA7d580"; //"0x7d8BEee4E2AFa2504df055EC6eCd1014388cF87a"; //"0xcD7819aD0ef9E33d5441eC6b13aBD22D4cB4e995"; //"0xA3A5e6D92EBd55ee62cc6D07088FeD5673E7ED30"; //"0x113aE280661d1d74c142864F2F16002AD581e8e3"; //"0xEB9b5C80ab6D7dD8d9da1223A4467e8D744645CC"; //"0xaa1e29854f9f4d41cf386e2858972f23da5bffe1"; //"0x89693da18c7741e51221Ef28A9Aa0B99daF8A97E"; //"0xa56e415bde7283d4e6717b471935ed0850691027"; //"0x97F26A2e110a3f020Af68b100E620615efD1D221";
const _contractName = "NucleusTokenSale"; //"NCashToken";

const _reserveWallet = "0x3559c44dcec5874c8747f6ff6f80415b57443017"; //"0xd425114da1911d533806f382ae4a098135bea93e";
const _teamWallet = "0x7a5cb81470d75c4f7541fedf7d1a3f74b26ac0e4"; //"0xe5c4d6e3f2d3e44e320216a4aa84a48c7436edb4";
const _partnersWallet = "0x0f34865976def109f9e95a3564a0a2d4e9aaae8c"; //"0xc9a354fd5c9cabd30d8c26816b5c8c048124f86c";
const _reservePercent = 25;
const _teamPercent = 20;
const _partnersPercent = 5;

const _btcWallet = "0xYYYYYYYYYYYYYYYYYYYYY";

const _gasLimit = 6700000;
const _gasPrice = 40000000000;

//const input = fs.readFileSync(_contractFileName);
// console.log("start compiling...");
// const output = solc.compile(input.toString(), 1);
// console.log("getting bytecode...");
// const bytecode = output.contracts[':'+_contractName].bytecode;
// console.log("parsing ABI...");
// const abi = JSON.parse(output.contracts[':'+_contractName].interface);
// console.log("creating contract...");
//const NCash = web3.eth.contract(abi);

//console.log("--------");
//console.log(input);
//console.log("--------");

const _binFile = "contracts/NucleusTokenSale.bin";
const _abiFile = "contracts/NucleusTokenSale.abi";
var NCash = null;
var _contract = null; //NCash.at(_contractAddress);

class Interface {

    // HELPER FUNCTIONS //

    // Converts Hex to String
    hex2a(hexx) {
        var hex = hexx.toString();//force conversion
        var str = '';
        for (var i = 0; i < hex.length; i += 2)
            str += String.fromCharCode(parseInt(hex.substr(i, 2), 16));
        return str;
    }

    init(addr) {
        if(!addr || addr == "") addr = _contractAddress;
        console.log("INIT("+addr+")");
        _contractAddress = addr;

        console.log("getting bytecode...");
        const bytecode = fs.readFileSync(_binFile);
        console.log("parsing ABI...");
        const abi = JSON.parse(fs.readFileSync(_abiFile));
        console.log("creating contract...");
        NCash = web3.eth.contract(abi);

        _contract = NCash.at(_contractAddress);
        return _contract;
    }

    // Returns the current balance of a contract or account
    etherBalance(contract) {
        if(!contract || contract == "") contract = _baseAcc;
        switch (typeof(contract)) {
            case "object":
                if (contract.address) {
                    return web3.fromWei(web3.eth.getBalance(contract.address), 'ether').toNumber()
                } else {
                    return new Error("cannot call getEtherBalance on an object that does not have a property 'address'")
                }
                break
            case "string":
                return web3.fromWei(web3.eth.getBalance(contract), 'ether').toNumber()
                break
        }
    }

    baseAccount() {
        // personal.unlockAccount("0x15a99D10a6b9f6b3F8962133482508295190B7DC", "1q2w3e4r5t6y")
        return _baseAcc;
    }

    unlockOwnerAccount() {
        console.log("unlockOwnerAccount");
        return personal.unlockAccount(_ownerAcc, _ownerAccPwd);
    }

    unlockBaseAccount() {
        console.log("unlockBaseAccount");
        return personal.unlockAccount(_baseAcc, _baseAccPwd);
    }

    sendBaseEtherToAccount(acc, amount, cb) {
        console.log("sendBaseEtherToAccount("+acc+", "+amount+")");
        this.unlockBaseAccount().then(
            function (a) {
                if (a == true) {
                    console.log("sendTransaction...");

                    web3.eth.sendTransaction({from: _baseAcc, to: acc, value: amount}, 
                        function(err, transactionHash) {
                            console.log("sendBaseEtherToAccount: "+(err ? "error = "+err : transactionHash));
                            if(cb) cb(err, transactionHash);
                        });
                } else {
                    console.log("Unlock error");
                    if(cb) cb("Unlock error");
                }
            });
    }

    sendBaseTokensToAccount(to, amount, cb) {
        console.log("sendBaseTokensToAccount("+to+", "+amount+")");
        if(!_contract) this.init();
        this.unlockOwnerAccount().then(
            function (a) {
                if (a == true) {
                    console.log("sendTransaction...");

                    var tx = _contract.transfer(to, amount, {from: _ownerAcc,gas: _gasLimit, gasPrice: _gasPrice});
                    if(cb) cb(null, tx);
                } else {
                    console.log("Unlock error");
                    if(cb) cb("Unlock error");
                }
            });
    }

    mintTokensToAccount(to, amount, cb) {
        console.log("mintTokensToAccount("+to+", "+amount+")");
        if(!_contract) this.init();
        this.unlockOwnerAccount().then(
            function (a) {
                if (a == true) {
                    console.log("sendTransaction...");

                    var tx = _contract.mintToken(to, amount, {from: _ownerAcc, gas: _gasLimit, gasPrice: _gasPrice});
                    if(cb) cb(null, tx);
                } else {
                    console.log("Unlock error");
                    if(cb) cb("Unlock error");
                }
            });
    }

    transferOwnership(newOwner, cb) {
        console.log("transferOwnership("+newOwner+")");
        if(!_contract) this.init();
        this.unlockOwnerAccount().then(
            function (a) {
                if (a == true) {
                    console.log("sendTransaction...");

                    var tx = _contract.transferOwnership(newOwner, {from: _ownerAcc, gas: _gasLimit, gasPrice: _gasPrice});
                    if(cb) cb(null, tx);
                } else {
                    console.log("Unlock error");
                    if(cb) cb("Unlock error");
                }
            });

    }

    changeBaseAccount(addr, pwd) {
        _baseAcc = addr;
        _baseAccPwd = pwd;
    }

    deployContract(initialAmount, cb) {
        console.log("deployContract");
        var _this = this;
        this.unlockOwnerAccount().then(
            function (a) {
                if (a == true) {

                    console.log("getting bytecode...");
                    const bytecode = fs.readFileSync(_binFile);
                    console.log("parsing ABI...");
                    const abi = JSON.parse(fs.readFileSync(_abiFile));
                    console.log("creating contract...");
                    NCash = web3.eth.contract(abi);

                    console.log("start deployment...");
                    _contract = NCash.new(
                        initialAmount, "NC09Test", 0, "NCN09", "NCC09Test", "NCC09", 
                        // _reserveWallet, _teamWallet, _partnersWallet,
                        // _reservePercent, _teamPercent, _partnersPercent,
                        _baseAcc, //_ownerWallet, _btcWallet, 
                        {
                            data: '0x' + bytecode,
                            from: _ownerAcc,
                            gas: _gasLimit, //web3.eth.estimateGas({data: '0x'+bytecode}),
                            gasPrice: _gasPrice
                        }, (err, res1) => {
                            if (err) {
                                console.log("contract deploy error:" + err);
                            } else {
                                // If we have an address property, the contract was deployed
                                if (res1.address) {
                                    console.log('Contract address: ' + res1.address);
                                    //_contractAddress = res1.address;
                                    //_this.init(res1.address);
                                } else {
                                    // Log the tx, you can explore status with eth.getTransaction()
                                    console.log("Contract transactionHash: " + res1.transactionHash);
                                }
                            }
                            if(cb) {
                                cb(err, res1);
                                cb = null; // disable second call
                            }
                        });
                } else {
                    console.log("Unlock error");
                    if(cb) cb("Unlock error");
                }
            });
    }

    distributeTokens(cb) {
        console.log("distributeTokens()");
        var _this = this;
        if(!_contract) this.init();
        this.unlockOwnerAccount().then(
            function (a) {
                if (a == true) {
                    var tx = _contract.distributeTokens(
                        _reserveWallet, _teamWallet, _partnersWallet,
                        _reservePercent, _teamPercent, _partnersPercent,
                        {from: _ownerAcc, gas: _gasLimit, gasPrice: _gasPrice});
                    console.log("_contract.distributeTokens: "+ tx);
                    if(cb) cb(null, tx);
                } else {
                    console.log("Unlock error");
                    if(cb) cb("Unlock error");
                }
            });
    }

    deployNCashToken(cb) {
        console.log("deployNCashToken");
        var _this = this;
        this.unlockOwnerAccount().then(
            function (a) {
                if (a == true) {
                    console.log("getting bytecode...");
                    const bytecode = fs.readFileSync("contracts/NCashToken.bin");
                    console.log("parsing ABI...");
                    const abi = JSON.parse(fs.readFileSync("contracts/NCashToken.abi"));
                    console.log("creating contract...");
                    var NCashToken = web3.eth.contract(abi);

                    console.log("start deployment...");
                    var _tkn = NCashToken.new(10000000000, "NC33Test", 0, "NCN33",
                        24*3600 + Math.floor(Date.now() / 1000),
                        {
                            data: '0x' + bytecode,
                            from: _ownerAcc,
                            gas: _gasLimit, gasPrice: _gasPrice
                        }, (err, res1) => {
                            if (err) {
                                console.log("contract deploy error:" + err);
                            } else {
                                // If we have an address property, the contract was deployed
                                if (res1.address) {
                                    console.log('Contract address: ' + res1.address);
                                    //_contractAddress = res1.address;
                                    //_this.init(res1.address);
                                } else {
                                    // Log the tx, you can explore status with eth.getTransaction()
                                    console.log("Contract transactionHash: " + res1.transactionHash);
                                }
                            }
                            if(cb) {
                                cb(err, res1);
                                cb = null; // disable second call
                            }
                        });
                } else {
                    console.log("Unlock error");
                    if(cb) cb("Unlock error");
                }
            });
    }

    whitelistAccount(addr, flag, cb) {
        console.log("whitelistAccount("+addr+")");
        var _this = this;
        if(!_contract) this.init();
        this.unlockBaseAccount().then(
            function (a) {
                if (a == true) {
                    //web3.eth.defaultAccount = _baseAcc;
                    var tx = _contract.whitelistAccount(addr, flag, {from: _baseAcc, gas: _gasLimit, gasPrice: _gasPrice});
                    console.log("_contract.whitelistAccount: "+ tx);
                    if(cb) cb(null, tx);
                } else {
                    console.log("Unlock error");
                    if(cb) cb("Unlock error");
                }
            });
    }

    approveAccount(addr, flag, cb) {
        console.log("approveAccount("+addr+")");
        var _this = this;
        if(!_contract) this.init();
        this.unlockBaseAccount().then(
            function (a) {
                if (a == true) {
                    //web3.eth.defaultAccount = _baseAcc;
                    var tx = _contract.approveAccount(addr, flag, {from: _baseAcc, gas: _gasLimit, gasPrice: _gasPrice});
                    console.log("_contract.approveAccount: "+ tx);
                    if(cb) cb(null, tx);
                } else {
                    console.log("Unlock error");
                    if(cb) cb("Unlock error");
                }
            });
    }

    addPreSaleAccount(addr, flag, lockTimeout, bonus, cb) {
        console.log("addPreSaleAccount("+addr+","+flag+","+lockTimeout+","+bonus+")");
        var _this = this;
        if(!_contract) this.init();
        this.unlockBaseAccount().then(
            function (a) {
                if (a == true) {
                    //web3.eth.defaultAccount = _baseAcc;
                    var tx = _contract.addPreSaleAccount(addr, flag, lockTimeout, bonus, {from: _baseAcc, gas: _gasLimit, gasPrice: _gasPrice});
                    console.log("_contract.addPreSaleAccount: "+ tx);
                    if(cb) cb(null, tx);
                } else {
                    console.log("Unlock error");
                    if(cb) cb("Unlock error");
                }
            });
    }

    changeAdmin(addr, cb) {
        console.log("changeAdmin("+addr+")");
        var _this = this;
        if(!_contract) this.init();
        this.unlockOwnerAccount().then(
            function (a) {
                if (a == true) {
                    //web3.eth.defaultAccount = _baseAcc;
                    var oldAdmin = _contract.admin;
                    console.log("oldAdmin: "+ oldAdmin);
                    var tx = _contract.transferAdmin(addr, {from: _ownerAcc, gas: _gasLimit, gasPrice: _gasPrice});
                    console.log("_contract.transferAdmin: "+ tx);
                    var newAdmin = _contract.admin;
                    console.log("newAdmin: "+ oldAdmin);
                    if(cb) cb(null, {tx: tx, old: oldAdmin, new: newAdmin});
                } else {
                    console.log("Unlock error");
                    if(cb) cb("Unlock error");
                }
            });
    }

    changeWallet(addr, cb) {
        console.log("changeWallet("+addr+")");
        var _this = this;
        if(!_contract) this.init();
        this.unlockOwnerAccount().then(
            function (a) {
                if (a == true) {
                    //web3.eth.defaultAccount = _baseAcc;
                    var tx = _contract.setWallets(addr, "", {from: _ownerAcc, gas: _gasLimit, gasPrice: _gasPrice});
                    console.log("_contract.setWallets: "+ tx);
                    if(cb) cb(null, tx);
                } else {
                    console.log("Unlock error");
                    if(cb) cb("Unlock error");
                }
            });
    }

    getBalance(acc) {
        console.log("getBalance("+acc+")");
        if(!_contract) this.init();
        if(!acc || acc == "") acc = _baseAcc;
        web3.eth.defaultAccount = acc;
        return _contract.getAccountBalance(acc);
    }

    isPreSale(addr, cb) {
        console.log("isPreSale("+addr+")");
        var _this = this;
        if(!_contract) this.init();
        this.unlockBaseAccount().then(
            function (a) {
                if (a == true) {
                    web3.eth.defaultAccount = _baseAcc;
                    //var wt = _contract.getWhitelistedSaleStartTime({gas: 2000000});
                    //var pt = _contract.getPublicSaleStartTime({gas: 2000000});
                    var tt = _contract.isPreSale(addr);
                    console.log("_contract.isPreSale: "+ tt);
                    if(cb) cb(null, tt);
                } else {
                    console.log("Unlock error");
                    if(cb) cb("Unlock error");
                }
            });
    }

    isWhitelisted(addr, cb) {
        console.log("isWhitelisted("+addr+")");
        var _this = this;
        if(!_contract) this.init();
        this.unlockBaseAccount().then(
            function (a) {
                if (a == true) {
                    web3.eth.defaultAccount = _baseAcc;
                    //var wt = _contract.getWhitelistedSaleStartTime({gas: 2000000});
                    //var pt = _contract.getPublicSaleStartTime({gas: 2000000});
                    var tt = _contract.isWhitelisted(addr);
                    console.log("_contract.isWhitelisted: "+ tt);
                    if(cb) cb(null, tt);
                } else {
                    console.log("Unlock error");
                    if(cb) cb("Unlock error");
                }
            });
    }

    isApproved(addr, cb) {
        console.log("isApproved("+addr+")");
        var _this = this;
        if(!_contract) this.init();
        this.unlockBaseAccount().then(
            function (a) {
                if (a == true) {
                    web3.eth.defaultAccount = _baseAcc;
                    //var wt = _contract.getWhitelistedSaleStartTime({gas: 2000000});
                    //var pt = _contract.getPublicSaleStartTime({gas: 2000000});
                    var tt = _contract.isApproved(addr);
                    console.log("_contract.isApproved: "+ tt);
                    if(cb) cb(null, tt);
                } else {
                    console.log("Unlock error");
                    if(cb) cb("Unlock error");
                }
            });
    }

    getSaleStartTimes(cb) {
        console.log("getSaleStartTimes()");
        var _this = this;
        if(!_contract) this.init();
        this.unlockBaseAccount().then(
            function (a) {
                if (a == true) {
                    web3.eth.defaultAccount = _baseAcc;
                    //var wt = _contract.getWhitelistedSaleStartTime({gas: 2000000});
                    //var pt = _contract.getPublicSaleStartTime({gas: 2000000});
                    var tt = _contract.getSaleTimes();
                    console.log("_contract.getSaleTimes: "+ tt);
                    if(cb) cb(null, tt);
                } else {
                    console.log("Unlock error");
                    if(cb) cb("Unlock error");
                }
            });
    }

    setSaleStartTimes(whitelistedStartTime, publicStartTime, endTime, lockTokenTimeout, cb) {
        console.log("setSaleStartTimes(" + whitelistedStartTime + ", " + publicStartTime + ", " + endTime + ", " + lockTokenTimeout + ")");
        var _this = this;
        if(!_contract) this.init();
        this.unlockBaseAccount().then(
            function (a) {
                if (a == true) {
                    //web3.eth.defaultAccount = _baseAcc;
                    // var wtx = _contract.setWhitelistedSaleStartTime(whitelistedStartTime, {gas: 2000000});
                    // var ptx = _contract.setPublicSaleStartTime(publicStartTime, {gas: 2000000});
                    var tx = _contract.setSaleTimes(whitelistedStartTime, publicStartTime, endTime, lockTokenTimeout, {from: _baseAcc, gas: _gasLimit, gasPrice: _gasPrice});
                    console.log("_contract.setSaleTimes: "+ tx);
                    if(cb) cb(null, tx);
                } else {
                    console.log("Unlock error");
                    if(cb) cb("Unlock error");
                }
            });
    }

    getSaleSettings(cb) {
        console.log("getSaleSettings()");
        var _this = this;
        if(!_contract) this.init();
        this.unlockBaseAccount().then(
            function (a) {
                if (a == true) {
                    web3.eth.defaultAccount = _baseAcc;
                    var tt = _contract.getSaleSettings();
                    console.log("_contract.getSaleSettings: "+ tt);
                    if(cb) cb(null, tt);
                } else {
                    console.log("Unlock error");
                    if(cb) cb("Unlock error");
                }
            });
    }

    setSaleSettings(wStartTime, pStartTime, eTime, lockTimeout, ePrice, bPrice, minEth, minGas, maxGas, 
            minGasPrice, maxGasPrice, bonus, bonusBuyers, softCap, hardCap, cb) {
        //console.log("setSaleSettings(" + whitelistedStartTime + ", " + publicStartTime + ")");
        var _this = this;
        if(!_contract) this.init();
        this.unlockBaseAccount().then(
            function (a) {
                if (a == true) {
                    var tx = _contract.setSaleSettings(wStartTime, pStartTime, eTime, lockTimeout, ePrice, bPrice, 
                        minEth, minGas, maxGas, minGasPrice, maxGasPrice, bonus, bonusBuyers, 
                        softCap, hardCap, {from: _baseAcc, gas: _gasLimit, gasPrice: _gasPrice});
                    console.log("_contract.setSaleSettings: "+ tx);
                    if(cb) cb(null, tx);
                } else {
                    console.log("Unlock error");
                    if(cb) cb("Unlock error");
                }
            });
    }

    getStats(cb) {
        console.log("getStats()");
        var _this = this;
        if(!_contract) this.init();
        this.unlockBaseAccount().then(
            function (a) {
                if (a == true) {
                    web3.eth.defaultAccount = _baseAcc;
                    var tt = _contract.getStats();
                    console.log("_contract.getStats: "+ tt);
                    if(cb) cb(null, tt);
                } else {
                    console.log("Unlock error");
                    if(cb) cb("Unlock error");
                }
            });
    }

    checkCanBuy(addr, ethAmount, cb) {
        console.log("checkCanBuy(" + addr + ", " + ethAmount + ")");
        var _this = this;
        if(!_contract) this.init();
        this.unlockBaseAccount().then(
            function (a) {
                if (a == true) {
                    //web3.eth.defaultAccount = _baseAcc;
                    // var tt = _contract.checkCanBuy(addr, web3.toDecimal(ethAmount), {from: _baseAcc, gas: 2000000});
                    var tt = _contract.checkCanBuy(addr, ethAmount, {from: _baseAcc, gas: _gasLimit, gasPrice: _gasPrice});
                    console.log("_contract.checkCanBuy: "+ tt);
                    if(cb) cb(null, tt);
                } else {
                    console.log("Unlock error");
                    if(cb) cb("Unlock error");
                }
            });
    }

    buyTokens(addr, pwd, ethAmount, cb) {
                    
        console.log("buyTokens(" + addr + ", " + ethAmount + ")");
        var _this = this;
        if(!_contract) this.init();
        personal.unlockAccount(addr, pwd).then(
            function (a) {
                if (a == true) {
                    //web3.eth.defaultAccount = addr;
                    var tt = _contract.buy({ from: addr, value: ethAmount, gas: _gasLimit, gasPrice: _gasPrice});
                    console.log("_contract.buy: "+ tt);
                    if(cb) cb(null, tt);
                } else {
                    console.log("Unlock error");
                    if(cb) cb("Unlock error");
                }
            });

    }

}

exports.Interface = Interface;
