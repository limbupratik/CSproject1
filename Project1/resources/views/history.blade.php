@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Transaction History</h1>

        @if ($transactions->isEmpty())
            <p>You have no transaction history.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Receiver</th>
                        <th>Coins Transferred</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ $transaction->recipient->name }} ({{ $transaction->recipient->email }})</td>
                            <td>{{ $transaction->amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
