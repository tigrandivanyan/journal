<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ball Journal</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    {{--@include('ball_journal_view.assets.styles')    <!-- Assets -->--}}
    <style>
        .main{
            margin:10px;
        }

    </style>

</head>
<body>



    <main id="app" class="main container-fluid">

        <ball-journal-header></ball-journal-header>
        <ball-journal-middle></ball-journal-middle>
        <ball-journal-entry-list></ball-journal-entry-list>

        {{--<modal-notification></modal-notification>--}}
        {{--<modal-notification-on-studio-delete></modal-notification-on-studio-delete>--}}
        {{--<studio-edit-form></studio-edit-form>--}}
        {{--<studio-add-form></studio-add-form>--}}
        {{--<studio-list></studio-list>--}}
    </main>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <script type="text/javascript" src="/assets/js/app.js"></script>

</body>
</html>