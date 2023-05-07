@extends('admin::inc/header')
@section('title', 'Add product')
@include('admin::inc/generalErrors')

@section('content')
<div class='details-bar'><!--details-bar-->
	<div class='details-left'>
		<h2>Adaugă produs</h2>
	</div>
	<div class='details-center'>
		<ul class='details-nav nav-tabs'>
			<li class='detail-selected'>
				<a href="" data-target="detalii">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.1 16">
						<path id="Text-2" data-name="Text" d="M5.2,2H11a.75.75,0,0,1,.53.22l4.35,4.35a.75.75,0,0,1,.22.53v8.7A2.222,2.222,0,0,1,13.9,18H5.2A2.222,2.222,0,0,1,3,15.8V4.2A2.222,2.222,0,0,1,5.2,2Zm0,1.5a.721.721,0,0,0-.7.7V15.8a.721.721,0,0,0,.7.7h8.7a.721.721,0,0,0,.7-.7V7.85H11a.75.75,0,0,1-.75-.75V3.5Zm6.55,1.061L13.539,6.35H11.75ZM5.9,7.825a.75.75,0,0,1,.75-.75H8.1a.75.75,0,0,1,0,1.5H6.65A.75.75,0,0,1,5.9,7.825Zm.75,2.15a.75.75,0,1,0,0,1.5h5.8a.75.75,0,1,0,0-1.5Zm0,2.9a.75.75,0,0,0,0,1.5h5.8a.75.75,0,0,0,0-1.5Z" transform="translate(-3 -2)" fill="#6C7A87" fill-rule="evenodd"/>
					</svg> 
					Detalii
				</a>
			</li>
		</ul>	
	</div>
	<div class='details-right'>
		<a class='general-btn backBtn' href="/admin/products">Înapoi</a>	
	</div>
</div><!--details-bar-->

<div class="content-container">
    <div class="cms-body">
	<form method="POST" action='/admin/products/'>
		@csrf
		
		<div class='flex-inputs flex100'>
			<div class="input-element">
				<label for="name">Product name</label>
				<input class='builNiceUrl' data-target='url' type="text" name="name" id='name' value="">
			</div>
			<div class="input-element">
				<label for="url">Product url</label>
				<input type="text" name="url" id='url' value="">
			</div>
			<div class="input-element">
				<label for="product_type">Tip produs</label>
				<select name='product_type' id='product_type' value=''>
					<option value="">Alege tipul</option>
					<option value="simple">Produs Masara</option>
					<option value="designer">Produs Designer</option>
				</select>
			</div>
			<div class="input-element">
				<label for="designer_id">Designer</label>
				<select name='designer_id' id='designer_id' value=''>
					<option value="0">Alege designer</option>
					<option value="1">Fără designer</option>
					<option value="2">Designer 1</option>
					<option value="2">Designer 2</option>
					<option value="2">Designer 3</option>
					<option value="2">Designer 4</option>
				</select>
			</div>
			<div class="input-element">
				<label for="sku">SKU</label>
				<input type="text" name="sku" id='sku' value="">
			</div>
			<div class="input-element">
				<label for="stock">Stoc</label>
				<input type="text" name="stock" id='stock' value="">
			</div>
			
			<div class="input-element">
				<label for="price_estimate">Preț estimat de designer/Masara</label>
				<input type="text" name="price_estimate" id='price_estimate' value="">
			</div>
			<div class="input-element">
				<label for="price">Prețul de vânzare</label>
				<input type="text" name="price" id='price' value="">
			</div>
			<div class="input-element textarea">
				<label for="description">Descriere produs</label>
				<textarea name="description" id="description" value=''></textarea>
			</div>
			
			<div class="input-element checkbox-input">
				<label for="rand_3d">Are randare 3d?</label>
				<input type="checkbox" name="rand_3d" id='rand_3d' value="1">
				<div class='fakecheck'></div>
			</div>
			<div class="input-element checkbox-input">
				<label for="favourite_product">Este setat ca si produs favorit?</label>
				<input type="checkbox" name="favourite_product" id='favourite_product' value="1">
				<div class='fakecheck'></div>
			</div>
			<div class="input-element">
				<label for="product_status">Status produs</label>
				<select name='product_status' id='product_status' value="">
					<option value="published">Publicat</option>
					<option value="hidden">Ascuns</option>
					<option value="pending">În așteptare</option>
				</select>
			</div>
		</div>
		<input class="general-btn" type="submit" value="Adaugă produs nou">
	</form>
	</div>
</div>


@endsection
