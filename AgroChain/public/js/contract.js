App = {
    contracts: {},
    load: async () => {
        await App.loadWeb3();
        await App.loadAccount();
        await App.loadContract();
        await App.loadWalletBalance();
        await App.skuCountForAdmin();

        // await App.render()
    },

    loadWeb3: async () => {
        if (typeof web3 !== "undefined") {
            App.web3Provider = web3.currentProvider;
            web3 = new Web3(web3.currentProvider);
            console.log(web3)

        } else {
            window.alert("Please connect to Metamask.");
        }
        // Modern dapp browsers...
        if (window.ethereum) {
            window.web3 = new Web3(ethereum);
            try {
                // Request account access if needed
                await ethereum.enable();
                // Acccounts now exposed
                web3.eth.sendTransaction({
                    /* ... */
                });
            } catch (error) {
                // User denied account access...
            }
        }
        // Legacy dapp browsers...
        else if (window.web3) {
            App.web3Provider = web3.currentProvider;
            window.web3 = new Web3(web3.currentProvider);
            // Acccounts always exposed
            web3.eth.sendTransaction({
                /* ... */
            });
        }
        // Non-dapp browsers...
        else {
            console.log(
                "Non-Ethereum browser detected. You should consider trying MetaMask!"
            );
        }
    },

    loadAccount: async () => {
        // Set the current blockchain account
        App.account = web3.eth.accounts[0];
        // App.account = await web3.eth.getAccounts();
        // App.account = App.account[0];
        $("#account").val(App.account);
        $("#account-farmer").val(App.account);
        $("#account-crowdfarmer").val(App.account);
        console.log("Account Loaded", App.account);
        web3.eth.defaultAccount = App.account;
    },

    loadWalletBalance: async () => {
        console.log('acc', App.account);
        this.web3.eth.getBalance(App.account, (err, balance) => {
            this.balance = "Rs. " + this.web3.fromWei(balance, "ether");
            $("#wallet").text(this.balance);
            console.log('Balance', this.balance);

        });
    },

    loadContract: async () => {
        // Create a JavaScript version of the smart contract
        const supplyChain = await $.getJSON("../contract/SupplyChain.json");
        App.contracts.SupplyChain = TruffleContract(supplyChain);
        App.contracts.SupplyChain.setProvider(App.web3Provider);

        // Hydrate the smart contract with values from the blockchain
        App.supplyChain = await App.contracts.SupplyChain.deployed();
        console.log("Supplychain Contract Loaded");


        // Create a JavaScript version of the smart contract
        const crowdFarmingProjectFactory = await $.getJSON(
            "../contract/CrowdFarmingProjectFactory.json"
        );
        App.contracts.CrowdFarmingProjectFactory = TruffleContract(
            crowdFarmingProjectFactory
        );
        App.contracts.CrowdFarmingProjectFactory.setProvider(App.web3Provider);

        // Hydrate the smart contract with values from the blockchain
        App.crowdFarmingProjectFactory = await App.contracts.CrowdFarmingProjectFactory.deployed();
        console.log("Crowdfarming Factory Contract Loaded");



        // Create a JavaScript version of the smart contract
        const crowdFarming = await $.getJSON(
            "../contract/CrowdFarmingProject.json"
        );
        App.contracts.CrowdFarming = TruffleContract(
            crowdFarming
        );
        App.contracts.CrowdFarming.setProvider(App.web3Provider);


        // Create a JavaScript version of the smart contract
        const cropInsurancePolicyFactory = await $.getJSON(
            "../contract/CropInsurancePolicyFactory.json"
        );
        App.contracts.CropInsurancePolicyFactory = TruffleContract(
            cropInsurancePolicyFactory
        );
        App.contracts.CropInsurancePolicyFactory.setProvider(App.web3Provider);

        // Hydrate the smart contract with values from the blockchain
        App.cropInsurancePolicyFactory = await App.contracts.CropInsurancePolicyFactory.deployed();
        console.log("CropInsurance Contract Loaded");



        // Create a JavaScript version of the smart contract
        const cropInsurancePolicy = await $.getJSON(
            "../contract/CropInsurancePolicy.json"
        );
        App.contracts.CropInsurancePolicy = TruffleContract(
            cropInsurancePolicy
        );
        App.contracts.CropInsurancePolicy.setProvider(App.web3Provider);

    },

    issueCrop: function(form) {
        let crop_name = $(form)
            .find('[name="crop_name"]')
            .val();
        let price = $(form)
            .find('[name="price"]')
            .val();
        let buyer_id = $(form)
            .find('[name="buyer_id"]')
            .val();
        let id = $(form)
            .find('[name="id"]')
            .val();
        App.contracts.SupplyChain.deployed()
            .then(function(instance) {
                return instance.issueCrop(crop_name, Number(price), buyer_id, {
                    from: App.account,
                    gas: 200000
                });
            })
            .then(function() {
                App.contracts.SupplyChain.deployed()
                    .then(function(instance) {
                        return instance.skuCount();
                    })
                    .then(function(sku) {
                        var token = $('meta[name="csrf-token"]').attr(
                            "content"
                        );
                        console.log(sku);
                        console.log(sku.c[0]);
                        sku = sku.c[0] - 1;
                        console.log(sku);
                        $.post(
                            "/issuerecords",
                            {
                                buyer_id: buyer_id,
                                id: id,
                                sku: sku,
                                _token: token
                            },
                            function() {
                                location.reload();
                            }
                        );
                    })
                    .catch(function(err) {
                        console.error(err);
                        return false;
                    });
            });
    },

    plantCrop: function(data, id) {
        App.contracts.SupplyChain.deployed()
            .then(function(instance) {
                return instance.plantCrop(data);
            })
            .then(function() {
                App.fetchItem(data, id);
            })
            .catch(function(err) {
                console.error(err);
            });
    },

    harvestCrop: function(data, id) {
        App.contracts.SupplyChain.deployed()
            .then(function(instance) {
                return instance.harvestCrop(data);
            })
            .then(function() {
                App.fetchItem(data, id);
            })
            .catch(function(err) {
                console.error(err);
            });
        App.fetchItem();
    },

    verifyCrop: function(data, id) {
        App.contracts.SupplyChain.deployed()
            .then(function(instance) {
                return instance.verifyCrop(data);
            })
            .then(function() {
                App.fetchItem(data, id);
            })
            .catch(function(err) {
                console.error(err);
            });
    },

    shipCrop: function(data, id) {
        App.contracts.SupplyChain.deployed()
            .then(function(instance) {
                return instance.shipCrop(data);
            })
            .then(function() {
                App.fetchItem(data, id);
            })
            .catch(function(err) {
                console.error(err);
            });
    },
    skuCount: function() {
        App.contracts.SupplyChain.deployed()
            .then(function(instance) {
                return instance.skuCount();
            })
            .then(function(data) {
                console.log(data.c[0] - 1);
            })
            .catch(function(err) {
                console.error(err);
            });
    },

    skuCountForAdmin: function() {
        App.contracts.SupplyChain.deployed()
            .then(function(instance) {
                return instance.skuCount();
            })
            .then(function(data) {
                $("#issuedCrops").html(data.c[0]);
            })
            .catch(function(err) {
                console.error(err);
            });
    },

    fetchItem: function(data, id) {
        App.contracts.SupplyChain.deployed()
            .then(function(instance) {
                return instance.fetchItem(data);
            })
            .then(function(data) {
                console.log(data);
                let state = data[3].c[0];
                var token = $('meta[name="csrf-token"]').attr("content");
                $.post(
                    "/crop-state",
                    {
                        id: id,
                        state: state,
                        _token: token
                    },
                    function() {
                        location.reload();
                    }
                );
            })
            .catch(function(err) {
                console.error(err);
            });
    },

    timestamps: function(data) {
        App.contracts.SupplyChain.deployed()
            .then(function(instance) {
                return instance.fetchItem(data);
            })
            .then(function(data) {
                console.log(data);
                $("#issued").html(App.convertTimestamp(data[5][0].c[0]));
                $("#planted").html(App.convertTimestamp(data[5][1].c[0]));
                $("#harvested").html(App.convertTimestamp(data[5][2].c[0]));
                $("#verified").html(App.convertTimestamp(data[5][3].c[0]));
                $("#shipped").html(App.convertTimestamp(data[5][4].c[0]));
            })
            .catch(function(err) {
                console.error(err);
            });
    },

    convertTimestamp: function(data) {
        var months_arr = [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec"
        ];

        // Convert timestamp to milliseconds
        var date = new Date(data * 1000);

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
        return (
            month +
            "-" +
            day +
            "-" +
            year +
            " " +
            hours +
            ":" +
            minutes.substr(-2) +
            ":" +
            seconds.substr(-2)
        );
    },

    //Create New Project by Farmer
    createProject: function (form) {
        let minContribution = $(form)
        .find('[name="price"]')
            .val();
        //Need to fetch form data and pass through AJAX
        console.log("contracts", App.contracts.CrowdFarmingProjectFactory.deployed())
        App.contracts.CrowdFarmingProjectFactory.deployed().then((instance) => {
            console.log("here", instance.address)
            return instance.createProject(minContribution);
        }).then(() => {
            App.contracts.CrowdFarmingProjectFactory.deployed()
                .then(function (instance) {
                    return instance.projectCount();
                })
                .then(function (sku) {

                    var formData = new FormData(form);
                    sku = sku - 1;
                    console.log(sku);
                    var token = $('meta[name="csrf-token"]').attr(
                        "content"
                    );
                    formData.append('sku', sku);
                    $.ajax({
                        method: 'post',
                        processData: false,
                        contentType: false,
                        cache: false,
                        data: formData,
                        enctype: 'multipart/form-data',
                        url: '/projects',
                        success: function (response) {
                            window.location = '/home'
                        }
                    });
                })
                .catch(function(err) {
                    console.error(err);
                    return false;
                });
            })
    },

    //Get the contract address of the project deployed by the farmer
    getDeployedProjectAddress: async function(projectId) {
        const instance = await App.contracts.CrowdFarmingProjectFactory.deployed()
        const address = await instance.deployedProjects(projectId);
        console.log(address);
        return address;
    },

    //Get the instance of project for processing other functions
    getDeployedProjectInstance: function (address) {
        const contractInstance = App.contracts.CrowdFarming.at(address);
        return contractInstance;
    },

    //Contribute money to a particular project id
    contribute: async function (form) {
        let projectId = $(form)
            .find('[name="bprojectId"]')
            .val();
        let investment = $(form)
            .find('[name="investment"]')
            .val();
            // investment = investment / 206566 * 1000000000000000000;
            // investment = web3.fromWei(investment, 'ether');
            console.log(investment);
        const address = await App.getDeployedProjectAddress(projectId);
        const contractInstance = await App.getDeployedProjectInstance(address);
        contractInstance.contribute({ value: investment }).then(() => {
            var formData = new FormData(form);
            var token = $('meta[name="csrf-token"]').attr(
                "content"
            );
            formData.append('_token', token);
            $.ajax({
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                enctype: 'multipart/form-data',
                url: '/contributions',
                success: function (response) {
                    location.reload();
                }
            });
        }).catch(function(err) {
            console.error(err);
            return false;
        });
    },

    //Request money from the fund to withdraw for a cause by the farmer
    requestWithdrawal: async function (form) {
        let project_Id = $(form)
            .find('[name="project_Id"]')
            .val();
        let recipient_id = $(form)
            .find('[name="recipient_id"]')
            .val();
        let amount = $(form)
            .find('[name="amount"]')
                .val();
        let description = $(form)
                .find('[name="description"]')
                .val();
                // amount = amount / 206566 * 1000000000000000000;

        const address = await App.getDeployedProjectAddress(project_Id);
        const contractInstance = await App.getDeployedProjectInstance(address);
        contractInstance.createWithdrawal( description, amount, recipient_id).then(() => {
            var formData = new FormData(form);
            var token = $('meta[name="csrf-token"]').attr(
                "content"
            );
            formData.append('_token', token);
            $.ajax({
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                enctype: 'multipart/form-data',
                url: '/withdrawals',
                success: function (response) {
                    location.reload();
                }
            });
        }).catch(function(err) {
            console.error(err);
            return false;
        });
    },

    //Approval for the withdraw request by the contributors
    approveWithdrawal: async function (form) {
        let project_Id = $(form)
            .find('[name="project_Id"]')
            .val();
        let withdrawal_id = $(form)
            .find('[name="withdrawal_id"]')
            .val();
        let withdrawalid = $(form)
            .find('[name="withdrawalid"]')
            .val();

        const address = await App.getDeployedProjectAddress(project_Id);
        const contractInstance = await App.getDeployedProjectInstance(address);
        contractInstance.approveWithdrawal( withdrawal_id).then(() => {
            var formData = new FormData(form);
            var token = $('meta[name="csrf-token"]').attr(
                "content"
            );
            formData.append('_token', token);
            $.ajax({
                method: 'get',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                url: '/approvals/approve/' + withdrawalid,
                success: function (response) {
                    location.reload();
                }
            });
        }).catch(function(err) {
            console.error(err);
            return false;
        });
    },

    //Withdraw fund after final request from the farmer
    finalizeWithdrawal: async function (form) {
        let project_Id = $(form)
            .find('[name="project_Id"]')
            .val();
        let withdrawal_id = $(form)
            .find('[name="withdrawal_id"]')
            .val();
        let withdrawalid = $(form)
            .find('[name="withdrawalid"]')
            .val();

        const address = await App.getDeployedProjectAddress(project_Id);
        const contractInstance = await App.getDeployedProjectInstance(address);
        contractInstance.finalizeWithdrawal(withdrawal_id).then(() => {
            var formData = new FormData(form);
            var token = $('meta[name="csrf-token"]').attr(
                "content"
            );
            formData.append('_token', token);
            $.ajax({
                method: 'get',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                url: 'withdrawals/withdraw/' + withdrawalid,
                success: function (response) {
                    location.reload();
                }
            });
        }).catch(function(err) {
            console.error(err);
            return false;
        });
    },

    //Get total fund collected in the project
    getBalance: async function (projectId) {
        const address = await App.getDeployedProjectAddress(projectId);
        const contractInstance = await App.getDeployedProjectInstance(address);
        const data = await contractInstance.getBalance();
        console.log("balance", data.c[0])
        $("#pwallet").text('Rs. ' + data.c[0]);
    },

    //Get all the withdrawal of a particular project
    getWithdrawals: function (contractInstance) {
        contractInstance.withdrawals(withdrawId).then(function(data) {
            console.log(data);
        })
    },

    //Cancel the project to be done by the farmer
    cancelProject: async function (form) {
        let project_Id = $(form)
            .find('[name="project_Id"]')
            .val();
            let projectId = $(form)
            .find('[name="projectId"]')
            .val();
        const address = await App.getDeployedProjectAddress(project_Id);
        const contractInstance = await App.getDeployedProjectInstance(address);
        contractInstance.cancelProject().then(() => {
            var formData = new FormData(form);
            var token = $('meta[name="csrf-token"]').attr(
                "content"
            );
            formData.append('_token', token);
            formData.append('_method', 'DELETE');
            $.ajax({
                method: 'post',
                type: 'delete',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                enctype: 'multipart/form-data',
                url: '/projects/' + projectId,
                success: function (response) {
                    location.reload();
                }
            });
        }).catch(function(err) {
            console.error(err);
            return false;
        });

    },

    //Total contributors in a project
    getContributorsCount: async function () {
        let address = await getDeployedProjectAddress();
        let contractInstance = await getDeployedProjectInstance(address);
        contractInstance.contributorsCount().then(function(data) {
            console.log(data);
        })
    },

    //Minimum amount required to contribute to the project
    minimumContribution: function () {
        contractInstance.minimumContribution().then(function(data) {
            console.log(data);
        })
    },

    //Create New Project by Farmer
    createInsurance: function (form) {
        let farmer_id = $(form)
            .find('[name="farmer_id"]')
            .val();
        let insured_amount = $(form)
            .find('[name="amount"]')
            .val();
        let premium_amount = $(form)
            .find('[name="premium"]')
            .val();
        let starttime = $(form)
            .find('[name="starttime"]')
            .val();
        let endtime = $(form)
            .find('[name="endtime"]')
            .val();
        starttime = Math.floor(new Date(starttime).getTime() / 1000)
        endtime = Math.floor(new Date(endtime).getTime() / 1000)

        //Need to fetch form data and pass through AJAX
        App.contracts.CropInsurancePolicyFactory.deployed().then((instance) => {
            return instance.createPolicy(farmer_id , insured_amount, premium_amount, starttime, endtime);
        }).then(() => {
            App.contracts.CropInsurancePolicyFactory.deployed()
                .then(function (instance) {
                    return instance.policyCount();
                })
                .then(function (sku) {

                    var formData = new FormData(form);
                    sku = sku - 1;
                    console.log(sku);
                    var token = $('meta[name="csrf-token"]').attr(
                        "content"
                    );
                    formData.append('sku', sku);
                    $.ajax({
                        method: 'post',
                        processData: false,
                        contentType: false,
                        cache: false,
                        data: formData,
                        enctype: 'multipart/form-data',
                        url: '/policies',
                        success: function (response) {
                            window.location = '/home'
                        }
                    });
                })
                .catch(function(err) {
                    console.error(err);
                    return false;
                });
        })
    },



    loadFund: async function (form) {
        let policy_id = $(form)
            .find('[name="policy_id"]')
            .val();
        let fund = $(form)
            .find('[name="fund"]')
            .val();
        // investment = investment / 206566 * 1000000000000000000;
        // investment = web3.fromWei(investment, 'ether');
        console.log(fund);
        const address = await App.getDeployedPolicyAddress(policy_id -1);
        const contractInstance = await App.getDeployedPolicyInstance(address);
        contractInstance.loadFund({ value: fund }).then(() => {
            var formData = new FormData(form);
            var token = $('meta[name="csrf-token"]').attr(
                "content"
            );
            formData.append('_token', token);
            $.ajax({
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                enctype: 'multipart/form-data',
                url: '/policy/load',
                success: function (response) {
                    window.location = '/home';
                }
            });
        }).catch(function(err) {
            console.error(err);
            return false;
        });
    },

    payPremium: async function (form) {
        let policy_id = $(form)
            .find('[name="policy_id"]')
            .val();
        let premium = $(form)
            .find('[name="premium"]')
            .val();
        // investment = investment / 206566 * 1000000000000000000;
        // investment = web3.fromWei(investment, 'ether');
        const address = await App.getDeployedPolicyAddress(policy_id-1);
        const contractInstance = await App.getDeployedPolicyInstance(address);
        contractInstance.payPremium({ value: premium }).then(() => {
            var formData = new FormData(form);
            var token = $('meta[name="csrf-token"]').attr(
                "content"
            );
            formData.append('_token', token);
            $.ajax({
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                enctype: 'multipart/form-data',
                url: '/policy/premium',
                success: function (response) {
                    window.location = '/home';
                }
            });
        }).catch(function(err) {
            console.error(err);
            return false;
        });
    },
    claimInsurance: async function (form) {
        let policy_id = $(form)
            .find('[name="policy_id"]')
            .val();
        let timestamp = $(form)
            .find('[name="timestamp"]')
            .val();
        let result = $(form)
            .find('[name="result"]')
            .val();
        let isFlood = $(form)
            .find('[name="isFlood"]')
            .val();
        let isDrought = $(form)
            .find('[name="isDrought"]')
            .val();
        // investment = investment / 206566 * 1000000000000000000;
        // investment = web3.fromWei(investment, 'ether');
        const address = await App.getDeployedPolicyAddress(policy_id-1);
        const contractInstance = await App.getDeployedPolicyInstance(address);
        contractInstance.claim(timestamp, result, isFlood, isDrought).then(() => {
            var formData = new FormData(form);
            var token = $('meta[name="csrf-token"]').attr(
                "content"
            );
            formData.append('_token', token);
            $.ajax({
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                enctype: 'multipart/form-data',
                url: '/policy/claim',
                success: function (response) {
                    window.location = '/home';
                }
            });
        }).catch(function(err) {
            console.error(err);
            return false;
        });
    },
    getPolicyBalance: async function (policyId) {
        const address = await App.getDeployedPolicyAddress(policyId-1);
        const contractInstance = await App.getDeployedPolicyInstance(address);
        const data = await contractInstance.getBalance();
        console.log("balance", data.c[0])
        $("#pwallet").text('Rs. ' + data.c[0]);
    },
    //Get the contract address of the project deployed by the farmer
    getDeployedPolicyAddress: async function(policyId) {
        const instance = await App.contracts.CropInsurancePolicyFactory.deployed()
        const address = await instance.deployedPolicies(policyId);
        console.log(address);
        return address;
    },

    //Get the instance of project for processing other functions
    getDeployedPolicyInstance: function (address) {
        const contractInstance = App.contracts.CropInsurancePolicy.at(address);
        return contractInstance;
    },
};

$(window).on("load", function() {
    App.load();
});
