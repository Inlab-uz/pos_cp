@extends('layouts.admin')

@section('title', 'Product List')
@section('content-header', 'Product List')
@section('content-actions')

@endsection
@section('css')

@endsection
@section('content')

    <div class="card">

        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Filial</th>
                    <th>Kassir</th>
                    <th>Turi</th>
                    <th>items</th>
                    <th>Jami</th>
                    <th>Created At</th>

                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)


                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->branch->name}}</td>
                        <td>{{$order->cashier->name}}</td>
                        <td>{{$order->pay_type}}</td>
                        <td>{{$order->items->count()}}</td>
                        <td>{{$order->total_price}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>
                            <a href="{{ route('orders.edit', $order) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-delete" data-url="{{route('orders.destroy', $order)}}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $orders->links() }}
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.btn-delete', function () {
                $this = $(this);
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "Do you really want to delete this product?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.post($this.data('url'), {_method: 'DELETE', _token: '{{csrf_token()}}'}, function (res) {
                            $this.closest('tr').fadeOut(500, function () {
                                $(this).remove();
                            })
                        })
                    }
                })
            })
        })
    </script>
@endsection
