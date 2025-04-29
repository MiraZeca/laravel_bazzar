@extends('home')

@section('title', 'Contact - Info')

@section('main')
    <div class="container">
        <h1 class="my-4">Contact List</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Creation date</th>
                        <th>Answered</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ $contact->message }}</td>
                            <td>{{ $contact->created_at->format('d.m.Y H:i') }}</td>
                            <td>
                                <input type="checkbox" class="answered-checkbox" data-id="{{ $contact->id }}"
                                    {{ $contact->answered ? 'checked' : '' }}>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> <br>
        <a href="{{ route('admin') }}" class="btn btn-primary">Back to All Products</a><br>

        @if ($contacts->isEmpty())
            <p class="text-center">No contacts found.</p>
        @endif
    </div><br><br>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.answered-checkbox').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    let contactId = this.getAttribute('data-id');
                    let isChecked = this.checked ? 1 : 0;

                    fetch(`/contact/${contactId}/answered`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                answered: isChecked
                            })
                        }).then(response => response.json())
                        .then(data => {
                            console.log('Updated:', data);
                        }).catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
@endsection
