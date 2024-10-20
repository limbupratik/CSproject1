@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Transfer Coins</h1>
        <p>You have {{ Auth::user()->coins }} coins.</p>

        <!-- Display error or success messages -->
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ url('/transfer-coins') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="recipient_email">Recipient Email:</label>
                <input type="email" name="recipient_email" id="recipient_email" class="form-control" required>
            </div>

            <div class="form-group mt-3">
                <label for="amount">Amount to Transfer:</label>
                <input type="number" name="amount" id="amount" class="form-control" min="1" max="{{ Auth::user()->coins }}" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Transfer Coins</button>
        </form>
    </div>
@endsection

