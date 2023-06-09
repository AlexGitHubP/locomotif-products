@extends('admin::inc/header')
@section('title', 'Edit product')
@include('admin::inc/generalErrors')

@section('content')
<div class='details-bar'><!--details-bar-->
	<div class='details-left'>
		<h2>Editare: {{ \Illuminate\Support\Str::limit($product->name, $limit = 15, $end = '...') }} </h2>
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
			<li>
				<a href="" data-target="categorii">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
						<path d="M9.665,2.079a.75.75,0,0,1,.671,0L17.585,5.7a.75.75,0,0,1,0,1.342l-7.25,3.625a.75.75,0,0,1-.671,0L2.415,7.046a.75.75,0,0,1,0-1.342Zm-5.238,4.3L10,9.161l5.573-2.786L10,3.589ZM2.079,13.29a.75.75,0,0,1,1.006-.335L10,16.412l6.915-3.457a.75.75,0,0,1,.671,1.342l-7.25,3.625a.75.75,0,0,1-.671,0L2.415,14.3A.75.75,0,0,1,2.079,13.29Zm1.006-3.96a.75.75,0,0,0-.671,1.342L9.665,14.3a.75.75,0,0,0,.671,0l7.25-3.625a.75.75,0,0,0-.671-1.342L10,12.787Z" transform="translate(-2 -2)" fill="#6C7A87" fill-rule="evenodd"/>
					  </svg>											
					Categorii
				</a>
			</li>
			<li>
				<a href="" data-target="componente">
					<svg id="Settings" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
						<path id="Settings-2" data-name="Settings" d="M2.309,6.772A2.1,2.1,0,0,0,3.125,9.7l.174.1c0,.069,0,.139-.005.205s0,.136.005.205l-.174.1a2.1,2.1,0,0,0-.816,2.928l.984,1.616a2.132,2.132,0,0,0,2.848.732l.158-.087c.2.128.4.247.612.357v.03A2.114,2.114,0,0,0,9.016,18h1.968a2.114,2.114,0,0,0,2.1-2.124v-.03c.21-.11.415-.229.612-.357l.158.087a2.132,2.132,0,0,0,2.848-.732l.984-1.616a2.1,2.1,0,0,0-.816-2.928l-.174-.1c0-.069,0-.139.005-.205s0-.136-.005-.205l.174-.1a2.1,2.1,0,0,0,.816-2.928l-.984-1.616a2.133,2.133,0,0,0-2.848-.732l-.158.087c-.2-.128-.4-.247-.612-.357v-.03A2.114,2.114,0,0,0,10.984,2H9.016a2.114,2.114,0,0,0-2.1,2.124v.03c-.21.11-.415.229-.612.357l-.158-.087a2.133,2.133,0,0,0-2.848.732Zm4.155-.144L5.29,5.984a.359.359,0,0,0-.48.1L3.826,7.7a.322.322,0,0,0,.151.443l1.241.679a4.8,4.8,0,0,0,0,2.363l-1.241.679a.322.322,0,0,0-.151.443l.984,1.616a.359.359,0,0,0,.48.1l1.174-.644a4.945,4.945,0,0,0,2.224,1.294v1.21a.337.337,0,0,0,.328.346h1.968a.337.337,0,0,0,.328-.346v-1.21a4.945,4.945,0,0,0,2.224-1.294l1.174.644a.359.359,0,0,0,.48-.1l.984-1.616a.322.322,0,0,0-.151-.443l-1.241-.679a4.8,4.8,0,0,0,0-2.363l1.241-.679a.322.322,0,0,0,.151-.443L15.19,6.081a.359.359,0,0,0-.48-.1l-1.174.644a4.935,4.935,0,0,0-2.224-1.293V4.124a.337.337,0,0,0-.328-.346H9.016a.337.337,0,0,0-.328.346V5.334A4.936,4.936,0,0,0,6.464,6.628ZM10,12.667A2.667,2.667,0,1,0,7.333,10,2.665,2.665,0,0,0,10,12.667ZM11,10a1,1,0,1,1-1-1A1,1,0,0,1,11,10Z" transform="translate(-2 -2)" fill="#6C7A87" fill-rule="evenodd"/>
					  </svg>					  
					Componente
				</a>
			</li>
			<li>
				<a href="" data-target="zone">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
						<path id="Copy" d="M3.705,3.705A.7.7,0,0,1,4.2,3.5h6.525a.7.7,0,0,1,.7.7v.725a.75.75,0,0,0,1.5,0V4.2a2.2,2.2,0,0,0-2.2-2.2H4.2A2.2,2.2,0,0,0,2,4.2v6.525a2.2,2.2,0,0,0,2.2,2.2h.725a.75.75,0,0,0,0-1.5H4.2a.7.7,0,0,1-.7-.7V4.2A.7.7,0,0,1,3.705,3.705Zm4.87,5.57a.7.7,0,0,1,.7-.7H15.8a.7.7,0,0,1,.7.7V15.8a.7.7,0,0,1-.7.7H9.275a.7.7,0,0,1-.7-.7Zm.7-2.2a2.2,2.2,0,0,0-2.2,2.2V15.8a2.2,2.2,0,0,0,2.2,2.2H15.8A2.2,2.2,0,0,0,18,15.8V9.275a2.2,2.2,0,0,0-2.2-2.2Z" transform="translate(-2 -2)" fill="#6C7A87" fill-rule="evenodd"/>
					</svg>									
					Zone produs
				</a>
			</li>
			<li>
				<a href="" data-target="imagini">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
						<path id="Image" d="M4.361,3.5a.861.861,0,0,0-.861.861V15.639a.861.861,0,0,0,.593.818l8.6-8.6a.75.75,0,0,1,1.061,0L16.5,10.606V4.361a.861.861,0,0,0-.861-.861ZM16.5,12.727,13.222,9.45,6.172,16.5h9.467a.861.861,0,0,0,.861-.861ZM2,4.361A2.361,2.361,0,0,1,4.361,2H15.639A2.361,2.361,0,0,1,18,4.361V15.639A2.361,2.361,0,0,1,15.639,18H4.361A2.361,2.361,0,0,1,2,15.639ZM7.181,6.722a.458.458,0,1,0,.458.458A.458.458,0,0,0,7.181,6.722Zm-1.958.458A1.958,1.958,0,1,1,7.181,9.139,1.958,1.958,0,0,1,5.222,7.181Z" transform="translate(-2 -2)" fill="#6C7A87" fill-rule="evenodd"/>
					</svg>					  
					Imagini
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
		<div class="tab-content">
			<div class="tab-pane active" id="detalii">
				<form method="POST" action='/admin/products/{{$product->id}}'>
					@csrf
					@method('PUT')
					<div class='flex-inputs flex100'>
						<div class="input-element">
							<label for="name">Product name</label>
							<input type="text" name="name" id='name' value="{{$product->name}}">
						</div>
						<div class="input-element">
							<label for="url">Product url</label>
							<input type="text" name="url" id='url' value="{{$product->url}}">
						</div>
						<div class="input-element">
							<label for="designer_id">Designer</label>
							<select name='designer_id' id='designer_id' value='{{$product->designer_id}}'>
								<option value="0">Alege designer</option>
								<option value="1">Masara</option>
								<option value="2">Alt designer</option>
							</select>
						</div>
						<div class="input-element">
							<label for="product_type">Tip produs</label>
							<select name='product_type' id='product_type' value='{{$product->product_type}}'>
								<option value="">Alege tipul</option>
								<option value="designer">Designer</option>
								<option value="simple">Simplu/de sine statator</option>
							</select>
						</div>
						<div class="input-element">
							<label for="sku">SKU</label>
							<input type="text" name="sku" id='sku' value="{{$product->sku}}">
						</div>
						<div class="input-element">
							<label for="stock">Stoc</label>
							<input type="text" name="stock" id='stock' value="{{$product->stock}}">
						</div>
						<div class="input-element">
							<label for="price">Preț</label>
							<input type="text" name="price" id='price' value="{{$product->price}}">
						</div>
						<div class="input-element">
							<label for="price_estimate">Preț estimat de designer</label>
							<input type="text" name="price_estimate" id='price_estimate' value="{{$product->price_estimate}}">
						</div>
						<div class="input-element textarea">
							<label for="description">Descriere produs</label>
							<textarea name="description" id="description" value='{{$product->description}}'>{{$product->description}}</textarea>
						</div>
						<div class="input-element checkbox-input">
							<label for="rand_3d">Are randare 3d?</label>
							<input type="checkbox" name="rand_3d" id='rand_3d' {{$product->rand_3d==1 ? 'checked' : ''}} value="">
							<div class='fakecheck'></div>
						</div>
						<div class="input-element checkbox-input">
							<label for="favourite_product">Este setat ca si produs favorit?</label>
							<input type="checkbox" name="favourite_product" id='favourite_product' {{$product->favourite_product==1 ? 'checked' : ''}} value="">
							<div class='fakecheck'></div>
						</div>
						<div class="input-element">
							<label for="product_status">Status</label>
							<select name='product_status' id='product_status' value="{{$product->product_status}}">
								<option value="">Alege status</option>
								<option value="published" {{$product->product_status=='published' ? 'selected' : '' }}>Publicat</option>
								<option value="hidden"    {{$product->product_status=='hidden' ? 'selected' : '' }}>Ascuns</option>
								<option value="pending"   {{$product->product_status=='pending' ? 'selected' : '' }}>În așteptare</option>
							</select>
						</div>
					</div>
					<input class='general-btn' type="submit" value="Update">
				</form>	
			</div>		
			<div class="tab-pane" id="categorii">
				{!! $associatedCategories !!}
			</div>		
			<div class="tab-pane" id="componente">
				{!! $associatedAttributes !!}
				{!! $buildAttributes !!}
			</div>

			<div class="tab-pane" id="zone">
				{!! $associatedAreas !!}
			</div>
			
			<div class="tab-pane" id="imagini">
				<h2>Imagini:</h2>
				{!! $associatedMedia !!}
			</div>
			
		</div><!--tab-content-->
    </div><!--cms-body-->
</div>

@endsection
