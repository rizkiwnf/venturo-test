<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <title>Get Data Makanan {{ $year }}</title>
</head>

<body>
    @php
        $namaFile = 'example.php';
    @endphp
    <div class="container-fluid my-3">
        <div class="card mw-100">
            <p class="card-header">Venturo - Laporan penjualan tahunan per menu</p>
            <div class="card-body mw-100">
                <form action="/intermediate/" class="mw-100" method="get">
                    <div class="d-flex gap-3 ">
                        <div class="choose-menu w-25">
                            <select class="form-select" aria-label="Default select example" name="year">
                                <option {{ $year == '' ? 'selected' : '' }} value="">Pilih Tahun</option>
                                <option {{ $year == '2021' ? 'selected' : '' }} value="2021">2021</option>
                                <option {{ $year == '2022' ? 'selected' : '' }} value="2022">2022</option>
                            </select>
                        </div>
                        <div class="button-submit">
                            <button type="submit"
                                class="bg-primary px-4 py-2 text-light fw-bold border-0 rounded">Tampilkan</button>
                        </div>
                        <div class="button-menu">
                            <button type="button" class="bg-secondary px-4 py-2 fw-bold border-0 rounded"><a
                                    href="/intermediate/menu" target="_blank"
                                    class=" text-light text-decoration-none">JSON
                                    Menu</a></button>
                        </div>
                        <div class="button-transaksi">
                            <button type="button" class="bg-secondary px-4 py-2 fw-bold border-0 rounded"><a
                                    href="/intermediate/transaksi/{{ $year }}" target="_blank"
                                    class=" text-light text-decoration-none">JSON Transaksi</a></button>
                        </div>
                        <div class="button-download">
                            <button type="button" class="bg-secondary px-4 py-2 fw-bold border-0 rounded"><a
                                    href="/intermediate/download/{{ $namaFile }}"
                                    class=" text-light text-decoration-none">Download
                                    Example</a></button>
                        </div>
                    </div>
                </form>
                <div class="table my-3" style="font-size: 12px">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-dark">
                                <th rowspan="2" style="text-align:center;vertical-align: middle;width: 250px">Menu
                                </th>
                                <th colspan="12" style="text-align: center;">Periode Pada {{ $year }}
                                </th>
                                <th rowspan="2" style="text-align:center;vertical-align: middle;width:75px">Total
                                </th>
                            </tr>
                            <tr class="table-dark">
                                <th style="text-align: center;width: 75px;">Jan</th>
                                <th style="text-align: center;width: 75px;">Feb</th>
                                <th style="text-align: center;width: 75px;">Mar</th>
                                <th style="text-align: center;width: 75px;">Apr</th>
                                <th style="text-align: center;width: 75px;">Mei</th>
                                <th style="text-align: center;width: 75px;">Jun</th>
                                <th style="text-align: center;width: 75px;">Jul</th>
                                <th style="text-align: center;width: 75px;">Ags</th>
                                <th style="text-align: center;width: 75px;">Sep</th>
                                <th style="text-align: center;width: 75px;">Okt</th>
                                <th style="text-align: center;width: 75px;">Nov</th>
                                <th style="text-align: center;width: 75px;">Des</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-secondary" colspan="14"><b>Makanan</b></td>
                            </tr>
                            @foreach ($menus as $menu)
                                <tr>
                                    @if ($menu['kategori'] == 'makanan')
                                        <td>{{ $menu['menu'] }}</td>
                                    @endif
                                    @php
                                        $totalByMenu = 0;
                                    @endphp
                                    @if ($menu['kategori'] == 'makanan')
                                        @foreach ($months as $month)
                                            @php
                                                $totalByMenuAndMonth = 0;
                                            @endphp
                                            @foreach ($transaksis as $transaksi)
                                                @php
                                                    $tanggalParts = explode('-', $transaksi['tanggal']);
                                                    $transaksiMonth = $tanggalParts[1];
                                                    $transaksiMenu = $transaksi['menu'];
                                                    $transaksiTotal = $transaksi['total'];
                                                @endphp
                                                @if ($transaksiMonth == $month && $transaksiMenu == $menu['menu'])
                                                    @php
                                                        $totalByMenuAndMonth += $transaksiTotal;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $totalByMenu += $totalByMenuAndMonth;
                                            @endphp
                                            @if ($totalByMenuAndMonth != 0)
                                                <td class="text-end">{{ number_format($totalByMenuAndMonth) }}</td>
                                            @else
                                                <td> </td>
                                            @endif
                                        @endforeach
                                        <td class="fw-bold text-end">
                                            {{ number_format($totalByMenu) }}
                                        </td>
                                    @endif

                                </tr>
                            @endforeach

                            <tr>
                                <td class="table-secondary" colspan="14"><b>Minuman</b></td>
                            </tr>
                            @foreach ($menus as $menu)
                                <tr>
                                    @if ($menu['kategori'] == 'minuman')
                                        <td>{{ $menu['menu'] }}</td>
                                    @endif
                                    @php
                                        $totalByMenu = 0;
                                    @endphp
                                    @if ($menu['kategori'] == 'minuman')
                                        @foreach ($months as $month)
                                            @php
                                                $totalByMenuAndMonth = 0;
                                            @endphp
                                            @foreach ($transaksis as $transaksi)
                                                @php
                                                    $tanggalParts = explode('-', $transaksi['tanggal']);
                                                    $transaksiMonth = $tanggalParts[1];
                                                    $transaksiMenu = $transaksi['menu'];
                                                    $transaksiTotal = $transaksi['total'];
                                                @endphp
                                                @if ($transaksiMonth == $month && $transaksiMenu == $menu['menu'])
                                                    @php
                                                        $totalByMenuAndMonth += $transaksiTotal;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $totalByMenu += $totalByMenuAndMonth;
                                            @endphp
                                            @if ($totalByMenuAndMonth != 0)
                                                <td class="text-end">{{ number_format($totalByMenuAndMonth) }}</td>
                                            @else
                                                <td> </td>
                                            @endif
                                        @endforeach
                                        <td class="fw-bold text-end">
                                            {{ number_format($totalByMenu) }}
                                        </td>
                                    @endif

                                </tr>
                            @endforeach

                            <tr class="table-dark">
                                <td><b>Total</b></td>
                                @php
                                    $totalByMenu = 0;
                                @endphp
                                @foreach ($months as $month)
                                    @php
                                        $totalByMonth = 0;
                                    @endphp
                                    @foreach ($transaksis as $transaksi)
                                        @php
                                            $tanggalParts = explode('-', $transaksi['tanggal']);
                                            $transaksiMonth = $tanggalParts[1];
                                            $transaksiTotal = $transaksi['total'];
                                        @endphp
                                        @if ($transaksiMonth == $month)
                                            @php
                                                $totalByMonth += $transaksiTotal;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @php
                                        $totalByMenu += $totalByMonth;
                                    @endphp
                                    @if ($totalByMonth != 0)
                                        <td class="fw-bold text-end">{{ number_format($totalByMonth) }}</td>                                        
                                    @else
                                    <td class="fw-bold text-end"> </td>
                                    @endif
                                @endforeach
                                <td style="text-align: right;"><b>{{ number_format($totalByMenu) }}</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
