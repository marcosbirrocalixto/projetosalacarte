@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>Detalhe:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $detail->name ?? old('name')}} ">
</div>
<div class="form-group">
<label>Descrição detalhada: ** até 6 imagens</label>
<textarea name="description" ols="30" rows="5" class="form-control">{{ $detail->description ?? old('description') }}</textarea>
</div>
<div class="form-group">
    <label>* Imagens:</label>
    <input type="file" name="images[]" multiple="multiple">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>
