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
    <title>Get Data Makanan</title>
</head>

<body>
    <div class="container-fluid my-5">
        <div class="card mw-100">
            <p class="card-header">Venturo - Laporan penjualan tahunan per menu</p>
            <div class="card-body mw-100">
                <form action="/intermediate/" class="mw-100" method="get" >
                    {{-- @csrf --}}
                    <div class="d-flex gap-3 ">
                        <div class="choose-menu w-25">
                            <select class="form-select" aria-label="Default select example" name="year">
                                <option {{ $year == '' ? "selected" : ""}} value="">Pilih Tahun</option>
                                <option {{ $year == '2021' ? "selected" : ""}} value="2021">2021</option>
                                <option {{ $year == '2022' ? "selected" : ""}} value="2022">2022</option>
                            </select>
                        </div>
                        <div class="button-submit">
                            <button type="submit" class="bg-primary px-4 py-2 text-light fw-bold border-0 rounded">Tampilkan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
