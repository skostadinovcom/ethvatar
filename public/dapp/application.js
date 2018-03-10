$(document).ready(function() {
    var options = {
        "network": "3", //1 for main eth
        "mode": "dev", //dev, production
        "ipfs_host": "localhost", //ipfs node with activated public & get
        "ipfs_port": 5001, //ipfs node port
        "ipfs_public_host": "ipfs.io/ipfs/"
    };

    if (typeof web3 !== 'undefined') {
        // Use Mist/MetaMask's provider
        web3js = new Web3(web3.currentProvider);
        var address = web3.eth.accounts[0];

        web3.version.getNetwork((err, netId) => {
            if ( netId == options.network ) {
                if (address){
                    init(address, options);
                }else{
                    error();
                }
            }else{
                error();
            }
        });
    } else {
        error();
    }
});

function init(address, options) {
    var contract = contact();

    var path = window.location.pathname;
    var function_name = path.split('/').join('_');

    if (function_name == "_") {
        function_name = "_index";
    }

    if (function_name.slice(-1) == '_') {
        function_name = function_name.slice(0, -1);  
    }

    if (typeof(window[function_name]) === "function"){
      window[function_name](contract, address, options);
    }else{
        if (mode == 'dev'){
            console.log('Function name should be: ' + function_name);
            console.log('Please create function for this route');
        }
    }
}

// Contract
function contact() {
    contractAddress = "0xaff078805359c34d6b28e9b1d00295c4cb9bda20";
    contractAbi = [
    {
        "constant": false,
        "inputs": [
            {
                "name": "information",
                "type": "string"
            }
        ],
        "name": "newInformation",
        "outputs": [],
        "payable": false,
        "stateMutability": "nonpayable",
        "type": "function"
    },
    {
        "constant": true,
        "inputs": [
            {
                "name": "userAddress",
                "type": "address"
            }
        ],
        "name": "getInformation",
        "outputs": [
            {
                "name": "",
                "type": "string"
            }
        ],
        "payable": false,
        "stateMutability": "view",
        "type": "function"
    },
    {
        "inputs": [],
        "payable": false,
        "stateMutability": "nonpayable",
        "type": "constructor"
    }]

    return web3.eth.contract(contractAbi).at(contractAddress);
}

// Route funcs
function _index() {
    return;
}

function _app(contract, address, options) {
    contract.getInformation(address, function(error, result){
        if (result) {
            $('body').html('');
            window.location.href = '/app/me';
        }
    });


    var form  = $('.register-form');
    var address = web3.eth.accounts[0];

    form.find('#address').val(address);

    form.submit(function(e) {
        e.preventDefault();

        const reader = new FileReader();
        reader.onloadend = function() {
            const ipfs = window.IpfsApi(options.ipfs_host, options.ipfs_port);
            const buf = buffer.Buffer(reader.result);
            ipfs.files.add(buf, (err, result) => {
                if(err) {
                    console.error(err);
                    return;
                }

                var hash = `${result[0].hash}`;

                var email = form.find('#email').val();
                var names = form.find('#names').val();
                var image = hash;

                var json = {
                    "email": email,
                    "names": names,
                    "social": {},
                    "image": image
                }

                var jsonString = JSON.stringify(json);

                contract.newInformation(jsonString, function(error, result){
                    if (error) {
                        console.log(error);
                        return;
                    }

                    form.append('<p align="center" style="margin-top: 25px;"><img src="./img/loading.gif" width="35px"><br/> Please wait for your transaction to be mined. </p>');

                    setInterval(function(){
                        web3.eth.getTransaction(result, function(error, result){
                            if (result.blockNumber) {
                                window.location.href = '/app/me';
                            }
                        });
                    }, 5000);
                });
            });
        };

        const photo = document.getElementById("ipfsphoto");
        reader.readAsArrayBuffer(photo.files[0]);
    });

    return;
}

