pragma solidity ^0.5.0;

contract CropInsurancePolicyFactory {
    address[] public deployedPolicies;
    //One more than the actual array index
    uint256 public policyCount;

    function createPolicy(
        address payable _farmer,
        uint256 _insuredAmount,
        uint256 _premium,
        uint256 _startTime,
        uint256 _endTime
    ) public returns (uint256) {
        address newPolicy = address(
            new CropInsurancePolicy(
                msg.sender,
                _farmer,
                _insuredAmount,
                _premium,
                _startTime,
                _endTime
            )
        );
        deployedPolicies.push(newPolicy);
        policyCount = policyCount + 1;
    }

    function getDeployedPolicies()
        public
        view
        returns (address[] memory addresses)
    {
        return deployedPolicies;
    }

    constructor() public {
        policyCount = 0;
    }
}

contract CropInsurancePolicy {
    //for BaseMin to BaseMax -> BasePayout% . for > Max -> MaxPayout%
    uint8 constant floodBaseMin = 1;
    uint8 constant floodBaseMax = 2;
    uint8 constant floodBasePayout = 50; //50% of coverage
    uint8 constant floodMaxPayout = 100; //100% of coverage

    //for BaseMin to BaseMax -> BasePayout% . for < Min -> MaxPayout%
    uint8 constant droughtBaseMin = 1;
    uint8 constant droughtBaseMax = 2;
    uint8 constant droughtBasePayout = 50; //50% of coverage
    uint8 constant droughtMaxPayout = 100; //100% of coverage

    uint8 constant frostBaseMin = 2;
    uint8 constant frostBaseMax = 5;
    uint8 constant frostBasePayout = 50; //50% of coverage
    uint8 constant frostMaxPayout = 100; //100% of coverage

    enum policyState {
        Pending,
        Active,
        PaidOut,
        TimedOut
    }
    address payable public user;
    address riskmanager;
    uint256 public premium;
    uint256 public startTime;
    uint256 public endTime; //crop's season dependent
    uint256 public coverageAmount; //depends on crop type
    policyState public state;

    address payable public owner;

    constructor(
        address payable creator,
        address payable _farmer,
        uint256 _insuredAmount,
        uint256 _premium,
        uint256 _startTime,
        uint256 _endTime
    ) public {
        // require(msg.value >= (_insuredAmount - _premium), "Insufficient Seed Amount");
        owner = creator;
        user = _farmer;
        coverageAmount = _insuredAmount;
        premium = _premium;
        startTime = _startTime;
        endTime = _endTime;
        state = policyState.Pending;
    }

    modifier onlyOwner() {
        require(msg.sender == owner);
        _;
    }

    modifier onlyFarmer() {
        require(msg.sender == user, "User Not Authorized");
        _;
    }

    function loadFund() public payable onlyOwner {
        require(msg.value == coverageAmount - premium);
    }

    function payPremium() public payable onlyFarmer {
        require(msg.value == premium);
        state = policyState.Active;
    }

    function claim(
        uint256 _timestamp,
        int256 _result,
        bool _isFlood,
        bool _isDrought
    ) public onlyFarmer {
        require(state == policyState.Active, "Policy Not Active");

        if (now > endTime) {
            state = policyState.TimedOut;
            revert("Policy's period has Ended.");
        }
        if (now < startTime) revert("Insurance Not Covered by Policy");
        uint256 payoutAmount;

        if (_isFlood) {
            if (_result > floodBaseMax) {
                payoutAmount = uint256((coverageAmount * floodMaxPayout) / 100);
                user.transfer(payoutAmount);
                state = policyState.PaidOut;
            } else {
                payoutAmount = uint256(
                    (coverageAmount * floodBasePayout) / 100
                );
                user.transfer(payoutAmount);
                state = policyState.PaidOut;
            }
        } else if (_isDrought) {
            if (_result > droughtBaseMax) {
                payoutAmount = uint256(
                    (coverageAmount * droughtMaxPayout) / 100
                );
                user.transfer(payoutAmount);
                state = policyState.PaidOut;
            } else {
                payoutAmount = uint256(
                    (coverageAmount * droughtBasePayout) / 100
                );
                user.transfer(payoutAmount);
                state = policyState.PaidOut;
            }
        } else {
            if (_result > frostBaseMax) {
                payoutAmount = uint256((coverageAmount * frostMaxPayout) / 100);
                user.transfer(payoutAmount);
                state = policyState.PaidOut;
            } else {
                payoutAmount = uint256(
                    (coverageAmount * frostBasePayout) / 100
                );
                user.transfer(payoutAmount);
                state = policyState.PaidOut;
            }
        }
    }

    function getBalance() public view returns (uint256) {
        return address(this).balance;
    }
}
