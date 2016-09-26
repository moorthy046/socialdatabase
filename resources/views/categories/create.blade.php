@extends('app')

@section('title')
Add New Category
@endsection

@section('content')

<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
	tinymce.init({
		selector : "textarea",
		plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages"],
		toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
	}); 
</script>

<form action="{{ url('/new-category') }}" method="post">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="form-group">
		<input required="required" value="{{ old('categoryName') }}" placeholder="Enter category name" type="text" name = "categoryName" class="form-control" />
	</div>
	<input type="submit" name='publish' class="btn btn-success" value = "Create"/>
</form>

<br />
<h2>Categories</h2>

<div>
	@foreach($categories as $category)
		{{$category->category_name}} <br />
	@endforeach
</div>

@endsection

