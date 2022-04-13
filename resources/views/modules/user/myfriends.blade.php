@extends('layouts.app')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">My Friends</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Friends</li>
        </ol>
    </div>
    @if(Session::has('success'))
        <div class="alert {{ Session::get('alert-class', 'alert-success') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('success') }}
        </div>
    @endif
    @if(Session::has('error'))
        <div class="alert {{ Session::get('alert-class', 'alert-danger') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">My Friends List</h6>
                </div>

                <div class="row">
                @if(count($friends) > 0)
                                @foreach($friends as $key => $value)
                <div class="col-lg-4  justify-content-center">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary text-center">{{ $value->name }}</h6>
                </div>
                <div class="card-body">
                    <div class=" d-flex justify-content-center">

                                 @if($value->profile_image != '')
                                        @php $file = $value->profile_image; 
                                             $extension = explode('.',$file);
                                        @endphp
                                        <img class="img-profile rounded-circle" src="{{url('storage/profileImage/userphoto'.$value->id.'.'.$extension[1])}}" style="max-width: 150px">
                                    @else
                                        <img class="img-profile rounded-circle" src="https://via.placeholder.com/150" style="max-width: 150px">
                                    @endif
                    </div>
            </div>
            
            <div class="card-footer text-center">
                            Email :    {{ $value->email }} 
                            <br/>   
                            Gender :    {{ $value->gender }}            
                  </div>
              </div>
            </div>

            @endforeach
                            @else
                                <div colspan="8" class="col-lg-12  text-bold text-danger text-center">
                                    No Data Found
                                </div>
                            @endif
</div>

              
            </div>
        </div>
    </div>
</div>
@endsection
