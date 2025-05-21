<!DOCTYPE html>
<html>
<head>
    <title>Image Upload</title>
</head>
<body>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
        <img src="{{ asset('storage/' . session('path')) }}" width="300" />
    @endif

    <form action="{{ route('upload.image') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" required>
        @error('image')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <button type="submit">Upload</button>
    </form>
</body>
</html>



<!-- 

<img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->filename }}">
<p>{{ $image->filename }}</p> 

-->
