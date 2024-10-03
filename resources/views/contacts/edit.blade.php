@extends('layout')

@section('content')
    <h2>Edit Contact</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $contact->name }}" required>
        </div>
        <div class="mb-3">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="lastName" value="{{ $contact->lastName }}" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $contact->phone }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update Contact</button>
    </form>
@endsection