function _app_me(contract, address, options) {
    $('#address').html(address);

    contract.getInformation(address, function(error, result){
        if (!result) {
            $('body').html('');
            window.location.href = '/app/';
        }

        var result = JSON.parse(result);

        var email = result.email;
        var names = result.names;

        if (result.image !== "default"){
            var image = "https://" + options.ipfs_public_host + result.image;
        }else{
            var image = "/assets/img/placeholder.jpg";
        }

        var social = result.social;

        $('#names').html(names);
        $('.profile').attr('alt', names);
        $('.profile').attr('src', image);

        $('#names-edit').val(names);
        $('#email-edit').val(email);
        $('#fb-edit').val(social.facebook);
        $('#tw-edit').val(social.twitter);
        $('#li-edit').val(social.linkedin);
        $('#gp-edit').val(social.googlep);

        var form = $('#edit-form');

        form.submit(function (e) {
            e.preventDefault();

            var image = $('#ipfsphoto').val();

            if (image !== ""){
                const reader = new FileReader();
                reader.onloadend = function() {
                    const ipfs = window.IpfsApi(options.ipfs_host, options.ipfs_port);
                    const buf = buffer.Buffer(reader.result);
                    ipfs.files.add(buf, (err, result) => {
                        if(err) {
                            console.error(err);
                            return;
                        }

                        var hash = `${result[0].hash}`;

                        var json = {
                            "email": $('#email-edit').val(),
                            "names": $('#names-edit').val(),
                            "social": {
                                "facebook": $('#fb-edit').val(),
                                "twitter": $('#tw-edit').val(),
                                "linkedin": $('#li-edit').val(),
                                "googlep": $('#gp-edit').val(),
                            },
                            "image": hash
                        };

                        var jsonString = JSON.stringify(json);

                        contract.newInformation(jsonString, function(error, result){
                            if (error) {
                                console.log(error);
                                return;
                            }

                            form.append('<p align="center" style="margin-top: 25px;"><img src="/assets/img/loading.gif" width="35px"><br/> Please wait for your transaction to be mined. </p>');

                            setInterval(function(){
                                web3.eth.getTransaction(result, function(error, result){
                                    if (result.blockNumber) {
                                        window.location.href = '/app/me#edit-form';
                                    }
                                });
                            }, 5000);
                        });
                    });
                };

                const photo = document.getElementById("ipfsphoto");
                reader.readAsArrayBuffer(photo.files[0]);
            }else{
                var json = {
                    "email": $('#email-edit').val(),
                    "names": $('#names-edit').val(),
                    "social": {
                        "facebook": $('#fb-edit').val(),
                        "twitter": $('#tw-edit').val(),
                        "linkedin": $('#li-edit').val(),
                        "googlep": $('#gp-edit').val(),
                    },
                    "image": result.image
                };

                var jsonString = JSON.stringify(json);

                contract.newInformation(jsonString, function(error, result){
                    if (error) {
                        console.log(error);
                        return;
                    }

                    form.append('<p align="center" style="margin-top: 25px;"><img src="/assets/img/loading.gif" width="35px"><br/> Please wait for your transaction to be mined. </p>');

                    setInterval(function(){
                        web3.eth.getTransaction(result, function(error, result){
                            if (result.blockNumber) {
                                window.location.href = '/app/me#edit-form';
                            }
                        });
                    }, 5000);
                });
            }
        });
    });

    return;
}

function _app_install() {
    $('body').html('');
    window.location.href = '/app/';

    return;
}

function error() {
    var path = window.location.pathname;

    if (path.slice(-1) == '/') {
        path = path.slice(0, -1);
    }

    if ( path !== '/app/install' && path !== '' ){
        $('body').html('');
        window.location.href = '/app/install';
    }
}

// Commands for ipfs to run from api
// Stoyans-MacBook-Pro:~ stoyankostadinov$ ipfs config --json API.HTTPHeaders.Access-Control-Allow-Origin '["*"]'
// Stoyans-MacBook-Pro:~ stoyankostadinov$ ipfs config --json API.HTTPHeaders.Access-Control-Allow-Methods '["GET", "POST"]'
// Stoyans-MacBook-Pro:~ stoyankostadinov$ ipfs config --json API.HTTPHeaders.Access-Control-Allow-Headers '["Authorization"]'
// Stoyans-MacBook-Pro:~ stoyankostadinov$ ipfs config --json API.HTTPHeaders.Access-Control-Expose-Headers '["Location"]'
// Stoyans-MacBook-Pro:~ stoyankostadinov$ ipfs config --json API.HTTPHeaders.Access-Control-Allow-Credentials '["true"]'