module.exports = {
  networks: {
    development: {
      host: "127.0.0.1",
      port: 8545,
      network_id: "*", // Match any network id
    },
  },
  // solc: {

  //   optimizer: {
  //     enabled: true,
  //     runs: 200,
  //   },
  // },
  contracts_build_directory: "../AgroChain/public/contract/",
  compilers: {
    solc: {
      version: "^0.5.0",
      settings: {
        optimizer: {
          enabled: true,
          runs: 200,
        },
      },
    },
  },
};
