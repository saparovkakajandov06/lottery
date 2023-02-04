<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MailBox</title>

  <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('summernote/summernote-bs4.min.css')}}">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form action="/advancedSearch" method="get" class="form-inline">
            @csrf
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar {{$errors->has('advancedSearch') ? 'is-invalid' : ''}}" type="search" name="advancedSearch" placeholder="Search Mail" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">{{$newmails->count()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            @foreach ($newmails as $newmail)
            <a href="/read/{{$newmail->id}}" class="dropdown-item">
                <div class="media border-bottom">
                    <img src="/img/logo.png" alt="User Avatar" class="w-25 m-1 img-circle">
                    <div class="media-body">
                        <h6 class="dropdown-item-title">
                             {{$newmail->subject}}
                        </h6>
                        <p class="text-sm">{!! Str::of($newmail->body)->limit(20) !!}</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{$newmail->created_at->diffForHumans()}}</p>
                    </div>
                </div>
            </a>
            @endforeach
            <a href="/inbox" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="../../index3.html" class="brand-link">
      <img src="/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MailBox</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/img/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="#" class="nav-link {{'trashed'!=request()->path() ? 'active' : '' }}">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Mailbox
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/inbox" class="nav-link {{'inbox'==request()->path() ? 'active' : '' }}">
                  <i class="fas fa-inbox nav-icon"></i>
                  <p>Inbox</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/new" class="nav-link {{'new'==request()->path() ? 'active' : '' }}">
                  <i class="fas fa-file nav-icon"></i>
                  <p>New Mail</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/sent" class="nav-link {{'sent'==request()->path() ? 'active' : '' }}">
                  <i class="far fa-envelope nav-icon"></i>
                  <p>Sent</p>
                </a>
              </li>

            </ul>
            <ul class="nav">
                <li class="nav-item ">
                    <a href="/draft" class="nav-link {{'draft'==request()->path() ? 'active' : '' }}">
                        <i class="far fa-file-alt nav-icon"></i><p> Drafts</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/trashed" class="nav-link {{'trashed'==request()->path() ? 'active' : '' }}">
                        <i class="far fa-trash-alt nav-icon"></i> <p>Trash</p>
                    </a>
                </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

      @yield('content')

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2021 <a href="">MailBox</a>.</strong> All rights reserved.
  </footer>
     @if(Session::has('success'))
        <div class="toasts-top-right mt-5 m-3 fixed">
            <div class="toast bg-success text-center fade show" style="min-width:300px;" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-body">
                        {{Session::get('success')}}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(Session::has('error'))
    <div class="toasts-top-right mt-5 m-3 fixed">
        <div class="toast bg-danger fade show" style="min-width:300px;" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                {{Session::get('error')}}
            </div>
            </div>
        </div>
    </div>
    @endif>
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

</body>
</html>
