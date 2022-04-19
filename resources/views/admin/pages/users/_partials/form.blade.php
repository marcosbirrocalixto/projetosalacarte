@include('admin.includes.alerts')

@csrf

@if ($user->id ?? '')
<div class="form-group">
    <label for="tipouser_id">Tipo usuário</label>
    <select class="form-control" name="tipouser_id">
        @foreach ( $tipousers as $tipouser )
            @if ($user->tipouser_id == $tipouser->id )
                <option selected value="{{ $tipouser->id }}">{{ $tipouser->description }}</option>
            @else
                <option value="{{ $tipouser->id }}">{{ $tipouser->description }}</option>
            @endif
        @endforeach
    </select>
</div>
@else
<div class="form-group">
    <label for="tipouser_id">Tipo usuário</label>
    <select class="form-control" name="tipouser_id">
        @foreach ( $tipousers as $tipouser )
            <option value="{{ $tipouser->id }}">{{ $tipouser->description }}</option>
        @endforeach
    </select>
</div>

@endif
<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $user->name ?? old('name')}} ">
</div>
<div class="form-group">
    <label>E-mail:</label>
    <input type="email" name="email" class="form-control" placeholder="E-mail" value="{{ $user->email ?? old('email')}} ">
</div>
<div class="form-group">
    <label>* Imagem:</label>
    <input type="file" name="image" class="form-control">
</div>
<div class="form-group">
    <label>Endereço:</label>
    <input type="text" name="endereco" class="form-control" placeholder="Endereço" value="{{ $user->endereco ?? old('endereco')}} ">
</div>
<div class="form-group">
    <label>Número:</label>
    <input type="text" name="numero" class="form-control" placeholder="Número" value="{{ $user->numero ?? old('numero')}} ">
</div>
<div class="form-group">
    <label>Bairro:</label>
    <input type="text" name="bairro" class="form-control" placeholder="Bairro" value="{{ $user->bairro ?? old('bairro')}} ">
</div>
<div class="form-group">
    <label>Cidade:</label>
    <input type="text" name="cidade" class="form-control" placeholder="Cidade" value="{{ $user->cidade ?? old('cidade')}} ">
</div>
<div class="form-group">
    <label>CEP:</label>
    <input type="text" name="cep" class="form-control" placeholder="CEP" value="{{ $user->cep ?? old('cep')}} ">
</div>
<div class="form-group">
    <label>Celular:</label>
    <input type="text" name="celular" class="form-control" placeholder="Celular" value="{{ $user->celular ?? old('celular')}} ">
</div>
<div class="form-group">
    <label>Senha:</label>
    <input type="password" name="password" class="form-control" placeholder="Senha">
</div>
<div class="form-group">
    <label>Senha:</label>
    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar Senha">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>
