@extends('layouts.app-admin') 

@section('content')
    <div class="head-title">
        <div class="left">
            <h1>Dashboard</h1>
            <ul class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">Order/Transaction</a></li>
            </ul>
        </div>
    </div>

    <ul class="box-info">
        <li>
            <i class='bx bxs-calendar-check'></i>
            <span class="text"><h3>{{ count($orders) }}</h3><p>Recent Orders</p></span>
        </li>
        <li>
            <i class='bx bxs-group'></i>
            <span class="text"><h3>{{ $total_login }}</h3><p>Visitors Today</p></span>
        </li>
        <li>
            <i class='bx bx-wallet'></i>
            <span class="text"><h3>Rp {{ number_format($total_sales, 0, ',', '.') }}</h3><p>Total Sales</p></span>
        </li>
        <li>
            <i class='bx bx-line-chart'></i>
            <span class="text"><h3>{{ $total_register }}</h3><p>Register</p></span>
        </li>
    </ul>

    <div class="table-container">
        <h3>Recent Orders</h3>
        <table>
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Nama Pembeli</th>
                    <th>Tanggal Pembelian</th>
                    <th>Daftar Barang</th>
                    <th>Harga per Item</th>
                    <th>Total Harga</th>
                    <th>Bukti Bayar</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>#{{ str_pad($order['id'], 3, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ htmlspecialchars($order['fullname']) }}</td>
                        <td>{{ date('d-m-Y', strtotime($order['order_date'])) }}</td>
                        <td><ul>@foreach ($order['barang'] as $b)<li>{{ htmlspecialchars($b) }}</li>@endforeach</ul></td>
                        <td><ul>@foreach ($order['harga'] as $h)<li>{{ $h }}</li>@endforeach</ul></td>
                        <td>Rp {{ number_format($order['total'], 0, ',', '.') }}</td>
                        <td>
                            @if ($order['file_path'])
                                <a href="{{ asset('uploads/' . $order['file_path']) }}" target="_blank" class="text-blue-600 underline">View</a>
                            @else
                                <span class="text-gray-400 text-sm">None</span>
                            @endif
                        </td>
                        <td>
                            {{-- FORM DENGAN ONCHANGE (Sudah diuji aman jika cache bersih) --}}
                            <form method="post" action="{{ route('dashboard.updateStatus') }}">
                                @csrf 
                                <input type="hidden" name="order_id" value="{{ $order['id'] }}">
                                <select name="new_status" onchange="this.form.submit()" class="status-select status-{{ strtolower($order['order_status']) }}">
                                    @php $statuses = ['Pending', 'Processing', 'Shipped', 'Completed']; @endphp
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}" {{ $order['order_status'] == $status ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td>
                            <a href="{{ url('order_detail/' . $order['id']) }}" class="text-sm bg-pink-600 text-white px-3 py-1 rounded hover:bg-pink-700 transition">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection