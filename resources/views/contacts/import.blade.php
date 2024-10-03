@extends('layout')

@section('content')
    <h2>Import Contacts from XML</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <form action="{{ route('contacts.importXML') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="xml_file" class="form-label">Choose XML File</label>
            <input type="file" class="form-control" id="xml_file" name="xml_file" required>
        </div>
        <button type="submit" class="btn btn-primary">Import Contacts</button>
    </form>
@endsection
