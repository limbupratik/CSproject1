@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{ url('/transfer-coins') }}" class="btn btn-primary">Transfer Coins</a>


                        <a href="{{ url('/transaction-history') }}" class="btn btn-secondary">View Transaction History</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
