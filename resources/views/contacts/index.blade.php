@extends('layout')

@section('content')
    <h2 class="mb-4">Contacts List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Last Name</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ ($contacts->currentPage() - 1) * $contacts->perPage() + $loop->iteration }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->lastName }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>
                        <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        
    </table>
   <!-- Add Pagination Links -->
<div class="d-flex justify-content-center mt-4">
    {{ $contacts->links('vendor.pagination.bootstrap-5') }}

</div>

@endsection
