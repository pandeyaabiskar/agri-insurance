var SupplyChain = artifacts.require("./SupplyChain.sol");
var CrowdFarmingProjectFactory = artifacts.require(
  "./CrowdFarmingProjectFactory.sol"
);
var CropInsurancePolicyFactory = artifacts.require(
  "./CropInsurancePolicyFactory.sol"
);

module.exports = function (deployer) {
  deployer.deploy(SupplyChain);
  deployer.deploy(CrowdFarmingProjectFactory);
  deployer.deploy(CropInsurancePolicyFactory);
};
