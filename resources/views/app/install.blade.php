@extends('layouts/app')

@section('page_title', 'Install')

@section('body')
    <div class="section section-install">
        <h1>You wanna use our application?</h1>
        <p>
            To use Ethvatar first you need to install Metamask because we use Metamsk as Wallet. You can install Metamask on your browser from <a href="https://chrome.google.com/webstore/detail/metamask/nkbihfbeogaeaoehlefnkodbefgpgknn" target="_blank">here</a>.<br/>
        </p>
        <h3>I have Metamask, but I can't login</h3>
        <p>
            If you have Metamask please check your network. You should be on Main Etherium Network.<br/><br/>
            <img src="{{ url('assets/img/metamask-install.png') }}" width="250px">
        </p>
    </div>
@endsection