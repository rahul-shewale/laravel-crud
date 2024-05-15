@extends('layouts.app')
@section('main')

    <div class="container">
        <div class="text-right">
            <a href="products/create" class="btn btn-dark mt-2">New Product</a>
        </div>
        <h1>Products</h1>

        <table class="table table-hover mt-2">
            <thead>
              <tr>
                <th>Sr.NO</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($products as $item)
                <tr>
                    <td>{{ $loop->index + 1}}</td>
                    <td><a class="text-dark" href="/products/show/{{ $item->id }}">{{ $item->name }}</a></td>
                    <td>{{ $item->description }}</td>
                    <td><img src="products/{{ $item->image }}" alt="{{ $item->image }}" class="rounded-circle" width="70" height="70"></td>
                    <td>
                        <a href="/products/edit/{{ $item->id }}" class="btn btn-dark btn-sm">Edit</a>
                      
                        <form action="/products/delete/{{ $item->id }}" method="POST"
                          class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
          {{-- <a href="/products/harddelete"class="text-dark">Hard Delete</a> --}}
          {{ $products->links() }}
    </div>

@endsection