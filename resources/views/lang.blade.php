<!DOCTYPE html>

<html>

<head>

    <title>How to Create Multi Language Website in Laravel - ItSolutionStuff.com</title>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>

<div class="container">

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Config::get('languages')[App::getLocale()] }}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            @foreach (Config::get('languages') as $lang => $language)
{{--                @if ($lang != App::getLocale())--}}
                    <a class="dropdown-item" href="{{ route('changeLang', $lang) }}"> {{$language}}</a>
{{--                @endif--}}
            @endforeach
        </div>
    </li>



    <h1>How to Create Multi Language Website in Laravel - ItSolutionStuff.com</h1>



    <div class="row">

        <div class="col-md-2 col-md-offset-6 text-right">

            <strong>Select Language: </strong>

        </div>

        <div class="col-md-4">
            <h3>{{session()->get('locale')}}</h3>
            <form action="{{route('changeLang')}}" method="post">@csrf
                <select class="form-control changeLang" name="lang">

                    <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>

                    <option value="fr" {{ session()->get('locale') == 'fr' ? 'selected' : '' }}>France</option>

                    <option value="bn" {{ session()->get('locale') == 'bn' ? 'selected' : '' }}>Bangla</option>

                </select>
                <input type="submit" class="btn btn-info">
            </form>



        </div>

    </div>



    <h1>{{ __('message.title') }}</h1>



</div>

</body>



<script type="text/javascript">



    {{--var url = "{{ route('changeLang') }}";--}}



    {{--$(".changeLang").change(function(){--}}

    {{--    window.location.href = url + "?lang="+ $(this).val();--}}

    {{--});--}}



</script>

</html>
