<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Vineyard Compassion Volunteer Database (temporary).">

    <link rel="shortcut icon" type="image/png" href="{{ asset('img/favicon.png') }}">

    <title>{{ $title }} | Vineyard Compassion CRM</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sticky-footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vccrm.css') }}">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Wrap all page content here -->
    <div id="wrap">

        <!-- Fixed navbar -->
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <img src="{{ asset('img/favicon.png') }}" class="navbar-brand" alt="Vineyard Compassion">
                    {{ link_to_route(
                            'home', 'Vineyard Compassion CRM', 
                            array(),
                            array ( 'class' => 'navbar-brand' )) }}
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                    @if (Sentry::check())
                        @if (Sentry::hasAccess('contact.*'))
                            <li class="{{ strpos(Route::currentRouteName(), 'contact') === 0 ? 'active' : '' }}">{{ link_to_route('contact.index', 'Contacts') }}</li>
                        @endif
                        @if (Sentry::hasAccess('project.*'))
                            <li class="{{ strpos(Route::currentRouteName(), 'project') === 0 ? 'active' : '' }}">{{ link_to_route('project.index', 'Projects') }}</li>
                        @endif
                        @if (Sentry::hasAccess('user.*'))
                            <li class="{{ strpos(Route::currentRouteName(), 'user') === 0 ? 'active' : '' }}">{{ link_to_route('user.index', 'Users') }}</li>
                        @endif
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ HTML::username() }} <b class="caret"></b></a>
                          <ul class="dropdown-menu">
                            <li>{{ link_to_route('account.editPassword', 'Change my password') }}</li>
                            <li>{{ link_to_route('account.edit', 'Change my details') }}</li>
                            <li>{{ link_to_route('logout', 'Logout') }}</li>
                          </ul>
                        </li>
                    @endif
                    </ul>
                </div>
            </div>
        </div>

        <!-- Begin page content -->
        <div class="container">

            <div class="page-header">
                <h1>{{ $title }} @if ($subtitle) <span class="subtitle"><small>&raquo; {{ $subtitle }} @endif</small></span></h1>
            </div>

            <div>

                @if (Session::has('info'))
                <div class="alert alert-info alert-dismissable">
                    <p>{{ Session::get('info') }}</p>
                </div>
                @elseif (isset($info))
                <div class="alert alert-info alert-dismissable">
                    <p>{{{ $info }}}</p>
                </div>
                @endif

                @if (Session::has('message'))
                <div class="alert alert-danger alert-dismissable">
                    <p>{{ Session::get('message') }}</p>
                </div>
                @elseif (isset($message))
                <div class="alert alert-danger alert-dismissable">
                    <p>{{{ $message }}}</p>
                </div>
                @endif

                @if ($errors->any())
                <div class="panel panel-danger">
                    <div class="panel-heading">Validation Errors</div>
                    <div class="panel-body">
                        <ul>
                            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                        </ul>
                    </div>
                </div>
                @endif

                {{ $content }}

            </div>

        </div>

    </div>

    <!-- JavaScript placed at the end of the document so the pages load faster -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>

    <script type="text/javascript">
        
        // Initialise datepicker inputs
        $('.dp3').datepicker();
        
    </script>

    @yield('extra_js')

</body>

</html>
