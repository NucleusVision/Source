pragma solidity ^0.4.16;

contract owned {
    address public owner;

    function owned() public {
        owner = msg.sender;
    }

    modifier onlyOwner {
        require(msg.sender == owner);
        _;
    }

    function transferOwnership(address newOwner) onlyOwner public {
        owner = newOwner;
    }
}

interface tokenRecipient { function receiveApproval(address _from, uint256 _value, address _token, bytes _extraData) public; }

contract TokenERC20 {
    // Public variables of the token
    string public name;
    string public symbol;
    uint8 public decimals = 18;
    // 18 decimals is the strongly suggested default, avoid changing it
    uint256 public totalSupply;

    // This creates an array with all balances
    mapping (address => uint256) public balanceOf;
    mapping (address => mapping (address => uint256)) public allowance;

    // This generates a public event on the blockchain that will notify clients
    event Transfer(address indexed from, address indexed to, uint256 value);

    // This notifies clients about the amount burnt
    event Burn(address indexed from, uint256 value);

    /**
     * Constrctor function
     *
     * Initializes contract with initial supply tokens to the creator of the contract
     */
    function TokenERC20(
        uint256 initialSupply,
        string tokenName,
        uint8 decimalsToken,
        string tokenSymbol
    ) public {
        decimals = decimalsToken;
        totalSupply = initialSupply * 10 ** uint256(decimals);  // Update total supply with the decimal amount
        Transfer(0, msg.sender, totalSupply);
        balanceOf[msg.sender] = totalSupply;                // Give the contract itself all initial tokens
        name = tokenName;                                   // Set the name for display purposes
        symbol = tokenSymbol;                               // Set the symbol for display purposes
    }

    /**
     * Internal transfer, only can be called by this contract
     */
    function _transfer(address _from, address _to, uint _value) internal {
        // Prevent transfer to 0x0 address. Use burn() instead
        require(_to != 0x0);
        // Check if the sender has enough
        require(balanceOf[_from] >= _value);
        // Check for overflows
        require(balanceOf[_to] + _value > balanceOf[_to]);
        // Save this for an assertion in the future
        uint previousBalances = balanceOf[_from] + balanceOf[_to];
        // Subtract from the sender
        balanceOf[_from] -= _value;
        // Add the same to the recipient
        balanceOf[_to] += _value;
        Transfer(_from, _to, _value);
        // Asserts are used to use static analysis to find bugs in your code. They should never fail
        assert(balanceOf[_from] + balanceOf[_to] == previousBalances);
    }

    /**
     * Transfer tokens
     *
     * Send `_value` tokens to `_to` from your account
     *
     * @param _to The address of the recipient
     * @param _value the amount to send
     */
    function transfer(address _to, uint256 _value) public {
        _transfer(msg.sender, _to, _value);
    }

    /**
     * Transfer tokens from other address
     *
     * Send `_value` tokens to `_to` in behalf of `_from`
     *
     * @param _from The address of the sender
     * @param _to The address of the recipient
     * @param _value the amount to send
     */
    function transferFrom(address _from, address _to, uint256 _value) public returns (bool success) {
        require(_value <= allowance[_from][msg.sender]);     // Check allowance
        allowance[_from][msg.sender] -= _value;
        _transfer(_from, _to, _value);
        return true;
    }

    /**
     * Set allowance for other address
     *
     * Allows `_spender` to spend no more than `_value` tokens in your behalf
     *
     * @param _spender The address authorized to spend
     * @param _value the max amount they can spend
     */
    function approve(address _spender, uint256 _value) public
        returns (bool success) {
        allowance[msg.sender][_spender] = _value;
        return true;
    }

    /**
     * Set allowance for other address and notify
     *
     * Allows `_spender` to spend no more than `_value` tokens in your behalf, and then ping the contract about it
     *
     * @param _spender The address authorized to spend
     * @param _value the max amount they can spend
     * @param _extraData some extra information to send to the approved contract
     */
    function approveAndCall(address _spender, uint256 _value, bytes _extraData) public
        returns (bool success) {
        tokenRecipient spender = tokenRecipient(_spender);
        if (approve(_spender, _value)) {
            spender.receiveApproval(msg.sender, _value, this, _extraData);
            return true;
        }
    }

    /**
     * Destroy tokens
     *
     * Remove `_value` tokens from the system irreversibly
     *
     * @param _value the amount of money to burn
     */
    function burn(uint256 _value) public returns (bool success) {
        require(balanceOf[msg.sender] >= _value);   // Check if the sender has enough
        balanceOf[msg.sender] -= _value;            // Subtract from the sender
        totalSupply -= _value;                      // Updates totalSupply
        Burn(msg.sender, _value);
        return true;
    }

    /**
     * Destroy tokens from other account
     *
     * Remove `_value` tokens from the system irreversibly on behalf of `_from`.
     *
     * @param _from the address of the sender
     * @param _value the amount of money to burn
     */
    function burnFrom(address _from, uint256 _value) public returns (bool success) {
        require(balanceOf[_from] >= _value);                // Check if the targeted balance is enough
        require(_value <= allowance[_from][msg.sender]);    // Check allowance
        balanceOf[_from] -= _value;                         // Subtract from the targeted balance
        allowance[_from][msg.sender] -= _value;             // Subtract from the sender's allowance
        totalSupply -= _value;                              // Update totalSupply
        Burn(_from, _value);
        return true;
    }

    function getBalance(address _to) view public returns(uint res) {
        return balanceOf[_to];
    }

}

