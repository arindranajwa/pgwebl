@extends('layout.tamplate')

@section('content')
<div>

</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($points as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->name }}</td>
            <td>{{ $p->description }}</td>
            <td>
                <img src="{{ asset('storage/images/' . $p->image) }}" alt=""
                width="200" title="{{ $p->image }}">
            </td>
            <td>{{ $p->created_at }}</td>
            <td>{{ $p->updated_at }}</td>
        </tr>
        @endforeach

        @foreach ($polylines as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->name }}</td>
            <td>{{ $p->description }}</td>
            <td>
                <img src="{{ asset('storage/images/' . $p->image) }}" alt=""
                width="200" title="{{ $p->image }}">
            </td>
            <td>{{ $p->created_at }}</td>
            <td>{{ $p->updated_at }}</td>
        </tr>
        @endforeach

        @foreach ($polygons as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->name }}</td>
            <td>{{ $p->description }}</td>
            <td>
                <img src="{{ asset('storage/images/' . $p->image) }}" alt=""
                width="200" title="{{ $p->image }}">
            </td>
            <td>{{ $p->created_at }}</td>
            <td>{{ $p->updated_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
