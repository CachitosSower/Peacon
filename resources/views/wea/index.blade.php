@extends('layouts.app')

@section('content')

    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
    @endif

{{Form::open(['url' => 'zxasqw/store'])}}

{{ Form::label('item', 'Item') }}
{{ Form::text('item', '', ['class' => 'form-control', 'placeholder' => 'Eetem']) }}

{{ Form::label('precio_clp', 'Precio CLP') }}
{{ Form::text('precio_clp', '', ['class' => 'form-control', 'placeholder' => 'Precio']) }}

{{ Form::label('precio_uf_form', 'Precio UF') }}
{{ Form::text('precio_uf_form', $uf, ['class' => 'form-control', 'disabled']) }}
{{ Form::hidden('uf', $uf) }}
<br>
{{ Form::submit('Seivu', ['class' => 'btn btn-primary']) }}

{{ Form::close() }}

    </div>

    @endsection