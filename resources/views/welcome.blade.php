<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mail Testing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center align-item-center">
            <div class="col-7">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('sendMail') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="to" class="form-label">To</label>
                                <input type="email" name="to" class="form-control" id="to">
                            </div>
                            <div class="mb-3">
                                <label for="cc" class="form-label">CC</label>
                                <input type="email" name="cc" class="form-control" id="cc">
                            </div>
                            <div class="mb-3">
                                <label for="bcc" class="form-label">BCC</label>
                                <input type="email" name="bcc" class="form-control" id="bcc">
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" name="subject" class="form-control" id="subject">
                            </div>
                            <div class="mb-3">
                                <label for="body" class="form-label">Body</label>
                                <textarea class="form-control" name="body" id="body" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send</button>
                            @if (Session::has('success'))
                                <div class="alert alert-success mt-2">Successfully send</div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-danger mt-2">Mail not sent</div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>
