@include('Admin.Navigation_bar')

<head>
    <title>Product List</title>
</head>

<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col-md-12">
            @if (Session::has('success'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if (!empty($notify))
                <div class="alert alert-primary" role="alert">
                    {{ $notify }}
                </div>
            @endif
            @if (!empty($fail))
                <div class="alert alert-danger" role="alert">
                    {{ $fail }}
                </div>
            @endif

            @if (Session::has('LoginID'))
                <div style="margin-right: 1%; float:right;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;">
                    <a href="{{ url('addProduct') }}" class="btn btn-success">
                        <i class="fas fa-plus-circle"></i> Add</a>
                </div>

                <div style="margin-right: 1%; float:right;">
                    <form action="{{ url('searchProduct') }}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search products" name="search">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" style="height:100%;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;"><i
                                        class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif

            <div style="margin-left: 5%; float:left;">
                <h2>Product List</h2>
            </div>
            {{-- End buttons --}}
            <table class="table table-hover" style="box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;">
                <thead>
                    <tr style="text-align: center">
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Details</th>
                        <th>Images</th>
                        <th>Size</th>
                        <th>Available</th>
                        @if (Session::has('LoginID'))
                            <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr style="text-align: center; vertical-align:middle">
                            <td>{{ $row->Product_ID }}</td>
                            <td>{{ $row->Product_Name }}</td>
                            <td>{{ $row->Category_ID }}</td>
                            <td>${{ $row->Price }}</td>
                            <td>{{ $row->Details }}</td>
                            <td>
                                <?php
                                $path = 'img/products/';
                                $ImagesAll = explode('@@@', $row->Images);
                                foreach ($ImagesAll as $item) {
                                    $img = $path . $item;
                                    echo "<img src='$img' width='100px' height='100px' style='margin-left:5px'>";
                                }
                                ?>
                            </td>
                            <td>{{ $row->Size }}</td>
                            <td>{{ $row->Available }}</td> <img src="" alt="">

                            @if (Session::has('LoginID'))
                                <td>
                                    <a href="{{ url('editAdmin/' . $row->Product_ID) }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ url('deleteAdmin/' . $row->Product_ID) }}" class="btn btn-danger"
                                        onclick="return confirm('Confirm delete?')">
                                        <i class="fas fa-trash-alt"></i></a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>

</html>
