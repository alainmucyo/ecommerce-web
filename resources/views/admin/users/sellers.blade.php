@extends('layouts.app')
@section('content')
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>List New Sellers</h5>
                    </div>
                    <div class="card-body table-responsive">
                        @if($sellers->count()>0)
                            <table class="table table-stripped" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Joined At</th>
                                    <th>Action?</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sellers as $seller)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            {{ $seller->name }}
                                        </td>
                                        <td>{{ $seller->email  }}
                                        </td>
                                        <td> {{ $seller->phone }}</td>
                                        <td>{{$seller->created_at->toDateString()}}</td>
                                        <td>
                                            <form method="post" onsubmit="return confirm('Deliver the order?')"
                                                  style="display: inline"
                                                  action="/user/seller/{{$seller->id}}">
                                                {{ method_field("PUT") }}
                                                @csrf
                                                <button type="submit" data-toggle="tooltip" data-placement="top"
                                                        title="Accept The Seller" href="#"
                                                        class="btn-icon btn-icon-only btn-pill btn btn-outline-success"
                                                ><i
                                                        class="feather icon-check btn-icon-wrapper"> </i></button>
                                            </form>
                                            <form method="post" onsubmit="return confirm('Reject the seller?')"
                                                  style="display: inline"
                                                  action="/user/seller/{{$seller->id}}">
                                                {{ method_field("DELETE") }}
                                                @csrf
                                                <button type="submit" data-toggle="tooltip" data-placement="top"
                                                        title="Reject the seller" href="#"
                                                        class="btn-icon btn-icon-only btn-pill btn btn-outline-danger"
                                                ><i
                                                        class="fa fa-times btn-icon-wrapper"> </i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-info">No new sellers requests available.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
