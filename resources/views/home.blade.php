@extends('layouts.mainlayouts')

@section('title', 'Home')

@section('content')

        <h1>Ini Halaman Home</h1>
        <h2>Selamat datang, {{ Auth::user()->name }}. Anda adalah {{ Auth::user()->role->name }}</h2>

       {{-- <table class="table">
            <tr>
                <th>No.</th>
                <th>Nama</th>
            </tr>
            @foreach ($buah as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data }}</td>
            </tr>    
            @endforeach

       </table> --}}
@endsection

        {{-- @for ($i = 0; $i < 5; $i++)
            {{ $i }} <br/>
        @endfor --}}

        {{-- @if ($role == 'admin')
            <a href="">Ke halaman admin</a>
        @elseif ($role == 'staff')
            <a href="">Ke halaman gudang</a>
        @else
            <a href="">Ke halaman lain</a>
        @endif --}}

        {{-- @switch($role)
            @case($role == 'admin')
                <a href="">ke halaman admin</a>
                @break
            @case($role == 'staff')
                <a href="">ke halaman gudang</a>
                @break
        
            @default
                <a href="">ke halaman lain</a>
                
        @endswitch --}}
