@extends('app')

@section('title', config('app.name'))

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h2>Welcome To {{ config('app.name') }}
                @if (Auth::check())
                    <a class="btn btn-danger btn-lg pull-right" href="{{ url('discussions/create') }}" role="button">发布新的文章 »</a>
                @endif
            </h2>
        </div>
    </div>
    <div class="container">
        <div class="container marketing">
            <!-- START THE FEATURETTES -->
            <hr class="featurette-divider">
            @foreach($discussions as $discussion)
            <div class="row featurette">
                <div class="col-md-7">
                    <h3 class="featurette-heading">
                        <a href="/discussions/{{ $discussion->id }}">{{ $discussion->title }}</a>
                    </h3>
                    <p class="list-enter-active">{{ $discussion->preface ?? '...' }}</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="post_mata ">
                            <span>
                                <i class="fa fa-user-tie"></i> {{ $discussion->user->name }}
                            </span>
                            <span>
                                <i class="fa fa-folder-open"></i> <a style="color: #15b982" href="/category/{{ $discussion->category->id }}">{{ $discussion->category->title }}</a>
                            </span>
                            {{--<span>
                                <i class="fa fa-tags"></i>
                                <a href="" style="color: #15b982" href="###">拍黄片</a>
                            </span>--}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <span><i class="fa fa-calendar-alt"></i> {{ $discussion->created_at }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    {{--445 * 190--}}
                    <img class="featurette-image img-responsive center-block" style="height: 190px" src="{{ $discussion->img }}" data-holder-rendered="true">
                </div>
            </div>

            <hr class="featurette-divider">
            @endforeach
            {{ $discussions->links() }}
            <!-- /END THE FEATURETTES -->

            <!-- FOOTER -->
            <footer>
                <p class="pull-right"><a href="#">Back to top</a></p>
            </footer>
        </div>
    </div>
@endsection
