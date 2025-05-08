@section('title')
    Admin
@endsection

@extends('home')

@section('main')
    <section>
      
        <div class="container mt-3">
            <div class="row">
                <div class="col-6 offset-3">
                    @if (session('success'))
                        <div id="successAlert" class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if (session('create'))
                    <div id="createAlert" class="alert alert-success" role="alert">
                        {{ session('create') }}
                    </div>
                @endif
                @if ($errors->has('profile_image'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('profile_image') }}
                </div>
            @endif
                </div>
            </div>
        </div>

        <div class="container">
            <div class="col-sm-6 offset-sm-3 text-center">
              
                <button id="uploadProfileImageBtn" class="btn-primary btn m-3 text-center">Upload a profile image</button>
                
                <form id="profileImageForm" action="{{ route('profile.image.upload') }}" method="POST"
                    enctype="multipart/form-data" style="display: none;">
                    @csrf
                    <br>
                    <label for="profile_image">Select an image:</label>
                    <input type="file" name="profile_image" id="profile_image" class="form-control">
                    <button type="submit" class="btn-primary btn m-3">Save image</button>
                </form>
            </div>

            <div class="container">
                <div class="col text-center">
                    <a href="{{ route('users.index') }}" class="btn-primary btn m-2 p-2">Add User / Admin</a>
                    <a href="{{ route('categories.create') }}" class="btn btn-primary m-2 p-2">Add Category</a>
                    <a href="{{ route('product.create') }}" class="btn btn-primary m-2 p-2">Add Product</a>
                    <a href="{{ route('contact.info') }}" class="btn btn-primary m-2 p-2">Contact - Info</a>
                    <a href="{{ route('warehouse.index') }}" class="btn btn-primary m-2 p-2">Warehouse</a>
                    <a href="{{ route('admin.orders') }}" class="btn btn-primary m-2 p-2">Orders</a>
                    <a href="{{ route('subscribes') }}" class="btn btn-primary m-2 p-2">Subscribers</a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover text-center p-3">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Images</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Discount Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
            
                    <tbody>
                        @foreach ($allProducts as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            width="100" height="100">
                                    @else
                                        <p>No image available</p>
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->discount_price }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <button class="btn btn-warning btnedit">
                                        <a href="{{ route('product.edit', $product->id) }}">Edit</a>
                                    </button>
            
                                    <!-- Delete Button -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                        onclick="setDeleteAction('{{ route('product.destroy', $product->id) }}')">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            
            
            <br><br>

        </div>

        <!-- Modal Confirmation for Deletion -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this product?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete" onclick="submitDeleteForm()">Yes</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
          
            let deleteUrl = '';

  
            function setDeleteAction(url) {
                deleteUrl = url;
            }

           
            function submitDeleteForm() {
                if (deleteUrl) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = deleteUrl;

                  
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = "{{ csrf_token() }}";

                   
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';

                    form.appendChild(csrfToken);
                    form.appendChild(methodField);
                    document.body.appendChild(form);

                    // Slanje forme
                    form.submit();
                }
            }

       
        document.getElementById('uploadProfileImageBtn').addEventListener('click', function() {
            var form = document.getElementById('profileImageForm');
            
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        });

        $(document).ready(function() {
            $('#uploadProfileImageBtn').click(function() {
                $('#profileImageForm').slideToggle();
            });
        });
        </script>

    </section> <br>
@endsection
