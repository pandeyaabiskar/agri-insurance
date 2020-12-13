
pragma solidity ^0.5.0;

contract SupplyChain {

  /* set owner */
  address owner;

  /* Add a variable called skuCount to track the most recent sku # */
  uint public skuCount;

  /* Add a line that creates a public mapping that maps the SKU (a number) to an Item.
     Call this mappings items
  */
  mapping (uint => Item) public items;

  /* Add a line that creates an enum called State. This should have 4 states
    Issued
    Planted
    Harvested
    Shipped
    (declaring them in this order is important)
  */
  enum State {Issued,Planted,Harvested,Verified,Shipped}

  /* Create a struct named Item.
    Here, add a name, sku, price, state, and buyer
  */

  struct Item {
    string name;
    uint sku;
    uint price;
    State state;
    address buyer;
    mapping(uint => uint) timestamps;

  }


  /* Create 4 events with the same name as each possible State */

    event LogIssued(uint sku);
    event LogPlanted(uint sku);
    event LogHarvested(uint sku);
    event LogVerified(uint sku);
    event LogShipped(uint sku);

/* Create a modifer that checks if the msg.sender is the buyer of the crop */

  modifier verifyCaller (address _address) {require (msg.sender == _address, "You are authorized to perform this transaction."); _;}


  modifier issued(uint _sku){
    require(items[_sku].state == State.Issued && items[_sku].buyer != address(0),"Crop has not been issued yet!");
    _;
  }
  modifier planted(uint _sku){
    require(items[_sku].state == State.Planted && items[_sku].buyer != address(0),"Crop has not been planted yet");
    _;
  }
  modifier harvested(uint _sku){
    require(items[_sku].state == State.Harvested,"Crop has not been harvested yet");
    _;
  }
    modifier verified(uint _sku){
    require(items[_sku].state == State.Verified,"Crop has not been verified for shipping");
    _;
  }
  modifier shipped(uint _sku){
    require(items[_sku].state == State.Shipped,"Crop has not been shipped yet");
    _;
  }


  constructor() public {
    /* Here, set the owner as the person who instantiated the contract
       and set your skuCount to 0. */
       owner = msg.sender;
       skuCount = 0;
  }

  function issueCrop(string memory _name, uint _price, address _buyer) public returns(bool){
    // emit LogIssued(skuCount);
    items[skuCount] = Item({name: _name, sku: skuCount, price: _price, state: State.Issued, buyer: _buyer});
    items[skuCount].timestamps[0] = block.timestamp;
    skuCount = skuCount + 1;
    return true;
  }


  function plantCrop(uint sku) public
  issued(sku) verifyCaller(items[sku].buyer)
  {
    items[sku].state = State.Planted;
    items[skuCount-1].timestamps[1] = block.timestamp;

     emit LogPlanted(sku);

  }

  /* Add 2 modifiers to check if the item is planted already, and that the person calling this function
  is the buyer. Change the state of the item to harvested. Remember to call the event associated with this function!*/
  function harvestCrop(uint sku) public
   planted(sku) verifyCaller(items[sku].buyer)
  {
    emit LogHarvested(skuCount);
    Item storage itm = items[sku];
    itm.state = State.Harvested;
        items[skuCount-1].timestamps[2] = block.timestamp;

  }
  
    function verifyCrop(uint sku) public
   harvested(sku)
  {
    emit LogVerified(skuCount);
    items[sku].state = State.Verified;
    items[skuCount-1].timestamps[3] = block.timestamp;

  }

  /* Add 2 modifiers to check if the item is harvested already, and that the person calling this function
  is the buyer. Change the state of the item to received. Remember to call the event associated with this function!*/
  function shipCrop(uint sku) public
   verified(sku) verifyCaller(items[sku].buyer)
  {
    emit LogShipped(skuCount);
    items[sku].state = State.Shipped;
        items[skuCount-1].timestamps[4] = block.timestamp;

  }


  function fetchItem(uint _sku) public view returns (string memory name, uint sku, uint price, uint state, address buyer, uint[] memory timestamp) {
    name = items[_sku].name;
    sku = items[_sku].sku;
    price = items[_sku].price;
    state = uint(items[_sku].state);
    buyer = items[_sku].buyer;
    timestamp = new uint[](state+1);
    for(uint i = 0; i <= state; i++){
        timestamp[i] = items[_sku].timestamps[i];
    }
    return (name, sku, price, state, buyer, timestamp);
  }

}
