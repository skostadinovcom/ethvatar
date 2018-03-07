@extends('layouts/app')

@section('page_title', 'Sign')

@section('body')
    <div class="page-header" style="background-image: url('../assets/img/login-image.jpg');">
        <div class="filter"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 ml-auto mr-auto">
                    <div class="card card-register">
                        <h3 class="title">Welcome</h3>
                        <form class="register-form">
                            <label>Ethereum Address</label>
                            <input id="address" type="text" class="form-control" placeholder="Ethereum Address" readonly>

                            <label>Email</label>
                            <input id="email" type="email" class="form-control" placeholder="Email">

                            <label>Names</label>
                            <input id="names" type="text" class="form-control" placeholder="Names">

                            <label>Profile Image</label>
                            <input id="ipfsphoto" type="file" class="form-control">

                            <button class="btn btn-danger btn-block btn-round">Join</button>
                        </form>
                        <div class="forgot">
                            <a href="#" class="btn btn-link btn-danger">You have problem?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection