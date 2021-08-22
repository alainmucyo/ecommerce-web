@extends('layouts.app')

@section('content')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Currency Exchange Management</h5>
                    </div>
                    <div class="card-body table-responsive">
                        @include("includes.error")
                        @if($currency)
                            <form action="{{ route("currencies.update",$currency->id) }}" method="post"
                                  enctype="multipart/form-data">
                                {{ method_field("PUT") }} @csrf
                                <div class="form-group">
                                    <label for="rwandan">Rwandan Currency Price(RWF)</label>
                                    <input type="number" name="rwandan" id="rwandan"
                                           value="{{ old("rwandan",$currency->rwandan) }}" class="form-control"
                                           required/>
                                </div>
                                <div class="form-group">
                                    <label for="american">American Currency Price($)</label>
                                    <input type="number" name="american" id="american"
                                           value="{{ old("american",$currency->american) }}"
                                           class="form-control"
                                           required/>
                                </div>
                                <div class="form-group">
                                    <label for="dirham">Dirham Currency Price(dirham)</label>
                                    <input type="number" name="dirham" id="dirham"
                                           value="{{ old("dirham",$currency->dirham) }}" class="form-control"
                                           required/>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="UPDATE"/>
                                </div>
                            </form>
                        @else
                            <form action="{{ route("currencies.store") }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="rwandan">Rwandan Currency Price(RWF)</label>
                                    <input type="number" name="rwandan" id="rwandan" class="form-control"
                                           required/>
                                </div>
                                <div class="form-group">
                                    <label for="american">American Currency Price($)</label>
                                    <input type="number" name="american" id="american"
                                           class="form-control"
                                           required/>
                                </div>
                                <div class="form-group">
                                    <label for="dirham">Dirham Currency Price(dirham)</label>
                                    <input type="number" name="dirham" id="dirham" class="form-control"
                                           required/>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="CREATE NEW"/>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
