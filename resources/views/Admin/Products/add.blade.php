@include('Admin.Navigation_bar')

<head>
    <title>Add product</title>
</head>

<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col-md-12">
            <h2>Add a new product</h2>
            <hr style="width: 500px;">
            {{-- Notification --}}
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <form action="{{ url('saveProduct') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="md-3">
                    <label for="name" class="form-label">Product Name</label>
                    <textarea type="number" name="name" class="form-control" placeholder="Enter product name"
                        style="width: 500px; height:75px">{{ old('name') }}</textarea>
                </div>
                @error('name')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <div class="md-3">
                    <label for="category" class="form-label">Category</label>
                    <select name="category" class="form-control form-select" value="{{ old('category') }}"
                        style="width: 200px">
                        @foreach ($data as $row)
                            <option value="{{ $row->Category_ID }}">{{ $row->Category_Name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <div class="md-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" placeholder="Product price"
                        value="{{ old('price') }}" style="width: 150px">
                </div>
                @error('price')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <div class="md-3">
                    <label for="details" class="form-label">Details</label>
                    <textarea type="number" name="details" class="form-control" placeholder="Enter product details"
                        style="width: 500px; height:150px">{{ old('details') }}</textarea>
                </div>
                @error('details')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <div class="md-3">
                    <label for="images" class="form-label">Images</label>
                    <input type="file" name="images[]" class="form-control" multiple value="{{ old('images[]') }}"
                        style="width: 350px" id="file-input">
                    <br>
                    <label for="preview">Previews</label>
                    <div id="preview" style="width:220px;height:220px" class="form-control" ></div> {{--preview area--}}
                    <br>
                    {{-- Script to preview multiple uploaded images --}}

                    <script>
                        function previewImages() {
                            var preview = document.querySelector('#preview');
                            preview.innerHTML = '';     //clear previous previews
                            preview.style = "width:fit-content";    //change the preview <div> style to fit the new childs (images in this case)
                            if (this.files) {
                                [].forEach.call(this.files, readAndPreview);
                            }
                            function readAndPreview(file) {
                                // Make sure `file.name` matches our extensions criteria
                                if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                                    return alert(file.name + " is not an image");
                                }
                                var reader = new FileReader();
                                reader.addEventListener("load", function() {
                                    var image = new Image();
                                    image.height = 210;
                                    image.width = 210;
                                    image.title = file.name;
                                    image.style = "border-radius: 10px; margin: 5px"    //image attributes
                                    image.src = this.result;
                                    preview.appendChild(image);
                                });
                                reader.readAsDataURL(file);
                            }
                        }
                        document.querySelector('#file-input').addEventListener("change", previewImages);
                    </script>

                    {{--End script--}}

                </div>
                @error('images')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
                {{-- <div class="md-3">
                        <label for="size" class="form-label">Size</label>
                        <input type="text" name="size" class="form-control" placeholder="Enter size">
                    </div>
                    @error('size')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror --}}
                <div class="md-3">
                    <label>Sizes</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="S"
                            name="size[]">
                        <label class="form-check-label" for="inlineCheckbox1">S</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="M"
                            name="size[]">
                        <label class="form-check-label" for="inlineCheckbox2">M</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="L"
                            name="size[]">
                        <label class="form-check-label" for="inlineCheckbox3">L</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="XL"
                            name="size[]">
                        <label class="form-check-label" for="inlineCheckbox4">XL</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox5" value="XXL"
                            name="size[]">
                        <label class="form-check-label" for="inlineCheckbox5">XXL</label>
                    </div>
                </div>

                <div class="md-3">
                    <label for="available" class="form-label">Available</label>
                    <input type="number" name="available" class="form-control" placeholder="Enter available"
                        value="{{ old('available') }}" style="width: 160px">
                </div>
                @error('available')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ url('listProduct') }}" class="btn btn-danger">Back</a>
                <br><br><br><br><br><br>
            </form>
        </div>
    </div>
</div>
</body>

</html>
