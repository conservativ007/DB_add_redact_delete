<!-- все статьи -->

<p>{{$status}}</p>
<p>{{$id}}</p>
<p>{{$title}}</p>
<table>
  @foreach($posts as $post)
  <tr>
    <td>{{$post->id}}</td>
    <td>
      <a href="/post/{{$post->id}}">{{$post->title}}</a>
    </td>
    <td>{{$post->description}}</td>
    <td>
      <a href="/post/edit/{{$post->id}}">red</a>
    </td>
    <td>
      <a href="/post/del/{{$post->id}}">del</a>
    </td>
  </tr>
  @endforeach
</table>
