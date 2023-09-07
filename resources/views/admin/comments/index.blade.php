@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Comment List
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th style="width:20px;">
                                    <label class="i-checks m-b-none">
                                        <input type="checkbox"><i></i>
                                    </label>
                                </th>
                                <th>product ID</th>
                                <th>product name</th>
                                <th>customer id</th>
                                <th>customer name</th>
                                <th>Comment content</th>
                                <th>status</th>
                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    <td><label class="i-checks m-b-none"><input type="checkbox"
                                                name="post[]"><i></i></label></td>
                                    <td>{{ $comment->product_id }}</td>
                                    <td>{{ $comment->product->product_name }}</td>
                                    <td>{{ $comment->customer_id }}</td>
                                    <td>{{ $comment->customer->customer_name }}</td>
                                    <td>{{ $comment->content }}</td>
                                    <td>
                                        @if ($comment->approved)
                                            <span class="label label-success">Approved</span>
                                        @else
                                            <span class="label label-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('approve.comment', ['id' => $comment->comment_id]) }}"
                                            class="active styling-edit" ui-toggle-class="">
                                            <i class="fa fa-check-square-o text-success text-active"></i>
                                        </a>
                                        <a onclick="return confirm('Are you sure to delete?')"
                                            href="{{ route('delete.comment', ['id' => $comment->comment_id]) }}"
                                            class="active styling-delete" ui-toggle-class="">
                                            <i class="fa fa-trash text-danger text"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-5 text-center">
                            {{-- <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small> --}}
                        </div>
                        <div class="col-sm-7 text-right text-center-xs">
                            {{ $comments->links() }}
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
@endsection
