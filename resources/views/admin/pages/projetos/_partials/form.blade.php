@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>* Projeto:</label>
    <input type="text" name="name" class="form-control" placeholder="Projeto:" value="{{ $projeto->name ?? old('name') }}">
</div>
<div class="form-group">
    <label>* Orçamento: Formato: 9999,99</label>
    <input type="text" name="orcamento" class="form-control" placeholder="Orçamento:" value="{{ number_format($projeto->orcamento, 2, ',', '') ?? old('orcamento') }}">
</div>
<div class="form-group">
    <label>* Descrição:</label>
    <textarea name="description" ols="30" rows="5" class="form-control">{{ $projeto->description ?? old('description') }}</textarea>
</div>
<div class="form-group">
    <label>* Imagem:</label>
    <input type="file" name="image" class="form-control">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>
