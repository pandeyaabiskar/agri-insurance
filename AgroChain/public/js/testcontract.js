App = {
    contracts: {},
    load: async () => {
        await App.loadWeb3()
        await App.loadAccount()
        await App.loadContract()
        // await App.render()
    },

    loadWeb3: async () => {
        if (typeof web3 !== 'undefined') {
            App.web3Provider = web3.currentProvider
            web3 = new Web3(web3.currentProvider)
        } else {
            window.alert("Please connect to Metamask.")
        }
        // Modern dapp browsers...
        if (window.ethereum) {
            window.web3 = new Web3(ethereum);
            try {
                // Request account access if needed
                await ethereum.enable();
                // Acccounts now exposed
                web3.eth.sendTransaction({/* ... */})
            } catch (error) {
                // User denied account access...
            }
        }
        // Legacy dapp browsers...
        else if (window.web3) {
            App.web3Provider = web3.currentProvider
            window.web3 = new Web3(web3.currentProvider)
            // Acccounts always exposed
            web3.eth.sendTransaction({/* ... */})
        }
        // Non-dapp browsers...
        else {
            console.log('Non-Ethereum browser detected. You should consider trying MetaMask!')
        }
    },

    loadAccount: async () => {
        // Set the current blockchain account
        App.account = web3.eth.accounts[0];
        $("#account").val(App.account);
    },

    loadContract: async () => {

        // Create a JavaScript version of the smart contract
        const supplyChain = await $.getJSON('contract/SupplyChain.json')
        App.contracts.SupplyChain = TruffleContract(supplyChain)
        App.contracts.SupplyChain.setProvider(App.web3Provider)

        // Hydrate the smart contract with values from the blockchain
        App.supplyChain = await App.contracts.SupplyChain.deployed()
    },

    issueCrop: function() {
        let crop_name = $('[name="crop_name"]').val();
        let price = $('[name="price"]').val();
        let buyer_id = $('[name="buyer_id"]').val();
        App.contracts.SupplyChain.deployed().then(function(instance) {
            return instance.issueCrop(crop_name, Number(price), buyer_id);
        }).then(function() {
            console.log('Success');
        }).catch(function(err) {
            console.error(err);
        });
    }
};




$(() => {
    $(window).load(() => {
        App.load()
    })
})