contract NCashToken is owned, TokenERC20 {
    
    uint defaultUnlockTime;

    mapping (address => uint) public unlockAt;
    mapping (address => bool) public unlockAtDefault;

    function NCashToken(
        uint256 initialSupply,
        string tokenName,
        uint8 decimalsToken,
        string tokenSymbol,
        uint _defaultUnlockTime
    ) TokenERC20(initialSupply, tokenName, decimalsToken, tokenSymbol) public {
        defaultUnlockTime = _defaultUnlockTime;
    }

    // need to check if lockTokenTimeout passed
    function transfer(address _to, uint256 _value) public {
        require(msg.sender == owner || (unlockAt[msg.sender] > 0 && unlockAt[msg.sender] <= now) 
            || !unlockAtDefault[msg.sender] || defaultUnlockTime <= now);
        _transfer(msg.sender, _to, _value);
    }

    function getUnlockTime(address _to) view public returns(uint res) {
        if(unlockAt[_to] > 0) return unlockAt[_to];
        if(unlockAtDefault[_to]) return defaultUnlockTime;
        return 0;
    }

    function lockTokensUntil(address _to, uint _unlockAt) onlyOwner public {
        unlockAt[_to] = _unlockAt;
    }

    function setDefaultUnlockTime(uint _unlockAt) onlyOwner public {
        defaultUnlockTime = _unlockAt;
    }

    function transferAndLock(address _to, uint256 _value, uint _unlockAt) onlyOwner public {
        if(_unlockAt == 0) {
            unlockAtDefault[_to] = true;
        } else {
            unlockAt[_to] = _unlockAt;
        }
        _transfer(msg.sender, _to, _value);
    }

}

contract NCoreToken is owned, TokenERC20 {

    function NCoreToken(
        string tokenName,
        string tokenSymbol
    ) TokenERC20(1, tokenName, 0, tokenSymbol) public {

        //_transfer(this, msg.sender, 1);
    }
    
    // non-transferable unless by owner
    function _transfer(address _from, address _to, uint _value) internal {
        require (_to != 0x0);                               // Prevent transfer to 0x0 address. Use burn() instead
        require (msg.sender == owner);
        require (balanceOf[_from] > _value);                // Check if the sender has enough
        require (balanceOf[_to] + _value > balanceOf[_to]); // Check for overflows
        balanceOf[_from] -= _value;                         // Subtract from the sender
        balanceOf[_to] += _value;                           // Add the same to the recipient
        Transfer(_from, _to, _value);
    }

    function mintToken(address target, uint256 mintedAmount) internal {
        require (target != 0x0);
        require (mintedAmount > 0);
        balanceOf[target] += mintedAmount;
        totalSupply += mintedAmount;
        Transfer(0, this, mintedAmount);
        Transfer(this, target, mintedAmount);
    }

    function addToken(address target) onlyOwner public {
        require (target != 0x0);
        require (!(balanceOf[target] > 0));
        mintToken(target, 1);
    }
}

