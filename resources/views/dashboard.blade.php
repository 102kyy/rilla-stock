@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row align-items-center mb-4">
            <div class="col">
                <h1 class="page-title" style="color: #6d4c41;">Selamat Datang, {{ Auth::user()->name }}! ✨</h1>
                <div class="text-muted small mt-1">Status login: <strong>{{ Auth::user()->role }}</strong> | Kelola stok Macramé jadi lebih mudah.</div>
            </div>
        </div>

        <div class="row row-cards mb-3">
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm" style="border-radius: 12px; border: none; box-shadow: 0 4px 12px rgba(186, 151, 120, 0.15);">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar" style="background-color: #ba9778; color: white;"><i class="ti ti-package"></i></span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">Total Produk</div>
                                <div class="h3 mb-0">{{ $totalProduk }} Jenis</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm" style="border-radius: 12px; border: none; box-shadow: 0 4px 12px rgba(186, 151, 120, 0.15);">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar" style="background-color: #8d6e63; color: white;"><i class="ti ti-box"></i></span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">Stok Tersedia</div>
                                <div class="h3 mb-0">{{ $totalStok }} Pcs</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm" style="border-radius: 12px; border: none; box-shadow: 0 4px 12px rgba(186, 151, 120, 0.15);">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar" style="background-color: #d7ccc8; color: #5d4037;"><i class="ti ti-category"></i></span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">Kategori</div>
                                <div class="h3 mb-0">{{ $totalKategori }} Grup</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm" style="border-radius: 12px; border: none; box-shadow: 0 4px 12px rgba(186, 151, 120, 0.15);">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar" style="background-color: #a1887f; color: white;"><i class="ti ti-coin"></i></span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">Estimasi Nilai</div>
                                <div class="h3 mb-0">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cards">
                        <div class="col-lg-5">
                <div class="card" style="border-radius: 15px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.05); min-height: 460px;">
                    <div class="card-header" style="background-color: #fffaf5;">
                        <h3 class="card-title" style="color: #6d4c41;">Produk Terkini 🧶</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-center">Stok</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($produkTerbaru as $p)
                                <tr>
                                    <td class="fw-bold small">{{ $p->nama_produk }}</td>
                                    <td class="text-center small">{{ $p->stok_akhir }}</td>
                                    <td class="text-center">
                                        <span class="badge {{ $p->stok_akhir <= 5 ? 'bg-danger' : 'bg-success' }}">
                                            {{ $p->stok_akhir <= 5 ? 'Kritis' : 'Aman' }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="text-center py-4 text-muted small">Belum ada data.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-end mt-auto">
                        <a href="{{ route('produk.index') }}" class="btn btn-link btn-sm" style="color: #ba9778;">Lihat Semua →</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card" style="border-radius: 15px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.05); min-height: 460px;">
                    <div class="card-header" style="background-color: #fffaf5;">
                        <h3 class="card-title" style="color: #6d4c41;">Komposisi Kategori 📊</h3>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div id="chart-kategori" style="min-height: 280px;"></div>
                    </div>
                </div>
            </div>



            <div class="col-lg-3">
                <div class="card" style="border-radius: 15px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.05); background-color: #6d4c41; color: white; min-height: 460px;">
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title text-white">Info Urgent 📝</h3>
                        
                        <div class="overflow-auto" style="max-height: 320px;">
                            @php
                                $stokKritis = $produkTerbaru->where('stok_akhir', '<=', 5);
                            @endphp

                            @if($stokKritis->count() > 0)
                                <div class="alert alert-important bg-danger border-0 mb-3" style="border-radius: 10px;">
                                    <div class="small fw-bold mb-1">⚠️ PERLU RESTOK:</div>
                                    <ul class="ps-3 mb-0 small">
                                        @foreach($stokKritis as $sk)
                                            <li>{{ $sk->nama_produk }} (Sisa {{ $sk->stok_akhir }})</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="p-3 mb-2" style="background: rgba(255,255,255,0.1); border-radius: 10px;">
                                <p class="small mb-0">💡 <b>Tips:</b> Jangan lupa cek kualitas tali katun sebelum produksi ya!</p>
                            </div>
                        </div>

                        <div class="mt-auto pt-3 border-top border-white-subtle">
                            <div class="d-flex align-items-center small text-white-50">
                                <i class="ti ti-calendar me-2"></i> <span>{{ date('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var options = {
            chart: { type: 'donut', height: 300, width: '100%' },
            series: {!! json_encode($chartValues) !!},
            labels: {!! json_encode($chartLabels) !!},
            colors: ['#ba9778', '#8d6e63', '#d7ccc8', '#a1887f', '#5d4037'],
            legend: { position: 'bottom', fontSize: '12px' },
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%',
                        labels: {
                            show: true,
                            total: { show: true, label: 'Kategori', color: '#6d4c41' }
                        }
                    }
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#chart-kategori"), options);
        chart.render();
    });
</script>
@endpush
@endsection