@extends('layouts.admin')

@section('title', 'Product List')
@section('content-header', 'Product List')
@section('content-actions')

@endsection
@section('css')

@endsection
@section('content')

    <div class="card">

        <div class="row mt-3 ml-3 mr-3">
            <div class="col-4">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-cart-plus"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Sotildi</span>

                        <span class="info-box-number">{{$count}}</span>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Savdo</span>
                        <span class="info-box-number">{{$total}}</span>
                    </div>
                </div>
            </div>
            <div class="col-4 ">
                <div class="info-box bg-gradient-warning">
                    <span class="info-box-icon"><i class="fas fa-chart-line"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Foyda</span>
                        <span class="info-box-number">{{$profit}}</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="card-header">
            <h3 class="card-title">@lang('cruds.order.title_singular')</h3>

            <div class="row">
                <div class="col-3"></div>
                <div class="col-3"></div>
                <div class="col-3"></div>
                <div class="col-3"></div>
            </div>

        </div>

        <div class="card-body">

            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Filial</th>
                    <th>Kassir</th>
                    <th>Turi</th>
                    <th>B. Soni</th>
                    <th>Jami</th>
                    <th>Sanasi</th>

                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)

                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->branch->name}}</td>
                        <td>{{$order->cashier->name}}</td>

                        <td>@if($order->pay_type ==0)
                                <i class="fas fa-credit-card" title="Plastik"></i>
                            @elseif($order->pay_type == 1)
                                <i class="fas fa-money-bill-wave" title="Naqd"></i>
                            @else
                            @endif
                        </td>

                        <td> {{ $order->items->count()}}</td>
                        <td>{{$order->total_price}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modal{{$order->id}}">
                                <i class="fas fa-eye"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modal{{$order->id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="modal{{$order->id}}Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal{{$order->id}}Label">
                                                Chek: {{$order->id}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach($order->items as $index =>$item)
                                                {{($index+1).". ".$item->product->title}} <br>
                                                Narxi: {{$item->count}} x {{$item->price}}={{$item->total_price}}<br>

                                                @if($item->discount != 0)
                                                    Skidka: {{$item->discount}}
                                                @endif

                                                <br>
                                            @endforeach
                                            ----------------------------<br>
                                            Jami: {{$order->total_price}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Yopish
                                            </button>
                                            {{--                                            <button type="button" class="btn btn-primary">Save changes</button>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('orders.edit', $order) }}" class="btn btn-primary"><i
                                    class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-delete" data-url="{{route('orders.destroy', $order)}}"><i
                                    class="fas fa-trash"></i></button>
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