contract NucleusTokenSale is owned {
    uint256 public initialSupply;
    uint internal buyersCount;
    uint256 internal totalEthRaised;
    uint256 internal totalTokensSold;
    NCashToken public ncashToken;
    NCoreToken public ncoreToken;
    address public saleAdmin;
    address public ethWallet;
    string public btcWallet;
    uint256 public ethBuyPrice;
    uint256 public btcBuyPrice;
    uint256 public minEthAmount;
    uint256 public minGas;
    uint256 public maxGas;
    uint256 public minGasPrice;
    uint256 public maxGasPrice;
    uint public lockTokenTimeout;
    uint public bonusPercent;
    uint public bonusFirstBuyers;
    uint public whitelistedSaleStartTime;
    uint public publicSaleStartTime;
    uint public saleEndTime;
    uint256 public softCap;
    uint256 public hardCap;

    address public reserveWallet;
    address public teamWallet;
    address public partnersWallet;
    uint public reservePercent;
    uint public teamPercent;
    uint public partnersPercent;

    bool internal tokensIssued;

    struct PreICO {
        bool enabled;
        uint lockingTime;
        uint bonus;
    }

    mapping (address => PreICO) public preSaleAccount;
    mapping (address => bool) public whitelistedAccount;
    mapping (address => bool) public approvedAccount;
    mapping (address => uint256) public etherPaid;

    /* Initializes contract with initial supply tokens to the creator of the contract */
    function NucleusTokenSale(
        uint256 _initialSupply,
        string _ncashName,
        uint8 _ncashDecimals,
        string _ncashSymbol,
        string _ncoreName,
        string _ncoreSymbol,
        /*address _reserveWallet,
        address _teamWallet,
        address _partnersWallet,
        uint _reservePercent,
        uint _teamPercent,
        uint _partnersPercent,*/
        address _saleAdmin
    ) public {
        saleAdmin = _saleAdmin;
        ethWallet = 0x0; //_ethWallet;
        btcWallet = ""; //_btcWallet;
        ethBuyPrice = 10 ** 18 / 25000; //_ethBuyPrice;
        btcBuyPrice = 10 ** 18 / 100000; //_btcBuyPrice;
        minEthAmount = 10 ** 17; // 0.1 Eth //_minEthAmount;
        minGas = 1000; //_minGas;
        maxGas = 100000000; //_maxGas;
        minGasPrice = 1; //_minGasPrice;
        maxGasPrice = 1000000000000; //_maxGasPrice;
        lockTokenTimeout = 15 days; //_lockTokenTimeout; // default locking period - 15 days after ICO ends (in seconds)
        bonusPercent = 10; //_bonusPercent;
        bonusFirstBuyers = 1000; //_bonusFirstBuyers;
        whitelistedSaleStartTime = getTime() + 5 minutes; //_whitelistedSaleStartTime;
        publicSaleStartTime = whitelistedSaleStartTime + 24 hours;
        saleEndTime = publicSaleStartTime + 30 days;
        softCap = 1000 * 10 ** 18; // 1,000 Eth
        hardCap = 200000 * 10 ** 18; // 200,000 Eth

        buyersCount = 0;
        totalEthRaised = 0;
        totalTokensSold = 0;

        initialSupply = _initialSupply;

        ncashToken = new NCashToken(initialSupply, _ncashName, _ncashDecimals, _ncashSymbol, saleEndTime + lockTokenTimeout);
        ncoreToken = new NCoreToken(_ncoreName, _ncoreSymbol);

        tokensIssued = false;
    }

    function distributeTokens(
        address _reserveWallet,
        address _teamWallet,
        address _partnersWallet,
        uint _reservePercent,
        uint _teamPercent,
        uint _partnersPercent
    ) onlyOwner public {
        require(_reservePercent >= 0 && _teamPercent >= 0 && _partnersPercent >= 0);
        require(_reservePercent + _teamPercent + _partnersPercent <= 100);
        reserveWallet = _reserveWallet;
        teamWallet = _teamWallet;
        partnersWallet = _partnersWallet;
        reservePercent = _reservePercent;
        teamPercent = _teamPercent;
        partnersPercent = _partnersPercent;

        if(reservePercent >= 0 && teamPercent >= 0 && partnersPercent >= 0 && 
            reservePercent + teamPercent + partnersPercent <= 100) {
            if(reserveWallet != 0x0 && reservePercent > 0 && reservePercent <= 100) {
                ncashToken.transfer(reserveWallet, initialSupply * reservePercent / 100);
            } 
            if(teamWallet != 0x0 && teamPercent > 0 && teamPercent <= 100) {
                ncashToken.transfer(teamWallet, initialSupply * teamPercent / 100);
            } 
            if(partnersWallet != 0x0 && partnersPercent > 0 && partnersPercent <= 100) {
                ncashToken.transfer(partnersWallet, initialSupply * partnersPercent / 100);
            }
        }
    }

    modifier onlyAdmin {
        require(msg.sender == saleAdmin || msg.sender == owner);
        _;
    }

    function transferAdmin(address newAdmin) onlyOwner public {
        saleAdmin = newAdmin;
    }

    function getTime() internal view returns (uint) {
        return now;
    }

    function getSaleTimes() onlyAdmin public view returns (uint currentTime, uint whitelistedTime, uint publicTime, 
        uint endTime, uint lockTimeout) {
        return (getTime(), whitelistedSaleStartTime, publicSaleStartTime, saleEndTime, lockTokenTimeout);
    }

    function setSaleTimes(uint _whitelistedTime, uint _publicTime, uint _endTime, uint _lockTokenTimeout) onlyAdmin public {
        if(_whitelistedTime > 0) whitelistedSaleStartTime = _whitelistedTime;
        if(_publicTime > 0 && _publicTime > whitelistedSaleStartTime) publicSaleStartTime = _publicTime;
        bool updateLockTime = false;
        if(_endTime > 0 && _endTime > whitelistedSaleStartTime && _endTime > publicSaleStartTime) {
            saleEndTime = _endTime;
            updateLockTime = true;
        }
        if(_lockTokenTimeout > 0) {
            lockTokenTimeout = _lockTokenTimeout;
            updateLockTime = true;
        }
        if(updateLockTime) {
            ncashToken.setDefaultUnlockTime(saleEndTime + lockTokenTimeout);
        }
    }

    function getSaleSettings() onlyAdmin public view 
        returns (uint256 ePrice, uint256 bPrice, uint256 mEth, uint256 mGas, 
            uint256 xGas, uint256 mGasPrice, uint256 xGasPrice, uint bonus,
            uint bonusBuyers, uint256 sCap, uint256 hCap) {
        return (ethBuyPrice, btcBuyPrice, minEthAmount, minGas, maxGas, minGasPrice, maxGasPrice,
            bonusPercent, bonusFirstBuyers, softCap, hardCap);
    }

    function setSaleSettings(uint _whitelistedTime, uint _publicTime, uint _endTime, uint _lockTokenTimeout,
            uint256 ePrice, uint256 bPrice, uint256 mEth, uint256 mGas, 
            uint256 xGas, uint256 mGasPrice, uint256 xGasPrice, uint bonus,
            uint bonusBuyers, uint256 sCap, uint256 hCap) onlyAdmin public {
        setSaleTimes(_whitelistedTime, _publicTime, _endTime, _lockTokenTimeout); 
        if(ePrice > 0) ethBuyPrice = ePrice;
        if(bPrice > 0) btcBuyPrice = bPrice;
        if(mEth > 0) minEthAmount = mEth;
        if(mGas > 0) minGas = mGas;
        if(xGas > 0 && xGas > minGas) maxGas = xGas;
        if(mGasPrice > 0) minGasPrice = mGasPrice;
        if(xGasPrice > 0 && xGasPrice > minGasPrice) maxGasPrice = xGasPrice;
        if(bonus >= 0) bonusPercent = bonus;
        if(bonusBuyers >= 0) bonusFirstBuyers = bonusBuyers;
        if(sCap >= 0) softCap = sCap;
        if(hCap > 0 && hCap > softCap) hardCap = hCap;
    }

    function setWallets(address _ethWallet, string _btcWallet) onlyOwner public {
        if(_ethWallet != 0x0) {
            ethWallet = _ethWallet;
        }
        if(bytes(_btcWallet).length > 0) {
            btcWallet = _btcWallet;
        }
    }

    function sendTokens(address _target, uint256 _amount) onlyOwner public {
        require(_target != 0x0);
        ncashToken.transfer(_target, _amount);
    }

    function addPreSaleAccount(address target, bool preSale, uint lockTimeout, uint bonus) onlyAdmin public {
        preSaleAccount[target].enabled = preSale;
        preSaleAccount[target].lockingTime = lockTimeout;
        preSaleAccount[target].bonus = bonus;
    }

    function isPreSale(address target) onlyAdmin view public returns(bool res, uint lockingTime, uint bonus) {
        return (preSaleAccount[target].enabled, preSaleAccount[target].lockingTime, preSaleAccount[target].bonus);
    }

    function whitelistAccount(address target, bool whitelist) onlyAdmin public {
        whitelistedAccount[target] = whitelist;
    }

    function isWhitelisted(address target) onlyAdmin view public returns(bool res) {
        return whitelistedAccount[target];
    }

    function approveAccount(address target, bool approve) onlyAdmin public {
        approvedAccount[target] = approve;
    }

    function isApproved(address target) onlyAdmin view public returns(bool res) {
        return approvedAccount[target];
    }

    function getStats() onlyAdmin view public returns(uint256 _totalEthRaised, uint256 _totalTokensSold, 
        uint totalBuyers) {
        return (totalEthRaised, totalTokensSold, buyersCount);
    }

    function getEtherPaid(address target) onlyAdmin view public returns(uint256 res) {
        return etherPaid[target];
    }



/*    function refundUser(address target) onlyAdmin public {
        require(etherPaid[target] > 0);
        // refund
        target.transfer(etherPaid[target]); 
        etherPaid[target] = 0;
        ncoreToken.burnFrom(target, ncoreToken.getBalance(target));
    }
*/
/*    function checkCanBuy(address _from, uint256 _amount) view onlyAdmin public 
            returns (bool res, string _msg, uint256 d1, uint256 d2, uint d3, uint d4) {
        if(_amount < minEthAmount) return (false, "Amount sent is too small", minEthAmount,  _amount, 0, 0);
        uint amountTokens = _amount / ethBuyPrice;  // calculates the amount
        if(buyersCount < bonusFirstBuyers) {
            amountTokens += amountTokens * bonusPercent / 100;
        }
        if((whitelistedSaleStartTime <= getTime() && whitelistedAccount[_from]) 
            || (publicSaleStartTime <= getTime())) {
            // everything is good - can buy
        } else {
            if(whitelistedSaleStartTime > getTime()) {
                return (false, "Too early", _amount, amountTokens, whitelistedSaleStartTime, getTime());
            }
            if(whitelistedAccount[_from]) {
                return (false, "User whitelisted, but too early for public", _amount, amountTokens, publicSaleStartTime, getTime());
            } else {
                return (false, "Too early for public", _amount, amountTokens, publicSaleStartTime, getTime());
            }
        }
        
        return (true, "Can Buy Tokens", _amount, amountTokens, 0, getTime());
    }
*/
    // fallback function can be used to buy tokens
    function () payable public {
        buy();
    }

    /// @notice Buy tokens from contract by sending ether
    function buy() payable public {
        require(msg.gas >= minGas && msg.gas <= maxGas);
        require(tx.gasprice >= minGasPrice && tx.gasprice <= maxGasPrice);
        require(msg.value >= minEthAmount);
        require(totalEthRaised + msg.value > totalEthRaised && totalEthRaised + msg.value <= hardCap);
        require(saleEndTime == 0 || saleEndTime > getTime());
        require(preSaleAccount[msg.sender].enabled
            || (whitelistedAccount[msg.sender] && whitelistedSaleStartTime <= getTime()) 
            || (approvedAccount[msg.sender] && publicSaleStartTime <= getTime()));
        uint amount = msg.value / ethBuyPrice;  // calculate the amount
        if(preSaleAccount[msg.sender].enabled) {
            amount += amount * preSaleAccount[msg.sender].bonus / 100;
        } else if(buyersCount < bonusFirstBuyers) {
            amount += amount * bonusPercent / 100;
        }
        if(preSaleAccount[msg.sender].enabled) {
            // calculate unlock date/time
            ncashToken.transferAndLock(msg.sender, amount, getTime() + preSaleAccount[msg.sender].lockingTime);
        } else {
            ncashToken.transferAndLock(msg.sender, amount, 0);
        }
        ncoreToken.addToken(msg.sender);

        buyersCount += 1;
        totalEthRaised += msg.value;
        totalTokensSold += amount;

        etherPaid[msg.sender] += msg.value;

        if(totalEthRaised >= softCap && ethWallet != 0x0) {
            // transfer everything from this wallet to external
            if(this.balance > 0) {
                ethWallet.transfer(this.balance);    
            } else {
                ethWallet.transfer(msg.value);
            }
        }

        // check if sale is over
        if(totalEthRaised >= hardCap || ncashToken.getBalance(this) == 0) {
            // sale is over
            ncashToken.setDefaultUnlockTime(getTime() + lockTokenTimeout);
        }
    }
}
