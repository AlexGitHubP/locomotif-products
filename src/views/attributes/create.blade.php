@extends('admin::inc/header')
@section('title', 'Add product')
@include('admin::inc/generalErrors')

@section('content')
<div class="content-container">
    <div class="cms-body">
	<a class='backBtn' href="/admin/productsAttributes"><--- Înapoi</a>
    <h2>Add Product attribute</h2>
	<form method="POST" action='/admin/productsAttributes/'>
		@csrf
		
		<div class='flex-inputs flex25'>
			<div class="input-element">
				<label for="attr_name">Atribute name</label>
				<input type="text" name="attr_name" id='attr_name' value="">
			</div>
			<div class="input-element">
				<label for="attr_identifier">Atribute identifier</label>
				<input type="text" name="attr_identifier" id='attr_identifier' value="">
			</div>
			
			<div class="input-element textarea">
				<label for="attr_descr">Descriere atribut</label>
				<textarea name="attr_descr" id="attr_descr" value=''></textarea>
			</div>
			
			<div class="input-element">
				<label for="attr_status">Status atribut</label>
				<select name='attr_status' id='attr_status' value="">
					<option value="hidden">Ascuns</option>
					<option value="published">Publicat</option>
				</select>
			</div>
		</div>
		<input type="submit" value="Adaugă atribut nou">
	</form>
	</div>
</div>


@endsection
