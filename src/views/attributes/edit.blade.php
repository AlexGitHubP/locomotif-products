@extends('admin::inc/header')
@section('title', 'Edit product')

@section('content')
<div class="content-container">
    <div class="cms-body">
	<a class='backBtn' href="/admin/productsAttributes"><--- Înapoi</a>
    <h2>Edit product attribute: {{$productsAttributes->name}}</h2>
	<form method="POST" action='/admin/productsAttributes/{{$productsAttributes->id}}'>
		@csrf
		@method('PUT')
		<div class='flex-inputs flex25'>
			<div class="input-element">
				<label for="attr_name">Product attribute name</label>
				<input type="text" name="attr_name" id='attr_name' value="{{$productsAttributes->attr_name}}">
			</div>
			<div class="input-element">
				<label for="attr_identifier">Atribute identifier</label>
				<input type="text" name="attr_identifier" id='attr_identifier' value="{{$productsAttributes->attr_identifier}}">
			</div>
			
			<div class="input-element textarea">
				<label for="attr_descr">Descriere atribut</label>
				<textarea name="attr_descr" id="attr_descr" value='{{$productsAttributes->attr_descr}}'>{{$productsAttributes->attr_descr}}</textarea>
			</div>
			
			
			<div class="input-element">
				<label for="attr_status">Status atribut</label>
				<select name='attr_status' id='attr_status' value="{{$productsAttributes->attr_status}}">
					<option value="hidden">Ascuns</option>
					<option value="published">Publicat</option>
				</select>
			</div>
		</div>
		<input type="submit" value="Update">
	</form>
	</div>
</div>

@endsection
