<form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
	Select file to upload:
	{{ csrf_field() }}
	<input type="file" name="file" id="file">
	<input type="submit" value="Upload File" name="submit">
</form>

<form action="{{ route('export') }}" method="post">
	{{ csrf_field() }}
	<button type="submit">Eksport</button>
</form>
