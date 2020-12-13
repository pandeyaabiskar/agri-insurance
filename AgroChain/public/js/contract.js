
App = {
    contracts: {},
    load: async () => {
        await App.loadWeb3()
        await App.loadAccount()
        await App.loadContract()
        await App.skuCountForAdmin()


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
        console.log('Account Loaded');
    },

    loadContract: async () => {

        // Create a JavaScript version of the smart contract
        const supplyChain = await $.getJSON('contract/SupplyChain.json')
        App.contracts.SupplyChain = TruffleContract(supplyChain)
        App.contracts.SupplyChain.setProvider(App.web3Provider)

        // Hydrate the smart contract with values from the blockchain
        App.supplyChain = await App.contracts.SupplyChain.deployed();
        console.log('Contract Loaded');
        console.log(App.SupplyChain);
    },

    issueCrop: function(form) {
        let crop_name = $(form).find('[name="crop_name"]').val();
        let price = $(form).find('[name="price"]').val();
        let buyer_id = $(form).find('[name="buyer_id"]').val();
        let id = $(form).find('[name="id"]').val();
        App.contracts.SupplyChain.deployed().then(function(instance) {
            return instance.issueCrop(crop_name, Number(price), buyer_id,{
                from:App.account,
                gas: 200000
            });
        }).then(function() {
            App.contracts.SupplyChain.deployed().then(function(instance) {
                return instance.skuCount();
            }).then(function(sku) {
            var token = $('meta[name="csrf-token"]').attr('content')
                sku = sku.c[0]-1;
            $.post("/issuerecords",
                {
                    buyer_id: buyer_id,
                    id: id,
                    sku: sku,
                    _token : token,
                },
                function(){
                    location.reload();
                });
        }).catch(function(err) {
            console.error(err);
            return false;
        });
    })},

    plantCrop: function(data, id) {
        App.contracts.SupplyChain.deployed().then(function(instance) {
            return instance.plantCrop(data);
        }).then(function() {
            App.fetchItem(data, id);
        }).catch(function(err) {
            console.error(err);
        });
    },

    harvestCrop: function(data, id) {
        App.contracts.SupplyChain.deployed().then(function(instance) {
            return instance.harvestCrop(data);
        }).then(function() {
            App.fetchItem(data, id);
        }).catch(function(err) {
            console.error(err);
        });
        App.fetchItem();
    },


    verifyCrop: function(data, id) {
        App.contracts.SupplyChain.deployed().then(function(instance) {
            return instance.verifyCrop(data);
        }).then(function() {
            App.fetchItem(data, id);
        }).catch(function(err) {
            console.error(err);
        });
    },

    shipCrop: function(data, id) {
        App.contracts.SupplyChain.deployed().then(function(instance) {
            return instance.shipCrop(data);
        }).then(function() {
            App.fetchItem(data, id);
        }).catch(function(err) {
            console.error(err);
        });
    },
    skuCount: function() {
        App.contracts.SupplyChain.deployed().then(function(instance) {
            return instance.skuCount();
        }).then(function(data) {
            console.log(data.c[0]-1);
        }).catch(function(err) {
            console.error(err);
        });
    },

    skuCountForAdmin: function() {
        App.contracts.SupplyChain.deployed().then(function(instance) {
            return instance.skuCount();
        }).then(function(data) {
            $('#issuedCrops').html(data.c[0]);
        }).catch(function(err) {
            console.error(err);
        });
    },

    fetchItem: function(data, id) {
        App.contracts.SupplyChain.deployed().then(function(instance) {
            return instance.fetchItem(data);
        }).then(function(data) {
            console.log(data);
            let state = data[3].c[0];
            var token = $('meta[name="csrf-token"]').attr('content')
            $.post("/crop-state",
                {
                    id: id,
                    state: state,
                    _token : token,
                },
                function(){
                    location.reload();
                });
        }).catch(function(err) {
            console.error(err);
        });
    },

    timestamps: function(data) {
        App.contracts.SupplyChain.deployed().then(function(instance) {
            return instance.fetchItem(data);
        }).then(function(data) {
            console.log(data)
            $('#issued').html(App.convertTimestamp(data[5][0].c[0]));
            $('#planted').html(App.convertTimestamp(data[5][1].c[0]));
            $('#harvested').html(App.convertTimestamp(data[5][2].c[0]));
            $('#verified').html(App.convertTimestamp(data[5][3].c[0]));
            $('#shipped').html(App.convertTimestamp(data[5][4].c[0]));
        }).catch(function(err) {
            console.error(err);
        });
    },

    convertTimestamp: function(data) {
        var months_arr = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

        // Convert timestamp to milliseconds
        var date = new Date(data*1000);

        // Year
        var year = date.getFullYear();

        // Month
        var month = months_arr[date.getMonth()];

        // Day
        var day = date.getDate();

        // Hours
        var hours = date.getHours();

        // Minutes
        var minutes = "0" + date.getMinutes();

        // Seconds
        var seconds = "0" + date.getSeconds();

        // Display date time in MM-dd-yyyy h:m:s format
        return month+'-'+day+'-'+year+' '+hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);

    },

    fetchItemTest: function(data, id) {
        App.contracts.SupplyChain.deployed().then(function(instance) {
            return instance.fetchItem(data);
        }).then(function(data) {
            console.log(data);
            let state = data[3].c[0];
            let timestamps = data[5][0].c[0];
            console.log(data[3].c[0]);
            console.log(data[5][0].c[0]);
        }).catch(function(err) {
            console.error(err);
        });
    }


};


$(window).on('load', function () {
    App.load()
    // var account = web3.eth.accounts[0];
    // var accountInterval = setInterval(function() {
    //     if (web3.eth.accounts[0] !== account) {
    //         var token = $('meta[name="csrf-token"]').attr('content')
    //         $.post("/logout",
    //             {
    //                 _token : token,
    //             },
    //             function(){
    //                 location.reload();
    //             });
    //     }
    // }, 1000);
});

