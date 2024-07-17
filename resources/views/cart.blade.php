@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Cart</h1>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($keranjang as $item)
                <tr>
                    <td>{{ $item->produk->nama_produk }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>
                        <!-- Update and delete buttons can go here -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        <h2>Categories</h2>
        <ul>
            @foreach($kategori as $cat)
                <li>{{ $cat->name }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
