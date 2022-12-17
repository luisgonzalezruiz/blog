<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Ingrese nombre de etiqueta']) !!}
    @error('name')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
   {!! Form::label('slug', 'Slug') !!}
   {!! Form::text('slug', null, ['class'=>'form-control','placeholder'=>'Ingrese nombre de slug','readonly']) !!}
   @error('slug')
        <span class="text-danger">{{$message}}</span>
   @enderror
</div>

<div class="form-group">

{{--   <label for="">Color:</label>
  <select name="color" id="color" class="form-control">
       <option value="red">Rojo</option>
       <option value="green">Verde</option>
       <option value="blue" selected>Azul</option>
  </select> --}}

  {!! Form::label('color', 'Color') !!}
  {!! Form::select('color', $colors, null, ['class'=>'form-control']) !!}
  @error('color')
     <span class="text-danger">{{$message}}</span>
  @enderror

</div>
