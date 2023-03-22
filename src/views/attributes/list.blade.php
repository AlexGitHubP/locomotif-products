@extends('admin::inc/header')
@section('title', 'Products Attributes list')

@section('content')
<div class="content-container">
	<div class="cms-body">
		<p>this is products attributes list</p>
		<a href="/admin/productsAttributes/create">Add new attribute</a>
		@foreach($productsAttributes as $productsAttribute)
			<p>Attribute: {{ $productsAttribute->attr_name }} <a href="/admin/productsAttributes/{{$productsAttribute->id}}/edit">Edit attribute</a> <form action="/admin/productsAttributes/{{ $productsAttribute->id }}" method="POST">@method('DELETE') @csrf <input type="submit" value="Delete attribute"/></form></p>
		@endforeach
    	</div>
</div>

@endsection

