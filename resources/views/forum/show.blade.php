@extends('app')

@section('title', env('APP_NAME'))

@section('content')
    <div class="jumbotron">
        <div class="container">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object img-circle" src="{{ $discussion->user->avatar }}" alt="64*64" style="width: 64px">
                    </a>
                </div>
                <div class="media-body">
                    @if (Auth::check() && Auth::user()->id == $discussion->user_id)
                        <a class="btn btn-primary btn-lg pull-right" href="{{ url("discussions/$discussion->id/edit") }}" role="button">修改文章</a>
                    @endif

                    {{--<h4 class="media-heading">{{ $discussion->title }}</h4>
                    {{ $discussion->user->name }}--}}
                    <span>
                        <i class="fa fa-fire"></i>
                        <span>阅读 <span>({{ $discussion->reading }})</span></span>
                    </span>
                    {{--<span>
                        <i class="fa fa-tags"></i>
                        <a href="###">拍黄片</a>
                    </span>--}}
                    <br><br>
                    <span><i class="fa fa-calendar-alt"></i> 2019-08-12 17:35:40</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main" id="post">
                <div class="blog-post">
                    <h2>{{ $discussion->title }}</h2>
                    <blockquote>
                        <p>{{ $discussion->preface }}</p>
                    </blockquote>
                </div><!-- /.blog-post -->
                {!! $html !!}

                <hr>

                {{-- 评论 --}}
                @foreach ($discussion->comments as $comment)
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle" src="{{ $comment->user->avatar }}" alt="64*64" style="width: 64px; height: 64px">
                            </a>
                        </div>

                        <div class="media-body">
                            <h4 class="media-heading">{{ $comment->user->name }}</h4>
                            {{ $comment->body }}
                        </div>
                    </div>
                @endforeach
                    {{-- vue.js.star--}}
                    <div class="media" v-for="comment in comments">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle" src="@{{ comment.avatar }}" alt="64*64" style="width: 64px; height: 64px">
                            </a>
                        </div>

                        <div class="media-body">
                            <h4 class="media-heading">@{{ comment.name }}</h4>
                            @{{ comment.body }}
                        </div>
                    </div>
                    {{-- vue.js.end--}}
                <hr>

                {{-- 评论输框 --}}
                @if (Auth::check())
                    @if ($errors->any())
                        <ul class="list-group">
                            @foreach ($errors->all() as $error)
                                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::open(['url' => '/comments', 'method' => 'post', 'v-on:submit' => 'onSubmitForm']) !!}

                        <div class="form-group">
                            {!! Form::hidden('discussion_id', $discussion->id, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::textarea('body', null, ['class' => 'form-control', 'v-model' => 'newComment.body']) !!}
                        </div>

                        <div>
                            {!! Form::submit('发表评论', ['class' => 'btn btn-primary form-control']) !!}
                        </div>
                    {!! Form::close() !!}
                @else
                    <a href="/user/login" class="btn btn-block btn-success">登录参与评论</a>
                @endif

            </div>
        </div>
    </div>

    <script>
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

        new Vue({
            el: '#post',
            data: {
                comments: [],
                newComment: {
                    name: '{{ Auth::user()->name ?? null }}',
                    avatar: '{{ Auth::user()->avatar ?? null }}',
                    body: ''
                },
                newPost: {
                    discussion_id: '{{ $discussion->id }}',
                    user_id: '{{ Auth::user()->id ?? null }}',
                    body: ''
                }
            },
            methods: {
                onSubmitForm:function (element) {
                    element.preventDefault();
                    var comment = this.newComment;
                    var post = this.newPost;
                    post.body = comment.body;

                    this.$http.post('/comments', post, function () {
                        this.comments.push(comment);
                    });
                    this.newComment = {
                        name: '{{ Auth::user()->name ?? null }}',
                        avatar: '{{ Auth::user()->avatar ?? null }}',
                        body: ''
                    };
                }
            }
        });
    </script>
@endsection
