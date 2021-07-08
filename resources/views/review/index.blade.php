@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if($reviews->count()>0)
                @foreach($reviews as $review)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">{{ $review->title }} by {{ $review->name }}</div>
                            <div class="card-body">
                                {{ $review->content }}
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <span class="text-muted">{{ $review->email }}</span>
                                <span class="text-muted">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-12 d-flex justify-content-center">
                    {!! $reviews->links() !!}
                </div>
            @else
                <div class="col-md-8">
                    <div class="alert alert-info">No Reviews available.</div>
                </div>
            @endif

        </div>
    </div>
@endsection
