pragma solidity ^0.5.0;

contract CrowdFarmingProjectFactory {
    address[] public deployedProjects;
    //One more than the actual array index
    uint public projectCount;
    
    function createProject(uint minimum) public returns (uint256) {
        address newProject = address(new CrowdFarmingProject(minimum, msg.sender));
        deployedProjects.push(newProject);
        projectCount = projectCount + 1;
    }
    
    function getDeployedProjects() public view returns (address[] memory addresses){
        return deployedProjects;
    }
    
    constructor() public {
        projectCount = 0;
    }
}

contract CrowdFarmingProject {
    struct Withdrawal {
        string description;
        uint value;
        address payable recipient;
        bool complete;
        uint approvalCount;
        mapping(address => bool) approvals;
    }
    
    Withdrawal[] public withdrawals;
    address payable [] public ContributorsAddress;
    address public owner;
    mapping(address => bool) contributors;
    uint public contributorsCount;
    uint public minimumContribution;
    bool public projectActive;
    
    constructor(uint minimum, address creator) public {
        owner = creator;
        minimumContribution = minimum;
        projectActive = true;
    }
    
    function contribute() public payable {
        require(msg.value >= minimumContribution);
        contributors[msg.sender] = true;
        ContributorsAddress.push(msg.sender);
        contributorsCount++;
    }
    
    modifier onlyOwner(){
        require(msg.sender == owner);
        _;
    }
    
    modifier onlyContributor(){
        require(contributors[msg.sender]);
        _;
    }
    
    
    function createWithdrawal(string memory description, uint value, address payable recipient) public onlyOwner {
        Withdrawal memory newWithdrawal = Withdrawal({
            description: description,
            value: value,
            recipient: recipient,
            complete: false,
            approvalCount: 0
        });
        withdrawals.push(newWithdrawal);
    }
    
    function approveWithdrawal(uint index) public onlyContributor {
        Withdrawal storage withdrawal = withdrawals[index];
        
        require(!withdrawal.approvals[msg.sender]);
        
        withdrawal.approvals[msg.sender] = true;
        withdrawal.approvalCount++;
    }
    
    function finalizeWithdrawal(uint index) public onlyOwner {
        Withdrawal storage withdrawal = withdrawals[index];
        
        require(withdrawal.approvalCount >= (contributorsCount / 2));
        require(!withdrawal.complete);
        
        withdrawal.recipient.transfer(withdrawal.value);
        withdrawal.complete = true;
    }
    
    function cancelProject() public onlyOwner {
        require(projectActive);
        projectActive = false;
        
        uint remainingAmountForEachContributor = uint(address(this).balance) / contributorsCount;
        
        for(uint i = 0; i < ContributorsAddress.length; i++){
            ContributorsAddress[i].transfer(remainingAmountForEachContributor);
        }
    }
    
    function getBalance() public view returns (uint256) {
        return address(this).balance;
    }
}