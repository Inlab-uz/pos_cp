@extends('layouts.admin')

@section('title', 'Edit Product')
@section('content-header', 'Edit Product')

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')


                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="category_id">@lang('cruds.category.title')</label>
                            <select class="form-control" name="category_id" id="category_id">

                                @foreach($categories as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="form-group">
                            <label for="title">@lang('cruds.pos.fields.product_name')</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                   id="title"
                                   placeholder="Coca-Cola" value="{{ old('name', $product->title) }}">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="barcode_number">@lang('cruds.pos.fields.barcode')</label>
                            <input type="text" name="barcode_number"
                                   autofocus
                                   class="form-control @error('barcode_number') is-invalid @enderror"
                                   id="barcode_number" placeholder="xxxxxxxx"
                                   value="{{ old('barcode_number', $product->barcode_number) }}">
                            @error('barcode_number')
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="description">@lang('global.description')</label>
                            <textarea name="description" rows="10"
                                      class="form-control @error('description') is-invalid @enderror"
                                      id="description"
                                      placeholder="Coca-Cola 1.5l. Enjoy with drinking with meals">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-2">

                        <div class="form-group">
                            <label for="image">@lang('cruds.product.fields.image')</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" id="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                            @enderror
                            <br>
                            <br>
                            <img class="align-items-center" id="blah" src="{{asset('consImages/image.png')}}"
                                 alt="your image" height="190px"
                                 width="240px"/>
                        </div>

                    </div>


                </div>

                <div class="row">

                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="price">@lang('cruds.import.fields.price')</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                   id="price"
                                   placeholder="@lang('cruds.import.fields.price')"
                                   value="{{ old('price', $import->price) }}">
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="nds">@lang('cruds.import.fields.nds') %</label>
                            <input type="number" name="nds" class="form-control @error('nds') is-invalid @enderror"
                                   id="nds"
                                   placeholder="nds" value="{{ old('nds',  $import->nds) }}">
                            @error('nds')
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="sale_price">@lang('cruds.import.fields.sale_price')</label>
                            <input type="number" name="sale_price"
                                   class="form-control @error('sale_price') is-invalid @enderror"
                                   id="sale_price"
                                   placeholder="@lang('cruds.import.fields.sale_price')"
                                   value="{{ old('sale_price', $import->sale_price) }}">
                            @error('sale_price')
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="form-group">
                            <label for="quantity">@lang('cruds.import.fields.quantity')</label>
                            <input type="text" name="quantity"
                                   class="form-control @error('quantity') is-invalid @enderror"
                                   id="quantity" placeholder="Quantity" value="{{ old('quantity',  $import->part) }}">
                            @error('quantity')
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror"
                                    id="status">
                                <option value="1" {{ old('status') === 1 ? 'selected' : ''}}>Active</option>
                                <option value="0" {{ old('status') === 0 ? 'selected' : ''}}>Inactive</option>
                            </select>
                            @error('status')
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>
    </div>
@endsection
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script>

    console.log(1)


    $(document).ready(function () {
        console.log(2)
        $('#nds').on('keyup', function () {
            var price = parseInt($('#price').val());
            var pr = price * parseInt($('#nds').val()) / 100;
            var total = price + pr
            $('#sale_price').val(total);
        });

        bsCustomFileInput.init();
    });

</script>
<script>
    $(document).ready(function () {
        image.onchange = evt => {
            const [file] = image.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    });
</script>

@section('js')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>


@endsection
