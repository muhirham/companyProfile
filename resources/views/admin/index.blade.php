@extends('layouts.admin')

@section('content')
  <div class="section-header">
    <h1>Dashboard</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
    </div>
  </div>

  {{-- STAT CARDS --}}
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">
        <div class="card-icon shadow-primary bg-primary">
          <i class="fas fa-box"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Produk Genset</h4>
          </div>
          <div class="card-body">
            {{ $totalProducts ?? 0 }}
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">
        <div class="card-icon shadow-primary bg-info">
          <i class="fas fa-newspaper"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Berita / Blog</h4>
          </div>
          <div class="card-body">
            {{ $totalPosts ?? 0 }}
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">
        <div class="card-icon shadow-primary bg-success">
          <i class="fas fa-envelope"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Pesan Kontak</h4>
          </div>
          <div class="card-body">
            {{ $totalMessages ?? 0 }}
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- LATEST POSTS & MESSAGES --}}
  <div class="row">
    {{-- BERITA TERBARU --}}
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <h4>Berita Terbaru</h4>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-striped mb-0">
              <thead>
                <tr>
                  <th>Judul</th>
                  <th>Slug</th>
                  <th>Status</th>
                  <th>Tanggal Publish</th>
                </tr>
              </thead>
              <tbody>
                @forelse($latestPosts ?? [] as $post)
                  <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->slug }}</td>
                    <td>
                      @if($post->status === 'published')
                        <div class="badge badge-success">Published</div>
                      @else
                        <div class="badge badge-secondary">Draft</div>
                      @endif
                    </td>
                    <td>
                      @if($post->status === 'published')
                        {{ $post->created_at?->format('d M Y') ?? '-' }}
                      @else
                        -
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="text-center">Belum ada data berita.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    {{-- PESAN KONTAK TERBARU --}}
    <div class="col-lg-4">
      <div class="card card-hero">
        <div class="card-header">
          <div class="card-icon">
            <i class="far fa-envelope"></i>
          </div>
          <h4>{{ $unreadMessagesCount ?? 0 }}</h4>
          <div class="card-description">Pesan belum dibaca</div>
        </div>
        <div class="card-body p-0">
          <div class="tickets-list">
            @forelse($latestMessages ?? [] as $msg)
              <a href="#" class="ticket-item">
                <div class="ticket-title">
                  <h4>{{ $msg->subject ?? '(Tanpa Subjek)' }}</h4>
                </div>
                <div class="ticket-info">
                  <div>{{ $msg->name }}</div>
                  <div class="bullet"></div>
                  <div class="text-primary">
                    {{ $msg->created_at?->diffForHumans() }}
                  </div>
                </div>
              </a>
            @empty
              <div class="p-3 text-center">
                Belum ada pesan masuk.
              </div>
            @endforelse

            <a href="{{ route('admin.messages.index') }}" class="ticket-item ticket-more">
              Lihat semua pesan <i class="fas fa-chevron-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
