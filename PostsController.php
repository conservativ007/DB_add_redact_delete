<?php
  namespace App\Http\Controllers;
  use App\Http\Controllers\Controller;
  use Illuminate\Http\Request;
  use App\Post;
  use Session;

// Сделайте контроллер PostController для работы со статьями.
  class PostsController extends Controller{

// В контроллере PostController сделайте действие getAll для получения списка всех статей. Пусть это действие будет доступно по адресу /post/all/.
// Отредактируйте маршрут действия getAll так, чтобы вместо адреса /post/all/ нашей действие стало доступно по адресу /post/all/:order/, где :order представляет собой имя поля, по которому выполнять сортировку.

//Сделайте так, чтобы сортировать можно было по полям id, title и date. Причем сортировка должна быть по убыванию значения поля.

//Сделайте так, чтобы параметр :order был не обязательным и по умолчанию имел значение date.

// Отредактируйте маршрут действия getAll так, чтобы появился еще один параметр :dir, представляющий собой направление сортировки (по убыванию или по возрастанию). То есть наш маршрут станет выглядеть так: /post/all/:order/:dir.

//Пусть параметр :dir может иметь только два значения: asc или desc. При этом пусть наш параметр также является не обязательным и по умолчанию имеет значение desc.
    public function getAll($order = 'date', $dir = 'desc'){
      $posts = Post::orderBy($order, $dir)->get();

      return view('post.posts', [
        'posts'  => $posts,
        'status' => session('status'),
        'id' => session('id'),
        'title' => session('title'),
      ]);
    }

// В действии getOne из таблицы posts получите статью соответствующую переданному параметру. Передайте полученную статью в представление и выведите ее на экран, оформив соответствующим HTML кодом.

// Отредактируйте действия getOne так, чтобы, если для переданного параметром id не существует записи в базе данных, то выводилась ошибка 404.
    public function getOne($id){
      $post = Post::findOrFail($id);

      return view('post.post', [
        'post' => $post,
      ]);
    }


// В контроллере PostController, созданном в предыдущем уроке, сделайте действие newPost для создания новой статьи. Пусть это действие будет доступно по адресу /post/new/. В представлении действия покажите форму для добавления новой записи. После отправки формы сохраните новую запись.
    public function newPost(Request $request){
      if(isset($request->title) && $request->title != ''){
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->text = $request->text;
        $post->date = date('H:i:s');

        if($post->save()){
          return redirect('/post/all');
        }
      }

      return view('post.new');
    }


// редактирование
// Модифицируйте код действия editPost так, чтобы после сохранения формы выполнялся редирект на список всех записей (то есть на действие getAll).
// Модифицируйте предыдущую задачу так, чтобы при редиректе отправлялось флеш сообщение об успешном обновлении записи. Выводите это сообщение в представлении действия getAll.
// Модифицируйте предыдущую задачу так, чтобы во флеш сообщении был указан id и title статьи, подвергнувшейся изменению.
    public function editPost(Request $request, $id){
      $post = Post::find($id);

      if( $request->has('submit') ){
        $post->title = $request->title;
        $post->description = $request->description;
        $post->date = $request->date;
        $post->text = $request->text;

        if( $post->save() ){
          Session::flash('status', 'редактирование выполнено успешно');
          Session::flash('id', "id статъи: $id");
          Session::flash('title', "title статъи: $request->title");
          return redirect('post/all');
        }
      }
      return view('post.editPost', [
        'post' => $post,
      ]);
    }

// Другие методы создания
    public function create(){
      $post = Post::firstOrCreate([
        'title'       => 'new title2',
        'description' => 'new description',
        'date'       => 'new date',
        'text' => 'text...',
      ]);

       var_dump($post);
    }

// Удаление моделей
// Отредактируйте представление действия getAll так, чтобы появилась еще одна колонка со ссылкой на удаления соответствующей статьи.

// После удаления выполняйте редирект обратно на список статей с флеш сообщением об успешном удалении статьи. Сообщение должно содержать title удаленной статьи.
    public function delPost(Request $request, $id){
      $post = Post::find($id);
      $title = $post->title;

      $foo = $post->delete();

      if( $foo ){
        Session::flash('status', 'удаление выполнено успешно');
        Session::flash('title', "title удалённой статъи: $title");
        return redirect('/post/all');
      }
    }

  }
