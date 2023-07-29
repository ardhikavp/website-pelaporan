@extends('layouts.app')

@section('content')
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Laporan Safety Observation</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h2 class="card-title">Laporan Safety Observation</h2>
                                <button onclick="toggle(this);">Inputan sementara</button>
                            </div>
                            <div class="col-md-2 text-right">
                                <a href="{{ route('safety-observation-forms.create') }}" class="btn btn-primary">
                                Lapor Temuan Baru</a>
                            </div>
                        </div>
                        @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                    </div>
                    <div class="card-body">

                        @include('safety-observation-forms.safety-observation-form-pending-review')
                        @include('safety-observation-forms.safety-observation-form-pending-approve')
                        @include('safety-observation-forms.safety-observation-form-approved')
                        @include('safety-observation-forms.safety-observation-form-rejected')

                    </div>
                </div>
            </div>
        </div>
    </div>

    @pushOnce('body-scripts')
    <script>
        let toggle = button => {
          let element = document.getElementById("mytable");
          let hidden = element.getAttribute("hidden");

          if (hidden) {
             element.removeAttribute("hidden");
             button.innerText = "Sembunyikan";
          } else {
             element.setAttribute("hidden", "hidden");
             button.innerText = "Tampilkan Data";
          }
        }
    </script>
    <script>
        let toggle = () => {
           let element = document.getElementById('mydiv');
           element.toggleAttribute('hidden');
        }
    </script>
    @endPushOnce
@endsection
