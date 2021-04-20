@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
      <h3>Urls Cadastradas</h3>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-inverse">
                    <tr>
                    <th>ID</th>
                    <th>Url</th>
                    <th>ShortUrl</th>
                    <th>Tempo de vida</th>
                    <th>Criado em</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($urls as $url)
                    <tr>
                        <td scope="row">{{$url->id }}</td>
                        <td>{{$url->url }}</td>
                        <td>{{$url->shortUrl }}</td>
                        @if(now()->diffInDays($url->lifeTime, false) > 0)
                        <td>{{now()->diffInDays($url->lifeTime, false)}} Dias</td>
                        @else
                        <td>Expirado</td>
                        @endif
                        <td>{{$url->created_at->format('d/m/Y')}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>           
            </div>
            {{$urls->links()}}
        </div>
    </div>
@endsection
@section('scripts')

@endsection
