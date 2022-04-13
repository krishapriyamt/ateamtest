@extends('layouts.app')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Profile Edit</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profile</li>
      </ol>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
          </div>
          @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible hidesuccess" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>{{ session()->get('success') }}</strong> 
            </div>
          @endif
          @if(session()->has('danger'))
            <div class="alert alert-danger alert-dismissible hidesuccess" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>{{ session()->get('danger') }}</strong> 
            </div>
          @endif
          <div class="card-body">
            <form method="POST" action="{{ url('user/update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="userid" value="{{$viewdata[0]['id']}}">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="col-md-55">
                                    <div class="image view view-first">
                                        @php $file = Auth::user()->profile_image; 
                                             $extension = explode('.',$file);
                                        @endphp
                                        <img style="width: 50px;height: 50px; display: block;" src="{{url('storage/profileImage/userphoto'.Auth::user()->id.'.'.$extension[1])}}" alt="image"  />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{$viewdata[0]['name']}}">
                                @if($errors->has('name'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email </label>
                                <input type="text" class="form-control" name="email" value="{{$viewdata[0]['email']}}">
                                @if($errors->has('email'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control mb-3" name="gender" required>
                                    <option value="female" @if($viewdata[0]['gender'] == 'female')  selected="" @endif>Female</option>
                                    <option value="male" @if($viewdata[0]['gender'] == 'male')  selected="" @endif>Male</option>
                                    <option value="other" @if($viewdata[0]['gender'] == 'other')  selected="" @endif>Other</option>
                                </select>
                                @if($errors->has('gender'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- <div class="col-lg-6">
                            <div class="form-group">
                                <label>Password</label>
                                    <input type="text" class="form-control" name="paswd" value="{{$viewdata[0]['password']}}">
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file"  name="profile_image">
                                        <input type="hidden" value="{{$viewdata[0]['profile_image']}}" name="old_image">
                                        @if($errors->has('profile_image'))
                                            <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('profile_image') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
