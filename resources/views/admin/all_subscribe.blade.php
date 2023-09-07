@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    EMAIL SUBSCRIBED LIST
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                <div class="panel-body">
                    <a href="{{ route('composeEmail') }}" class="btn btn-primary">Compose Email</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Subscribed Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subscribes as $subscribe)
                                <tr>
                                    <td>{{ $subscribe->subscribe_id }}</td>
                                    <td>{{ $subscribe->email_subscribe }}</td>
                                    <td>{{ $subscribe->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
