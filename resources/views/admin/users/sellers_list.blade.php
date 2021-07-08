@extends('layouts.app')
@section('content')
    <div class="container" id="app">
        <vue-progress-bar></vue-progress-bar>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>List Sellers</h5>
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
                                    <th>Homepage</th>
                                    <th>Action</th>
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
                                            <form method="post" action="/admin/seller/{{$seller->id}}/home"
                                                  onsubmit="return confirm('Allow seller to post products on homepage?')">
                                                @csrf
                                                {{ method_field("PUT") }}
                                                @if(!$seller->on_homepage)
                                                    <button type="submit" value="add" name="submit"
                                                            class="btn btn-warning btn-sm" data-toggle="tooltip"
                                                            data-placement="top"
                                                            title="Click to allow seller to post products on homepage">
                                                        NOT ON HOMEPAGE
                                                    </button>
                                                @else
                                                    <button type="submit" value="remove" name="submit" class="btn btn-success btn-sm"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Click to restrict seller to post products on homepage">
                                                        ON HOMEPAGE
                                                    </button>
                                                @endif
                                            </form>
                                        </td>
                                        <td>
                                            @if(!$seller->disabled)
                                                <form method="post"
                                                      onsubmit="return confirm('Disable Account and making seller\'s products unavailable.')"
                                                      style="display: inline"
                                                      action="/admin/seller/disable/{{$seller->id}}">
                                                    {{ method_field("PUT") }}
                                                    @csrf
                                                    <button type="submit" data-toggle="tooltip" data-placement="top"
                                                            title="Disable Account and making seller's products unavailable."
                                                            href="#"
                                                            class="btn-icon btn-icon-only btn-pill btn btn-outline-warning"
                                                    ><i
                                                            class="fa fa-times btn-icon-wrapper"> </i></button>
                                                </form>
                                            @else
                                                <form method="post"
                                                      onsubmit="return confirm('Enable Account and making seller\'s products available again.')"
                                                      style="display: inline"
                                                      action="/admin/seller/enable/{{$seller->id}}">
                                                    {{ method_field("PUT") }}
                                                    @csrf
                                                    <button type="submit" data-toggle="tooltip" data-placement="top"
                                                            title="Enable Account and making seller's products available again."
                                                            href="#"
                                                            class="btn-icon btn-icon-only btn-pill btn btn-outline-success"
                                                    ><i
                                                            class="feather icon-check btn-icon-wrapper"> </i></button>
                                                </form>
                                            @endif
                                            {{--   <form method="post" onsubmit="return confirm('Delete the seller?')"
                                                     style="display: inline"
                                                     action="/user/seller/{{$seller->id}}">
                                                   {{ method_field("DELETE") }}
                                                   @csrf
                                                   <button type="submit" data-toggle="tooltip" data-placement="top"
                                                           title="Delete Seller and his/her all products. No Undo" href="#"
                                                           class="btn-icon btn-icon-only btn-pill btn btn-outline-danger"
                                                   ><i
                                                           class="feather icon-trash btn-icon-wrapper"> </i></button>
                                               </form>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-info">No sellers available.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push("scripts")
    @include("includes.datatable")
@endpush
