import Web3 from requre('web3');

const web3 = new Web3(window.ethereum);
await window.ethereum.enable();

const NameContract = web3.eth.Contract('./build/contracts/SupplyChain.json', '0x298AA305C68084D15Ca7929CD6968535900F228D');

console.log(NameContract);

// App = {
//     contracts: {},
//     load: async () => {
//         await App.loadWeb3()
//         await App.loadAccount()
//         await App.loadContract()
//         // await App.render()
//     },

//     loadWeb3: async () => {
//         if (typeof web3 !== 'undefined') {
//             App.web3Provider = web3.currentProvider
//             web3 = new Web3(web3.currentProvider)
//         } else {
//             window.alert("Please connect to Metamask.")
//         }
//         // Modern dapp browsers...
//         if (window.ethereum) {
//             window.web3 = new Web3(ethereum);
//             try {
//                 // Request account access if needed
//                 await ethereum.enable();
//                 // Acccounts now exposed
//                 web3.eth.sendTransaction({/* ... */})
//             } catch (error) {
//                 // User denied account access...
//             }
//         }
//         // Legacy dapp browsers...
//         else if (window.web3) {
//             App.web3Provider = web3.currentProvider
//             window.web3 = new Web3(web3.currentProvider)
//             // Acccounts always exposed
//             web3.eth.sendTransaction({/* ... */})
//         }
//         // Non-dapp browsers...
//         else {
//             console.log('Non-Ethereum browser detected. You should consider trying MetaMask!')
//         }
//     },

//     loadAccount: async () => {
//         // Set the current blockchain account
//         App.account = web3.eth.accounts[0];
//         $("#account").val(App.account);
//     },

//     loadContract: async () => {

//         // Create a JavaScript version of the smart contract
//         const supplyChain = await $.getJSON('./build/contracts/SupplyChain.json')
//         App.contracts.SupplyChain = TruffleContract(supplyChain)
//         App.contracts.SupplyChain.setProvider(App.web3Provider)

//         // Hydrate the smart contract with values from the blockchain
//         App.supplyChain = await App.contracts.SupplyChain.deployed()
//     },
//     //
//     // render: async () => {
//     //     await App.renderAllTransactions();
//     //     await App.renderRecentTransactions();
//     // },
//     // renderRecentTransactions: async () => {
//     //     const townships = await fetch('/api/townships')
//     //         .then((resp) => resp.json())
//     //         .then(function(data) {
//     //             return data;
//     //         });
//     //
//     //     const totalRegistered = await App.landRegistry.totalRegistered();
//     //     const townShipTemplate = $('#recentTransactions');
//     //
//     //     for (var  i = totalRegistered.toNumber(); i >= 1; i--) {
//     //         // Fetch the task data from the blockchain
//     //         const townShip = await App.landRegistry.townShips(i);
//     //         let townshipId = await townShip[1].toNumber();
//     //         let owner_name = await townShip[3];
//     //         let owner_address = await townShip[4];
//     //         let owner_father_name = await townShip[5];
//     //         let owner_mother_name = await townShip[6];
//     //         let created_at = await townShip[7].toNumber();
//     //         let townShipData = App.getTownshipByCode(townships, townshipId);
//     //
//     //         // Create the html for the task
//     //         let townShipItem =
//     //             `<div class="col-md-4">
//     //             <div class="card mt-4">
//     //                 <div class="card-body">
//     //                     <h4 class="card-title"><strong><i class="fa fa-calendar text-muted" aria-hidden="true"></i> ` + moment.unix(created_at).format("DD-MM-YYYY h:mm:ss") + `</strong></h4>
//     //                     <h5 class="card-title">#`+ townShipData.code +`</h5>
//     //                     <p>
//     //                         <i class="fa fa-area-chart text-muted" aria-hidden="true"></i> `+ townShipData.area +` sqft <br>
//     //                         <i class="fa fa-map-marker text-muted" aria-hidden="true"></i>  ` + townShipData.location + `
//     //                     </p>
//     //
//     //                     <hr>
//     //
//     //                     <h6 class="card-subtitle mb-2"><span class="text-muted">Owner:</span> `+ owner_name +`</h6>
//     //                     <h6 class="card-subtitle"><span class="text-muted"><i class="fa fa-map-marker" aria-hidden="true"></i> </span> ` + owner_address + `</h6>
//     //                 </div>
//     //             </div>
//     //         </div>`;
//     //
//     //         // Show the task
//     //         townShipTemplate.append(townShipItem)
//     //     }
//     // },
//     //
//     // renderAllTransactions: async() =>  {
//     //     const townships = await fetch('/api/townships')
//     //     .then((resp) => resp.json())
//     //     .then(function(data) {
//     //         return data;
//     //     });
//     //
//     //     const totalRegistered = await App.landRegistry.totalRegistered();
//     //     const townShipTemplate = $('#allTransactions > .row');
//     //
//     //     for (var  i = totalRegistered.toNumber(); i >= 1; i--) {
//     //         // Fetch the task data from the blockchain
//     //         const townShip = await App.landRegistry.townShips(i);
//     //         let townshipId = await townShip[1].toNumber();
//     //         let owner_name = await townShip[3];
//     //         let owner_address = await townShip[4];
//     //         let owner_father_name = await townShip[5];
//     //         let owner_mother_name = await townShip[6];
//     //         let created_at = await townShip[7].toNumber();
//     //         let townShipData = App.getTownshipByCode(townships, townshipId);
//     //
//     //         // Create the html for the task
//     //         let townShipItem =
//     //         `<div class="col-md-4">
//     //             <div class="card mt-4">
//     //                 <div class="card-body">
//     //                     <h4 class="card-title"><strong><i class="fa fa-calendar text-muted" aria-hidden="true"></i> ` + moment.unix(created_at).format("DD-MM-YYYY h:mm:ss") + `</strong></h4>
//     //                     <h5 class="card-title">#`+ townShipData.code +`</h5>
//     //                     <p>
//     //                         <i class="fa fa-area-chart text-muted" aria-hidden="true"></i> `+ townShipData.area +` sqft <br>
//     //                         <i class="fa fa-map-marker text-muted" aria-hidden="true"></i>  ` + townShipData.location + `
//     //                     </p>
//     //
//     //                     <hr>
//     //
//     //                     <h6 class="card-subtitle mb-2"><span class="text-muted">Owner:</span> `+ owner_name +`</h6>
//     //                     <h6 class="card-subtitle"><span class="text-muted"><i class="fa fa-map-marker" aria-hidden="true"></i> </span> ` + owner_address + `</h6>
//     //                 </div>
//     //             </div>
//     //         </div>`;
//     //
//     //         // Show the task
//     //         townShipTemplate.append(townShipItem)
//     //     }
//     // },
//     //
//     issueCrop: async () => {
//         let crop_name = $('[name="crop_name"]').val();
//         let price = $('[name="price"]').val();
//         let buyer_id = $('[name="buyer_id"]').val();

//         await App.supplyChain.issueCrop(crop_name, Number(price), buyer_id);
//         alert('Successfully issued crop.')
//     },

//     //
//     // getTownshipByCode: (townships, id) => {
//     //     return townships.find(function (townShip) {
//     //         return townShip.id === id;
//     //     })
//     // }
// }


// $(() => {
//     $(window).load(() => {
//         App.load()
//     })
// })