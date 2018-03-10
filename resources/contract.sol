pragma solidity ^0.4.18;

contract Ethvatar {
    address private owner;
    mapping (address => string) private userInformation;

    function Ethvatar() public {
        owner = msg.sender;
    }

    function newInformation(string information) public {
        userInformation[msg.sender] = information;
    }

    function getInformation(address userAddress) public view returns (string) {
        return userInformation[userAddress];
    }

}