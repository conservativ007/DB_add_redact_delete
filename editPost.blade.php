<!-- редактирование -->
<form method="post">
  {{ csrf_field() }}
  <input type="text" name="title" value="{{$post->title}}">
  <input type="text" name="description" value="{{$post->description}}">
  <input type="text" name="date" value="{{$post->date}}">
  <textarea name="text" rows="4" cols="20">{{$post->text}}</textarea>
  <input type="submit" name="submit">
</form>
