<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">
    <title>Task</title>
</head>

<body>
    <main class="content">
        <div class="container-sm mt-5">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    upload validation Error<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @if ($message = Session::get('fail'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">X</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">X</button>
                    <strong>{{ $message }}</strong>
                </div>

            @endif
            <form action={{ url('import_excel') }} method="POST" name="importform" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="formFile" class="form-label">Upload Excel File</label>
                    <input class="form-control" type="file" id="file" name="file">
                    <input type="submit" name="upload" class="btn btn-primary mt-2" value="Upload"></button>
                </div>
            </form>
        </div>
        <div class="container">
            <table class="table table-sm ">
                <thead>
                    <tr>
                        <th scope="col">book title</th>
                        <th scope="col" class="text-center">description</th>
                        <th scope="col">author title</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $book)
                        <tr>
                            <th scope="row">{{ $book->name }}</th>
                            <td class="text-center">{{ $book->description }}</td>
                            <td>{{ $book->author->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
    <script src="/js/app.js"></script>
</body>

</html>
