@extends('layouts.admin')

@section('title', 'Open POS')
@section('content-header', 'Open POS')

@section('content')

    <div class="card">

        <div class="row">
            <div class="col-md-6 col-lg-5">
                <div class="row mb-2">
                    <div class="col">
                        <form onSubmit=>
                            <input type="text" class="form-control" placeholder="Scan Barcode..."/>
                        </form>
                    </div>
                    <div class="col">
                        <select class="form-control">
                            <option value="">Walking Customer</option>
                            </option>
                        </select>
                    </div>
                </div>
                <div class="user-cart">
                    <div class="card">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Product Name</th>
                                <th >Quantity</th>
                                <th class="text-right">Price</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td>Olma</td>
                                <td>
                                    <label>
                                        <input  type="text" class="form-control form-control-sm qty" value="1"/>
                                    </label>
                                    <button class="btn btn-danger btn-delete" data-url=""><i
                                            class="fas fa-trash"></i></button>
                                </td>
                                <td class="text-right">
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col">Total:</div>
                    <div class="col text-right">

                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button
                            type="button"
                            class="btn btn-danger btn-block"
                        >
                            Cancel
                        </button>
                    </div>
                    <div class="col">
                        <button
                            type="button"
                            class="btn btn-primary btn-block"
                        >
                            Submit
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-7">
                <div class="mb-2">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Search Product..."
                    />
                </div>
                <div class="order-product">

                    <div>
                        <img src="" alt=""/>
                        <h5></h5>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script>

    </script>
@endsection
