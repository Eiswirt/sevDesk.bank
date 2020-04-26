@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Checking accounts</div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Amount</th>
                                <th>Limit</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($check as $it)
                                    <tr>
                                        <td>{{$it -> id}}</td>
                                        <td>{{$it -> amount}} €</td>
                                        <td>{{$it -> limit}} €</td>
                                    </tr>
                                @endforeach
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-header">Credit accounts</div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>IDr</th>
                                <th>Amount</th>
                                <th>Limit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($credits as $it)
                                <tr>
                                    <td>{{$it -> id}}</td>
                                    <td>{{$it -> amount}} €</td>
                                    <td>{{$it -> limit}} €</td>
                                </tr>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-header">Passbook</div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Amount</th>
                                <th>Interest</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($passb as $it)
                                <tr>
                                    <td>{{$it -> id}}</td>
                                    <td>{{$it -> amount}} €</td>
                                    <td>{{$it -> interest}} %</td>
                                </tr>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
