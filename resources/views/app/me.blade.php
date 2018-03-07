@extends('layouts/app')

@section('page_title', 'My profile')

@section('body')     
        <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('../assets/img/fabio-mangione.jpg');">
			<div class="filter"></div>
		</div>
        <div class="section profile-content">
            <div class="container">
                <div class="owner">
                    <div class="avatar">
                        <img src="" alt="Loading..." class="img-circle img-no-padding img-responsive profile" width="150px" height="150px">
                    </div>
                    <div class="name">
                        <h4 id="names" class="title names">Loading...</h4>
						<h6 id="address" class="email">Loading..</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto text-center">
                        <p id="information"></p>
                        <br />
                        <a href="#inputs-edit" class="btn btn-outline-default btn-round"><i class="fa fa-cog"></i> Settings</a>
                    </div>
                </div>
                <br/><hr/>
                <div id="inputs-edit" class="inputs">
                    <form id="edit-form">
                        <label>Email</label>
                        <input id="email-edit" type="email" class="form-control" placeholder="Email">

                        <label>Names</label>
                        <input id="names-edit" type="text" class="form-control" placeholder="Names">

                        <label>Profile Image</label><br/>
                        <img src="" alt="Loading..." class="img-circle img-no-padding img-responsive profile" width="50px" height="50px" style="border: 1px #CCC solid;">
                        <input id="ipfsphoto" type="file" class="form-control">

                        <label>Facebook</label>
                        <input id="fb-edit" type="text" class="form-control" placeholder="Facebook">

                        <label>Twitter</label>
                        <input id="tw-edit" type="text" class="form-control" placeholder="Twitter">

                        <label>Linkedin</label>
                        <input id="li-edit" type="text" class="form-control" placeholder="Linkedin">

                        <label>Google+</label>
                        <input id="gp-edit" type="text" class="form-control" placeholder="Google+">

                        <button class="btn btn-danger btn-block btn-round" data-toggle="tooltip" data-placement="top" title="" data-original-title="Be sure you are uploading the right data! You will be charged for this transaction regardless of what data you upload!">Edit</button>
                    </form>
                </div>
            </div>
        </div>
@endsection